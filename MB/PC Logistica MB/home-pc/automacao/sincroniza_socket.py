import requests
import mysql.connector
import time
from time import gmtime, strftime


url_local = 'http://192.168.10.96/automacoes_poste_saida/verifica_condicao.php'


mydb = mysql.connector.connect(
    host="localhost",#nao mudar para localhost
    user="admin",
    password="Logistica2019@@",
    database="bd_poste_balanca1"
)





while(1):
    #BUSCA SE EXISTE ACIONAMENTOS PARA SEREM REALIZADOS
    mycursor = mydb.cursor()
    mycursor.execute("SELECT * FROM validacoes_socket WHERE condicao = 'pendente' ORDER BY id DESC LIMIT 1")
    y = 0
    myresult = mycursor.fetchall()
    for x in myresult:
      y=y+1
      if(y==1):
        id = x[0]
        epc = x[1]
        try:
          dados = {'epc': epc }
          texto = None
          print ('ID : ' + str(id))
          requisicao = requests.get(url_local,dados)
          texto = str(requisicao)
          print(texto[11:14])
        except Exception as e:
          print("Requisicao deu erro:", e)
        try:
          #apago a linha
          #Agora apaga a linnha
          mycursor = mydb.cursor()
          sql = "UPDATE validacoes_socket SET condicao = 'Tratado' WHERE id = %s" %id
          mycursor.execute(sql)
          mydb.commit()
    
        except Exception as e:
          print("Requisicao deu erro:", e)
        
      else:
        y=0 # Nao apagar        
    if y<=0:
      print('sem solicitacoes')
    mydb.commit()
    time.sleep(2)