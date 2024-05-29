/*
 * 
 *  UTILIZA O MICROCRONTROLADOR ESP8266 NODEMCU
 * 
 * 
 * 
 * CENTRAL DE CONTROLE DO GUINCHO AUTOMATIZADO
 * 
 * TRABALHA EM REDE RS485 USANDO A CENTRAL LABORATORIO COMO APOIO
 * 
 * 
 * 
 * 
 * 
 */




#include <Wire.h>
#include <EEPROM.h>
#include <Encoder.h>
#include<SoftwareSerial.h>
long int newPosition;
long int ValorInicial;
long int ValorCorrente;
long int oldPosition;
long int Valor;
int bloqueia_subida = 0; // Quando atuar Fim de curso de subir a variavel vai para 1 e nao aceita comando para subir, somente ao dar comando descer que ele joga ela para 0 e permite descer apenas
int bloqueia_descida = 0;// Quando atuar Fim de curso de descida a variavel vai para 1 e nao aceita comando para descer, somente ao dar comando subir que ele joga ela para 0 e permite subir apenas
int modo = 0; // 0 Automatico em 1 manual
String readString;
String StatusPosicao = "NaGaragem";
String UltimaMensagemRecebida = "";
int precisao_pulso = 5; // Filtro para não perder pulsos do andar e nao parar

// Valor para variaveis do motor giro
#define motor_giro A0
#define sentido_motor_giro A1 // em 0 para descer, em 1 para subir
#define valor_fc_subida 3
int fc_subida;

// Valor para variaveis do motor posicao
#define motor_posicao A2
#define sentido_motor_posicao A3 // em 0 para descer, em 1 para subir
#define valor_fc_parede 11 // em 0 parado na garagem
#define valor_fc_lugar 12 // em 0 parado no lugar e libera subir ou descer
int fc_parede;
int fc_lugar;

// Variaveis dos andares
int valor_primeiro_andar = 1940;
int valor_segundo_andar = 1092; // tem q ser 959 para subir
int valor_terceiro_andar = 540; // tem q ser 388 para subir
int valor_garagem = 100;

#define valor_cmd_subir A4  // Atua em 0
#define valor_cmd_descer A5 // Atua em 0
int cmd_subir;
int cmd_descer;

Encoder myEnc(2, 4); // DT , CLK



#define transmitir 7 // Pino DE e RE - Transmissao     PINO D3
#define pinRX 5 // Pino RO                             PINO D1
#define pinTX 6 // Pino DI                             PINO D2
SoftwareSerial RS485(pinRX, pinTX);
#define LedStatus 13 // LedStatus                      PINO D0

#define LedStatusAndar3 10
#define LedStatusAndar2 9
#define LedStatusAndar1 8

void setup() 
{
 Serial.begin(4800);
 RS485.begin(4800);
 pinMode(transmitir, OUTPUT);
 digitalWrite(transmitir, LOW);
 pinMode(LedStatus, OUTPUT); // Define LedMensagem como saida
 digitalWrite(LedStatus, LOW); // Inicia apagagado

 pinMode(LedStatusAndar3, OUTPUT); // Define como saida
 digitalWrite(LedStatusAndar3, LOW); // Inicia apagagado
 pinMode(LedStatusAndar2, OUTPUT); // Define como saida
 digitalWrite(LedStatusAndar2, LOW); // Inicia apagagado
 pinMode(LedStatusAndar1, OUTPUT); // Define como saida
 digitalWrite(LedStatusAndar1, LOW); // Inicia apagagado

 // Definindo as portas do motor icamento
 pinMode(motor_giro, OUTPUT); // Define como saida
 digitalWrite(motor_giro, LOW); // Inicia desligada
 pinMode(sentido_motor_giro, OUTPUT); // Define como saida
 digitalWrite(sentido_motor_giro, LOW); // Inicia desligada e pronto para descida
 pinMode(valor_fc_subida, INPUT); // Define como entrada //Em 0 atua para cortar a subida


 // Definindo as portas do motor posicao
 pinMode(motor_posicao, OUTPUT); // Define como saida
 digitalWrite(motor_posicao, LOW); // Inicia desligada
 pinMode(sentido_motor_posicao, OUTPUT); // Define como saida
 digitalWrite(sentido_motor_posicao, LOW); // Inicia desligada e pronto para descida
 pinMode(valor_fc_parede, INPUT); // Define como entrada // Em 0 atua para indicar a posicao de guardado na garagem
 pinMode(valor_fc_lugar, INPUT); // Define como entrada // Em 0 atua para indicar a posicao de permicao de funcionar para subir ou descer


 pinMode(valor_cmd_subir, INPUT); 
 pinMode(valor_cmd_descer, INPUT); 

 ValorInicial = 10;
 int hiByte1 = (EEPROM.read(0)* 255)+(EEPROM.read(0));
 int loByte1 = EEPROM.read(1); 
 ValorCorrente = ((hiByte1)+(loByte1));
 oldPosition  = -999;

int ValorStatusPosicao = EEPROM.read(2);
if ( ValorStatusPosicao == 0 ){StatusPosicao = "NaGaragem";}
if ( ValorStatusPosicao == 4 ){StatusPosicao = "NaPosicao";}
if ( ValorStatusPosicao == 3 ){StatusPosicao = "No3Andar";}
if ( ValorStatusPosicao == 2 ){StatusPosicao = "No2Andar";}
if ( ValorStatusPosicao == 1 ){StatusPosicao = "No1Andar";} 


 fc_subida = digitalRead(valor_fc_subida);
 fc_parede = digitalRead(valor_fc_parede);
 fc_lugar = digitalRead(valor_fc_lugar);
 cmd_subir = digitalRead(valor_cmd_subir);
 cmd_descer = digitalRead(valor_cmd_descer);


} // Fecha void setup



void GirarSubir()
{
  ////Serial.println("GirarSubir");
  if ( fc_lugar == 0 ) // So libera subir caso o guincho esteja na posicao permitda
  {
    //Serial.println("GirouSubir");
   if ( fc_subida != 0 ) //Deixa subir apenas se não estiver atuado o fim de curso de emergencia, e atua em 0
   {
     digitalWrite(motor_giro, HIGH); //Habilita alimentação do motor
     digitalWrite(sentido_motor_giro, HIGH); //Habilita a posicao para subida
   
   }
   else
   {
    StatusPosicao = "NaPosicao"; 
    EEPROM.write(2,4); // Salva na memoria 2 o valor 4 que é na posicao de ir para a garagem
    Parar(); // Se atuar o fim de curso para o motor
   }

  } // Fecha se fc_lugar == 0
 
} // Fecha GirarSubir()

void GirarDescer()
{
  //Serial.println("GirarDescer");
  
  if ( fc_lugar == 0 && bloqueia_descida == 0) // So libera o guincho caso esteja na posicao permitda e nao esteja atuado o fim de curso de descida virtual
  {
   //Serial.println("GirouDescer");
   digitalWrite(motor_giro, HIGH); //Liga alimentação do motor
   digitalWrite(sentido_motor_giro, LOW); //Habilita a posicao para descida
   if ( Valor >= (valor_primeiro_andar+precisao_pulso)) // Se descer mais que deve manda parar
   {
    //Serial.println("Emergencia");
    bloqueia_descida = 1; // Bloqueia descer
    Parar();
   }



   
  } // Fecha se fc_lugar == 0
 
}// Fecha GirarDescer()





void Andar3()
{
 bloqueia_subida = 0; // Somente no 3 andar retira o sinal do bloqueio
 //Serial.println("Passou no 3 Andar"); 
 digitalWrite(LedStatusAndar3, HIGH);
 digitalWrite(LedStatusAndar2, LOW);
 digitalWrite(LedStatusAndar1, LOW);
 StatusPosicao = "No3Andar";
 EEPROM.write(2,3); // Salva na memoria 2 o valor 3 que é no 3 andar
  
 if ( UltimaMensagemRecebida == "ir_1andar" && StatusPosicao == "No3Andar"){ GirarDescer(); } //Manda descer pois ainda está no terceiro andar
 if ( UltimaMensagemRecebida == "ir_2andar" && StatusPosicao == "No3Andar"){ GirarDescer(); } //Manda descer pois ainda está no terceiro andar
 if ( UltimaMensagemRecebida == "ir_3andar" && StatusPosicao == "No3Andar"){ Parar(); } //Manda parar pois ja esta no terceiro andar

 digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
 RS485.print("esta_no_andar_3");
 digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
 digitalWrite(LedStatus,HIGH);

}
void Andar2()
{
 bloqueia_descida = 0; // Somente libera sair defeito de fim de curso de descida atuado ao voltar para o 2 andar
 //Serial.println("Passou no 2 Andar");
 digitalWrite(LedStatusAndar2, HIGH);
 digitalWrite(LedStatusAndar3, LOW);
 digitalWrite(LedStatusAndar1, LOW);
 StatusPosicao = "No2Andar";
 EEPROM.write(2,2); // Salva na memoria 2 o valor 2 que é no 2 andar

 if ( UltimaMensagemRecebida == "ir_1andar" && StatusPosicao == "No2Andar"){ GirarDescer(); } //Manda descer pois ainda está no segundo andar
 if ( UltimaMensagemRecebida == "ir_2andar" && StatusPosicao == "No2Andar"){ Parar(); } //Manda parar pois ja esta no segundo andar
 if ( UltimaMensagemRecebida == "ir_3andar" && StatusPosicao == "No2Andar"){ GirarSubir(); } //Manda subir pois ainda está no segundo andar

  digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
  RS485.print("esta_no_andar_2");
  digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
  digitalWrite(LedStatus,HIGH);


}

void Andar1()
{
 //Serial.println("Passou no 1 Andar"); 
 digitalWrite(LedStatusAndar1, HIGH);
 digitalWrite(LedStatusAndar2, LOW);
 digitalWrite(LedStatusAndar3, LOW);
 StatusPosicao = "No1Andar";  
 EEPROM.write(2,1); // Salva na memoria 2 o valor 1 que é no 1 andar
 if ( UltimaMensagemRecebida == "ir_1andar" && StatusPosicao == "No1Andar"){ Parar(); } //Para pois ja está no primeiro andar
 if ( UltimaMensagemRecebida == "ir_2andar" && StatusPosicao == "No1Andar"){ GirarSubir(); } //Manda subir pois ainda está no primeiro andar
 if ( UltimaMensagemRecebida == "ir_3andar" && StatusPosicao == "No1Andar"){ GirarSubir(); } //Manda subir pois ainda está no primeiro andar

 digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
 RS485.print("esta_no_andar_1");
 digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
 digitalWrite(LedStatus,HIGH);

}


void Garagem()
{
 digitalWrite(LedStatusAndar1, LOW);
 digitalWrite(LedStatusAndar2, LOW);
 digitalWrite(LedStatusAndar3, LOW);
 StatusPosicao = "NaPosicao"; 
 EEPROM.write(2,4); // Salva na memoria 2 o valor 4 que é na posicao de ir para a garagem
 //Serial.println("Indo para Garagem");

// Verifico se esta no lugar e se esta recolido a corda
if (fc_lugar == 0 && fc_parede !=0 && ((   valor_garagem-precisao_pulso) && ( Valor <= valor_garagem+precisao_pulso) ))
{
  if (digitalRead(motor_posicao) == 0 && fc_parede != 0)// Somente para não ficar entrando toda hora aqui e apenas uma unica vez
   { 
    while ( fc_parede != 0 )
    {
     fc_parede = digitalRead(valor_fc_parede);
     fc_lugar = digitalRead(valor_fc_lugar);
     
     digitalWrite(motor_posicao, HIGH); // Liga Motor
     digitalWrite(sentido_motor_posicao, HIGH); // Liga para guardar
     //Serial.println("aaa");
    }
    //Serial.println("bbb");
    if ( fc_parede == 0 )
    {
       //Serial.println("ccc");
       //Serial.println("Na Garagem");
       
       digitalWrite(motor_posicao, LOW); // Desliga Motor
       digitalWrite(sentido_motor_posicao, LOW); // Desliga Motor
       StatusPosicao = "NaGaragem"; 
       EEPROM.write(2,0); // Salva na memoria 2 o valor 0 que é na posicao garagem
     
    }
  }
 }  
} // Fecha void garagem

void SairGaragem()
{
 digitalWrite(LedStatusAndar1, LOW);
 digitalWrite(LedStatusAndar2, LOW);
 digitalWrite(LedStatusAndar3, LOW);
 //Serial.println("Sair Garagem");

// Verifico se esta no lugar e se esta recolido a corda
if (fc_lugar != 0 && fc_parede ==0 && ((   valor_garagem-precisao_pulso) && ( Valor <= valor_garagem+precisao_pulso) ))
{
  while ( fc_lugar != 0 )
  {
   fc_parede = digitalRead(valor_fc_parede);
   fc_lugar = digitalRead(valor_fc_lugar);
    
   digitalWrite(motor_posicao, HIGH); // Liga Motor
   digitalWrite(sentido_motor_posicao,LOW); // Desliga para retirar o guincho, sentido inverso do de guardar
   //Serial.println("ddd");
  }
  if ( fc_lugar == 0 )
  {
   if (digitalRead(motor_posicao) == 1)// Somente para não ficar entrando toda hora aqui e apenas uma unica vez
   { 
    //Serial.println("eee");
     StatusPosicao = "NaPosicao"; 
     EEPROM.write(2,4); // Salva na memoria 2 o valor 4 que é na posicao de operar ou de ir para a garagem novamente
     digitalWrite(motor_posicao, LOW); // Desliga Motor
     digitalWrite(sentido_motor_posicao, LOW); // Desliga Motor
     GirarDescer();
   }
  }
}




 
}


void Parar()
{
 digitalWrite(motor_giro, LOW); //Desliga alimentação do motor
 digitalWrite(sentido_motor_giro, LOW); //Habilita a posicao para descida
 //Serial.println("Parar");
}



void Zerar()
{

int Valor = 100;

byte hiByte = highByte(Valor);
byte loByte = lowByte(Valor);
EEPROM.write(0,hiByte);
EEPROM.write(1,loByte);
}




void Salva()
{

// Armazena na serial
byte hiByte = highByte(Valor);
byte loByte = lowByte(Valor);
EEPROM.write(0,hiByte);
EEPROM.write(1,loByte);
Serial.println(Valor);
digitalWrite(LedStatus,!digitalRead(LedStatus)); // Pulsa LedStatus a cada pulso
if ((Valor >= (valor_primeiro_andar-precisao_pulso)) && (Valor <= (valor_primeiro_andar+precisao_pulso)))
{
  Andar1(); 
}
if ((Valor >= (valor_segundo_andar-precisao_pulso)) && (Valor <= (valor_segundo_andar+precisao_pulso)))
{
  Andar2(); 
}
if ((Valor >= (valor_terceiro_andar-precisao_pulso)) && (Valor <= (valor_terceiro_andar+precisao_pulso)))
{
  Andar3(); 
}

if ( Valor >= (valor_primeiro_andar+precisao_pulso)) // Se descer mais que deve manda parar
 {
  ////Serial.println("Emergencia");
  Parar();
 }




if (UltimaMensagemRecebida == "ir_garagem")
{
 if (  StatusPosicao != "NaGaragem" &&      (Valor >= (valor_garagem-precisao_pulso)) && (Valor <= (valor_garagem+precisao_pulso)))
 {
  StatusPosicao = "NaPosicao";
  Parar();
  //Serial.println("Indo para Garagem");
  Garagem(); 
 }
}
else
{
 if (UltimaMensagemRecebida == "ir_1andar" ||  UltimaMensagemRecebida == "ir_2andar" ||UltimaMensagemRecebida == "ir_3andar")
 {
    if ((Valor >= (valor_garagem-precisao_pulso)) && (Valor <= (valor_garagem+precisao_pulso)) )
   {
    GirarDescer();
   }
 }
}



} //Fecha void salva

void loop()
{
 
 newPosition = myEnc.read();
 digitalWrite(LedStatus,LOW); // Apaga o LedStatus e para ele acender somente a cada pulso ou msg recebida
 
  
 fc_subida = digitalRead(valor_fc_subida);
 fc_parede = digitalRead(valor_fc_parede);
 fc_lugar = digitalRead(valor_fc_lugar);
 cmd_subir = digitalRead(valor_cmd_subir);
 cmd_descer = digitalRead(valor_cmd_descer);
 
if ( fc_subida == 0)
 {
  if (bloqueia_subida == 1) // em 1 esta bloqueado para subir
  {
   digitalWrite(sentido_motor_giro, LOW); //Habilita a posicao para descida somente
  }
  if (bloqueia_subida ==0) // Ainda não cortou para subir
  {
  bloqueia_subida = 1;
  // Parada de emergencia
  StatusPosicao = "NaPosicao"; 
  //Serial.println("Parada Emergencia");
  EEPROM.write(2,4); // Salva na memoria 2 o valor 4 que é na posicao de ir para a garagem
  Parar(); // Se atuar o fim de curso para o motor
  }
   
}
else
{
 bloqueia_subida = 0; // Se nao estiver atuado no bloqueia
}
 
 
 
 
 if ( modo == 1 ) // Se estiver em manual
 {
  if ( cmd_subir == 0  && fc_lugar  == 0) {  GirarSubir(); }
  if ( bloqueia_descida == 0 && cmd_descer == 0  && fc_lugar  == 0) {  GirarDescer(); }
  if ( cmd_subir != 0 && cmd_descer != 0 ){Parar();} // Se nenhum botao for atuado manda parar
 }
 
 if (newPosition != oldPosition) 
 {
  oldPosition = newPosition;
  
  if(ValorCorrente<ValorInicial)
  {
    newPosition = -1 ;oldPosition = 0;
  }
  Valor = (ValorCorrente+newPosition);
  if ( Valor < ValorInicial)
  {
   Valor = ValorInicial;
   oldPosition = 0;
   newPosition = 0;
  }
  Salva();
 } // Fecha se variou a posicao dos pulsos


  while (RS485.available())
  {
    delay(3);
    char c = RS485.read();
    readString += c;
  }
   while (Serial.available())
  {
    delay(3);
    char c = Serial.read();
    readString += c;
  }

 if (readString.length() > 0)
 {
 digitalWrite(LedStatus, HIGH); // Liga
 readString.trim(); // Não retirar esta parte, pois ela retira espaços providos a ruidos gerados
 UltimaMensagemRecebida = readString;

 if ( readString == "zerar")
 {
  Zerar();
 }
 if ( readString == "parar")
 {
  Parar();
 }
 if ( readString == "automatico")
 {
  modo = 0;
  //Serial.println("Em Modo Automatico");
 }
 if ( readString == "manual")
 {
  modo = 1;
  //Serial.println("Em Modo Manual");
 }
 
 if ( readString == "ir_1andar")
 {
  
  if( StatusPosicao == "No1Andar"  && fc_lugar  == 0) // Se ja estiver no primeiro andar para 
  {
   Parar();
  }
  if( StatusPosicao == "No2Andar"  && fc_lugar  == 0) // Se ja estiver no segundo andar desce
  {
   GirarDescer();
  }
  if( StatusPosicao == "No3Andar"  && fc_lugar  == 0) // Se ja estiver no terceiro andar desce
  {
   GirarDescer();
  }
  if( StatusPosicao == "NaPosicao"  && fc_lugar  == 0) // Se ja estiver na posicao libera descer
  {
   GirarDescer();
  }
  if( StatusPosicao == "NaGaragem" && fc_parede == 0 && fc_lugar  != 0) // Se ja estiver na garagem sai dela e depois vai para o andar desejado
  {
   SairGaragem();
   GirarDescer();
  }

  

  
 } // Fecha readString 1 Andar










 
 if ( readString == "ir_2andar")
 {

  if( StatusPosicao == "No1Andar"  && fc_lugar  == 0) // Se ja estiver no primeiro andar sobe para o 2 
  {
   GirarSubir();
  }
  if( StatusPosicao == "No2Andar"  && fc_lugar  == 0) // Se ja estiver no segundo andar para
  {
   Parar();
  }
  if( StatusPosicao == "No3Andar"  && fc_lugar  == 0) // Se ja estiver no terceiro manda descer
  {
  GirarDescer();
  }
  if( StatusPosicao == "NaPosicao"  && fc_lugar  == 0) // Se ja estiver na posicao libera descer
  {
   GirarDescer();
  }
  if( StatusPosicao == "NaGaragem"  && fc_parede == 0 && fc_lugar  != 0) // Se ja estiver na garagem sai dela e depois vai para o andar desejado
  {
   SairGaragem();
   GirarDescer();
  }

  
 } // Fecha 2 Andar


 
 if ( readString == "ir_3andar")
 {
  
  if( StatusPosicao == "No1Andar"  && fc_lugar  == 0) // Se ja estiver no primeiro andar sobe para o 3 
  {
   GirarSubir();
  }
  if( StatusPosicao == "No2Andar"  && fc_lugar  == 0) // Se ja estiver no segundo andar sobe
  {
    GirarSubir();
  }
  if( StatusPosicao == "No3Andar"  && fc_lugar  == 0) // Se ja estiver no terceiro andar para
  {
  Parar();
  }
  if( StatusPosicao == "NaPosicao"  && fc_lugar  == 0) // Se ja estiver na posicao libera descer
  {
   GirarDescer();
  }
  if( StatusPosicao == "NaGaragem"  && fc_parede == 0 && fc_lugar  != 0) // Se ja estiver na garagem sai dela e depois vai para o andar desejado
  {
   SairGaragem();
   GirarDescer();
  }
 }






 
 if ( readString == "ir_garagem")
 {
  if( StatusPosicao == "No1Andar" && fc_lugar  == 0) // Se ja estiver no primeiro andar sobe para a posicao
  {
   GirarSubir();
  }
  if( StatusPosicao == "No2Andar"  && fc_lugar  == 0) // Se ja estiver no segundo andar sobe para a posicao
  {
    GirarSubir();
  }
  if( StatusPosicao == "No3Andar" && fc_lugar  == 0) // Se ja estiver no terceiro andar sobe para a posicao
  {
  GirarSubir();
  }
  if( StatusPosicao == "NaPosicao") // Se ja estiver na posicao libera descer
  {
   //GirarDescer();
  }
  if( StatusPosicao == "NaGaragem"  && fc_parede == 0 && fc_lugar  == 1) // Se ja estiver na garagem sai dela e depois vai para o andar desejado
  {
   SairGaragem();
   GirarDescer();
  }
 }
 
 
 if(fc_parede !=0 &&  ( UltimaMensagemRecebida == "ir_1andar" || UltimaMensagemRecebida == "ir_2andar" ||UltimaMensagemRecebida == "ir_3andar" ) && fc_lugar !=0) // Nao pode operar pois esta fora do lugar
 {
  digitalWrite(LedStatusAndar1, LOW);
  digitalWrite(LedStatusAndar2, LOW);
  digitalWrite(LedStatusAndar3, LOW);

  for ( int x = 0; x<20;x++)
  {
   digitalWrite(LedStatusAndar1,!digitalRead(LedStatusAndar1));
   digitalWrite(LedStatusAndar2,!digitalRead(LedStatusAndar2));
   digitalWrite(LedStatusAndar3,!digitalRead(LedStatusAndar3));
   delay(200);
  }

  
 }
 
 
 
 readString = "";
 digitalWrite(LedStatus, LOW); // Apaga
 
 }// Fecha se existe dados na serial






 
} //Fecha Loop
