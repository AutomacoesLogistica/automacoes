import serial
import requests
import time
import RPi.GPIO as GPIO
from time import gmtime, strftime
from threading import Thread
import mysql.connector
import random


global ciclo
global ativa_sinaleiro
global ativa_led_ant0
global ativa_led_ant1
global ativa_erro_cavalo
global ativa_erro_carreta
global n_leitura
ciclo = 0
ativa_sinaleiro = 0
ativa_led_ant0 = 0
ativa_led_ant1 = 1
ativa_erro_carreta = 0
ativa_erro_cavalo = 0



#dados de memoria temporaria
global ultima_epc_cavalo
global ultima_epc_carreta


#comunicacaoSerial = serial.Serial('/dev/ttyUSB0', 115200)
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



GPIO.setmode(GPIO.BCM);
GPIO.setwarnings(False);
LED_rodando = 12; # Led de Status Rodando
LED_saida_ANT0 = 6;
LED_saida_ANT1 = 5;
Saida_Rele_Pulso_Sinaleiro = 19;
Saida_Rele_Pulso_Cancela = 26;
Entrada_Pulso_Reader = 20;
LED_Saida_Pulso_Reader = 21;

# Saidas
GPIO.setup(LED_rodando, GPIO.OUT);
GPIO.setup(LED_saida_ANT0, GPIO.OUT);
GPIO.setup(LED_saida_ANT1, GPIO.OUT);
GPIO.setup(Saida_Rele_Pulso_Sinaleiro, GPIO.OUT);
GPIO.setup(Saida_Rele_Pulso_Cancela, GPIO.OUT);
GPIO.setup(LED_Saida_Pulso_Reader, GPIO.OUT);

# Entradas
GPIO.setup(Entrada_Pulso_Reader, GPIO.IN, pull_up_down = GPIO.PUD_DOWN)


GPIO.output(LED_rodando,GPIO.LOW); # Inicia desligado o led rodando
GPIO.output(LED_saida_ANT0,GPIO.LOW); # Inicia desligado o led da saida 1
GPIO.output(LED_saida_ANT1,GPIO.LOW); # Inicia desligado o led da saida 2
GPIO.output(Saida_Rele_Pulso_Sinaleiro,GPIO.HIGH); # Inicia desligado a saida 1 - Rele atua com LOW
GPIO.output(Saida_Rele_Pulso_Cancela,GPIO.HIGH); # Inicia desligado a saida 2 - Rele atua com LOW
GPIO.output(LED_Saida_Pulso_Reader,GPIO.HIGH); # Inicia desligado

class Classe_Salvar_no_banco_erro_cavalo:
    def __init__(self):
        self._running = True

    def terminate(self):
        self._running = False

    def run(self):
        global ultima_epc_cavalo
        global ativa_erro_cavalo
        while self._running:
            if ( ativa_erro_cavalo == 1 ):
                #Realiza o acionamento do sinaleiro offline
                print("Entrou para salvar que faltou cavalo!")
                print(ultima_epc_cavalo)
                ativa_erro_cavalo = 0
                #Pego a hora atual
                data_completa = (strftime("%d/%m/%Y %H:%M:%S", gmtime()))
                data =str(data_completa)
                dia_agora_cavalo = data[0:2]
                mes_agora_cavalo = data[3:5]
                ano_agora_cavalo = data[6:10]
                data_leitura = dia_agora_cavalo+"/"+mes_agora_cavalo+"/"+ano_agora_cavalo
                hora_agora_cavalo = str(int(data[10:13])-3)
                minuto_agora_cavalo = (data[14:16])
                segundo_agora_cavalo = (data[17:19])
                if(len(hora_agora_cavalo)==1):
                    hora_agora_cavalo = "0"+hora_agora_cavalo
                hora_leitura = hora_agora_cavalo+":"+minuto_agora_cavalo+":"+segundo_agora_cavalo

                try:
                    # Agora salvo na tabela de historico de leituras *******************************************
                    mydb = mysql.connector.connect(
                    host="192.168.10.35",
                    user="admin",
                    password="logistica2019@@",
                    database="bd_poste_balanca1"
                    )
                    mycursor = mydb.cursor()
                    sql = "INSERT INTO alerta_tags(epc, faltou, data_leitura, hora_leitura) VALUES (%s, %s, %s, %s)"
                    msg = (ultima_epc_cavalo,"Faltando TAG do cavalo",data_leitura, hora_leitura,);
                    mycursor.execute(sql,msg);
                    mydb.commit()
                except Exception as e:
                    print("Requisicao deu erro:", e)
                #*******************************************************************************************


class Classe_Salvar_no_banco_erro_carreta:
    def __init__(self):
        self._running = True

    def terminate(self):
        self._running = False

    def run(self):
        global ultima_epc_carreta
        global ativa_erro_carreta
        while self._running:
            if ( ativa_erro_carreta == 1 ):
                #Realiza o acionamento do sinaleiro offline
                print("Entrou para salvar que faltou carreta!")
                print(ultima_epc_carreta)
                ativa_erro_carreta = 0
                #Pego a hora atual
                data_completa = (strftime("%d/%m/%Y %H:%M:%S", gmtime()))
                data =str(data_completa)
                dia_agora_carreta = data[0:2]
                mes_agora_carreta = data[3:5]
                ano_agora_carreta = data[6:10]
                data_leitura = dia_agora_carreta+"/"+mes_agora_carreta+"/"+ano_agora_carreta
                hora_agora_carreta = str(int(data[10:13])-3)
                minuto_agora_carreta = (data[14:16])
                segundo_agora_carreta = (data[17:19])
                if(len(hora_agora_carreta)==1):
                    hora_agora_carreta = "0"+hora_agora_carreta
                hora_leitura = hora_agora_carreta+":"+minuto_agora_carreta+":"+segundo_agora_carreta

                try:
                    # Agora salvo na tabela de historico de leituras *******************************************
                    mydb = mysql.connector.connect(
                    host="192.168.10.35",
                    user="admin",
                    password="logistica2019@@",
                    database="bd_poste_balanca1"
                    )
                    mycursor = mydb.cursor()
                    sql = "INSERT INTO alerta_tags(epc, faltou, data_leitura, hora_leitura) VALUES (%s, %s, %s, %s)"
                    msg = (ultima_epc_cavalo,"Faltando TAG do cavalo",data_leitura, hora_leitura,);
                    mycursor.execute(sql,msg);
                    mydb.commit()
                except Exception as e:
                    print("Requisicao deu erro:", e)
                #*******************************************************************************************


class Classe_Sinaleiro:
    def __init__(self):
        self._running = True

    def terminate(self):
        self._running = False

    def run(self):
        global ativa_sinaleiro
        while self._running:
            if ( ativa_sinaleiro == 1):
                #Realiza o acionamento do sinaleiro offline
                print('');
                print("Acionou sinaleiro!")
                GPIO.output(Saida_Rele_Pulso_Sinaleiro,GPIO.LOW);
                time.sleep(5)
                GPIO.output(Saida_Rele_Pulso_Sinaleiro,GPIO.HIGH);
                print ("Apagou sinaleiro");
                ativa_sinaleiro = 0 # para nao entrar em loop


class Classe_LED_ANT0:
    def __init__(self):
        self._running = True

    def terminate(self):
        self._running = False

    def run(self):
        global ativa_led_ant0
        while self._running:
            if ( ativa_led_ant0 == 1 ):
                #Realiza o acionamento do sinaleiro offline
                GPIO.output(LED_saida_ANT0,GPIO.HIGH);
                time.sleep(2)
                GPIO.output(LED_saida_ANT0,GPIO.LOW);
                ativa_led_ant0 = 0

class Classe_LED_ANT1:
    def __init__(self):
        self._running = True

    def terminate(self):
        self._running = False

    def run(self):
        global ativa_led_ant1
        while self._running:
            if (ativa_led_ant1 == 1 ):
                #Realiza o acionamento do sinaleiro offline
                GPIO.output(LED_saida_ANT1,GPIO.HIGH);
                time.sleep(2)
                GPIO.output(LED_saida_ANT1,GPIO.LOW);
                ativa_led_ant1 = 0


class Classe_Ler_Pulso_do_Reader:
    def __init__(self):
        self._running = True

    def terminate(self):
        self._running = False

    def run(self):
        global Ler_Cancela_1
        while self._running:
            if(GPIO.input(Entrada_Pulso_Reader) == 1):
                print('Desativado! - voltar para == 0');
                #print("Acionado pulso vindo pelo reader!");
                #GPIO.output(LED_Saida_Pulso_Reader,GPIO.HIGH);
                #time.sleep(2); # Espera 2 Segundos!
                #GPIO.output(LED_Saida_Pulso_Reader,GPIO.LOW);
				# FALTA SALVAR DENTRO DO BANCO PARA CASAR ESSA INFORMAÇÃO PARA SER O MATCH DO DIPS

class Classe_Ler_Serial:
    def __init__(self):
        self._running = True

    def terminate(self):
        self._running = False

    def run(self):
        global Ler_Banco
        global ultima_epc_cavalo
        global ultima_epc_carreta
        global n_leitura
        global leituras_0
        global leituras_1
        global leitura_geral
        global ativa_sinaleiro
        global ativa_led_ant0
        global ativa_led_ant1
        global ativa_erro_carreta
        global ativa_erro_cavalo
        global condicao
        global data_hora
        condicao = 0
        leituras_0 = 0
        leituras_1 = 0
        leitura_geral = 0
        n_leitura = "0"
        ultima_epc_carreta = "0"
        ultima_epc_cavalo = "0"
        while self._running:
            try:
                mensagem =str(comunicacaoSerial.readline())
                if(mensagem.startswith('b')):
                    if(mensagem.endswith("'")):
                        dado = (mensagem[2:len(mensagem)-5])
                        dado = dado.split(',')
                        epc = (dado[0])
                        epc = epc.split('=')
                        epc = epc[1]
                        tamanho = len(epc)
                        tag = epc[0:6]
                        antena = (dado[1])
                        antena = antena.split("=")
                        antena = antena[1]
                        if (tamanho == 24):
                            if(tag=="442001" and epc != ultima_epc_cavalo):
                                #ativa o sinaleiro
                                ativa_sinaleiro = 1
                                ultima_epc_cavalo = epc #Atualiza a tag lida para a cavalo
                                #Pego a hora atual
                                data_completa = (strftime("%d/%m/%Y %H:%M:%S", gmtime()))
                                data =str(data_completa)
                                dia_agora_cavalo = data[0:2]
                                mes_agora_cavalo = data[3:5]
                                ano_agora_cavalo = data[6:10]
                                data_cavalo = dia_agora_cavalo+"/"+mes_agora_cavalo+"/"+ano_agora_cavalo
                                hora_agora_cavalo = str(int(data[10:13])-3)
                                minuto_agora_cavalo = (data[14:16])
                                segundo_agora_cavalo = (data[17:19])
                                if(len(hora_agora_cavalo)==1):
                                    hora_agora_cavalo = "0"+hora_agora_cavalo
                                hora_leitura = hora_agora_cavalo+":"+minuto_agora_cavalo+":"+segundo_agora_cavalo
                                data_hora = data_cavalo + ' ' + hora_leitura
                                print("cavalo,"+epc+","+antena+","+data_completa)
                                if(antena=="0"):
                                    leitura_geral = leitura_geral+1
                                    leituras_0 = leituras_0+1
                                    ativa_led_ant0 = 1
                                    #Agora salvo no banco que teve leitura
                                    condicao = random.randint(5, 15)
                                    #try:
                                    #    # Agora salvo na tabela do banco bd_dashboard_dispositivos *******************************************
                                    #    mydb = mysql.connector.connect(
                                    #     host="192.168.30.124",
                                    #     user="admin",
                                    #     password="logistica2019@@",
                                    #     database="bd_dashboard_dispositivos"
                                    #    )
                                    #    mycursor = mydb.cursor()
                                    #    sql = "INSERT INTO Controle_3_01(ponto, condicao, dia,mes,ano,vdata, vhora,data_hora,epc) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)"
                                    #    msg = ("antena0",condicao,dia_agora_cavalo,mes_agora_cavalo,ano_agora_cavalo,data_cavalo, hora_leitura,data_hora,epc,);
                                    #    mycursor.execute(sql,msg);
                                    #    mydb.commit()
                                    #except Exception as e:
                                    #    print("Requisicao deu erro:", e)
                                    #*******************************************************************************************
                                    #AGORA ATUALIZO QUE A ANTENA 0 ESTA COM ERRO!
                                    #try:
                                    #    # Agora salvo na tabela local *******************************************
                                    #    mydb = mysql.connector.connect(
                                    #     host="192.168.30.124",
                                    #     user="admin",
                                    #     password="logistica2019@@",
                                    #     database="bd_dashboard"
                                    #    )
                                    #    mycursor = mydb.cursor()
                                    #    sql = "UPDATE atualizacao SET antena0 = %s WHERE ponto='Controle 3'"
                                    #    msg = ('OK',)
                                    #    mycursor.execute(sql,msg);
                                    #    mydb.commit();
                                    #except Exception as e:
                                    #    print("Requisicao deu erro:", e)                                     



                                else:
                                    leituras_1 = leituras_1 + 1
                                    leitura_geral = leitura_geral-1
                                    ativa_led_ant1 = 1
                                    #Agora salvo no banco que teve leitura
                                    condicao = random.randint(5, 15)
                                    #try:
                                    #    # Agora salvo na tabela do banco bd_dashboard_dispositivos *******************************************
                                    #    mydb = mysql.connector.connect(
                                    #     host="192.168.30.124",
                                    #     user="admin",
                                    #     password="logistica2019@@",
                                    #     database="bd_dashboard_dispositivos"
                                    #    )
                                    #    mycursor = mydb.cursor()
                                    #    sql = "INSERT INTO Controle_3_01(ponto, condicao, dia,mes,ano,vdata, vhora,data_hora, epc) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)"
                                    #    msg = ("antena1",condicao,dia_agora_cavalo,mes_agora_cavalo,ano_agora_cavalo,data_cavalo, hora_leitura,data_hora,epc,);
                                    #    mycursor.execute(sql,msg);
                                    #    mydb.commit()
                                    #except Exception as e:
                                    #    print("Requisicao deu erro:", e)
                                    #*******************************************************************************************
                                    #AGORA ATUALIZO QUE A ANTENA 0 ESTA COM ERRO!
                                    #try:
                                    #    # Agora salvo na tabela local *******************************************
                                    #    mydb = mysql.connector.connect(
                                    #     host="192.168.30.124",
                                    #     user="admin",
                                    #     password="logistica2019@@",
                                    #     database="bd_dashboard"
                                    #    )
                                    #    mycursor = mydb.cursor()
                                    #    sql = "UPDATE atualizacao SET antena1 = %s WHERE ponto='Controle 3'"
                                    #    msg = ('OK',)
                                    #    mycursor.execute(sql,msg);
                                    #    mydb.commit();
                                    #except Exception as e:
                                    #    print("Requisicao deu erro:", e)                                     

                                #FALTA SALVAR NO BANCO
                                #FALTA SALVAR NO BANCO
                                try:
                                    # Agora salvo na tabela de historico de leituras *******************************************
                                    mydb = mysql.connector.connect(
                                    host="192.168.10.35",
                                    user="admin",
                                    password="logistica2019@@",
                                    database="bd_poste_balanca1"
                                    )
                                    mycursor = mydb.cursor()
                                    sql = "INSERT INTO historico_leituras (tipo, epc,data_leitura, hora_leitura,antena,tratado) VALUES (%s, %s, %s, %s, %s, %s)"
                                    msg = ("cavalo",epc, data_cavalo, hora_leitura, antena,'nao',);
                                    mycursor.execute(sql,msg);
                                    mydb.commit()
                                except Exception as e:
                                    print("Requisicao deu erro:", e)
                                #Chamo para verificar a condicao
                                url_local2 = 'http://192.168.10.35/automacoes/verifica_condicao.php'
                                dados = {'epc': epc}
                                texto = None
                                try:
                                    requisicao = requests.get(url_local2,dados)
                                    texto = str(requisicao)
                                    print(texto[11:14])
                                except Exception as e:
                                    print("Requisicao deu erro:", e)
                                #*******************************************************************************************
                                #trato se esta em condicao correta na sequencia da leitura
                                if ( n_leitura == "0" ):

                                    #Condicao correta!
                                    n_leitura = "1"
                                elif ( n_leitura =="1"):
                                    #Salvo o valor da ultima_epc_carreta no banco para tratar!
                                    ativa_erro_carreta = 1 # ativa para publicar erro de tag!
                                    #print("Faltou tag carreta!")
                                    n_leitura = "1"

                            elif(tag=="442002" and epc != ultima_epc_carreta):
                                #ativa o sinaleiro
                                ativa_sinaleiro = 1
                                ultima_epc_carreta = epc # Atualiza a ultima tag lida para carreta
                                #Pego a hora atual
                                data_completa = (strftime("%d/%m/%Y %H:%M:%S", gmtime()))
                                data =str(data_completa)
                                dia_agora_carreta = data[0:2]
                                mes_agora_carreta = data[3:5]
                                ano_agora_carreta = data[6:10]
                                data_carreta = dia_agora_carreta+"/"+mes_agora_carreta+"/"+ano_agora_carreta
                                hora_agora_carreta = str(int(data[10:13])-3)
                                minuto_agora_carreta = (data[14:16])
                                segundo_agora_carreta = (data[17:19])
                                if(len(hora_agora_carreta)==1):
                                    hora_agora_carreta = "0"+hora_agora_carreta
                                hora_leitura = hora_agora_carreta+":"+minuto_agora_carreta+":"+segundo_agora_carreta
                                data_hora = data_carreta + ' ' + hora_leitura
                                print("carreta,"+epc+","+antena+","+data_completa)
                                if(antena=="0"):
                                    leitura_geral = leitura_geral+1
                                    leituras_0 = leituras_0+1
                                    ativa_led_ant0 = 1
                                    #Agora salvo no banco que teve leitura
                                    condicao = random.randint(5, 15)
                                    #try:
                                    #    # Agora salvo na tabela do banco bd_dashboard_dispositivos *******************************************
                                    #    mydb = mysql.connector.connect(
                                    #     host="192.168.30.124",
                                    #     user="admin",
                                    #     password="logistica2019@@",
                                    #     database="bd_dashboard_dispositivos"
                                    #    )
                                    #    mycursor = mydb.cursor()
                                    #    sql = "INSERT INTO Controle_3_01(ponto, condicao, dia,mes,ano,vdata, vhora,data_hora, epc) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)"
                                    #    msg = ("antena0",condicao,dia_agora_carreta,mes_agora_carreta,ano_agora_carreta,data_carreta, hora_leitura,data_hora,epc,);
                                    #    mycursor.execute(sql,msg);
                                    #    mydb.commit()
                                    #except Exception as e:
                                    #    print("Requisicao deu erro:", e)
                                    #*******************************************************************************************
                                    #AGORA ATUALIZO QUE A ANTENA 0 ESTA COM ERRO!
                                    #try:
                                    #    # Agora salvo na tabela local *******************************************
                                    #    mydb = mysql.connector.connect(
                                    #     host="192.168.30.124",
                                    #     user="admin",
                                    #     password="logistica2019@@",
                                    #     database="bd_dashboard"
                                    #    )
                                    #    mycursor = mydb.cursor()
                                    #    sql = "UPDATE atualizacao SET antena0 = %s WHERE ponto='Controle 3'"
                                    #    msg = ('OK',)
                                    #    mycursor.execute(sql,msg);
                                    #    mydb.commit();
                                    #except Exception as e:
                                    #    print("Requisicao deu erro:", e)                                     

                                else:
                                    leituras_1 = leituras_1+1
                                    leitura_geral = leitura_geral-1
                                    ativa_led_ant1 = 1
                                    #Agora salvo no banco que teve leitura
                                    condicao = random.randint(5, 15)
                                    #try:
                                    #    # Agora salvo na tabela do banco bd_dashboard_dispositivos *******************************************
                                    #    mydb = mysql.connector.connect(
                                    #     host="192.168.30.124",
                                    #     user="admin",
                                    #     password="logistica2019@@",
                                    #     database="bd_dashboard_dispositivos"
                                    #    )
                                    #    mycursor = mydb.cursor()
                                    #    sql = "INSERT INTO Controle_3_01(ponto, condicao, dia,mes,ano,vdata, vhora,data_hora, epc) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)"
                                    #    msg = ("antena1",condicao,dia_agora_carreta,mes_agora_carreta,ano_agora_carreta,data_carreta, hora_leitura,data_hora,epc,);
                                    #    mycursor.execute(sql,msg);
                                    #    mydb.commit()
                                    #except Exception as e:
                                    #    print("Requisicao deu erro:", e)
                                    #*******************************************************************************************
                                    #AGORA ATUALIZO QUE A ANTENA 0 ESTA COM ERRO!
                                    #try:
                                    #    # Agora salvo na tabela local *******************************************
                                    #    mydb = mysql.connector.connect(
                                    #     host="192.168.30.124",
                                    #     user="admin",
                                    #     password="logistica2019@@",
                                    #     database="bd_dashboard"
                                    #    )
                                    #    mycursor = mydb.cursor()
                                    #    sql = "UPDATE atualizacao SET antena1 = %s WHERE ponto='Controle 3'"
                                    #    msg = ('OK',)
                                    #    mycursor.execute(sql,msg);
                                    #    mydb.commit();
                                    #except Exception as e:
                                    #    print("Requisicao deu erro:", e)                                    

                                #FALTA SALVAR NO BANCO
                                #FALTA SALVAR NO BANCO
                                try:
                                    # Agora salvo na tabela de historico de leituras *******************************************
                                    mydb = mysql.connector.connect(
                                    host="192.168.10.35",
                                    user="admin",
                                    password="logistica2019@@",
                                    database="bd_poste_balanca1"
                                    )
                                    mycursor = mydb.cursor()
                                    sql = "INSERT INTO historico_leituras (tipo, epc,data_leitura, hora_leitura,antena,tratado) VALUES (%s, %s, %s, %s, %s, %s)"
                                    msg = ("carreta",epc, data_carreta, hora_leitura, antena,'nao',);
                                    mycursor.execute(sql,msg);
                                    mydb.commit()
                                except Exception as e:
                                    print("Requisicao deu erro:", e)
                                
                                #Chamo para verificar a condicao
                                url_local2 = 'http://192.168.10.35/automacoes/verifica_condicao.php'
                                dados = {'epc': epc}
                                texto = None
                                try:
                                    requisicao = requests.get(url_local2,dados)
                                    texto = str(requisicao)
                                    print(texto[11:14])
                                except Exception as e:
                                    print("Requisicao deu erro:", e)
                                #*******************************************************************************************

                                #Agora chamo para salvar no dashboard
                                #url_local2 = 'http://192.168.10.35/dashboard/dashboard_ponto_poste_balanca1.php'
                                #dados = {'epc': epc}
                                #texto = None
                                #try:
                                #    requisicao = requests.get(url_local2,dados)
                                #    texto = str(requisicao)
                                #    print(texto[11:14])
                                #except Exception as e:
                                #    print("Requisicao deu erro:", e)
                                
                                #*******************************************************************************************
                                if ( n_leitura == "0" ):
                                    #Errado, faltou a tag do cavalo
                                    ativa_erro_cavalo = 1 # ativa para publicar erro tag!
                                    n_leitura = "0"
                                    #print("Faltou tag cavalo!")
                                elif ( n_leitura =="1"):
                                    #Condicao correta!
                                    n_leitura = "0"
                                    #Salvar o match
                                    try:
                                        # Agora salvo na tabela de historico de leituras *******************************************
                                        mydb = mysql.connector.connect(
                                        host="192.168.10.35",
                                        user="admin",
                                        password="logistica2019@@",
                                        database="bd_poste_balanca1"
                                        )
                                        mycursor = mydb.cursor()
                                        sql = "INSERT INTO historico_match (epc_cavalo,placa_cavalo,epc_carreta,placa_carreta,tratado) VALUES (%s, %s, %s, %s, %s)"
                                        msg = (ultima_epc_cavalo,"-",ultima_epc_carreta,"-","nao",);
                                        mycursor.execute(sql,msg);
                                        mydb.commit()
                                    except Exception as e:
                                        print("Requisicao deu erro:", e)
                                    #*******************************************************************************************
                                    #Chamo para atualizar e buscar as placas
                                    url_local = 'http://192.168.10.35/dashboard/validacao_match.php'
                                    dados = {'rodar':'rodar'}
                                    texto = None
                                    try:
                                        requisicao = requests.get(url_local,dados)
                                        texto = str(requisicao)
                                        print(texto[11:14])
                                    except Exception as e:
                                        print("Requisicao deu erro:", e)


                                    #*******************************************************************************************
                                    #Chamo para atualizar horas e remover do grafico quem esta a muito tempo
                                    #url_local2 = 'http://192.168.10.35/dashboard/verifica_tempo.php'
                                    #dados = {'rodar':'rodar'}
                                    #texto = None
                                    #try:
                                    #    requisicao = requests.get(url_local2,dados)
                                    #    texto = str(requisicao)
                                    #    print(texto[11:14])
                                    #except Exception as e:
                                    #    print("Requisicao deu erro:", e)

                                    #Chamo para atualizar a planilha atualizacao
                                    
                                    #url_local2 = 'http://192.168.30.124/dips/verifica_dispositivos.php'
                                    #dados = {'rodar':'rodar'}
                                    #texto = None
                                    #try:
                                    #    requisicao = requests.get(url_local2,dados)
                                    #    texto = str(requisicao)
                                    #    print(texto[11:14])
                                    #except Exception as e:
                                    #    print("Requisicao deu erro:", e)

                            #agora verifica a condicao das antenas
                            if (leitura_geral >10 or leitura_geral< -10):
                                leitura_geral = 0
                                #print("Erro em alguma antena, agora precisa tratar
                                if(leituras_0 == 0):
                                    leituras_0 = 0
                                    leituras_1 = 0
                                    #Pego a hora atual
                                    data_completa = (strftime("%d/%m/%Y %H:%M:%S", gmtime()))
                                    data =str(data_completa)
                                    dia_agora_cavalo = data[0:2]
                                    mes_agora_cavalo = data[3:5]
                                    ano_agora_cavalo = data[6:10]
                                    data_leitura = dia_agora_cavalo+"/"+mes_agora_cavalo+"/"+ano_agora_cavalo
                                    hora_agora_cavalo = str(int(data[10:13])-3)
                                    minuto_agora_cavalo = (data[14:16])
                                    segundo_agora_cavalo = (data[17:19])
                                    if(len(hora_agora_cavalo)==1):
                                        hora_agora_cavalo = "0"+hora_agora_cavalo
                                    hora_leitura = hora_agora_cavalo+":"+minuto_agora_cavalo+":"+segundo_agora_cavalo

                                    
                                    try:
                                        #Erro na antena zero
                                        # Agora salvo na tabela de historico de leituras *******************************************
                                        mydb = mysql.connector.connect(
                                        host="192.168.10.35",
                                        user="admin",
                                        password="logistica2019@@",
                                        database="bd_poste_balanca1"
                                        )
                                        mycursor = mydb.cursor()
                                        sql = "INSERT INTO alerta_antenas(antena,local,tratado, data_leitura, hora_leitura) VALUES (%s, %s, %s, %s, %s)"
                                        msg = ("0","Automacoes Saida Balanca 1","nao",data_leitura, hora_leitura,);
                                        mycursor.execute(sql,msg);
                                        mydb.commit()
                                    except Exception as e:
                                        print("Requisicao deu erro:", e)
                                    #*******************************************************************************************
                                    #AGORA ATUALIZO QUE A ANTENA 0 ESTA COM ERRO!
                                    #try:
                                    #    # Agora salvo na tabela local *******************************************
                                    #    mydb = mysql.connector.connect(
                                    #     host="192.168.30.124",
                                    #     user="admin",
                                    #     password="logistica2019@@",
                                    #     database="bd_dashboard"
                                    #    )
                                    #    mycursor = mydb.cursor()
                                    #    sql = "UPDATE atualizacao SET antena0 = %s WHERE ponto='Controle 3'"
                                    #    msg = ('Erro',)
                                    #    mycursor.execute(sql,msg);
                                    #    mydb.commit();
                                    #except Exception as e:
                                    #    print("Requisicao deu erro:", e)                                      
                                    #FALTA SALVAR NO BANCO!
                                elif(leituras_1 == 0):
                                    leituras_0 = 0
                                    leituras_1 = 0
                                    #Pego a hora atual
                                    data_completa = (strftime("%d/%m/%Y %H:%M:%S", gmtime()))
                                    data =str(data_completa)
                                    dia_agora_cavalo = data[0:2]
                                    mes_agora_cavalo = data[3:5]
                                    ano_agora_cavalo = data[6:10]
                                    data_leitura = dia_agora_cavalo+"/"+mes_agora_cavalo+"/"+ano_agora_cavalo
                                    hora_agora_cavalo = str(int(data[10:13])-3)
                                    minuto_agora_cavalo = (data[14:16])
                                    segundo_agora_cavalo = (data[17:19])
                                    if(len(hora_agora_cavalo)==1):
                                        hora_agora_cavalo = "0"+hora_agora_cavalo
                                    hora_leitura = hora_agora_cavalo+":"+minuto_agora_cavalo+":"+segundo_agora_cavalo
                                    try:
                                        #Erro na antena 1
                                        # Agora salvo na tabela de historico de leituras *******************************************
                                        mydb = mysql.connector.connect(
                                        host="192.168.10.35",
                                        user="admin",
                                        password="logistica2019@@",
                                        database="bd_poste_balanca1"
                                        )
                                        mycursor = mydb.cursor()
                                        sql = "INSERT INTO alerta_antenas(antena,local,tratado, data_leitura, hora_leitura) VALUES (%s, %s, %s, %s, %s)"
                                        msg = ("1","Automacoes Saida Balanca 1","nao", data_leitura, hora_leitura,);
                                        mycursor.execute(sql,msg);
                                        mydb.commit()
                                    except Exception as e:
                                        print("Requisicao deu erro:", e)
                                    #*******************************************************************************************
                                    #AGORA ATUALIZO QUE A ANTENA 0 ESTA COM ERRO!
                                    #try:
                                    #    # Agora salvo na tabela local *******************************************
                                    #    mydb = mysql.connector.connect(
                                    #     host="192.168.30.124",
                                    #     user="admin",
                                    #     password="logistica2019@@",
                                    #     database="bd_dashboard"
                                    #    )
                                    #    mycursor = mydb.cursor()
                                    #    sql = "UPDATE atualizacao SET antena1 = %s WHERE ponto='Controle 3'"
                                    #    msg = ('Erro',)
                                    #    mycursor.execute(sql,msg);
                                    #    mydb.commit();
                                    #except Exception as e:
                                    #    print("Requisicao deu erro:", e)                                    
                        epc = "xx"
                        antena = "xx"
            except Exception as e:
                print(e)            
        #Fecha While



#Criando a classe
OneSecond = Classe_Ler_Serial()
OneSecondThread = Thread(target=OneSecond.run)
OneSecondThread.start()

Thread_sinaleiro = Classe_Sinaleiro()
ExecutarThread_sinaleiro = Thread(target=Thread_sinaleiro.run)
ExecutarThread_sinaleiro.start()

Thread_erro_cavalo = Classe_Salvar_no_banco_erro_cavalo()
ExecutarThread_erro_cavalo = Thread(target=Thread_erro_cavalo.run)
ExecutarThread_erro_cavalo.start()

Thread_erro_carreta = Classe_Salvar_no_banco_erro_carreta()
ExecutarThread_erro_carreta = Thread(target=Thread_erro_carreta.run)
ExecutarThread_erro_carreta.start()

#Criando a classe
FiveSecond = Classe_Ler_Pulso_do_Reader()
FiveSecondThread = Thread(target=FiveSecond.run)
FiveSecondThread.start()



Thred_ant0 = Classe_LED_ANT0()
ExecutarThread_led_ant0 = Thread(target=Thred_ant0.run)
ExecutarThread_led_ant0.start()

Thred_ant1 = Classe_LED_ANT1()
ExecutarThread_led_ant1 = Thread(target=Thred_ant1.run)
ExecutarThread_led_ant1.start()


Exit = False #Flag para saida





while Exit==False:
 ciclo = ciclo + 1
 #print("Rodando  - ", ciclo)
 time.sleep(1) # 1 segundo de delay para codigo principal
 if(ciclo ==2): GPIO.output(LED_rodando,GPIO.HIGH);
 if(ciclo ==4):
    GPIO.output(LED_rodando,GPIO.LOW);
    ciclo = 0;
    #Pego a hora atual
    data_completa = (strftime("%d/%m/%Y %H:%M:%S", gmtime()));
    data =str(data_completa);
    dia_agora = data[0:2];
    mes_agora = data[3:5];
    ano_agora = data[6:10];
    data_atualizacao = dia_agora+"/"+mes_agora+"/"+ano_agora;
    hora_agora = str(int(data[10:13])-3);
    if(len(str(hora_agora))<2):
        hora_agora = '0'+ str(hora_agora);
    minuto_agora = (data[14:16]);
    segundo_agora = (data[17:19]);
    hora_atualizacao = hora_agora+':'+minuto_agora+':'+segundo_agora;
    try:
        # Agora salvo na tabela local *******************************************
        mydb = mysql.connector.connect(
        host="192.168.10.35",
        user="admin",
        password="logistica2019@@",
        database="bd_poste_balanca1"
        )
        mycursor = mydb.cursor()
        sql = "UPDATE atualizacao SET data_atualizacao = %s, hora_atualizacao = %s WHERE id='1'"
        msg = (data_atualizacao, hora_atualizacao,)
        mycursor.execute(sql,msg);
        mydb.commit();
    except Exception as e:
        print("Requisicao deu erro:", e)
    
    #try:
    #    # Agora salvo na tabela geral *******************************************
    #    mydb = mysql.connector.connect(
    #    host="192.168.30.124",
    #    user="admin",
    #    password="logistica2019@@",
    #    database="bd_dashboard"
    #    )
    #    mycursor = mydb.cursor()
    #    sql = "UPDATE atualizacao SET data_atualizacao = %s, hora_atualizacao = %s WHERE ponto='Controle 3'"
    #    msg = (data_atualizacao, hora_atualizacao,)
    #    mycursor.execute(sql,msg);
    #    mydb.commit();
    #except Exception as e:
    #    print("Requisicao deu erro:", e)
    #Chamo para atualizar a planilha atualizacao
    #url_verifica_dispositivo = 'http://192.168.30.124/dips/verifica_dispositivos.php'
    #dados = {'rodar':'rodar'}
    #texto = None
    #try:
    #    requisicao = requests.get(url_verifica_dispositivo,dados)
    #    texto = str(requisicao)
    #    print(texto[11:14] + ' - Atualizado dispositivos!')
    #except Exception as e:
    #    print("Requisicao deu erro:", e)
    #print('Atualizou!');
    #print(data_atualizacao + ' ' + hora_atualizacao);
    
    
 if (ciclo > 1000): Exit = True #Sai do programa

OneSecond.terminate() # Finaliza a tread
TwoSecond.terminate() # Finaliza a tread
ThreeSecond.terminate() # Finaliza a tread
FiveSecond.terminate() # Finaliza a tread
Thread_sinaleiro.terminate()

print("Finalizando!")
