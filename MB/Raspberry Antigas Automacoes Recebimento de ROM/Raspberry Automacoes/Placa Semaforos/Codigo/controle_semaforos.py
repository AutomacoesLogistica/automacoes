# Escreva o seu c�digo aqui :-)
# Escreva o seu c�digo aqui :-)
import requests
import time
import RPi.GPIO as GPIO
from time import gmtime, strftime
from threading import Thread
import mysql.connector
import random

global url_local
global ciclo
global semaforo_entrada
global alguem_entrando
global vezes
global vezes_fechou
global v_semaforo_entrada
global semaforo_saida
global v_semaforo_saida
global ativa_erro_avanco_semaforo

ciclo = 0
vezes = 0
vezes_fechou = 0
alguem_entrando = 0
semaforo_entrada = 0 # Para iniciar verde
semaforo_saida = 1 # Para iniciar verde
ativa_erro_avanco_semaforo = 0
url_local = 'http://localhost/AutomacaoGerdau/monitor_rom.php'
GPIO.setmode(GPIO.BCM);
GPIO.setwarnings(False);
LED_rodando = 5; # Led de Status Rodando
#SEMAFORO DE ENTRADA ***********************************
LED_Vermelho_Entrada = 20; #antes 16
LED_Verde_Entrada = 26; # antes 19
#SEMAFORO DE SAIDA *************************************
LED_Vermelho_Saida = 16; #antes 20
LED_Verde_Saida = 19; # antes 26

#RELES DOS SEMAFOROS ***********************************
Saida_Rele_Entrada = 12; #IN1 Mike 8 F - (1)
Saida_Rele_Saida = 6; #IN2 Mike 8 F - (2)

#SENSOR LASER SEMAFORO ENTRADA *************************
Entrada_Sensor_Semaforo_Entrada = 13;
LED_Sensor_Atuado = 25;

Saida_Sirene = 24;
LED_Sirene = 21;

# Saidas
GPIO.setup(LED_rodando, GPIO.OUT);
GPIO.setup(LED_Vermelho_Entrada, GPIO.OUT); # LED SIMULANDO SEMAFORO VERMELHO DE ENTRADA LA FORA
GPIO.setup(LED_Vermelho_Saida, GPIO.OUT); # LED SIMULANDO SEMAFORO VERMELHO DE SAIDA LA FORA
GPIO.setup(LED_Verde_Entrada, GPIO.OUT); # LED SIMULANDO SEMAFORO VERDE DE ENTRADA LA FORA
GPIO.setup(LED_Verde_Saida, GPIO.OUT); # LED SIMULANDO SEMAFORO VERDE DE SAIDA LA FORA
GPIO.setup(Saida_Rele_Entrada, GPIO.OUT); # LED SIMULANDO SEMAFORO VERDE DE ENTRADA LA FORA
GPIO.setup(Saida_Rele_Saida, GPIO.OUT); # LED SIMULANDO SEMAFORO VERDE DE SAIDA LA FORA
GPIO.setup(LED_Sirene, GPIO.OUT); # LED SIMULANDO ATUACAO SIRENE LA FORA
GPIO.setup(LED_Sensor_Atuado, GPIO.OUT); # LED SIMULANDO ATUACAO SENSOR LA FORA

# ATUA��O DO SEMAFORO ENTRADA *********************************
GPIO.setup(Saida_Sirene, GPIO.OUT); # Saida para acionar sirene caso alguem ava�e o sinal
GPIO.setup(Entrada_Sensor_Semaforo_Entrada, GPIO.IN)


GPIO.output(LED_rodando,GPIO.LOW); # Inicia desligado o led rodando
GPIO.output(LED_Vermelho_Entrada,GPIO.LOW); # Inicia desligado o led vermelho da entrada
GPIO.output(LED_Vermelho_Saida,GPIO.HIGH); # Inicia ligado o led vermelho da saida
GPIO.output(LED_Verde_Entrada,GPIO.HIGH); # Inicia ligado o led verde de entrada
GPIO.output(LED_Verde_Saida,GPIO.LOW); # Inicia desligado o led ver de saida
GPIO.output(Saida_Rele_Entrada,GPIO.HIGH); # Inicia desligado o rele de entrada - NA_Vermelho / NF_Verde
GPIO.output(Saida_Rele_Saida,GPIO.HIGH); # Inicia desligado o rele de saida - NA_Verde / NF_Vermelho
GPIO.output(Saida_Sirene,GPIO.HIGH); # Inicia desligado
GPIO.output(LED_Sirene,GPIO.LOW); # Inicia desligado
GPIO.output(LED_Sensor_Atuado,GPIO.LOW); # Inicia desligado

class Classe_Entra_Para_Salvar_Avanco_Semaforo:
    def __init__(self):
        self._running = True

    def terminate(self):
        self._running = False

    def run(self):
        global ativa_erro_avanco_semaforo
        while self._running:
            if ( ativa_erro_avanco_semaforo == 1 ):
                GPIO.output(Saida_Sirene,GPIO.LOW); #Atua a sirene
                #print("Entrou para salvar que avancou o sinal!")
                ativa_erro_avanco_semaforo = 0 #Para nao ficar em loop
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
                     host="192.168.20.66",
                     user="admin",
                     password="logistica2019@@",
                     database="bd_display_mb"
                    )
                    mycursor = mydb.cursor()
                    sql = "INSERT INTO avanco_semaforo(data_evento,v_dia,v_mes,v_ano, horario_evento) VALUES (%s,%s,%s,%s, %s)"
                    msg = (data_leitura,dia_agora_cavalo,mes_agora_cavalo,ano_agora_cavalo, hora_leitura,);
                    mycursor.execute(sql,msg);
                    mydb.commit()
                    print('Salvou avanco do semaforo')
                    # FALTA FAZERd A PARTE DE TIRAR FOTO
                    # FALTA FAZER A PARTE DE TIRAR FOTO
                    # FALTA FAZER A PARTE DE TIRAR FOTO
                except Exception as e:
                    print("Requisicao deu erro:", e)
                #*******************************************************************************************
                while(GPIO.input(Entrada_Sensor_Semaforo_Entrada) == 0):
                    time.sleep(3)
                    GPIO.output(Saida_Sirene,GPIO.LOW); #Atua a sirene
                time.sleep(1)
                while(GPIO.input(Entrada_Sensor_Semaforo_Entrada) == 0):
                    time.sleep(3)
                    GPIO.output(Saida_Sirene,GPIO.LOW); #Atua a sirene
                time.sleep(1)
                while(GPIO.input(Entrada_Sensor_Semaforo_Entrada) == 0):
                    time.sleep(3)
                    GPIO.output(Saida_Sirene,GPIO.LOW); #Atua a sirene
                time.sleep(1)
                GPIO.output(Saida_Sirene,GPIO.HIGH); #Desliga a sirene

                time.sleep(5)
                #GPIO.output(Saida_Sirene,GPIO.HIGH); #Desliga a sirene

class Classe_Sinaleiro_entrada:
    def __init__(self):
        self._running = True

    def terminate(self):
        self._running = False

    def run(self):
        global semaforo_entrada
        while self._running:
            #print(semaforo_entrada)
            if ( semaforo_entrada == 1): #Coloca em vermelho
                #Realiza o acionamento do semaforo de entrada para vermelho
                GPIO.output(Saida_Rele_Entrada,GPIO.HIGH);
                GPIO.output(LED_Verde_Entrada,GPIO.LOW); # Desliga led verde de entrada
                GPIO.output(LED_Vermelho_Entrada,GPIO.HIGH); # Liga led vermelho de entrada
            else:
                GPIO.output(Saida_Rele_Entrada,GPIO.LOW); # Retira alimentacao do rele e deixa a entrada em verde
                GPIO.output(LED_Verde_Entrada,GPIO.HIGH); # Liga led verde de entrada
                GPIO.output(LED_Vermelho_Entrada,GPIO.LOW); # Desliga led vermelho de entrada

class Classe_Sinaleiro_saida:
    def __init__(self):
        self._running = True

    def terminate(self):
        self._running = False

    def run(self):
        global semaforo_saida
        global vezes
        global alguem_entrando
        global vezes_fechou
        while self._running:
            if ( semaforo_saida == 1): # Coloca em verde
                #Realiza o acionamento do semaforo de saida para verde
                GPIO.output(Saida_Rele_Saida,GPIO.HIGH);
                GPIO.output(LED_Verde_Saida,GPIO.HIGH); # Liga led verde de saida
                GPIO.output(LED_Vermelho_Saida,GPIO.LOW); # Apaga led vermelho de saida
                if(vezes == 0):
                    vezes = 1
            else:
                GPIO.output(Saida_Rele_Saida,GPIO.LOW); # Retira alimentacao do rele e deixa a entrada em vermelho
                GPIO.output(LED_Verde_Saida,GPIO.LOW); # Apaga led verde de saida
                GPIO.output(LED_Vermelho_Saida,GPIO.HIGH); # Liga led vermelho de saida
                if(vezes == 1):
                    #Acabou de normaliar o sistema
                    vezes = 0
                    alguem_entrando = 0
                    vezes_fechou = 0

class Classe_Ler_Sensor_Entrada:
    def __init__(self):
        self._running = True

    def terminate(self):
        self._running = False

    def run(self):
        global ativa_erro_avanco_semaforo
        global vezes
        global vezes_fechou
        global alguem_entrando
        global semaforo_entrada
        global semaforo_saida
        global url_local
        while self._running:
            #print(GPIO.input(Saida_Rele_Entrada)) #0 Verde entrada  1 Vermelho entrada
            if( GPIO.input(Entrada_Sensor_Semaforo_Entrada) == 0 and semaforo_entrada == 1 and vezes_fechou == 1):
                print('Avan�aram o semaforo!');
                vezes_fechou = 2

                ativa_erro_avanco_semaforo = 1 #Chama avisando que avancou semaforo
                #semaforo_entrada = 1 # Fecha o semaforo entrada
            #CODIGO PARA FECHAR O SEMAFORO DE ENTRADA AO DETECTAR ALGUEM ENTRANDO *********************
            #CODIGO PARA FECHAR O SEMAFORO DE ENTRADA AO DETECTAR ALGUEM ENTRANDO *********************
            #CODIGO PARA FECHAR O SEMAFORO DE ENTRADA AO DETECTAR ALGUEM ENTRANDO *********************
            #obs = Se atuar sensor de entrada (0) e o semaforo de entrada estiver verde(1)

            if( GPIO.input(Entrada_Sensor_Semaforo_Entrada) == 0 and semaforo_entrada == 0 and vezes_fechou == 0):
                time.sleep(2)
                if( GPIO.input(Entrada_Sensor_Semaforo_Entrada) == 0):
                    vezes_fechou = 1
                    semaforo_entrada = 1
                    alguem_entrando = 1
                    GPIO.output(Saida_Rele_Entrada,GPIO.HIGH);# Coloca a entrada em vermelho
                    print('Fechou semaforo alguem entrando!');
                    #PODE FAZER UPDATE TELA ROM
                    dados = {'mensagem': "sensor_semaforo" ,'id': "04"}
                    #Postando em modo local
                    try:
                        requisicao = requests.get(url_local,dados)
                    except Exception as e:
                        print("Requisicao deu erro:", e)
                    print('Fechou semaforo!')
                    GPIO.output(Saida_Rele_Entrada,GPIO.HIGH);# Coloca a entrada em vermelho
                    while(GPIO.input(Entrada_Sensor_Semaforo_Entrada) == 0):
                        time.sleep(3)
                    time.sleep(1)
                    while(GPIO.input(Entrada_Sensor_Semaforo_Entrada) == 0):
                        time.sleep(3)
                    time.sleep(1)
                    while(GPIO.input(Entrada_Sensor_Semaforo_Entrada) == 0):
                        time.sleep(3)
                    time.sleep(1)

                    print("Saiu")
                    time.sleep(3)
                    #FALTAAAAA
                else:
                    vezes_fechou = 1
                    semaforo_entrada = 1
                    alguem_entrando = 1

            #AGORA TRATA A LEITURA DO SENSOR APENAS PARA VALIDACAO INTERNA DO LED
            if(GPIO.input(Entrada_Sensor_Semaforo_Entrada)==0):
                #print('Sensor atuado!')
                GPIO.output(LED_Sensor_Atuado,GPIO.HIGH); #Liga o led interno de sensor atuado

            else:
                #print('Sensor nao atuado!')
                GPIO.output(LED_Sensor_Atuado,GPIO.LOW); #Apaga o led interno de sensor atuado



class Classe_Ler_Banco:
    def __init__(self):
        self._running = True

    def terminate(self):
        self._running = False

    def run(self):
        global semaforo_entrada
        global semaforo_saida
        global LED_Verde_Entrada
        global LED_Verde_Saida
        global LED_Vermelho_Entrada
        global LED_Vermelho_Saida
        global foto
        global vezes_fechou
        global vezes
        global alguem_entrando
        while self._running:
            try:
                #print('Rodando');
                mydb = mysql.connector.connect(
                 host="192.168.20.66",
                 user="admin",
                 password="logistica2019@@",
                 database="bd_display_mb"
                )
                mycursor = mydb.cursor()
                mycursor.execute("SELECT * FROM rom")
                y = 0
                myresult = mycursor.fetchall()
                myresult = str(myresult).split(',');
                v_semaforo_entrada =str(myresult[7]).strip()
                v_semaforo_saida =str(myresult[8]).strip()
                foto = str(myresult[4]).strip()
                v_semaforo_entrada =str((v_semaforo_entrada[1:len(v_semaforo_entrada)-1]))
                v_semaforo_saida =str((v_semaforo_saida[1:len(v_semaforo_saida)-1]))
                #print(v_semaforo_entrada)
                if(v_semaforo_entrada == 'verde'):

                    #print('Esta em verde o semaforo de entrada!')
                    #if(alguem_entrando == 1):
                    #semaforo_entrada = 1
                    #else:
                    semaforo_entrada = 0



                else:
                    #print('Esta em vermelho o semaforo de entrada!')
                    semaforo_entrada = 1 # Coloca o rele de entrada atuado para ficar em vermelho

                if(v_semaforo_saida == 'verde'):
                    semaforo_saida = 1 # Coloca para o rele de saida atuar e ficar em verde
                    #print('Esta em verde o semaforo de saida!')
                    if(foto == 0):
                        print("normalizou")
                        semaforo_saida = 0 #Coloca em fechado a saida
                        semaforo_entrada = 0 # Coloca em aberto a entrada
                        #vezes_fechou = 0
                        #alguem_entrando = 0
                        #vezes = 0

                else:
                    #print('Esta em vermelho o semaforo de saida!')
                    if(semaforo_saida == 1):
                        semaforo_entrada = 0 # verde
                    semaforo_saida = 0 # Coloca em vermelho
                if(semaforo_entrada == 0 and semaforo_saida == 0 ):
                    print("verde,vermelho")
                    vezes_fechou = 0
                elif(semaforo_entrada==1 and semaforo_saida == 0):
                    print("vermelho,vermelho")
                    alguem_entrando = 1
                    vezes_fechou = 1
                elif(semaforo_entrada == 0 and semaforo_saida == 1):
                    print("verde,verde")
                elif(semaforo_entrada==1 and semaforo_saida ==1):
                    print("vermelho,verde")
                time.sleep(1);
                print(GPIO.input(Entrada_Sensor_Semaforo_Entrada))
            except Exception as e:
                print(e)



#Criando a classe
Thread_ler_banco = Classe_Ler_Banco() #Conecta nos bancos e fica trazendo o status dos semaforos de entrada e saida
ExecutarThread_ler_banco = Thread(target=Thread_ler_banco.run)
ExecutarThread_ler_banco.start()

Thread_sinaleiro_entrada = Classe_Sinaleiro_entrada()
ExecutarThread_sinaleiro_entrada = Thread(target=Thread_sinaleiro_entrada.run)
ExecutarThread_sinaleiro_entrada.start()

Thread_sinaleiro_saida = Classe_Sinaleiro_saida()
ExecutarThread_sinaleiro_saida = Thread(target=Thread_sinaleiro_saida.run)
ExecutarThread_sinaleiro_saida.start()

Thread_avanco_semaforo = Classe_Entra_Para_Salvar_Avanco_Semaforo() # Classe para entrar e salvar avanco de semaforo de entrada
ExecutarThread_avanco_semaforo = Thread(target=Thread_avanco_semaforo.run)
ExecutarThread_avanco_semaforo.start()

Thread_ler_banco = Classe_Ler_Sensor_Entrada()
ExecutarThread_ler_banco = Thread(target=Thread_ler_banco.run)
ExecutarThread_ler_banco.start()


Exit = False #Flag para saida





while Exit==False:
 ciclo = ciclo + 1
 #print("Rodando  - ", ciclo)
 time.sleep(1) # 1 segundo de delay para codigo principal
 if(ciclo ==2):
    GPIO.output(LED_rodando,GPIO.HIGH);
    #print(GPIO.input(LED_rodando));
 if(ciclo ==4):
    GPIO.output(LED_rodando,GPIO.LOW);
    #print(GPIO.input(LED_rodando));
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
         host="192.168.20.66",
         user="admin",
         password="logistica2019@@",
         database="bd_display_mb"
        )
        mycursor = mydb.cursor()
        sql = "UPDATE atualizacao_semaforos SET data_atualizacao = %s, hora_atualizacao = %s WHERE id='1'"
        msg = (data_atualizacao, hora_atualizacao,)
        mycursor.execute(sql,msg);
        mydb.commit();
        #print(hora_atualizacao)
    except Exception as e:
        print("Requisicao deu erro:", e)

 if (ciclo > 1000): Exit = True #Sai do programa

Thread_ler_banco.terminate() # Finaliza a tread
Thread_sinaleiro_entrada.terminate() # Finaliza a tread
Thread_sinaleiro_saida.terminate() # Finaliza a tread
Thread_avanco_semaforo.terminate() # Finaliza a tread
Thread_ler_banco.terminate()

print("Finalizando!")