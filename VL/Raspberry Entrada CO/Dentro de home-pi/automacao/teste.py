import requests

#Chamo para atualizar e buscar as placas
url_local = 'http://192.168.30.124/dips/validacao_match.php'
texto = None
try:
    requisicao = requests.get(url_local)
    texto = str(requisicao)
    resposta =(texto[11:14])
    if( resposta == "200"):
        print("Request ok!")
    else:
        print ("Erro request!")
except Exception as e:
    print("Requisicao deu erro:", e)