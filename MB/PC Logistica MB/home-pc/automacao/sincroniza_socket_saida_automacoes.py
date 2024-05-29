import requests
import mysql.connector
import time
from time import gmtime, strftime


url_local = 'http://192.168.10.96/dashboard_utmi/saida_automacoes/saida_automacoes.php'
url_local2 = 'http://192.168.10.96/sockets/saida_automacoes/testa_tag_gagf.php'
url_local3 = 'http://192.168.10.96/sockets/saida_automacoes/atualiza_hora.php'
url_local4 = 'http://192.168.10.96/sockets/saida_automacoes/valida_math_socket.php' # Sincronismo atualizado setembro 2023
url_local5 = 'http://192.168.10.96/sockets/saida_automacoes/responde_hora.php'

#url_local6 = 'http://192.168.10.96/automacoes_poste_saida/verifica_condicao_saida.php'
#url_local7 = 'http://192.168.10.96/automacoes_poste_saida/validacao_math_saida.php'


ultima_epc_carreta_balanca = ""

mydb = mysql.connector.connect(
    host="localhost",#nao mudar para localhost
    user="admin",
    password="Logistica2019@@",
    database="bd_poste_balanca1"
)



mydb2 = mysql.connector.connect(
    host="localhost",#nao mudar para localhost
    user="admin",
    password="Logistica2019@@",
    database="bd_saida"
)




def main():
    try:
      while(1):
          data_completa = ''
          try:
            #url_local5 = 'http://192.168.10.96/sockets/saida_automacoes/responde_hora.php'
            dados = {'a': 'a'}
            texto = None
            requisicao = requests.get(url_local5,dados)
            texto = str(requisicao.content)
            mensagem = texto
            if(mensagem.startswith('b') and len(mensagem)>9 ):
              if(mensagem.endswith("'")):
                dado = (mensagem[2:len(mensagem)-1])
                dado = dado.split(':')
                data_completa = (dado[1])
            print(data_completa)
          except Exception as e:
            print("Requisicao deu erro:", e)
            main()

          time.sleep(1)

          if(data_completa != ''):
            #BUSCA SE EXISTE ACIONAMENTOS PARA SEREM REALIZADOS
            mycursor = mydb.cursor()
            mycursor.execute("SELECT * FROM validacoes_socket WHERE (data_leitura='%s' AND condicao='pendente') ORDER BY id Asc LIMIT 1" %str(data_completa) )
            y = 0
            myresult = mycursor.fetchall()
            print("")
            print("")
            for x in myresult:
              y=y+1
              if(y>0): #Trata apenas o primeiro
                id = x[0]
                epc = x[1]
                ponto = x[3]
                condicao = x[6]
                print(condicao)

                if(condicao == 'pendente'):
                  #Mando publicar para fazer as validacoes do dashboard
                  ponto = 'Saida Automações'
                  try:
                    #url_local = 'http://192.168.10.96/dashboard_utmi/saida_automacoes/saida_automacoes.php'
                    dados = {'epc': epc , 'rodar': ponto}
                    texto = None
                    print ('ID : ' + str(id))
                    requisicao = requests.get(url_local,dados)
                    texto = str(requisicao)
                    print(texto[11:14])
                  except Exception as e:
                    print("Requisicao deu erro:", e)
                    main()

                  time.sleep(0.5)

                  try:
                    #url_local2 = 'http://192.168.10.96/sockets/saida_automacoes/testa_tag_gagf.php'
                    dados = {'epc': epc , 'rodar': ponto}
                    texto = None
                    print ('ID : ' + str(id))
                    requisicao = requests.get(url_local2,dados)
                    texto = str(requisicao)
                    print(texto[11:14])
                  except Exception as e:
                    print("Requisicao deu erro:", e)
                    main()

                  time.sleep(0.5)

                  try:
                    #url_local4 = 'http://192.168.10.96/sockets/saida_automacoes/valida_math_socket.php' # Sincronismo atualizado setembro 2023
                    dados = {'epc': epc , 'rodar': ponto, 'id': id}
                    texto = None
                    print ('ID : ' + str(id))
                    requisicao = requests.get(url_local4,dados)
                    texto = str(requisicao)
                    print(texto[11:14])
                  except Exception as e:
                    print("Requisicao deu erro:", e)
                    main()

                else:
                  print("Erro na condicao, diferente de pendente!")    
              else:
                y=0 # Nao apagar        
                time.sleep(2)
            if y<=0:
              print('sem solicitacoes')
              time.sleep(5)
            mydb.commit()
          else:
            print("Erro ao buscar a data!")
            time.sleep(5)

          #ATUALIZA SERVICE **********************************************************************************************
          try:
            #url_local3 = 'http://192.168.10.96/sockets/saida_automacoes/atualiza_hora.php'
            dados = {'a': 'a'}
            texto = None
            requisicao = requests.get(url_local3,dados)
            texto = str(requisicao)
            print(texto[11:14])
          except Exception as e:
            print("Requisicao deu erro:", e)
            main()
          time.sleep(1)













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





