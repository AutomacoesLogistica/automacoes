import requests
import mysql.connector
import time
from time import gmtime, strftime

def main():
  url_local = 'http://192.168.30.124/dips/valida_tag_tora_fjx.php'
  mydb = mysql.connector.connect(
    host="192.168.30.124",#nao mudar para localhost
    user="admin",
    password="logistica2019@@",
    database="bd_dashboard"
  )
  while(1):
    try:
      #BUSCA SE EXISTE ACIONAMENTOS PARA SEREM REALIZADOS
      mycursor = mydb.cursor()
      mycursor.execute("SELECT * FROM validacoes_tags_tora_fjx WHERE validado = 'pendente' ORDER BY id DESC LIMIT 1")
      y = 0
      myresult = mycursor.fetchall()
      for x in myresult:
        y=y+1
        if(y==1):
          id_tabela = x[0]
          epc = x[1]
          if(len(epc)==24 or len(epc)==7):
            print("Tratando ID = " + str(id_tabela) + " -  EPC = " + str(epc))
            try:
              dados = {'epc': epc,'id': id_tabela}
              texto = None
              requisicao = requests.get(url_local,dados)
              url = 'http://192.168.30.124/dips/responde_hora.php'
              status = str(requisicao)
              response = str(requisicao.content)
              print(status[11:14])
              print(response)
            except Exception as e:
              print("Requisicao deu erro:", e)
              main()
            mydb.commit()
          
          
          
      if y<=0:
        print('sem solicitacoes')
      mydb.commit()
      try:
        url = 'http://192.168.30.124/dips/responde_hora.php'
        x = requests.get(url)
        mensagem = str(x.content)
        if(mensagem.startswith('b')):
          if(mensagem.endswith("'")):
            dado = (mensagem[2:len(mensagem)-1])
            dado = dado.split(';')
            data = (dado[0])
            hora = (dado[1])
            print(data + " " + hora)
            if((len(str(data)))==10 and (len(str(hora)))==8):
              try:
                print("Atualizando horario!")
                mycursor = mydb.cursor()
                #Atualizando dados do service> verifica_tag_tora_ou_fjx.service
                sql = "UPDATE atualizacao_services SET data_atualizacao = %s, hora_atualizacao = %s WHERE id = 1"
                val = (data, hora)
                mycursor.execute(sql,val)
                mydb.commit()
              except Exception as e:
                print("Requisicao deu erro:", e)
                main()
      except Exception as e:
        print("Requisicao deu erro:", e)
        main()
    except Exception as e:
      print("Requisicao deu erro:", e)
      main()
    time.sleep(2)
  


for i in range(1, 1000000000):
  try:
    main()
  except Exception as e:
    print(e)
    print("Restarting!")
    main()

