import pyodbc # pip3 install pyodbc

# Some other example server values are
# server = 'localhost\sqlexpress' # for a named instance
# server = 'myserver,port' # to specify an alternate port

#Dados servidor local *******************
#server = 'localhost' 
#db = 'db_herculano' 
#username = 'Bruno' 
#password = 'Bruno123@@' 
#driver='{SQL Server Native Client 11.0}'


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
conexao = pyodbc.connect(dados_conexao)
cursor = conexao.cursor()

#cursor.execute("INSERT INTO tbl_Vendas (cliente) VALUES ('Fernanda')") #Faz um insert na tabela vendas
#Sample select query
#cursor.execute("SELECT * from tbl_Vendas WHERE cliente='Amanda'")
#dados = cursor.fetchone() 
#if(dados == None):
#    print("Vazio")
#else:
#    print("Achou ==> " + str(dados))
    
#while row: 
#    print("ID = " + str(row[0]) + " - Cliente = " + str(row[1]))
#    row = cursor.fetchone()
#cursor.execute("INSERT INTO tbl_Vendas (cliente) VALUES ('Fernanda')") #Faz um insert na tabela vendas
#cursor.execute ("UPDATE tbl_vendas SET cliente='Amanda' WHERE cliente='Sabrina'")



#cursor.execute("SELECT * from tbl_Vendas") #Selecionar todos
#cursor.execute("SELECT TOP 1 * from tbl_Vendas")  #Selecionar o 1 apenas
#cursor.execute("SELECT TOP 1 * from tbl_Vendas ORDER BY id_venda DESC")  #Selecionar o 1 apenas com order by desc na coluna id_vendas




#row = cursor.fetchone() 
#while row: 
#    print("ID = " + str(row[0]) + " - Cliente = " + str(row[1]))
#    row = cursor.fetchone()





#Sample select query
cursor.execute("SELECT @@version;") 
row = cursor.fetchone() 
while row: 
    print(row[0])
    row = cursor.fetchone()


