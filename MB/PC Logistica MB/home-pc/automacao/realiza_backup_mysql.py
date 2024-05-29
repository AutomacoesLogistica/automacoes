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
        
        comando = 'mysqldump -u root -p ' 
        banco = 'radius'
        complemento = '>' 
        destino_backup = '/home/pc/backups/'
        complemento_nome_backup = '.sql'
        comando_completo = ''

        while(1):
            try:
                # Verifica o primeiro script *********************************************************************************************************
                #Nome do script desejado a verificar!
                comando = 'mysqldump -u -p ' 
                banco = 'bd_dashboard'
                complemento = '>' 
                destino_backup = '/home/pc/backups/'
                nome_backup = 'radius' 
                complemento_nome_backup = '.sql'
                
                #Comando para realizar o backup
                comando_completo = comando + banco + complemento + destino_backup + banco + complemento_nome_backup

                ssh = paramiko.SSHClient()
                ssh.set_missing_host_key_policy(paramiko.AutoAddPolicy())
                ssh.connect(hostname=address,username=username,password=password)
                ssh.exec_command('sudo su') # Entro em modo root
                time.sleep(1)
                stdin, stdout, stderr = ssh.exec_command(comando_completo) #Executo o comando completo status+script
                
                time.sleep(10)
                stdin.close() # Deixar para evitar erros 
                
                ssh.exec_command('exit') # Saio do modo root
                ssh.close() #Fecho a conexao!
            except Exception as e:
                print("Requisicao deu erro:", e)
                main()
            print('Aguardando tempo entre scripts!')
            time.sleep(86400000)

            print('Aguardando tempo!')

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