import requests
import mysql.connector
import time
from time import gmtime, strftime


url_local = 'http://192.168.10.35/automacoes_poste_saida/tratar_saida_automacoes.php'


mydb = mysql.connector.connect(
    host="localhost",#nao mudar para localhost
    user="admin",
    password="Logistica2019@@",
    database="bd_poste_balanca1"
)





while(1):
    #BUSCA SE EXISTE ACIONAMENTOS PARA SEREM REALIZADOS
    mycursor = mydb.cursor()
    mycursor.execute("SELECT * FROM saida_automacoes WHERE condicao = 'pendente' ORDER BY id DESC LIMIT 1")
    y = 0
    myresult = mycursor.fetchall()
    for x in myresult:
      y=y+1
      if(y==1):
        epc_carreta = x[1]
        id = x[0]
        
        print(epc_carreta)
        
        if len(str(epc_carreta)) == 24:
          try:
            dados = {'epc_carreta': epc_carreta,'id':id}
            texto = None
            requisicao = requests.get(url_local,dados)
            texto = str(requisicao)
            print(texto[11:14])
          except Exception as e:
            print("Requisicao deu erro:", e)
          try:
            #apago a linha
            #Agora apaga a linnha
            mycursor = mydb.cursor()
            sql = "UPDATE saida_automacoes SET condicao = 'Tratado' WHERE id = %s" %id
            mycursor.execute(sql)
            mydb.commit()
          except Exception as e:
            print("Requisicao deu erro:", e)

        else:
          print('Aguardando tag valida!')
    if y<=0:
      print('sem solicitacoes')
    mydb.commit()
    time.sleep(5)