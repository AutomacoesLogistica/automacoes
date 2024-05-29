/*
 * 
 * 
 * 
 * INICIAR A LOGICA SEMPRE COM A CORTINA FECHADA
 * 
 * 
 *  Com a cortina fechada sincroniza toda a logica e tambem o led de status 13 funcionara 
 *  
 *  Aceso indica fechada 
 * 
 * 
 * Apagado indica aberta
 * 
 * Podendo assim utiliza-lo para uma possivel automação via TX/RX ou ate mesmo RF 
 * 
 * Revisada dia 28/11/2015 as 11:37
 * 
 * 
 * 
 */



#include <IRremote.h>
int RECV_PIN = 11;
IRrecv irrecv(RECV_PIN);
decode_results results;


 int ledPin = 13;
 String readString;
 int aberta,fechada;
 int abrirp,abrirt,TVabrir,TVfechar;

 void setup() 
 {
  Serial.begin(9600);
  // Pino 11 = Receptor de IR 
  pinMode(13, OUTPUT); //led aceso = cortina fechada, apagado= aberta
  pinMode(2, OUTPUT);  // saida para receber o comando no controle para acender a lampada ( S3 no controle )
  pinMode(3, OUTPUT); //saida para receber o comando no controle para o portao de acesso para carros ( S1 no controle )
  pinMode(4, OUTPUT); // saida para receber o comando no controle para o portao de acesso para pessoas ( S2 no controle )
  pinMode(8, OUTPUT); // Acionamento do comando fechar
  pinMode(9, OUTPUT);// Acionamento do comando abrir
  digitalWrite(8,0);
  digitalWrite(9,0);
  digitalWrite(13,1);
  aberta = 0;
  fechada = 1;
  abrirp,abrirt,TVabrir,TVfechar = 0;
  irrecv.enableIRIn(); // Start the receiver
 }


 void loop() 
 {

  // LOGICA PARA MAPEAR ALGO RECEBIDO PELO CONTROLE REMOTO DA TV E DECODIFICA-LO
  
 if (irrecv.decode(&results)) 
 {
  Serial.println(results.value, HEX);
 
 // CODIGO RECEBIDO PARA ALTERAR O STATUS DA LAMPADA DA GARAGEM

 if(results.value==0xFD52AD)
 {   
  digitalWrite(2, HIGH);
  delay(500);
  digitalWrite(2, LOW);   
  delay(1000);
  irrecv.resume(); // Limpa o decodificador e fica pronto para receber novo codigo
 }
   
   
 // CODIGO PARA ALTERAR A POSIÇÃO DA CORTINA

 // COMANDO FECHAR CORTINA PARCIAL
 
 if(results.value == 0xFDA25D)// apertado botao para baixo 
 {
  TVfechar = 1;TVabrir = 0; 
  irrecv.resume(); // Limpa o decodificador e fica pronto para receber novo codigo 
 }  

 // COMANDO FECHAR CORTINA PARCIAL
 
 if(results.value == 0xFDB847)// apertado botao para cima 
 {
  TVfechar = 0;TVabrir = 1; 
  irrecv.resume(); // Limpa o decodificador e fica pronto para receber novo codigo
 }
     
 // CODIGO PARA ALTERAR A POSIÇÃO DO PORTAO DE ACESSO PARA CARROS

 if (results.value==0xFD32CD)     // portao grande
 {
  digitalWrite(3, HIGH);
  delay(500);
  digitalWrite(3, LOW);   
  irrecv.resume(); // Limpa o decodificador e fica pronto para receber novo codigo
 }

 // CODIGO PARA ALTERAR A POSIÇÃO DO PORTAO DE ACESSO PARA PESSOAS     

 if (results.value==0xFD926D)   // portao pequeno  
 {
  digitalWrite(4, HIGH);
  delay(500);
  digitalWrite(4, LOW);   
  irrecv.resume(); // Limpa o decodificador e fica pronto para receber novo codigo
 }
 
  irrecv.resume(); // Limpa o decodificador e fica pronto para receber novo codigo
 } 

 // +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
 


 // MAPEIA DADOS RECEBIDOS PELA SERIAL

 while (Serial.available()) 
 {
  delay(3);  
  char c = Serial.read();
  readString += c; 
 }
  
 if (readString.length() >0||TVabrir==1||TVfechar==1) 
 {
  Serial.println(readString);

 // PARTE DA LOGICA PARA ABRIR COMPLETAMENTE A CORTINA

 if (readString == "abrirt"&&fechada==1)     
 {
  abrirt = 1;  
  digitalWrite(9,1);
  delay(4000);
  digitalWrite(9,0);
  fechada = 0;
  aberta = 1;
  digitalWrite(13,0);  
 }

 if (readString == "fechart" && aberta==1 && abrirt==1 && abrirp==0)
 {
  abrirt = 0;  
  digitalWrite(8,1);
  delay(4000);
  digitalWrite(8,0);
  fechada = 1;
  aberta = 0;
  digitalWrite(13,1);  
 }
  // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++  

 
 // PARTE DE ACIONAMENTO PARA ABRIR PARCIAL OU PELO CONTROLE REMOTO DA TV   

 if ((readString == "abrirp"||TVabrir==1)&&fechada==1)     
 {
  abrirp = 1;
  digitalWrite(9,1);
  delay(3000);
  digitalWrite(9,0);
  fechada = 0;
  aberta = 1;
  digitalWrite(13,0);  
 }

 if ((readString == "fecharp"||TVfechar==1)&&aberta==1 && abrirp==1 && abrirt==0)
 {
  abrirp = 0;
  digitalWrite(8,1);
  delay(3000);
  digitalWrite(8,0);
  fechada = 1;
  aberta = 0;
  digitalWrite(13,1);  
 }
 // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++  

  readString="";
 }
  TVfechar = 0;TVabrir = 0; 
}

