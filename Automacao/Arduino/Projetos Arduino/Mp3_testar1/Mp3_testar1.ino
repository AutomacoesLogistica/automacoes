
const int clockPin = 6;  // the pin number of the clock pin
const int dataPin = 9;  // the pin number of the dataPin pin
const int resetPin = 3;  // the pin number of the reset pin

const int botao = 7;

const unsigned int VOLUME_0 = 0xFFF0;
const unsigned int VOLUME_1 = 0xFFF1;
const unsigned int VOLUME_2 = 0xFFF2;
const unsigned int VOLUME_3 = 0xFFF3;
const unsigned int VOLUME_4 = 0xFFF4;
const unsigned int VOLUME_5 = 0xFFF5;
const unsigned int VOLUME_6 = 0xFFF6;
const unsigned int VOLUME_7 = 0xFFF7;

const unsigned int PLAY_PAUSE = 0xFFFE;
const unsigned int STOP = 0xFFFF;

int count;
int ok;

void setup() {
  Serial.begin(115200);
  delay(500);
  
  pinMode(clockPin, OUTPUT);
  pinMode(dataPin, OUTPUT);
  pinMode(resetPin, OUTPUT);
  pinMode(botao, INPUT);

  delay(100);
  
  digitalWrite(clockPin, HIGH);
  digitalWrite(dataPin, LOW);

  delay(100);
  
  // reset the module
  digitalWrite(resetPin, HIGH);
  delay(100);
  digitalWrite(resetPin, LOW);
  delay(10);
  digitalWrite(resetPin, HIGH);
  delay(600);
  digitalWrite(botao, HIGH);
  delay(600);

  sendCommand(VOLUME_7);
  
  count = -1;
  ok = 0;
}

void loop() {
  int r = digitalRead(botao);

  //delay(1000);

  if (!r) 
  { 
    ok = 1;
    count++;
    delay(150);
  }
  // play fisrt file, hexadecimal parameter
  
  if (count == 0 && ok)
  {
    ok = 0;
    sendCommand(0x0000);
    while(digitalRead(botao)) 
    {
      Serial.println("Arduino rodando com musica tocando!");
      delay(100);
    }
  }
  else if (count == 1 && ok)
  {
    ok = 0;
    sendCommand(0x0001);
    while(digitalRead(botao)) delay(100);
  }
  else if (count == 2 && ok)
  { 
    ok = 0;
    sendCommand(0x0002);
    while(digitalRead(botao)) delay(100);
  }
  else if (count == 3 && ok)
  {
    ok = 0;
    sendCommand(0x0003);
    while(digitalRead(botao)) delay(100);
  }
  else
  {
    ok = 0;
    // stop playing
    sendCommand(STOP);
    count = -1;
  }
  delay(100);
}

void sendCommand(int addr) {
 digitalWrite(clockPin, LOW);
  delay(2);
  for (int i=15; i>=0; i--)
  { 
    delayMicroseconds(50);
    if((addr>>i)&0x0001 >0)
      {
        digitalWrite(dataPin, HIGH);
        //Serial.print(1);
      }
    else
       {
         digitalWrite(dataPin, LOW);
        // Serial.print(0);
       }
    delayMicroseconds(50);
    digitalWrite(clockPin, HIGH);
    delayMicroseconds(50);
    
    if(i>0)
    digitalWrite(dataPin, LOW);
    else
    digitalWrite(dataPin, HIGH);
    delayMicroseconds(50);
    
    if(i>0)
    digitalWrite(clockPin, LOW);
    else
    digitalWrite(clockPin, HIGH);
  }
  
  delay(20); 
}
