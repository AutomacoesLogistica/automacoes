#Teste leitura QRCODE
from qrtools import QR 
my_QR = QR(filename = "/home/pc/automacao/QRCODE/qrcode_teste2.png") 
my_QR.decode() 
print (my_QR.data) 
