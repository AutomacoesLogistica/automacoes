
String readString;

void setup() 
{
Serial.begin(9600);
pinMode(8,OUTPUT);
pinMode(9,OUTPUT);
pinMode(10,OUTPUT);
pinMode(11,OUTPUT);
digitalWrite(8,1);
digitalWrite(9,1);
digitalWrite(10,1);
digitalWrite(11,1);


pinMode(2,INPUT);
digitalWrite(2,0);
pinMode(3,INPUT);
digitalWrite(3,0);
pinMode(4,INPUT);
digitalWrite(4,0);
pinMode(5,INPUT);
digitalWrite(5,0);
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
    //Serial.println(readString);
    if (readString == "lamp1")     
    {
    digitalWrite(8,!digitalRead(8));
    if ( digitalRead(8)==1){Serial.println("Lamp1_ON");}
    if ( digitalRead(8)==0){Serial.println("Lamp1_OFF");}
    }
    if (readString == "lamp2")     
    {
    digitalWrite(9,!digitalRead(9));
    if ( digitalRead(9)==1){Serial.println("Lamp2_ON");}
    if ( digitalRead(9)==0){Serial.println("Lamp2_OFF");}
    }
    if (readString == "lamp3")     
    {
    digitalWrite(10,!digitalRead(10));
    if ( digitalRead(10)==1){Serial.println("Lamp3_ON");}
    if ( digitalRead(10)==0){Serial.println("Lamp3_OFF");}
    }
    if (readString == "lamp4")     
    {
    digitalWrite(11,!digitalRead(11));
    if ( digitalRead(11)==1){Serial.println("Lamp4_ON");}
    if ( digitalRead(11)==0){Serial.println("Lamp4_OFF");}
    }
  readString ="";
  }





if (digitalRead(2)==1)
{
  digitalWrite(8,!digitalRead(8));
    if ( digitalRead(8)==1){Serial.println("Lamp1_ON");}
    if ( digitalRead(8)==0){Serial.println("Lamp1_OFF");}
    delay(1000);
}

if ( digitalRead(3)==1)
{
  digitalWrite(9,!digitalRead(9));
    if ( digitalRead(9)==1){Serial.println("Lamp2_ON");}
    if ( digitalRead(9)==0){Serial.println("Lamp2_OFF");}
    delay(1000);
}

if ( digitalRead(4)>=1)
{
  digitalWrite(10,!digitalRead(10));
    if ( digitalRead(10)==1){Serial.println("Lamp3_ON");}
    if ( digitalRead(10)==0){Serial.println("Lamp3_OFF");}
    delay(1000);
}

if ( digitalRead(5)==1)
{
  digitalWrite(11,!digitalRead(11));
    if ( digitalRead(11)==1){Serial.println("Lamp4_ON");}
    if ( digitalRead(11)==0){Serial.println("Lamp4_OFF");}
    delay(1000);
}





}
