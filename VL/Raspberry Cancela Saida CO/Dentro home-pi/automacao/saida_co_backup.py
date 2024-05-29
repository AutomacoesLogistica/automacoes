import serial
import requests
import time
import numpy as np


def main():
    url_dashboard = 'http://localhost/dashboard/dashboard_ponto_saida_co.php'
    url_dashboard2 = 'http://192.168.30.124/dips/verifica_tempo.php'

    ultima_epc_442001 = "999"
    ultima_epc_442002 = "999"
    tipo = "nada"


    try:
        comunicacaoSerial =serial.Serial(
                port='/dev/ttyUSB0',
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
          print(dado)
          epc = dado[1]
          epc = epc.split(',')
          epc = epc[0] # Valor da tag lida
          print(epc)
          antena = dado[2]
          antena = antena.split(',')
          antena = antena[0] # Valor da antena lida
          #print(antena)
          hostname = dado[3]
          hostname = hostname.split(',')
          hostname = hostname[0] # Valor do hostname
          #print(hostname)
          data = str(dado[4])
          data_ano = data[0:4]
          data_mes = data[5:7]
          data_dia = data[8:10]
          data = data_dia + "/" + data_mes + "/" + data_ano # Pega a data
          #print(data)
          hora = str(dado[5])
          hora = hora[0:8]
          #print(hora)
          if(epc[0:6]=="442002"):
            if(epc!=ultima_epc_442002):
              tipo = "Carreta"
              print("EPC: "+ epc)
              print("Antena: " + antena)
              print("Hostname: " + hostname)
              print("Data: "+data)
              print("Hora: "+hora)
              print("tipo: "+tipo)
              print("")
              print("")
              dados = {'ca':'CA16002802',
              'data':data,
              'hora':hora,
              'epc':epc,
              'antena': antena,
              'tipo':tipo}
              #Postando em modo remoto ( CCL VL ) ###########################################################################
              texto = None
              #try:
              #  requisicao = requests.get(url_remota,dados)
              #  #para POST mudar .get para .post
              #  texto = str(requisicao)
              #  print(texto[11:14])
              #except Exception as e:
              #  print("Requisicao deu erro:", e)

              #Agora publico para dashboard
              #Postando em modo local ########################################################################################
              dados = {'epc':epc}
              texto = None
              try:
                requisicao = requests.get(url_dashboard,dados)
                #para POST mudar .get para .post
                texto = str(requisicao)
                print(texto[11:14])
              except Exception as e:
                print("Requisicao deu erro:", e)
              #Agora publico para limpar dashboard com saidas maiores q 3h ou quem saiu a 10 min
              #Postando em modo local ########################################################################################
              dados = {'epc':epc}
              texto = None
              try:
                requisicao = requests.get(url_dashboard2,dados)
                #para POST mudar .get para .post
                texto = str(requisicao)
                print(texto[11:14])
              except Exception as e:
                print("Requisicao deu erro:", e)
              ultima_epc_442002 = epc
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