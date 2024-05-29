import requests
import mysql.connector
import time
from time import gmtime, strftime


url_local = 'http://192.168.10.96/automacoes_poste_saida/sincronizar_excesso.php'

ultimo_id = 0

mydb = mysql.connector.connect(
    host="192.168.10.96",#nao mudar para localhost
    user="admin",
    password="Logistica2019@@",
    database="bd_poste_balanca1"
)





while(1):
    #BUSCA SE EXISTE ACIONAMENTOS PARA SEREM REALIZADOS

    mycursor = mydb.cursor()
    mycursor.execute("SELECT * FROM lidar_excesso ORDER BY id DESC LIMIT 1")
    y = 0
    myresult = mycursor.fetchall()
    for x in myresult:
      y=y+1
      if(y==1):
        id = x[0]
        sincronizado = x[23]
        if(ultimo_id != id):
          if(sincronizado =='nao'):
            #Mudo para sim e envio
            print("Tratou o id" + str(id))
            try:
              dados = {'id': id }
              texto = None
              print ('ID : ' + str(id))
              requisicao = requests.get(url_local,dados)
              texto = str(requisicao)
              print(texto[11:14])
            except Exception as e:
              print("Requisicao deu erro:", e)
            #atualiza o ultimo ID
            ultimo_id = id
        else:
          print("Ja validado!")
      else:
        y=0 # Nao apagar        
    if y<=0:
      print('sem solicitacoes')
    mydb.commit()
    time.sleep(2)