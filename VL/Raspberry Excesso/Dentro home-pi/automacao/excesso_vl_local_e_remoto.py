import serial
import requests
import time
from time import gmtime, strftime
import numpy as np
import mysql.connector
global ciclo

def main():
    url_remota = 'http://192.168.30.124/gagf/salvar_leituras_execesso_vl.php'
    url_local = 'http://localhost/gagf/salvar_leituras_execesso_vl.php'
    url_dashboard = 'http://localhost/gagf/dashboard_ponto_excesso.php'

    ultima_epc_442001 = "999"
    ultima_epc_442002 = "999"
    tipo = "nada"
    ciclo = 0

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
              #Postando em modo remoto ( K-HOUSE ) ###########################################################################
              texto = None
              try:
                requisicao = requests.get(url_remota,dados)
                #para POST mudar .get para .post
                texto = str(requisicao)
                print(texto[11:14])
              except Exception as e:
                print("Requisicao deu erro:", e)
              
              #Postando em modo local ########################################################################################
              texto = None
              try:
                requisicao = requests.get(url_local,dados)
                #para POST mudar .get para .post
                texto = str(requisicao)
                print(texto[11:14])
              except Exception as e:
                print("Requisicao deu erro:", e)
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
              ultima_epc_442002 = epc
      except Exception as e:
        print(e)
        main()
      #Agora atualizo dada e hora no banco
      if(ciclo == 0):
        #Pego a hora atual
        try:
          data_completa = (strftime("%d/%m/%Y %H:%M:%S", gmtime()));
          data =str(data_completa);
          dia_agora = data[0:2];
          mes_agora = data[3:5];
          ano_agora = data[6:10];
          data_atualizacao = dia_agora+"/"+mes_agora+"/"+ano_agora;
          hora_agora = str(int(data[10:13])-3);
          print (data_completa) 
          if(hora_agora==-3):
            hora_agora = '21'
          elif(hora_agora==-2):
            hora_agora = '22'
          elif (hora_agora == -1):
            hora_agora = '23'
          elif (hora_agora == 0):
            hora_agora = '00'
          if(len(str(hora_agora))<2):
            hora_agora = '0'+ str(hora_agora);
          minuto_agora = (data[14:16]);
          segundo_agora = (data[17:19]);
          
          #print('Hora_agora = '+ hora_agora)
          #print('Minuto_agora = '+ minuto_agora)
          #print('Segundo_agora = '+ segundo_agora)
          hora_atualizacao = hora_agora+':'+minuto_agora+':'+segundo_agora;
          # Agora salvo na tabela local *******************************************
          mydb = mysql.connector.connect(
           host="192.168.30.124",
           user="admin",
           password="logistica2019@@",
           database="bd_dashboard"
          )
          mycursor = mydb.cursor()
          sql = "UPDATE atualizacao SET data_atualizacao = %s, hora_atualizacao = %s WHERE ponto='Excesso'"
          msg = (data_atualizacao, hora_atualizacao,)
          mycursor.execute(sql,msg);
          mydb.commit();
        except Exception as e:
          print("Requisicao deu erro:", e)
        
      if(ciclo ==5):
        ciclo = -5
      ciclo = ciclo + 1
          
      
###########################


for i in range(1, 1000000000):
  try:
    main()
  except Exception as e:
    print(e)
    print("Restarting!")
    main()