import requests
import mysql.connector
import time
from time import gmtime, strftime


url_local = 'http://192.168.10.96/dashboard_utmi/utmi/validacoes_gagf.php'


mydb = mysql.connector.connect(
    host="localhost",#nao mudar para localhost
    user="admin",
    password="Logistica2019@@",
    database="bd_dashboard"
)





while(1):
    #BUSCA SE EXISTE ACIONAMENTOS PARA SEREM REALIZADOS
    mycursor = mydb.cursor()
    mycursor.execute("SELECT * FROM tabela_validacoes ORDER BY id DESC LIMIT 1")
    y = 0
    myresult = mycursor.fetchall()
    for x in myresult:
      y=y+1
      if(y==1):
        id_tabela = x[0]
        epc = x[1]
        try:
         dados = {'epc': epc,'id': id_tabela}
         texto = None
         requisicao = requests.get(url_local,dados)
         texto = str(requisicao)
         print(texto[11:14])
        except Exception as e:
          print("Requisicao deu erro:", e)
        try:
          #Agora apaga a linnha
          mycursor = mydb.cursor()
          sql = "DELETE FROM tabela_validacoes WHERE id = %s" %id_tabela
          mycursor.execute(sql)
          mydb.commit()  
        except Exception as e:
          print("Requisicao deu erro:", e)
        
    if y<=0:
      print('sem solicitacoes')
    mydb.commit()
    time.sleep(1)