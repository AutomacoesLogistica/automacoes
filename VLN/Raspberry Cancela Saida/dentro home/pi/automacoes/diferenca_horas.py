from time import gmtime, strftime
import datetime

#Pego a hora atual
data_completa = (strftime("%d/%m/%Y %H:%M:%S", gmtime()))
data =str(data_completa)
hora = str(int(data[10:13])-3)
minuto = (data[14:16])
segundo = (data[17:19])
data_completa = data[0:10]
hora_completa = hora+":"+minuto+":"+segundo
time_2 = datetime.timedelta(hours= int(hora) , minutes=int(minuto), seconds=int(segundo))
time_1 = datetime.timedelta(hours= 16, minutes=48, seconds=45)

resultado = (time_2-time_1);
print(type(resultado));