#para instalar basta digitar >>>> sudo apt install python3-paramiko
import paramiko #importa para criar a conexao ssh
import time # biblioteca nativa para ter delay
import requests

url_local = 'http://192.168.10.96/sockets/valicadoes_sockets/validacao.php'


def main():
    try:
        address = '192.168.10.96'
        username = 'root'
        password = 'logistica2019@@'



        # Comando pre definidos
        _status = 'systemctl status '
        _stop = 'systemctl stop '
        _start = 'systemctl start '
        _caminho = 'cd /etc/systemd/system'

        while(1):
            try:
                # Verifica o primeiro script *********************************************************************************************************
                #Nome do script desejado a verificar!
                script = 'servidor_socket_pires.service'
                ssh = paramiko.SSHClient()
                ssh.set_missing_host_key_policy(paramiko.AutoAddPolicy())
                ssh.connect(hostname=address,username=username,password=password)
                ssh.exec_command('sudo su') # Entro em modo root
                time.sleep(1)
                ssh.exec_command(_caminho) # Entro na pasta
                stdin, stdout, stderr = ssh.exec_command(_status + ' ' + script) #Executo o comando completo status+script
                stdin.close() # Deixar para evitar erros 
                print("Testando o scritp : " + script)
                for line in stdout.readlines():
                    result = (line.replace('\n',''))
                    #print(result)
                    if 'Active' in result:
                        msg = line
                        #print(line)
                        msg = msg.replace(' ',',')
                        msg = msg.split(',')
                        if( msg[7] == '(running)' ):
                            print("Rodando OK!")
                            try:
                                dados = {'condicao': 'rodando', 'nome_service': script }
                                texto = None
                                requisicao = requests.get(url_local,dados)
                                texto = str(requisicao)
                                print(texto[11:14])
                            except Exception as e:
                                print("Requisicao deu erro:", e)
                        else:
                            print("Erro ou desativado, precisa reiniciar!")
                            try:
                                dados = {'condicao': 'rodando', 'nome_service': script }
                                texto = None
                                requisicao = requests.get(url_local,dados)
                                texto = str(requisicao)
                                print(texto[11:14])
                            except Exception as e:
                                print("Requisicao deu erro:", e)
                            ssh.exec_command(_stop + ' ' + script) #Executo o comando completo stop+script
                            print("Desativando o script e aguardando 3 segundos para ativa-lo!")
                            time.sleep(3)
                            ssh.exec_command(_start + ' ' + script) #Executo o comando completo start+script
                            print("Script " + script + " foi ativado, no proximo loop sera verificado!")
                            time.sleep(3)
                ssh.exec_command('exit') # Saio do modo root
                ssh.close() #Fecho a conexao!
            except Exception as e:
                print("Requisicao deu erro:", e)
                main()
            print('Aguardando tempo entre scripts!')
            time.sleep(5)
            
            # ***********************************************************************************************************************************

            try:
                # Verifica o primeiro script *********************************************************************************************************
                #Nome do script desejado a verificar!
                script = 'sincroniza_socket_pires.service'
                ssh = paramiko.SSHClient()
                ssh.set_missing_host_key_policy(paramiko.AutoAddPolicy())
                ssh.connect(hostname=address,username=username,password=password)
                ssh.exec_command('sudo su') # Entro em modo root
                time.sleep(1)
                ssh.exec_command(_caminho) # Entro na pasta
                stdin, stdout, stderr = ssh.exec_command(_status + ' ' + script) #Executo o comando completo status+script
                stdin.close() # Deixar para evitar erros 
                print("Testando o scritp : " + script)
                for line in stdout.readlines():
                    result = (line.replace('\n',''))
                    #print(result)
                    if 'Active' in result:
                        msg = line
                        #print(line)
                        msg = msg.replace(' ',',')
                        msg = msg.split(',')
                        if( msg[7] == '(running)' ):
                            print("Rodando OK!")
                            try:
                                dados = {'condicao': 'rodando', 'nome_service': script }
                                texto = None
                                requisicao = requests.get(url_local,dados)
                                texto = str(requisicao)
                                print(texto[11:14])
                            except Exception as e:
                                print("Requisicao deu erro:", e)
                        else:
                            print("Erro ou desativado, precisa reiniciar!")
                            try:
                                dados = {'condicao': 'rodando', 'nome_service': script }
                                texto = None
                                requisicao = requests.get(url_local,dados)
                                texto = str(requisicao)
                                print(texto[11:14])
                            except Exception as e:
                                print("Requisicao deu erro:", e)
                            ssh.exec_command(_stop + ' ' + script) #Executo o comando completo stop+script
                            print("Desativando o script e aguardando 3 segundos para ativa-lo!")
                            time.sleep(3)
                            ssh.exec_command(_start + ' ' + script) #Executo o comando completo start+script
                            print("Script " + script + " foi ativado, no proximo loop sera verificado!")
                            time.sleep(3)
                ssh.exec_command('exit') # Saio do modo root
                ssh.close() #Fecho a conexao!
            except Exception as e:
                print("Requisicao deu erro:", e)
                main()
            print('Aguardando tempo entre scripts!')
            time.sleep(5)
            
            # ***********************************************************************************************************************************





            try:
                # Verifica o primeiro script *********************************************************************************************************
                #Nome do script desejado a verificar!
                script = 'publica_tora.service'
                ssh = paramiko.SSHClient()
                ssh.set_missing_host_key_policy(paramiko.AutoAddPolicy())
                ssh.connect(hostname=address,username=username,password=password)
                ssh.exec_command('sudo su') # Entro em modo root
                time.sleep(1)
                ssh.exec_command(_caminho) # Entro na pasta
                stdin, stdout, stderr = ssh.exec_command(_status + ' ' + script) #Executo o comando completo status+script
                stdin.close() # Deixar para evitar erros 
                print("Testando o scritp : " + script)
                for line in stdout.readlines():
                    result = (line.replace('\n',''))
                    #print(result)
                    if 'Active' in result:
                        msg = line
                        #print(line)
                        msg = msg.replace(' ',',')
                        msg = msg.split(',')
                        if( msg[7] == '(running)' ):
                            print("Rodando OK!")
                            try:
                                dados = {'condicao': 'rodando', 'nome_service': script }
                                texto = None
                                requisicao = requests.get(url_local,dados)
                                texto = str(requisicao)
                                print(texto[11:14])
                            except Exception as e:
                                print("Requisicao deu erro:", e)
                        else:
                            print("Erro ou desativado, precisa reiniciar!")
                            try:
                                dados = {'condicao': 'rodando', 'nome_service': script }
                                texto = None
                                requisicao = requests.get(url_local,dados)
                                texto = str(requisicao)
                                print(texto[11:14])
                            except Exception as e:
                                print("Requisicao deu erro:", e)
                            ssh.exec_command(_stop + ' ' + script) #Executo o comando completo stop+script
                            print("Desativando o script e aguardando 3 segundos para ativa-lo!")
                            time.sleep(3)
                            ssh.exec_command(_start + ' ' + script) #Executo o comando completo start+script
                            print("Script " + script + " foi ativado, no proximo loop sera verificado!")
                            time.sleep(3)
                ssh.exec_command('exit') # Saio do modo root
                ssh.close() #Fecho a conexao!
            except Exception as e:
                print("Requisicao deu erro:", e)
                main()
            print('Aguardando tempo entre scripts!')
            time.sleep(5)
            
            # ***********************************************************************************************************************************






            try:
                # Verifica o primeiro script *********************************************************************************************************
                #Nome do script desejado a verificar!
                script = 'servidor_socket_balanca1.service'
                ssh = paramiko.SSHClient()
                ssh.set_missing_host_key_policy(paramiko.AutoAddPolicy())
                ssh.connect(hostname=address,username=username,password=password)
                ssh.exec_command('sudo su') # Entro em modo root
                time.sleep(1)
                ssh.exec_command(_caminho) # Entro na pasta
                stdin, stdout, stderr = ssh.exec_command(_status + ' ' + script) #Executo o comando completo status+script
                stdin.close() # Deixar para evitar erros 
                print("Testando o scritp : " + script)
                for line in stdout.readlines():
                    result = (line.replace('\n',''))
                    #print(result)
                    if 'Active' in result:
                        msg = line
                        #print(line)
                        msg = msg.replace(' ',',')
                        msg = msg.split(',')
                        if( msg[7] == '(running)' ):
                            print("Rodando OK!")
                            try:
                                dados = {'condicao': 'rodando', 'nome_service': script }
                                texto = None
                                requisicao = requests.get(url_local,dados)
                                texto = str(requisicao)
                                print(texto[11:14])
                            except Exception as e:
                                print("Requisicao deu erro:", e)
                        else:
                            print("Erro ou desativado, precisa reiniciar!")
                            try:
                                dados = {'condicao': 'rodando', 'nome_service': script }
                                texto = None
                                requisicao = requests.get(url_local,dados)
                                texto = str(requisicao)
                                print(texto[11:14])
                            except Exception as e:
                                print("Requisicao deu erro:", e)
                            ssh.exec_command(_stop + ' ' + script) #Executo o comando completo stop+script
                            print("Desativando o script e aguardando 3 segundos para ativa-lo!")
                            time.sleep(3)
                            ssh.exec_command(_start + ' ' + script) #Executo o comando completo start+script
                            print("Script " + script + " foi ativado, no proximo loop sera verificado!")
                            time.sleep(3)
                ssh.exec_command('exit') # Saio do modo root
                ssh.close() #Fecho a conexao!
            except Exception as e:
                print("Requisicao deu erro:", e)
                main()
            print('Aguardando tempo entre scripts!')
            time.sleep(5)
            
            # ***********************************************************************************************************************************





            try:
                # Verifica o primeiro script *********************************************************************************************************
                #Nome do script desejado a verificar!
                script = 'sincroniza_socket_balanca1.service'
                ssh = paramiko.SSHClient()
                ssh.set_missing_host_key_policy(paramiko.AutoAddPolicy())
                ssh.connect(hostname=address,username=username,password=password)
                ssh.exec_command('sudo su') # Entro em modo root
                time.sleep(1)
                ssh.exec_command(_caminho) # Entro na pasta
                stdin, stdout, stderr = ssh.exec_command(_status + ' ' + script) #Executo o comando completo status+script
                stdin.close() # Deixar para evitar erros 
                print("Testando o scritp : " + script)
                for line in stdout.readlines():
                    result = (line.replace('\n',''))
                    #print(result)
                    if 'Active' in result:
                        msg = line
                        #print(line)
                        msg = msg.replace(' ',',')
                        msg = msg.split(',')
                        if( msg[7] == '(running)' ):
                            print("Rodando OK!")
                            try:
                                dados = {'condicao': 'rodando', 'nome_service': script }
                                texto = None
                                requisicao = requests.get(url_local,dados)
                                texto = str(requisicao)
                                print(texto[11:14])
                            except Exception as e:
                                print("Requisicao deu erro:", e)
                        else:
                            print("Erro ou desativado, precisa reiniciar!")
                            try:
                                dados = {'condicao': 'rodando', 'nome_service': script }
                                texto = None
                                requisicao = requests.get(url_local,dados)
                                texto = str(requisicao)
                                print(texto[11:14])
                            except Exception as e:
                                print("Requisicao deu erro:", e)
                            ssh.exec_command(_stop + ' ' + script) #Executo o comando completo stop+script
                            print("Desativando o script e aguardando 3 segundos para ativa-lo!")
                            time.sleep(3)
                            ssh.exec_command(_start + ' ' + script) #Executo o comando completo start+script
                            print("Script " + script + " foi ativado, no proximo loop sera verificado!")
                            time.sleep(3)
                ssh.exec_command('exit') # Saio do modo root
                ssh.close() #Fecho a conexao!
            except Exception as e:
                print("Requisicao deu erro:", e)
                main()
            print('Aguardando tempo entre scripts!')
            time.sleep(5)
            
            # ***********************************************************************************************************************************






            try:
                # Verifica o primeiro script *********************************************************************************************************
                #Nome do script desejado a verificar!
                script = 'sincroniza_socket_saida_automacoes.service'
                ssh = paramiko.SSHClient()
                ssh.set_missing_host_key_policy(paramiko.AutoAddPolicy())
                ssh.connect(hostname=address,username=username,password=password)
                ssh.exec_command('sudo su') # Entro em modo root
                time.sleep(1)
                ssh.exec_command(_caminho) # Entro na pasta
                stdin, stdout, stderr = ssh.exec_command(_status + ' ' + script) #Executo o comando completo status+script
                stdin.close() # Deixar para evitar erros 
                print("Testando o scritp : " + script)
                for line in stdout.readlines():
                    result = (line.replace('\n',''))
                    #print(result)
                    if 'Active' in result:
                        msg = line
                        #print(line)
                        msg = msg.replace(' ',',')
                        msg = msg.split(',')
                        if( msg[7] == '(running)' ):
                            print("Rodando OK!")
                            try:
                                dados = {'condicao': 'rodando', 'nome_service': script }
                                texto = None
                                requisicao = requests.get(url_local,dados)
                                texto = str(requisicao)
                                print(texto[11:14])
                            except Exception as e:
                                print("Requisicao deu erro:", e)
                        else:
                            print("Erro ou desativado, precisa reiniciar!")
                            try:
                                dados = {'condicao': 'rodando', 'nome_service': script }
                                texto = None
                                requisicao = requests.get(url_local,dados)
                                texto = str(requisicao)
                                print(texto[11:14])
                            except Exception as e:
                                print("Requisicao deu erro:", e)
                            ssh.exec_command(_stop + ' ' + script) #Executo o comando completo stop+script
                            print("Desativando o script e aguardando 3 segundos para ativa-lo!")
                            time.sleep(3)
                            ssh.exec_command(_start + ' ' + script) #Executo o comando completo start+script
                            print("Script " + script + " foi ativado, no proximo loop sera verificado!")
                            time.sleep(3)
                ssh.exec_command('exit') # Saio do modo root
                ssh.close() #Fecho a conexao!
            except Exception as e:
                print("Requisicao deu erro:", e)
                main()
            print('Aguardando tempo entre scripts!')
            time.sleep(5)
            
            # ***********************************************************************************************************************************





            try:
                # Verifica o primeiro script *********************************************************************************************************
                #Nome do script desejado a verificar!
                script = 'sincroniza_socket_saida.service'
                ssh = paramiko.SSHClient()
                ssh.set_missing_host_key_policy(paramiko.AutoAddPolicy())
                ssh.connect(hostname=address,username=username,password=password)
                ssh.exec_command('sudo su') # Entro em modo root
                time.sleep(1)
                ssh.exec_command(_caminho) # Entro na pasta
                stdin, stdout, stderr = ssh.exec_command(_status + ' ' + script) #Executo o comando completo status+script
                stdin.close() # Deixar para evitar erros 
                print("Testando o scritp : " + script)
                for line in stdout.readlines():
                    result = (line.replace('\n',''))
                    #print(result)
                    if 'Active' in result:
                        msg = line
                        #print(line)
                        msg = msg.replace(' ',',')
                        msg = msg.split(',')
                        if( msg[7] == '(running)' ):
                            print("Rodando OK!")
                            try:
                                dados = {'condicao': 'rodando', 'nome_service': script }
                                texto = None
                                requisicao = requests.get(url_local,dados)
                                texto = str(requisicao)
                                print(texto[11:14])
                            except Exception as e:
                                print("Requisicao deu erro:", e)
                        else:
                            print("Erro ou desativado, precisa reiniciar!")
                            try:
                                dados = {'condicao': 'rodando', 'nome_service': script }
                                texto = None
                                requisicao = requests.get(url_local,dados)
                                texto = str(requisicao)
                                print(texto[11:14])
                            except Exception as e:
                                print("Requisicao deu erro:", e)
                            ssh.exec_command(_stop + ' ' + script) #Executo o comando completo stop+script
                            print("Desativando o script e aguardando 3 segundos para ativa-lo!")
                            time.sleep(3)
                            ssh.exec_command(_start + ' ' + script) #Executo o comando completo start+script
                            print("Script " + script + " foi ativado, no proximo loop sera verificado!")
                            time.sleep(3)
                ssh.exec_command('exit') # Saio do modo root
                ssh.close() #Fecho a conexao!
            except Exception as e:
                print("Requisicao deu erro:", e)
                main()
            print('Aguardando tempo entre scripts!')
            time.sleep(5)
            
            # ***********************************************************************************************************************************




            try:
                # Verifica o primeiro script *********************************************************************************************************
                #Nome do script desejado a verificar!
                script = 'servidor_socket_poste_balanca1.service'
                ssh = paramiko.SSHClient()
                ssh.set_missing_host_key_policy(paramiko.AutoAddPolicy())
                ssh.connect(hostname=address,username=username,password=password)
                ssh.exec_command('sudo su') # Entro em modo root
                time.sleep(1)
                ssh.exec_command(_caminho) # Entro na pasta
                stdin, stdout, stderr = ssh.exec_command(_status + ' ' + script) #Executo o comando completo status+script
                stdin.close() # Deixar para evitar erros 
                print("Testando o scritp : " + script)
                for line in stdout.readlines():
                    result = (line.replace('\n',''))
                    #print(result)
                    if 'Active' in result:
                        msg = line
                        #print(line)
                        msg = msg.replace(' ',',')
                        msg = msg.split(',')
                        if( msg[7] == '(running)' ):
                            print("Rodando OK!")
                            try:
                                dados = {'condicao': 'rodando', 'nome_service': script }
                                texto = None
                                requisicao = requests.get(url_local,dados)
                                texto = str(requisicao)
                                print(texto[11:14])
                            except Exception as e:
                                print("Requisicao deu erro:", e)
                        else:
                            print("Erro ou desativado, precisa reiniciar!")
                            try:
                                dados = {'condicao': 'rodando', 'nome_service': script }
                                texto = None
                                requisicao = requests.get(url_local,dados)
                                texto = str(requisicao)
                                print(texto[11:14])
                            except Exception as e:
                                print("Requisicao deu erro:", e)
                            ssh.exec_command(_stop + ' ' + script) #Executo o comando completo stop+script
                            print("Desativando o script e aguardando 3 segundos para ativa-lo!")
                            time.sleep(3)
                            ssh.exec_command(_start + ' ' + script) #Executo o comando completo start+script
                            print("Script " + script + " foi ativado, no proximo loop sera verificado!")
                            time.sleep(3)
                ssh.exec_command('exit') # Saio do modo root
                ssh.close() #Fecho a conexao!
            except Exception as e:
                print("Requisicao deu erro:", e)
                main()
            print('Aguardando tempo entre scripts!')
            time.sleep(5)
            
            # ***********************************************************************************************************************************





            try:
                # Verifica o primeiro script *********************************************************************************************************
                #Nome do script desejado a verificar!
                script = 'verifica_validacoes_gagf.service'
                ssh = paramiko.SSHClient()
                ssh.set_missing_host_key_policy(paramiko.AutoAddPolicy())
                ssh.connect(hostname=address,username=username,password=password)
                ssh.exec_command('sudo su') # Entro em modo root
                time.sleep(1)
                ssh.exec_command(_caminho) # Entro na pasta
                stdin, stdout, stderr = ssh.exec_command(_status + ' ' + script) #Executo o comando completo status+script
                stdin.close() # Deixar para evitar erros 
                print("Testando o scritp : " + script)
                for line in stdout.readlines():
                    result = (line.replace('\n',''))
                    #print(result)
                    if 'Active' in result:
                        msg = line
                        #print(line)
                        msg = msg.replace(' ',',')
                        msg = msg.split(',')
                        if( msg[7] == '(running)' ):
                            print("Rodando OK!")
                            try:
                                dados = {'condicao': 'rodando', 'nome_service': script }
                                texto = None
                                requisicao = requests.get(url_local,dados)
                                texto = str(requisicao)
                                print(texto[11:14])
                            except Exception as e:
                                print("Requisicao deu erro:", e)
                        else:
                            print("Erro ou desativado, precisa reiniciar!")
                            try:
                                dados = {'condicao': 'rodando', 'nome_service': script }
                                texto = None
                                requisicao = requests.get(url_local,dados)
                                texto = str(requisicao)
                                print(texto[11:14])
                            except Exception as e:
                                print("Requisicao deu erro:", e)
                            ssh.exec_command(_stop + ' ' + script) #Executo o comando completo stop+script
                            print("Desativando o script e aguardando 3 segundos para ativa-lo!")
                            time.sleep(3)
                            ssh.exec_command(_start + ' ' + script) #Executo o comando completo start+script
                            print("Script " + script + " foi ativado, no proximo loop sera verificado!")
                            time.sleep(3)
                ssh.exec_command('exit') # Saio do modo root
                ssh.close() #Fecho a conexao!
            except Exception as e:
                print("Requisicao deu erro:", e)
                main()
            print('Aguardando tempo entre scripts!')
            time.sleep(5)
            
            # ***********************************************************************************************************************************




            # ***********************************************************************************************************************************

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