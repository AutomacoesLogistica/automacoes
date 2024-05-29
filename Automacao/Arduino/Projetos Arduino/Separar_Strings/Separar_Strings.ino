int ledPin = 13;
String readString;

void setup() {
  Serial.begin(9600);
  pinMode(ledPin, OUTPUT); 
}

void loop() {
  int i;
  char d[5];
  
  
  while (Serial.available()) {
      delay(3);
    char c = Serial.read();
    
    readString += c;
  }
  
  if (readString.length()) {

  
     Serial.write(readString[0]);
     Serial.write(readString[1]);
     Serial.write(readString[2]);
     Serial.write(readString[3]);
     Serial.println("");     
     Serial.write(readString[4]);
     Serial.write(readString[5]);
     Serial.write(readString[6]);
     Serial.write(readString[7]);
     Serial.println("");
     Serial.write(readString[8]);
     Serial.write(readString[9]);
     Serial.write(readString[10]);
     Serial.write(readString[11]);
     Serial.println("");
 


  
    readString="";

  } 
}

