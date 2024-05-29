import requests
import mysql.connector
import time
from time import gmtime, strftime


url_local = 'http://192.168.40.251/dashboard/saida_vln/saida.php'
url_local2 = 'http://192.168.40.251/saida/saida.php'
url_local3 = 'http://192.168.40.251/saida/atualiza_tag.php'

ultima_epc_carreta_balanca = ""

mydb = mysql.connector.connect(
    host="192.168.40.107",#nao mudar para localhost
    user="admin",
    password="logistica2019@@",
    database="bd_saida_vln"
)





while(1):
    #BUSCA SE EXISTE ACIONAMENTOS PARA SEREM REALIZADOS
    
    mycursor = mydb.cursor()
    mycursor.execute("SELECT * FROM validacoes_socket ORDER BY id Desc LIMIT 8")
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
        antena = x[2]
        ponto = x[3]
        condicao = x[6]
        print(condicao)

        if(epc != ultima_epc_carreta_balanca and condicao == 'pendente'):
          ultima_epc_carreta_balanca = epc
          #Mando publicar para fazer as validacoes do dashboard
          if(antena == "0" or antena =="1"):
            ponto = 'Saida VLN LE'
          else:
            ponto = "Saida VLN LD"
          
          try:
            dados = {'epc': epc , 'rodar': ponto}
            texto = None
            print ('ID : ' + str(id))
            requisicao = requests.get(url_local,dados)
            texto = str(requisicao)
            print(texto[11:14])
          except Exception as e:
            print("Requisicao deu erro:", e)

          # Essa linha para fazer dar pulso na cancela! ************************************************************************
          try:
            dados = {'epc': epc , 'rodar': ponto}
            texto = None
            print ('ID : ' + str(id))
            requisicao = requests.get(url_local2,dados)
            texto = str(requisicao)
            print(texto[11:14])
          except Exception as e:
            print("Requisicao deu erro:", e)

        # Essa linha para fazer atualizar a tag lida nas cancelas la no portal! ************************************************************************
        try:
          dados = {'epc': epc , 'rodar': ponto}
          texto = None
          print ('ID : ' + str(id))
          requisicao = requests.get(url_local3,dados)
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
        time.sleep(0.5)  
      else:
        y=0 # Nao apagar        
    if y<=0:
      print('sem solicitacoes')
    mydb.commit()
    time.sleep(1)