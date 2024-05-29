/*

    CODIGO UTILIZANDO UM ARDUINO PRO MINI EM REDE RS485 - CODIGO PARA FITA LED RGB CORTINEIRA DA SALA


   Conexão do modulo RS485    Recebe as mensagens dos interruptores e envia tambem para a central com mqtt atualizar supervisorio
   RO = Pino 3
   DI = Pino 4
   DE = Pino 2 Pino para ativar transmissao
   RE = Pino 2 Pino para ativar transmissao

   PINO DOS RGB's
   GREEN 9
   RED 10
   BLUE 11
   LedStatus 13
   

   
*/

#define GREEN 9
#define RED 10
#define BLUE 11
#define LedStatus 13

#include<SoftwareSerial.h>
#define transmitir 2 // Pino DE e RE - Transmissao
#define pinRX 3 // Pino RO
#define pinTX 4 // Pino DI
SoftwareSerial RS485(pinRX, pinTX);
String readString; // Variavel pra cDesligarRelecatenar dados da serial
char MensagemRecebida[15]; // Usado para receber e concaternar as mensagens
char* MensagemParaImprimir;

int valor_Verde = 0;
int valor_Vermelho = 0;
int valor_Azul = 0;
float valor_brilho = 1.0; // Inicia em maxima potencia
int posicao,a,b,c,e,f = 0;
int cond_cortina = 0; // Indicação da posição da cortina; 0 = Fechada  1 = Aberta
String comando_cortina = "";
void setup()
{
 RS485.begin(4800);
 Serial.begin(9600);
 pinMode(transmitir, OUTPUT);
 digitalWrite(transmitir, LOW);
 pinMode(LedStatus, OUTPUT);
 digitalWrite(LedStatus, LOW);
 pinMode(GREEN,OUTPUT);//9
 pinMode(RED,OUTPUT);//10
 pinMode(BLUE,OUTPUT);//11
 digitalWrite(GREEN,0);
 digitalWrite(RED,0);
 digitalWrite(BLUE,0);
}

void loop()                    
{

 while (RS485.available())
 {
  delay(3);
  char d = RS485.read();
  readString += d;
  posicao++;
  if (d == '_' && a != 0 && b != 0 && c == 0) { c = posicao;}
  if (d == ',' && a != 0 && b == 0 && c == 0) { b = posicao;}
  if (d == ',' && a == 0 && b == 0 && c == 0) { a = posicao;}
  if (d == '_' && f == 0 && e != 0) { f = posicao;}
  if (d == '_' && e == 0 && f == 0) { e = posicao;}
 }
 
 while (Serial.available())
 {
  delay(3);
  char d = Serial.read();
  readString += d;
  posicao++;
  if (d == '_' && a != 0 && b != 0 && c == 0) { c = posicao;}
  if (d == ',' && a != 0 && b == 0 && c == 0) { b = posicao;}
  if (d == ',' && a == 0 && b == 0 && c == 0) { a = posicao;}
  if (d == '_' && f == 0 && e != 0) { f = posicao;}
  if (d == '_' && e == 0 && f == 0) { e = posicao;}
 }
  
 if (readString.length() > 0)
 {
  digitalWrite(LedStatus, 1);
  delay(150);
  digitalWrite(LedStatus, 0);
  delay(150); 
 
  readString.trim(); // Não retirar esta parte, pois ela retira espaços providos a ruidos gerados
  
  // VERIFICANDO SE A MENSANGEM É DA ILUMINAÇÃO DA FITA DE LED DA CORTINA ****************************************************************************************************************
  if ( readString.indexOf("led_") >= 0 &&  readString.indexOf("_cortina") >= 0)
  {
   valor_Verde = (readString.substring(4, a-1).toInt()); // Retira o primeiro algarismo do canal - Centena
   valor_Vermelho = (readString.substring(a, b-1).toInt()); // Retira o segundo algarismo do canal - Dezena
   valor_Azul = (readString.substring(b, c-1).toInt()); // Retira o terceiro algarismo do canal - Unidade

   if ( valor_Verde > 255 ) { valor_Verde = 255;}
   if ( valor_Verde < 0 ) { valor_Verde = 0;}

   if ( valor_Vermelho > 255 ) { valor_Vermelho = 255;}
   if ( valor_Vermelho < 0 ) { valor_Vermelho = 0;}

   if ( valor_Azul > 255 ) { valor_Azul = 255;}
   if ( valor_Azul < 0 ) { valor_Azul = 0;}

   analogWrite(GREEN,valor_Verde * valor_brilho);
   analogWrite(RED,valor_Vermelho * valor_brilho);
   analogWrite(BLUE,valor_Azul * valor_brilho);
  }   

  // VERIFICANDO SE A MENSANGEM É DA BRILHO ILUMINAÇÃO DA FITA DE LED DA CORTINA **********************************************************************************************************
  if ( readString.indexOf("led_") >= 0 &&  readString.indexOf("_brilhocortina") >= 0)
  {
   valor_brilho = (readString.substring(e, f-1).toInt());
   valor_brilho = valor_brilho/100;
   
   if ( valor_Verde > 255 ) { valor_Verde = 255;}
   if ( valor_Verde < 0 ) { valor_Verde = 0;}

   if ( valor_Vermelho > 255 ) { valor_Vermelho = 255;}
   if ( valor_Vermelho < 0 ) { valor_Vermelho = 0;}

   if ( valor_Azul > 255 ) { valor_Azul = 255;}
   if ( valor_Azul < 0 ) { valor_Azul = 0;}

   analogWrite(GREEN,valor_Verde * valor_brilho);
   analogWrite(RED,valor_Vermelho * valor_brilho);
   analogWrite(BLUE,valor_Azul * valor_brilho);
  }   



  // VERIFICANDO SE A MENSANGEM É PARA ABRIR OU FECHAR A CORTINA *************************************************************************************************************************
  if ( readString.indexOf("afc_") >= 0 &&  readString.indexOf("_cortina") >= 0)
  {
   comando_cortina = (readString.substring(4, 9)); //
   Serial.println(comando_cortina);
   //cortina(); // Chama o void para verificar o que deve ser feito
  }  
  
  
  
  
  
  readString = ""; // Limpa a mensagem
  posicao = 0; // limpa para receber novos dados
  a = 0;
  b = 0;
  c = 0;
  e = 0;
  f = 0;
  
 }// Fecha o (readString.length() > 0
  
  
  
  
  
  
  
 

} // Fecha Loop



void cortina() 
{
  Serial.println(readString);
  
  // Abrir A cortina ***************************************************************************************************************************************
  if ( readString.indexOf("com_a") >= 0)
  {
   // digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
   // RS485.print("cortina_aberta");
   // digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485

  }
  // Fechar A cortina ***************************************************************************************************************************************
  if ( readString.indexOf("com_f") >= 0)
  {
   // digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
   // RS485.print("cortina_fechada");
   // digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
  }


  
  
} // Fecha void cortina
