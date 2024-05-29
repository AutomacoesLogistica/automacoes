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



# ATUALIZAO NO PORTAL **********************************************************
mydb = mysql.connector.connect(host="192.168.40.35",user="admin",password="logistica2019@@",database="bd_cancelas")
mycursor = mydb.cursor()
sql = "UPDATE id_cancelas_vln SET data=%s,hora=%s, info=%s WHERE id=3"
msg = (data_completa,hora_completa, "Acionado cancela Direita");
mycursor.execute(sql,msg);
mydb.commit()
# *******************************************************************************