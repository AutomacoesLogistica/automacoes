
//   GA AUTOMAÇÕES   GA AUTOMAÇÕES   GA AUTOMAÇÕES   GA AUTOMAÇÕES   GA AUTOMAÇÕES   GA AUTOMAÇÕES   GA AUTOMAÇÕES   GA AUTOMAÇÕES   GA AUTOMAÇÕES   GA AUTOMAÇÕES   GA AUTOMAÇÕES   GA AUTOMAÇÕES 
//   GA AUTOMAÇÕES   GA AUTOMAÇÕES   GA AUTOMAÇÕES   GA AUTOMAÇÕES   GA AUTOMAÇÕES   GA AUTOMAÇÕES   GA AUTOMAÇÕES   GA AUTOMAÇÕES   GA AUTOMAÇÕES   GA AUTOMAÇÕES   GA AUTOMAÇÕES   GA AUTOMAÇÕES 
//   GA AUTOMAÇÕES   GA AUTOMAÇÕES   GA AUTOMAÇÕES   GA AUTOMAÇÕES   GA AUTOMAÇÕES   GA AUTOMAÇÕES   GA AUTOMAÇÕES   GA AUTOMAÇÕES   GA AUTOMAÇÕES   GA AUTOMAÇÕES   GA AUTOMAÇÕES   GA AUTOMAÇÕES 
//   GA AUTOMAÇÕES   GA AUTOMAÇÕES   GA AUTOMAÇÕES   GA AUTOMAÇÕES   GA AUTOMAÇÕES   GA AUTOMAÇÕES   GA AUTOMAÇÕES   GA AUTOMAÇÕES   GA AUTOMAÇÕES   GA AUTOMAÇÕES   GA AUTOMAÇÕES   GA AUTOMAÇÕES 
//   GA AUTOMAÇÕES   GA AUTOMAÇÕES   GA AUTOMAÇÕES   GA AUTOMAÇÕES   GA AUTOMAÇÕES   GA AUTOMAÇÕES   GA AUTOMAÇÕES   GA AUTOMAÇÕES   GA AUTOMAÇÕES   GA AUTOMAÇÕES   GA AUTOMAÇÕES   GA AUTOMAÇÕES 
//   GA AUTOMAÇÕES   GA AUTOMAÇÕES   GA AUTOMAÇÕES   GA AUTOMAÇÕES   GA AUTOMAÇÕES   GA AUTOMAÇÕES   GA AUTOMAÇÕES   GA AUTOMAÇÕES   GA AUTOMAÇÕES   GA AUTOMAÇÕES   GA AUTOMAÇÕES   GA AUTOMAÇÕES 

/* PROJETO RECEPTOR DE 20 PONTOS DISTINTOS COM SUPORTE A SOFTWARE E BLUETOOTH

   1 - GND
   2 - VCC 3.3V ............................Nao usar 5V, queima
   3 - CE no Arduino pino 9
   4 - CSN no Arduino pino 10
   5 - SCK no Arduino pino 13
   6 - MOSI no Arduino pino 11
   7 - MISO no Arduino pino 12
   8 - Nao usado
 
 
 
  LIGACOES DO DISPLAY 20X4 OU ATE MESMO 16X2
  
 1 - VSS do LCD - GND
 2 - VDD do LCD - 5V
 3 - VO do LCD - Pino central do potenciometro ou DIVISOR DE TENSAO VCC/470R/100R/GND   e o sinal em entre 470R e 100R
 4 - RS do LCD - Vai ao pino 7
 5 - RW do LCD - GND
 6 - E do LCD - Vai ao pino 6
 7 - D0 do LCD - NC
 8 - D1 do LCD - NC
 9 - D2 do LCD - NC
10 - D3 do LCD - NC
11 - D4 do LCD - Pino 5
12 - D5 do LCD - Pino 4
13 - D6 do LCD - Pino 3 
14 - D7 do LCD - Pino 2 
15 - A do LCD - 5V 
16 - K do LCD - GND 


 
   
 - Produzido por: Bruno Gonçalves
 - Data:  21/02/2015 
 
 
 
 
 */

// Carrega as bibliotecas
#include <SPI.h>
#include <nRF24L01.h>
#include <RF24.h>

#define CE_PIN   9
#define CSN_PIN 10

const uint64_t pipe = 0xE8E8F0F0E1LL; // Define a frequencia de recepção, deve ser igual a do transmissor, em decimal, neste caso, equivale a 1000340517089

RF24 radio(CE_PIN, CSN_PIN); // Cria o Radio e inicia a Recepção

int SINAIS[20];  // usada para receber os comandos enviados
String dados; // usado para imprimir no lcd o que esta sendo enviado no ambiente


// variaveis para impressao do tempo de duracao da execucao do programa
int funcionamento;


int tempo; // usada para alternar entre meu numero e o do marcelo
// inclui a biblioteca LiquidCrystal:
#include <LiquidCrystal.h>

// inicia a biblioteca com o numero das portas da interface
LiquidCrystal lcd(7, 6, 5, 4, 3, 2);

String d;
int id;
String readString;


String L0,D0;
String L1,D1;


int funcao;




void setup()
{
  id=0;
  Serial.begin(9600);
  delay(10);
  Serial.println("******      GA Automacoes      ******");
  Serial.println("");
  Serial.println("Iniciado o Programa!");
  Serial.println("");
  // configura o numero de colunas e linhas do LCD: 
  lcd.begin(20, 4);
  radio.begin();

  radio.openWritingPipe(pipe);
  radio.openReadingPipe(1,pipe);
  radio.startListening();;
 lcd.setCursor(0, 1);
 lcd.print("Tel: (31)8369-1000  ");

L0="Ligada 0";
D0="Desligada 0";

L1="Ligada 1";
D1="Desligada 1";








funcao=0;
}


void loop()

{

if(funcao==0)
{

  // MODO PARA ALTERNAR OS NUMEROS PARA CONTATO
tempo=tempo++;

if (tempo==500)
{
  lcd.setCursor(0, 1);
  lcd.print("Tel: (31)8369-1000  ");
}
if (tempo==1000)
{
 lcd.setCursor(0, 1);
 lcd.print("Tel: (31)9314-0440  ");
 tempo = 0;
}
// **************************************************************************************************************************************************************************************



   
// CODIGO FEITO PARA COM O AUXILIO DO SOFTWARE SABER QUAL A ID DE COMUNICACAO E O PACOTE USADO  
  
            while (Serial.available()) 
            {
             delay(3);  
             char c = Serial.read();
             readString += c; 
            }
            
 if (readString.length() >0) 
 {
   if (readString == "reset")     
   {
    setup();
   }
    
   
   if (readString == "funcao")     
   {
    funcao=1;
   }
   
   
   
   if (readString == "info2015")     
   {
     Serial.println("****** GA Automacoes ******");
     Serial.println("");
     Serial.println("Driver do Arquivo = AUTOMACAO_RECEPTOR_SUPERVISORIO");
     Serial.println("");
     Serial.println(" ID para comunicacao = 0xE8E8F0F0E1LL");
     Serial.println(" Numero de canais =  20 ");
     Serial.println(" Suporte comunicacao bluetooth = SIM ");     
     Serial.println(" IP bluetooth = 20:13:08:09:10:85");     
     Serial.println(" Modelo Bluetooth = HC-06");   
     Serial.println(" Suporte comunicacao Ethernet = NAO ");
     Serial.println(" Suporte comunicacao RF = SIM ");     
     Serial.println(" Modulo de 2.4Ghz ");    
     Serial.println(" Modelo = nRF24L01 ");         


     Serial.println(" Data da Criacao = 21/02/2015 ");     
     Serial.println(" Versao do Software = 1.0 ");
     Serial.println(" Versao do chip = atmega328");     
     Serial.println("  ");    
     



   }
    
   if (readString == "programa")     
   {
     Serial.println("Vira aqui todo o programa gravado no arduino");
     Serial.println(" ");
     Serial.println(" ");
     Serial.println("");
     Serial.println("*");
     Serial.println("");
     Serial.println("");
     Serial.println("");
     Serial.println(" ");
    }
 
 if (readString.length() >0) 
        {
         
          dados = readString;
          lcd.setCursor(0, 2);
         lcd.print("                    ");delay(50);
         lcd.setCursor(0, 2);
         lcd.print(dados);
        } 
 
        
  if(id==1&&readString!=0&&readString!="rid")
   {
     
    lcd.setCursor(0, 2);
    lcd.print("                    ");
    lcd.setCursor(0, 3);
    lcd.print(readString);
    id=2;
   }  
   
    if (readString == "id")     
   {
    id=1;
    lcd.setCursor(0, 2);
    lcd.print("                    ");
    lcd.setCursor(0, 3);
    lcd.print("                    ");
    delay(20);
    
   }
   
 if(readString=="rid")
   {
   lcd.setCursor(0, 3);
   lcd.print(funcionamento);// imprime o numero de segundos desde o reset:
   id=0;
   lcd.setCursor(0, 2);
   lcd.print("                     ");
   }
 

 
 
 
 
         readString=""; // LIMPA A VARIAVEL
 }
//************************************************************************************************************************************   
 




// ATUALIZA O LCD QUANDO HA ALGUM DADO RECEBIDO/ ENVIADO POR ALGUM DISPOSITIVO E INDICANDO O QUE FOI ACIONADO!


 if (readString.length() >0) 
        {
         
          dados = readString;
          lcd.setCursor(0, 2);
         lcd.print("                    ");delay(50);
         lcd.setCursor(0, 2);
         lcd.print(dados);
         Serial.println(dados);
         
        readString="";
        } 

// ******************************************************************************************************************************************************************************************************





// INICIA A PARTE DO RADIO DE 2.4gHZ

  if ( radio.available() ) // Se o Radio estiver disponivel, ou seja, recebendo informação do transmissor imprime as informações
  {

    bool done = false;
    while (!done)
    {

     done = radio.read( SINAIS, sizeof(SINAIS) );
     
     
     
     if(SINAIS[0]==1000)
     {
     Serial.println("SINAIS[0]==1000");
     lcd.setCursor(0, 2);
     lcd.print("                    ");delay(50);
     lcd.setCursor(0, 2);
     lcd.print(L0);
     }
     if(SINAIS[0]==500)
     {
     Serial.println("SINAIS[0]==500");
     lcd.setCursor(0, 2);
     lcd.print("                    ");delay(50);
     lcd.setCursor(0, 2);
     lcd.print(D0);
     }


     if(SINAIS[1]==1000)
     {
     Serial.println("SINAIS[1]==1000");
     lcd.setCursor(0, 2);
     lcd.print("                    ");delay(50);
     lcd.setCursor(0, 2);
     lcd.print(L1);
     }
     if(SINAIS[1]==500)
     {
     Serial.println("SINAIS[1]==500");
     lcd.setCursor(0, 2);
     lcd.print("                    ");delay(50);
     lcd.setCursor(0, 2);
     lcd.print(D1);
     }

  
    }
  }
  else
  {    
    
   lcd.setCursor(0, 0);
   lcd.print("    GA Automacoes   ");
   
   

  
  
   
   funcionamento=(millis()/1000);   
   
   if(id==0)
   {
   lcd.setCursor(0, 3);
   lcd.print(funcionamento);// imprime o numero de segundos desde o reset:
  }
 
 }
 
}



if(funcao==1)
{

            while (Serial.available()) 
            {
             delay(3);  
             char c = Serial.read();
             readString += c; 
            }
            
 if (readString.length() >0) 
 {
   if (readString == "0")     
   {
   SINAIS[0]=750;  
   radio.write(SINAIS,sizeof(0)); 
   }
    if (readString == "1")     
   {
   SINAIS[1]=750;  
   radio.write(SINAIS,sizeof(1)); 
   }
   
   readString="";
   funcao=0;
    delay(500);



 }
}








}
