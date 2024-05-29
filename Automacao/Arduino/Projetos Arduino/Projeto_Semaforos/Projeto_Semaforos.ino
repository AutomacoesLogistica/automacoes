// usado no timer do wireless
long valorTempo = 0; 
long intervalo = 1000; // DEFINE O TEMPO DO TIMER
int numero_vezes_loop;
int timer_ativo;



int SEMAFORO1,SEMAFORO2,SEMAFORO3,SEMAFORO4,SEMAFORO5,SEMAFORO6,SEMAFORO7,SEMAFORO8,SEMAFORO9,SEMAFORO10;
int tsem1a,tsem2a,tsem3a,tsem4a,tsem5a,tsem6a,tsem7a,tsem8a,tsem9a,tsem10a;
int tsem1f,tsem2f,tsem3f,tsem4f,tsem5f,tsem6f,tsem7f,tsem8f,tsem9f,tsem10f;
int sem1,sem2,sem3,sem4,sem5,sem6,sem7,sem8,sem9,sem10;
int ligado2;

void setup()
{
  Serial.begin(9600);

//  Semaforo 1 ********************************

  pinMode(2,OUTPUT); // Semaforo 1 Vermelho
  pinMode(3,OUTPUT); // Semaforo 1 Verde
  digitalWrite(2,0);
  digitalWrite(3,1);
  
//  Semaforo 2 ********************************

  pinMode(4,OUTPUT); // Semaforo 2 Vermelho
  pinMode(5,OUTPUT); // Semaforo 2 Verde
  digitalWrite(4,1);
  digitalWrite(5,0);

//  Semaforo 3 ********************************

  pinMode(6,OUTPUT); // Semaforo 3 Vermelho
  pinMode(7,OUTPUT); // Semaforo 3 Verde
  digitalWrite(6,0);
  digitalWrite(7,1);

//  Semaforo 4 ********************************

  pinMode(8,OUTPUT); // Semaforo 4 Vermelho
  pinMode(9,OUTPUT); // Semaforo 4 Verde
  digitalWrite(8,1);
  digitalWrite(9,0);

//  Semaforo 5 ********************************

  pinMode(10,OUTPUT); // Semaforo 5 Vermelho
  pinMode(11,OUTPUT); // Semaforo 5 Verde
  digitalWrite(10,1);
  digitalWrite(11,0);

//  Semaforo 6 ********************************

  pinMode(12,OUTPUT); // Semaforo 6 Vermelho
  pinMode(13,OUTPUT); // Semaforo 6 Verde
  digitalWrite(12,0);
  digitalWrite(13,1);

//  Semaforo 7 ********************************

  pinMode(22,OUTPUT); // Semaforo 7 Vermelho
  pinMode(23,OUTPUT); // Semaforo 7 Verde
  digitalWrite(22,1);
  digitalWrite(23,0);

//  Semaforo 8 ********************************

  pinMode(24,OUTPUT); // Semaforo 8 Vermelho
  pinMode(25,OUTPUT); // Semaforo 8 Verde
  digitalWrite(24,0);
  digitalWrite(25,1);

//  Semaforo 9 ********************************

  pinMode(26,OUTPUT); // Semaforo 9 Vermelho
  pinMode(27,OUTPUT); // Semaforo 9 Verde
  digitalWrite(26,0);
  digitalWrite(27,1);

//  Semaforo 10 ********************************

  pinMode(28,OUTPUT); // Semaforo 10 Vermelho
  pinMode(29,OUTPUT); // Semaforo 10 Verde
  digitalWrite(28,1);
  digitalWrite(29,0);


timer_ativo = 0;

SEMAFORO1 = 0;
SEMAFORO2 = 0;
SEMAFORO3 = 0;
SEMAFORO4 = 0;
SEMAFORO5 = 0;
SEMAFORO6 = 0;
SEMAFORO7 = 0;
SEMAFORO8 = 0;
SEMAFORO9 = 0;
SEMAFORO10 = 0;

// DEFINE O TEMPO DE CADA SEMAFORO

// TEMPOS DO SEMAFORO 1
tsem1a = 30; // Semaforo do pino 2 e 3
tsem1f = 35; // Semaforo do pino 2 e 3
sem1 = 0;

// TEMPOS DO SEMAFORO 2
tsem2a = 35; // Semaforo do pino 4 e 5
tsem2f = 30; // Semaforo do pino 4 e 5
sem2 = 0;

// TEMPOS DO SEMAFORO 3
tsem3a = 30; // Semaforo do pino 6 e 7
tsem3f = 35; // Semaforo do pino 6 e 7
sem3 = 0;

// TEMPOS DO SEMAFORO 4
tsem4a = 30; // Semaforo do pino 8 e 9
tsem4f = 40; // Semaforo do pino 8 e 9
sem4 = 0;
ligado2 = 0;
// TEMPOS DO SEMAFORO 5
tsem5a = 25; // Semaforo do pino 10 e 11
tsem5f = 50; // Semaforo do pino 10 e 11
sem5 = 0;

// TEMPOS DO SEMAFORO 6
//tsem6a = 15; // Semaforo do pino 12 e 13
//tsem6f = 15; // Semaforo do pino 12 e 13
//sem6 = 0;

// TEMPOS DO SEMAFORO 7
tsem7a = 25; // Semaforo do pino 22 e 23
tsem7f = 50; // Semaforo do pino 22 e 23
sem7 = 0;

// TEMPOS DO SEMAFORO 8
tsem8a = 15; // Semaforo do pino 24 e 25
tsem8f = 15; // Semaforo do pino 24 e 25
sem8 = 0;

// TEMPOS DO SEMAFORO 9
//tsem9a = 15; // Semaforo do pino 26 e 27
//tsem9f = 15; // Semaforo do pino 26 e 27
//sem9 = 0;

// TEMPOS DO SEMAFORO 10
tsem10a = 25; // Semaforo do pino 28 e 29
tsem10f = 60; // Semaforo do pino 28 e 29
sem10 = 0;

}
//******************************************************************************************************************************************************************************************

void loop()  
{

 if (timer_ativo ==1)
 {
  SEMAFORO1++;
  SEMAFORO2++;
  SEMAFORO3++;
  SEMAFORO5++;
  SEMAFORO6++;
  SEMAFORO7++;
  SEMAFORO8++;
  SEMAFORO9++;
  SEMAFORO10++;

  SEMAFORO4++;



// SEMAFORO 1 ********************************************************

  
  if (SEMAFORO1==tsem1a&&sem1==0)
  {
    digitalWrite(2,!digitalRead(2));
    digitalWrite(3,!digitalRead(3));    
    SEMAFORO1 = 0;
    sem1=1;
  }

  if (SEMAFORO1==tsem1f&&sem1==1)
  {
    digitalWrite(2,!digitalRead(2));
    digitalWrite(3,!digitalRead(3));    
    SEMAFORO1 = 0;
    sem1=0;
  }

    
// SEMAFORO 2 ********************************************************

  if (SEMAFORO2==tsem2a&&sem2==1)
  {
    digitalWrite(4,!digitalRead(4));
    digitalWrite(5,!digitalRead(5));    
    SEMAFORO2 = 0;
    sem2=0;//fechado

  }

  if (SEMAFORO2==tsem2f&&sem2==0)
  {
    digitalWrite(4,!digitalRead(4));
    digitalWrite(5,!digitalRead(5));    
    SEMAFORO2 = 0;
    sem2=1;//aberto

  }
  


// SEMAFORO 3 ********************************************************

  if (SEMAFORO3==tsem3a&&sem3==0)
  {
    digitalWrite(6,!digitalRead(6));
    digitalWrite(7,!digitalRead(7));    
    SEMAFORO3 = 0;
    sem3=1;
  }

  if (SEMAFORO3==tsem3f&&sem3==1)
  {
    digitalWrite(6,!digitalRead(6));
    digitalWrite(7,!digitalRead(7));    
    SEMAFORO3 = 0;
    sem3=0;
  }

// SEMAFORO 4 ********************************************************

  if (SEMAFORO4==tsem4a&&sem4==1)
  {
    digitalWrite(8,!digitalRead(8));
    digitalWrite(9,!digitalRead(9));
    digitalWrite(24,!digitalRead(24));
    digitalWrite(25,!digitalRead(25));    
    SEMAFORO4 = 0;
    sem4=0;
  }
  
  if (SEMAFORO4==tsem4f&&sem4==0)
  {
    digitalWrite(8,!digitalRead(8));
    digitalWrite(9,!digitalRead(9));    
    digitalWrite(24,!digitalRead(24));
    digitalWrite(25,!digitalRead(25));
    SEMAFORO4 = 0;
    sem4=1;
  }
// SEMAFORO 5 ********************************************************

  if (SEMAFORO5==tsem5a&&sem5==1)
  {
    digitalWrite(10,!digitalRead(10));
    digitalWrite(11,!digitalRead(11));    
    digitalWrite(12,!digitalRead(12));
    digitalWrite(13,!digitalRead(13));    
 
    SEMAFORO5 = 0;
    sem5=0;
  }

  if (SEMAFORO5==tsem5f&&sem5==0)
  {
    digitalWrite(10,!digitalRead(10));
    digitalWrite(11,!digitalRead(11));    
    digitalWrite(12,!digitalRead(12));
    digitalWrite(13,!digitalRead(13));    
 
    SEMAFORO5 = 0;
    sem5=1;
  }

/*
/ SEMAFORO 6 ********************************************************

  if (SEMAFORO6==tsem6a&&sem6==0)
  {
    digitalWrite(12,!digitalRead(12));
    digitalWrite(13,!digitalRead(13));    
    SEMAFORO6 = 0;
    sem6=1;
  }

  if (SEMAFORO6==tsem6f&&sem6==1)
  {
    digitalWrite(12,!digitalRead(12));
    digitalWrite(13,!digitalRead(13));    
    SEMAFORO6 = 0;
    sem6=0;
  }

*/

// SEMAFORO 7 ********************************************************

  if (SEMAFORO7==tsem7a&&sem7==1)
  {
    digitalWrite(22,!digitalRead(22));
    digitalWrite(23,!digitalRead(23));    
    SEMAFORO7 = 0;
    sem7=0;
  }

  if (SEMAFORO7==tsem7f&&sem7==0)
  {
    digitalWrite(22,!digitalRead(22));
    digitalWrite(23,!digitalRead(23));    
    SEMAFORO7 = 0;
    sem7=1;
  }


/*
/ SEMAFORO 8 ********************************************************

  if (SEMAFORO8==tsem8a&&sem8==0)
  {
    digitalWrite(24,!digitalRead(24));
    digitalWrite(25,!digitalRead(25));    
    SEMAFORO8 = 0;
    sem8=1;
  }

  if (SEMAFORO8==tsem8f&&sem8==1)
  {
    digitalWrite(24,!digitalRead(24));
    digitalWrite(25,!digitalRead(25));    
    SEMAFORO8 = 0;
    sem8=0;
  }


// SEMAFORO 9 ********************************************************

  if (SEMAFORO9==tsem9a&&sem9==0)
  {
    digitalWrite(26,!digitalRead(26));
    digitalWrite(27,!digitalRead(27));    
    SEMAFORO9 = 0;
    sem9=1;
  }

  if (SEMAFORO9==tsem9f&&sem9==1)
  {
    digitalWrite(26,!digitalRead(26));
    digitalWrite(27,!digitalRead(27));    
    SEMAFORO9 = 0;
    sem9=0;
  }

*/
// SEMAFORO 10 ********************************************************

  if (SEMAFORO10==tsem10a&&sem10==1)
  {
    digitalWrite(28,!digitalRead(28));
    digitalWrite(29,!digitalRead(29));    
    digitalWrite(26,!digitalRead(26));
    digitalWrite(27,!digitalRead(27));    
    SEMAFORO10 = 0;
    sem10=0;
  }

  if (SEMAFORO10==tsem10f&&sem10==0)
  {
    digitalWrite(28,!digitalRead(28));
    digitalWrite(29,!digitalRead(29));    
    digitalWrite(26,!digitalRead(26));
    digitalWrite(27,!digitalRead(27));    
    SEMAFORO10 = 0;
    sem10=1;
  }


timer_ativo=0;
}

  
  // usasdo no timer do LED do Wireless
 unsigned long tempo = millis();

 if(tempo - valorTempo > intervalo) 
 {
  valorTempo = tempo;
  timer_ativo =1;
 }

// ********************************************************************************************************************************************************************************




}


