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
    tag = '442002000000000000001632'
    mycursor = mydb.cursor()
    mycursor.execute("SELECT * FROM tabela_referencia WHERE tag='%s'" % tag)
    
    y = 0
    myresult = mycursor.fetchall()
    for x in myresult:
      y=y+1
      if(y==1):
        id = x[0]
        print(x)
    time.sleep(5)
