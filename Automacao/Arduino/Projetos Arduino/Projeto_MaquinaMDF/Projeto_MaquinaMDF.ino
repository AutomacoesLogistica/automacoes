/*
 * 
 * 
 * PROJETO MAQUINA MDF 
 * 
 * ENTRADAS
 * Manual / Automatico     0 = Automatico   1 = Manual
 * Liga
 * Desliga
 * PrensaM
 * ElevaM
 * GiraM
 * FrenteM
 * TrasM
 * 
 * SAIDAS
 * Prensa
 * Eleva
 * Gira
 * Frente
 * Tras
 * 
 * 
 */

int PrensaM;
int ElevaM;

void setup() 
{  
// ENTRADAS
pinMode(2,INPUT); // Botao Automatico/Manual
pinMode(3,INPUT); // Botao Liga
pinMode(4,INPUT); // Botao Para
pinMode(5,INPUT); // Botao PrensaM
pinMode(6,INPUT); // Botao ElevaM
pinMode(7,INPUT); // Botao GiraM
pinMode(8,INPUT); // Botao FrenteM
pinMode(9,INPUT); // Botao TrasM
pinMode(10,INPUT); // Sensor Frente
pinMode(11,INPUT); // Sensor Tras

// SAIDAS
pinMode(A0,OUTPUT); // Saida Prensa
digitalWrite(A0,1);
pinMode(A1,OUTPUT); // Saida Eleva
digitalWrite(A1,1);
pinMode(A2,OUTPUT); // Saida Giro
digitalWrite(A2,1);
pinMode(A3,OUTPUT); // Saida Frente
digitalWrite(A3,1);
pinMode(A4,OUTPUT); // Saida Tras
digitalWrite(A4,1);
pinMode(A5,OUTPUT); // Saida Alivio Prensa
digitalWrite(A5,1);
pinMode(12,OUTPUT); // Saida AUTOMATICO
digitalWrite(12,0);
pinMode(13,OUTPUT); // Saida Alivio Eleva
digitalWrite(13,1);

PrensaM = 0;
ElevaM = 0;
}

void loop() 
{ // Abre o loop

  
// MODO AUTOMATICO    MODO AUTOMATICO    MODO AUTOMATICO    MODO AUTOMATICO    MODO AUTOMATICO    MODO AUTOMATICO    MODO AUTOMATICO    MODO AUTOMATICO    MODO AUTOMATICO  
// MODO AUTOMATICO    MODO AUTOMATICO    MODO AUTOMATICO    MODO AUTOMATICO    MODO AUTOMATICO    MODO AUTOMATICO    MODO AUTOMATICO    MODO AUTOMATICO    MODO AUTOMATICO  
// MODO AUTOMATICO    MODO AUTOMATICO    MODO AUTOMATICO    MODO AUTOMATICO    MODO AUTOMATICO    MODO AUTOMATICO    MODO AUTOMATICO    MODO AUTOMATICO    MODO AUTOMATICO  
// MODO AUTOMATICO    MODO AUTOMATICO    MODO AUTOMATICO    MODO AUTOMATICO    MODO AUTOMATICO    MODO AUTOMATICO    MODO AUTOMATICO    MODO AUTOMATICO    MODO AUTOMATICO  

if ( digitalRead(2)==0)
{
  digitalWrite(12,1); // Liga luz modo MANUAL
  
   // Iniciando corte
   if ( digitalRead(3)==1 && digitalRead(11)== 1 && digitalRead(A0)==1 ) // Se apertado o botao iniciar, nao apertadoo botao parar e o sensor fim de curso tras estiver atuado FCT
   {
    digitalWrite(A0,0); // Prensa
    delay(1000);
    digitalWrite(A1,0); // Eleva
    delay(1000);
    digitalWrite(A2,0); // Gira
    delay(1000);
    digitalWrite(A3,0); // Frente
    digitalWrite(A4,1); // Tras
   }

   // Apertado o botao parar ou sensor FCF atuado
   if ( (digitalRead(4)==1 || digitalRead(10)==1)&& digitalRead(A3)==0 && digitalRead(A4)==1 ) // Se apertado o botao parar ou atuado o fim de curso frente FCF
   {
    digitalWrite(A3,1); // Frente
    digitalWrite(A2,1); // Giro
    digitalWrite(A1,1); // Eleva
    digitalWrite(13,0); // Liga Alivio
    delay(1000); // Espera 1 segundo
    digitalWrite(13,1); // Liga Alivio
    digitalWrite(A4,0); // Tras
    delay(2000); // Espera 2 segundo
   }
   
   // Voltando
   if ( digitalRead(11)==0 && digitalRead(13)==1 && digitalRead(A4)==0 && digitalRead(A3)==1 ) // Se apertado o botao parar ou atuado o fim de curso frente FCF
   {
    digitalWrite(A3,1); // Frente
    digitalWrite(A2,1); // Giro
    digitalWrite(A1,1); // Eleva
    digitalWrite(A4,0); // Tras
   }
   
   // Finaliza o corte
   if ( digitalRead(11)==1 && digitalRead(10)==0 && digitalRead(A4)==0 && digitalRead(A3)==1) // Se o sensor FCT estiver atuado e a maquina estiver voltando do corte ( Tras == 1 )
   {
    digitalWrite(A4,1); // Tras
    digitalWrite(A3,1); // Frente
    digitalWrite(A1,1); // Eleva
    digitalWrite(A2,1); // Giro
    digitalWrite(A0,1); // Prensa
    digitalWrite(A5,0); // Ativa o alivio da Prensa
    delay(1000);
    digitalWrite(A5,1); // Desativa o alivio da Prensa
   }
   
   // Forca ficar parado
   if ( digitalRead(11)==1 && digitalRead(10)==0 && digitalRead(3)==0 && digitalRead(4)==0  &&  digitalRead(A3)==1 &&  digitalRead(A4)==1 ) // Se o sensor FCT estiver atuado e a maquina estiver voltando do corte ( Tras == 1 )
   {
    digitalWrite(A4,1); // Tras
    digitalWrite(A3,1); // Frente
    digitalWrite(A1,1); // Eleva
    digitalWrite(A2,1); // Giro
    digitalWrite(A0,1); // Prensa
    digitalWrite(A5,1); // Ativa o alivio da Prensa
    digitalWrite(13,1); // Ativa o alivio da Elevacao
   }

    
} // Fecha modo Automatico

// ***************************************************************************************


// MODO MANUAL    MODO MANUAL    MODO MANUAL    MODO MANUAL    MODO MANUAL    MODO MANUAL    MODO MANUAL    MODO MANUAL    MODO MANUAL    MODO MANUAL   
// MODO MANUAL    MODO MANUAL    MODO MANUAL    MODO MANUAL    MODO MANUAL    MODO MANUAL    MODO MANUAL    MODO MANUAL    MODO MANUAL    MODO MANUAL   
// MODO MANUAL    MODO MANUAL    MODO MANUAL    MODO MANUAL    MODO MANUAL    MODO MANUAL    MODO MANUAL    MODO MANUAL    MODO MANUAL    MODO MANUAL   
// MODO MANUAL    MODO MANUAL    MODO MANUAL    MODO MANUAL    MODO MANUAL    MODO MANUAL    MODO MANUAL    MODO MANUAL    MODO MANUAL    MODO MANUAL   

if ( digitalRead(2)==1) // Modo manual
{
 digitalWrite(12,0); // Apaga luz modo MANUAL
 
  // Liga a prensa
  if ( digitalRead(5)==1 && PrensaM == 0)
  {
   PrensaM = 1;  
   digitalWrite(A0,0);
  }
  // Desliga a prensa
  if ( digitalRead(5)==0 && PrensaM == 1)
  {
   PrensaM = 0;
   digitalWrite(A0,1);
   digitalWrite(A5,0); // Liga Alivio
   delay(1000); // Espera 1 segundo
   digitalWrite(A5,1); // Desliga Alivio
  }
  // Eleva Disco
  if ( digitalRead(6)==1 && ElevaM == 0)
  {
   ElevaM = 1;
   digitalWrite(A1,0);
  }
  // Abaixa Disco
  if ( digitalRead(6)==0 && ElevaM == 1)
  {
   ElevaM = 0; 
   digitalWrite(A1,1);
   digitalWrite(13,0); // Liga Alivio
   delay(1000); // Espera 1 segundo
   digitalWrite(13,1); // Desliga Alivio
  }
  // Gira Serras
  if ( digitalRead(7)==1)
  {
  digitalWrite(A2,0);
  }
  // Para Serras
  if ( digitalRead(7)==0)
  {
  digitalWrite(A2,1);
  }
  
  
  // Translacao Frente
  if ( digitalRead(8)==1 && digitalRead(10)==0) // apertar e nao atuar o sensor
  {
  digitalWrite(A3,0);
  }
  // Para Translacao Frente
  if ( digitalRead(8)==0 || digitalRead(10)== 1 ) // Se soltar o botao ou atuar o sensor
  {
  digitalWrite(A3,1);
  }
  
  
  // Translacao Tras
  if ( digitalRead(9)==1 && digitalRead(11)==0) // apertar e nao atuar o sensor
  {
  digitalWrite(A4,0);
  }
  // Para Translacao Tras
  if ( digitalRead(9)==0 || digitalRead(11)==1) // Se soltar o botao ou atuar o sensor
  {
  digitalWrite(A4,1);
  }


  
} // Fecha Modo Manual
} // Fecha loop
