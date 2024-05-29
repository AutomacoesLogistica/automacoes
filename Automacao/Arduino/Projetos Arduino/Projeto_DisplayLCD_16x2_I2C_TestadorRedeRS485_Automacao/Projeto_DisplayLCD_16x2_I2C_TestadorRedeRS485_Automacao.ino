/*
 * 
 * 
 * PROJETO TESTADOR DE REDE RS485 
 * 
 * UTILIZADO PARA ENVIAR E RECEBER MENSAGENS NA REDE DE AUTOMACAO
 *  Conexão do modulo RS485
 *  RO = Pino 3
 *  DI = Pino 4
 *  DE = Pino 2 Usado para transmitir
 *  RE = Pino 2 Usado para transmitir
 *  
 *  buzzer = Pino 5
 *  Seleciona2 = Pino 6
 *   
 *  Analogica esquerda cima
 *  cima      A0 = 0
 *  baixo     A0 = 460 *possivel defeito
 *  esquerda  A1 = 1023
 *  direita   A1 = 0
 *    
 *  Analogica esqueda baixo
 *  cima      A2 = 0
 *  baixo     A2 = 1023
 *  esquerda  A3 = 1023
 *  direita   A3 = 0
 *  
 *  LedStatus = Pino 13
 * 
 */

#include <Wire.h>
#include <LiquidCrystal_I2C.h>

// Inicializa o display no endereco 0x3F
LiquidCrystal_I2C lcd(0x27,2,1,0,4,5,6,7,3, POSITIVE);
String readString;
char* Memoria[] = {"teto_sala","lustre_sala","amb_sala","varan_sala","projetor_a","projetor_f","cort_sala_a","cort_sala_f","lam_cor_sala","escada_lage","escada_rua","port_acesso","lamp_quarto1","amb_quarto1","cort_quar1_a","cort_quar1_f","lam_cor_q1","lamp_quarto2","amb_quarto2","cort_quar2_a","cort_quar2_f","lam_cor_q2","teto_corredo","teto_cozinha","amb_cozinha","pend_cozinha","per_cozinh_a","per_cozinh_f","lam_ban_soci","amb_ban_soci","esp_ban_soci","teto_gourmet","pend_gourmet","chur_gourmet","lava_gourmet","per1_gourm_a","per1_gourm_f","per2_gourm_a","per2_gourm_f","lamp_quartoc","amb_quartoc","cort_quarc_a","cort_quarc_f","lam_cor_qc","lamp_closet","espe_closet","amb_closet","lam_banh_c","amb_ban_c","esp_ban_c","teto_labora","pers_labo_a","pers_labo_f","vent_labora","teto_churra","pen_churra","amb_churra","muro_churra","lamp_gara_1","lamp_gara_2","lamp_gara_3","muro_carr","jardim_verti","jardim_hori","lamp_oficina","frente_casa","carros","all_0","all_1","geral_on","geral_off"};
int MAXnumero_da_memoria = 71; // Numero de palavras na memoria disponivel
int numero_da_memoria = -1; // Sempre iniciar em -1
char palavra[12]; 
char letras[] = {'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','X','Y','Z','0','1','2','3','4','5','6','7','8','9','-','_','*',' '};
int numero_da_letra = -1; // Sempre iniciar em -1
int posicao_da_letra = 4; // Sempre iniciar em 4
int MAXnumero_da_letra = 64; // Numero de letras disponiveis

char Mensagem_a_enviar[12]; // Usado para criar a string de envio
String Mensagem_atual;

//Criando a Serial
#include<SoftwareSerial.h>
#define transmitir 2 // Pino DE e RE - Transmissao
#define pinRX 3 // Pino RO
#define pinTX 4 // Pino DI
SoftwareSerial RS485(pinRX, pinTX);

//Botao de envio
#define buzzer 5 // Usado para tom
#define Seleciona2 6 // Usado para enviar a mensagem
#define LedStatus 13

void setup() 
{
 Serial.begin(9600);
 RS485.begin(9600);
 numero_da_memoria = -1; // Sempre iniciar em -1
 numero_da_letra = -1; // Sempre iniciar em -1
 posicao_da_letra = 4; // Sempre iniciar em 4


 
 pinMode(transmitir, OUTPUT);
 pinMode(LedStatus, OUTPUT);
 digitalWrite(LedStatus,HIGH);
 pinMode(Seleciona2, INPUT);  
 lcd.begin(16,2);
 lcd.clear();
 lcd.setCursor(0,0);
 lcd.print ("Testador de Rede");
 lcd.setCursor(0,1);
 lcd.print ("Automacao RS485 ");
 delay(2000);
 lcd.clear();
 lcd.setCursor(0,0);
 lcd.print ("Autor:          ");
 lcd.setCursor(0,1);
 lcd.print ("Bruno Goncalves ");
 delay(1500);
 lcd.clear();
 lcd.setCursor(0,0);
 lcd.print ("Versao :   1.0.0");
 lcd.setCursor(0,1);
 lcd.print ("                ");
 delay(1500);
 
 lcd.clear();
 lcd.setCursor(0,0);
 lcd.print ("Aguarde          ");
 lcd.setCursor(0,1);
 for (int a=0;a<16;a++)
 {
  digitalWrite(LedStatus,LOW);
  delay(100);
  lcd.setCursor(a,1);
  lcd.print (".");
  digitalWrite(LedStatus,HIGH);
  delay(100);
 }
 
 tone(buzzer,1000,200); 
 lcd.clear();
 lcd.setCursor(0,0);
 lcd.print ("Rx:             ");
 lcd.setCursor(0,1);
 lcd.print ("Tx:             ");
 

} 

void loop()
{

// VERIFICAND SE CHEGOU ALGUMA MENSAGEM E ATUALIZANDO NA TELA
 while (RS485.available())
 {
  delay(1);
  char c = RS485.read();
  readString += c;
 }
 //readString.trim(); // Retira todos espaços vazios
 
 if (readString.length() > 0 && readString.length() <12)
 {
  digitalWrite(LedStatus,LOW);
  lcd.setCursor(0,0);
  lcd.print ("Rx:             "); // Limpa a mensagem antiga
  lcd.setCursor(4,0);
  lcd.print (readString); // Escreve a nova mensagem
  tone(buzzer,1000,1500);
  digitalWrite(LedStatus,HIGH);
  readString = "";
 }
 if(readString.length()>=12) // Falha na recepção ou valor maior que o definido dentro da rede que sao de 12 caracteres maximo
 {
  readString = "";
  tone(buzzer,500,2000);
 }
 

// ENVIO DA MENSAGEM
if(digitalRead(Seleciona2) == HIGH)
{
 digitalWrite(LedStatus,LOW);
 delay(500);
 while(digitalRead(Seleciona2) == HIGH)
 {
 delay(500);
 }

 Mensagem_atual = ""; // Limpa a mensagem

  if ( numero_da_letra != -1 ) // Se veio digitada manualmente
  {
    for (int a=0;a<=(posicao_da_letra-1);a++)
    {
      Mensagem_atual += palavra[a];
      
    }
  }
  else // Se veio da memoria
  {
  Mensagem_atual = Memoria[numero_da_memoria];
  }
 
 digitalWrite(transmitir, HIGH);    //Habilita o envio
 RS485.print(Mensagem_atual);
 digitalWrite(transmitir,LOW);      //Desabilita o envio
 tone(buzzer,1300,200); 
 digitalWrite(LedStatus,HIGH);
}


// NAVEGANDO NOS MENUS

// Limpando tela
if(analogRead(A0) <5)
{
 numero_da_letra = -1;
 posicao_da_letra = 4;
 for (int a=1;a<13;a++)
{
 palavra[a] = ' '; 
}
 Mensagem_atual = ""; 
 lcd.clear();
 lcd.setCursor(0,0);
 lcd.print ("Rx:             ");
 lcd.setCursor(0,1);
 lcd.print ("Tx:             ");
 delay(1000);
}




// Reinicar o sistema
if(analogRead(A0) >1000) 
{
 lcd.clear();
 lcd.setCursor(0,0);
 lcd.print ("Reiniciando em  ");
 for (int a = 0;a<3;a++)
 {
  delay(1000);
  lcd.setCursor(0,1);
  lcd.print(3-a);
 }
 delay(1000);
 setup();
}





// Buscando mensagens da memoria
if(analogRead(A1) <100) // Movendo para direita é a proxima
{
 numero_da_letra = -1; // Limpa a memoria das letras para saber que nao esta digitando manual
 numero_da_memoria++; 
 if ( numero_da_memoria >=MAXnumero_da_memoria )
 {
  numero_da_memoria = 0;
 }
 lcd.setCursor(0,1);
 lcd.print ("Tx:             ");
 lcd.setCursor(4,1);
 lcd.print (Memoria[numero_da_memoria]);
 tone(buzzer,1300,200);
 delay(200);
}

if(analogRead(A1) >1000) // Movendo para esquerda é a anterior
{
 numero_da_letra = -1; // Limpa a memoria das letras para saber que nao esta digitando manual
 numero_da_memoria--; 
 if ( numero_da_memoria <0 )
 {
  numero_da_memoria = MAXnumero_da_memoria-1;
 }
 lcd.setCursor(0,1);
 lcd.print ("Tx:             ");
 lcd.setCursor(4,1);
 lcd.print (Memoria[numero_da_memoria]);
 tone(buzzer,1300,200);
 delay(200);
}


// Mudando letras para baixo
if(analogRead(A2) <100)
{
  numero_da_letra++;
  if (numero_da_letra >= MAXnumero_da_letra)
  {
    numero_da_letra = 0;
  }
 delay(200);
 palavra[posicao_da_letra-3] = letras[numero_da_letra];
 lcd.setCursor(posicao_da_letra,1);
 lcd.print (letras[numero_da_letra]);
 
}

// Mudando letras para cima
if(analogRead(A2) > 1000)
{
  numero_da_letra--;
  if (numero_da_letra < 0)
  {
    numero_da_letra = MAXnumero_da_letra;
  }
 delay(200);
 palavra[posicao_da_letra-3] = letras[numero_da_letra];
 lcd.setCursor(posicao_da_letra,1);
 lcd.print (letras[numero_da_letra]);
 
}




// Mudando posicao letras para direita
if(analogRead(A3) <100)
{
  posicao_da_letra++;
  if (posicao_da_letra >= 15)
  {
    posicao_da_letra = 15;
  }
 lcd.setCursor(posicao_da_letra,1);
 lcd.print (letras[numero_da_letra]); 
 tone(buzzer,1300,200); 
 delay(400);
 
 
}

// Mudando posicao letras para esquerda
if(analogRead(A3) > 1000)
{
  posicao_da_letra--;
  if (posicao_da_letra < 4)
  {
    posicao_da_letra = 4;
  }
 lcd.setCursor(posicao_da_letra,1);
 lcd.print (letras[numero_da_letra]);
 tone(buzzer,1300,200);
 delay(400);
 
 
 
}








}// Fecha o loop
