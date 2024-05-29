import requests
import mysql.connector
import pyodbc
import time

url_local = 'http://192.168.10.96/automacoes/atualiza_dados.php'
placa = ''
data_saida = ''
hora_saida = ''

#DADOS CONEXAO COM A HERCULANO SQL SERVER ************************************************

#Dados servidor herculano
server = '200.209.137.130'
db = 'MINA_WEB' 
username = 'GERDAU' 
password = 'G3rd@u' 
#driver='{SQL Server}'
#print (pyodbc.drivers())
#drivers = pyodbc.drivers()
#driver = drivers[0]
#print(driver)
driver='ODBC Driver 18 for SQL Server'

dados_conexao = ("DRIVER="+driver+";"
                 "Server="+server+";"
                 "Database="+db+";"
                 "UID="+username+";"
                 "PWD="+password+";"
                 "Encrypt=no;"
                 )

# DADOS MYSQL LOCAL PC LOGISTICA ***********************************************************
mydb = mysql.connector.connect(
    host="localhost",#nao mudar para localhost
    user="admin",
    password="Logistica2019@@",
    database="bd_saida_vln"
)


while(1):
    #BUSCA SE EXISTE ACIONAMENTOS PARA SEREM REALIZADOS
    mycursor = mydb.cursor()
    mycursor.execute("SELECT * FROM validacoes_socket WHERE condicao = 'pendente' ORDER BY id DESC LIMIT 1")
    y = 0
    myresult = mycursor.fetchall()
    for x in myresult:
      y=y+1
      epc = ''
      if(y==1):
        id = x[0]
        epc = x[1]
        data_saida = x[4]
        hora_saida = x[5]
        #print ('ID : ' + str(id) + " - Data: " + data_saida + "  - Hora: " + hora_saida)

        try:
          dados = {'epc': epc }
          texto = None
          print ('ID : ' + str(id) + " - Data: " + data_saida + "  - Hora: " + hora_saida + " -  TAG = " + epc) 
          #requisicao = requests.get(url_local,dados)
          #texto = str(requisicao)
          #print(texto[11:14])
        except Exception as e:
          print("Requisicao deu erro:", e)
        mydb.commit()
        try:
          print("Consultando a tag = " + epc)
          #epc = '442002000000000000001911'
          mycursor = mydb.cursor()
          mycursor.execute("SELECT * FROM tabela_referencia WHERE tag='%s' LIMIT 1" % epc)
          y = 0
          w = 0
          epc = ''
          myresult = mycursor.fetchall()
          for w in myresult:
            placa = ''
            print("Achou a placa " + str(w)) 
            y=y+1
            if(y>0):
              placa = w[1]
              print (placa)
        except Exception as e:
          print("Requisicao deu erro:", e)
        mydb.commit()
        try:
          #Agora mudo o status para tratado
          print('d')
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


    #Agora faço o insert no banco SQL da herculano
    if(placa != ''):
      #Pode publicar para herculano
      #Verifico se a placa ja esta com status de saindo planta
      conexao = pyodbc.connect(dados_conexao)
      cursor = conexao.cursor()
      valor = 0
      cursor.execute(f"SELECT TOP 1 * FROM INTEGRACAO_GERDAU_HM WHERE (placa_carreta='{placa}' AND data_saida_origem='{data_saida}' AND status_processo!='Saindo da Planta!') ORDER BY ID Desc" ) #Faz um insert na tabela vendas
      #cursor.execute("INSERT INTO INTEGRACAO_GERDAU_HM (placa_carreta,data_saida_origem,hora_saida_origem,status_processo,PROCESSADO) VALUES (?,?,?,?,?)", placa,data_saida,hora_saida,'Saindo da Planta!',0 ) #Faz um insert na tabela vendas
      dados = cursor.fetchone() 
      if(dados == None):
        print("Vazio")
        cursor.commit()
        #Não encontrou, faço INSERT
        conexao = pyodbc.connect(dados_conexao)
        cursor = conexao.cursor()
        valor = 0
        cursor.execute("INSERT INTO INTEGRACAO_GERDAU_HM (placa_carreta,data_saida_origem,hora_saida_origem,status_processo,PROCESSADO) VALUES (?,?,?,?,?)", placa,data_saida,hora_saida,'Saindo da Planta!',0 ) #Faz um insert na tabela vendas
        cursor.commit()
        print('ok')

      else:
        print("Achou ==> " + str(dados))
        id = dados[0]
        print(id)
        cursor.commit()
        #Faço entao UPDATE
        conexao = pyodbc.connect(dados_conexao)
        cursor = conexao.cursor()
        valor = 0
        data_saida = '19/05/2023'
        hora_saida = '15:48:22'
        cursor.execute(f"UPDATE INTEGRACAO_GERDAU_HM SET  data_saida_origem='{data_saida}',hora_saida_origem='{hora_saida}',status_processo='Saindo da Planta!' WHERE ID='{id}'" ) #Faz um insert na tabela vendas
        cursor.commit() 
        print('Finalizado UPDATE!')
    placa = ''
    hora = ''
    data = ''
    time.sleep(5)
