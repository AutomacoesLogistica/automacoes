String readString1;
String readString2;
String readString3;
String readString4;
String readString5;
int n;

void setup() 
{ 
  Serial.begin(9600);
  Serial.println("Iniciado!");
  n = 0;
} 

void loop() 
{ 
  while (Serial.available()) 
  {
   delay(3);  
   char c = Serial.read();
   if (c ==',')
   {
   n++;
   }
   else
   {
    if ( n == 0 ) { readString1 += c;  }
    if ( n == 1 ) { readString2 += c;  }
    if ( n == 2 ) { readString3 += c;  }
    if ( n == 3 ) { readString4 += c;  }
    if ( n == 4 ) { readString5 += c;  }
   } // fecha else
  }
  
   if (readString1.length()>0) 
   {
    Serial.println("  ");
    Serial.print("Valor 1 :  "); 
    Serial.println(readString1); 
    Serial.print("Valor 2 :  "); 
    Serial.println(readString2); 
    Serial.print("Valor 3 :  "); 
    Serial.println(readString3); 
    Serial.print("Valor 4 :  "); 
    Serial.println(readString4); 
    Serial.print("Valor 5 :  "); 
    Serial.println(readString5); 
    readString1="";
    readString2="";
    readString3="";
    readString4="";
    readString5="";
    n =0;
   }
}
