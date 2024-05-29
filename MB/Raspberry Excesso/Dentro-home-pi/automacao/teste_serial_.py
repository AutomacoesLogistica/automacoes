#!/usr/bin/env python3
import serial
comunicacaoSerial = serial.Serial('/dev/ttyUSB0', 115200)
while True:
   mensagem =str(comunicacaoSerial.readline())
   if(mensagem.startswith('b')):
     if(mensagem.endswith("'")):
       dado = (mensagem[2:len(mensagem)-5])
       dado = dado.split(',')
       epc = (dado[0])
       epc = epc.split(':')
       antena = (dado[1])
       antena = antena.split(':')
       hostname = (dado[2])
       hostname = hostname.split(':')
       print('EPC = ' + epc[1])
       print('Antena = ' + antena[1])
       print('Hostname = ' + hostname[1])