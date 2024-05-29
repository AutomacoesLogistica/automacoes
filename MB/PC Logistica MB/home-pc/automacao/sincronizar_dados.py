import requests
import mysql.connector
import time
from time import gmtime, strftime


url_local = 'http://192.168.10.96/automacoes_poste_saida/sincronizar_dados.php'


mydb = mysql.connector.connect(
    host="192.168.10.96",#nao mudar para localhost
    user="admin",
    password="Logistica2019@@",
    database="bd_poste_balanca1"
)





while(1):
    
    #BUSCA SE EXISTE ACIONAMENTOS PARA SEREM REALIZADOS
    mycursor = mydb.cursor()
    mycursor.execute("SELECT * FROM sincronizar_dados WHERE condicao = 'pendente' ORDER BY id DESC LIMIT 1")
    y = 0
    myresult = mycursor.fetchall()
    for x in myresult:
      y=y+1
      if(y==1):
        id = x[0]
        print ("Iniciando as tratativas!")
        try:
          dados = {'id': id }
          texto = None
          print ('ID : ' + str(id))
          requisicao = requests.get(url_local,dados) # Passa os dados para tratar o sincronizar_dados
          texto = str(requisicao)
          print(texto[11:14])
        except Exception as e:
          print("Requisicao deu erro:", e)
        try:
          #Agora mudo para tratado a linnha
          mycursor = mydb.cursor()
          sql = "UPDATE saida_automacoes SET condicao = 'Tratado!' WHERE id = %s" %id
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