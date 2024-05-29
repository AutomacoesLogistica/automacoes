/*
 * 
   Conexão do modulo RS485
   RO = Pino 10
   DI = Pino 11
   DE = Pino 12
   RE = Pino 12
 * 
 * 
 * 
 */

#include<SoftwareSerial.h>
#define transmitir 12 // Pino DE e RE - Transmissao
#define pinRX 10 // Pino RO
#define pinTX 11 // Pino DI
SoftwareSerial RS485(pinRX, pinTX);


boolean manual = false;

long UltimoMillis = 0;        // Variável de controle do tempo
long intervalo_subir = 26000;     // Tempo em ms do intervalo a ser executado
long intervalo_descer = 30000;     // Tempo em ms do intervalo a ser executado
unsigned long AtualMillis;
String ultima_mensagem = ""; // Por segurança nao subir no primeiro comando;

#define SaidaRele_Geral 7 // Rele de alimentação do sistema 

String readString;

boolean descendo = false;
boolean subindo = false;

int valor_subir = 0;
int valor_descer = 0;

// DADOS REFERENTE AO MONSTER MOTOR SHILED - TRANSLAÇÃO DA PONTE E DO CARRO *********************************************************
#define BRAKEVCC 0
#define CW 1 // 1 sentido horario
#define CCW 2 // 2 sentido anti-horario
#define BRAKEGND 3
#define CS_THRESHOLD 5   // Definição da corrente de segurança
int inApin = 4; // pino 4 para motor A2
int inBpin = 9; // pino 9 para motor B2
int pwmpin = 6; //Saida PWM 6 Velocidade motor A2/B2  
int cspin =  A3; // Entrada do Sensor de Corrente pino A3 ( Motor A2/B2 )
int statpin = 13;
int i=0;
boolean fc_Subida = false;
boolean fc_Descida = false;
int esticando = 0;
unsigned int pulso = 0;

// VARIAVEIS PARA MANTER A VELOCIDADE MAXIMA
int aa = 0; //referente ao motor 0 para subir
int bb = 0; //referente ao motor 0 para descer

boolean em_rampa_subindo = false;
boolean em_rampa_descendo = false;

// ********************************************************************************************************************


// VARIAVEIS  PARA CRIACAO DE PINOS INTERNOS ATRAVEZ DA LEITURA DAS ANALOGICAS
int Tela_F_Subir; // leitura da analogica A0 maior que 1000
int Tela_F_Descer; // leitura da analogica A0 menor que 300
boolean v_subir = false;
boolean v_descer = false;


// DEFINIÇÃO DOS TEMPOS DE RAMPA ( tempo definido em milisegundos )
#define tRampa_TelaFrete 30 // Define o tempo de rampa de translação da ponte tanto para frente quanto para traz

// Pinos Interrupçao


void parar_subida()
{
 if ( ((Tela_F_Subir == 1 && Tela_F_Descer == 0) || (v_subir == true && v_descer == false)) && subindo == true )
 { 
  Serial.println(valor_subir);
  v_subir = false;
  v_descer = false;
  digitalWrite(inApin, LOW);
  digitalWrite(inBpin, LOW);
  analogWrite(6, 0);
  aa = 0;
  subindo = false;
  AtualMillis = millis();
  UltimoMillis = AtualMillis;
  Serial.println("Parou EMERGENCIA SUBIR");//
  fc_Subida = true;
  ultima_mensagem = "subir";
  //Parar_Subir();
  //Esta aberto!
  // Envia a mensagem > tela_aberta <  no RS485
  digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
  RS485.print("tela_aberta");
  digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
  Parar_Subir();
 }
if((em_rampa_subindo == false && fc_Subida == false) && subindo == true)
{
  Serial.println(valor_subir);
  v_subir = false;
  v_descer = false;
  digitalWrite(inApin, LOW);
  digitalWrite(inBpin, LOW);
  analogWrite(6, 0);
  aa = 0;
  subindo = false;
  AtualMillis = millis();
  UltimoMillis = AtualMillis;
  Serial.println("Parou EMERGENCIA SUBIR");//
  fc_Subida = true;
  ultima_mensagem = "subir";
  //Parar_Subir(); 
  //Esta aberta!
  // Envia a mensagem > tela_aberta <  no RS485
  digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
  RS485.print("tela_aberta");
  digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
  Parar_Subir();
 }
 
}


void parar_descida()
{
 if ( ((Tela_F_Subir == 0 && Tela_F_Descer == 1) || (v_subir == false && v_descer == true)) && descendo == true )
 { 
  v_subir = false;
  v_descer = false;
  digitalWrite(inApin, LOW);
  digitalWrite(inBpin, LOW);
  analogWrite(6, 0);
  bb = 0;
  descendo = false;
  AtualMillis = millis();
  UltimoMillis = AtualMillis;
  Serial.println("Parou EMERGENCIA DESCER");//
  fc_Descida = true;
  ultima_mensagem = "descer";
  // Envia a mensagem > tela_fechada <  no RS485
  digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
  RS485.print("tela_fechada");
  digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
  Parar_Descer();
 }
 if((em_rampa_descendo == false && fc_Descida == false)  && descendo == true  )
{
   v_subir = false;
  v_descer = false;
  digitalWrite(inApin, LOW);
  digitalWrite(inBpin, LOW);
  analogWrite(6, 0);
  bb = 0;
  descendo = false;
  AtualMillis = millis();
  UltimoMillis = AtualMillis;
  Serial.println("Parou EMERGENCIA DESCER");//
  fc_Descida = true;
  ultima_mensagem = "descer";
  // Envia a mensagem > tela_fechada <  no RS485
  digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
  RS485.print("tela_fechada");
  digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
  Parar_Descer();
}
}


void setup()
{
 Serial.begin(9600);
 RS485.begin(9600);
 pinMode(transmitir, OUTPUT);
 digitalWrite(transmitir, LOW); // Fica recebendo mensagem!
 
 attachInterrupt(digitalPinToInterrupt(2), parar_subida, CHANGE);
 attachInterrupt(digitalPinToInterrupt(3), parar_descida, CHANGE);
 // REFETENTE AO MONSTER MOTOR SHILED *******************************************************************************************************************
 pinMode(inApin, OUTPUT);
 pinMode(inBpin, OUTPUT);
 pinMode(pwmpin, OUTPUT);  
 digitalWrite(inApin, LOW);
 digitalWrite(inBpin, LOW);


 
// ******************************************************************************************************************************************************



Tela_F_Subir = 0;
Tela_F_Descer = 0;


if(digitalRead(2)==HIGH && digitalRead(3)==LOW) // Ja esta fechado!
{
  ultima_mensagem = "subir";
}
if(digitalRead(3)==HIGH && digitalRead(2)==LOW)// Ja esta aberto!
{
  ultima_mensagem = "descer";
}
} // FECHA O SETUP



void Desarmou()
{
 v_subir = false;
 v_descer = false;
 descendo = false;
 subindo = false;
 digitalWrite(inApin, LOW);
 digitalWrite(inBpin, LOW);
 analogWrite(6, 0);
 aa = 0;
 bb = 0;
 subindo = false;
 AtualMillis = millis();
 UltimoMillis = AtualMillis;
 parar_subida();
}





void Parar_Subir()
{
 v_subir = false;
 v_descer = false;
 digitalWrite(inApin, LOW);
 digitalWrite(inBpin, LOW);
 analogWrite(6, 0);
 aa = 0;
 subindo = false;
 AtualMillis = millis();
 UltimoMillis = AtualMillis;
 Serial.println("Parar_Subir");
 delay(5000);
}


void Parar_Descer()
{
 v_subir = false;
 v_descer = false;
 digitalWrite(inApin, LOW);
 digitalWrite(inBpin, LOW);
 analogWrite(6, 0);
 bb = 0;
 descendo = false;
 AtualMillis = millis();
 UltimoMillis = AtualMillis; 
 Serial.println("Parar_Descer");
 delay(5000);
}

void loop() 
{
  
  if(v_descer == false && v_subir == false)
  {
     AtualMillis = millis();
     UltimoMillis = AtualMillis;
     descendo = false;
     subindo = false;
  }
  
  if((v_descer == true && fc_Descida == false) || (Tela_F_Subir == 0 && Tela_F_Descer == 1))
  {
   AtualMillis = millis();    //Tempo atual em ms
   if (AtualMillis - UltimoMillis > intervalo_descer) 
   { 
    UltimoMillis = AtualMillis;    // Salva o tempo atual
    valor_descer = 120; // Reduz a velocidade da descida para chegar e atuar devagar o fim de curso
    motorGo(1, CCW, valor_descer);
    Serial.println("Reduziu descer");
   }
  }


  if((v_subir == true && fc_Subida == false)||(Tela_F_Subir == 1 && Tela_F_Descer == 0))
  {
   AtualMillis = millis();    //Tempo atual em ms
   if (AtualMillis - UltimoMillis > intervalo_subir) 
   { 
    UltimoMillis = AtualMillis;    // Salva o tempo atual
    valor_subir = 190; // Reduz a velocidade da subida e atuar devagar o fim de curso
    motorGo(1, CW, valor_subir);
    Serial.println("Reduziu subir");
   }
  }
  
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
  readString.trim();
  if (readString.length() >0 && (readString.indexOf("subir") >=0 || readString.indexOf("parar") >=0 || readString.indexOf("descer") >=0))
  {
   Serial.print("Chegou : ");Serial.print(readString);Serial.print("  -  Ultima mensagem :  ");Serial.println(ultima_mensagem);
   Serial.print("FC Subida = ");Serial.print(fc_Subida);Serial.print("   -  FC Descida : ");Serial.println(fc_Descida);
   
   if (readString.indexOf("subir") >=0 && ultima_mensagem == "descer" && fc_Subida == false && subindo == false)     
   {
    Serial.println("Comando subir serial!");
    manual = false;
    v_subir = true;
    v_descer = false;
    fc_Descida = false;
    AtualMillis = millis();
    UltimoMillis = AtualMillis;
    ultima_mensagem = "subir";
    aa = 0;
    bb = 0;
    subindo = true;
    descendo = false;
    valor_descer = 0;
    valor_subir = 0;
    esticando = 0;
   }
   if (readString.indexOf("descer") >=0 && ultima_mensagem == "subir" && fc_Descida == false && descendo == false)
   {
    Serial.println("Comando descer serial!");
    manual = false;
    v_subir = false;
    v_descer = true;
    fc_Subida = false;
    AtualMillis = millis();
    UltimoMillis = AtualMillis;
    ultima_mensagem = "descer";
    aa = 0;
    bb = 0;
    descendo = true;
    subindo = false;
    valor_descer = 0;
    valor_subir = 0;
    esticando = 0;
   }
   if (readString.indexOf("parar") >=0)
   {
    manual = false;
    v_subir = false;
    v_descer = false;
    Serial.println("Desarmou");
    digitalWrite(inApin, LOW);
    digitalWrite(inBpin, LOW);
    analogWrite(6, 0);
    aa = 0;
    bb = 0;
    subindo = false;
    descendo = false;
    valor_descer = 0;
    valor_subir = 0;
    esticando = 0;
   }
  readString="";
 } // Fecha readstring > 0 




  
 //Serial.println(analogRead(A0));
// MAPEANDO AS ANALÓGICAS ****************************************************************************************************************************************************
// ENTRADA A0 - COMANDO TRANSLAÇÃO DA PONTE
if(analogRead(A0)>=300 && analogRead(A0)<=1000) // Limpa comandos
{
 Tela_F_Subir = 0;
 Tela_F_Descer = 0;
 //Serial.println("Parado");
 em_rampa_subindo == true;
 em_rampa_descendo == true;
 subindo = false;
 descendo = false;
 valor_descer = 0;
 valor_subir = 0;
 esticando = 0;
 if(manual==true)
 {
  analogWrite(6, 0);
  aa = 0;
  bb = 0;
 }
}

if(analogRead(A0)>1000 && Tela_F_Subir == 0 && fc_Descida == false) // descer a tela manualmente
{
 manual = true;
 if (digitalRead(3)==LOW) // Nao esta atuado o fim de curso de descida 
 {
  Tela_F_Subir = 0;
  Tela_F_Descer = 1;
  subindo = false;
  descendo = true;
  //Serial.println("Descer");
  fc_Subida = false;
  ultima_mensagem = "descer";
  valor_descer = 0;
  valor_subir = 0;
  esticando = 0; 
 }
 else
 {
  Parar_Descer();
 }
  
}
if(analogRead(A0)<300 && Tela_F_Descer == 0 && fc_Subida == false) // subindo a tela manualmente
{
 manual = true; 
 if(digitalRead(2)==LOW) // Nao esta atuado o fim de curso subida 
 {
  //Serial.println("Subir"); 
  Tela_F_Subir = 1;
  Tela_F_Descer = 0;
  subindo = true;
  descendo = false;
  fc_Descida = false;
  ultima_mensagem = "subir";
  valor_descer = 0;
  valor_subir = 0;
  esticando = 0;
 }
 else
 {
  Parar_Subir();
 }
 
}
// **************************************************************************************************************************************************************************************


// ATUA OS COMANDOS RESPECTIVOS    ATUA OS COMANDOS RESPECTIVOS   ATUA OS COMANDOS RESPECTIVOS   ATUA OS COMANDOS RESPECTIVOS
// ATUA OS COMANDOS RESPECTIVOS    ATUA OS COMANDOS RESPECTIVOS   ATUA OS COMANDOS RESPECTIVOS   ATUA OS COMANDOS RESPECTIVOS
// ATUA OS COMANDOS RESPECTIVOS    ATUA OS COMANDOS RESPECTIVOS   ATUA OS COMANDOS RESPECTIVOS   ATUA OS COMANDOS RESPECTIVOS
// ATUA OS COMANDOS RESPECTIVOS    ATUA OS COMANDOS RESPECTIVOS   ATUA OS COMANDOS RESPECTIVOS   ATUA OS COMANDOS RESPECTIVOS

 if ((Tela_F_Subir == 1 || v_subir==true && fc_Subida == false)&& digitalRead(2)==LOW)
 {
  Serial.println("Subindo");
  subindo = true;
  descendo = false;
  //Serial.println(analogRead(cspin));
  if(analogRead(cspin)>158)// Protecao para se agarrar parar
  {
   Serial.println("Desarmou");
   digitalWrite(inApin, LOW);
   digitalWrite(inBpin, LOW);
   analogWrite(6, 0);
   aa = 0;
   Desarmou();
  }
  // MOTOR 0 E EM CW 
  for(int e = 30;e<255;e++)
  {
   if (analogRead(A0)<300 || v_subir==true && fc_Subida == false)
   {
    if ( aa == 0 )
    {
     motorGo(1, CW, e);// Aumento do o PWM do motor até 255
     em_rampa_subindo = true; 
     delay(tRampa_TelaFrete);//Tempo de Rampa
     if ( e == 254){aa = 1; em_rampa_subindo = false;}
     e++;
     valor_subir = e; 
    }
   }
   else
   {
    //Serial.println("Parando");
    // Desliga o motor
    digitalWrite(inApin, LOW);
    digitalWrite(inBpin, LOW);
    analogWrite(6, 0);
    aa = 0;
    break;
   } // fecha else
  } // fecha for
   
  if(em_rampa_subindo == false && fc_Subida == false)
  {
   //Serial.println("Saiu da rampa subida!");
   //motorGo(1, CW, 80); // Para subir devagar    
  }
 } // fecha COMANDO
 else if ( fc_Subida == true && (Tela_F_Subir == 1 && Tela_F_Descer == 0)||(v_subir == true && v_descer == false))
 {
  Parar_Subir();  
 }

 // *************************************************************** 
  
 if (( Tela_F_Descer == 1 || v_descer == true && fc_Descida == false)&& digitalRead(3)==LOW)
 {
  descendo = true;
  subindo = false;
  //Serial.println(analogRead(cspin));
  //Serial.println("Descendo");
  // MOTOR 0 E EM CCW 
  for(int f = 0;f<255;f++)
  {     
   if (analogRead(A0)>1000 || v_descer == true)
   {
    if ( bb == 0 )
    {
     motorGo(1, CCW, f);// Aumento do o PWM do motor até 255 
     em_rampa_descendo = true;
     delay(tRampa_TelaFrete);//Tempo de Rampa
     if ( f == 254){bb = 1;em_rampa_descendo = false;}
     f++;
     valor_subir = f; 
    }
   }
   else
   {
    //Serial.println("Parando");
    // Desliga o motor
    digitalWrite(inApin, LOW);
    digitalWrite(inBpin, LOW);
    analogWrite(6, 0);
    bb = 0;
    break;
   } // fecha else
  } // fecha for

 if(em_rampa_descendo == false && fc_Descida == false)
  {
   //Serial.println("Saiu da rampa subida!");
   //motorGo(1, CCW, 80); // Para subir devagar    
  }

  
 } // fecha COMANDO



}//Fecha Loop
// ***************************************************************  


// Controle do motor  Controle do motor  Controle do motor  Controle do motor  Controle do motor  Controle do motor  Controle do motor  Controle do motor  Controle do motor 
// Controle do motor  Controle do motor  Controle do motor  Controle do motor  Controle do motor  Controle do motor  Controle do motor  Controle do motor  Controle do motor 
// Controle do motor  Controle do motor  Controle do motor  Controle do motor  Controle do motor  Controle do motor  Controle do motor  Controle do motor  Controle do motor 
// Controle do motor  Controle do motor  Controle do motor  Controle do motor  Controle do motor  Controle do motor  Controle do motor  Controle do motor  Controle do motor 
// Controle do motor  Controle do motor  Controle do motor  Controle do motor  Controle do motor  Controle do motor  Controle do motor  Controle do motor  Controle do motor 

void motorGo(uint8_t motor, uint8_t direct, uint8_t pwm)         //Função que controla as variáveis: motor(0 ou 1), sentido (cw ou ccw) e pwm (entra 0 e 255);
{
 /* 
 Serial.print(motor);
 Serial.print(",");
 Serial.print(direct);
 Serial.print(",");
 Serial.println(pwm);
   */
 if (motor <= 1)
 {
  if (direct <=4)
  {
   if (direct <=1 && fc_Subida == false && digitalRead(2)==LOW)
   {
    digitalWrite(inApin, HIGH);
   // Serial.println("A");
   }
   else
   {  
    digitalWrite(inApin, LOW);
    //Serial.println("B");
   }
       
   if ((direct==0)||(direct==2))
   {
    digitalWrite(inBpin, HIGH && fc_Descida == false && digitalRead(3)==LOW);
    //Serial.println("C");
   }
   else
   {
    digitalWrite(inBpin, LOW);
    //Serial.println("D");
   }
   
   analogWrite(pwmpin, pwm);
   
  } //Fecha direct <=4
 } // Fecha motor<=1

} // Fecha motorGo
