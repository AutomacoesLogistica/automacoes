#include <LiquidCrystal.h>
int redPin = 2;
int greenPin = 3;
int bluePin = 4;
int group1Button = 30;
LiquidCrystal lcd(26, 27, 22, 23, 24, 25);
void setup(){
Serial1.begin(9600);
delay(1000);
lcd.begin(16,2);
lcd.setCursor(4,0);
lcd.print("LED RGB");
lcd.setCursor(0,1);
lcd.print("Controle de voz");
pinMode(redPin, OUTPUT);
pinMode(greenPin, OUTPUT);
pinMode(bluePin, OUTPUT);
pinMode(group1Button, INPUT);
delay(500);
Serial1.write(0xAA);
Serial1.write(0x37); //alterna para modo compacto
delay(2000);
Serial1.write(0xAA);
Serial1.write(0x21); //incorpora o grupo 1 para utilizar
}
void loop(){
byte incomingByte = 0;
int flag = 0;
if( digitalRead(group1Button) == LOW ){
rgbLed(255,0,0);
delay(100);
rgbLed(0,255,0);
delay(100);
rgbLed(0,0,255);
delay(100);
rgbLed(0,0,0);
delay(1000);
lcd.clear();
lcd.print("Gravar Grupo 1");
Serial1.write(0xAA);
Serial1.write(0x11); //entra no modo de gravacao do grupo 1
while(flag == 0){
if( Serial1.available() > 0) { //detecta dado na porta serial, se tiver algo no buffer
incomingByte = Serial1.read(); //pega dado da serial e parte para o testes
if(incomingByte == 0xe0){ //erro de comando
rgbLed(255,0,0);
delay(200);
rgbLed(0,0,0);
}
else if(incomingByte == 0x40){ //fale agora - START
rgbLed(0,255,0);
delay(200);
rgbLed(0,0,0);
}
else if(incomingByte == 0x41){ //sem voz
rgbLed(0,255,255);
delay(200);
rgbLed(0,0,0);
}
else if(incomingByte == 0x42){ //fale de novo!
rgbLed(0,0,255);
delay(200);
rgbLed(0,0,0);
}
else if(incomingByte == 0x43){ //muito alto
rgbLed(255,255,0);
delay(200);
rgbLed(0,0,0);
}
else if(incomingByte == 0x44){ //diferente
rgbLed(255,255,255);
delay(200);
rgbLed(0,0,0);
}
else if(incomingByte == 0x45){ //comando gravado
rgbLed(0,255,0);
delay(200);
rgbLed(0,0,0);
delay(100);
rgbLed(0,255,0);
delay(200);
rgbLed(0,0,0);
delay(1000);
}
}
else if(incomingByte == 0x46){ //grupo gravado
rgbLed(255,255,255);
delay(200);
rgbLed(0,0,0);
delay(100);
rgbLed(255,255,255);
delay(200);
rgbLed(0,0,0);
flag = 1;
}
}
Serial1.write(0xAA);
Serial1.write(0x21); //incorpora o grupo 1 para utilizar
lcd.clear();
lcd.setCursor(4,0);
lcd.print("LED RGB");
lcd.setCursor(0,1);
lcd.print("Controle de voz");
}
if( Serial1.available() > 0) {
incomingByte = Serial1.read();
if(incomingByte == 0x11)
rgbLed(255,0,0);
else if(incomingByte == 0x12)
rgbLed(0,255,0);
else if(incomingByte == 0x13)
rgbLed(0,0,255);
else if(incomingByte == 0x14)
rgbLed(255,0,255);
else if(incomingByte == 0x15)
rgbLed(255,255,255);
}
}
void rgbLed(unsigned char red, unsigned char green, unsigned char blue){
analogWrite(redPin, red);
analogWrite(greenPin, green);
analogWrite(bluePin, blue);
}
