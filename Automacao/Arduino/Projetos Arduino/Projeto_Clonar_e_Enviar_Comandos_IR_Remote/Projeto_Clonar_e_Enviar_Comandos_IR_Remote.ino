// INCLUSÃO DE BIBLIOTECA
#include <IRremote.h>
#include <PushButton.h>

// DIRETIVAS DE COMPILAÇÃO
#define tempoTecla 350
#define frequencia 38 // kHz

// DEFINIÇÃO DOS PINOS
#define pinReceptor 11
#define pinBot1 8
#define pinLed 12

// INSTANCIANDO OBJETOS
IRrecv receptorIR(pinReceptor);
IRsend emissorIR;
PushButton botaoLeitura(pinBot1);

// DECLARAÇÃO VARIÁVEIS GLOBAIS
bool lerComando = false;

// DECLARAÇÃO DAS FUNÇÕES DE LEITURA

void ircode   (decode_results *results);
void encoding (decode_results *results);
void dumpInfo (decode_results *results);
void dumpRaw  (decode_results *results);
void dumpCode (decode_results *results);

//  DECLARAÇÃO DAS TECLAS CLONADAS
unsigned int teclaA[]= {3350,1650, 400,450, 400,450, 350,1300, 400,450, 400,1250, 400,450, 400,1300, 400,400, 400,450, 400,1250, 450,400, 450,400, 450,1200, 450,1200, 450,400, 450,400, 450,400, 450,400, 450,350, 450,400, 450,350, 500,400, 450,1200, 400,450, 450,1200, 450,400, 400,450, 450,400, 450,350, 500,350, 450,400, 450,400, 500,1150, 450,1200, 450,1200, 500,400, 500,1150, 450,350, 500,400, 450,350, 500,350, 500,1150, 500,1150, 500,350, 550,1150, 500,350, 550,1100, 500,350, 500};  // UNKNOWN 924FD4DCunsigned int  rawData[] = {3350,1650, 400,450, 400,450, 350,1300, 400,450, 400,1250, 400,450, 400,1300, 400,400, 400,450, 400,1250, 450,400, 450,400, 450,1200, 450,1200, 450,400, 450,400, 450,400, 450,400, 450,350, 450,400, 450,350, 500,400, 450,1200, 400,450, 450,1200, 450,400, 400,450, 450,400, 450,350, 500,350, 450,400, 450,400, 500,1150, 450,1200, 450,1200, 500,400, 500,1150, 450,350, 500,400, 450,350, 500,350, 500,1150, 500,1150, 500,350, 550,1150, 500,350, 550,1100, 500,350, 500};  // UNKNOWN 924FD4DC
//unsigned int  teclaA[] = {8950,4400, 600,550, 600,550, 500,600, 550,550, 600,600, 450,600, 550,550, 600,550, 500,600, 550,550, 600,1650, 550,1700, 500,1700, 700,1550, 650,1600, 500,1750, 600,1550, 600,550, 600,1650, 600,550, 550,550, 550,500, 650,500, 600,1600, 600,550, 600,1600, 650,500, 600,1600, 650,1650, 550,1600, 650,1650, 600,500, 600};  // NEC 3FA15E
unsigned int  teclaB[] = {3350,1700, 400,450, 400,400, 450,1250, 400,400, 500,1200, 450,400, 450,1150, 500,400, 400,400, 450,1250, 500,350, 400,400, 550,1100, 500,1200, 550,300, 450,400, 500,300, 500,350, 450,400, 500,350, 450,400, 500,300, 500,1200, 500,300, 550,1150, 550,250, 500,350, 500,300, 600,1150, 450,350, 550,300, 500,350, 450,1200, 500,1200, 500,1150, 550,300, 550,1100, 500,350, 450,350, 500,400, 450,350, 500,1200, 500,1150, 500,350, 500,350, 500,300, 550,1150, 500,350, 550};  // UNKNOWN FCD5027A
unsigned int  teclaC[] = {8750,4500, 400,800, 350,550, 550,650, 450,750, 350,550, 600,650, 400,700, 400,650, 500,1800, 350,1750, 450,1850, 500,1700, 350,1850, 400,1800, 500,600, 400,1700, 650,1700, 350,700, 500,500, 550,1750, 550,1750, 350,700, 450,650, 400,750, 350,600, 600,1700, 400,1750, 450,750, 350,700, 550,1700, 400,1750, 450,1800, 500};  // UNKNOWN 60AD1B2B
unsigned int teclaD[] = {25788, 4500, -4500, 550, -1700, 500, -1700, 550, -1700, 550, -550, 550, -600, 500, -600, 500, -600, 550, -600, 500, -1700, 550, -1700, 500, -1700, 550, -600, 500, -600, 550, -550, 550, -600, 500, -600, 550, -550, 550, -1700, 500, -1700, 550, -600, 500, -600, 550, -1700, 550, -1650, 550, -1700, 550, -1700, 550, -550, 550, -550, 550, -1700, 550, -1650, 600, -550, 550, -550, 550, -550, 600};

void setup() {
  Serial.begin(9600);
  pinMode(pinLed, OUTPUT);

  // INICIANDO RECEPTOR IR
  receptorIR.enableIRIn();
  Serial.print("Setup Concluído");

}

void loop() {
  // MÉTODO PARA LEITURA E ATUALIZAÇÃO DAS PROPRIEDADES DO BOTÃO
  botaoLeitura.button_loop();

  // BLOCO CONDIÇÕES PARA INICIAR LEITURA
  if (botaoLeitura.pressed() && !lerComando) {
    lerComando = true;
    digitalWrite(pinLed, HIGH);
  } else if (botaoLeitura.pressed() && lerComando) {
    lerComando = false;
    digitalWrite(pinLed, LOW);
  }

  // LAÇO PARA LEITURA DO RECEPTOR IR QUANDO FOR PRESSIONADO O BOTÃO
  while (lerComando) {

    decode_results  results;

    if (receptorIR.decode(&results)) {
      Serial.println(results.value, HEX);
      dump(&results);
      receptorIR.resume();
      lerComando = false;
      digitalWrite(pinLed, LOW);
    }
  }

  // BLOCO PARA RECEBER DADOS DA SERIAL E INICIAR EMISSOR IR
  if (Serial.available()) {
    char tecla = Serial.read();

    switch (tecla) {
      case 'a':
        emissorIR.sendRaw(teclaA, sizeof(teclaA) / sizeof(teclaA[0]), frequencia);
        Serial.println("Enviando Tecla A clonada");
        delay(tempoTecla);
        break;

      case 'b':
        emissorIR.sendRaw(teclaB, sizeof(teclaB) / sizeof(teclaB[0]), frequencia);
        Serial.println("Enviando Tecla B clonada");
        delay(tempoTecla);
        break;

      case 'c':
        emissorIR.sendRaw(teclaC, sizeof(teclaC) / sizeof(teclaC[0]), frequencia);
        Serial.println("Enviando Tecla C clonada");
        delay(tempoTecla);
        break;

      case 'd':
        emissorIR.sendRaw(teclaD, sizeof(teclaD) / sizeof(teclaD[0]), frequencia);
        Serial.println("Enviando Tecla D clonada");
        delay(tempoTecla);

        emissorIR.sendNEC(0xE0E06798,frequencia);
        break;
    }
  }
}
