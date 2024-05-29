import serial
import requests
import time
import RPi.GPIO as GPIO
from time import gmtime, strftime
from threading import Thread
import mysql.connector
import random


global ciclo
global ativa_sinaleiro_balanca
global ativa_sinaleiro_mg
global ativa_led_ant0
global ativa_led_ant1
global ativa_led_ant2
global ativa_led_ant3
global ativa_erro_cavalo_balanca
global ativa_erro_carreta_balanca
global ativa_erro_cavalo_mg
global ativa_erro_carreta_mg
global n_leitura_balanca
global n_leitura_mg
ciclo = 0
ativa_sinaleiro_balanca = 0
ativa_sinaleiro_mg = 0
ativa_led_ant0 = 0
ativa_led_ant1 = 0
ativa_led_ant2 = 0
ativa_led_ant3 = 0
ativa_erro_carreta_balanca = 0
ativa_erro_cavalo_balanca = 0
ativa_erro_carreta_mg = 0
ativa_erro_cavalo_mg = 0


#dados de memoria temporaria
global ultima_epc_cavalo_balanca
global ultima_epc_carreta_balanca
global ultima_epc_cavalo_mg
global ultima_epc_carreta_mg

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






class Classe_Salvar_no_banco_erro_cavalo_balanca:
    def __init__(self):
        self._running = True

    def terminate(self):
        self._running = False

    def run(self):
        global ultima_epc_cavalo_balanca
        global ativa_erro_cavalo_balanca
        while self._running:
            if ( ativa_erro_cavalo_balanca == 1 ):
                #Realiza o acionamento do sinaleiro offline
                print("Entrou para salvar que faltou cavalo Balanca!")
                print(ultima_epc_cavalo_balanca)
                ativa_erro_cavalo_balanca = 0
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

                #try:
                #    # Agora salvo na tabela de historico de leituras *******************************************
                #    mydb = mysql.connector.connect(
                #    host="192.168.10.102",
                #    user="admin",
                #    password="logistica2019@@",
                #    database="bd_balanca1"
                #    )
                    #mycursor = mydb.cursor()
                    #sql = "INSERT INTO alerta_tags(epc, faltou, data_leitura, hora_leitura) VALUES (%s, %s, %s, %s)"
                    #msg = (ultima_epc_cavalo_balanca,"Faltando TAG do cavalo Balanca",data_leitura, hora_leitura,);
                    #mycursor.execute(sql,msg);
                    #mydb.commit()
                #except Exception as e:
                #    print("Requisicao deu erro:", e)
                #*******************************************************************************************


class Classe_Salvar_no_banco_erro_cavalo_mg:
    def __init__(self):
        self._running = True

    def terminate(self):
        self._running = False

    def run(self):
        global ultima_epc_cavalo_balanca
        global ativa_erro_cavalo_balanca
        while self._running:
            if ( ativa_erro_cavalo_balanca == 1 ):
                #Realiza o acionamento do sinaleiro offline
                print("Entrou para salvar que faltou cavalo MG030!")
                print(ultima_epc_cavalo_balanca)
                ativa_erro_cavalo_balanca = 0
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

                #try:
                #    # Agora salvo na tabela de historico de leituras *******************************************
                #    mydb = mysql.connector.connect(
                #    host="192.168.10.102",
                #    user="admin",
                #    password="logistica2019@@",
                #    database="bd_balanca1"
                #    )
                #    mycursor = mydb.cursor()
                #    sql = "INSERT INTO alerta_tags(epc, faltou, data_leitura, hora_leitura) VALUES (%s, %s, %s, %s)"
                #    msg = (ultima_epc_cavalo_balanca,"Faltando TAG do cavalo MG030",data_leitura, hora_leitura,);
                #    mycursor.execute(sql,msg);
                #    mydb.commit()
                #except Exception as e:
                #    print("Requisicao deu erro:", e)
                #*******************************************************************************************






class Classe_Salvar_no_banco_erro_carreta_balanca:
    def __init__(self):
        self._running = True

    def terminate(self):
        self._running = False

    def run(self):
        global ultima_epc_carreta_balanca
        global ativa_erro_carreta_balanca
        while self._running:
            if ( ativa_erro_carreta_balanca == 1 ):
                #Realiza o acionamento do sinaleiro offline
                print("Entrou para salvar que faltou carreta Balanca!")
                print(ultima_epc_carreta_balanca)
                ativa_erro_carreta_balanca = 0
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

                #try:
                #    # Agora salvo na tabela de historico de leituras *******************************************
                #    mydb = mysql.connector.connect(
                #    host="192.168.10.102",
                #    user="admin",
                #    password="logistica2019@@",
                #    database="bd_balanca1"
                #    )
                #    mycursor = mydb.cursor()
                #    sql = "INSERT INTO alerta_tags(epc, faltou, data_leitura, hora_leitura) VALUES (%s, %s, %s, %s)"
                #    msg = (ultima_epc_cavalo_balanca,"Faltando TAG do cavalo Balanca",data_leitura, hora_leitura,);
                #    mycursor.execute(sql,msg);
                #    mydb.commit()
                #except Exception as e:
                #    print("Requisicao deu erro:", e)
                #*******************************************************************************************


class Classe_Salvar_no_banco_erro_carreta_mg:
    def __init__(self):
        self._running = True

    def terminate(self):
        self._running = False

    def run(self):
        global ultima_epc_carreta_balanca
        global ativa_erro_carreta_balanca
        while self._running:
            if ( ativa_erro_carreta_balanca == 1 ):
                #Realiza o acionamento do sinaleiro offline
                print("Entrou para salvar que faltou carreta MG030!")
                print(ultima_epc_carreta_balanca)
                ativa_erro_carreta_balanca = 0
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

                #try:
                #    # Agora salvo na tabela de historico de leituras *******************************************
                #    mydb = mysql.connector.connect(
                #    host="192.168.10.102",
                #    user="admin",
                #    password="logistica2019@@",
                #    database="bd_balanca1"
                #    )
                #    mycursor = mydb.cursor()
                #    sql = "INSERT INTO alerta_tags(epc, faltou, data_leitura, hora_leitura) VALUES (%s, %s, %s, %s)"
                #    msg = (ultima_epc_cavalo_balanca,"Faltando TAG do cavalo MG030",data_leitura, hora_leitura,);
                #    mycursor.execute(sql,msg);
                #    mydb.commit()
                #except Exception as e:
                #    print("Requisicao deu erro:", e)
                #*******************************************************************************************

class Classe_Sinaleiro_balanca:
    def __init__(self):
        self._running = True

    def terminate(self):
        self._running = False

    def run(self):
        global ativa_sinaleiro_balanca
        while self._running:
            if ( ativa_sinaleiro_balanca == 1):
                #Realiza o acionamento do sinaleiro offline
                print('');
                print("Acionou sinaleiro!")
                #GPIO.output(Saida_Rele_Pulso_Sinaleiro,GPIO.LOW);
                #time.sleep(5)
                #GPIO.output(Saida_Rele_Pulso_Sinaleiro,GPIO.HIGH);
                #print ("Apagou sinaleiro");
                ativa_sinaleiro_balanca = 0 # para nao entrar em loop

class Classe_Sinaleiro_mg:
    def __init__(self):
        self._running = True

    def terminate(self):
        self._running = False

    def run(self):
        global ativa_sinaleiro_mg
        while self._running:
            if ( ativa_sinaleiro_mg == 1):
                #Realiza o acionamento do sinaleiro offline
                print('');
                print("Acionou sinaleiro!")
                #GPIO.output(Saida_Rele_Pulso_Sinaleiro,GPIO.LOW);
                #time.sleep(5)
                #GPIO.output(Saida_Rele_Pulso_Sinaleiro,GPIO.HIGH);
                print ("Apagou sinaleiro");
                ativa_sinaleiro_mg = 0 # para nao entrar em loop


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
                #GPIO.output(LED_saida_ANT0,GPIO.HIGH);
                #time.sleep(2)
                #GPIO.output(LED_saida_ANT0,GPIO.LOW);
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
                #GPIO.output(LED_saida_ANT1,GPIO.HIGH);
                #time.sleep(2)
                #GPIO.output(LED_saida_ANT1,GPIO.LOW);
                ativa_led_ant1 = 0

class Classe_LED_ANT2:
    def __init__(self):
        self._running = True

    def terminate(self):
        self._running = False

    def run(self):
        global ativa_led_ant2
        while self._running:
            if ( ativa_led_ant2 == 1 ):
                #Realiza o acionamento do sinaleiro offline
                #GPIO.output(LED_saida_ANT0,GPIO.HIGH);
                #time.sleep(2)
                #GPIO.output(LED_saida_ANT0,GPIO.LOW);
                ativa_led_ant2 = 0

class Classe_LED_ANT3:
    def __init__(self):
        self._running = True

    def terminate(self):
        self._running = False

    def run(self):
        global ativa_led_ant3
        while self._running:
            if ( ativa_led_ant3 == 1 ):
                #Realiza o acionamento do sinaleiro offline
                #GPIO.output(LED_saida_ANT0,GPIO.HIGH);
                #time.sleep(2)
                #GPIO.output(LED_saida_ANT0,GPIO.LOW);
                ativa_led_ant3 = 0




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
        global ultima_epc_cavalo_balanca
        global ultima_epc_carreta_balanca
        global ultima_epc_cavalo_mg
        global ultima_epc_carreta_mg        
        global n_leitura_balanca
        global n_leitura_mg
        global leituras_0
        global leituras_1
        global leituras_2
        global leituras_3
        global leitura_geral_balanca
        global leitura_geral_mg
        global ativa_sinaleiro_balanca
        global ativa_sinaleiro_mg
        global ativa_led_ant0
        global ativa_led_ant1
        global ativa_led_ant2
        global ativa_led_ant3
        global ativa_erro_carreta_balanca
        global ativa_erro_cavalo_balanca
        global ativa_erro_carreta_mg
        global ativa_erro_cavalo_mg
        global condicao
        global data_hora
        condicao = 0
        leituras_0 = 0
        leituras_1 = 0
        leituras_2 = 0
        leituras_3 = 0
        leitura_geral_balanca = 0
        leitura_geral_mg = 0
        n_leitura_balanca = "0"
        n_leitura_mg = "0"
        ultima_epc_carreta_balanca = "0"
        ultima_epc_cavalo_balanca = "0"
        ultima_epc_carreta_mg = "0"
        ultima_epc_cavalo_mg = "0"
        while self._running:
            try:
                mensagem =str(comunicacaoSerial.readline())
                if(mensagem.startswith('b') and len(mensagem)>30 ):
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
                            
                            
                            #TRATANDO PARA SAINDO DA BALANCA ******************************************************************************
                            #TRATANDO PARA SAINDO DA BALANCA ******************************************************************************
                            #TRATANDO PARA SAINDO DA BALANCA ******************************************************************************
                            if(antena=="0" or antena=="1"):
                                if(tag=="442001" and epc != ultima_epc_cavalo_balanca and (antena=="0" or antena=="1")):
                                    #ativa o sinaleiro
                                    ativa_sinaleiro_balanca = 1
                                    ultima_epc_cavalo_balanca = epc #Atualiza a tag lida para a cavalo
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
                                        leitura_geral_balanca = leitura_geral_balanca+1
                                        leituras_0 = leituras_0+1
                                        ativa_led_ant0 = 1
                                        #Agora salvo no banco que teve leitura
                                        condicao = random.randint(5, 15)
                                        #try:
                                        #    # Agora salvo na tabela do banco bd_dashboard_dispositivos *******************************************
                                        #    mydb = mysql.connector.connect(
                                        #     host="192.168.10.96",
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
                                        #     host="192.168.10.96",
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



                                    elif(antena=="1"):
                                        leituras_1 = leituras_1 + 1
                                        leitura_geral_balanca = leitura_geral_balanca-1
                                        ativa_led_ant1 = 1
                                        #Agora salvo no banco que teve leitura
                                        condicao = random.randint(5, 15)
                                        #try:
                                        #    # Agora salvo na tabela do banco bd_dashboard_dispositivos *******************************************
                                        #    mydb = mysql.connector.connect(
                                        #     host="192.168.10.96",
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
                                        #     host="192.168.10.96",
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
                                        host="192.168.10.102",
                                        user="admin",
                                        password="logistica2019@@",
                                        database="bd_balanca1"
                                        )
                                        mycursor = mydb.cursor()
                                        sql = "INSERT INTO historico_leituras (tipo, epc,data_leitura, hora_leitura,antena) VALUES (%s, %s, %s, %s, %s)"
                                        msg = ("cavalo",epc, data_cavalo, hora_leitura, antena,);
                                        mycursor.execute(sql,msg);
                                        mydb.commit()
                                    except Exception as e:
                                        print("Requisicao deu erro:", e)
                                    #*******************************************************************************************
                                    #trato se esta em condicao correta na sequencia da leitura
                                    if ( n_leitura_balanca == "0" ):

                                        #Condicao correta!
                                        n_leitura_balanca = "1"
                                    elif ( n_leitura_balanca =="1"):
                                        #Salvo o valor da ultima_epc_carreta_balanca no banco para tratar!
                                        ativa_erro_carreta_balanca = 1 # ativa para publicar erro de tag!
                                        #print("Faltou tag carreta!")
                                        n_leitura_balanca = "1"

                                elif(tag=="442002" and epc != ultima_epc_carreta_balanca and (antena=="0" or antena=="1")):
                                    #ativa o sinaleiro
                                    ativa_sinaleiro_balanca = 1
                                    ultima_epc_carreta_balanca = epc # Atualiza a ultima tag lida para carreta
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
                                        leitura_geral_balanca = leitura_geral_balanca+1
                                        leituras_0 = leituras_0+1
                                        ativa_led_ant0 = 1
                                        #Agora salvo no banco que teve leitura
                                        condicao = random.randint(5, 15)
                                        #try:
                                        #    # Agora salvo na tabela do banco bd_dashboard_dispositivos *******************************************
                                        #    mydb = mysql.connector.connect(
                                        #     host="192.168.10.96",
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
                                        #     host="192.168.10.96",
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

                                    elif(antena=="1"):
                                        leituras_1 = leituras_1+1
                                        leitura_geral_balanca = leitura_geral_balanca-1
                                        ativa_led_ant1 = 1
                                        #Agora salvo no banco que teve leitura
                                        condicao = random.randint(5, 15)
                                        #try:
                                        #    # Agora salvo na tabela do banco bd_dashboard_dispositivos *******************************************
                                        #    mydb = mysql.connector.connect(
                                        #     host="192.168.10.96",
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
                                        #     host="192.168.10.96",
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
                                        host="192.168.10.102",
                                        user="admin",
                                        password="logistica2019@@",
                                        database="bd_balanca1"
                                        )
                                        mycursor = mydb.cursor()
                                        sql = "INSERT INTO historico_leituras (tipo, epc,data_leitura, hora_leitura,antena) VALUES (%s, %s, %s, %s, %s)"
                                        msg = ("carreta",epc, data_carreta, hora_leitura, antena,);
                                        mycursor.execute(sql,msg);
                                        mydb.commit()
                                    except Exception as e:
                                        print("Requisicao deu erro:", e)
                                    #Agora chamo para salvar no dashboard
                                    #url_local2 = 'http://192.168.10.102/dashboard/dashboard_ponto_balanca1.php'
                                    #dados = {'epc': epc,'ponto': 'balanca'}
                                    #texto = None
                                    #try:
                                    #    requisicao = requests.get(url_local2,dados)
                                    #    texto = str(requisicao)
                                    #    print(texto[11:14])
                                    #except Exception as e:
                                    #    print("Requisicao deu erro:rrrrr", e)
                                    
                                    #*******************************************************************************************
                                    if ( n_leitura_balanca == "0" ):
                                        #Errado, faltou a tag do cavalo
                                        ativa_erro_cavalo_balanca = 1 # ativa para publicar erro tag!
                                        n_leitura_balanca = "0"
                                        #Em testes salvar mesmo que so tenha leitura cavalo
                                        #
                                        #
                                        #
                                        #
                                        if(ultima_epc_cavalo_balanca == ''):
                                            ultima_epc_cavalo_balanca = '-'
                                            
                                        try:
                                            # Agora salvo na tabela de historico de leituras *******************************************
                                            mydb = mysql.connector.connect(
                                            host="192.168.10.102",
                                            user="admin",
                                            password="logistica2019@@",
                                            database="bd_balanca1"
                                            )
                                            mycursor = mydb.cursor()
                                            sql = "INSERT INTO historico_match (epc_cavalo,placa_cavalo,epc_carreta,placa_carreta,ponto,tratado) VALUES (%s, %s, %s, %s, %s, %s)"
                                            msg = (ultima_epc_cavalo_balanca,"-",ultima_epc_carreta_balanca,"-","balanca","nao",);
                                            mycursor.execute(sql,msg);
                                            mydb.commit()
                                        except Exception as e:
                                            print("Requisicao deu erro:", e)
                                        #*******************************************************************************************
                                        #Chamo para atualizar e buscar as placas
                                        url_local = 'http://192.168.10.102/dashboard/validacao_match.php'
                                        dados = {'rodar':'balanca'}
                                        texto = None
                                        try:
                                            requisicao = requests.get(url_local,dados)
                                            texto = str(requisicao)
                                            print(texto[11:14])
                                        except Exception as e:
                                            print("Requisicao deu erro:", e)
                                        #
                                        #
                                        #



                                        #print("Faltou tag cavalo!")
                                    elif ( n_leitura_balanca =="1"):
                                        #Condicao correta!
                                        n_leitura_balanca = "0"
                                        #Salvar o match
                                        try:
                                            # Agora salvo na tabela de historico de leituras *******************************************
                                            mydb = mysql.connector.connect(
                                            host="192.168.10.102",
                                            user="admin",
                                            password="logistica2019@@",
                                            database="bd_balanca1"
                                            )
                                            mycursor = mydb.cursor()
                                            sql = "INSERT INTO historico_match (epc_cavalo,placa_cavalo,epc_carreta,placa_carreta,ponto,tratado) VALUES (%s, %s, %s, %s, %s, %s)"
                                            msg = (ultima_epc_cavalo_balanca,"-",ultima_epc_carreta_balanca,"-","balanca","nao",);
                                            mycursor.execute(sql,msg);
                                            mydb.commit()
                                        except Exception as e:
                                            print("Requisicao deu erro:", e)
                                        #*******************************************************************************************
                                        #Chamo para atualizar e buscar as placas
                                        url_local = 'http://192.168.10.102/dashboard/validacao_match.php'
                                        dados = {'rodar':'balanca'}
                                        texto = None
                                        try:
                                            requisicao = requests.get(url_local,dados)
                                            texto = str(requisicao)
                                            print(texto[11:14])
                                        except Exception as e:
                                            print("Requisicao deu erro:", e)


                                        #*******************************************************************************************
                                        #Chamo para atualizar horas e remover do grafico quem esta a muito tempo
                                        
                                        
                                        
                                        
                                        #   QUALQUER COISA VOLTAR ISSO!!!!!!!!!!!!!!!!!!!
                                        
                                        #url_local2 = 'http://192.168.10.102/dashboard/verifica_tempo.php'
                                        #dados = {'rodar':'rodar'}
                                        #texto = None
                                        #ry:
                                        #    requisicao = requests.get(url_local2,dados)
                                        #    texto = str(requisicao)
                                        #    print(texto[11:14])
                                        #except Exception as e:
                                        #    print("Requisicao deu erro:", e)

                                        #Chamo para atualizar a planilha atualizacao
                                        
                                        #url_local2 = 'http://192.168.10.96/dips/verifica_dispositivos.php'
                                        #dados = {'rodar':'rodar'}
                                        #texto = None
                                        #try:
                                        #    requisicao = requests.get(url_local2,dados)
                                        #    texto = str(requisicao)
                                        #    print(texto[11:14])
                                        #except Exception as e:
                                        #    print("Requisicao deu erro:", e)

                                #agora verifica a condicao das antenas
                                if (leitura_geral_balanca >10 or leitura_geral_balanca< -10):
                                    leitura_geral_balanca = 0
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

                                        
                                        #try:
                                        #    #Erro na antena zero
                                        #    # Agora salvo na tabela de historico de leituras *******************************************
                                        #    mydb = mysql.connector.connect(
                                        #    host="192.168.10.102",
                                        #    user="admin",
                                        #    password="logistica2019@@",
                                        #    database="bd_balanca1"
                                        #    )
                                        #    mycursor = mydb.cursor()
                                        #    sql = "INSERT INTO alerta_antenas(antena,local,tratado, data_leitura, hora_leitura) VALUES (%s, %s, %s, %s, %s)"
                                        #    msg = ("0","Saida Balanca 01","nao",data_leitura, hora_leitura,);
                                        #    mycursor.execute(sql,msg);
                                        #    mydb.commit()
                                        #except Exception as e:
                                        #    print("Requisicao deu erro:", e)
                                        #*******************************************************************************************
                                        #AGORA ATUALIZO QUE A ANTENA 0 ESTA COM ERRO!
                                        #try:
                                        #    # Agora salvo na tabela local *******************************************
                                        #    mydb = mysql.connector.connect(
                                        #     host="192.168.10.96",
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
                                        #try:
                                        #    #Erro na antena 1
                                        #    # Agora salvo na tabela de historico de leituras *******************************************
                                        #    mydb = mysql.connector.connect(
                                        #    host="192.168.10.102",
                                        #    user="admin",
                                        #    password="logistica2019@@",
                                        #    database="bd_balanca1"
                                        #    )
                                        #    mycursor = mydb.cursor()
                                        #    sql = "INSERT INTO alerta_antenas(antena,local,tratado, data_leitura, hora_leitura) VALUES (%s, %s, %s, %s, %s)"
                                        #    msg = ("1","Saida Balanca 01","nao", data_leitura, hora_leitura,);
                                        #    mycursor.execute(sql,msg);
                                        #    mydb.commit()
                                        #except Exception as e:
                                        #    print("Requisicao deu erro:", e)
                                        #*******************************************************************************************
                                        #AGORA ATUALIZO QUE A ANTENA 0 ESTA COM ERRO!
                                        #try:
                                        #    # Agora salvo na tabela local *******************************************
                                        #    mydb = mysql.connector.connect(
                                        #     host="192.168.10.96",
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
                                        # 
                            #FINALIZA TRATANDO PARA SAINDO DA BALANCA ***********************************************                                
                            #TRATANDO PARA SAINDO DA mg ******************************************************************************
                            #TRATANDO PARA SAINDO DA mg ******************************************************************************
                            #TRATANDO PARA SAINDO DA mg ******************************************************************************
                            else:
                                if(tag=="442001" and epc != ultima_epc_cavalo_mg and (antena=="2" or antena=="3")):
                                    #ativa o sinaleiro
                                    ativa_sinaleiro_mg = 1
                                    ultima_epc_cavalo_mg = epc #Atualiza a tag lida para a cavalo
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
                                    if(antena=="2"):
                                        leitura_geral_mg = leitura_geral_mg+1
                                        leituras_2 = leituras_2+1
                                        ativa_led_ant2 = 1
                                        #Agora salvo no banco que teve leitura
                                        condicao = random.randint(5, 15)
                                        #try:
                                        #    # Agora salvo na tabela do banco bd_dashboard_dispositivos *******************************************
                                        #    mydb = mysql.connector.connect(
                                        #     host="192.168.10.96",
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
                                        #     host="192.168.10.96",
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



                                    elif(antena=="3"):
                                        leituras_3 = leituras_3 + 1
                                        leitura_geral_mg = leitura_geral_mg-1
                                        ativa_led_ant3 = 1
                                        #Agora salvo no banco que teve leitura
                                        condicao = random.randint(5, 15)
                                        #try:
                                        #    # Agora salvo na tabela do banco bd_dashboard_dispositivos *******************************************
                                        #    mydb = mysql.connector.connect(
                                        #     host="192.168.10.96",
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
                                        #     host="192.168.10.96",
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
                                        host="192.168.10.102",
                                        user="admin",
                                        password="logistica2019@@",
                                        database="bd_balanca1"
                                        )
                                        mycursor = mydb.cursor()
                                        sql = "INSERT INTO historico_leituras (tipo, epc,data_leitura, hora_leitura,antena) VALUES (%s, %s, %s, %s, %s)"
                                        msg = ("cavalo",epc, data_cavalo, hora_leitura, antena,);
                                        mycursor.execute(sql,msg);
                                        mydb.commit()
                                    except Exception as e:
                                        print("Requisicao deu erro:", e)
                                    #*******************************************************************************************
                                    #trato se esta em condicao correta na sequencia da leitura
                                    if ( n_leitura_mg == "0" ):

                                        #Condicao correta!
                                        n_leitura_mg = "1"
                                    elif ( n_leitura_mg =="1"):
                                        #Salvo o valor da ultima_epc_carreta_mg no banco para tratar!
                                        ativa_erro_carreta_mg = 1 # ativa para publicar erro de tag!
                                        #print("Faltou tag carreta!")
                                        n_leitura_mg = "1"

                                elif(tag=="442002" and epc != ultima_epc_carreta_mg and (antena=="2" or antena=="3")):
                                    #ativa o sinaleiro
                                    ativa_sinaleiro_mg = 1
                                    ultima_epc_carreta_mg = epc # Atualiza a ultima tag lida para carreta
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
                                    if(antena=="2"):
                                        leitura_geral_mg = leitura_geral_mg+1
                                        leituras_2 = leituras_2+1
                                        ativa_led_ant2 = 1
                                        #Agora salvo no banco que teve leitura
                                        condicao = random.randint(5, 15)
                                        #try:
                                        #    # Agora salvo na tabela do banco bd_dashboard_dispositivos *******************************************
                                        #    mydb = mysql.connector.connect(
                                        #     host="192.168.10.96",
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
                                        #     host="192.168.10.96",
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

                                    elif(antena=="3"):
                                        leituras_3 = leituras_3+1
                                        leitura_geral_mg = leitura_geral_mg-1
                                        ativa_led_ant3 = 1
                                        #Agora salvo no banco que teve leitura
                                        condicao = random.randint(5, 15)
                                        #try:
                                        #    # Agora salvo na tabela do banco bd_dashboard_dispositivos *******************************************
                                        #    mydb = mysql.connector.connect(
                                        #     host="192.168.10.96",
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
                                        #     host="192.168.10.96",
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
                                        host="192.168.10.102",
                                        user="admin",
                                        password="logistica2019@@",
                                        database="bd_balanca1"
                                        )
                                        mycursor = mydb.cursor()
                                        sql = "INSERT INTO historico_leituras (tipo, epc,data_leitura, hora_leitura,antena) VALUES (%s, %s, %s, %s, %s)"
                                        msg = ("carreta",epc, data_carreta, hora_leitura, antena,);
                                        mycursor.execute(sql,msg);
                                        mydb.commit()
                                    except Exception as e:
                                        print("Requisicao deu erro:", e)
                                    #Agora chamo para salvar no dashboard
                                    url_local2 = 'http://192.168.10.102/dashboard/dashboard_ponto_balanca1.php'
                                    dados = {'epc': epc,'ponto': 'balanca'}
                                    texto = None
                                    try:
                                        requisicao = requests.get(url_local2,dados)
                                        texto = str(requisicao)
                                        print(texto[11:14])
                                    except Exception as e:
                                        print("Requisicao deu erro:77777", e)
                                    
                                    #*******************************************************************************************
                                    if ( n_leitura_mg == "0" ):
                                        #Errado, faltou a tag do cavalo
                                        #Em testes salvar mesmo que so tenha leitura cavalo
                                        #
                                        #
                                        #
                                        #
                                        if(ultima_epc_cavalo_mg == ''):
                                            ultima_epc_cavalo_mg = '-'
                                            
                                        try:
                                            # Agora salvo na tabela de historico de leituras *******************************************
                                            mydb = mysql.connector.connect(
                                            host="192.168.10.102",
                                            user="admin",
                                            password="logistica2019@@",
                                            database="bd_balanca1"
                                            )
                                            mycursor = mydb.cursor()
                                            sql = "INSERT INTO historico_match (epc_cavalo,placa_cavalo,epc_carreta,placa_carreta,ponto,tratado) VALUES (%s, %s, %s, %s, %s, %s)"
                                            msg = (ultima_epc_cavalo_mg,"-",ultima_epc_carreta_mg,"-","mg","nao",);
                                            mycursor.execute(sql,msg);
                                            mydb.commit()
                                        except Exception as e:
                                            print("Requisicao deu erro:", e)
                                        #*******************************************************************************************
                                        #Chamo para atualizar e buscar as placas
                                        url_local = 'http://192.168.10.102/dashboard/validacao_match.php'
                                        dados = {'rodar':'mg'}
                                        texto = None
                                        try:
                                            requisicao = requests.get(url_local,dados)
                                            texto = str(requisicao)
                                            print(texto[11:14])
                                        except Exception as e:
                                            print("Requisicao deu erro:", e)
                                        #
                                        #
                                        #



                                        ativa_erro_cavalo_mg = 1 # ativa para publicar erro tag!
                                        n_leitura_mg = "0"
                                        #print("Faltou tag cavalo!")
                                    elif ( n_leitura_mg =="1"):
                                        #Condicao correta!
                                        n_leitura_mg = "0"
                                        #Salvar o match
                                        try:
                                            # Agora salvo na tabela de historico de leituras *******************************************
                                            mydb = mysql.connector.connect(
                                            host="192.168.10.102",
                                            user="admin",
                                            password="logistica2019@@",
                                            database="bd_balanca1"
                                            )
                                            mycursor = mydb.cursor()
                                            sql = "INSERT INTO historico_match (epc_cavalo,placa_cavalo,epc_carreta,placa_carreta,ponto,tratado) VALUES (%s, %s, %s, %s, %s, %s)"
                                            msg = (ultima_epc_cavalo_mg,"-",ultima_epc_carreta_mg,"-","mg","nao",);
                                            mycursor.execute(sql,msg);
                                            mydb.commit()
                                        except Exception as e:
                                            print("Requisicao deu erro:", e)
                                            
                                        #*******************************************************************************************
                                        #Chamo para atualizar e buscar as placas
                                        url_local = 'http://192.168.10.102/dashboard/validacao_match.php'
                                        dados = {'rodar':'mg'}
                                        texto = None
                                        try:
                                            requisicao = requests.get(url_local,dados)
                                            texto = str(requisicao)
                                            print(texto[11:14])
                                        except Exception as e:
                                            print("Requisicao deu erro1:", e)


                                        #*******************************************************************************************
                                        #Chamo para atualizar horas e remover do grafico quem esta a muito tempo
                                        
                                        
                                        
                                        # QUALQUER COISA VOLTAR ISSO !!!!!!!!!!!!!!!!!!!!!!!!!!!!
                                        
                                        
                                        #url_local2 = 'http://192.168.10.102/dashboard/verifica_tempo.php'
                                        #dados = {'rodar':'rodar'}
                                        #texto = None
                                        #try:
                                        #    requisicao = requests.get(url_local2,dados)
                                        #    texto = str(requisicao)
                                        #    print(texto[11:14])
                                        #except Exception as e:
                                        #    print("Requisicao deu erro:", e)

                                        #Chamo para atualizar a planilha atualizacao
                                        
                                        #url_local2 = 'http://192.168.10.96/dips/verifica_dispositivos.php'
                                        #dados = {'rodar':'rodar'}
                                        #texto = None
                                        #try:
                                        #    requisicao = requests.get(url_local2,dados)
                                        #    texto = str(requisicao)
                                        #    print(texto[11:14])
                                        #except Exception as e:
                                        #    print("Requisicao deu erro:", e)

                                #agora verifica a condicao das antenas
                                if (leitura_geral_mg >10 or leitura_geral_mg< -10):
                                    leitura_geral_mg = 0
                                    #print("Erro em alguma antena, agora precisa tratar
                                    if(leituras_2 == 0):
                                        leituras_2 = 0
                                        leituras_3 = 0
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

                                        
                                        #try:
                                        #    #Erro na antena zero
                                        #    # Agora salvo na tabela de historico de leituras *******************************************
                                        #    mydb = mysql.connector.connect(
                                        #    host="192.168.10.102",
                                        #    user="admin",
                                        #    password="logistica2019@@",
                                        #    database="bd_balanca1"
                                        #    )
                                        #    mycursor = mydb.cursor()
                                        #    sql = "INSERT INTO alerta_antenas(antena,local,tratado, data_leitura, hora_leitura) VALUES (%s, %s, %s, %s, %s)"
                                        #    msg = ("2","Saida MG030","nao",data_leitura, hora_leitura,);
                                        #    mycursor.execute(sql,msg);
                                        #    mydb.commit()
                                        #except Exception as e:
                                        #    print("Requisicao deu erro:", e)
                                        #*******************************************************************************************
                                        #AGORA ATUALIZO QUE A ANTENA 0 ESTA COM ERRO!
                                        #try:
                                        #    # Agora salvo na tabela local *******************************************
                                        #    mydb = mysql.connector.connect(
                                        #     host="192.168.10.96",
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
                                    elif(leituras_3 == 0):
                                        leituras_2 = 0
                                        leituras_3 = 0
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
                                        #try:
                                        #    #Erro na antena 1
                                        #    # Agora salvo na tabela de historico de leituras *******************************************
                                        #    mydb = mysql.connector.connect(
                                        #    host="192.168.10.102",
                                        #    user="admin",
                                        #    password="logistica2019@@",
                                        #    database="bd_balanca1"
                                        #    )
                                        #    mycursor = mydb.cursor()
                                        #    sql = "INSERT INTO alerta_antenas(antena,local,tratado, data_leitura, hora_leitura) VALUES (%s, %s, %s, %s, %s)"
                                        #    msg = ("3","Saida MG030","nao", data_leitura, hora_leitura,);
                                        #    mycursor.execute(sql,msg);
                                        #    mydb.commit()
                                        #except Exception as e:
                                        #    print("Requisicao deu erro:", e)
                                        #*******************************************************************************************
                                        #AGORA ATUALIZO QUE A ANTENA 0 ESTA COM ERRO!
                                        #try:
                                        #    # Agora salvo na tabela local *******************************************
                                        #    mydb = mysql.connector.connect(
                                        #     host="192.168.10.96",
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
                                        # 
                            #FINALIZA TRATANDO PARA SAINDO DA mg ***********************************************                                

                        epc = "xx"
                        antena = "xx"
            except Exception as e:
                print(e)            
        #Fecha While



#Criando a classe
OneSecond = Classe_Ler_Serial()
OneSecondThread = Thread(target=OneSecond.run)
OneSecondThread.start()

Thread_sinaleiro_balanca = Classe_Sinaleiro_balanca()
ExecutarThread_sinaleiro_balanca = Thread(target=Thread_sinaleiro_balanca.run)
ExecutarThread_sinaleiro_balanca.start()

Thread_sinaleiro_mg = Classe_Sinaleiro_balanca()
ExecutarThread_sinaleiro_mg = Thread(target=Thread_sinaleiro_mg.run)
ExecutarThread_sinaleiro_mg.start()


Thread_erro_cavalo_balanca = Classe_Salvar_no_banco_erro_cavalo_balanca()
ExecutarThread_erro_cavalo_balanca = Thread(target=Thread_erro_cavalo_balanca.run)
ExecutarThread_erro_cavalo_balanca.start()

Thread_erro_cavalo_mg = Classe_Salvar_no_banco_erro_cavalo_balanca()
ExecutarThread_erro_cavalo_mg = Thread(target=Thread_erro_cavalo_mg.run)
ExecutarThread_erro_cavalo_mg.start()


Thread_erro_carreta_balanca = Classe_Salvar_no_banco_erro_carreta_balanca()
ExecutarThread_erro_carreta_balanca = Thread(target=Thread_erro_carreta_balanca.run)
ExecutarThread_erro_carreta_balanca.start()

Thread_erro_carreta_mg = Classe_Salvar_no_banco_erro_carreta_balanca()
ExecutarThread_erro_carreta_mg = Thread(target=Thread_erro_carreta_mg.run)
ExecutarThread_erro_carreta_mg.start()


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

Thred_ant2 = Classe_LED_ANT2()
ExecutarThread_led_ant2 = Thread(target=Thred_ant2.run)
ExecutarThread_led_ant2.start()

Thred_ant3 = Classe_LED_ANT3()
ExecutarThread_led_ant3 = Thread(target=Thred_ant3.run)
ExecutarThread_led_ant3.start()


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
        host="192.168.10.102",
        user="admin",
        password="logistica2019@@",
        database="bd_balanca1"
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
    #    host="192.168.10.96",
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
    #url_verifica_dispositivo = 'http://192.168.10.96/dips/verifica_dispositivos.php'
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

FiveSecond.terminate() # Finaliza a tread



Thred_ant0.terminate()
Thred_ant1.terminate()
Thred_ant2.terminate()
Thred_ant3.terminate()
Thread_erro_carreta_balanca.terminate()
Thread_erro_carreta_mg.terminate()
Thread_erro_cavalo_balanca.terminate()
Thread_erro_cavalo_mg.terminate()
Thread_sinaleiro_balanca.terminate()
Thread_sinaleiro_mg.terminate()

print("Finalizando!")
