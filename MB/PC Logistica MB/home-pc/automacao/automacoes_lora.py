import serial
#import requests
import mysql.connector
import time
from time import gmtime, strftime
import random

def main():
  comunicacaoSerial =serial.Serial(
          port='/dev/ttyUSB0',
          baudrate=115200,
          parity=serial.PARITY_NONE,
          stopbits=serial.STOPBITS_ONE,
          bytesize=serial.EIGHTBITS,
          timeout=1

      )

  mydb = mysql.connector.connect(
      host="localhost",#nao mudar para localhost
      user="admin",
      password="Logistica2019@@",
      database="bd_poste_balanca1"
  )


  mensagem_lora = ""
  while(1):
      try:
        #BUSCA SE EXISTE ACIONAMENTOS PARA SEREM REALIZADOS
        mycursor = mydb.cursor()
        mycursor.execute("SELECT * FROM mensagens_lora ORDER BY id ASC")
        y = 0
        myresult = mycursor.fetchall()
        for x in myresult:
          y=y+1
          if(y==1):
            try:
              id_tabela = x[0]
              v_mensagem_lora = x[1]
            except Exception as e:
              print("Requisicao deu erro:", e)
              comunicacaoSerial.write(str(v_mensagem_lora).encode('ascii'))
              time.sleep(1)
            try:
              #Insere na tabela acionamentos efetuados
              #BUSCA HORA E TRATA PARA SALVAR
              data_completa = (strftime("%d/%m/%Y %H:%M:%S", gmtime()))
              data =str(data_completa)
              hora = str(int(data[10:13])-3)
              minuto = (data[14:16])
              segundo = (data[17:19])
              data_completa = data[0:10]
              hora_completa = hora+":"+minuto+":"+segundo
            except Exception as e:
              print("Requisicao deu erro:", e)
            try:
              mycursor = mydb.cursor()
              sql = "INSERT INTO historico_lora (mensagem,data_atualizacao,hora_atualizacao) VALUES (%s, %s, %s)"
              val = (v_mensagem_lora,data_completa,hora_completa)
              mycursor.execute(sql, val)
              mydb.commit()
              #Agora apaga a linnha
              mycursor = mydb.cursor()
              sql = "DELETE FROM mensagens_lora WHERE id = %s" %id_tabela
              mycursor.execute(sql)
              mydb.commit()
            except Exception as e:
              print("Requisicao deu erro:", e)
              main()
        if y<=0:
          print("sem_requisicoes: " + str(random.randrange(1, 100)))
          mydb.commit()
        else:
          print("Apagado comando " + v_mensagem_lora)
      except Exception as e:
        print("Requisicao deu erro:", e)
        main()

      mensagem = str(comunicacaoSerial.readline())
      try:
        if (len(mensagem)>=5):
          if(mensagem.startswith('b')):
            if(mensagem.endswith("'")):
              dado = (mensagem[2:len(mensagem)-5]) #-1
              #print(dado)
              if(dado[0:1]=="+" and dado[len(dado)-1:len(dado)]=="+"):
                  #print("sim")
                  mensagem_lora = dado[1:len(dado)-1]
                  #print(mensagem_lora)
                  mensagem_lora = mensagem_lora.split(',')
                  semaforo_entrada = mensagem_lora[0]
                  semaforo_saida = mensagem_lora[1]
                  #print(semaforo_entrada)
                  #print(semaforo_saida)
                  if(semaforo_entrada == "verde" and semaforo_saida == "vermelho"):
                    print("Liberado para operacao!")

                  elif(semaforo_entrada == "vermelho" and semaforo_saida == "vermelho"):
                    print("Iniciando tratativas!")
                    time.sleep(2)
                    for x in range(3):
                        comunicacaoSerial.write(str(">1,1<").encode('ascii')) # Fecha para informar que esta tratando!

                  elif(semaforo_entrada == "vermelho" and semaforo_saida == "verde"):
                    print("Finalizado tratativas!")

                  elif(semaforo_entrada == "verde" and semaforo_saida == "verde"):
                    print("Bloqueado")



              elif(dado[0:1]==">" and dado[len(dado)-1:len(dado)]=="<"):
                  #print("auxiliares")
                  mensagem_lora = dado[1:len(dado)-1]
                  if(mensagem_lora == "val_alerta"):
                    print("Tratado alguem com algum tipo de alerta!")
                    comunicacaoSerial.write(str(">0,1<").encode('ascii')) # Libera para operacao novamente
                  #Salvar no banco de dados
                  elif(mensagem_lora == "tratando"):
                    print("Tratado o veiculo atual!")
                  elif(mensagem_lora == "bloqueado"):
                    print("Desativado as automacoes, os dois semaforos estao em verde!")
                    #Salvar no banco de dados
                  elif(mensagem_lora == "liberado"):
                    print("Liberado para iniciar trativas!")
                    #Salvar no banco de dados
                  elif(mensagem_lora == "aguardando"):
                    print("Liberado e aguardando alguem aproximar para iniciar trativas!")
                    #Salvar no banco de dados
                  elif(mensagem_lora == "acabou"):
                    print("Liberado para iniciar trativas!")
                    comunicacaoSerial.write(str(">0,1<").encode('ascii')) # Libera para operacao novamente
                    #Salvar no banco de dados
                  elif(mensagem_lora == "avancou"):
                    print("Alguem acabou de avancar o semáforo!")
      except Exception as e:
        print("Requisicao deu erro:", e)
        main()
        



for i in range(1, 1000000000):
  try:
    main()
  except Exception as e:
    print(e)
    print("Restarting!")
    main()