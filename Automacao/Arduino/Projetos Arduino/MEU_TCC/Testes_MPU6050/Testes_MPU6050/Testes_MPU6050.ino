#include<Wire.h>
#define N 300 // Numero de amostas

int media; // Recebe a media
int valores[N]; // Array para armazenar os valores lidos
long soma; // Variavel para somar os valores 

//Endereco I2C do MPU6050
const int MPU = 0x68; //pino aberto 0X68 , pino ligado em 3,3V 0x69

//Variaveis globais
int acelX, acelY, acelZ, temperatura, giroX, giroY, giroZ;

//configurações iniciais
void setup()
{

  Serial.begin(9600); //inicia a comunicação serial
  Wire.begin();                 //inicia I2C
  Wire.beginTransmission(MPU);  //Inicia transmissão para o endereço do MPU
  Wire.write(0x6B);

  //Inicializa o MPU-6050
  Wire.write(0);
  Wire.endTransmission(true);
}

//loop principal
void loop()
{
  Wire.beginTransmission(MPU);      //transmite
  Wire.write(0x3B);                 // Endereço 0x3B (ACCEL_XOUT_H)
  Wire.endTransmission(false);     //Finaliza transmissão

  Wire.requestFrom(MPU, 14, true); //requisita bytes

  //Armazena o valor dos sensores nas variaveis correspondentes
  acelX = Wire.read() << 8 | Wire.read();
  acelY = Wire.read() << 8 | Wire.read();
  acelZ = Wire.read() << 8 | Wire.read();

  //temperatura = Wire.read() << 8 | Wire.read();

  giroZ = Wire.read() << 8 | Wire.read();

  //Envia valores lidos do acelerômetro
  acelX = map(acelX, -16300, 16300, -10, 10);
  acelY = map(acelY, -16300, 16300, -10, 10);
  acelZ = map(acelZ, -16300, 16300, -10, 10);



int valorLido = giroZ;

// For para fazer o deslocamento das variaveis, atualizando-as ************************************************************************
 
 for(int i = N-1;i>0;i--)
 {
  valores[i] = valores[i-1];
 }

 // *************************************************************************************************************************************
 

  valores[0] = valorLido; // Coloca o valor mais atual em valores[0]
  soma = 0;  // Limpa a variavel de soma



  // For para calcular a media atualizada *************************************************************************************************
  for (int i=0;i<N;i++)
  {
    soma = soma+valores[i];
  }

  // ***************************************************************************************************************************************
  
  
  media = soma/N;








 
  Serial.print(acelX);
  Serial.print(",");
  Serial.print(acelY);
  Serial.print(",");
  Serial.println(media);


}
