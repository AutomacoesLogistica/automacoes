
import socket
import sys
import time
import binascii

# Create a TCP/IP socket
#sock = socket.socket(socket.AF_INET, socket.SOCK_STREAM,socket.IPPROTO_TCP)

# Connect the socket to the port where the server is listening
#server_address = ('192.168.10.100', 2101)
#print('connecting to {} port {}'.format(*server_address))

with socket.socket(socket.AF_INET, socket.SOCK_STREAM) as s:
    s.connect(('192.168.10.100', 2101))
    
    #Em Desenvolvimento!
    message='01 02 50 01 01 AA 01 01 82 01 01 00 32 AA 10 AA 70 AA 01 45 6D 20 64 65 73 65 6E 76 6F 6C 76 69 6D 65 6E 74 6F 21 AA 10 AA 70 AA 02 20 20 20 20 20 20 20 20 20 20 20 20 20 20 20 20 20 20 20 03 07 F8'
    s.sendall(bytes.fromhex(message))
    time.sleep(2)

    #Efetuando testes
    message='01 02 50 01 01 AA 01 01 82 01 01 00 32 AA 10 AA 70 AA 01 45 66 65 74 75 61 6E 64 6F 20 20 20 20 20 20 20 20 20 20 AA 10 AA 70 AA 02 74 65 73 74 65 73 20 20 20 20 20 20 20 20 20 20 20 20 20 03 18 34'
    s.sendall(bytes.fromhex(message))
    time.sleep(2)
    
    #Atencao: Carga descentralizada!
    message='01 02 50 01 01 AA 01 01 82 01 01 00 32 AA 10 AA 70 AA 01 20 20 41 74 65 6E 63 61 6F 3A 20 43 61 72 67 61 20 20 20 AA 10 AA 70 AA 02 20 20 64 65 73 63 65 6E 74 72 61 6C 69 7A 61 64 61 21 20 03 D2 3F'
    s.sendall(bytes.fromhex(message))
    time.sleep(3)
    
    #Dirija-se ao patio de excessos!
    message='01 02 50 01 01 AA 01 01 82 01 01 00 32 AA 10 AA 70 AA 01 44 69 72 69 6A 61 2D 73 65 20 61 6F 20 70 61 74 69 6F 20 AA 10 AA 70 AA 02 64 65 20 65 78 63 65 73 73 6F 73 21 20 20 20 20 20 20 20 03 19 50'
    s.sendall(bytes.fromhex(message))
    time.sleep(3)
    
    #Tenha uma boa viagem teste
    message='01 02 50 01 01 AA 01 01 82 01 01 00 32 AA 10 AA 70 AA 01 54 65 6E 68 61 20 75 6D 61 20 62 6F 61 20 20 20 20 20 20 AA 10 AA 70 AA 02 76 69 61 67 65 6D 20 74 65 73 74 65 20 20 20 20 20 20 20 03 19 95'
    s.sendall(bytes.fromhex(message))
    time.sleep(3)
    
       

    #Limpa a tela, tudo em branco 
    #message='01 02 50 01 01 AA 01 01 82 01 01 00 32 AA 10 AA 70 AA 01 20 20 20 20 20 20 20 20 20 20 20 20 20 20 20 20 20 20 20 AA 10 AA 70 AA 02 20 20 20 20 20 20 20 20 20 20 20 20 20 20 20 20 20 20 20 03 59 6E'
    #time.sleep(2)
    
    #Aguardando veiculo!
    message="01 02 50 01 01 AA 01 01 82 01 01 00 32 AA 10 AA 70 AA 01 41 67 75 61 72 64 61 6E 64 6F 20 76 65 69 63 75 6C 6F 21 AA 10 AA 70 AA 02 20 20 20 20 20 20 20 20 20 20 20 20 20 20 20 20 20 20 20 03 1A BA" 
    s.sendall(bytes.fromhex(message))
    time.sleep(2)

    
    #Em Desenvolvimento!
    message='01 02 50 01 01 AA 01 01 82 01 01 00 32 AA 10 AA 70 AA 01 45 6D 20 64 65 73 65 6E 76 6F 6C 76 69 6D 65 6E 74 6F 21 AA 10 AA 70 AA 02 20 20 20 20 20 20 20 20 20 20 20 20 20 20 20 20 20 20 20 03 07 F8'
    s.sendall(bytes.fromhex(message))
    time.sleep(2)

    s.detach()
    s.close()
