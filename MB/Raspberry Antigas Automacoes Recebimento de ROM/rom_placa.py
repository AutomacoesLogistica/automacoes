import serial
import requests
import time
import numpy as np


def main():
    #url_remota = 'http://192.168.20.21/gagf/salvar_leituras_execesso_mb.php'
    url_local = 'http://localhost/AutomacaoGerdau/salvar_placa_rom.php'

    ultima_epc_442001 = "999"
    ultima_epc_ant0 = "999"
    ultima_epc_ant1 = "999"
    ultima_epc_ant2 = "999"
    ultima_epc_ant3 = "999"
    ultima_epc_entrando = "999"
    ultima_epc_saindo = "999"
    
    tipo = "nada"


    try:
        comunicacaoSerial =serial.Serial(
                port='/COM4',
                baudrate=115200,
                parity=serial.PARITY_NONE,
                stopbits=serial.STOPBITS_ONE,
                bytesize=serial.EIGHTBITS,
                timeout=1

            )

        print(comunicacaoSerial.isOpen())
    except ValueError:
        print("Erro")

    while True:
      
      try:
        mensagem = str(comunicacaoSerial.readline())
        if(len(mensagem)>10):
          dado = mensagem.split('=')
          #print(dado)
          epc = dado[1]
          epc = epc.split(',')
          epc = epc[0] # Valor da tag lida
          #print(epc)
          antena = dado[2]
          antena = antena.split(',')
          antena = antena[0] # Valor da antena lida
          #print(antena)
          hostname = dado[3]
          hostname = hostname.split(',')
          hostname = hostname[0] # Valor do hostname
          #print(hostname)
          if(epc[0:6]=="442002"):
            #print(epc)
            if((antena=='0' or antena=='1') and epc!=ultima_epc_entrando):
              print("EPC: "+ epc)
              print("Antena: " + antena)
              #print("Hostname: " + hostname)
              #print("")
              print("")
              dados = {'ca':'CA16003055',
              'epc':epc,
              'antena': antena,
              'tipo':tipo}
              #Postando em modo remoto ( CCL MB ) ###########################################################################
              #texto = None
              #try:
              #  requisicao = requests.get(url_remota,dados)
              #  #para POST mudar .get para .post
              #  texto = str(requisicao)
              #  print(texto[11:14])
              #except Exception as e:
              #  print("Requisicao deu erro:", e)
              #Postando em modo local ########################################################################################
              texto = None
              try:
                requisicao = requests.get(url_local,dados)
                #para POST mudar .get para .post
                texto = str(requisicao)
                print(texto[11:14])
              except Exception as e:
                print("Requisicao deu erro:", e)
              ultima_epc_entrando = epc

            if((antena == '2' or antena=='3') and epc!=ultima_epc_saindo):
              print("EPC: "+ epc)
              #print("Antena: " + antena)
              #print("Hostname: " + hostname)
              #print("")
              print("")
              dados = {'ca':'CA16003055',
              'epc':epc,
              'antena': antena,
              'tipo':tipo}
              #Postando em modo remoto ( CCL MB ) ###########################################################################
              #texto = None
              #try:
              #  requisicao = requests.get(url_remota,dados)
              #  #para POST mudar .get para .post
              #  texto = str(requisicao)
              #  print(texto[11:14])
              #except Exception as e:
              #  print("Requisicao deu erro:", e)
              #Postando em modo local ########################################################################################
              texto = None
              try:
                requisicao = requests.get(url_local,dados)
                #para POST mudar .get para .post
                texto = str(requisicao)
                print(texto[11:14])
              except Exception as e:
                print("Requisicao deu erro:", e)
              ultima_epc_saindo = epc
              
      except Exception as e:
        print(e)
        main()
###########################


for i in range(1, 1000000000):
  try:
    main()
  except Exception as e:
    print(e)
    print("Restarting!")
    main()
