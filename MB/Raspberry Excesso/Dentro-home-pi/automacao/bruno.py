#! /usr/bin/env python3

import serial
porta = '/dev/ttyUSB0'
baud_rate = 115200

###################### FUNCAO PARA VERIFICAR PORTAS ATIVAS ###############
def verifica_portas():

    portas_ativas = []
    for numero in range(10):

        try:
            objeto_verifica = serial.Serial(numero)
            portas_ativas.append((numero, objeto_verifica.portstr))
            objeto_verifica.close()

        except serial.SerialException:
            pass
    return portas_ativas

################    FUNCAO PARA ESCREVER NA PORTA ####################
def escrever_porta():

   try:

       valor = (input("Digite o valor a ser enviado: "))
       Obj_porta = serial.Serial(porta, baud_rate)
       Obj_porta.write(valor)
       Obj_porta.close()

   except serial.SerialException:
       print("ERRO: Verifique se ha algum dispositivo conectado na porta!")

   return valor

########################## FUNCAO PARA LER A PORTA #######################
def ler_porta():

   try:

       Obj_porta = serial.Serial(porta, baud_rate)
       valor = Obj_porta.read()
       print("Valor lido da Serial: ",valor)
       Obj_porta.close()

   except serial.SerialException:
       print("ERRO: Verifique se ha algum dispositivo conectado na porta!")

################################ MAIN ####################################
if __name__=='__main__':

    print("===========================================")
    print("===== 1 - Verificar Portas Existentes =====")
    print("===== 2 - Ler Valor da Porta Serial   =====")
    print("===== 3 - Escrever Valor na Porta Serial ==")
    print("===========================================")
    opcao = int (input("Digite a Opcao: "))

    if opcao == 1:
        print("Numero da porta | Nome da Porta")
        for numero,portas_ativas in verifica_portas():
            print("      %d         |    %s" % (numero,portas_ativas))

    elif opcao == 2:
        ler_porta()

    elif opcao == 3:
        escrever_porta()

    else:
       print("Entrada Invalida!!")