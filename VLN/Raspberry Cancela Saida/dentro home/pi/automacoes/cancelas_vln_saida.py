import serial
import requests
import time
import RPi.GPIO as GPIO
from time import gmtime, strftime
from threading import Thread
import mysql.connector
cancela1 = "21";#Era21 # Codigo lora referente a cancela do lado Esquerdo
cancela2 = "22";#Era22 # Codigo lora referente a cancela do lado Direito
portal_cancela1 = "p21"; #Vindo pelo portal/socket ja que pulso GAGF tem falhado!
portal_cancela2 = "p22"; #Vindo pelo portal/socket ja que pulso GAGF tem falhado!

global ciclo
ciclo = 0
tempo_cancela1 = 2; # tempo em segundos
tempo_cancela2 = 2; # tempo em segundos
GPIO.setmode(GPIO.BCM);
GPIO.setwarnings(False);
LED_rodando = 12;
LED_saida1 = 6;
LED_saida2 = 5;
Saida1 = 19;
Saida2 = 26;
Entrada1 = 20;
Entrada2 = 21;
# Saidas
GPIO.setup(LED_rodando, GPIO.OUT);
GPIO.setup(LED_saida1, GPIO.OUT);
GPIO.setup(LED_saida2, GPIO.OUT);
GPIO.setup(Saida1, GPIO.OUT);
GPIO.setup(Saida2, GPIO.OUT);

# Entradas
GPIO.setup(Entrada1, GPIO.IN, pull_up_down = GPIO.PUD_DOWN)
GPIO.setup(Entrada2, GPIO.IN, pull_up_down = GPIO.PUD_DOWN)

GPIO.output(LED_rodando,GPIO.LOW); # Inicia desligado o led rodando
GPIO.output(LED_saida1,GPIO.LOW); # Inicia desligado o led da saida 1
GPIO.output(LED_saida2,GPIO.LOW); # Inicia desligado o led da saida 2
GPIO.output(Saida1,GPIO.HIGH); # Inicia desligado a saida 1 - Rele atua com LOW
GPIO.output(Saida2,GPIO.HIGH); # Inicia desligado a saida 2 - Rele atua com LOW







class Classe_Ler_Cancela_1:
    def __init__(self):
        self._running = True

    def terminate(self):
        self._running = False

    def run(self):
        global Ler_Cancela_1
        while self._running:
            if(GPIO.input(Entrada1) == 0):
                print("Acionada Saida 1");
                GPIO.output(LED_saida1,GPIO.HIGH);
                GPIO.output(Saida1,GPIO.LOW);
                time.sleep(tempo_cancela1);
                GPIO.output(LED_saida1,GPIO.LOW);
                GPIO.output(Saida1,GPIO.HIGH);
                #Pego a hora atual
                data_completa = (strftime("%d/%m/%Y %H:%M:%S", gmtime()))
                data =str(data_completa)
                hora = str(int(data[10:13])-3)
                minuto = (data[14:16])
                segundo = (data[17:19])
                data_completa = data[0:10]
                hora_completa = hora+":"+minuto+":"+segundo
                # Agora salvo na tabela
                mydb = mysql.connector.connect(
                 host="localhost",
                 user="admin",
                 password="logistica2019@@",
                 database="bd_cancelas"
                )
                mycursor = mydb.cursor()
                sql = "INSERT INTO historico_cancelas (cancela, data_leitura, hora_leitura) VALUES (%s, %s, %s)"
                msg = ("Esquerda", data_completa, hora_completa,);
                mycursor.execute(sql,msg);
                mydb.commit()
                # ATUALIZAO NO PORTAL **********************************************************
                mydb = mysql.connector.connect(host="192.168.40.107",user="admin",password="logistica2019@@",database="bd_cancelas")
                mycursor = mydb.cursor()
                sql = "UPDATE id_cancelas_vln SET data=%s,hora=%s, info=%s WHERE id=4"
                msg = (data_completa,hora_completa, "Acionado cancela da Esquerda!");
                mycursor.execute(sql,msg);
                mydb.commit()
                # *******************************************************************************



class Classe_Ler_Cancela_2:
    def __init__(self):
        self._running = True

    def terminate(self):
        self._running = False

    def run(self):
        global Ler_Cancela_2
        while self._running:
            if(GPIO.input(Entrada2) == 0):
                print("Acionada Saida 2");
                GPIO.output(LED_saida2,GPIO.HIGH);
                GPIO.output(Saida2,GPIO.LOW);
                time.sleep(tempo_cancela2);
                GPIO.output(LED_saida2,GPIO.LOW);
                GPIO.output(Saida2,GPIO.HIGH);
                #Pego a hora atual
                data_completa = (strftime("%d/%m/%Y %H:%M:%S", gmtime()))
                data =str(data_completa)
                hora = str(int(data[10:13])-3)
                minuto = (data[14:16])
                segundo = (data[17:19])
                data_completa = data[0:10]
                hora_completa = hora+":"+minuto+":"+segundo
                # Agora salvo na tabela
                mydb = mysql.connector.connect(
                 host="localhost",
                 user="admin",
                 password="logistica2019@@",
                 database="bd_cancelas"
                )
                mycursor = mydb.cursor()
                sql = "INSERT INTO historico_cancelas (cancela, data_leitura, hora_leitura) VALUES (%s, %s, %s)"
                msg = ("Direita", data_completa, hora_completa,);
                mycursor.execute(sql,msg);
                mydb.commit()
                # ATUALIZAO NO PORTAL **********************************************************
                mydb = mysql.connector.connect(host="192.168.40.107",user="admin",password="logistica2019@@",database="bd_cancelas")
                mycursor = mydb.cursor()
                sql = "UPDATE id_cancelas_vln SET data=%s,hora=%s, info=%s WHERE id=3"
                msg = (data_completa,hora_completa, "Acionado cancela da Direita!");
                mycursor.execute(sql,msg);
                mydb.commit()
# *******************************************************************************

class Classe_Ler_Banco:
    def __init__(self):
        self._running = True

    def terminate(self):
        self._running = False

    def run(self):
        global Ler_Banco
        while self._running:
            mydb = mysql.connector.connect(
              host="localhost",
              user="admin",
              password="logistica2019@@",
              database="bd_cancelas"
            )
            mycursor = mydb.cursor()
            mycursor.execute("SELECT * FROM acionamento LIMIT 1")
            y=0;
            myresult = mycursor.fetchall()
            for x in myresult:
                #print(x)
                #Encontrou a linha, agora precisa tratar se foi cancela 1(Esquerda) ou 2(Direita) de saida
                id = x[0];
                codigo_lora = x[1];
                if(codigo_lora == cancela1):
                    print("Cancela 1");
                    mycursor = mydb.cursor()
                    sql = "DELETE FROM acionamento WHERE id = %s"
                    valor_id = (id, )
                    mycursor.execute(sql,valor_id);
                    mydb.commit()
                    print(mycursor.rowcount, "record(s) deleted")
                    # COLOCAR A PARTE QUE ATUA O GPIO
                    print("Acionada Saida Cancela da Esquerda Manual pelo Portal");
                    GPIO.output(LED_saida1,GPIO.HIGH);
                    GPIO.output(Saida1,GPIO.LOW);
                    time.sleep(tempo_cancela1);
                    GPIO.output(LED_saida1,GPIO.LOW);
                    GPIO.output(Saida1,GPIO.HIGH);
                    #Pego a hora atual
                    data_completa = (strftime("%d/%m/%Y %H:%M:%S", gmtime()))
                    data =str(data_completa)
                    hora = str(int(data[10:13])-3)
                    minuto = (data[14:16])
                    segundo = (data[17:19])
                    data_completa = data[0:10]
                    hora_completa = hora+":"+minuto+":"+segundo
                    # Agora salvo na tabela
                    mydb = mysql.connector.connect(
                     host="localhost",
                     user="admin",
                     password="logistica2019@@",
                     database="bd_cancelas"
                    )
                    mycursor = mydb.cursor()
                    sql = "INSERT INTO historico_cancelas (cancela, data_leitura, hora_leitura) VALUES (%s, %s, %s)"
                    msg = ("Esquerda_Manual", data_completa, hora_completa,);
                    mycursor.execute(sql,msg);
                    mydb.commit()
                    # ATUALIZAO NO PORTAL **********************************************************
                    mydb = mysql.connector.connect(host="192.168.40.107",user="admin",password="logistica2019@@",database="bd_cancelas")
                    mycursor = mydb.cursor()
                    sql = "UPDATE id_cancelas_vln SET data=%s,hora=%s, info=%s WHERE id=4"
                    msg = (data_completa,hora_completa, "Acionado cancela da Esquerda!");
                    mycursor.execute(sql,msg);
                    mydb.commit()
                    # *******************************************************************************
                elif(codigo_lora == portal_cancela1):
                    print("Cancela 1 pelo Portal!");
                    mycursor = mydb.cursor()
                    sql = "DELETE FROM acionamento WHERE id = %s"
                    valor_id = (id, )
                    mycursor.execute(sql,valor_id);
                    mydb.commit()
                    print(mycursor.rowcount, "record(s) deleted")
                    # COLOCAR A PARTE QUE ATUA O GPIO
                    print("Acionada Saida Cancela da Esquerda Automatica pelo Portal");
                    GPIO.output(LED_saida1,GPIO.HIGH);
                    GPIO.output(Saida1,GPIO.LOW);
                    time.sleep(tempo_cancela1);
                    GPIO.output(LED_saida1,GPIO.LOW);
                    GPIO.output(Saida1,GPIO.HIGH);
                    #Pego a hora atual
                    data_completa = (strftime("%d/%m/%Y %H:%M:%S", gmtime()))
                    data =str(data_completa)
                    hora = str(int(data[10:13])-3)
                    minuto = (data[14:16])
                    segundo = (data[17:19])
                    data_completa = data[0:10]
                    hora_completa = hora+":"+minuto+":"+segundo
                    # Agora salvo na tabela
                    mydb = mysql.connector.connect(
                     host="localhost",
                     user="admin",
                     password="logistica2019@@",
                     database="bd_cancelas"
                    )
                    mycursor = mydb.cursor()
                    sql = "INSERT INTO historico_cancelas (cancela, data_leitura, hora_leitura) VALUES (%s, %s, %s)"
                    msg = ("Esquerda_Automatico_Portal", data_completa, hora_completa,);
                    mycursor.execute(sql,msg);
                    mydb.commit()
                    # ATUALIZAO NO PORTAL **********************************************************
                    mydb = mysql.connector.connect(host="192.168.40.107",user="admin",password="logistica2019@@",database="bd_cancelas")
                    mycursor = mydb.cursor()
                    sql = "UPDATE id_cancelas_vln SET data=%s,hora=%s, info=%s WHERE id=4"
                    msg = (data_completa,hora_completa, "Acionado cancela da Esquerda!");
                    mycursor.execute(sql,msg);
                    mydb.commit()
                    # *******************************************************************************


                elif (codigo_lora == cancela2):
                    print("Cancela 2");
                    mycursor = mydb.cursor()
                    sql = "DELETE FROM acionamento WHERE id = %s"
                    valor_id = (id, )
                    mycursor.execute(sql,valor_id);
                    mydb.commit()
                    print(mycursor.rowcount, "record(s) deleted")
                    # COLOCAR A PARTE QUE ATUA O GPIO
                    print("Acionada Saida Cancela da Direita Manual pelo Portal");
                    GPIO.output(LED_saida2,GPIO.HIGH);
                    GPIO.output(Saida2,GPIO.LOW);
                    time.sleep(tempo_cancela2);
                    GPIO.output(LED_saida2,GPIO.LOW);
                    GPIO.output(Saida2,GPIO.HIGH);
                    #Pego a hora atual
                    data_completa = (strftime("%d/%m/%Y %H:%M:%S", gmtime()))
                    data =str(data_completa)
                    hora = str(int(data[10:13])-3)
                    minuto = (data[14:16])
                    segundo = (data[17:19])
                    data_completa = data[0:10]
                    hora_completa = hora+":"+minuto+":"+segundo
                    # Agora salvo na tabela
                    mydb.commit()
                    mydb.commit()
                    mycursor = mydb.cursor()
                    sql = "INSERT INTO historico_cancelas (cancela, data_leitura, hora_leitura) VALUES (%s, %s, %s)"
                    msg = ("Direita_Manual", data_completa, hora_completa,);
                    mycursor.execute(sql,msg);
                    mydb.commit()
                    # ATUALIZAO NO PORTAL **********************************************************
                    mydb = mysql.connector.connect(host="192.168.40.107",user="admin",password="logistica2019@@",database="bd_cancelas")
                    mycursor = mydb.cursor()
                    sql = "UPDATE id_cancelas_vln SET data=%s,hora=%s, info=%s WHERE id=3"
                    msg = (data_completa,hora_completa, "Acionado cancela da Direita!");
                    mycursor.execute(sql,msg);
                    mydb.commit()
                    # *******************************************************************************
                elif (codigo_lora == portal_cancela2):
                    print("Cancela 2 pelo Portal!");
                    mycursor = mydb.cursor()
                    sql = "DELETE FROM acionamento WHERE id = %s"
                    valor_id = (id, )
                    mycursor.execute(sql,valor_id);
                    mydb.commit()
                    print(mycursor.rowcount, "record(s) deleted")
                    # COLOCAR A PARTE QUE ATUA O GPIO
                    print("Acionada Saida Cancela da Direita Automatica pelo Portal");
                    GPIO.output(LED_saida2,GPIO.HIGH);
                    GPIO.output(Saida2,GPIO.LOW);
                    time.sleep(tempo_cancela2);
                    GPIO.output(LED_saida2,GPIO.LOW);
                    GPIO.output(Saida2,GPIO.HIGH);
                    #Pego a hora atual
                    data_completa = (strftime("%d/%m/%Y %H:%M:%S", gmtime()))
                    data =str(data_completa)
                    hora = str(int(data[10:13])-3)
                    minuto = (data[14:16])
                    segundo = (data[17:19])
                    data_completa = data[0:10]
                    hora_completa = hora+":"+minuto+":"+segundo
                    # Agora salvo na tabela
                    mydb.commit()
                    mydb.commit()
                    mycursor = mydb.cursor()
                    sql = "INSERT INTO historico_cancelas (cancela, data_leitura, hora_leitura) VALUES (%s, %s, %s)"
                    msg = ("Direita_Automatico_Portal", data_completa, hora_completa,);
                    mycursor.execute(sql,msg);
                    mydb.commit()
                    # ATUALIZAO NO PORTAL **********************************************************
                    mydb = mysql.connector.connect(host="192.168.40.107",user="admin",password="logistica2019@@",database="bd_cancelas")
                    mycursor = mydb.cursor()
                    sql = "UPDATE id_cancelas_vln SET data=%s,hora=%s, info=%s WHERE id=3"
                    msg = (data_completa,hora_completa, "Acionado cancela da Direita!");
                    mycursor.execute(sql,msg);
                    mydb.commit()
                    # *******************************************************************************





                else:
                    print("Outro");
                    mycursor = mydb.cursor()
                    sql = "DELETE FROM acionamento WHERE id = %s"
                    valor_id = (id, )
                    mycursor.execute(sql,valor_id);
                    mydb.commit()
                    print(mycursor.rowcount, "record(s) deleted")
                y=y+1
                if y>0:
                    print(y)
                else:
                    print ("Nao encontrado!")




#Criando a classe
FiveSecond = Classe_Ler_Cancela_1()
#Create Thread
FiveSecondThread = Thread(target=FiveSecond.run)
#Start Thread
FiveSecondThread.start()

#Criando a classe
TwoSecond = Classe_Ler_Cancela_2()
#Create Thread
TwoSecondThread = Thread(target=TwoSecond.run)
#Start Thread
TwoSecondThread.start()


#Criando a classe
OneSecond = Classe_Ler_Banco()
#Create Thread
OneSecondThread = Thread(target=OneSecond.run)
#Start Thread
OneSecondThread.start()




Exit = False #Flag para saida





while Exit==False:
 ciclo = ciclo + 1
 print("Rodando  - ", ciclo)
 time.sleep(1) # 1 segundo de delay para codigo principal
 if(ciclo ==2): GPIO.output(LED_rodando,GPIO.HIGH);
 if(ciclo ==4): GPIO.output(LED_rodando,GPIO.LOW); ciclo = 0;
 if (ciclo > 50000): Exit = True #Sai do programa

TwoSecond.terminate() # Finaliza a tread
FiveSecond.terminate() # Finaliza a tread
OneSecond.terminate() # Finaliza a tread

print("Finalizando!")