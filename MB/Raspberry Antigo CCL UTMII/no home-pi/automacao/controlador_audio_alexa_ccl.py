# Importando o PyGame
import pygame
import os
import time
import random
#import RPi.GPIO as GPIO
import mysql.connector


v_id = 0
valor = 0
vezes = 0
y = 0

while(1):
    mydb = mysql.connector.connect(
        host="192.168.20.21",
        user="admin",
        password="logistica2019@@",
        database="bd_sva"
    )
    mycursor = mydb.cursor()
    mycursor.execute("SELECT * FROM audios ORDER BY id DESC LIMIT 1")
    myresult = mycursor.fetchall()
    for x in myresult:
        #print(x)
        y=y+1
        if(y == 1):
            print(x)
            v_id = x[0]
            valor_audio  = str(x[1]).split('.')
            valor_audio = (valor_audio[1])
            audio = "/var/www/html/sva/" + valor_audio + ".mp3" # Executar extensoes .mp3
            print(audio)
            pygame.mixer.pre_init(frequency=48000, channels=2, buffer=512)
            pygame.mixer.init()
            if os.path.exists(audio):
                pygame.mixer.music.load(audio)
                pygame.mixer.music.play()
                clock = pygame.time.Clock()
                clock.tick(1)
                while pygame.mixer.music.get_busy():
                    clock.tick(1)
                #Agora remove o arquivo do banco
                print('Valor do id e : ' + str(v_id))
                mycursor = mydb.cursor()
                sql = "DELETE FROM audios WHERE id = %s"
                valor_id = v_id
                mycursor.execute(sql,(valor_id,))
                v_id = 0
                vezes = 0
            else:
                print('O arquivo não está no diretório do script Python')
            print(mycursor.rowcount, "record(s) deleted")
            mydb.commit()
            mydb.close()
            break    
        
     
    if y>0:
        #print(y)
        pass
    else:
        print("Nao encontrado!")
        
    time.sleep(2)
    valor = valor+1
    print("Rodando" + str(valor))
    mydb.close()
    v_id = 0
    y = 0
    vezes = 0
