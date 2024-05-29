/*
 * 
 * Controle via frequencia 2.4 para ferromodelismo pai
 * 
 * Conexos do Modulo de 2.4Ghz
      
   1 - GND
   2 - VCC 3.3V ................Nao usar 5v , queima
   3 - CE to Arduino pin 9
   4 - CSN to Arduino pin 10
   5 - SCK to Arduino pin 13
   6 - MOSI to Arduino pin 11
   7 - MISO to Arduino pin 12
   8 - UNUSED
 * 
 */


 
// Carrega as Bibliotecas
#include <SPI.h>
#include <nRF24L01.h>
#include <RF24.h>

#define CE_PIN   9
#define CSN_PIN 10

#include <Wire.h>
#include <LiquidCrystal_I2C.h>

// Inicializa o display no endereco 0x3F
LiquidCrystal_I2C lcd(0x27,2,1,0,4,5,6,7,3, POSITIVE);

const uint64_t pipe = 0xE8E8F0F0E1LL; // Define a frequencia que sera transmitida

String vv = "";

byte curva[] = {
  B00111,
  B00011,
  B00101,
  B01000,
  B10000,
  B10000,
  B10000,
  B10000
};

byte reta[] = {
  B00100,
  B01110,
  B11111,
  B00100,
  B00100,
  B00100,
  B00100,
  B00100
};
RF24 radio(CE_PIN, CSN_PIN); // Crea o Radio e ativa a transissão do sinal

// Array de 10 elementos
/*
 * SINAIS[0] = velocidade  
 * SINAIS[1] = setido  
 * SINAIS[2] = maquina ligada ou nao
 * SINAIS[3] = luz cabine
 * SINAIS[4] = luz chassi
 * SINAIS[5] = buzina
 * SINAIS[6] = sino
 * SINAIS[7] = maquina selecionada
 * SINAIS[8] = deviracao1
 * SINAIS[9] = derivacao2
 */

int SINAIS[10];  
#define potenciometro A0
#define frente 2
#define tras 3
#define luz 4
#define buzina 5
#define anterior 6
#define menu 7
#define proximo A1
#define comando_servo A2
#define seleciona_servo A3

boolean ativa_pisca_erro = false;
int vezes_erro = 0;
boolean ativa_audio = false;
long UltimoMillis = 0;        // Variável de controle do tempo
long intervalo = 2000;     // Tempo em ms do intervalo a ser executado
long intervalo2 = 200;
unsigned long AtualMillis;



#define led 8
int vezes = 0;
int vezes_buzinou = 0;
int vezes_sino = 0;
int maquina = 1;  // 0 = SD40     1 = AC44i    2 = Ambas
String condicao_maquina = "Desligada";
String maquinas [] = {"SD40","AC44i","Ambas"}; 
int v_maquinas = 1;  // 0 = SD40     1 = AC44i    2 = Ambas
int tela = 0;  //Principal
int vluz = 0;
int vluz2 = 0;
int v_cond_maquina = 0;
int vanterior = 0;
int vmenu = 0;
int vproximo = 0;
int velocidade = 0;
int mapvelocidade = 0;
int valor = 0;
int sentido = 0;   //0 = Frente   1 = Tras
int v_luz = 0; // 0 Lampadas cabine desligadas    1 Lampadas cabine ligadas
int v_luz2 = 0; // 0 Lampadas farol desligadas    1 Lampadas farol ligadas
int v_buzina = 0; //0 Buzina desligadas    1 Buzina ligada
int v_sino = 0; //0 Sino desligado    1 Sino ligado
String protocolo = "";
int servo_1 = 0; //"0" servo fica em 0 graus   "1" servo fica na posicao oposta no campo
int servo_2 = 0; //"0" servo fica em 0 graus   "1" servo fica na posicao oposta no campo
String selecionado_servo = "1";  // 1 seleciona servo 1 e 2 seleciona servo 2   
int vcomando_servo = 0;

void setup() 
{
 Serial.begin(9600);
 lcd.begin(16,2);
 lcd.createChar(1, reta);
 lcd.createChar(2, curva);
 lcd.clear();
 lcd.setCursor(0,0);
 lcd.print (" Ferromodelismo ");
 lcd.setCursor(0,1);
 lcd.print ("                ");
 delay(4000);

 lcd.clear();
 lcd.setCursor(0,0);
 lcd.print (maquinas[maquina]);
 lcd.setCursor(6,0);
 lcd.print("F");
 lcd.setCursor(8,0);
 lcd.print("L:");
 lcd.setCursor(10,0);
 lcd.print(v_luz);
 lcd.setCursor(12,0);
 lcd.print("L2:");
 lcd.setCursor(15,0);
 lcd.print(v_luz2);
 lcd.setCursor(6,1);
 lcd.print ("S1:");
 lcd.setCursor(9,1);
 lcd.write(1); //reta 
 lcd.setCursor(11,1);
 lcd.print ("S2:");
 lcd.setCursor(14,1);
 lcd.write(1); //reta 
 lcd.setCursor(0,1);
 lcd.print ("M = ");
 lcd.setCursor(0,3);
 lcd.print ("OFF  ");
 
 //delay(2000);


 
 
pinMode(frente,INPUT);
pinMode(tras,INPUT);
pinMode(luz,INPUT);
pinMode(buzina,INPUT);

//Menus
pinMode(anterior,INPUT);
pinMode(menu,INPUT);
pinMode(proximo,INPUT);


pinMode(comando_servo,INPUT);
pinMode(seleciona_servo,INPUT);


pinMode(led,OUTPUT);
digitalWrite(led,LOW);

radio.begin(); // Inicia o radio!
radio.openWritingPipe(pipe);//seta o endereco
radio.stopListening(); //Seta que sera transmissor

}


void vvled()//delay
{
  digitalWrite(led,HIGH);
    
  if(sentido == 0)
  {
   SINAIS[1] = 100; //sentido  
  }
  else
  {
   SINAIS[1] = 200; //sentido  
  
  }
  
  if(condicao_maquina == "Desligada")
  {
    SINAIS[2] = 100; //maquina ligada ou nao;
  }
  else
  {
    SINAIS[2] = 200; //maquina ligada ou nao
  }
  if(v_luz == 0)
  {
    SINAIS[3] = 100; //luz cabine
  }
  else
  {
    SINAIS[3] = 200; //luz cabine  
  }
  if(v_luz2 == 0)
  {
    SINAIS[4] = 100; //luz chassi
  }
  else
  {
    SINAIS[4] = 200; //luz chassi
  }
  if(v_buzina ==0)
  {
   SINAIS[5] = 100; //buzina
  }
  else
  {
    SINAIS[5] = 200; //buzina
  }
  if(v_sino == 0)
  {
    SINAIS[6] = 100; //sino
  }
  else
  {
    SINAIS[6] = 200; //sino
  }
  if(v_maquinas == 0)
  {
   SINAIS[7] = 100; //maquina selecionada
  }
  else if (v_maquinas ==1 )
  {
   SINAIS[7] = 101; //maquina selecionada
  }
  else
  {
    SINAIS[7] = 102; //maquina selecionada
  }
  
  if(servo_1 == 0)
  {
   SINAIS[8] = 100; //deviracao1
  }
  else
  {
    SINAIS[8] = 200; //deviracao1
  }
  
  if(servo_2 == 0)
  {
    SINAIS[9] = 100; //derivacao2
  }
  else
  {
   SINAIS[9] = 200; //derivacao2
  }

  
  if(condicao_maquina == "Desligada") // maquina desligada
  {
   SINAIS[0] = 0; //velocidade  
  }
  else
  {
   SINAIS[0] = valor; //velocidade    
  }



   
 
  
  radio.write( SINAIS, sizeof(SINAIS) ); // Comando para enviar o sinal e o sizeof(joystick),serve para enviar o sinal o numero de vezes que foi definido no array

  if(digitalRead(tras)==HIGH && velocidade <10 && tela == 0 && digitalRead(anterior)==LOW)
  {
   //Comando para desligar a maquina
    condicao_maquina = "Desligada";
    v_cond_maquina = 0;
    //Serial.println("A maquina acabou de ser desligada !");
  
    lcd.setCursor(0,1);
    lcd.print ("M = ");
    lcd.setCursor(0,3);
    lcd.print ("OFF  ");
    //delay(2000);
  }
  if(digitalRead(frente)==HIGH && velocidade <10 && tela == 0 && digitalRead(anterior)==LOW)
  {
   //Comando para ligar a maquina
    condicao_maquina = "Ligada";
    v_cond_maquina = 1;
    //Serial.println("A maquina acabou de ser ligada !");
    lcd.setCursor(0,1);
    lcd.print ("M = ");
    lcd.setCursor(0,3);
    lcd.print ("ON   ");
    
    //delay(2000);
  }

  

 lcd.clear();
 lcd.setCursor(0,0);
 lcd.print (maquinas[maquina]);
 lcd.setCursor(6,0);
 if(sentido == 0)
 {
  lcd.print("F");
 }
 else
 {
  lcd.print("T");  
 }
 lcd.setCursor(8,0);
 lcd.print("L:");
 lcd.setCursor(10,0);
 lcd.print(v_luz);
 lcd.setCursor(12,0);
 lcd.print("L2:");
 lcd.setCursor(15,0);
 lcd.print(v_luz2);
 lcd.setCursor(6,1);
 lcd.print ("S1:");
 lcd.setCursor(9,1);
 if(servo_1==0)
 {
  lcd.write(1); //reta 
 }
 else
 {
  lcd.write(2); //curva
 }
 lcd.setCursor(11,1);
 lcd.print ("S2:");
 lcd.setCursor(14,1);
 if(servo_2==0)
 {
  lcd.write(1); //reta 
 }
 else
 {
  lcd.write(2); //curva
 }

 if(condicao_maquina == "Ligada")
 {
  lcd.setCursor(0,1);
  lcd.print ("M = ");
  lcd.setCursor(0,3);
  lcd.print ("ON   ");
 }
 else
 {
  lcd.setCursor(0,1);
  lcd.print ("M = ");
  lcd.setCursor(0,3);
  lcd.print ("OFF  ");
 
 }
  
  valor = 0;
  envia();
}


void envia()
{
  
  
  if(sentido == 0)
  {
   SINAIS[1] = 100; //sentido  
  }
  else
  {
   SINAIS[1] = 200; //sentido  
  
  }
  
  if(condicao_maquina == "Desligada")
  {
    SINAIS[2] = 100; //maquina ligada ou nao;
  }
  else
  {
    SINAIS[2] = 200; //maquina ligada ou nao
  }
  if(v_luz == 0)
  {
    SINAIS[3] = 100; //luz cabine
  }
  else
  {
    SINAIS[3] = 200; //luz cabine  
  }
  if(v_luz2 == 0)
  {
    SINAIS[4] = 100; //luz chassi
  }
  else
  {
    SINAIS[4] = 200; //luz chassi
  }
  if(v_buzina ==0)
  {
   SINAIS[5] = 100; //buzina
  }
  else
  {
    SINAIS[5] = 200; //buzina
  }
  if(v_sino == 0)
  {
    SINAIS[6] = 100; //sino
  }
  else
  {
    SINAIS[6] = 200; //sino
  }
  if(v_maquinas == 0)
  {
   SINAIS[7] = 100; //maquina selecionada
  }
  else if (v_maquinas ==1 )
  {
   SINAIS[7] = 101; //maquina selecionada
  }
  else
  {
    SINAIS[7] = 102; //maquina selecionada
  }
  
  if(servo_1 == 0)
  {
   SINAIS[8] = 100; //deviracao1
  }
  else
  {
    SINAIS[8] = 200; //deviracao1
  }
  
  if(servo_2 == 0)
  {
    SINAIS[9] = 100; //derivacao2
  }
  else
  {
   SINAIS[9] = 200; //derivacao2
  }

  
  if(condicao_maquina == "Desligada") // maquina desligada
  {
   SINAIS[0] = 0; //velocidade  
  }
  else
  {
   SINAIS[0] = valor; //velocidade    
  }



   
 
  
  radio.write( SINAIS, sizeof(SINAIS) ); // Comando para enviar o sinal e o sizeof(joystick),serve para enviar o sinal o numero de vezes que foi definido no array
 
 
}

void loop()
{
 velocidade =  analogRead(potenciometro);
 velocidade = 1024-velocidade; //Para inverter o valor sentido do potenciometro
 valor = velocidade;


 while((valor>10 && vezes==0)==true   )
 {
  lcd.setCursor(0,0);
  lcd.print ("Atencao: Reduza ");
  lcd.setCursor(0,1);
  lcd.print ("a velocidade a 0");
 
  //delay(500);
  velocidade =  analogRead(potenciometro);
  velocidade = 1024-velocidade; //Para inverter o valor sentido do potenciometro
  valor = velocidade;  
 
 }


  AtualMillis = millis();    //Tempo atual em ms
  if(ativa_audio == true)
  {
    if (AtualMillis - UltimoMillis > intervalo) 
    { 
     UltimoMillis = AtualMillis;    // Salva o tempo atual
     ativa_audio = false;
     digitalWrite(led,LOW);
  
     }
  }
  else if (ativa_pisca_erro == true)
  {
    if (AtualMillis - UltimoMillis > intervalo2) 
    { 
     UltimoMillis = AtualMillis;    // Salva o tempo atual
     if(vezes_erro >=10)
     {
     ativa_pisca_erro = false;
     digitalWrite(led,LOW);
     vezes_erro = 0;
     }
     else
     {
      digitalWrite(led,!digitalRead(led));
      vezes_erro++;
     }
    }
  }
  else
  {
     UltimoMillis = AtualMillis;    // Salva o tempo atual
  }





 
 if(vezes == 0)
 {
  vezes = 1;
  

 lcd.clear();
 lcd.setCursor(0,0);
 lcd.print (maquinas[maquina]);
 lcd.setCursor(6,0);
 lcd.print("F");
 lcd.setCursor(8,0);
 lcd.print("L:");
 lcd.setCursor(10,0);
 lcd.print(v_luz);
 lcd.setCursor(12,0);
 lcd.print("L2:");
 lcd.setCursor(15,0);
 lcd.print(v_luz2);
 lcd.setCursor(6,1);
 lcd.print ("S1:");
 lcd.setCursor(9,1);
 lcd.write(1); //reta 
 lcd.setCursor(11,1);
 lcd.print ("S2:");
 lcd.setCursor(14,1);
 lcd.write(1); //reta 
 lcd.setCursor(0,1);
 lcd.print ("M = ");
 lcd.setCursor(0,3);
 lcd.print ("OFF  ");
 }


 
 if(digitalRead(frente)==HIGH && velocidade <10)
 {
  //Serial.println("Frente");
  sentido = 0;
  envia();
  ativa_audio = true;
  vvled();
  //delay;
 }
 else
 {
  if(digitalRead(frente)==HIGH && velocidade >10 && tela == 0) 
  {
   ativa_pisca_erro = true;
  }

  
 }
 
 if(digitalRead(tras)==HIGH && velocidade <10 && tela == 0)
 {
  //Serial.println("Tras");
  sentido = 1;
  envia();
  ativa_audio = true;
  vvled();
  //delay;
 }
 else
 {
  if(digitalRead(tras)==HIGH && velocidade >10 && tela == 0) 
  {
   ativa_pisca_erro = true; 
  } 
 }
 
 
 if(digitalRead(luz)==HIGH)
 {
  vluz++;
 }
 else
 {
  vluz = 0;
 }

 if(vluz>15)
 {
  if(v_luz == 0)
  {
    v_luz = 1;
    //Serial.println("Lampada cabine ligada!");
    envia();
  }
  else
  {
    v_luz = 0;
    //Serial.println("Lampada cabine desligada!");
    envia();
    
  }
  
  //delay;
  ativa_audio = true;
  vvled();
 }


 if(digitalRead(buzina)==HIGH)
 {
  v_buzina = 1;
 }
 else
 {
  v_buzina = 0;
  if(vezes_buzinou == 1)
  {
   lcd.clear();
   lcd.setCursor(0,0);
   lcd.print (maquinas[maquina]);
   lcd.setCursor(6,0);
   if(sentido == 0)
   {
    lcd.print("F");
   }
   else
   {
    lcd.print("T");
   }
   lcd.setCursor(8,0);
   lcd.print("L::");
   lcd.setCursor(10,0);
   lcd.print(v_luz);
   lcd.setCursor(12,0);
   lcd.print("L2:");
   lcd.setCursor(15,0);
   lcd.print(v_luz2);
   lcd.setCursor(6,1);
   lcd.print ("S1:");
   lcd.setCursor(9,1);
   if(servo_1==0)
   {
    lcd.write(1); //reta 
   }
   else
   {
    lcd.write(2); //curva
   }
   lcd.setCursor(11,1);
   lcd.print ("S2:");
   lcd.setCursor(14,1);
   if(servo_2==0)
   {
    lcd.write(1); //reta 
   }
   else
   {
    lcd.write(2); //curva
   }
   digitalWrite(led,LOW);
  }
  vezes_buzinou = 0;
 }


//COMANDO PARA OS SERVOS ****************************************************************************************************************************8

if(digitalRead(seleciona_servo)==LOW)
{
 selecionado_servo = "1";
}
else
{
 selecionado_servo = "2";
}

//Serial.println (selecionado_servo); 
//Monitoro se deu comando
if(digitalRead(comando_servo)==HIGH)
{
 vcomando_servo++;
}
else
{
 if(tela == 0)
 {
  vcomando_servo = 0;
 }
} // Fecha else

 if(vcomando_servo>10 && tela == 0)
 {
  
  if(selecionado_servo == "1")
  {
   //Comando no servo 1
   if(servo_1 == 0)
   {
    servo_1 = 1;
    lcd.setCursor(9,1);
    lcd.write(2); //curva 
   }
   else
   {
    servo_1 = 0;
    lcd.setCursor(9,1);
    lcd.write(1); //reta 
   }
    
  }
  else
  {
   //Comando no servo 2 
   if(servo_2 == 0)
   {
    servo_2 = 1;
    lcd.setCursor(14,1);
    lcd.write(2); //curva 
   }
   else
   {
    servo_2 = 0;
    lcd.setCursor(14,1);
    lcd.write(1); //reta 
   }  
  }
  //Serial.print("Dado o comando para acionar o servo ");
  //Serial.print(selecionado_servo);
  //Serial.print(" e colocado na posicao ");
  if(selecionado_servo == "1")
  {
   //Serial.println (servo_1);
  }
  else
  {
   //Serial.println (servo_2);   
  }
  
  vcomando_servo = 0;
  envia();
  ativa_audio = true;
  vvled();
  //delay;
 }



   
//***************************************************************************************************************************************************


 if(digitalRead(menu)==HIGH && velocidade <10)
 {
  vmenu++;
 }
 else if(digitalRead(menu)==HIGH && velocidade >10)
 {
  ativa_pisca_erro = true;
 }
 
 else
 {
   if(tela == 0)
   {
    vmenu = 0;
   }
   if(tela == 1 && valor >10)
   {
    //ativa_pisca_erro = true;
   }
 
  
 }

 if(vmenu>2 && tela == 0)
 {
  // Entra no menu
  tela = 1;
  vmenu = 0;
  //Serial.println("Entrou no menu para configuracoes");
  lcd.clear();
  lcd.setCursor(0,0);
  lcd.print ("> Menu");
  lcd.setCursor(0,1);
  lcd.print ("Mod.: ");
  lcd.setCursor(6,1);
  lcd.print (maquinas[maquina]);

  while(digitalRead(menu)==HIGH)
  {
    delay(1000);
  }
 }
 if(vmenu>5 && tela == 1)
 {
  // Sai do menu e confirma qual maquina selecionou
  tela = 0;
  vmenu = 0;
  ativa_audio = true;
  vvled();
 }

 if(digitalRead(anterior)==LOW && tela == 0 && digitalRead(tras)==LOW)
 {
  v_sino++; // Liga o sino
 }
 else
 {
  v_sino = 0; //Desliga o sino
  
 }
  if(vezes_sino >= 35)
  {
   lcd.clear();
   lcd.setCursor(0,0);
   lcd.print (maquinas[maquina]);
   lcd.setCursor(6,0);
   if(sentido == 0)
   {
    lcd.print("F");
   }
   else
   {
    lcd.print("T");
   }
   lcd.setCursor(8,0);
   lcd.print("L::");
   lcd.setCursor(10,0);
   lcd.print(v_luz);
   lcd.setCursor(12,0);
   lcd.print("L2:");
   lcd.setCursor(15,0);
   lcd.print(v_luz2);
   lcd.setCursor(6,1);
   lcd.print ("S1:");
   lcd.setCursor(9,1);
   if(servo_1==0)
   {
    lcd.write(1); //reta 
   }
   else
   {
    lcd.write(2); //curva
   }
   lcd.setCursor(11,1);
   lcd.print ("S2:");
   lcd.setCursor(14,1);
   if(servo_2==0)
   {
    lcd.write(1); //reta 
   }
   else
   {
    lcd.write(2); //curva
   }
   digitalWrite(led,LOW);
  vezes_sino = 0;
  } // fecha vezes_sino >=5

 
 if(digitalRead(anterior)==LOW && tela == 1)
 {
  vanterior++;
 }
 else
 {
  vanterior = 0;
 }
 
 if(vanterior>1 && tela == 1)
 {
  // Troca maquina
  maquina = maquina - 1;
  if(maquina < 0)
  {
    maquina = 0;
  }
  vanterior = 0;
  lcd.clear();
  lcd.setCursor(0,0);
  lcd.print ("> Menu");
  lcd.setCursor(0,1);
  lcd.print ("Mod.: ");
  lcd.setCursor(6,1);
  lcd.print (maquinas[maquina]);

  Serial.print("Mudou para a maquina ");
  Serial.println(maquinas[maquina]);
  delay(1000);
 }



 if(digitalRead(proximo)==LOW && tela == 0)
 {
  vluz2++;
 }
 else
 {
  vluz2 = 0;
 }

 if(vluz2>15)
 {
  if(v_luz2 == 0)
  {
    v_luz2 = 1;
    //Serial.println("Lampadas farol ligadas!");
  }
  else
  {
    v_luz2 = 0;
    //Serial.println("Lampadas farol desligadas!");
  }
  envia();
  ativa_audio = true;
  vvled();
 }


 if(digitalRead(proximo)==LOW && tela == 1)
 {
  vproximo++;
 }
 else
 {
  vproximo = 0;
 }
 
 if(vproximo>1 && tela == 1)
 {
  // Troca maquina
  maquina = maquina + 1;
  if(maquina >2)
  {
    maquina = 2;
  }
  vproximo = 0;
  
  lcd.clear();
  lcd.setCursor(0,0);
  lcd.print ("> Menu");
  lcd.setCursor(0,1);
  lcd.print ("Mod.: ");
  lcd.setCursor(6,1);
  lcd.print (maquinas[maquina]);
  Serial.print("Mudou para a maquina ");
  Serial.println(maquinas[maquina]);
  ////delay(1000);
 }

 v_maquinas = maquina;



String vvalor = String(valor);

if(valor<1000)
{
  vvalor = "0"+ vvalor;
}

if(valor<100)
{
  vvalor = "0" + vvalor;
}

if(valor<10)
{
  vvalor = "0" + vvalor;
}






 

 if(tela == 0)
 {
  /*
  if(condicao_maquina == "Desligada")
  {
   protocolo = "0000 - " + String(sentido)   +  " - " + v_cond_maquina + " - " + v_luz + " - " + v_luz2 + " - " + v_buzina + " - " + v_sino + " - " + v_maquinas + " - " + String(servo_1) + " - " + String(servo_2);
  }
  else
  {
   protocolo = vvalor+ " - " + String(sentido)+  " - " + v_cond_maquina + " - " + v_luz + " - " + v_luz2 + " - " + v_buzina + " - " + v_sino + " - " + v_maquinas + " - " + String(servo_1) + " - " + String(servo_2);
  }
*/
  //Serial.println( protocolo );



  








  
 } // fecha if tela == 0
 else if(tela == 1)
 {
  
 }
















  envia();
 
  //Limpa dados por segurança
  valor = 0;
  
}
