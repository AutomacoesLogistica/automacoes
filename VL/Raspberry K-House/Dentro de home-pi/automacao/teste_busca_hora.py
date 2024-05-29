import requests

url = 'http://192.168.30.124/dips/responde_hora.php'
x = requests.get(url)
mensagem = str(x.content)
if(mensagem.startswith('b')):
    if(mensagem.endswith("'")):
        dado = (mensagem[2:len(mensagem)-1])
        dado = dado.split(';')
        data = (dado[0])
        hora = (dado[1])
        print(data)
        print(hora)
      