import serial
import requests

url_local = 'http://localhost/AutomacaoGerdau/monitor_rom.php'


comunicacaoSerial =serial.Serial(
        port='/dev/ttyUSB2',
        baudrate=115200,
        parity=serial.PARITY_NONE,
        stopbits=serial.STOPBITS_ONE,
        bytesize=serial.EIGHTBITS,
        timeout=1

    )



def publicar(id,msg):
  dados = {'mensagem': msg,'id': id}
  print(dados)
  #Postando em modo local
  try:
    requisicao = requests.get(url_local,dados)
  except Exception as e:
    print("Requisicao deu erro:", e)



print(comunicacaoSerial.isOpen())
while True:
  mensagem = str(comunicacaoSerial.readline())
  if (len(mensagem)>3):
    if(mensagem.startswith('b')):
      if(mensagem.endswith("'")):
        dado = (mensagem[2:len(mensagem)-5]) #-1
        print(dado)
        if(dado == "04_msg_sva=ok"):
          #print("validou SVA")
          id = (mensagem[2:4])
          msg = (mensagem[9:len(mensagem)-5])# -1
          publicar(id,msg)
        elif (dado == "04_msg_sva=nao,gscs=ok"):
          #print("validou GSCS mas SVA nao")
          id = (mensagem[2:4])
          msg = (mensagem[9:len(mensagem)-5])
          publicar(id,msg)
        elif (dado == "04_msg_esgotou"):
          #print("Esgotou tempo e validou apenas SVA")
          id = (mensagem[2:4])
          msg = (mensagem[9:len(mensagem)-5])
          publicar(id,msg)
        elif (dado == "04_msg_abrir"):
          #print("Validou SVA e GSCS, agora verifica se pode abrir")
          id = (mensagem[2:4])
          msg = (mensagem[9:len(mensagem)-5])
          publicar(id,msg)
        elif (dado == "04_msg_abrir1"):
          #print("Validou SVA com byPASS e GSCS, agora verifica se pode abrir")
          id = (mensagem[2:4])
          msg = (mensagem[9:len(mensagem)-5])
          publicar(id,msg)
        elif (dado == "04_msg_abrir2"):
          #print("Validou GSCS com byPASS e SVA, agora verifica se pode abrir")
          id = (mensagem[2:4])
          msg = (mensagem[9:len(mensagem)-5])
          publicar(id,msg)
        elif (dado == "04_msg_vmcnas"):
          #print("Validou os dois, porem o caminhão não esta na frente do sensor")
          id = (mensagem[2:4])
          msg = (mensagem[9:len(mensagem)-5])
          publicar(id,msg)
        elif (dado == "04_msg_limpar"):
          #print("Limpando a tela")
          id = (mensagem[2:4])
          msg = (mensagem[9:len(mensagem)-5])
          publicar(id,msg)
        elif (dado == "04_msg_normalizou"):
          #print("Normalizou")
          id = (mensagem[2:4])
          msg = (mensagem[9:len(mensagem)-5])
          publicar(id,msg)

        #OUTRA PLACA, A QUE RECEBE PULSO SAIDA OU SAIDA ALT.
        elif (dado == "05_msg_saida"):
          time.sleep(3)
          #print("Saiu um na saida normal")
          id = (mensagem[2:4])
          msg = (mensagem[9:len(mensagem)-5])
          publicar(id,msg)
        elif (dado == "06_msg_saida"):
          time.sleep(3)
          #print("Saiu um na saida alternativa")
          id = (mensagem[2:4])
          msg = (mensagem[9:len(mensagem)-5])
          publicar(id,msg)

        #OUTRA PLACA, A QUE TRATA ERRO GSCS SEMAROFO VERMELHO
        elif (dado == "04_msg_GSCS"):
          #print("Ja aciona erro pois tem problema no GSCS")
          id = (mensagem[2:4])
          msg = (mensagem[9:len(mensagem)-5])
          publicar(id,msg)