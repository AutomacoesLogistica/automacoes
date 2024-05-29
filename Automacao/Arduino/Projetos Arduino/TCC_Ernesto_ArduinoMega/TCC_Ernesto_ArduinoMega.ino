/*
A0 - Device 1;
A1 - Device 2;
A2 - Device 3;
A3 - Device 4;
A4 - Device 5;
A5 - Device 6;
D0 - N/C;
D1 - N/C;
D2 - Device 7;
D3 - Device 8;
D4 - Ethernet Shield SD Card;
D5 - Device 9;
D6 - Device 10;
D7 - Device 11;
D8 - Device 12;
D9 - N/C;
D10 -Ethernet Shield Controller; 
D11 -Ethernet Shield MOSI; 
D12 -Ethernet Shield MISO;  
D13 -Ethernet Shield SCK;  
--------------------------------------------------------------------
*/

#include <SPI.h>
#include <String.h>
#include <Ethernet.h>
#include <Stepper.h>

//-------------------------------------------------------------------
// Definindo sensor de chuva
int sensorchuva = 7;
int valorchuva;
boolean todasfechadas = 0; // Inicia em todas abertas, todas fechadas é 1
boolean janela01 = 1; // 0 é aberta, 1 é fechada
boolean janela02 = 1; // 0 é aberta, 1 é fechada
boolean janela03 = 1; // 0 é aberta, 1 é fechada
boolean janela04 = 1; // 0 é aberta, 1 é fechada
boolean janela05 = 1; // 0 é aberta, 1 é fechada

//-------------------------------------------------------------------

// Dados da janela 1
int aberto1 = 44;
int fechado1 = 45;

//Dados da janela 2
int aberto2 = 46;
int fechado2 = 47;

// Dados da janela 3
int aberto3 = 48;
int fechado3 = 49;

// Dados da janela 4
int aberto4 = 50;
int fechado4 = 51;

// Dados da janela 5
int aberto5 = 52;
int fechado5 = 53;

//-------------------------------------------------------------------
// Dados dos motores
const int stepsPerRevolution = 200;

Stepper motor1(stepsPerRevolution, 22,23,24,25);            
Stepper motor2(stepsPerRevolution, 26,27,28,29);            
Stepper motor3(stepsPerRevolution, 30,31,32,33);            
Stepper motor4(stepsPerRevolution, 34,35,36,37);            
Stepper motor5(stepsPerRevolution, 38,39,40,41);            


//-------------------------------------------------------------------
byte mac[] = {0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED };//MAC padrão;
IPAddress ip(192, 168, 2, 50);//Define o endereco IPv4(trocar final);
IPAddress gateway(192, 168, 2, 1);      //Define o gateway
IPAddress subnet(255, 255, 255, 0); //Define a máscara de rede
EthernetServer server(80); // Porta de serviço
//-------------------------------------------------------------------
int AA0 = A0;//Arduino analogica A0;
int AA1 = A1;//Arduino analogica A1;
int AA2 = A2;//Arduino analogica A2;
int AA3 = A3;//Arduino analogica A3;
int AA4 = A4;//Arduino analogica A4;
int AA5 = A5;//Arduino analogica A5;
//-------------------------------------------------------------------
int D2 = 2;//Arduino digital D2;
int D3 = 3;//Arduino digital D3;
int D5 = 5;//Arduino digital D5;
int D6 = 6;//Arduino digital D6;
int D7 = 7;//Arduino digital D7;
int D8 = 8;//Arduino digital D8;
//-------------------------------------------------------------------
String readString = String(30); // string para buscar dados de endereço
boolean statusA0 = false; // Variável para o status do led 
boolean statusA1 = false; // Variável para o status do led 
boolean statusA2 = false; // Variável para o status do led 
boolean statusA3 = false; // Variável para o status do led 
boolean statusA4 = false; // Variável para o status do led 
boolean statusA5 = false; // Variável para o status do led 

boolean statusD2 = false; // Variável para o status do led 
boolean statusD3 = false; // Variável para o status do led 
boolean statusD5 = false; // Variável para o status do led 
boolean statusD6 = false; // Variável para o status do led 
boolean statusD7 = false; // Variável para o status do led 
boolean statusD8 = false; // Variável para o status do led 
//--------------------------------------------------------------------
void setup(){
  // Inicia o Ethernet
  //Ethernet.begin(mac, ip);
  Ethernet.begin(mac, ip, gateway, subnet);
  server.begin();
 
  // -----------------------------------------------------------------
  // Definindo os pinos das janelas
    pinMode(aberto1,INPUT);
    pinMode(aberto2,INPUT);
    pinMode(aberto3,INPUT);
    pinMode(aberto4,INPUT);
    pinMode(aberto5,INPUT);
    pinMode(fechado1,INPUT);
    pinMode(fechado2,INPUT);
    pinMode(fechado3,INPUT);
    pinMode(fechado4,INPUT);
    pinMode(fechado5,INPUT);
  // -----------------------------------------------------------------
  // Definindo sensor de chuva
    pinMode(sensorchuva, INPUT);
 
 // -----------------------------------------------------------------
 // Definindo a velocidade dos motores
   motor1.setSpeed(100);
   motor2.setSpeed(100);
   motor3.setSpeed(100);
   motor4.setSpeed(100);
   motor5.setSpeed(100);   
   
//-----------------------Define pino como saída-----------------------
  pinMode(AA0, OUTPUT);
  pinMode(AA1, OUTPUT);
  pinMode(AA2, OUTPUT);
  pinMode(AA3, OUTPUT);
  pinMode(AA4, OUTPUT);
  pinMode(AA5, OUTPUT);
  
  pinMode(D2, OUTPUT);
  pinMode(D3, OUTPUT);
  pinMode(D5, OUTPUT);
  pinMode(D6, OUTPUT);
  pinMode(D7, OUTPUT);
  pinMode(D8, OUTPUT);
  
 //Devido a lógida invertida de acionamento dos relés,
 //devemos iniciar os canais AA0, AA1, AA2...D8; 
 //com nível alto 5V(HIGH) como segue abaixo;

 //Módulo relé atua com lógica invertida:
 //Entrada do módulo relé em nível lógico "0V":Bobina Energizada;
 //Contato N/A(N/O)>>Fecha contato;
 //Entrada do módulo relé em nível lógico "5V":Bobina Desernegizada;
 //Contato N/A(N/O)>>Abre contato;

 digitalWrite(AA0,HIGH);
 digitalWrite(AA1,HIGH);
 digitalWrite(AA2,HIGH);
 digitalWrite(AA3,HIGH);
 digitalWrite(AA4,HIGH);
 digitalWrite(AA5,HIGH);

 digitalWrite(D2,HIGH);
 digitalWrite(D3,HIGH);
 digitalWrite(D5,HIGH);
 digitalWrite(D6,HIGH);
 digitalWrite(D7,HIGH);
 digitalWrite(D8,HIGH);
//---------------------------------------------------------------------
  // Inicia a comunicação Serial
  Serial.begin(9600); 
}

void loop()
{
 valorchuva = digitalRead(sensorchuva);
 
 // VERIFICANDO SE ESTA CHOVENDO
 if ( valorchuva == 0 ) // Entra se esta chovendo
 {
  while (todasfechadas == 0 ) // quando todas fecharem, a variavel vai para 1 e sai do while
  {
    // JANELA 01 ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    if(digitalRead(fechado1 == 1))
    {
      motor1.step(-stepsPerRevolution); // Roda para fechar pois ainda está aberta
      janela01 = 0;
    }
    else
    {
     janela01 = 1;   // Janela esta fechada    
    }

    // JANELA 02 ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    if(digitalRead(fechado2 == 1))
    {
      motor2.step(-stepsPerRevolution); // Roda para fechar pois ainda está aberta
      janela02 = 0;
    }
    else
    {
     janela02 = 1;       // Janela esta fechada
    }

    // JANELA 03 ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    if(digitalRead(fechado3 == 1))
    {
      motor3.step(-stepsPerRevolution); // Roda para fechar pois ainda está aberta
      janela03 = 0;
    }
    else
    {
     janela03 = 1;  // Janela esta fechada     
    }
   
    // JANELA 04 ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    if(digitalRead(fechado4 == 1))
    {
      motor4.step(-stepsPerRevolution); // Roda para fechar pois ainda está aberta
      janela04 = 0;
    }
    else
    {
     janela04 = 1;  // Janela esta fechada    
    }

    // JANELA 05 ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    if(digitalRead(fechado5 == 1))
    {
      motor5.step(-stepsPerRevolution); // Roda para fechar pois ainda está aberta
      janela05 = 0;
    }
    else
    {
     janela05 = 1;  // Janela esta fechada     
    }
   
   if (janela01 == 1 && janela02 == 1 && janela03 == 1 && janela04 == 1 && janela05 == 1)
   {
   todasfechadas = 1;       // Todas as janelas estão fechadas
   }
   else
   {
   todasfechadas = 0;    // Alguma das janelas ou todas ainda estão abertas    
   }
   
  } // Fecha o while
 }
  // Criar uma conexão de cliente
  EthernetClient client = server.available();
  
  if (client) {
    while (client.connected())
    {
      if (client.available())
      {
        char c = client.read();
        // ler caractere por caractere vindo do HTTP
        if (readString.length() < 30)
        {
          // armazena os caracteres para string
          readString += (c);
        }

        
        //se o pedido HTTP terminou
        if (c == '\n')
          {
//------------------------------------------------------------------
// DADOS DA JANELA 01

        if(readString.indexOf("a0high")>=0)//Recebido do Android;
          {
           // Turn ON the Relay.
            digitalWrite(AA0, LOW);//Arduino porta digital A0=5V;
            statusA0 = true;
            
            // ABRINDO A JANELA 01
            while(digitalRead(fechado1 == 1))
            {
             motor1.step(stepsPerRevolution);  
             todasfechadas = 0; // Limpa a variavel para obter o fechamento por chuva
            }
            janela01 = 0; // Janela esta aberta
          }
          // Se a string possui o texto L=Desligar
          if(readString.indexOf("a0low")>=0)//Recebido do Android;
          {
           // Turn OFF the Relay.
            digitalWrite(AA0, HIGH);//Arduino porta digital A0=0V;
            statusA0 = false;
            
            // FECHANDO A JANELA 01
            while(digitalRead(aberto1 == 1))
            {
             motor1.step(-stepsPerRevolution);  
            }
            janela01 = 1; // Janela esta fechada
          }
//------------------------------------------------------------------
       if(readString.indexOf("a1high")>=0)//Recebido do Android;
          {
           // Turn ON the Relay.
            digitalWrite(AA1, LOW);//Arduino porta digital A1=5V;
            statusA1 = true;
            
            // ABRINDO A JANELA 02
            while(digitalRead(fechado2 == 1))
            {
             motor2.step(stepsPerRevolution);  
             todasfechadas = 0; // Limpa a variavel para obter o fechamento por chuva
            }
            janela02 = 0; // Janela esta aberta
          }
          // Se a string possui o texto L=Desligar
          if(readString.indexOf("a1low")>=0)//Recebido do Android;
          {
           // Turn OFF the Relay.
            digitalWrite(AA1, HIGH);//Arduino porta digital A1=0V;
            statusA1 = false;
            // FECHANDO A JANELA 02
            while(digitalRead(aberto2 == 1))
            {
             motor2.step(-stepsPerRevolution);  
            }
            janela02 = 1; // Janela esta fechadaa
          }
//------------------------------------------------------------------
       if(readString.indexOf("a2high")>=0)//Recebido do Android;
          {
            // Turn ON the Relay.
            digitalWrite(AA2, LOW);//Arduino porta digital A2=5V;
            statusA2 = true;
            // ABRINDO A JANELA 03
            while(digitalRead(fechado3 == 1))
            {
             motor3.step(stepsPerRevolution);  
             todasfechadas = 0; // Limpa a variavel para obter o fechamento por chuva
            }
            janela03 = 0; // Janela esta aberta
          }
          // Se a string possui o texto L=Desligar
          if(readString.indexOf("a2low")>=0)//Recebido do Android;
          {
           // Turn OFF the Relay.
            digitalWrite(AA2, HIGH);//Arduino porta digital A2=0V;
            statusA2 = false;
           // FECHANDO A JANELA 04
            while(digitalRead(aberto3 == 1))
            {
             motor3.step(-stepsPerRevolution);  
            }
            janela03 = 0; // Janela esta fechada
          }
//------------------------------------------------------------------
       if(readString.indexOf("a3high")>=0)//Recebido do Android;
          {
           // Turn ON the Relay.
            digitalWrite(AA3, LOW);//Arduino porta digital A3=5V;
            statusA3 = true;
            // ABRINDO A JANELA 04
            while(digitalRead(fechado4 == 1))
            {
             motor4.step(stepsPerRevolution);  
             todasfechadas = 0; // Limpa a variavel para obter o fechamento por chuva
            }
            janela04 = 0; // Janela esta aberta
          }
          // Se a string possui o texto L=Desligar
          if(readString.indexOf("a3low")>=0)//Recebido do Android;
          {
           // Turn OFF the Relay.
            digitalWrite(AA3, HIGH);//Arduino porta digital A3=0V;
            statusA3 = false;
            // FECHANDOO A JANELA 04
            while(digitalRead(aberto4 == 1))
            {
             motor4.step(-stepsPerRevolution);  
            }
            janela04 = 0; // Janela esta fechada
          }
//------------------------------------------------------------------
       if(readString.indexOf("a4high")>=0)//Recebido do Android;
          {
           // Turn ON the Relay.
            digitalWrite(AA4, LOW);//Arduino porta digital A4=5V;
            statusA4 = true;
            // ABRINDO A JANELA 05
            while(digitalRead(fechado5 == 1))
            {
             motor5.step(stepsPerRevolution);  
             todasfechadas = 0; // Limpa a variavel para obter o fechamento por chuva
            }
            janela05 = 0; // Janela esta aberta
          }
          // Se a string possui o texto L=Desligar
          if(readString.indexOf("a4low")>=0)//Recebido do Android;
          {
           // Turn OFF the Relay.
            digitalWrite(AA4, HIGH);//Arduino porta digital A4=0V;
            statusA4 = false;
            // FECHADO A JANELA 05
            while(digitalRead(aberto5 == 1))
            {
             motor5.step(-stepsPerRevolution);  
            }
            janela05 = 0; // Janela esta fechada
          }
//------------------------------------------------------------------
       if(readString.indexOf("a5high")>=0)//Recebido do Android;
          {
           // Turn ON the Relay.
            digitalWrite(AA5, LOW);//Arduino porta digital A5=5V;
            statusA5 = true;
          }
          // Se a string possui o texto L=Desligar
          if(readString.indexOf("a5low")>=0)//Recebido do Android;
          {
           // Turn OFF the Relay.
            digitalWrite(AA5, HIGH);//Arduino porta digital A5=0V;
            statusA5 = false;
          }          
//------------------------------------------------------------------        
          if(readString.indexOf("d2high")>=0)//Recebido do Android;
          {
           // Turn ON the Relay.
            digitalWrite(D2, LOW);//Arduino porta digital D2=5V;
            statusD2 = true;
          }
          // Se a string possui o texto L=Desligar
          if(readString.indexOf("d2low")>=0)//Recebido do Android;
          {
            // Turn OFF the Relay.
            digitalWrite(D2, HIGH);//Arduino porta digital D2=0V;
            statusD2 = false;
          }
//------------------------------------------------------------------        
          if(readString.indexOf("d3high")>=0)//Recebido do Android;
          {
          // Turn ON the Relay.
            digitalWrite(D3, LOW);//Arduino porta digital D3=5V;
            statusD3 = true;
          }
          // Se a string possui o texto L=Desligar
          if(readString.indexOf("d3low")>=0)//Recebido do Android;
          {
           // Turn OFF the Relay.
            digitalWrite(D3, HIGH);//Arduino porta digital D3=0V;
            statusD3 = false;
          }
//------------------------------------------------------------------        
          if(readString.indexOf("d5high")>=0)//Recebido do Android;
          {
          // Turn ON the Relay.
            digitalWrite(D5, LOW);//Arduino porta digital D5=5V;
            statusD5 = true;
          }
          // Se a string possui o texto L=Desligar
          if(readString.indexOf("d5low")>=0)//Recebido do Android;
          {
            // Turn OFF the Relay.
            digitalWrite(D5, HIGH);//Arduino porta digital D5=0V;
            statusD5 = false;
          }
//------------------------------------------------------------------        
          if(readString.indexOf("d6high")>=0)//Recebido do Android;
          {
           // Turn ON the Relay.
            digitalWrite(D6, LOW);//Arduino porta digital D6=5V;
            statusD6 = true;
          }
          // Se a string possui o texto L=Desligar
          if(readString.indexOf("d6low")>=0)//Recebido do Android;
          {
           // Turn OFF the Relay.
            digitalWrite(D6, HIGH);//Arduino porta digital D6=0V;
            statusD6 = false;
          }
//------------------------------------------------------------------        
          if(readString.indexOf("d7high")>=0)//Recebido do Android;
          {
           // Turn ON the Relay.
            digitalWrite(D7, LOW);//Arduino porta digital D7=5V;
            statusD7 = true;
          }
          // Se a string possui o texto L=Desligar
          if(readString.indexOf("d7low")>=0)//Recebido do Android;
          {
           // Turn OFF the Relay.
            digitalWrite(D7, HIGH);//Arduino porta digital D7=0V;
            statusD7 = false;
          } 
//------------------------------------------------------------------        
          if(readString.indexOf("d8high")>=0)//Recebido do Android;
          {
          // Turn ON the Relay.
            digitalWrite(D8, LOW);//Arduino porta digital D8=5V;
            statusD8 = true;
          }
          // Se a string possui o texto L=Desligar
          if(readString.indexOf("d8low")>=0)//Recebido do Android;
          {
           // Turn OFF the Relay.
            digitalWrite(D8, HIGH);//Arduino porta digital D8=0V;
            statusD8 = false;
          }         
//------------------------------------------------------------------         
        // dados HTML de saída começando com cabeçalho padrão
        client.println("HTTP/1.1 200 OK");
        client.println("Content-Type: text/html");
        client.println();      
        client.print("<font size='20'>");
//------------------------------------------------------------------  
 if (statusA0) {
          client.print("azeroon");//Ethernet envia para Android;
          //String apenas letras;
        } else {
          client.print("azerooff");//Ethernet envia string para Android;
          //String apenas letras;
        }
//------------------------------------------------------------------  
if (statusA1) {
          client.print("aoneon");//Ethernet envia para Android;
          //String apenas letras;
        } else {
          client.print("aoneoff");//Ethernet envia string para Android;
          //String apenas letras;
        }
//------------------------------------------------------------------ 
if (statusA2) {
          client.print("atwoon");//Ethernet envia para Android;
          //String apenas letras;
        } else {
          client.print("atwooff");//Ethernet envia string para Android;
          //String apenas letras;
        }
//------------------------------------------------------------------  
if (statusA3) {
          client.print("athreeon");//Ethernet envia para Android;
          //String apenas letras;
        } else {
          client.print("athreeoff");//Ethernet envia string para Android;
          //String apenas letras;
        }
//------------------------------------------------------------------ 
if (statusA4) {
          client.print("afouron");//Ethernet envia para Android;
          //String apenas letras;
        } else {
          client.print("afouroff");//Ethernet envia string para Android;
          //String apenas letras;
        }
//------------------------------------------------------------------ 
if (statusA5) {
          client.print("afiveon");//Ethernet envia para Android;
          //String apenas letras;
        } else {
          client.print("afiveoff");//Ethernet envia string para Android;
          //String apenas letras;
        }        
//------------------------------------------------------------------        
        if (statusD2) {
          client.print("dtwoon");//Ethernet envia para Android;
          //String apenas letras;
        } else {
          client.print("dtwooff");//Ethernet envia string para Android;
          //String apenas letras;
        }
//------------------------------------------------------------------ 
        if (statusD3) {
          client.print("dthreeon");//Ethernet envia para Android;
          //String apenas letras;
        } else {
          client.print("dthreeoff");//Ethernet envia string para Android;
          //String apenas letras;
        }
//------------------------------------------------------------------ 
        if (statusD5) {
          client.print("dfiveon");//Ethernet envia para Android;
          //String apenas letras;
        } else {
          client.print("dfiveoff");//Ethernet envia string para Android;
          //String apenas letras;
        }
//------------------------------------------------------------------ 
        if (statusD6) {
          client.print("dsixon");//Ethernet envia para Android;
          //String apenas letras;
        } else {
          client.print("dsixoff");//Ethernet envia string para Android;
          //String apenas letras;
        }
//------------------------------------------------------------------ 
        if (statusD7) {
          client.print("dsevenon");//Ethernet envia para Android;
          //String apenas letras;
        } else {
          client.print("dsevenoff");//Ethernet envia string para Android;
          //String apenas letras;
        }
//------------------------------------------------------------------ 
        if (statusD8) {
          client.print("deighton");//Ethernet envia para Android;
          //String apenas letras;
        } else {
          client.print("deightoff");//Ethernet envia string para Android;
          //String apenas letras;
        }        
//------------------------------------------------------------------ 
        //limpa string para a próxima leitura
        readString="";
        
        // parar cliente
        client.stop();
        }
      }
    }
  }
}

