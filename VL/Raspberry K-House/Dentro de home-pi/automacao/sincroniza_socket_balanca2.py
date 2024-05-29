import requests
import mysql.connector
import time
from time import gmtime, strftime

def main():
  url_local = 'http://192.168.30.124/dashboard/balanca2/validacao_match.php'
  ultima_epc_carreta_balanca = ""
  mydb = mysql.connector.connect(
    host="192.168.30.124",#nao mudar para localhost
    user="admin",
    password="logistica2019@@",
    database="bd_balanca2"
  )
  while(1):
    #BUSCA SE EXISTE ACIONAMENTOS PARA SEREM REALIZADOS
    try:
      mycursor = mydb.cursor()
      mycursor.execute("SELECT * FROM validacoes_socket WHERE condicao = 'pendente' ORDER BY id DESC LIMIT 1")
      y = 0
      myresult = mycursor.fetchall()
      for x in myresult:
        y=y+1
        if(y==1):
          id = x[0]
          epc = x[1]
          ponto = x[3]
          if(epc != ultima_epc_carreta_balanca):
            ultima_epc_carreta_balanca = epc
            #Agora adiciono no historico math
            if(ponto == "balanca"):
              try:
                mycursor = mydb.cursor()
                sql = "INSERT INTO historico_match (epc_cavalo,placa_cavalo,epc_carreta,placa_carreta,ponto,tratado) VALUES (%s, %s, %s, %s, %s, %s)"
                msg = ("-","-",ultima_epc_carreta_balanca,"-","balanca","nao",);
                mycursor.execute(sql,msg);
                mydb.commit()
              except Exception as e:
                print("Requisicao deu erro:", e)
                main()
            else:
              try:
                mycursor = mydb.cursor()
                sql = "INSERT INTO historico_match (epc_cavalo,placa_cavalo,epc_carreta,placa_carreta,ponto,tratado) VALUES (%s, %s, %s, %s, %s, %s)"
                msg = ("-","-",ultima_epc_carreta_balanca,"-","mg","nao",);
                mycursor.execute(sql,msg);
                mydb.commit()
              except Exception as e:
                print("Requisicao deu erro:", e)
                main()
            try:
              dados = {'epc': epc , 'rodar': ponto}
              texto = None
              print ('ID : ' + str(id))
              requisicao = requests.get(url_local,dados)
              texto = str(requisicao)
              print(texto[11:14])
            except Exception as e:
              print("Requisicao deu erro:", e)
              main()

          try:
            #apago a linha
            #Agora apaga a linnha
            mycursor = mydb.cursor()
            sql = "UPDATE validacoes_socket SET condicao = 'Tratado' WHERE id = %s" %id
            mycursor.execute(sql)
            mydb.commit()
          except Exception as e:
            print("Requisicao deu erro:", e)
            main()
        else:
          y=0 # Nao apagar        
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
            if((len(str(data)))==10 and (len(str(hora)))==8):
              try:
                print("Atualizando horario!")
                mycursor = mydb.cursor()
                #Atualizando dados do service> servidor_socket_balanca2.service
                sql = "UPDATE atualizacao_services SET data_atualizacao = %s, hora_atualizacao = %s WHERE id = 3"
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
