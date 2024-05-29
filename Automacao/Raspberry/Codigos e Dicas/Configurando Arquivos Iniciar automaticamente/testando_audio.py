# Importando o PyGame
import pygame
import os
import time
import random
import RPi.GPIO as GPIO

GPIO.setmode(GPIO.BOARD)
GPIO.setwarnings(False)
GPIO.setup(35, GPIO.IN)
GPIO.setup(37, GPIO.OUT)
valor = 0

while True:
  if(valor == 0):
    GPIO.output(37,GPIO.HIGH)
  if(valor >2):
    GPIO.output(37,GPIO.LOW)
    valor = -2
  valor = valor + 1
  #print(valor)
  if(GPIO.input(35) == False):
    my_array = ["audio_0.mp3","audio_1.mp3","audio_2.mp3"]
    audio = random.randint(0,2)
    pygame.init()
    if os.path.exists(my_array[audio]):
      pygame.mixer.music.load(my_array[audio])
      pygame.mixer.music.play()
      clock = pygame.time.Clock()
      clock.tick(1)
      while pygame.mixer.music.get_busy():
        clock.tick(1)
    else:
      print('O arquivo musica.mp3 não está no diretório do script Python')
  time.sleep(.2)
GPIO.cleanup()
