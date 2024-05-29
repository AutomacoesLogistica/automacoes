import serial
import requests
import time
import RPi.GPIO as GPIO
from time import gmtime, strftime
from threading import Thread
import mysql.connector
cancela1 = "21";#Era21 # Codigo lora referente a cancela do lado Esquerdo
cancela2 = "22";#Era22 # Codigo lora referente a cancela do lado Direito

global ciclo
ciclo = 0
tempo_cancela1 = 2; # tempo em segundos
tempo_cancela2 = 2; # tempo em segundos
GPIO.setmode(GPIO.BCM);
GPIO.setwarnings(False);
LED_rodando = 12;
LED_saida1 = 6;
LED_saida2 = 5;
Saida1 = 19;
Saida2 = 26;
Entrada1 = 20;
Entrada2 = 21;
# Saidas
GPIO.setup(LED_rodando, GPIO.OUT);
GPIO.setup(LED_saida1, GPIO.OUT);
GPIO.setup(LED_saida2, GPIO.OUT);
GPIO.setup(Saida1, GPIO.OUT);
GPIO.setup(Saida2, GPIO.OUT);

# Entradas
GPIO.setup(Entrada1, GPIO.IN, pull_up_down = GPIO.PUD_DOWN)
GPIO.setup(Entrada2, GPIO.IN, pull_up_down = GPIO.PUD_DOWN)

GPIO.output(LED_rodando,GPIO.LOW); # Inicia desligado o led rodando
GPIO.output(LED_saida1,GPIO.LOW); # Inicia desligado o led da saida 1
GPIO.output(LED_saida2,GPIO.LOW); # Inicia desligado o led da saida 2
GPIO.output(Saida1,GPIO.HIGH); # Inicia desligado a saida 1 - Rele atua com LOW
GPIO.output(Saida2,GPIO.HIGH); # Inicia desligado a saida 2 - Rele atua com LOW

GPIO.output(Saida1,GPIO.LOW); # Inicia desligado a saida 2 - Rele atua com LOW
time.sleep(5)
GPIO.output(Saida1,GPIO.HIGH); # Inicia desligado a saida 2 - Rele atua com LOW

