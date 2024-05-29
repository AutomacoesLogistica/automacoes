#include <Wire.h>        //Biblioteca para manipulação do protocolo I2C
#include <DS3231.h>      //Biblioteca para manipulação do DS3231
 
DS3231 RTC;              //Criação do objeto do tipo DS3231
RTCDateTime dataehora;   //Criação do objeto do tipo RTCDateTime

int dia;
int mes;
int ano; 
int hora;
int minuto;
int segundo;


void setup()
{
  Serial.begin(9600);     //Inicialização da comunicação serial
  RTC.begin();            //Inicialização do RTC DS3231
  //RTC.setDateTime(__DATE__, __TIME__);   // Descomente esta linha e compile,serve para colocar a hora da compilação no RTC, depois comente a linha e volte o codigo novamente
  
}
 
void loop()
{
  dataehora = RTC.getDateTime();     // Busca a hora interna do RTC
  dia = dataehora.day;
  mes = dataehora.month;
  ano = dataehora.year;
  hora = dataehora.hour;
  minuto = dataehora.minute;
  segundo = dataehora.second;
  
  Serial.print(dia);      //Imprimindo o Dia
  Serial.print("/");
  Serial.print(mes);    //Imprimindo o Mês
  Serial.print("/");
  Serial.print(ano);     //Imprimindo o Ano   
  Serial.print("         ");
  Serial.print(hora);     //Imprimindo a Hora
  Serial.print(":");
  Serial.print(minuto);   //Imprimindo o Minuto
  Serial.print(":");
  Serial.print(segundo);   //Imprimindo o Segundo
  Serial.println("");
  delay(1000);
 
}
