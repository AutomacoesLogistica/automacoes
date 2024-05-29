#include <SoftwareSerial.h>

#define RX 2 
#define TX 3 
SoftwareSerial mySerial(RX, TX);
long vezes = 0;
String readString;

void setup() {
  Serial.begin(9600);
  mySerial.begin(9600); //Start mySerial
  delay(5000);  
  Serial.println("iniciou");
  pinMode(13,OUTPUT);
}

void loop() {
  
  char teste;
  
  while (mySerial.available()) {
    delay(3);  
    char c = mySerial.read();
    readString += c; 
    teste += c;
  }
  
  if (readString.length() >0) {
    Serial.println(readString);
    readString.trim();
    String v = readString;
    mySerial.write(teste);
    if(readString == "descer")
    {
       digitalWrite(13,HIGH);
    }
    else if(readString == "subir")
    {
       digitalWrite(13,LOW);
    }
    else if(readString == "tela_aberta")
    {
       mySerial.write("tela_aberta");
    }
    
    else if(readString == "tela_fechada")
    {
     mySerial.write("tela_fechada");
    }
    
    else if(readString == "projetor_aberto")
    {
       mySerial.write("projetor_aberto");
    }
    else if(readString == "projetor_fechado")
    {
       mySerial.write("projetor_fechado");
    }   
    }
    
    readString="";
    teste = "";
  // Serial.println(vezes);
  // vezes++;

  // if (vezes>=1000)
  // {
  //  vezes = -1000;
   // mySerial.write("bruno");
 //  }
}
