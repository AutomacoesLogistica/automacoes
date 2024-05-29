#include<Wire.h>
#include <SPI.h>
#include <Servo.h>

Servo servo_motor1;
Servo servo_motor2;
//Endereco I2C do Endereco_MPU6050
const int Endereco_MPU = 0x68; //pino aberto 0X68 , pino ligado em 3,3V 0x69



#define N 30 // Numero de amostas
float media; // Recebe a media
float valores[N]; // Array para armazenar os valores lidos
double soma; // Variavel para somar os valores 
int eixoX = 0.0;



#define M 30 // Numero de amostas
float mediaM; // Recebe a media
float valoresM[M]; // Array para armazenar os valores lidos
double somaM; // Variavel para somar os valores 
int eixoY = 0.0;







//Variaveis globais
int acelX;
int acelY;
int pino_servo_motor1 = 3;
int pino_servo_motor2 = 5;
int valor_servo_motor1 = 90;
int valor_servo_motor2 = 90;
int valorInicialX = 90;
int valorInicialY = 45;
//configurações iniciais
void setup()
{

  Serial.begin(9600); //inicia a comunicação serial
  Wire.begin();                 //inicia I2C
  Wire.beginTransmission(Endereco_MPU);  //Inicia transmissão para o endereço do Endereco_MPU
  Wire.write(0x6B);
  Wire.write(0);
  Wire.endTransmission(true);
  servo_motor1.attach(pino_servo_motor1);
  servo_motor2.attach(pino_servo_motor2);
 
}

//loop principal
void loop()
{
  
  Wire.beginTransmission(Endereco_MPU);
  Wire.write(0x3B);        
  Wire.endTransmission(false);

  Wire.requestFrom(Endereco_MPU, 14, true); //requisita bytes

  //Armazena o valor dos sensores nas variaveis correspondentes
  acelX = Wire.read() << 8 | Wire.read();
  acelY = Wire.read() << 8 | Wire.read();



  //Envia valores lidos do acelerômetro
  acelX = map(acelX, -16300, 16300, 0, 100);
  acelY = map(acelY, -16300, 16300, 0, 100);

  valor_servo_motor1 = map(acelX, 0, 100, -30 ,30);
  valor_servo_motor2 = map(acelY, 0, 100,60 , -60);


  // For para fazer o deslocamento das variaveis, atualizando-as ************************************************************************
  for(int i = N-1;i>0;i--)
  {
   valores[i] = valores[i-1];
   valoresM[i] = valoresM[i-1];
  }
  
  valores[0] = valor_servo_motor2; // Coloca o valor mais atual em valores[0]
  valoresM[0] = valor_servo_motor1; // Coloca o valor mais atual em valores[0]
  soma = 0;  // Limpa a variavel de soma
  somaM = 0;  // Limpa a variavel de soma

   // For para calcular a media atualizada *************************************************************************************************
  for (int i=0;i<N;i++)
  {
    soma = soma+valores[i];
    somaM = somaM+valoresM[i];
  }

  // ***************************************************************************************************************************************
  
  media = soma/N;
  mediaM = somaM/M;

  eixoX = media;  // atualiza distanciaCM com o valor ja estabilizado pela media movel
  eixoY = mediaM;  // atualiza distanciaCM com o valor ja estabilizado pela media movel




Serial.println(eixoY);




  
  servo_motor1.write(valorInicialY+eixoY); // Servo para vertical
  servo_motor2.write(valorInicialX-eixoX); // Servo para horizontal


      
} //Fecha o loop
