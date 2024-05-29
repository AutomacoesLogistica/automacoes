#include <SPI.h>
#include <Wire.h>
 
#define trigPin 9 // RX 
#define echoPin 8 // TX // CASO SEJA ESP OU RASPBERRY QUE SAO 3.3v E ESTEJA SENDO ALIMENTADO POR 5, USAR O DIVISOR DE TENSAO ACIMA
 
#define LED_BUILTIN 13 // PINO 13
#define SENSOR  2 // PINO D4
long duration;
float distancia;
float u_distancia;
 
long TempoAtual = 0;
long TempoAnterior = 0;
int Intervalo = 1000;
boolean LedStatus = LOW;
float Fator_de_Calibracao = 4.5;
volatile byte Contagem_Pulsos;
byte Pulso_1_Segundo = 0;
float Quociente_Vazao;
unsigned long Vazao_Mililitros;
unsigned int Total_Mililitros;
float Vazao_Litros;
float Total_Litros;


#define N 20 // Numero de amostras
float media; // Recebe a media
int valores[N]; // Array para armazenar os valores lidos
float soma; // Variavel para somar os valores 

 
void Conta_Pulsos()
{
  Contagem_Pulsos++;
}
 
 
void setup()
{
  Serial.begin(9600);
  delay(10);
 
  pinMode(LED_BUILTIN, OUTPUT);
  pinMode(SENSOR, INPUT_PULLUP);
  pinMode(trigPin, OUTPUT);
  pinMode(echoPin, INPUT);

  Contagem_Pulsos = 0;
  Quociente_Vazao = 0.0;
  Vazao_Mililitros = 0;
  Total_Mililitros = 0;
  TempoAnterior = 0;
 
  attachInterrupt(digitalPinToInterrupt(SENSOR), Conta_Pulsos, FALLING);
}
 
void loop()
{
  TempoAtual = millis();
  if (TempoAtual - TempoAnterior > Intervalo) 
  {
    Pulso_1_Segundo = Contagem_Pulsos;
    Contagem_Pulsos = 0;
    Quociente_Vazao = ((1000.0 / (millis() - TempoAnterior)) * Pulso_1_Segundo) / Fator_de_Calibracao;
    TempoAnterior = millis();
    Vazao_Mililitros = (Quociente_Vazao / 60) * 1000;
    Vazao_Litros = (Quociente_Vazao / 60);
    Total_Mililitros += Vazao_Mililitros;
    Total_Litros += Vazao_Litros;
    float vazao = float(Quociente_Vazao);
    
    digitalWrite(trigPin, LOW);
    delayMicroseconds(5);
    digitalWrite(trigPin, HIGH);
    delayMicroseconds(10);
    digitalWrite(trigPin, LOW);
    duration = pulseIn(echoPin, HIGH);
    distancia= duration*0.034/2; // Em cm ja
    
    
     // For para fazer o deslocamento das variaveis, atualizando-as ************************************************************************
     for(int i = N-1;i>0;i--)
     {
      valores[i] = valores[i-1];
     }
     // *************************************************************************************************************************************
     valores[0] = distancia; // Coloca o valor mais atual em valores[0]
     soma = 0;  // Limpa a variavel de soma
    // For para calcular a media atualizada *************************************************************************************************
    for (int i=0;i<N;i++)
    {
     soma = soma+valores[i];
    }
    // ***************************************************************************************************************************************
    media = soma/N;
    distancia = media;
      
    if(distancia>0)
    {
      u_distancia = distancia;
    }
    Serial.print("vz=");
    Serial.print(vazao); // L/min
    Serial.print(",l=");
    Serial.print(Total_Litros); // Litros ja passados
    Serial.print(",d=");
    Serial.print(u_distancia);
    Serial.println(";");
 
  } // Fecha o if do Millis
  
   
}// Fecha Loop
