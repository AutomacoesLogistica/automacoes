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
 * Revisada dia 30/07/2017 as 15:44
 * 
 * 
 * 
 */
 
#define RED 5
#define GREEN 6
#define BLUE 9

int luz,natal,som;
int corSom;
int corLuz;
int SOM;
int valor1;
String readString;
int recebido;




#include <IRremote.h>
int RECV_PIN = 11;
IRrecv irrecv(RECV_PIN);
decode_results results;


int ledPin = 13;
int aberta,fechada;
int abrirp,abrirt,TVabrir,TVfechar;




// usado no timer de alteração do modo SomRandom
long valorTempo = 0; 
long intervalo = 1000; // DEFINE O TEMPO DO TIMER
int numero_vezes_loop;
int timer_ativo;
int ativa_Random;

int seleciona;



void setup() 
{
 Serial.begin(9600);
 // Pino 11 = Receptor de IR 
 pinMode(13, OUTPUT); //led aceso = cortina fechada, apagado= aberta
 pinMode(2, OUTPUT);  // saida para receber o comando no controle para acender a lampada ( S3 no controle )
 pinMode(3, OUTPUT); //saida para receber o comando no controle para o portao de acesso para carros ( S1 no controle )
 pinMode(4, OUTPUT); // saida para receber o comando no controle para o portao de acesso para pessoas ( S2 no controle )
 pinMode(RED,OUTPUT);//5
 pinMode(GREEN,OUTPUT);//6
 pinMode(7, OUTPUT);// Acionamento do comando abrir
 pinMode(8, OUTPUT); // Acionamento do comando fechar
 pinMode(BLUE,OUTPUT);//9
 digitalWrite(8,0);
 digitalWrite(7,0);
 digitalWrite(13,1);
digitalWrite(RED,0);
digitalWrite(GREEN,0);
digitalWrite(BLUE,0);
 
 aberta = 0;
 fechada = 1;
 abrirp,abrirt,TVabrir,TVfechar = 0;
 irrecv.enableIRIn(); // Start the receiver
 delay(300);

luz = 0;
natal = 0;
som = 1; 
corSom = 1;
corLuz = 6;
SOM = 0;
timer_ativo = 0;
numero_vezes_loop = 0;  
ativa_Random=0;
valor1=255;
}

void loop() 
{

// usasdo no timer do modo de SomRandom
 unsigned long tempo = millis();


if (timer_ativo == 1)
{
  if(tempo - valorTempo > intervalo) 
 {
  valorTempo = tempo;
   ativa_Random = 1;
 }

}

// ********************************************************************************************************************************************************************************

  
  // LOGICA PARA MAPEAR ALGO RECEBIDO PELO CONTROLE REMOTO DA TV E DECODIFICA-LO
  
 if (irrecv.decode(&results)) 
 {
  if (results.value>0)
  {
  Serial.print("Recebido :  ");
  Serial.println(results.value,HEX);
  delay(100);
  }



  
 if(results.value==0xFD52AD || results.value==0x168E56C1 ) //comando da luz da garagem
 {   
  Serial.println("Luz Garagem");
  digitalWrite(2, HIGH);
  delay(500);
  digitalWrite(2, LOW);   
 
 }
   









   
 // CODIGO PARA ALTERAR A POSIÇÃO DA CORTINA

 // COMANDO FECHAR CORTINA PARCIAL
  if(results.value == 0xFDA25D || results.value == 0xCEBE4CC1)// apertado botao para baixo 
 {
  
  TVfechar = 1;TVabrir = 0; 
 
 }  

 // COMANDO ABRIR CORTINA PARCIAL
 
 if(results.value == 0xFDB847  || results.value == 0x7E9F81D  )// apertado botao para cima 
 {
  
  TVfechar = 0;TVabrir = 1; 
 
 }

     
 // CODIGO PARA ALTERAR A POSIÇÃO DO PORTAO DE ACESSO PARA CARROS

 if (results.value==0xFD32CD || results.value==0xBA4375E1)     // portao grande
 {
  Serial.println("Portao Grande");
  digitalWrite(3, HIGH);
  delay(500);
  digitalWrite(3, LOW);
  
 }

 // CODIGO PARA ALTERAR A POSIÇÃO DO PORTAO DE ACESSO PARA PESSOAS     

 if (results.value==0xFD926D || results.value==0x63EA1CA9)   // portao pequeno  
 {
  Serial.println("Portao Pequeno");
  digitalWrite(4, HIGH);
  delay(500);
  digitalWrite(4, LOW);   
 
 }











// ALTERNA ENTRE O MODO DE LUZ E MODO DE SOM APERTANDO O BOTAO OPTION *****************************

if (results.value==0xFDE817)   // botao OPTION
 {
  seleciona = 0;

  if (luz==0 && som==1 && seleciona==0)
  {
    Serial.println("Em Modo Luz");
   luz = 1;
   som = 0;
   seleciona=1; 
  }
  if (som==0 && luz==1 && seleciona==0)
  {
    Serial.println("Em Modo Som");
   luz = 0;
   som = 1;
   seleciona=1; 
  }
  seleciona=0; 
 
 
  }

//***************************************************************************************************

// RESETA O SISTEMA SE APERTAR O BOTAO PONTO

if (results.value==0xFD30CF)     // BOTAO PONTO
 {
  Serial.println("Resetado Sistema");
  delay(300);
  setup();
 }


//***************************************************************************************************

// DESLIGA O SISTEMA SE APERTAR O BOTAO STOP

 if (results.value==0xFDCA35)     // BOTAO STOP
 {
  Serial.println("Desligado Sistema");
 digitalWrite(RED,0);
 digitalWrite(GREEN,0);
 digitalWrite(BLUE,0);
  luz=0;
  som=0;
  
 }
//***************************************************************************************************

// LIGA O SISTEMA SE APERTAR O BOTAO PLAY

if (results.value==0xFD4AB5)     // BOTAO PLAY
 {
  Serial.println("Ligado Sistema");
  luz=0;
  som=1;

 }


//***************************************************************************************************

// ALTERNA O MODO DE CORES


// NO MODO SOM ATIVO

// Proxima cor ***********
if (results.value==0xFD8A75 && som==1) //   BOTÃO PROXIMO
 {
 Serial.println("Proxima Cor"); 
 digitalWrite(RED,0);
 digitalWrite(GREEN,0);
 digitalWrite(BLUE,0); 
 corSom = corSom+1;
 
 }
 
// Cor anterior ***********
if (results.value==0xFD0AF5 && som==1) //   BOTÃO ANTERIOR
{
  Serial.println("Cor Anterior");
 digitalWrite(RED,0);
 digitalWrite(GREEN,0);
 digitalWrite(BLUE,0); 
 corSom = corSom-1;
 if (corSom<=-1)
 {
  corSom = 13; 
 }
}


//**********************


// NO MODO LUZ ATIVO

// Proxima cor ***********
if (results.value==0xFD8A75 && som==1) //   BOTÃO PROXIMO
 {
  Serial.println("Proxima Cor");
 digitalWrite(RED,0);
 digitalWrite(GREEN,0);
 digitalWrite(BLUE,0); 
 corLuz = corLuz+1;
 }
 
// Cor anterior ***********
if (results.value==0xFD0AF5 && som==1) //   BOTÃO ANTERIOR
{
  Serial.println("Cor Anterior");
 digitalWrite(RED,0);
 digitalWrite(GREEN,0);
 digitalWrite(BLUE,0); 
 corLuz = corLuz-1;
 if (corLuz<=-1)
 {
  corLuz = 13; 
 }
 
}

//*************************************************************************************************************************************************************

// MODO DE SOM ALEATORIO


// ATIVAR MODO ALEATORIO DO SOM
 
 if (results.value==0xFD9A65 && som==1) //   BOTÃO GUIDE
{
  Serial.println("Ativado Modo Aleatorio do Som");
 SOM = 1;
 timer_ativo=1;
 
}




// DESATIVAR MODO ALEATORIO DO SOM

 if (results.value==0xFD629D && som==1) //   BOTÃO INFO
{
  Serial.println("Desativa Modo Aleatorio do Som");
 SOM = 0;
 timer_ativo=0;

}



//*************************************************************************************************************************************************************



// MODO DE CONTROLE DE BRILHO

// DIMINUINDO O BRILHO

if (results.value==0xFDB24D && luz==1) //   BOTÃO ATRASAR
{
  Serial.println("Diminui Brilho");
  valor1 = valor1-15;
  if(valor1<0)
  {
   valor1 = 0;  
  }
 
}

//AUMENTANDO O BRILHO
  
 if (results.value==0xFD728D && luz==1) //   BOTÃO ADIANTAR
{  
 Serial.println("Aumenta Brilho"); 
  valor1 = valor1+15;
  if(valor1>255)
  {
   valor1 = 255;  
  }
 
}
  irrecv.resume(); // Limpa o decodificador e fica pronto para receber novo codigo

  
 }

// FINALIZA O MODO DE RECEPÇÃO POR IR
//*************************************************************************************************************************************************************











 // MAPEIA DADOS RECEBIDOS PELA SERIAL

 while (Serial.available()) 
 {
  delay(3);  
  char c = Serial.read();
  readString += c; 
 }
  
 if (readString.length() >0||TVabrir==1||TVfechar==1) 
 {
  Serial.println(readString); //imprime o que chegou na serial


 // PARTE DA LOGICA PARA ABRIR COMPLETAMENTE A CORTINA


 if (readString == "portP")     
 {
  digitalWrite(4, HIGH);
  delay(500);
  digitalWrite(4, LOW);   
 }

 if (readString == "portG")     
 {
  digitalWrite(3, HIGH);
  delay(500);
  digitalWrite(3, LOW); 
 }

 if (readString == "LampG")     
 {
  digitalWrite(2, HIGH);
  delay(500);
  digitalWrite(2, LOW);   
 }
 
 if (readString == "abrirt"&&fechada==1)     
 {
  abrirt = 1;  
  digitalWrite(7,1);
  delay(4000);
  digitalWrite(7,0);
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
  Serial.println("Abrir Cortina");
  abrirp = 1;
  digitalWrite(7,1);
  delay(3000);
  digitalWrite(7,0);
  fechada = 0;
  aberta = 1;
  digitalWrite(13,0);  
 }

 if ((readString == "fecharp"||TVfechar==1)&&aberta==1 && abrirp==1 && abrirt==0)
 {
  Serial.println("Fechar cortina");
  abrirp = 0;
  digitalWrite(8,1);
  delay(3000);
  digitalWrite(8,0);
  fechada = 1;
  aberta = 0;
  digitalWrite(13,1);  
 }
 // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++  





if (readString == "r") // colocar o que quer receber na serial para ativar algo
 {
 setup();
 }



 if (readString == "l") // colocar o que quer receber na serial para ativar algo
 {
 digitalWrite(RED,0);
 digitalWrite(GREEN,0);
 digitalWrite(BLUE,0); 
 valor1 = 255; 
 luz = 1;
 som = 0;
 }

 if (readString == "s") // colocar o que quer receber na serial para ativar algo
 {
 digitalWrite(RED,0);
 digitalWrite(GREEN,0);
 digitalWrite(BLUE,0); 
 luz = 0;
 som = 1;
 }

 if (readString == "off") // colocar o que quer receber na serial para ativar algo
 {
 digitalWrite(RED,0);
 digitalWrite(GREEN,0);
 digitalWrite(BLUE,0);
  luz=0;
  som=0;
 
 }

 if (readString == "on") // colocar o que quer receber na serial para ativar algo
 {
  
  luz=0;
  som=1;
 }

 
if (readString == "a"&&som==1) // colocar o que quer receber na serial para ativar algo
 {
 digitalWrite(RED,0);
 digitalWrite(GREEN,0);
 digitalWrite(BLUE,0); 
 corSom = corSom+1;
 }

 if (readString == "a"&&luz==1) // colocar o que quer receber na serial para ativar algo
 {
 digitalWrite(RED,0);
 digitalWrite(GREEN,0);
 digitalWrite(BLUE,0); 
 corLuz = corLuz+1;
 }


if (readString == "b"&&som==1) // colocar o que quer receber na serial para ativar algo
 {
 digitalWrite(RED,0);
 digitalWrite(GREEN,0);
 digitalWrite(BLUE,0); 
 corSom = corSom-1;
  if (corSom<=-1)
 {
  corSom = 13; 
 }
 }

 if (readString == "b"&&luz==1) // colocar o que quer receber na serial para ativar algo
 {
 digitalWrite(RED,0);
 digitalWrite(GREEN,0);
 digitalWrite(BLUE,0); 
 corLuz = corLuz-1;
  if (corLuz<=-1)
 {
  corLuz = 13; 
 }
 
 }

if (readString == "sa" && som==1) // colocar o que quer receber na serial para ativar algo
 {
 Serial.println("Som Aleatorio");
 SOM = 1;
 timer_ativo=1;
 readString = "";
 }
 
 if (readString == "ssa" && som==1) // colocar o que quer receber na serial para ativar algo
 {
 Serial.println("Saiu do Som Aleatorio");
 SOM = 0;
 timer_ativo=0;
 readString = "";
 }

  if (readString == "-" && luz==1) // colocar o que quer receber na serial para ativar algo
  {
  valor1 = valor1-15;
  if(valor1<0)
  {
   valor1 = 0;  
  }
  }
  
  if (readString == "=" && luz==1) // colocar o que quer receber na serial para ativar algo
  {   
  valor1 = valor1+15;
  if(valor1>255)
  {
   valor1 = 255;  
  }
  }
  
  readString = ""; //limpar a serial

 }











if (luz==1)
{
Luz();
}

if (som==1)
{
Som();
}

if (SOM == 1)
{
  if( ativa_Random==1)
  {
   corSom = random(0,12);
   ativa_Random=0;
  } 
}
TVfechar = 0;TVabrir = 0; 














 
}

