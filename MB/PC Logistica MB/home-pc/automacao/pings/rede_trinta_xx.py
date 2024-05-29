import mysql.connector
import os
import time



mydb = mysql.connector.connect(
  host="localhost",
  user="admin",
  password="Logistica2019@@",
  database="bd_portal_gestao"
)

mydb2 = mysql.connector.connect(
  host="localhost",
  user="admin",
  password="Logistica2019@@",
  database="bd_portal_gestao"
)


def main():
    try:
      while(1):
        nome_rede = "rede_trinta_xx"
        qnt_online = 0
        qnt_offline = 0
        qnt_bloqueado = 0
        qnt_disponivel_sim = 0
        qnt_camera = 0
        qnt_radios = 0
        qnt_gerenciavel = 0
        qnt_nvr = 0
        qnt_reader = 0
        qnt_raspberry = 0
        vezes_ping = 10

        mycursor = mydb.cursor()
        mycursor.execute(f"SELECT * FROM {nome_rede} LIMIT 254")

        for x in mycursor:
          id = x[0]
          IP = x[2]
          tipo = x[6]
          ativo = x[8]
          status = x[9]
          disponivel = x[12]
          
          # Mapeio se esta diisponivel ou nao ***********************************************************************************************
          if(disponivel == "Sim"):
            qnt_disponivel_sim = int(qnt_disponivel_sim) + 1
          
          
          # Mapeio se esta ONLINE ou OFFLINE ou BLOQUEADO ***********************************************************************************
          if(status == "Online"):
            print(">>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>Status = " + status)
            qnt_online = int(qnt_online) + 1  
          elif(status == "Offline"):
            print(">>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>Status = " + status)
            qnt_offline = int(qnt_offline) + 1
          else:
            qnt_bloqueado = int(qnt_bloqueado) + 1
 
          
          # Mapeio o tipo do equipamento ****************************************************************************************************
          if(tipo == "Câmera" or tipo == "PTZ"):
            qnt_camera = int(qnt_camera) + 1
          elif(tipo == "Base Box" or tipo == "Groove" or tipo ==  "Rádio" or tipo ==  "Rede" or tipo == "SXT"):
            qnt_radios = int(qnt_radios) + 1
          elif(tipo == "Switch Gerenciavel"):
            qnt_gerenciavel = int(qnt_gerenciavel) + 1
          elif(tipo == "NVR"):
            qnt_nvr = int(qnt_nvr) + 1
          elif(tipo == "Raspberry/TV"):
            qnt_raspberry = int(qnt_raspberry) + 1
          elif(tipo == "Reader"):
            qnt_reader = int(qnt_reader) + 1


          if(ativo == "Sim"): # Pode validar o IP
            response = os.system("ping -c "+ str(vezes_ping) + " " + IP)
            if response == 0:
                print("Esta OK o IP: " + IP)
                condicao = "Online"
                try:
                  mycursor2 = mydb2.cursor()
                  mycursor2.execute(f"UPDATE {nome_rede} SET status='{condicao}'WHERE id='{id}'" )
                  mydb2.commit() 
                except Exception as e:
                  print(e)
                  main()

            else:
                print("Esta fora o IP: " + IP)
                condicao = "Offline"
                try:
                  mycursor2 = mydb2.cursor()
                  mycursor2.execute(f"UPDATE {nome_rede} SET status='{condicao}'WHERE id='{id}'" )
                  mydb2.commit() 
                except Exception as e:
                  print(e)
                  main()

          else:
              condicao = "Bloqueado"
              try:
                mycursor2 = mydb2.cursor()
                mycursor2.execute(f"UPDATE {nome_rede} SET status='{condicao}'WHERE id='{id}'" )
                mydb2.commit()
              except Exception as e:
                print(e)
                main()
          
        mydb.commit()
        # Agora atualizo os dados na tabela
        mycursor2 = mydb2.cursor()
        mycursor2.execute(f"UPDATE resumo_rede SET qnt_online='{qnt_online}', qnt_offline='{qnt_offline}', qnt_bloqueado='{qnt_bloqueado}', qnt_disponivel_sim='{qnt_disponivel_sim}', qnt_camera='{qnt_camera}', qnt_radios='{qnt_radios}', qnt_switch_gerenciavel='{qnt_gerenciavel}', qnt_nvr='{qnt_nvr}', qnt_reader='{qnt_reader}', qnt_raspberry='{qnt_raspberry}'           WHERE nome_rede='{nome_rede}'" )
        mydb2.commit()
        print("Fim") 
        time.sleep(5)
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
