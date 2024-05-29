/*

Equivalencia das saidas Digitais entre NodeMCU e ESP8266 (na IDE do Arduino)
NodeMCU - ESP8266
D0 = 16;
D1 = 5;
D2 = 4;
D3 = 0;
D4 = 2;
D5 = 14;
D6 = 12;
D7 = 13;
D8 = 15;
D9 = 3;
D10 = 1;
*/

int rpm;
float tensao;
float temp;
String msg;
int valor;

void setup() 
{
  Serial.begin(115200);
  rpm = 0;
  msg = "Ligado";
  Serial.println("");
  delay(1000);
  Serial.println("");
  
}



void loop() 
{

rpm = random(0,2300);
tensao = random(120,147);
temp = random(100,340);
valor = random(0,100);



if (valor>50)
{
  msg = "Ligada";
}
else
{
  msg = "Desligada";
}

Serial.print(rpm);
Serial.print("*");
Serial.print(tensao/111*10);
Serial.print("-");
Serial.print(temp/122*9.11);
Serial.print("(");
Serial.println(msg);


delay(700);
                             
}
