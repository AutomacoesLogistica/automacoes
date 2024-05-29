String readString; // USADO PARA CONCATENAR DADOS NA SERIAL
void setup() 
{
  Serial.begin(9600);
  pinMode(13,OUTPUT);
  pinMode(2,OUTPUT);
  digitalWrite(2,0);
  pinMode(3,OUTPUT);
  digitalWrite(3,0);
  pinMode(4,OUTPUT);
  digitalWrite(4,0);
  pinMode(5,OUTPUT);
  digitalWrite(5,0);
  
  
  pinMode(A0,INPUT);
  pinMode(A1,INPUT);
  
}

void loop() 
{
  while (Serial.available()) 
  {
    delay(3);  
    char c = Serial.read();
    readString += c; 
  }
  
    
    
    
    if (readString == "next")
    {
     digitalWrite(5,1);delay(300);digitalWrite(5,0);

    }


    if (readString == "ant"||analogRead(A1)>=1000)
    {
    digitalWrite(4,1);delay(300);digitalWrite(4,0);
    }

    if (readString == "modo")
    {
    digitalWrite(3,1);delay(300);digitalWrite(3,0);
    }


    if (readString == "play")
    {
    digitalWrite(2,1);delay(300);digitalWrite(2,0);
    }

    readString = "";
}
