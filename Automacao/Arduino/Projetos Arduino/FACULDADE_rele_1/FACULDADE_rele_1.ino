int modo;
char c;
int n;

void setup()
{
modo = 0;
n=0;
pinMode(13,OUTPUT);
digitalWrite(13,LOW);
Serial.begin(9600);
}


void loop()
{

if ( Serial.available()>0)
{  
  c = Serial.read();
}

  if( c == '0')
  { 
   Modo0(); 
  }
  
  if( c == '1')
  { 
   Modo1(); 
  }
  
  if( c == '2')
  { 
  
   Modo2(); 
  }
  
 

}

