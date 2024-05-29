int redPin = 3;
int greenPin = 5;
int bluePin = 6;
int group1Button = 4;

void setup(){

Serial.begin(9600);

delay(1000);
Serial.println("LED RGB");
delay(1000);
Serial.println("Controle de voz");
pinMode(redPin, OUTPUT);
pinMode(greenPin, OUTPUT);
pinMode(bluePin, OUTPUT);
pinMode(group1Button, INPUT);
delay(500);
Serial.println(" Entrando em modo compacto");
Serial.write(0xAA);
Serial.write(0x37); //alterna para modo compacto
delay(2000);
Serial.println(" Incorporando grupo 1");
Serial.write(0xAA);
Serial.write(0x21); //incorpora o grupo 1 para utilizar

}
void loop(){
char c=Serial.read();  
if(c=='r'){setup();}
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

Serial.println(" Gravar Grupo 1");
Serial.println(" Entrando no modo de gravacao do grupo 1");
Serial.write(0xAA);
Serial.write(0x11); //entra no modo de gravacao do grupo 1

while(flag == 0){
if( Serial.available() > 0) { //detecta dado na porta serial, se tiver algo no buffer
incomingByte = Serial.read(); //pega dado da serial e parte para o testes
if(incomingByte == 0xe0){ //erro de comando
rgbLed(255,0,0);
delay(200);
rgbLed(0,0,0);
}
else if(incomingByte == 0x40||c=='a'){ //fale agora - START
Serial.println("Fale quando avisar");
rgbLed(0,255,0);
delay(200);
Serial.println("Agora");
rgbLed(0,0,0);
}
else if(incomingByte == 0x41){ //sem voz
Serial.println("Sem voz");
rgbLed(0,255,255);
delay(200);
rgbLed(0,0,0);
}
else if(incomingByte == 0x42){ //fale de novo!
Serial.println("Fale Denovo");
rgbLed(0,0,255);
delay(200);
Serial.println("Agora");
rgbLed(0,0,0);
}
else if(incomingByte == 0x43){ //muito alto
Serial.println("Muito Alto");
rgbLed(255,255,0);
delay(200);
rgbLed(0,0,0);
}
else if(incomingByte == 0x44){ //diferente
Serial.println("Vozes foram Diferentes");
rgbLed(255,255,255);
delay(200);
rgbLed(0,0,0);
}
else if(incomingByte == 0x45){ //comando gravado
Serial.println("Comando Gravado");
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
Serial.println("Grupo Gravado");
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
Serial.write(0xAA);
Serial.write(0x21); //incorpora o grupo 1 para utilizar
Serial.println("Incorpora Grupo 1 para utilizar");
Serial.println("LED RGB");
Serial.println("Controle de voz");
}
if( Serial.available() > 0) {
incomingByte = Serial.read();
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
