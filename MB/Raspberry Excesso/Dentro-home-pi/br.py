#!/usr/bin/env python3

'''
Programa para estudo de comunicação serial via USB entre Raspberry e Arduino
Lembrar de verificar na Raspberry a porta serial onde o Arduino está conectado,
utilizando um dos comandos abaixo:
ls /dev/tty* ou dmesg | grep tty
'''

#Importação de bibliotecas ou módulos:
from serial import serial
comunicacaoSerial = serial.Serial('/dev/ttyACM0', 9600)


# Rotina principal com o Loop Infinito:
while True:
    print(comunicacaoSerial.readline()) #imprime no console o valor recebido pela serial
