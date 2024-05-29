import paramiko #importa para criar a conexao ssh
#para instalar basta digitar >>>> sudo apt install python3-paramiko
import time # biblioteca nativa para ter delay
import requests


host = '192.168.10.3'
porta = 22
username = 'admin'
password = 'logistica2019@@'


def copiar_arquivo_ssh(origem, destino, host, porta, username, password):
    ssh = paramiko.SSHClient()
    ssh.set_missing_host_key_policy(paramiko.AutoAddPolicy())
    ssh.connect(host, port=porta, username=username, password=password)

    sftp = ssh.open_sftp()
    # Listar arquivos do diretório remoto
    diretorio_remoto = '/'

    arquivos = sftp.listdir(diretorio_remoto)

    # Exibir os arquivos
    for arquivo in arquivos:
        print(arquivo)


    sftp.close()
    ssh.close()
    print("FIM")
    time.sleep(20000)



def main():
    try:
        
        while(1):
            try:
                # Verifica o primeiro script *********************************************************************************************************
                #Nome do script desejado a verificar!
                script = 'servidor_socket_pires.service'
                ssh = paramiko.SSHClient()
                ssh.set_missing_host_key_policy(paramiko.AutoAddPolicy())
                ssh.connect(hostname=host,username=username,password=password)
                nome_radio = ""
                #Executo o comando para pegar o nome do equipamento
                script = '/system identity print'
                stdin, stdout, stderr = ssh.exec_command(script) #Executo o comando completo status+script
                stdin.close() # Deixar para evitar erros 
                
                for line in stdout.readlines():
                    result = (line.replace('\n',''))
                    #print(result)
                    nome_radio = nome_radio + str(result)
                
                nome_radio = nome_radio.split(':')
                #print(nome_radio)
                nome_radio = str(nome_radio[1]).strip()
                print("O nome do radio e >" + str(nome_radio))
                nome_backup = nome_radio.replace(" ", "_")
                ssh.close() #Fecho a conexao!
            except Exception as e:
                print("Requisicao deu erro:", e)
                main()

            time.sleep(2)
            #executo o comando para realizar o backup ****************************************************************************************
            try:
                
                ssh = paramiko.SSHClient()
                ssh.set_missing_host_key_policy(paramiko.AutoAddPolicy())
                ssh.connect(hostname=host,username=username,password=password)
                script = '/export file=' + nome_backup + '.rsc'
                print(script)
                stdin, stdout, stderr = ssh.exec_command(script) #Executo o comando completo status+script
                stdin.close() # Deixar para evitar erros 
                for line in stdout.readlines():
                    result = (line.replace('\n',''))
                    print(result)
                ssh.close() #Fecho a conexao! 
                print("Efetuado backup!")
                print("")
                print("Agora vamos realizar a copia do arquivo do radio para o PC") 
                
            except Exception as e:
                print("Requisicao deu erro:", e)
                main()

            # Agora faco a copia para o PC ****************************************************************************************************
            try:
                ssh = paramiko.SSHClient()
                ssh.set_missing_host_key_policy(paramiko.AutoAddPolicy())
                ssh.connect(host, port=porta, username=username, password=password)
                sftp = ssh.open_sftp()
                # Listar arquivos do diretório remoto
                diretorio_remoto = '/'
                #arquivos = sftp.listdir(diretorio_remoto)
                # Exibir os arquivos
                #for arquivo in arquivos:
                #   print(arquivo)
                conteudo = "" # Vai salvar toda a configuracao aqui dentro!

                arquivo = diretorio_remoto + nome_backup + '.rsc'
                with sftp.open(arquivo,'rb+') as arquivo:
                    conteudo = arquivo.read()
                    conteudo=str(conteudo,'utf-8')
                    #print(conteudo)
                tamanho = len(conteudo)
                print("Tamanho = " + str(tamanho)) 
                print("Teste = \n" + str(conteudo)     )
                
                print("")
                print("")
                print("")
                origem = '/'
                
                destino = '/home/pc/automacao/mk/backups/'
                
                destino2 = destino + nome_backup + '.rsc'
                
                
                #sftp.put('/', destino) # comando para copiar o arquivo do radio para a pasta do pc
                sftp.close()
                ssh.close()
            except Exception as e:
                print("Requisicao deu erro:", e)
                main() 
                
                #agora faço a conexao no proprio pc
            try:
                ssh = paramiko.SSHClient()
                ssh.set_missing_host_key_policy(paramiko.AutoAddPolicy())
                ssh.connect('192.168.10.96', port=porta, username='root', password='logistica2019@@')
                sftp = ssh.open_sftp()
                # Listar arquivos do diretório remoto
                diretorio_remoto = destino
                #arquivos = sftp.listdir(diretorio_remoto)
                # Exibir os arquivos
                #for arquivo in arquivos:
                #   print(arquivo)
                

                #Agora salvo os dados 
                caminho_arquivo = destino2
                with sftp.open(caminho_arquivo,'w+') as arquivo:
                    arquivo.write(conteudo)

                sftp.close()  
                ssh.close()
            except Exception as e:
                print("Requisicao deu erro:", e)
                main()  
                
                print("FIM")

           

            time.sleep(20000)


                
            





























            print('')
            print('')
            print('Aguardando tempo para testar todos novamente!')
            print('')
            print('')
            time.sleep(5)
    except Exception as e:
        print(e)
        main()




for i in range(1, 1000000000):
  try:
    main()
    #copiar_arquivo_ssh(origem, destino, host, porta, username, password)
  except Exception as e:
    print(e)
    print("Restarting!")
    main()