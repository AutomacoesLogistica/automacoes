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
    #Agora faço o insert no banco SQL da herculano
    placa = 'RVE5A94'
    if(placa != ''):
      #Verifico se a placa ja esta com status de saindo planta
      conexao = pyodbc.connect(dados_conexao)
      cursor = conexao.cursor()
      valor = 0
      data_saida = '19/05/2023'
      cursor.execute(f"SELECT TOP 1 * FROM INTEGRACAO_GERDAU_HM WHERE (placa_carreta='{placa}' AND data_saida_origem='{data_saida}' AND status_processo!='Saindo da Planta!') ORDER BY ID Desc" ) #Faz um insert na tabela vendas
      #cursor.execute("INSERT INTO INTEGRACAO_GERDAU_HM (placa_carreta,data_saida_origem,hora_saida_origem,status_processo,PROCESSADO) VALUES (?,?,?,?,?)", placa,data_saida,hora_saida,'Saindo da Planta!',0 ) #Faz um insert na tabela vendas
      dados = cursor.fetchone() 
      if(dados == None):
        print("Vazio")
        cursor.commit()
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
      
      
      print('ok')
    else:
      print('erro')
    placa = ''
    hora = ''
    data = ''
    time.sleep(5)
