/*  
 *  0 - tx
 *  1 - rx
 *  2 - Entrada Geral 127V
 *  3 - Entrada Geral 12V
 *  4 - Ativa SD card
 *  5 - ECHO
 *  6 - TRIGGER
 *  7 - fusivel da bomba 
 *  8 - fusivel da camera
 *  9 - fusivel da solenoide
 * 10 - Ativa Ethernet Shield
 * 11 - Dados SD
 * 12 - Dados SD
 * 13 - Dados SD
 * A0 - Entrada PH
 * A1 - Entrada Turbidez
 * A2 - Saida bomba
 * A3 - Saida Solenoide
 * A4 - Saida Camera
 * A5
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 */
 #include <Wire.h>
#include <EEPROM.h>
#include <SPI.h>
#include <SD.h>
#include <Ultrasonic.h>
#define TRIGGER_PIN  6
#define ECHO_PIN     5
Ultrasonic ultrasonic(TRIGGER_PIN, ECHO_PIN);

// Valores para media movel **************************************************************

#define N 100 // Numero de amostas
float media; // Recebe a media
float valores[N]; // Array para armazenar os valores lidos
double soma; // Variavel para somar os valores
float distanciaCM = 0.00;// Para o nivel do tanque e deteccao de bomba ou solenoide danificada
float distanciaCM_Antes = 0.00;//
float distanciaCM_Depois = 0.00;//
float distanciaMax = 100.00;// DistanciaMaxima permitida
// ****************************************************************************************

String readString;
unsigned int registro;
unsigned int valor;
byte hiByte;
byte loByte;
File myFile;


#define EntradaGeral_12V 0
#define EntradaGeral_127V 0
#define EntradaFusivel_Bomba 0
#define EntradaFusivel_Camera 0
#define EntradaFusivel_Solenoide 0
#define SaidaBomba 7
#define SaidaSolenoide 8
#define SaidaEletronica 9
 
int AlimentacaoGeral_12V;
int AlimentacaoGeral_127V;
int fusivel_bomba = 1; // Em 1 fusivel esta ok
int fusivel_camera = 1; // Em 1 fusivel esta ok
int fusivel_solenoide = 1; // Em 1 fusivel esta ok
int fonte = 1; // Em 1 fonte esta ok
int bomba = 1; // Em 1 a bomba está normal
int eletronica = 1; // Em 1 esta normal
int solenoide = 1; // Em 1 a solenoide esta normal
int sensor = 1; // Para verificar se o sensor esta ok

float valorPH = 8.77;
float valorTurbidez = 47.3;
float Ultimo_valorPH;
float Ultimo_valorTurbidez;
int scan = 0;
int check = 0;
int vezes = 0;
int tempo_bomba = 5000; // 2 min e meio
int tempo_eletronica = 5000; // 2 min e meio
int tempo_solenoide = 5000; // 2 min e meio




long UltimoMillis = 0;        // Variável de controle do tempo
long intervalo = 500;     // Tempo em ms do intervalo a ser executado
unsigned long AtualMillis;





void setup() {
  // Open serial communications and wait for port to open:
  Serial.begin(9600);
  while (!Serial) {
    ; // wait for serial port to connect. Needed for native USB port only
  }
  //Serial.print("Inicializando o cartao SD");
  if (!SD.begin(4))
  {
    //  Serial.println("A inicalizacao falhou! ");
    return;
  }
  //Serial.println("Inicializacao completa!");
  int hiByte1 = (EEPROM.read(0) * 255) + (EEPROM.read(0));
  int loByte1 = EEPROM.read(1);
  valor = ((hiByte1) + (loByte1));
  registro = valor;

  pinMode(EntradaGeral_12V, INPUT);
  pinMode(EntradaGeral_127V, INPUT);



}

void loop()
{

  // VERIFICANDO AS ENTRADAS E CONDICOES DO SISTEMA ***********************************************************************************************************************************

  if (EntradaGeral_127V == 0) {AlimentacaoGeral_127V = 1;}  // Alimentação esta ok
  if (EntradaGeral_127V == 1) {AlimentacaoGeral_127V = 2;}  // Alimentação com algum defeito
  
  if (EntradaGeral_12V == 0) {AlimentacaoGeral_12V = 1;}    // Alimentação esta ok
  if (EntradaGeral_12V == 1) {AlimentacaoGeral_12V = 2;}    // Alimentação com algum defeito
  
  // Verificando se o fusivel da bomba esta ok
  if (AlimentacaoGeral_12V == 1 && EntradaFusivel_Bomba == 0) {fusivel_bomba = 1;}  // Fusivel da bomba esta ok
  if (AlimentacaoGeral_12V == 1 && EntradaFusivel_Bomba == 1) {fusivel_bomba = 2;}  // Fusivel da bomba aberto
  
  // Verificando se o fusivel da camera esta ok
  if (AlimentacaoGeral_12V == 1 && EntradaFusivel_Camera == 0) {fusivel_camera = 1;} // Fusivel da camera esta ok
  if (AlimentacaoGeral_12V == 1 && EntradaFusivel_Camera == 1) {fusivel_camera = 2;} // Fusivel da camera aberto
  
  // Verificando se o fusivel da solenoide esta ok
  if (AlimentacaoGeral_127V == 1 && EntradaFusivel_Solenoide == 0) {fusivel_solenoide = 1;} // Fusivel da solenoide esta ok
  if (AlimentacaoGeral_127V == 1 && EntradaFusivel_Solenoide == 1) {fusivel_solenoide = 2;} // Fusivel da solenoide aberto
  
  // Verificando se a fonte esta ok
  if (AlimentacaoGeral_127V == 1 && AlimentacaoGeral_12V == 1) {fonte = 1;} // Fonte esta ok
  if (AlimentacaoGeral_127V == 1 && AlimentacaoGeral_12V == 0) {fonte = 2;} // Fonte danificada
  


   AtualMillis = millis();    //Tempo atual em ms
  
 

  long microsec = ultrasonic.timing(); //Lendo o sensor
  distanciaCM = ultrasonic.convert(microsec, Ultrasonic::CM); //Convertendo a distância em CM
  
  if ( distanciaCM != 0.00 )
  {
    sensor =1;
  }
  else
  {
  sensor = 2;
  }
  
  if (distanciaCM > distanciaMax) {
    distanciaCM = distanciaMax;
  }
  distanciaCM = distanciaMax - distanciaCM;
  // For para fazer o deslocamento das variaveis, atualizando-as ************************************************************************
  for (int i = N - 1; i > 0; i--)
  {
    valores[i] = valores[i - 1];
  }
  valores[0] = distanciaCM; // Coloca o valor mais atual em valores[0]
  soma = 0.0;  // Limpa a variavel de soma
  // For para calcular a media atualizada *************************************************************************************************
  for (int i = 0; i < N; i++)
  {
    soma = soma + valores[i];
  }
  // ***************************************************************************************************************************************
  media = soma / N;
  distanciaCM = media;  // atualiza distanciaCM com o valor ja estabilizado pela media movel

  media = map(media, 0, distanciaMax, 0, 100);
  //Serial.println(media);











  while (Serial.available())
  {
    delay(3);
    char c = Serial.read();
    readString += c;
  }
  if (readString.length() > 0)
  {
    if (readString == "p")  // Solicitado impressão dos dados do cartao
    {
      myFile = SD.open("Banco_01.txt");
      if (myFile)
      {
        Serial.println();
        Serial.println("Imprimindo os dados encontrados no cartão: ");
        while (myFile.available())
        {
          Serial.write(myFile.read());
        }
        myFile.close();
      }
      else
      {
        Serial.println("Erro ao abrir o arquivo Banco_01.txt");
      }
    }
    if (readString == "r")  // Reiniciar sistema
    {
      setup();
    }
    if (readString == "s")  // Iniciar ciclo do sistema
    {
      scan = 1;vezes=0;
    }
     if (readString == "d")  // Dados do sistema
    {
      vezes = 7;
    }
    if (readString == "c")  // Cancelar Scan do sistema
    {
      if ( scan == 1){vezes = 8;}
    }
    if (readString == "z")  // Zerar a eeprom
    {
      registro = 0;
      hiByte = highByte(registro);
      loByte = lowByte(registro);
      EEPROM.write(0, hiByte);
      EEPROM.write(1, loByte);
      Serial.println("A EEPROM foi zerada, a partir de agora basta desligar o sistema!");
      for (int i = 0; i < 10; i++)
      {
        Serial.print(" . ");
        delay(500);
      }
      setup();
    }
    readString = "";
  }




  /*

    myFile = SD.open("Banco_01.txt", FILE_WRITE); // Maximo é 8 caracteres
    if (myFile) // Se encontrar o arquivo entra e salva
    {
      registro = registro+1;
      myFile.print(registro);
      myFile.print(" - ");
      myFile.println(millis() / 1000);
      myFile.close();
      hiByte = highByte(registro);
      loByte = lowByte(registro);
      EEPROM.write(0,hiByte);
      EEPROM.write(1,loByte);


    }
    else // Senao da erro
    {
      Serial.println("Erro ao abrir o arquivo Banco_01.txt");
    }

  */


if (scan == 1 ) // Executando scan
{
 if (AlimentacaoGeral_12V==1 && AlimentacaoGeral_127V==1 && fusivel_bomba == 1&& fusivel_solenoide == 1 )
 {
   
   if ( vezes == 0 ) // Ligar a bomba ********************************************************************************************
   {
    distanciaCM_Antes = distanciaCM;
    digitalWrite(SaidaBomba,HIGH);// liga a bomba
    fonte= 0;
    solenoide = 0;
    bomba = 0;
    fusivel_solenoide = 0;
    fusivel_bomba = 0;
    fusivel_camera = 0;
    sensor = 0;
    
    impressao();
    delay(2000);
    impressao();
    //Serial.println("Ligou a bomba");
    UltimoMillis = AtualMillis; // Atualiza o tempo
    vezes = 1;
   }
   if ( vezes == 1 ) // Desigar a bomba
   {
    if (AtualMillis - UltimoMillis > tempo_bomba) // Millis para bomba
    { 
     UltimoMillis = AtualMillis;    // Salva o tempo atual
     digitalWrite(SaidaBomba,LOW);// Desliga a bomba
     //Serial.println("Desligou a bomba");
     //Serial.println();
     
     distanciaCM_Depois = distanciaCM;
     vezes = 2;
     if (distanciaCM_Depois - distanciaCM_Antes > 8 ){bomba =1;}else{bomba =2;}
     impressao();
    }
   } // Fecha vezes == 1
 
 
  if ( vezes == 2 ) // Ligar a eletronica ********************************************************************************************
   {
    digitalWrite(SaidaEletronica,HIGH);// liga a eletronica
//Serial.println("Ligou a eletronica");
    UltimoMillis = AtualMillis; // Atualiza o tempo
    vezes = 3;
   }
   if ( vezes == 3 ) // Desligar a eletronica
   {
    if (AtualMillis - UltimoMillis > tempo_eletronica) // Millis para eletronica
    { 
     UltimoMillis = AtualMillis;    // Salva o tempo atual
     digitalWrite(SaidaEletronica,LOW);// Desliga a eletronica
     //Serial.println("Desligou a eletronica");
     //Serial.println();
     vezes = 4;
     impressao();
    }
   } // Fecha vezes == 4
 
   if ( vezes == 4 ) // Ligar a Solenoide ********************************************************************************************
   {
     distanciaCM_Antes = distanciaCM;
    digitalWrite(SaidaSolenoide,HIGH);// liga a solenoide
    //Serial.println("Ligou a solenoide");
    UltimoMillis = AtualMillis; // Atualiza o tempo
    vezes = 5;
    impressao();
   }
   if ( vezes == 5 ) // Desligar a solenoide
   {
    if (AtualMillis - UltimoMillis > tempo_solenoide) // Millis para solenoide
    { 
     UltimoMillis = AtualMillis;    // Salva o tempo atual
     digitalWrite(SaidaSolenoide,LOW);// Desliga a solenoide
     //Serial.println("Desligou a solenoide");
     //Serial.println();
     distanciaCM_Depois = distanciaCM;
     vezes = 6;
     if (distanciaCM_Antes - distanciaCM_Depois > 8 ){solenoide =1;}else{solenoide =2;}
     impressao();
    }
   } // Fecha vezes == 6
 
  if ( vezes == 6 && scan == 1)
  {
    scan = 0; vezes = 0;
    //Serial.println("Fim do scan!");
    //Serial.println();
    impressao();
  }


  if (vezes == 8)
  {
    digitalWrite(SaidaBomba,LOW);
    digitalWrite(SaidaEletronica,LOW);
    digitalWrite(SaidaSolenoide,LOW);
    //Serial.println("Abortado o Scan!");
    //Serial.println();
    vezes = 0;
    scan = 0;
  }
 }// Fecha se pode executar o scan
 
} // Fecha scan




if ( vezes == 7)
{
    Serial.println();
    Serial.println("Status do Sistema :");
    Serial.print("Alimentacao Geral 127V :      ");
    if ( AlimentacaoGeral_127V == 1){Serial.println("Alimentacao ok !");}else{Serial.println("Sem alimentacao!");}
    Serial.print("Alimentacao Geral 12V :       ");
    if ( AlimentacaoGeral_12V == 1){Serial.println("Alimentacao ok !");}else{Serial.println("Sem alimentacao!");}
    Serial.print("Fusivel da bomba :            ");
    if ( fusivel_bomba == 1 ){Serial.println("Fusivel da bomba esta ok!");}else{Serial.println("Fusivel da bomba esta aberto!");}
    if ( fusivel_bomba == 1 )
    {
     Serial.print("Condicao da bomba :           ");
      if (bomba == 1){Serial.println("A bomba esta ok!");}else{Serial.println("A bomba esta danificada!");}
    } 
    else
    {
     Serial.print("Condicao da bomba :           ");Serial.println("Não foi possivel efetuar o teste, fusivel da bomba aberto!");
    }
    Serial.print("Fusivel da solenoide :        ");
    if ( fusivel_solenoide == 1 ){Serial.println("Fusivel da solenoide esta ok!");}else{Serial.println("Fusivel da solenoide esta aberto!");}
    if ( fusivel_solenoide == 1 )
    {
     Serial.print("Condicao da solenoide :       ");
     if (solenoide == 1){Serial.println("A solenoide esta ok!");}else{Serial.println("A solenoide esta danificada!");}
    }
    else
    {
     Serial.print("Condicao da solenoide :       ");Serial.println("Não foi possivel efetuar o teste, fusivel da solenoide aberto!");
    }
    Serial.print("Condicao da eletronica :      ");
    
    // bolar ateste de acordo com os valores lidos de ph e turbidez
    Serial.println(eletronica);
    Serial.print("Fusivel da camera :           ");
    if ( AlimentacaoGeral_12V == 1 )
    {
      if ( fusivel_camera == 1 ){Serial.println("Fusivel da camera esta ok!");}else{Serial.println("Fusivel da camera esta aberto!");}
    }
    else
    {
     Serial.print("Condicao da camera :          ");Serial.println("Não foi possivel efetuar o teste, falta de alimentacao 12V!");
    }
    Serial.print("Condicao do sensor de nivel : ");
    if(sensor == 1){Serial.println("O sensor de nivel esta ok!");}else{Serial.println("O sensor de nivel esta danificado!");}
    Serial.print("Condicao da Fonte :           ");Serial.println(fonte);
    Serial.println();
    Serial.println();
    vezes = 0;
}
   






if ( check == 1 )
{
  
}
  

} // Fecha loop

void impressao()
{
  AlimentacaoGeral_127V = 1;
  fonte = 1;
  fusivel_solenoide = 1;
  fusivel_bomba = 1;
  sensor = 1;
  fusivel_camera = 1;
  
  Serial.print(AlimentacaoGeral_127V);
  Serial.print(fonte);
  Serial.print(sensor);
  Serial.print(fusivel_solenoide);
  Serial.print(fusivel_bomba);
  Serial.print(fusivel_camera);
  Serial.print(solenoide);
  Serial.print(bomba);
  Serial.print(",");
  Serial.print(valorPH);
  Serial.print("+");
  Serial.print(valorTurbidez);
  Serial.print("-");
  Serial.print(distanciaCM);
  Serial.print("*\n");
  
}

