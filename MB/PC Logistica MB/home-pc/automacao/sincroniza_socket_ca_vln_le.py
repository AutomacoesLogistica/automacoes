import requests
import mysql.connector
import pyodbc
import time

url_local = 'http://192.168.10.96/automacoes/atualiza_dados.php' # NAO ESTA USANDO!
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
    database="bd_ca_vln_le"
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
      #print('a')
      valor = 0
      
      #Primeiro consulto se nao existe essa placa
      conexao = pyodbc.connect(dados_conexao)
      cursor = conexao.cursor()
      cursor.execute(f"SELECT TOP 3 * FROM INTEGRACAO_GERDAU_HM ORDER BY ID Desc" )
      dados = cursor.fetchall() 
      encontrados = 0
      array_placa = []
      for w in dados:
        encontrados = encontrados+1
        vvplaca = w[11]
        array_placa.append(vvplaca)
      
      v_encontrados = (len(array_placa)) # quantidade encontrada
      cursor.commit() # Fecha a conexao!
      if(v_encontrados>0):
        #verifico se a placa existe na lista
        if(placa in array_placa):
          print("Ignoro pois ja tem a placa na lista")
        else:
          print("Pode inserir!")
          conexao = pyodbc.connect(dados_conexao)
          cursor = conexao.cursor()
          cursor.execute("INSERT INTO INTEGRACAO_GERDAU_HM (placa_carreta,data_saida_origem,hora_saida_origem,status_processo,PROCESSADO) VALUES (?,?,?,?,?)", placa,data_saida,hora_saida,'Controle de Acesso!',0 ) #Faz um insert na tabela vendas
          cursor.commit() # Fecha a conexao!
          time.sleep(5) # Espero mais 5 segundos por seguranca!
      print('ok')
    else:
      print('erro')
    placa = ''
    hora = ''
    data = ''
    time.sleep(5)
