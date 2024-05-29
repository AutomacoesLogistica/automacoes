import requests
import mysql.connector
import time
from time import gmtime, strftime


url_local = 'http://192.168.10.96/automacoes_poste_saida/salvar_excesso_lidar.php'


mydb = mysql.connector.connect(
    host="192.168.10.96",#nao mudar para localhost
    user="admin",
    password="Logistica2019@@",
    database="bd_poste_balanca1"
)





while(1):
    #BUSCA SE EXISTE ACIONAMENTOS PARA SEREM REALIZADOS
    mycursor = mydb.cursor()
    mycursor.execute("SELECT * FROM display_balanca1 WHERE id='1'")
    y = 0
    myresult = mycursor.fetchall()
    for x in myresult:
      y=y+1
      if(y==1):
        epc_lidar = x[21]
        id_lidar = x[12]
        id_cheio_vazio = x[14]
        alerta2 = x[18]
        veiculo  = x[22]

        print(epc_lidar)
        
        if len(str(epc_lidar)) == 24:
          try:
            dados = {'epc_lidar': epc_lidar,'id_lidar':id_lidar,'id_cheio_vazio':id_cheio_vazio,'alerta2':alerta2,'veiculo':veiculo}
            texto = None
            requisicao = requests.get(url_local,dados)
            texto = str(requisicao)
            print(texto[11:14])
          except Exception as e:
            print("Requisicao deu erro:", e)
        else:
          print('Aguardando tag valida!')
    if y<=0:
      print('sem solicitacoes')
    mydb.commit()
    time.sleep(1)