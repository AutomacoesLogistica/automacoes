#include<Wire.h>

//Endereco I2C do Endereco_MPU6050
const int Endereco_MPU = 0x68; //pino aberto 0X68 , pino ligado em 3,3V 0x69

//Variaveis globais
int acelX, acelY, acelZ;

//configurações iniciais
void setup()
{

  Serial.begin(9600); //inicia a comunicação serial
  Wire.begin();                 //inicia I2C
  Wire.beginTransmission(Endereco_MPU);  //Inicia transmissão para o endereço do Endereco_MPU
  Wire.write(0);
  Wire.endTransmission(true);
  pinMode(13,OUTPUT);
  digitalWrite(13,0);
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
  acelZ = Wire.read() << 8 | Wire.read();


  //Envia valores lidos do acelerômetro
  acelX = map(acelX, -16300, 16300, 0, 10);
  acelY = map(acelY, -16300, 16300, 0, 10);
  acelZ = map(acelZ, -16300, 16300, 0, 10);

 Serial.print (acelX);
 Serial.print (",");
 Serial.print (acelY);
 Serial.print (",");
 Serial.println (acelZ); 
 
  if ( acelX==5 && acelY==5)
  {
    digitalWrite(13,1);
  }
  else
  {
    digitalWrite(13,0);
  }
 

}
