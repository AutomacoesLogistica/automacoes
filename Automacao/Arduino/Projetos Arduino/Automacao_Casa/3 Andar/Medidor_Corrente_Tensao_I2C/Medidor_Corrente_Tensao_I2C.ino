/*
 * CODIGO RODA DENTRO DE UM PRO MINI COMUNICANDO VIA SERIAL COM UM ESP8266 NODEMCU QUE ENVIA OS DADOS PARA MQTT
 * 
 * 
 */
#include <Wire.h>
#include <LiquidCrystal_I2C.h>
#include "EmonLib.h" //INCLUSÃO DE BIBLIOTECA

#define VOLT_CAL 500
#define entrada 2 // Entrada do botao para mudar de menu
#define entrada_interfone A4 // Entrada do interfone

EnergyMonitor emon1; //Fase1
EnergyMonitor emon2; //Fase2
EnergyMonitor SCT013_1;
EnergyMonitor SCT013_2;
int tela = 0;
int aux_tela = 0; 
float tensao1;
float tensao2;
double Irms_1;
double Irms_2;
double Irms_t;
float potencia_1;
float potencia_2;
float potencia_t;
int valor_interfone = 0;

LiquidCrystal_I2C lcd(0x27, 16, 2);

void setup() 
{
 SCT013_1.current(A0, 6.0606);
 SCT013_2.current(A1, 6.0606);
 emon1.voltage(A2, VOLT_CAL, 1.7); //PASSA PARA A FUNÇÃO OS PARÂMETROS (PINO ANALÓGIO / VALOR DE CALIBRAÇÃO / MUDANÇA DE FASE)
 emon2.voltage(A3, VOLT_CAL, 1.7); //PASSA PARA A FUNÇÃO OS PARÂMETROS (PINO ANALÓGIO / VALOR DE CALIBRAÇÃO / MUDANÇA DE FASE)
 pinMode(entrada,INPUT);
 Serial.begin(115200);
 lcd.init();   // INICIALIZA O DISPLAY LCD
 lcd.backlight(); // HABILITA O BACKLIGHT (LUZ DE FUNDO
 
 lcd.setCursor(0,0);lcd.print ("Iniciando!");
 delay(2000);
 lcd.clear();
}
void loop()
{
  valor_interfone = analogRead(entrada_interfone);
  
  emon1.calcVI(17,2000); //FUNÇÃO DE CÁLCULO (17 SEMICICLOS, TEMPO LIMITE PARA FAZER A MEDIÇÃO)    
  emon2.calcVI(17,2000); //FUNÇÃO DE CÁLCULO (17 SEMICICLOS, TEMPO LIMITE PARA FAZER A MEDIÇÃO)    
  
  tensao1   = emon1.Vrms; //VARIÁVEL RECEBE O VALOR DE TENSÃO RMS OBTIDO
  tensao2   = emon2.Vrms; //VARIÁVEL RECEBE O VALOR DE TENSÃO RMS OBTIDO

  Irms_1 = SCT013_1.calcIrms(1480);
  Irms_2 = SCT013_2.calcIrms(1480);

  if(tensao1<90.0){tensao1 = 0.00;}
  if(tensao2<90.0){tensao2 = 0.00;}
 
  potencia_1 = Irms_1 * tensao1;
  potencia_2 = Irms_2 * tensao2;
  potencia_t = potencia_1+ potencia_2;


  if(digitalRead(entrada)==LOW)
  {
    tela++;
    aux_tela = 0;
    delay(500);
    if(tela>=2)
    {
      tela = 0;
    }
  }

  // Tela 0 ****************************************************************************************************************************
  if ( tela == 0 )
  {
   if(aux_tela == 0)
   {
    lcd.clear();
    aux_tela = 1;
   }
   if(aux_tela==1)
   {
    lcd.setCursor(0,0);lcd.print ("       ");
    lcd.setCursor(0,1);lcd.print ("       ");
    lcd.setCursor(8,0);lcd.print ("        ");
    lcd.setCursor(8,1);lcd.print ("        ");
    lcd.setCursor(0,0);lcd.print (tensao1,2);lcd.print ("V");
    lcd.setCursor(0,1);lcd.print (tensao2,2);lcd.print ("V");
    lcd.setCursor(8,0);lcd.print (Irms_1,1);lcd.print ("A"); 
    lcd.setCursor(8,1);lcd.print (Irms_2,1);lcd.print ("A"); 
    
   } // Fecha aux_tela
  }// Fecha tela 0
  
 
  // Tela 1 ****************************************************************************************************************************
  if ( tela == 1 )
  {
   if(aux_tela == 0)
   {
    lcd.clear();
    aux_tela = 1;
   }
   if(aux_tela==1)
   {
    lcd.setCursor(0,0);lcd.print ("       ");
    lcd.setCursor(0,1);lcd.print ("       ");
    lcd.setCursor(8,0);lcd.print ("        ");
    lcd.setCursor(8,1);lcd.print ("        ");
    lcd.setCursor(0,0);lcd.print (potencia_1,2);lcd.print ("KW");  
    lcd.setCursor(0,1);lcd.print (potencia_2,2);lcd.print ("KW");
    lcd.setCursor(8,0);lcd.print (potencia_t,2);lcd.print ("KW"); 
    
   } // Fecha aux_tela
  }// Fecha tela 0
  
  
  
  
  

  
  Serial.print(tensao1,2);
  Serial.print(";");
  Serial.print(tensao2,2);
  Serial.print(";");
  Serial.print(Irms_1,1);
  Serial.print(";");
  Serial.print(Irms_2,1);
  Serial.print(";");
  Serial.print(potencia_1,2);
  Serial.print(";");
  Serial.print(potencia_2,2);
  Serial.print(";");
  Serial.print(potencia_t,2);
  Serial.print(";");
  Serial.println(valor_interfone);  
  
  delay(500); 
}
