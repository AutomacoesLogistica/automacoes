import socketserver
import requests
import time
url_local = 'http://192.168.10.96/automacoes_poste_saida/verifica_tempo_services.php'

    
def main():
    try:
        if __name__ == "__main__":
          print ("Checando!")
          #Agora vaço uma requisicao
          dados = {'mensagem': 'validar_dados'} #envio algo so por enviar, nao usa para nada, esse é apenas para iniciar o script!
          try:
            requisicao = requests.get(url_local,dados)
            #para POST mudar .get para .post
            texto = str(requisicao)
            print(texto[11:14])
          except Exception as e:
            print("Requisicao deu erro:", e)
       
        
    except Exception as e:
        print(e)
        main()
    time.sleep(600) # Espera 10 minutos e revalida tudo! 

for i in range(1, 1000000000):
  try:
    main()
  except Exception as e:
    print(e)
    print("Restarting!")
    main()
