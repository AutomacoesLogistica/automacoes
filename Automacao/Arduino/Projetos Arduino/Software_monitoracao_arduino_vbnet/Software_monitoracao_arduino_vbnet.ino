
String readString;

void setup() 
{
  
  Serial.begin(9600);
   
  pinMode(2,OUTPUT);
  pinMode(3,OUTPUT);
  pinMode(4,OUTPUT);
  pinMode(5,OUTPUT);
  pinMode(6,OUTPUT);
  pinMode(7,OUTPUT);
  pinMode(8,OUTPUT);
  pinMode(9,OUTPUT);
  pinMode(10,OUTPUT);
  pinMode(11,OUTPUT);
  pinMode(12,OUTPUT);
  pinMode(13,OUTPUT);
  
  digitalWrite(2,0);
  digitalWrite(3,0);
  digitalWrite(4,0);
  digitalWrite(5,0);
  digitalWrite(6,0);
  digitalWrite(7,0);
  digitalWrite(8,0);
  digitalWrite(9,0);
  digitalWrite(10,0);
  digitalWrite(11,0);
  digitalWrite(12,0);
  digitalWrite(13,0);


}

void loop() 
{  



   while (Serial.available()) 
   {
    delay(3);  
    char c = Serial.read();
    readString += c; 
   }
  
  //reinicia o arduino
  if (readString.length() >0) 
  {
      
  // altera o status da saida 2
    if (readString.indexOf("2on") >= 0)     
   {
   digitalWrite(2,1);
   }
   if (readString.indexOf("2off") >= 0)     
   {
   digitalWrite(2,0);
   }

   // ''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
   
   
   
    // altera o status da saida 3
 
   if (readString.indexOf("3on") >= 0)     
   {
   digitalWrite(3,1);
   }
   
   if (readString.indexOf("3off") >= 0)     
   {
   digitalWrite(3,0);
   }
 
   // ''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
  
  
   // altera o status da saida 4
 
   if (readString.indexOf("4on") >= 0)     
   {
   digitalWrite(4,1);
   }
   
   if (readString.indexOf("4off") >= 0)     
   {
   digitalWrite(4,0);
   }
 
   // ''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
  
  
   // altera o status da saida 5
 
   if (readString.indexOf("5on") >= 0)     
   {
   digitalWrite(5,1);
   }
   
   if (readString.indexOf("5off") >= 0)     
   {
   digitalWrite(5,0);
   }
 
   // ''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
  
  
  
   // altera o status da saida 6
 
   if (readString.indexOf("6on") >= 0)     
   {
   digitalWrite(6,1);
   }
   
   if (readString.indexOf("6off") >= 0)     
   {
   digitalWrite(6,0);
   }
 
   // ''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
  
  
   // altera o status da saida 7
 
   if (readString.indexOf("7on") >= 0)     
   {
   digitalWrite(7,1);
   }
   
   if (readString.indexOf("7off") >= 0)     
   {
   digitalWrite(7,0);
   }
 
   // ''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
  
  
   // altera o status da saida 8
 
   if (readString.indexOf("8on") >= 0)     
   {
   digitalWrite(8,1);
   }
   
   if (readString.indexOf("8off") >= 0)     
   {
   digitalWrite(8,0);
   }
 
   // ''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
  
  
  
  
  
   // altera o status da saida 9
 
   if (readString.indexOf("9on") >= 0)     
   {
   digitalWrite(9,1);
   }
   
   if (readString.indexOf("9off") >= 0)     
   {
   digitalWrite(9,0);
   }
 
   // ''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
  
  
  
   // altera o status da saida 10
 
   if (readString.indexOf("10on") >= 0)     
   {
   digitalWrite(10,1);
   }
   
   if (readString.indexOf("10off") >= 0)     
   {
   digitalWrite(10,0);
   }
 
   // ''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
  
  
  
   // altera o status da saida 11
 
   if (readString.indexOf("11on") >= 0)     
   {
   digitalWrite(11,1);
   }
   
   if (readString.indexOf("11off") >= 0)     
   {
   digitalWrite(11,0);
   }
 
   // ''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
  
  
  
   // altera o status da saida 12
 
   if (readString.indexOf("12oon") >= 0)     
   {
   digitalWrite(12,1);
   }
   
   if (readString.indexOf("12ooff") >= 0)     
   {
   digitalWrite(12,0);
   }
 
   // ''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
  
  
   // altera o status da saida 13
 
   if (readString.indexOf("13oon") >= 0)     
   {
   digitalWrite(13,1);
   }
   
   if (readString.indexOf("13ooff") >= 0)     
   {
   digitalWrite(13,0);
   }
 
   // ''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
  
  
   // altera o status da saida todas para desligado
 
   if (readString.indexOf("alloff") >= 0)     
   {
      digitalWrite(2,0);
      digitalWrite(3,0);
      digitalWrite(4,0);
      digitalWrite(5,0);
      digitalWrite(6,0);
      digitalWrite(7,0);
      digitalWrite(8,0);
      digitalWrite(9,0);
      digitalWrite(10,0);
      digitalWrite(11,0);
      digitalWrite(12,0);
      digitalWrite(13,0);
       
   }
 
   // ''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
  
  
  
  
  // altera o status da saida todas para ligado
 
   if (readString.indexOf("allon") >= 0)     
   {
      digitalWrite(2,1);
      digitalWrite(3,1);
      digitalWrite(4,1);
      digitalWrite(5,1);
      digitalWrite(6,1);
      digitalWrite(7,1);
      digitalWrite(8,1);
      digitalWrite(9,1);
      digitalWrite(10,1);
      digitalWrite(11,1);
      digitalWrite(12,1);
      digitalWrite(13,1);
       
   }
 
   // ''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
  
  Serial.println(readString);
  readString = "";
 }
 
}
