import serial
import requests
import mysql.connector
import time
from time import gmtime, strftime


url_local = 'http://192.168.20.66/AutomacaoGerdau/monitor_rom.php'

comunicacaoSerial =serial.Serial(
        port='/dev/ttyUSB0',
        baudrate=115200,
        parity=serial.PARITY_NONE,
        stopbits=serial.STOPBITS_ONE,
        bytesize=serial.EIGHTBITS,
        timeout=1

    )

mydb = mysql.connector.connect(
    host="192.168.20.66",#nao mudar para localhost
    user="admin",
    password="logistica2019@@",
    database="bd_display_mb"
)



def publicar(id,msg):
  dados = {'mensagem': msg,'id': id}
  comunicacaoSerial.write(b'ola')
  #print(dados)
  #Postando em modo local
  try:
    requisicao = requests.get(url_local,dados)
  except Exception as e:
    print("Requisicao deu erro:", e)


while(1):
    mensagem = str(comunicacaoSerial.readline())
    if (len(mensagem)>3):
      if(mensagem.startswith('b')):
        if(mensagem.endswith("'")):
          dado = (mensagem[2:len(mensagem)-5]) #-1
          #print(dado)
          #Trata o erro vindo da placa lora e posta para avisar erro no GSCS - Acendeu semaforo vermelho!
          if (dado == "04_msg_GSCS"):
            id = (mensagem[2:4])
            msg = (mensagem[9:len(mensagem)-5])
            publicar(id,msg)


    #BUSCA SE EXISTE ACIONAMENTOS PARA SEREM REALIZADOS
    mycursor = mydb.cursor()
    mycursor.execute("SELECT * FROM acionamentos_cancelas_rom ORDER BY id ASC")
    y = 0
    myresult = mycursor.fetchall()
    for x in myresult:
      y=y+1
      if(y==1):
        id_tabela = x[0]
        cod_lora = x[1]
        comando = x[2]
        #Manda na serial para o esp LoRa enviar o comando!
        valor = x[1]+"_"+x[2]

        for x in range(5):
            comunicacaoSerial.write(str(valor).encode('ascii'))
            time.sleep(0.1)
        #Insere na tabela acionamentos efetuados
        #BUSCA HORA E TRATA PARA SALVAR
        data_completa = (strftime("%d/%m/%Y %H:%M:%S", gmtime()))
        data =str(data_completa)
        hora = str(int(data[10:13])-3)
        minuto = (data[14:16])
        segundo = (data[17:19])
        data_completa = data[0:10]
        hora_completa = hora+":"+minuto+":"+segundo
        mycursor = mydb.cursor()
        sql = "INSERT INTO acionamentos_efetuados (codigo_lora,comando,data,hora) VALUES (%s, %s, %s, %s)"
        val = (cod_lora,comando,data_completa,hora_completa)
        mycursor.execute(sql, val)
        mydb.commit()

        #Agora apaga a linnha
        mycursor = mydb.cursor()
        sql = "DELETE FROM acionamentos_cancelas_rom WHERE id = %s" %id_tabela
        mycursor.execute(sql)
        mydb.commit()

    if y<=0:
      comunicacaoSerial.write(b'sem_requisicoes')
    mydb.commit()