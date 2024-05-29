/*
 * 
 * Novo projeto da Central Multimédia
 * 
 * 
 * 
 * Autor:  Bruno Gonçalves
 * Hora : 20:48        
 * Dia :  26/07/2016
 * 
 * 
 * 
 */


int botao;// recebe o valor na analogica A0 para saber qual botao foi precionado
String tecla; //armazena o ultimo botao pressionado
int ledPin = 12;

String readString;
int valor;
void setup() 
{
 Serial.begin(9600);
 valor = 255;
 pinMode(ledPin, OUTPUT); 
 analogWrite(ledPin,valor);
 botao = 0;
 tecla = "";
}

void loop() 
{

while (Serial.available()) {
    delay(3);  
    char c = Serial.read();
    readString += c; 
  }
  if (readString.length() >0) {
    Serial.println(readString);
    valor = (readString.toInt());
    analogWrite(ledPin,valor);
    delay(500);
    valor = 255;
    analogWrite(ledPin,valor);
    readString="";
  } 











  
botao = analogRead(A0);  



if ( botao>=10) //abre o mapeamento de teclas pressionadas
{
 if (botao>=845 &&botao<=855)//BOTÃO EJETAR
 { 
  tecla = "EJETAR";
 }
 if (botao>=519 &&botao<=529)//BOTÃO FM/AM
 {
  tecla = "FM/AM"; 
 }
 if (botao>=338 &&botao<=348)//BOTÃO DVD
 {
  tecla = "DVD"; 
 }
 if (botao>=45 &&botao<=55)//BOTÃO BLUETOOTH
 {
  tecla = "BT"; 
 }
 if (botao>=7 &&botao<=17)//BOTÃO AUX
 {
  tecla = "AUX"; 
 }
 if (botao>=723 &&botao<=733)//BOTÃO RESET
 {
  tecla = "RESET"; 
 }
 if (botao>=561 &&botao<=571)//BOTÃO MUTE
 {
  tecla = "MUTE"; 
 }
 if (botao>=471 &&botao<=481)//BOTÃO GPS
 {
  tecla = "GPS"; 
 }
 if (botao>=425 &&botao<=435)//BOTÃO APS
 {
  tecla = "APS"; 
 }
 if (botao>=154 &&botao<=164)//BOTÃO PIC
 {
  tecla = "PIC"; 
 }
 if (botao>=79 &&botao<=89)//BOTÃO EQUALIZAÇÃO
 {
  tecla = "EQ"; 
 }
 if (botao>=316 &&botao<=326)//BOTÃO proximo
 {
  tecla = "PROXIMO";
 }
 if (botao>=255 &&botao<=265) //BOTÃO anterior
 {
  tecla = "ANTERIOR"; 
 }

}//fecha o mapeamento de teclas pressionadas


// FUNÇÕES DE CADA BOTÃO *********************************************************************
// FUNÇÕES DE CADA BOTÃO *********************************************************************
// FUNÇÕES DE CADA BOTÃO *********************************************************************
// FUNÇÕES DE CADA BOTÃO *********************************************************************
// FUNÇÕES DE CADA BOTÃO *********************************************************************
// FUNÇÕES DE CADA BOTÃO *********************************************************************



if ( tecla == "EJETAR")
{
 tecla = "";   
}
if ( tecla == "FM/AM")
{
 tecla = "";   
}
if ( tecla == "DVD")
{
 tecla = "";   
}
if ( tecla == "BT")
{
 tecla = "";   
}
if ( tecla == "AUX")
{
 tecla = "";   
}
if ( tecla == "MUTE")
{
 tecla = "";   
}
if ( tecla == "RESET")
{
 setup(); 
 tecla = "";   
}
if ( tecla == "GPS")
{
 tecla = "";   
}
if ( tecla == "APS")
{
 tecla = "";  
}
if ( tecla == "PIC")
{
 tecla = "";  
}
if ( tecla == "EQ")
{
 tecla = "";  
}
if ( tecla == "PROXIMO")
{
 analogWrite(ledPin,50);
 delay(500);
 valor = 255;
 analogWrite(ledPin,valor); 
 delay(500);
 tecla = ""; 
}

if ( tecla == "ANTERIOR")
{
 analogWrite(ledPin,100);
 delay(500);
 valor = 255;
 analogWrite(ledPin,valor); 
 delay(500);
 tecla = "";
}








}



