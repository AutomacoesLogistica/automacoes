/*
 *  PROJETO TCC PONTE ROLANTE COM CONTROLE DE VELOCIDADE
 * 
 * 
 * PINOS UTILIZADOS
 * 
 * 
 * >>>>>>     ANALOGICOS      <<<<<<<
 * A0 - MONITORA TRANSLACAO DA PONTE
 * A1 - MONITORA TRANSLACAO DO CARRO
 * A2 - SENSOR DE CORRENTE DO MOTOR 0    A1/B1
 * A3 - SENSOR DE CORRENTE DO MOTOR 1    A2/B2
 * A4 - MONITOR IÇAMENTO
 * 
 * >>>>>>    PINOS DIGITAIS    <<<<<<
 * 2 -  BOTAO DE RESET  > btnReset
 * 3 -  BOTAO DE EMERGENCIA > btnEmergencia
 * 4 -  PINO REFERENTE AO MOTOR 1 A2/B2
 * 5 -  VELOCIDADE DO MOTOR 0 A1/B1
 * 6 -  VELOCIDADE DO MOTOR 1 A2/B2
 * 7 -  PINO REFERENTE AO MOTOR 0 A1/B1
 * 8 -  PINO REFERENTE AO MOTOR 0 A1/B1
 * 9 -  PINO REFERENTE AO MOTOR 1 A2/B2
 * 10 - SAIDA PARA LAMPADA DE DEFEITO/FALHA
 * 11 - SAIDA PARA LAMPADA DE MOVIMENTOS
 * 12 - VELOCIDADE MOTOR 2 IÇAMENTO
 * 13 - NÃO UTILIZADO DEVIDO ESTAR LIGADO INTERNAMENTE DA PLACA AO RESET DO ARDUINO, COM ISSO PODERIA INTERFERIR EM ALGUM COMANDO OU SINALIZAÇÃO DA PONTE AO RESETAR OU LIGAR O ARDUINO
 * 14 - SAIDA PARA LAMPADA DE FIM DE CURSO ATUADO
 * 15 - PINO REFERENTE AO MOTOR 2
 * 16 - PINO REFERENTE AO MOTOR 2
 * 31 - FIM DE CURSO FRENTE TRANSLAÇÃO DA PONTE
 * 33 - FIM DE CURSO TRAZ TRANSLAÇÃO DA PONTE
 * 35 - FIM DE CURSO FRENTE TRANSLAÇÃO D0 CARRO
 * 37 - FIM DE CURSO TRAZ TRANSLAÇÃO D0 CARRO
 *   
 */



// DADOS REFERENTE AO MONSTER MOTOR SHILED - TRANSLAÇÃO DA PONTE E DO CARRO *********************************************************
#define BRAKEVCC 0
#define CW 1 // 1 sentido horario
#define CCW 2 // 2 sentido anti-horario
#define BRAKEGND 3
#define CS_THRESHOLD 15   // Definição da corrente de segurança
int inApin[2] = {7, 4}; // pino 7 para motor A1   -    pino 4 para motor A2
int inBpin[2] = {8, 9}; // pino 8 para motor B1   -    pino 9 para motor B2
int pwmpin[2] = {5, 6}; // Saida PWM 5 Velocidade motor A1/B1  -  Saida PWM 6 Velocidade motor A2/B2  
int cspin[2] = {2, 3};  // Entrada do Sensor de Corrente pino A2 ( Motor A1/B1 ) e pino A3 ( Motor A2/B2 )
int statpin = 13;
int i=0;

// **********************************************************************************************************************************

// PINOS REFERENTE AO MOTOR DO IÇAMENTO
#define ELEVAR 15
#define ABAIXAR 16

// **********************************************************************************************************************************

// PINO REFERENTE AO BOTAO DE RESET
#define btnReset 2

// **********************************************************************************************************************************

// PINO REFERENTE AO BOTAO DE EMERGENCIA
#define btnEmergencia 3

// **********************************************************************************************************************************

// PINOS REFERENTE AOS FIM DE CURSOS
#define fcF_TranslacaoPonte 31 // Fim de curso de translação da ponte para frente
#define fcT_TranslacaoPonte 33 // Fim de curso de translação da ponte para traz
#define fcF_TranslacaoCarro 35 // Fim de curso de translação do carro para frente
#define fcT_TranslacaoCarro 37 // Fim de curso de translação do carro para traz

// **********************************************************************************************************************************

// PINOS REFERENTE AS LÂMPADAS DE SINALIZAÇÃO
#define Defeito 10 //  Lampada acende quando se aperta a botoeira de emergência simulando uma falha / defeito
#define Acionamento 11 // Lampada acende quando qualquer manete da ponte seja acionada sinalizando algum movimento executado na ponte
#define AtuadoFcurso 14 // Lampada acende quando qualquer um dos fim de cursos forem atuados

// **********************************************************************************************************************************

// DEFINIÇÃO DOS TEMPOS DE RAMPA ( tempo definido em milisegundos )
#define tRampa_TranslacaoPonte 30 // Define o tempo de rampa de translação da ponte tanto para frente quanto para traz
#define tRampa_TranslacaoCarro 130 // Define o tempo de rampa de translação do carro tanto para frente quanto para traz
#define tRampa_Icamento 20 // Define o tempo de rampa de içamento da ponte tanto para elevar quanto para abaixar

// **********************************************************************************************************************************


// VARIAVEIS PARA MANTER A VELOCIDADE MAXIMA
int aa = 0; //referente ao motor 0 para frente
int bb = 0; //referente ao motor 0 para traz
int cc = 0; //referente ao motor 1 para frente
int dd = 0; //referente ao motor 1 para traz
int ee = 0; //referente ao motor 2 para elevar
int ff = 0; //referente ao motor 2 para abaixar

// ********************************************************************************************************************


// VARIAVEIS  PARA CRIACAO DE PINOS INTERNOS ATRAVEZ DA LEITURA DAS ANALOGICAS
int TP_Frente; // leitura da analogica A0 maior que 1000
int TP_Traz; // leitura da analogica A0 menor que 300
int TC_Frente; // leitura da analogica A1 maior que 1000
int TC_Traz; // leitura da analogica A1 menor que 300
int Sobe; // leitura da analogica A4 maior que 1000
int Desce; // leitura da analogica A4 menor que 300


// ********************************************************************************************************************

// VARIAVEL RESPONSAVEL PARA TRAVAR A LOGICA CASO SEJA APERTADO O BOTAO DE EMERGENCIA
int falha;

// ********************************************************************************************************************

void setup()
{
// Entradas
pinMode(btnEmergencia,INPUT);
digitalWrite(btnEmergencia,1);
pinMode(btnReset,INPUT);
digitalWrite(btnReset,1);

// Mapeia os fim de cursos
pinMode(fcF_TranslacaoPonte,INPUT);
digitalWrite(fcF_TranslacaoPonte,LOW);
pinMode(fcT_TranslacaoPonte,INPUT);
digitalWrite(fcT_TranslacaoPonte,LOW);
pinMode(fcF_TranslacaoCarro,INPUT);
digitalWrite(fcF_TranslacaoCarro,LOW);
pinMode(fcT_TranslacaoCarro,INPUT);
digitalWrite(fcT_TranslacaoCarro,LOW);

// Saidas
pinMode(Defeito,OUTPUT);// Pino 8
digitalWrite(Defeito,0);
pinMode(Acionamento,OUTPUT);//Pino 9
digitalWrite(Acionamento,0);
pinMode(AtuadoFcurso,OUTPUT);//Pino 10
digitalWrite(AtuadoFcurso,0);

// REFETENTE AO MONSTER MOTOR SHILED *******************************************************************************************************************

    // Faz a configuração dos pinos como saida
    for (int i=0; i<2; i++)
    {
    pinMode(inApin[i], OUTPUT);
    pinMode(inBpin[i], OUTPUT);
    pinMode(pwmpin[i], OUTPUT);
    }
    
    // Faz os pinos começarem todos em 0, ou seja, parados
    for (int i=0; i<2; i++)
    {
    digitalWrite(inApin[i], LOW);
    digitalWrite(inBpin[i], LOW);
    }

// ******************************************************************************************************************************************************

// REFERENTE AO MOTOR DE IÇAMENTO
pinMode(ELEVAR, OUTPUT);
pinMode(ABAIXAR, OUTPUT);
digitalWrite(ELEVAR,LOW);
digitalWrite(ABAIXAR,LOW);

// ******************************************************************************************************************************************************

falha = 0;
TP_Frente = 0;
TP_Traz = 0;
TC_Frente = 0;
TC_Traz = 0;
Sobe = 0;
Desce = 0;

} // FECHA O SETUP

void loop() 
{

//   Atua Emergência  
if (digitalRead(btnEmergencia)==0)
{
  falha = 1;
}

// MAPEANDO AS ANALÓGICAS ****************************************************************************************************************************************************

// ENTRADA A0 - COMANDO TRANSLAÇÃO DA PONTE
if(analogRead(A0)>=300 && analogRead(A0)<=1000) // Limpa comandos
{
 TP_Frente = 0;
 TP_Traz = 0;
}

if(analogRead(A0)>1000 && TP_Traz == 0 && TC_Frente == 0 && TC_Traz == 0 && Sobe == 0 && Desce == 0) // ativa translação da ponte para frente
{
  TP_Frente = 1;
  TP_Traz = 0;
  TC_Frente = 0;
  TC_Traz = 0;
  Sobe = 0;
  Desce = 0;
}
if(analogRead(A0)<300 && TP_Frente == 0 && TC_Frente == 0 && TC_Traz == 0 && Sobe == 0 && Desce == 0) // ativa translação da ponte para traz
{
  TP_Frente = 0;
  TP_Traz = 1;
  TC_Frente = 0;
  TC_Traz = 0;
  Sobe = 0;
  Desce = 0;  
}
// ENTRADA A1 - COMANDO TRANSLAÇÃO DO CARRO
if(analogRead(A1)>=300 && analogRead(A1)<=1000) // Limpa comandos
{
 TC_Frente = 0;
 TC_Traz = 0;
}
if(analogRead(A1)>1000&& TP_Frente == 0 && TP_Traz == 0 && TC_Traz == 0 && Sobe == 0 && Desce == 0) // ativa translação do carro para frente
{
  TP_Frente = 0;
  TP_Traz = 0;
  TC_Frente = 1;
  TC_Traz = 0;
  Sobe = 0;
  Desce = 0;
}
if(analogRead(A1)<300&& TP_Frente == 0 && TP_Traz == 0 && TC_Frente == 0 && Sobe == 0 && Desce == 0) // ativa translação do carro para traz
{
  TP_Frente = 0;
  TP_Traz = 0;
  TC_Frente = 0;
  TC_Traz = 1;
  Sobe = 0;
  Desce = 0;  
}

// ENTRADA A4 - COMANDO IÇAMENTO
if(analogRead(A4)>=300 && analogRead(A2)<=1000) // Limpa comandos
{
 Sobe = 0;
 Desce = 0;
}

if(analogRead(A4)>1000 && TP_Frente == 0 && TP_Traz == 0 && TC_Frente == 0 && TC_Traz == 0 && Desce == 0) // ativa subida do moitão
{
  TP_Frente = 0;
  TP_Traz = 0;
  TC_Frente = 0;
  TC_Traz = 0;
  Sobe = 1;
  Desce = 0;
}
if(analogRead(A4)<300 && TP_Frente == 0 && TP_Traz == 0 && TC_Frente == 0 && TC_Traz == 0 && Sobe == 0) // ativa descida do moitão
{
  TP_Frente = 0;
  TP_Traz = 0;
  TC_Frente = 0;
  TC_Traz = 0;
  Sobe = 0;
  Desce = 1;  
}

// **************************************************************************************************************************************************************************************

// SE POSSUIR FALHAS    SE POSSUIR FALHAS    SE POSSUIR FALHAS    SE POSSUIR FALHAS    SE POSSUIR FALHAS    
// SE POSSUIR FALHAS    SE POSSUIR FALHAS    SE POSSUIR FALHAS    SE POSSUIR FALHAS    SE POSSUIR FALHAS    
// SE POSSUIR FALHAS    SE POSSUIR FALHAS    SE POSSUIR FALHAS    SE POSSUIR FALHAS    SE POSSUIR FALHAS    
// SE POSSUIR FALHAS    SE POSSUIR FALHAS    SE POSSUIR FALHAS    SE POSSUIR FALHAS    SE POSSUIR FALHAS    

if(falha==1)
{
  digitalWrite(Defeito,1); // Se possuir falhas, e a mesma não for resetada, a lâmpada de falhas permanecerá acesa.
  // Desliga toda a ponte
  digitalWrite(Acionamento,0);
  TP_Frente = 0;
  TP_Traz = 0;
  TC_Frente = 0;
  TC_Traz = 0;
  Sobe = 0;
  Desce = 0;
  
 // comando de reset da falha 
  // so reseta a falha se a botoeira de emergência não estiver atuada e nenhum comando da ponte acionado
 if(digitalRead(btnReset)==0 && digitalRead(btnEmergencia)==1 &&((analogRead(A0)>=300 && analogRead(A0)<=1000))&&((analogRead(A1)>=300 && analogRead(A1)<=1000))&&((analogRead(A4)>=300 && analogRead(A4)<=1000))&& (digitalRead(Acionamento)==0))
 {
  falha = 0; // limpa a falha
  digitalWrite(Defeito,0); // limpa a falha
  delay(1000); // espera 1 segundo para evitar falhas
 }
}


// SE NÃO POSSUIR FALHAS     SE NÃO POSSUIR FALHAS     SE NÃO POSSUIR FALHAS      SE NÃO POSSUIR FALHAS
// SE NÃO POSSUIR FALHAS     SE NÃO POSSUIR FALHAS     SE NÃO POSSUIR FALHAS      SE NÃO POSSUIR FALHAS
// SE NÃO POSSUIR FALHAS     SE NÃO POSSUIR FALHAS     SE NÃO POSSUIR FALHAS      SE NÃO POSSUIR FALHAS
// SE NÃO POSSUIR FALHAS     SE NÃO POSSUIR FALHAS     SE NÃO POSSUIR FALHAS      SE NÃO POSSUIR FALHAS


if (falha == 0) // Sem falhas
{
digitalWrite(Defeito,0); // se nao tem falhas, mantem apagado a lâmpada de falhas



// ATUALIZA A SINALIZAÇÃO DE MOVIMENTO
if ( TP_Frente == 1 || TP_Traz == 1 || TC_Frente == 1 || TC_Traz == 1 || Sobe == 1 || Desce == 1)
{
digitalWrite(Acionamento,1); // acende a lâmpada de movimentos    
}
if ( TP_Frente == 0 && TP_Traz == 0 && TC_Frente == 0 && TC_Traz == 0 && Sobe == 0 && Desce == 0)// Se não teve movimentos
{
 digitalWrite(Acionamento,0); // apaga a lâmpada de movimentos   
}

// ************************************************************************************************************************************************************************

// MAPEIA FIM DE CURSOS
if ( digitalRead(fcF_TranslacaoPonte)==1 || digitalRead(fcT_TranslacaoPonte)==1 || digitalRead(fcF_TranslacaoCarro)==1 || digitalRead(fcT_TranslacaoCarro)==1) //Se possuir algum fim de curso atuado, acende a lâmpada fim de curso atuado
{
digitalWrite(AtuadoFcurso,1); // acende a lâmpada de fim de curso atuado    
}
if ( digitalRead(fcF_TranslacaoPonte)==0 && digitalRead(fcT_TranslacaoPonte)==0 && digitalRead(fcF_TranslacaoCarro)==0 && digitalRead(fcT_TranslacaoCarro)==0) // Se não possuir fim de curso algum atuado, apaga a lâmpada fim de curso atuado
{
 digitalWrite(AtuadoFcurso,0); // apaga a lâmpada de fim de curso atuado 
}


// ATUA OS COMANDOS RESPECTIVOS    ATUA OS COMANDOS RESPECTIVOS   ATUA OS COMANDOS RESPECTIVOS   ATUA OS COMANDOS RESPECTIVOS
// ATUA OS COMANDOS RESPECTIVOS    ATUA OS COMANDOS RESPECTIVOS   ATUA OS COMANDOS RESPECTIVOS   ATUA OS COMANDOS RESPECTIVOS
// ATUA OS COMANDOS RESPECTIVOS    ATUA OS COMANDOS RESPECTIVOS   ATUA OS COMANDOS RESPECTIVOS   ATUA OS COMANDOS RESPECTIVOS
// ATUA OS COMANDOS RESPECTIVOS    ATUA OS COMANDOS RESPECTIVOS   ATUA OS COMANDOS RESPECTIVOS   ATUA OS COMANDOS RESPECTIVOS

   if (TP_Frente == 1 && digitalRead(fcF_TranslacaoPonte)==0 )
   {
    // MOTOR 0 E EM CW 
    for(int e = 0;e<255;e++)
    {     
       if ( digitalRead(fcF_TranslacaoPonte)==0 && (analogRead(A0)>1000)&&(digitalRead(btnEmergencia)==1) )
       {
             
             if ( (digitalRead(fcF_TranslacaoPonte)==0) && (digitalRead(fcT_TranslacaoPonte)==0) && (digitalRead(fcF_TranslacaoCarro)==0) && (digitalRead(fcT_TranslacaoCarro)==0) )
             {
              digitalWrite(AtuadoFcurso,0);
             }
             if ( aa == 0 )
             {
              motorGo(0, CW, e);// Aumento do o PWM do motor até 255 
             delay(tRampa_TranslacaoPonte);//Tempo de Rampa
             if ( e == 254){aa = 1;}
             e++; 
             }      
       }
       else
       {
        // Desliga o motor
        for (int a=0; a<2; a++)
        {
         digitalWrite(inApin[a], LOW);
         digitalWrite(inBpin[a], LOW);
         // Desliga a saida PWM do respectivo motor
         analogWrite(5, 0);
         aa = 0;
        }
       } // fecha else
    } // fecha for
   } // fecha COMANDO
    
// *************************************************************** 
  
  if ( TP_Traz == 1 && digitalRead(fcT_TranslacaoPonte)==0 )
  {
 // MOTOR 0 E EM CCW 
    for(int f = 0;f<255;f++)
    {     
       if ( digitalRead(fcT_TranslacaoPonte)==0 && (analogRead(A0)<300)&&(digitalRead(btnEmergencia)==1))
       {
              if ( (digitalRead(fcF_TranslacaoPonte)==0) && (digitalRead(fcT_TranslacaoPonte)==0) && (digitalRead(fcF_TranslacaoCarro)==0) && (digitalRead(fcT_TranslacaoCarro)==0) )
              {
               digitalWrite(AtuadoFcurso,0);
              }
              if ( bb == 0 )
              {
              motorGo(0, CCW, f);// Aumento do o PWM do motor até 255 
              delay(tRampa_TranslacaoPonte);//Tempo de Rampa
              if ( f == 254){bb = 1;}
              f++; 
              }
       }
       else
       {
        // Desliga o motor
        for (int b=0; b<2; b++)
        {
         digitalWrite(inApin[b], LOW);
         digitalWrite(inBpin[b], LOW);
         // Desliga a saida PWM do respectivo motor
         analogWrite(5, 0);
         bb = 0;
        }
       } // fecha else
    } // fecha for
  } // fecha COMANDO
  
// ***************************************************************  
  
  if ( TC_Frente == 1&& digitalRead(fcF_TranslacaoCarro)==0 )
  {    
  // MOTOR 1 E EM CW 
    for(int g = 50;g<180;g++)
    {     
       if ( digitalRead(fcF_TranslacaoCarro)==0 && (analogRead(A1)>1000)&&(digitalRead(btnEmergencia)==1))
       {
              if ( (digitalRead(fcF_TranslacaoPonte)==0) && (digitalRead(fcT_TranslacaoPonte)==0) && (digitalRead(fcF_TranslacaoCarro)==0) && (digitalRead(fcT_TranslacaoCarro)==0) )
              {
               digitalWrite(AtuadoFcurso,0);
              }
              if ( cc == 0 )
              {
              motorGo(1, CW, g);// Aumento do o PWM do motor até 255 
              delay(tRampa_TranslacaoCarro);//Tempo de Rampa
              if ( g == 180){cc = 1;}
              g++;   
              }   
       }
       else
       {
        // Desliga o motor
        for (int c=0; c<2; c++)
        {
         digitalWrite(inApin[c], LOW);
         digitalWrite(inBpin[c], LOW);
         // Desliga a saida PWM do respectivo motor
         analogWrite(6, 0);
         cc = 0;
        }
      } // fecha else
    } // fecha for
  } // fecha COMANDO

// ***************************************************************  
  
  if ( TC_Traz == 1 && digitalRead(fcT_TranslacaoCarro)==0 )
  {
 // MOTOR 1 E EM CCW 
    for(int h = 50;h<180;h++)
    {     
       if ( digitalRead(fcT_TranslacaoCarro)==0 && (analogRead(A1)<300)&&(digitalRead(btnEmergencia)==1))
       {
              if ( (digitalRead(fcF_TranslacaoPonte)==0) && (digitalRead(fcT_TranslacaoPonte)==0) && (digitalRead(fcF_TranslacaoCarro)==0) && (digitalRead(fcT_TranslacaoCarro)==0) )
              {
              digitalWrite(AtuadoFcurso,0);
              }
              if ( dd == 0 )
              {
              motorGo(1, CCW, h);// Aumento do o PWM do motor até 255 
              delay(tRampa_TranslacaoCarro);//Tempo de Rampa
              if ( h == 180){dd = 1;}
              h++;
              }      
       }
       else
       {
        // Desliga o motor
        for (int d=0; d<2; d++)
        {
         digitalWrite(inApin[d], LOW);
         digitalWrite(inBpin[d], LOW);
         // Desliga a saida PWM do respectivo motor
         analogWrite(6, 0);
        dd = 0;
        }
      } // fecha else
    } // fecha for
  } // fecha COMANDO
  
// ***************************************************************  
  
  if ( Sobe == 1&&(analogRead(A4)>1000))
  {
  // MOTOR 2 ELEVAR 
  digitalWrite(ELEVAR,HIGH);
  digitalWrite(ABAIXAR,LOW);
  
    for(int i= 180;i<255;i++)
    {     
       if ((analogRead(A4)>1000)&&(digitalRead(btnEmergencia)==1))
       {
             if ( ee == 0 )
             {
             analogWrite(12,i);// Aumento do o PWM do motor até 255 
             analogWrite(12,i);
             delay(tRampa_Icamento);//Tempo de Rampa
             if ( i == 254 ){ee = 1; }
             i++;   
             }
       }
       else
       {
        // Desliga o motor
        digitalWrite(ELEVAR,LOW);
        digitalWrite(ABAIXAR,LOW);
        analogWrite(12,0);
        ee = 0;
   
       } // fecha else
       
     } // fecha for
  } // fecha COMANDO
  
// ***************************************************************  
  
  if ( Desce == 1 )
  {
  
 // MOTOR 2 ABAIXAR 
  digitalWrite(ABAIXAR,HIGH);
  digitalWrite(ELEVAR,LOW);
  
    for(int j= 120;j<255;j++)
    {     
       if ((analogRead(A4)<300)&&(digitalRead(btnEmergencia)==1))
       {
             if ( ff == 0 )
             {
             analogWrite(12,j);// Aumento do o PWM do motor até 255 
             delay(tRampa_Icamento);//Tempo de Rampa
             if ( j == 254 ){ff = 1; }
             j++;
             }
       }
       else
       {
        // Desliga o motor
        digitalWrite(ELEVAR,LOW);
        digitalWrite(ABAIXAR,LOW);
        analogWrite(12,0);
        j = 256;
        ff = 0;
       } // fecha else
     } // fecha for
  } // fecha COMANDO
// ***************************************************************
} // Fecha o else se não possui falhas
} // Fecha loop




// Controle do motor  Controle do motor  Controle do motor  Controle do motor  Controle do motor  Controle do motor  Controle do motor  Controle do motor  Controle do motor 
// Controle do motor  Controle do motor  Controle do motor  Controle do motor  Controle do motor  Controle do motor  Controle do motor  Controle do motor  Controle do motor 
// Controle do motor  Controle do motor  Controle do motor  Controle do motor  Controle do motor  Controle do motor  Controle do motor  Controle do motor  Controle do motor 
// Controle do motor  Controle do motor  Controle do motor  Controle do motor  Controle do motor  Controle do motor  Controle do motor  Controle do motor  Controle do motor 
// Controle do motor  Controle do motor  Controle do motor  Controle do motor  Controle do motor  Controle do motor  Controle do motor  Controle do motor  Controle do motor 

void motorGo(uint8_t motor, uint8_t direct, uint8_t pwm)         //Função que controla as variáveis: motor(0 ou 1), sentido (cw ou ccw) e pwm (entra 0 e 255);
{
if (motor <= 1)
    {
    if (direct <=4)
        {
        if (direct <=1)
            digitalWrite(inApin[motor], HIGH);
        else
            digitalWrite(inApin[motor], LOW);
       
        
        if ((direct==0)||(direct==2))
            digitalWrite(inBpin[motor], HIGH);
        else
            digitalWrite(inBpin[motor], LOW);
        analogWrite(pwmpin[motor], pwm);
        }
    }
}




