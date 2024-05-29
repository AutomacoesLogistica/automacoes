import base64

caminho_origem = "C:/Users/EACO-MANUTENCAO/Desktop/teste/foto.bin";  
caminho_saida = "C:/Users/EACO-MANUTENCAO/Desktop/teste/";
caminho_saida = caminho_saida + "nome_do_arquivo.jpg";
print(caminho_saida);
file = open(caminho_origem, 'rb') 
byte = file.read() 
file.close() 
  
decodeit = open(caminho_saida, 'wb') 
decodeit.write(base64.b64decode((byte))) 
decodeit.close() 