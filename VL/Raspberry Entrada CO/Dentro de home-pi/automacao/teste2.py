from threading import Thread
import time

global ciclo
global ciclo_entrada
global ciclo_saida

ciclo = 0
ciclo_entrada = 0
ciclo_saida = 0

class Sinaleiro_Entrada:
    def __init__(self):
        self._running = True

    def terminate(self):
        self._running = False

    def run(self):
        global ciclo_entrada
        while self._running:
            print("Sinaleiro Entrada Aceso")
            time.sleep(3) #Tempo do Sinaleiro De entrada aceso
            ciclo_entrada = ciclo_entrada + 3
            print("Sinaleiro Entrada Apagado - ", ciclo_entrada)


class Sinaleiro_Saida:
    def __init__(self):
        self._running = True

    def terminate(self):
        self._running = False

    def run(self):
        global ciclo_saida
        while self._running:
            print("Sinaleiro Saida Aceso")
            time.sleep(5) #Five second delay
            ciclo_saida = ciclo_saida + 10
            print("Sinaleiro Saida Apagado - ", ciclo_saida)
            TwoSecond.terminate()

#Create Class
FiveSecond = Sinaleiro_Entrada()
#Create Thread
FiveSecondThread = Thread(target=FiveSecond.run)
#Start Thread
FiveSecondThread.start()

#Create Class

#Create Thread
#TwoSecondThread = Thread(target=TwoSecond.run)
#Start Thread
#TwoSecondThread.start()









Exit = False #Flag para saida

while Exit==False:
 ciclo = ciclo + 1
 print("serial  - ", ciclo)
 time.sleep(1) # 1 segundo de delay para codigo principal
 if(ciclo ==5 or ciclo==20):
     TwoSecond = Sinaleiro_Saida()
     TwoSecondThread = Thread(target=TwoSecond.run)
     TwoSecondThread.start()
 if (ciclo > 50000): Exit = True #Sai do programa

TwoSecond.terminate() # Finaliza a tread
FiveSecond.terminate() # Finaliza a tread

print("Finalizando!")