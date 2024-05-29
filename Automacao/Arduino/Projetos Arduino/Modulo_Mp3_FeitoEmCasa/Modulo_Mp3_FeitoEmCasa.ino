
String readString;

void setup() 
{
  Serial.begin(9600);
  pinMode(2, OUTPUT); // mode - cabo branco 
  pinMode(3, OUTPUT); // proxima e vol+   - cabo roxo
  pinMode(4, OUTPUT); // play e pause e em radio serve como scan  - cabo azul 
  pinMode(5, OUTPUT); // anterior e vol-    - cabo verde
  
  digitalWrite(2,LOW);
  digitalWrite(3,LOW);
  digitalWrite(4,LOW);
  digitalWrite(5,LOW);
 }

void loop() 
{
  while (Serial.available()) 
  {
   delay(3);  
   char c = Serial.read();
   readString += c; 
  }
  
  if (readString.length() >0) 
  {
    Serial.println(readString);
    
    if (readString == "mode")     
    {
     digitalWrite(2, HIGH);
     delay(200);   
     digitalWrite(2, LOW);   
    }
   
     if (readString == "proxima")     
    {
     digitalWrite(3, HIGH);
     delay(100);   
     digitalWrite(3, LOW);   
    }
   
   
     if (readString == "play")     
    {
     digitalWrite(4, HIGH);
     delay(200);   
     digitalWrite(4, LOW);   
    }
    
    
      if (readString == "anterior")     
    {
     digitalWrite(5, HIGH);
     delay(100);   
     digitalWrite(5, LOW);   
    }
    
      if (readString == "vol+")     
    {
     digitalWrite(3, HIGH);
     delay(1000);   
     digitalWrite(3, LOW);   
    }
    
      if (readString == "vol-")     
    {
     digitalWrite(5, HIGH);
     delay(1000);   
     digitalWrite(5, LOW);   
    }
    
  readString="";
  } 
}

