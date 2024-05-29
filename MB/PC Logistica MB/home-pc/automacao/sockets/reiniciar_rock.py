import mysql.connector
import time
from time import gmtime, strftime
from datetime import datetime
import paramiko #importa para criar a conexao ssh



def main():
    try:
        address = '192.168.10.35'
        username = 'root'
        password = 'logistica2019@@'



        # Comando pre definidos
        _status = 'systemctl status '
        _stop = 'systemctl stop '
        _start = 'systemctl start '
        _caminho = 'cd /etc/systemd/system'
        

        while(1):
            try:
                mydb = mysql.connector.connect(
                 host="192.168.10.35",#nao mudar para localhost
                 user="admin",
                 password="logistica2019@@",
                 database="bd_poste_balanca1"
                )
                
                #BUSCA SE EXISTE ACIONAMENTOS PARA SEREM REALIZADOS
                mycursor = mydb.cursor()
                mycursor.execute("SELECT * FROM historico_display WHERE ( data_aqui1 != '' AND data_aqui1 != '-' ) ORDER BY id DESC LIMIT 1")
                y = 0
                myresult = mycursor.fetchall()
                for x in myresult:
                    y=y+1
                    if(y==1):
                        id = x[0]
                        data = x[6]
                        hora = x[7]
                        data = data + " " + hora
                        dia_banco = data[0:2]
                        mes_banco = data[3:5]
                        ano_banco = data[6:10]
                        hora_banco = data[10:13]
                        minuto_banco = data[14:16]
                        segundo_banco = data[17:19]
                        
                        print("Dia = "+ str(dia_banco))
                        print("Mes = "+ str(mes_banco))
                        print("Ano = "+ str(ano_banco))
                        print("Hora = "+ str(hora_banco))
                        print("Minuto = "+ str(minuto_banco))
                        print("Segundo = "+ str(segundo_banco))
                        ultima_leitura = datetime(int(ano_banco), int(mes_banco), int(dia_banco), int(hora_banco), int(minuto_banco), int(segundo_banco))
                        
                        
                        #Pego a hora atual
                        data_completa = (strftime("%d/%m/%Y %H:%M:%S", gmtime()))
                        data =str(data_completa)
                        dia_agora = int(data[0:2])
                        mes_agora = int(data[3:5])
                        ano_agora = int(data[6:10])
                        hora_agora = int(str(int(data[10:13])-3))
                        
                        minuto_agora = int(data[14:16])
                        segundo_agora = str(data[17:19])

                        leitura_agora = datetime(int(ano_agora),int(mes_agora), int(dia_agora), int(hora_agora), int(minuto_agora), int(segundo_agora)) #Ano, mes, dia, hora, minuto, segundos

                        resposta= str(leitura_agora - ultima_leitura)
                        resposta = resposta.split(':')
                        
                        v_hora = int(resposta[0])
                        v_minuto = int(resposta[1])
                        v_segundo = int(resposta[2])
                        #resposta_em_segundos = (int(resposta[0])*3600)+(int(resposta[1])*60)+int(resposta[2])

                        print(v_hora)
                        print(v_minuto)
                        print(v_segundo)
                        
                        if(v_minuto >=20):
                            print("tem que reiniciar!")
                            ssh = paramiko.SSHClient()
                            ssh.set_missing_host_key_policy(paramiko.AutoAddPolicy())
                            ssh.connect(hostname=address,username=username,password=password)
                            ssh.exec_command('sudo su') # Entro em modo root
                            time.sleep(1)
                            ssh.exec_command('sudo reboot') # Reinicio o sistema!                    
                            time.sleep(1)
                            ssh.close() #Fecho a conexao!
                        else:
                            print("Tudo OK, deixa rodando!")
                    
                    else:
                        y=0 # Nao apagar        
                    if y<=0:
                        print('sem solicitacoes')
                    mydb.commit()
                    time.sleep(600) #Roda a cada 10 minutos!
            except Exception as e:
                print("Requisicao deu erro:", e)
                main() 
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













