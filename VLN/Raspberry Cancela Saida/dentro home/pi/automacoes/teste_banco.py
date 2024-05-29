from time import gmtime, strftime
import mysql.connector
#Pego a hora atual
data_completa = (strftime("%d/%m/%Y %H:%M:%S", gmtime()))
data =str(data_completa)
hora = str(int(data[10:13])-3)
minuto = (data[14:16])
segundo = (data[17:19])
data_completa = data[0:10]
print (data_completa);
hora_completa = hora+":"+minuto+":"+segundo
print ( hora_completa);
# Agora salvo na tabela
mydb = mysql.connector.connect(
 host="192.168.40.35",
 user="admin",
 password="logistica2019@@",
 database="bd_cancelas"
)
mycursor = mydb.cursor()
sql = "UPDATE historico_cancelas (cancela, data_leitura, hora_leitura) VALUES (%s, %s, %s)"
msg = ("Direita", data_completa, hora_completa,);
mycursor.execute(sql,msg);
mydb.commit()