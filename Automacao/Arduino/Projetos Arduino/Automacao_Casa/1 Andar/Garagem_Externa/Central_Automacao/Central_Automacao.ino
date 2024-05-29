/*
   
   CENTRAL PLACA DE AUTOMACAO oficina EXTERNA - 1 ANDAR

   Conexão do modulo RS485    Recebe as mensagens dos interruptores e envia tambem para a central com mqtt atualizar supervisorio
   RO = Pino 3
   DI = Pino 4
   DE = Pino 2 Pino para ativar transmissao
   RE = Pino 2 Pino para ativar transmissao

   Data = Pino 5         Usado no modulo relé serial
   Clock = Pino 6        Usado no modulo relé serial
   LedStatus = Pino 13  Usado para toda recepcao de mensagem piscar o led d status
   
   DEFINICAO DOS RELES
   teto = 0;       // Rele1_1
   pendente = 0;   // Rele2_1
   quadros  = 0;   // Rele3_1
   muroch = 0;     // Rele4_1
   carro1 = 0;     // Rele5_1
   carro2 = 0;     // Rele6_1
   carro3 = 0;     // Rele7_1
   muroca = 0;     // Rele8_1
   jardimh = 0;    // Rele1_2
   jardimv = 0;    // Rele2_2
   oficina = 0;       // Rele3_2
   frente = 0;     // Rele4_2

   RTC I2C
   SDA = A4
   SCL = A5
   
*/

#include <SerialRelayBruno.h>
const int NumeroModulos = 2;    // Maximo de 10 ( 80 reles )
SerialRelayBruno reles(5,6,NumeroModulos); // (data, clock, Numero de Modulos)


// Criando dados para o relogio RTC I2C
#include <Wire.h>        //Biblioteca para manipulação do protocolo I2C
int dia;
int mes;
int ano; 
int hora;
int minuto;
int segundo;


// Dados para o millis()
long UltimoMillis = 0;        // Variável de cDesligarReletrole do tempo
long intervalo = 20000;     // Tempo em ms do intervalo a ser executado
unsigned long AtualMillis;
int intertrava_dia = 1; // Inicia em 1, caso envia mensagem pelo MQTT para liberar as luzes acender de dia , renova todo dia.


#include<SoftwareSerial.h>
#define transmitir 2 // Pino DE e RE - Transmissao
#define pinRX 3 // Pino RO
#define pinTX 4 // Pino DI
SoftwareSerial RS485(pinRX, pinTX);

#define LedStatus 13 // Pino para quando receber mensagem piscar definido na porta 7
String readString; // Variavel pra cDesligarRelecatenar dados da serial
char MensagemRecebida[15]; // Usado para receber e concaternar as mensagens
char* MensagemParaImprimir;
int intertrava = 0; // Serve para bloqueio e aciDesligarRelear apenas uma unica vez
int n_de_lampada = 0;

// Variaveis da automacao
int teto = 0; // Rele1_1
int pendente = 0; // Rele2_1
int quadros  = 0; // Rele3_1
int muroch = 0; // Rele4_1
int carro1 = 0; // Rele5_1
int carro2 = 0; // Rele6_1
int carro3 = 0; // Rele7_1
int muroca = 0; // Rele8_1
int jardimh = 0; // Rele1_2
int jardimv = 0; // Rele2_2
int oficina = 0; // Rele3_2
int frente = 0; // Rele4_2


void setup() 
{
 RS485.begin(9600);      //Inicialização da rede RS485
 Serial.begin(9600);     //Inicialização da Serial
 pinMode(transmitir, OUTPUT);
 digitalWrite(transmitir, LOW);
 pinMode(LedStatus, OUTPUT); // Define LedMensagem como saida
 digitalWrite(LedStatus, HIGH); // Inicia ligado 

 // Desligando todos os reles
 for(int i=1 ; i <= NumeroModulos ; i++)
 {
  for(int j=1 ; j <= 8 ; j++)
  {
   reles.SetRelay(j, LigarRele, i);
  }
 }

}

void loop() 
{
 while (RS485.available())
 {
  delay(3);
  char c = RS485.read();
  readString += c;
 }

 while (Serial.available())
 {
  delay(3);
  char c = Serial.read();
  readString += c;
 }


  // Se receber mensagem 
 if (readString.length() > 0 && readString.length() < 13)
 {
  digitalWrite(LedStatus, 0);
  delay(150);
  digitalWrite(LedStatus, 1);
  delay(150);
  if ( readString == "modo_dia" || readString == "modo_noite")
  {
    if ( readString == "modo_dia")
    {
    intertrava_dia = 0;// Habilita acionamento das luzes para o dia ou seja, habilita acionamentos para os horarios de 6 a 17 horas.
    readString = "";
    }
    if ( readString == "modo_noite")
    {
    intertrava_dia = 1;// Desabilita acionamento das luzes para o dia e fica somente para a noite de 18 as 5 da manha
    readString = "";
    }

    
  }
  else
  {
   imprimir(); // Chama o void para verificar o que deve ser feito
   
  } 
 }
 

 // Millis para atualizar a hora a cada 60 segundos
 AtualMillis = millis();    //Tempo atual em ms
 if (AtualMillis - UltimoMillis > intervalo) 
 { 
  UltimoMillis = AtualMillis;    // Salva o tempo atual
  //atualizar_hora();
 }

} // Fecha Loop





void imprimir() 
{
  Serial.println(readString);
  
  // Alterando rele do teto da oficina de churrasco  ***************************************************************************************************************************************
  if ( readString.indexOf("teto_1") >= 0)
  {
   teto = 1; 
   reles.SetRelay(1, DesligarRele, 1); // num rele, modo, num modulo
  }
  if ( readString.indexOf("teto_0") >= 0 )
  {
   teto = 0; 
   reles.SetRelay(1, LigarRele, 1); // num rele, modo, num modulo
  }
  
  if ( readString.indexOf("teto_churra") >= 0)
  {
   intertrava = 0;
   if (teto == 0 && intertrava == 0)
   {
    teto = 1;
    intertrava = 1;
    reles.SetRelay(1, DesligarRele, 1); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("teto_1");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
   if (teto == 1 && intertrava == 0)
   {
    teto = 0;
    intertrava = 1;
    reles.SetRelay(1, LigarRele, 1); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("teto_0");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
  }







  // Alterando rele dos pendentes da oficina de churrasco  **********************************************************************************************************************************
  if ( readString.indexOf("pendente_1") >= 0)
  {
    pendente = 1;
    reles.SetRelay(2, DesligarRele, 1); // num rele, modo, num modulo
  }
  
  if ( readString.indexOf("pendente_0") >= 0 )
  {
    pendente = 0;
    reles.SetRelay(2, LigarRele, 1); // num rele, modo, num modulo
  }
  
  if ( readString.indexOf("pen_churra") >= 0 )
  {
   intertrava = 0;
   if (pendente == 0 && intertrava == 0)
   {
    pendente = 1;
    intertrava = 1;
    reles.SetRelay(2, DesligarRele, 1); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("pendente_1");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
   if (pendente == 1 && intertrava == 0)
   {
    pendente = 0;
    intertrava = 1;
    reles.SetRelay(2, LigarRele, 1); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("pendente_0");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
  }


  // Alterando rele dos quadros da area de churrasco  **********************************************************************************************************************************
  if ( readString.indexOf("quadro_1") >= 0 )
  {
    quadros = 1;
    reles.SetRelay(3, DesligarRele, 1); // num rele, modo, num modulo
  }
  
  if ( readString.indexOf("quadro_0") >= 0 )
  {
    quadros = 0;
    reles.SetRelay(3, LigarRele, 1); // num rele, modo, num modulo
  }
  
  if ( readString.indexOf("amb_churra") >= 0 )
  {
   intertrava = 0;
   if (quadros == 0 && intertrava == 0)
   {
    quadros = 1;
    intertrava = 1;
    reles.SetRelay(3, DesligarRele, 1); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("quadro_1");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
   if (quadros == 1 && intertrava == 0)
   {
    quadros = 0;
    intertrava = 1;
    reles.SetRelay(3, LigarRele, 1); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("quadro_0");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
  }




  // Alterando rele da iluminacao do muro da area de churrasco  **************************************************************************************************************************
  if ( readString.indexOf("muro_ch_1") >= 0 )
  {
    muroch = 1;
    reles.SetRelay(4, DesligarRele, 1); // num rele, modo, num modulo
  }
  if ( readString.indexOf("muro_ch_0") >= 0 )
  {
    muroch = 0;
    reles.SetRelay(4, LigarRele, 1); // num rele, modo, num modulo
  }
  
  if ( readString.indexOf("muro_churra") >= 0 )
  {
   intertrava = 0;
   if (muroch == 0 && intertrava == 0)
   {
    muroch = 1;
    intertrava = 1;
    reles.SetRelay(4, DesligarRele, 1); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("muro_ch_1");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
   if (muroch == 1 && intertrava == 0)
   {
    muroch = 0;
    intertrava = 1;
    reles.SetRelay(4, LigarRele, 1); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("muro_ch_0");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
  }





  // Alterando reles da Garagem 1 ******************************************************************************************************************************************************
  if ( readString.indexOf("liga1") >= 0)
  {
   carro1 = 1;
   reles.SetRelay(5, DesligarRele, 1); // num rele, modo, num modulo
  }
  
  if ( readString.indexOf("desliga1") >= 0)
  {
   carro1 = 0;
   reles.SetRelay(5, LigarRele, 1); // num rele, modo, num modulo
  }
  
  if ( readString.indexOf("lamp_gara_1") >= 0 || readString.indexOf("carro1") >= 0)
  {
   intertrava = 0;
   if (carro1 == 0 && intertrava == 0)
   {
    carro1 = 1;
    intertrava = 1;
    reles.SetRelay(5, DesligarRele, 1); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("liga1");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
   if (carro1 == 1 && intertrava == 0)
   {
    carro1 = 0;
    intertrava = 1;
    reles.SetRelay(5, LigarRele, 1); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("desliga1");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
  }



    
  // Alterando reles da Garagem 2 ******************************************************************************************************************************************************
  if ( readString.indexOf("liga2") >= 0)
  {
   carro2 = 1;
   reles.SetRelay(6, DesligarRele, 1); // num rele, modo, num modulo
  }
  
  if ( readString.indexOf("desliga2") >= 0)
  {
   carro2 = 0;
   reles.SetRelay(6, LigarRele, 1); // num rele, modo, num modulo
  }
  
  
  if ( readString.indexOf("lamp_gara_2") >= 0 || readString.indexOf("carro2") >= 0)
  {
   intertrava = 0;
   if (carro2 == 0 && intertrava == 0)
   {
    carro2 = 1;
    intertrava = 1;
    reles.SetRelay(6, DesligarRele, 1); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("liga2");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
   if (carro2 == 1 && intertrava == 0)
   {
    carro2 = 0;
    intertrava = 1;
    reles.SetRelay(6, LigarRele, 1); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("desliga2");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
  }




  // Alterando reles da Garagem 3 ******************************************************************************************************************************************************
  if ( readString.indexOf("liga3") >= 0)
  {
   carro3 = 1;
   reles.SetRelay(7, DesligarRele, 1); // num rele, modo, num modulo
  }
  
  if ( readString.indexOf("desliga3") >= 0 )
  {
   carro3 = 0;
   reles.SetRelay(7, LigarRele, 1); // num rele, modo, num modulo
  }
  
  if ( readString.indexOf("lamp_gara_3") >= 0 || readString.indexOf("carro3") >= 0)
  {
   intertrava = 0;
   if (carro3 == 0 && intertrava == 0)
   {
    carro3 = 1;
    intertrava = 1;
    reles.SetRelay(7, DesligarRele, 1); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("liga3");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
   if (carro3 == 1 && intertrava == 0)
   {
    carro3 = 0;
    intertrava = 1;
    reles.SetRelay(7, LigarRele, 1); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("desliga3");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
  }




  // Alterando os reles da Garagem   ****************************************************************************************************************************************************
  if ( readString.indexOf("carros") >= 0)
  {
    n_de_lampada = 0;
    
   if(carro1 == 1) {n_de_lampada++;}
   if(carro2 == 1) {n_de_lampada++;}
   if(carro3 == 1) {n_de_lampada++;}

  
  if (carro1 == 0 && carro2 == 0 && carro3 == 0 && n_de_lampada==0 )
  {
   carro1 = 1;
   carro2 = 1;
   carro3 = 1;
   
   reles.SetRelay(5, DesligarRele, 1); // num rele, modo, num modulo
   reles.SetRelay(6, DesligarRele, 1); // num rele, modo, num modulo
   reles.SetRelay(7, DesligarRele, 1); // num rele, modo, num modulo

   digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
   RS485.print("todos_on");
   RS485.print("");
   digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   delay(200);
   
   n_de_lampada = 50;
  }
  
  if (n_de_lampada ==1 || ( (carro1 == 1 && carro2 == 1 && carro3 == 1 ) && n_de_lampada!=50 ) )
  {
   carro1 = 0;
   carro2 = 0;
   carro3 = 0;
   
   reles.SetRelay(5, LigarRele, 1); // num rele, modo, num modulo
   reles.SetRelay(6, LigarRele, 1); // num rele, modo, num modulo
   reles.SetRelay(7, LigarRele, 1); // num rele, modo, num modulo

   digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
   RS485.print("todos_off");
   RS485.print("");
   digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   delay(200);
   n_de_lampada = 0;
  }
  
  if ( n_de_lampada ==2)
  {
   carro1 = 1;
   carro2 = 1;
   carro3 = 1;
   
   reles.SetRelay(5, DesligarRele, 1); // num rele, modo, num modulo
   reles.SetRelay(6, DesligarRele, 1); // num rele, modo, num modulo
   reles.SetRelay(7, DesligarRele, 1); // num rele, modo, num modulo
   
   digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
   RS485.print("todos_on");
   RS485.print("");
   digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   delay(200);
   n_de_lampada = 0;
  }
 n_de_lampada = 0;

 } // Fecha se receber carros

// Alterando reles da iluminacao do muro dos carros ************************************************************************************************************************************
  if ( readString.indexOf("muro_ca_1") >= 0 )
  {
   muroca = 1;
   reles.SetRelay(8, DesligarRele, 1); // num rele, modo, num modulo
  }

  if ( readString.indexOf("muro_ca_0") >= 0 )
  {
   muroca = 0;
   reles.SetRelay(8, LigarRele, 1); // num rele, modo, num modulo
  }
  
  if ( readString.indexOf("muro_carros") >= 0 || readString.indexOf("arandela") >= 0)
  {
   intertrava = 0;
   if (muroca == 0 && intertrava == 0)
   {
    muroca = 1;
    intertrava = 1;
    reles.SetRelay(8, DesligarRele, 1); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("muro_ca_1");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
   if (muroca == 1 && intertrava == 0)
   {
    muroca = 0;
    intertrava = 1;
    reles.SetRelay(8, LigarRele, 1); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("muro_ca_0");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
  }


  // Alterando rele da iluminacao do jardim horizontal **********************************************************************************************************************************
  if ( readString.indexOf("jardim_h_1") >= 0 )
  {
   jardimh = 1;
   reles.SetRelay(1, DesligarRele, 2); // num rele, modo, num modulo
  }

  if ( readString.indexOf("jardim_h_0") >= 0 )
  {
   jardimh = 0;
   reles.SetRelay(1, LigarRele, 2); // num rele, modo, num modulo
  }

  if ( readString.indexOf("jardim_hori") >= 0 || readString.indexOf("jarhori") >= 0)
  {
   intertrava = 0;
   if (jardimh == 0 && intertrava == 0)
   {
    jardimh = 1;
    intertrava = 1;
    reles.SetRelay(1, DesligarRele, 2); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("jardim_h_1");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
   if (jardimh == 1 && intertrava == 0)
   {
    jardimh = 0;
    intertrava = 1;
    reles.SetRelay(1, LigarRele, 2); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("jardim_h_0");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
  }


  // Alterando rele da iluminacao do jardim vertical **********************************************************************************************************************************
  if ( readString.indexOf("jardim_v_1") >= 0 )
  {
   jardimv = 1;
   reles.SetRelay(2, DesligarRele, 2); // num rele, modo, num modulo
  }

  if ( readString.indexOf("jardim_v_0") >= 0)
  {
   jardimv = 0;
   reles.SetRelay(2, LigarRele, 2); // num rele, modo, num modulo
  }

  if ( readString.indexOf("jardim_verti") >= 0 )
  {
   intertrava = 0;
   if (jardimv == 0 && intertrava == 0)
   {
    jardimv = 1;
    intertrava = 1;
    reles.SetRelay(2, DesligarRele, 2); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("jardim_v_1");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
   if (jardimv == 1 && intertrava == 0)
   {
    jardimv = 0;
    intertrava = 1;
    reles.SetRelay(2, LigarRele, 2); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("jardim_v_0");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
  }




  // Alterando rele da iluminacao da oficina *****************************************************************************************************************************************
  if ( readString.indexOf("oficina_1") >= 0 )
  {
   oficina = 1;
   reles.SetRelay(3, DesligarRele, 2); // num rele, modo, num modulo
  }
  
  if ( readString.indexOf("oficina_0") >= 0 )
  {
   oficina = 0;
   reles.SetRelay(3, LigarRele, 2); // num rele, modo, num modulo
  }
  
  if ( readString.indexOf("lamp_oficina") >= 0 )
  {
   intertrava = 0;
   if (oficina == 0 && intertrava == 0)
   {
    oficina = 1;
    intertrava = 1;
    reles.SetRelay(3, DesligarRele, 2); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("oficina_1");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
   if (oficina == 1 && intertrava == 0)
   {
    oficina = 0;
    intertrava = 1;
    reles.SetRelay(3, LigarRele, 2); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("oficina_0");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
  }





  // Alterando rele da iluminacao da frente da casa ************************************************************************************************************************************
  if ( readString.indexOf("frente_1") >= 0 )
  {
   frente = 1;
   reles.SetRelay(4, DesligarRele, 2); // num rele, modo, num modulo
  }
 
  if ( readString.indexOf("frente_0") >= 0 )
  {
   frente = 0;
   reles.SetRelay(4, LigarRele, 2); // num rele, modo, num modulo
  }


  if ( readString.indexOf("frente_casa") >= 0 || readString.indexOf("frenca") >= 0)
  {
   intertrava = 0;
   if (frente == 0 && intertrava == 0)
   {
    frente = 1;
    intertrava = 1;
    reles.SetRelay(4, DesligarRele, 2); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("frente_1");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
   if (frente == 1 && intertrava == 0)
   {
    frente = 0;
    intertrava = 1;
    reles.SetRelay(4, LigarRele, 2); // num rele, modo, num modulo
    digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
    RS485.print("frente_0");
    digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   }
  }


  // Enviando a hora interna do RTC   ****************************************************************************************************************************************************
  if ( readString.indexOf("hora") >= 0 )
  {
   digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
   String DadosDaMensagemRecebida = {String(hora)+ ":"+String(minuto)};
   DadosDaMensagemRecebida.toCharArray(MensagemRecebida, DadosDaMensagemRecebida.length() + 1);
   //Serial.print("Enviando : ");
   //Serial.println(MensagemRecebida);
   RS485.print(MensagemRecebida);
   digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
  
  }
  
  // Desligando todos       ****************************************************************************************************************************************************
  if ( readString.indexOf("all_0") >= 0 )
  {
   teto = 0; 
   pendente = 0;
   quadros = 0;
   muroch = 0;
   carro1 = 0;
   carro2 = 0;
   carro3 = 0;
   muroca = 0;
   jardimh = 0;
   jardimv = 0;
   oficina = 0;
   frente = 0;

   digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
   RS485.print("geral_0");
   digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   delay(500);
   
   // Desligando todos os reles
   for(int i=1 ; i <= NumeroModulos ; i++)
   {
    for(int j=1 ; j <= 8 ; j++)
    {
     reles.SetRelay(j, LigarRele, i);
    }
   }
  }
  
  // Ligando todos       ****************************************************************************************************************************************************
  if ( readString.indexOf("all_1") >= 0)
  {
   teto = 1; 
   pendente = 1;
   quadros = 1;
   muroch = 1;
   carro1 = 1;
   carro2 = 1;
   carro3 = 1;
   muroca = 1;
   jardimh = 1;
   jardimv = 1;
   oficina = 1;
   frente = 1;

   digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
   RS485.print("geral_1");
   digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   delay(200);
   
   // Ligando todos os reles
   for(int i=1 ; i <= NumeroModulos ; i++)
   {
    for(int j=1 ; j <= 8 ; j++)
    {
     reles.SetRelay(j, DesligarRele, i);
     delay(800);
    }
   }   
}
     

  // Ligando muro pelo Portao EletrDesligarReleico ****************************************************************************************************************************************************
  
  // Garagem 01
  if ( readString.indexOf("portg1") >= 0 && (hora == 18 || hora == 19 || hora == 20 || hora == 21 || hora == 22 || hora == 23 || hora == 0 || hora == 1 || hora == 2 || hora == 3 || hora == 4 || hora == 5))
  {
   carro1 = 1;
   reles.SetRelay(5, DesligarRele, 1); // num rele, modo, num modulo
   digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
   RS485.print("liga1");
   digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   delay(200);
   muroca = 1;
   reles.SetRelay(8, DesligarRele, 1); // num rele, modo, num modulo
   digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
   RS485.print("muro_ca_1");
   digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
  }
  
  // Garagem 02
  if ( readString.indexOf("portg2") >= 0 && (hora == 18 || hora == 19 || hora == 20 || hora == 21 || hora == 22 || hora == 23 || hora == 0 || hora == 1 || hora == 2 || hora == 3 || hora == 4 || hora == 5))
  {
   carro2 = 1;
   reles.SetRelay(6, DesligarRele, 1); // num rele, modo, num modulo
   digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
   RS485.print("liga2");
   digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   delay(200);
   muroca = 1;
   reles.SetRelay(8, DesligarRele, 1); // num rele, modo, num modulo
   digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
   RS485.print("muro_ca_1");
   digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
  }
  
  // Garagem 03
  if ( readString.indexOf("portg3") >= 0 && (hora == 18 || hora == 19 || hora == 20 || hora == 21 || hora == 22 || hora == 23 || hora == 0 || hora == 1 || hora == 2 || hora == 3 || hora == 4 || hora == 5))
  {
   carro3 = 1;
   reles.SetRelay(7, DesligarRele, 1); // num rele, modo, num modulo
   digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
   RS485.print("liga3");
   digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
   delay(200);
   muroca = 1;
   reles.SetRelay(8, DesligarRele, 1); // num rele, modo, num modulo
   digitalWrite(transmitir, HIGH);    // Habilita a transmissão RS485
   RS485.print("muro_ca_1");
   digitalWrite(transmitir, LOW);    // Desabilita a transmissão RS485
  }

   
readString = ""; // Limpa a mensagem
  

loop(); // Mantem sempre rodando

} // Fecha void imprimir
