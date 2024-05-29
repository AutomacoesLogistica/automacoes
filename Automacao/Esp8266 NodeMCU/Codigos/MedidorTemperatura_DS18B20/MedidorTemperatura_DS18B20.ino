/*
 * 
 * Pode ser alimentado em 3.3V ou 5V - Para o ESP8266 Alimentar com 3.3V
 * 
 * Usar um resistor de 5K ( 2 de 10K em paralelo ) entre o vermelho (VCC) e o sinal ( Amarelo )
 * 
 * Codigo para monitorar dois sensores de temperatura DS18B20
 * 
 */


#include <OneWire.h> //INCLUSÃO DE BIBLIOTECA
#include <DallasTemperature.h> //INCLUSÃO DE BIBLIOTECA

#define DS18B20 7 //DEFINE O PINO DIGITAL UTILIZADO PELO SENSOR

OneWire ourWire(DS18B20); //CONFIGURA UMA INSTÂNCIA ONEWIRE PARA SE COMUNICAR COM O SENSOR
DallasTemperature sensors(&ourWire); //BIBLIOTECA DallasTemperature UTILIZA A OneWire

void setup(){
  Serial.begin(9600); //INICIALIZA A SERIAL
  sensors.begin(); //INICIA O SENSOR
  delay(1000); //INTERVALO DE 1 SEGUNDO
}

void loop(){
  sensors.requestTemperatures();//SOLICITA QUE A FUNÇÃO INFORME A TEMPERATURA DO SENSOR
  Serial.print("Temperatura: "); //IMPRIME O TEXTO NA SERIAL
  Serial.print(sensors.getTempCByIndex(0)); //IMPRIME NA SERIAL O VALOR DE TEMPERATURA MEDIDO // Primeiro Sensor
  Serial.print( " - " );
  Serial.print(sensors.getTempCByIndex(1)); //IMPRIME NA SERIAL O VALOR DE TEMPERATURA MEDIDO // Segundo Sensor
  Serial.println("*C"); //IMPRIME O TEXTO NA SERIAL
  delay(250);//INTERVALO DE 250 MILISSEGUNDOS
}
