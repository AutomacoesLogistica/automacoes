






def main():
    import requests
    import mysql.connector
    import time
    from time import gmtime, strftime
    import socket
    import sys
    import binascii    
    url_local = 'http://192.168.10.96/automacoes_poste_saida/display_tcp/mensagem_display.php'
    url_local2 = 'http://192.168.10.96/sockets/saida_automacoes/atualiza_hora_display.php'

    ultima_mensagem = '-'


    mydb = mysql.connector.connect(
        host="192.168.10.96",#nao mudar para localhost
        user="admin",
        password="Logistica2019@@",
        database="bd_poste_balanca1"
    )
    try:
        with socket.socket(socket.AF_INET, socket.SOCK_STREAM) as s:
            s.connect(('192.168.10.100', 2101))
            while(1):
                #BUSCA os dados da mensagem
                mycursor = mydb.cursor()
                mycursor.execute("SELECT * FROM display_balanca1 WHERE id='1'")
                y = 0
                myresult = mycursor.fetchall()
                for x in myresult:
                    y=y+1
                    if(y==1):
                        mensagem1 = x[1]
                        mensagem2 = x[2]
                        crc_display = x[9]
                        if(crc_display == "" or crc_display =="-"):
                            crc_display="01 02 50 01 01 AA 01 01 82 01 01 00 32 AA 10 AA 70 AA 01 20 20 20 20 20 54 65 6E 68 61 20 75 6D 61 20 20 20 20 20 AA 10 AA 70 AA 02 20 20 20 20 62 6F 61 20 76 69 61 67 65 6D 21 20 20 20 20 03 51 43"

                        if(ultima_mensagem != mensagem1):
                            ultima_mensagem = mensagem1
                            print(mensagem1)
                            if(mensagem1=='___Tenha_uma_boa___'):
                                #Viagem concluida, esperar 2 e limpar a tela
                                message = str(crc_display)
                                print(message)
                                s.sendall(bytes.fromhex(message))
                                try:
                                    dados = {'mensagem1': mensagem1,'mensagem2': mensagem2 }
                                    texto = None
                                    requisicao = requests.get(url_local,dados)
                                    texto = str(requisicao)
                                    print(texto[11:14])
                                except Exception as e:
                                    print("Requisicao deu erro:", e)
                                
                                time.sleep(5) #Espero os 5 segundos

                                #Agora mando pra limpar a tela e escreve Aguardando veiculo!
                                message="01 02 50 01 01 AA 01 01 82 01 01 00 32 AA 10 AA 70 AA 01 41 67 75 61 72 64 61 6E 64 6F 20 76 65 69 63 75 6C 6F 21 AA 10 AA 70 AA 02 20 20 20 20 20 20 20 20 20 20 20 20 20 20 20 20 20 20 20 03 1A BA" 
                                s.sendall(bytes.fromhex(message))
                                mensagem1 = 'Aguardando veiculo!'
                                mensagem2 = '____________________'
                                try:
                                    dados = {'mensagem1': mensagem1,'mensagem2': mensagem2 }
                                    texto = None
                                    requisicao = requests.get(url_local,dados)
                                    texto = str(requisicao)
                                    print(texto[11:14])
                                except Exception as e:
                                    print("Requisicao deu erro:", e)
                                
                                time.sleep(1) #Espero os 1 segundos

                            #******************************************************************************************************************************
                            
                            elif(mensagem1=='_Atencao:_Carga___'):
                                #Existe uma carga descentralizada! notifico
                                message='01 02 50 01 01 AA 01 01 82 01 01 00 32 AA 10 AA 70 AA 01 20 20 41 74 65 6E 63 61 6F 3A 20 43 61 72 67 61 20 20 20 AA 10 AA 70 AA 02 20 20 64 65 73 63 65 6E 74 72 61 6C 69 7A 61 64 61 21 20 03 D2 3F'
                                s.sendall(bytes.fromhex(message))
                                try:
                                    dados = {'mensagem1': mensagem1,'mensagem2': mensagem2 }
                                    texto = None
                                    requisicao = requests.get(url_local,dados)
                                    texto = str(requisicao)
                                    print(texto[11:14])
                                except Exception as e:
                                    print("Requisicao deu erro:", e)
                                
                                time.sleep(3) #Espero os 3 segundos

                                #Agora mando para direcionar ir ao patio de excessos
                                message='01 02 50 01 01 AA 01 01 82 01 01 00 32 AA 10 AA 70 AA 01 44 69 72 69 6A 61 2D 73 65 20 61 6F 20 70 61 74 69 6F 20 AA 10 AA 70 AA 02 64 65 20 65 78 63 65 73 73 6F 73 21 20 20 20 20 20 20 20 03 19 50'
                                s.sendall(bytes.fromhex(message))
                                mensagem1 = '_Dirija-se_para_o__'
                                mensagem2 = '_patio_de_excessos!'
                                try:
                                    dados = {'mensagem1': mensagem1,'mensagem2': mensagem2 }
                                    texto = None
                                    requisicao = requests.get(url_local,dados)
                                    texto = str(requisicao)
                                    print(texto[11:14])
                                except Exception as e:
                                    print("Requisicao deu erro:", e)
                                
                                time.sleep(3) #Aguardo 3 segundos 
                                
                                #Agora mando para limpar a tela e escrevo Aguardando veiculo!
                                message="01 02 50 01 01 AA 01 01 82 01 01 00 32 AA 10 AA 70 AA 01 41 67 75 61 72 64 61 6E 64 6F 20 76 65 69 63 75 6C 6F 21 AA 10 AA 70 AA 02 20 20 20 20 20 20 20 20 20 20 20 20 20 20 20 20 20 20 20 03 1A BA" 
                                s.sendall(bytes.fromhex(message))
                                mensagem1 = 'Aguardando veiculo!'
                                mensagem2 = '____________________'
                                try:
                                    dados = {'mensagem1': mensagem1,'mensagem2': mensagem2 }
                                    texto = None
                                    requisicao = requests.get(url_local,dados)
                                    texto = str(requisicao)
                                    print(texto[11:14])
                                except Exception as e:
                                    print("Requisicao deu erro:", e)

                            #******************************************************************************************************************************

                            elif(mensagem1=='_Dirija-se_para_o__'):
                                #Existe um excesso de carga!
                                message='01 02 50 01 01 AA 01 01 82 01 01 00 32 AA 10 AA 70 AA 01 44 69 72 69 6A 61 2D 73 65 20 61 6F 20 70 61 74 69 6F 20 AA 10 AA 70 AA 02 64 65 20 65 78 63 65 73 73 6F 73 21 20 20 20 20 20 20 20 03 19 50'
                                s.sendall(bytes.fromhex(message))
                                try:
                                    dados = {'mensagem1': mensagem1,'mensagem2': mensagem2 }
                                    texto = None
                                    requisicao = requests.get(url_local,dados)
                                    texto = str(requisicao)
                                    print(texto[11:14])
                                except Exception as e:
                                    print("Requisicao deu erro:", e)
                                
                                time.sleep(2) #Espero os 2 segundos
                                
                                #Agora mando para limpar a tela
                                message="01 02 50 01 01 AA 01 01 82 01 01 00 32 AA 10 AA 70 AA 01 41 67 75 61 72 64 61 6E 64 6F 20 76 65 69 63 75 6C 6F 21 AA 10 AA 70 AA 02 20 20 20 20 20 20 20 20 20 20 20 20 20 20 20 20 20 20 20 03 1A BA" 
                                s.sendall(bytes.fromhex(message))
                                mensagem1 = 'Aguardando veiculo!'
                                mensagem2 = '____________________'
                                try:
                                    dados = {'mensagem1': mensagem1,'mensagem2': mensagem2 }
                                    texto = None
                                    requisicao = requests.get(url_local,dados)
                                    texto = str(requisicao)
                                    print(texto[11:14])
                                except Exception as e:
                                    print("Requisicao deu erro:", e)
                            #******************************************************************************************************************************
                            else:
                                #Aguardando veiculo!
                                #Agora mando para limpar a tela
                                message="01 02 50 01 01 AA 01 01 82 01 01 00 32 AA 10 AA 70 AA 01 41 67 75 61 72 64 61 6E 64 6F 20 76 65 69 63 75 6C 6F 21 AA 10 AA 70 AA 02 20 20 20 20 20 20 20 20 20 20 20 20 20 20 20 20 20 20 20 03 1A BA" 
                                s.sendall(bytes.fromhex(message))
                                
                                time.sleep(2) #Espero os 2 segundos
                                                    
                                mensagem1 = 'Aguardando veiculo!'
                                mensagem2 = '____________________'
                                try:
                                    dados = {'mensagem1': mensagem1,'mensagem2': mensagem2 }
                                    texto = None
                                    requisicao = requests.get(url_local,dados)
                                    texto = str(requisicao)
                                    print(texto[11:14])
                                except Exception as e:
                                    print("Requisicao deu erro:", e)
                        else:
                            print('igual')
                    else:
                        y=0 # Nao apagar        
                    if y<=0:
                        print('sem solicitacoes')
                    mydb.commit()
                    time.sleep(1)
                    try:
                        dados = {'m': 'm'}
                        texto = None
                        requisicao = requests.get(url_local2,dados)
                        texto = str(requisicao)
                        print(texto[11:14])
                    except Exception as e:
                        print("Requisicao deu erro:", e)

        s.detach()
        s.close()
                    

    except Exception as e:
        print(e)
        main()        






for i in range(1, 1000000000):
  try:
    main()
  except Exception as e:
    print(e)
    print("Restarting!")
    main()

        