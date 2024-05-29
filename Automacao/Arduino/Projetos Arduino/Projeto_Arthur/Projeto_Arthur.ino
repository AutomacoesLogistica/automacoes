#include <Wire.h>
#include <EEPROM.h>
#include <LiquidCrystal_I2C.h>
#include <Ultrasonic.h>
#define TRIGGER_PIN  4
#define ECHO_PIN     5
Ultrasonic ultrasonic(TRIGGER_PIN, ECHO_PIN);

// Valores para media movel **************************************************************

#define N 100 // Numero de amostas
float media; // Recebe a media
float valores[N]; // Array para armazenar os valores lidos
double soma; // Variavel para somar os valores 

// ****************************************************************************************

float distMax = 42.77;
float nivel;
float h = 28.6; // em cm
float volume ;
float r = 11.5; // valor em cm

float distanciaCM = 0;
float UltimadistanciaCM = 0;
float distanciaTotal = 0;
int atualiza = 0;
long UltimoMillis = 0;        // Variável de controle do tempo
long intervalo = 1000;     // Tempo em ms do intervalo a ser executado
unsigned long AtualMillis;



int linha = 0; // variavel que se refere as linhas do excel
int LABEL = 1; 


byte desenho[8] = {
  B11111,
  B11111,
  B11111,
  B11111,
  B11111,
  B11111,
  B11111,
  B11111
};


 
// Inicializa o display no endereco 0x3F
LiquidCrystal_I2C lcd(0x27,2,1,0,4,5,6,7,3, POSITIVE);

void setup() 
{ 
 lcd.createChar(1,desenho);
 Serial.begin (9600);
 lcd.begin(20,4);
 nivel = 0;  
 delay(200);
 lcd.setCursor(0,0);
 lcd.print("0              100 %");
 lcd.setCursor(0,1);
 lcd.print("Nivel em %  :       ");
 lcd.setCursor(0,2);
 lcd.print("Nivel em CM :       ");
 lcd.setCursor(0,3);
 lcd.print("Nivel em L  :       ");
 Serial.println("CLEARDATA");            // Reset da comunicação serial
 Serial.println("LABEL,Hora,nivel,distanciaCM,litros");   // Nomeia as colunas

} 

void loop()
{


  long microsec = ultrasonic.timing(); //Lendo o sensor
  distanciaCM = ultrasonic.convert(microsec, Ultrasonic::CM); //Convertendo a distância em CM
  

  if (distanciaCM>distMax)
  {
   distanciaCM = distMax;
  }
  Serial.println(distanciaCM);
  distanciaCM = distMax - distanciaCM;
  
  // For para fazer o deslocamento das variaveis, atualizando-as ************************************************************************
  for(int i = N-1;i>0;i--)
  {
   valores[i] = valores[i-1];
  }
  
  valores[0] = distanciaCM; // Coloca o valor mais atual em valores[0]
  soma = 0.0;  // Limpa a variavel de soma

   // For para calcular a media atualizada *************************************************************************************************
  for (int i=0;i<N;i++)
  {
    soma = soma+valores[i];
  }

  // ***************************************************************************************************************************************
  
  media = soma/N;

  distanciaCM = media;  // atualiza distanciaCM com o valor ja estabilizado pela media movel
 //Serial.println(media);
 //Serial.println(distanciaCM);
  // Serial.println("");

 


// PLOTANDO A DISTANCIA EM CM *************************************************************************************************************************************************************
if (distanciaCM>h)
  {
   distanciaCM = h;
  }
if ( distanciaCM<10)
{
lcd.setCursor(17,2);
lcd.print("   ");
lcd.setCursor(14,2);
lcd.print(distanciaCM,1);
}

if ( distanciaCM>=10 && distanciaCM<99)
{
lcd.setCursor(18,2);
lcd.print("  ");
lcd.setCursor(14,2);
lcd.print(distanciaCM,1);
}

if (distanciaCM>=100)
{
 lcd.setCursor(19,2);
 lcd.print(" ");
 lcd.setCursor(14,2);
 lcd.print(distanciaCM,1);
}







// Controle barra **************************************************************************************************************************************************************
nivel = (distanciaCM*100)/h;
if ( nivel >100 )
{
nivel = 100;
}

if ( nivel <0 )
{
nivel = 0;
}

if (nivel>= 0 && nivel<10 )
{
 if (distanciaCM == 0 )
{
nivel = 0;
}

 lcd.setCursor(4,0);
 lcd.print("          "); 
 lcd.setCursor(3,0);
 lcd.write(1);
}


if (nivel>= 10 && nivel<20 )
{
 lcd.setCursor(5,0);
 lcd.print("         "); 
 lcd.setCursor(3,0);
 lcd.write(1);
 lcd.setCursor(4,0);
 lcd.write(1);
}

if (nivel>= 20 && nivel<30 )
{
 lcd.setCursor(6,0);
 lcd.print("        "); 
 lcd.setCursor(3,0);
 lcd.write(1);
 lcd.setCursor(4,0);
 lcd.write(1);
 lcd.setCursor(5,0);
 lcd.write(1);
}

if (nivel>= 30 && nivel<40 )
{
 lcd.setCursor(7,0);
 lcd.print("       "); 
 lcd.setCursor(3,0);
 lcd.write(1);
 lcd.setCursor(4,0);
 lcd.write(1);
 lcd.setCursor(5,0);
 lcd.write(1);
 lcd.setCursor(6,0);
 lcd.write(1);
}

if (nivel>= 40 && nivel<50 )
{
 lcd.setCursor(8,0);
 lcd.print("      "); 
 lcd.setCursor(3,0);
 lcd.write(1);
 lcd.setCursor(4,0);
 lcd.write(1);
 lcd.setCursor(5,0);
 lcd.write(1);
 lcd.setCursor(6,0);
 lcd.write(1);
 lcd.setCursor(7,0);
 lcd.write(1);
}

if (nivel>= 50 && nivel<60 )
{
 lcd.setCursor(9,0);
 lcd.print("     "); 
 lcd.setCursor(3,0);
 lcd.write(1);
 lcd.setCursor(4,0);
 lcd.write(1);
 lcd.setCursor(5,0);
 lcd.write(1);
 lcd.setCursor(6,0);
 lcd.write(1);
 lcd.setCursor(7,0);
 lcd.write(1);
 lcd.setCursor(8,0);
 lcd.write(1);
}

if (nivel>= 60 && nivel<70 )
{
 lcd.setCursor(10,0);
 lcd.print("    "); 
 lcd.setCursor(3,0);
 lcd.write(1);
 lcd.setCursor(4,0);
 lcd.write(1);
 lcd.setCursor(5,0);
 lcd.write(1);
 lcd.setCursor(6,0);
 lcd.write(1);
 lcd.setCursor(7,0);
 lcd.write(1);
 lcd.setCursor(8,0);
 lcd.write(1);
 lcd.setCursor(9,0);
 lcd.write(1);
}

if (nivel>= 70 && nivel<80 )
{
 lcd.setCursor(11,0);
 lcd.print("   "); 
 lcd.setCursor(3,0);
 lcd.write(1);
 lcd.setCursor(4,0);
 lcd.write(1);
 lcd.setCursor(5,0);
 lcd.write(1);
 lcd.setCursor(6,0);
 lcd.write(1);
 lcd.setCursor(7,0);
 lcd.write(1);
 lcd.setCursor(8,0);
 lcd.write(1);
 lcd.setCursor(9,0);
 lcd.write(1);
 lcd.setCursor(10,0);
 lcd.write(1);
}

if (nivel>= 80 && nivel<90 )
{
 lcd.setCursor(12,0);
 lcd.print("  "); 
 lcd.setCursor(3,0);
 lcd.write(1);
 lcd.setCursor(4,0);
 lcd.write(1);
 lcd.setCursor(5,0);
 lcd.write(1);
 lcd.setCursor(6,0);
 lcd.write(1);
 lcd.setCursor(7,0);
 lcd.write(1);
 lcd.setCursor(8,0);
 lcd.write(1);
 lcd.setCursor(9,0);
 lcd.write(1);
 lcd.setCursor(10,0);
 lcd.write(1);
 lcd.setCursor(11,0);
 lcd.write(1);
}

if (nivel>= 90 && nivel<100 )
{
 lcd.setCursor(13,0);
 lcd.print(" "); 
 lcd.setCursor(3,0);
 lcd.write(1);
 lcd.setCursor(4,0);
 lcd.write(1);
 lcd.setCursor(5,0);
 lcd.write(1);
 lcd.setCursor(6,0);
 lcd.write(1);
 lcd.setCursor(7,0);
 lcd.write(1);
 lcd.setCursor(8,0);
 lcd.write(1);
 lcd.setCursor(9,0);
 lcd.write(1);
 lcd.setCursor(10,0);
 lcd.write(1);
 lcd.setCursor(11,0);
 lcd.write(1);
 lcd.setCursor(12,0);
 lcd.write(1);
}

if (nivel>= 100)
{
 lcd.setCursor(3,0);
 lcd.write(1);
 lcd.setCursor(4,0);
 lcd.write(1);
 lcd.setCursor(5,0);
 lcd.write(1);
 lcd.setCursor(6,0);
 lcd.write(1);
 lcd.setCursor(7,0);
 lcd.write(1);
 lcd.setCursor(8,0);
 lcd.write(1);
 lcd.setCursor(9,0);
 lcd.write(1);
 lcd.setCursor(10,0);
 lcd.write(1);
 lcd.setCursor(11,0);
 lcd.write(1);
 lcd.setCursor(12,0);
 lcd.write(1);
 lcd.setCursor(13,0);
 lcd.write(1);
}

// PLOTANDO NIVEL EM % *************************************************************************************************************************************************************
if ( nivel <10)
{
lcd.setCursor(17,1);
lcd.print("   ");
lcd.setCursor(14,1);
lcd.print(nivel,1);
}

if (  nivel >=10 &&  nivel<99)
{
lcd.setCursor(18,1);
lcd.print("  ");
lcd.setCursor(14,1);
lcd.print(nivel,1);
}

if (nivel >=100)
{
lcd.setCursor(14,1);
lcd.print(nivel,1);
}


// PLOTANDO LITROS       *************************************************************************************************************************************************************

volume = (3.14159265359 * (r*r)*distanciaCM)/1000;


if ( volume<10)
{
lcd.setCursor(17,3);
lcd.print("   ");
lcd.setCursor(14,3);
lcd.print(volume,1);
}

if ( volume>=10 && volume<99)
{
lcd.setCursor(18,3);
lcd.print("  ");
lcd.setCursor(14,3);
lcd.print(volume,1);
}

if (volume>=100)
{
 lcd.setCursor(19,3);
 lcd.print(" ");
 lcd.setCursor(14,3);
 lcd.print(volume,1);
}




if (linha == 100) //laço para limitar a quantidade de dados
{
linha = 0;
//Serial.println("ROW,SET,2");

Serial.println("CLEARDATA");            // Reset da comunicação serial
Serial.println("LABEL,Hora,nivel,distanciaCM,litros");   // Nomeia as colunas
}



AtualMillis = millis();    //Tempo atual em ms
  
  if (AtualMillis - UltimoMillis > intervalo) 
  { 
    UltimoMillis = AtualMillis;    // Salva o tempo atual
  AtualizaGrafico();
  linha++;
    
  }


 // incrementa a linha do excel para que a leitura pule de linha em linha
} // fecha loop




void AtualizaGrafico()
{

  Serial.print("DATA,TIME,"); //inicia a impressão de dados, sempre iniciando 
  Serial.print(nivel); 
  Serial.print(",");
  Serial.print(distanciaCM); 
  Serial.print(",");
  Serial.println(volume); 
  
  
}

