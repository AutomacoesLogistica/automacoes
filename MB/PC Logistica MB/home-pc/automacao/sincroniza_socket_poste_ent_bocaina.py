import requests
import mysql.connector
import time
from time import gmtime, strftime


url_local4 = 'http://192.168.10.96/sockets/bocaina/entrada/testa_tag_gagf.php'
url_local5 = 'http://192.168.10.96/sockets/bocaina/entrada/atualiza_hora.php'


ultima_epc_carreta_balanca = ""

mydb = mysql.connector.connect(
    host="localhost",#nao mudar para localhost
    user="admin",
    password="Logistica2019@@",
    database="bd_poste_entrada_bocaina"
)
mydb2 = mysql.connector.connect(
    host="localhost",#nao mudar para localhost
    user="admin",
    password="Logistica2019@@",
    database="bd_poste_balanca1"
)



while(1):
    #BUSCA SE EXISTE ACIONAMENTOS PARA SEREM REALIZADOS
    
    mycursor = mydb.cursor()
    mycursor.execute("SELECT * FROM validacoes_socket ORDER BY id Desc LIMIT 1")
    y = 0
    myresult = mycursor.fetchall()
    print("")
    print("")
    print("Inciando ...")
    print("")
    for x in myresult:
      y=y+1
      if(y>0): #Trata apenas o primeiro
        id = x[0]
        epc = x[1]
        ponto = x[3]
        condicao = x[6]
        print(condicao)

        if(epc != ultima_epc_carreta_balanca and condicao == 'pendente'):
          ultima_epc_carreta_balanca = epc
          #Mando publicar para fazer as validacoes do dashboard
          ponto = 'Entrada Bocaina'
          #try:
          #  dados = {'epc': epc , 'ponto': ponto}
          #  texto = None
          #  print ('ID : ' + str(id))
            #requisicao = requests.get(url_local,dados)
            #texto = str(requisicao)
            #print(texto[11:14])
          #except Exception as e:
          #  print("Requisicao deu erro:", e)
          
          #url_local4 = 'http://192.168.10.96/sockets/bocaina/entrada/testa_tag_gagf.php'
          try:
            dados = {'epc': epc , 'ponto': ponto}
            texto = None
            print ('ID : ' + str(id))
            requisicao = requests.get(url_local4,dados)
            texto = str(requisicao)
            print(texto[11:14])
          except Exception as e:
            print("Requisicao deu erro:", e)          
          
          
          #Atualiza tratado para sim **************************************************************************  
          try:
            mycursor = mydb.cursor()
            sql = "UPDATE validacoes_socket SET condicao = 'Tratado' WHERE id = %s" %id
            mycursor.execute(sql)
            mydb.commit()
          except Exception as e:
            print("Requisicao deu erro:", e)
          
        time.sleep(0.5)  
      else:
        print("igual a ultima epc")
        y=0 # Nao apagar        
    if y<=0:
      print('sem solicitacoes')
    mydb.commit()
    #ATUALIZA SERVICE **********************************************************************************************
    try:
      #url_local5 = 'http://192.168.10.96/sockets/bocaina/entrada/atualiza_hora.php'
      dados = {'a': 'a'}
      texto = None
      print ('ID : ' + str(id))
      requisicao = requests.get(url_local5,dados)
      texto = str(requisicao)
      print(texto[11:14])
    except Exception as e:
      print("Requisicao deu erro:", e)    
    time.sleep(1)
    