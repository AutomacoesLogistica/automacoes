
#include <SPI.h> //Inclui a biblioteca SPI.h
#include <Ethernet.h> //Inclui a biblioteca Ethernet.h

// Configurações para o Ethernet Shield
byte mac[] = { 0x90, 0xA2, 0xDA, 0x0D, 0x83, 0xEA }; // Entre com o valor do MAC
IPAddress ip(192,168,1,108); // Configure um IP válido 
EthernetServer server(8092); //Inicializa a biblioteca EthernetServer com os valores de IP acima citados e configura a porta de acesso(80)

int led1 = 2;
int led2 = 3;
int led3 = 5;
int led4 = 6;
int led5 = 7;
int led6 = 8;
int led7 = 9;

int cled1,cled2,cled3,cled4;  // variaveis para imprimir o relatorio do check das saidas

String readString = String(30);
String statusled;


//======================================================================================

void setup()
{
Serial.begin(9600);
  Ethernet.begin(mac, ip);// Inicializa o Server com o IP e Mac atribuido acima
 pinMode(led1,OUTPUT);
 pinMode(led2,OUTPUT);
 pinMode(led3,OUTPUT);
 pinMode(led4,OUTPUT);
 pinMode(led5,OUTPUT);
 pinMode(led6,OUTPUT);
 pinMode(led7,OUTPUT);
 digitalWrite(led1,LOW);
 digitalWrite(led2,LOW);
 digitalWrite(led3,LOW);
 digitalWrite(led4,LOW);
 digitalWrite(led5,LOW);
 digitalWrite(led6,LOW);
 digitalWrite(led7,LOW);

cled1,cled2,cled3,cled4 = 0;
}


void loop()
{ // abre loop

 EthernetClient client = server.available();// Verifica se tem alguém conectado
char S = Serial.read();

// Aciona Led 1 Pela Serial
if(S == '1')
{
 digitalWrite(led1, !digitalRead(led1));
    if(digitalRead(led1)==1)
    {
    Serial.println("Led 1 Ligado!");cled1 = 1;
    } 
    if (digitalRead(led1)==0)
    {
    Serial.println("Led 1 Desligado!");cled1 = 0;
    }  
}



// Aciona Led 2 Pela Serial
if(S == '2')
{
  digitalWrite(led2, !digitalRead(led2));
    if(digitalRead(led2)==1)
    {
    Serial.println("Led 2 Ligado!");cled2 = 1;
    } 
    if (digitalRead(led2)==0)
    {
    Serial.println("Led 2 Desligado!");cled2 = 0;
    }
}

// Aciona Led 3 Pela Serial
if(S == '3')
{
 digitalWrite(led3, !digitalRead(led3));
    if(digitalRead(led3)==1)
    {
    Serial.println("Led 3 Ligado!");cled3 = 1;
    } 
    if (digitalRead(led3)==0)
    {
    Serial.println("Led 3 Desligado!");cled3 = 0;
    }
}

// Aciona Led 3 Pela Serial
if(S == '4')
{
 digitalWrite(led4, !digitalRead(led4));
    if(digitalRead(led4)==1)
    {
    Serial.println("Led 4 Ligado!");cled4 = 1;
    } 
    if (digitalRead(led4)==0)
    {
    Serial.println("Led 4 Desligado!");cled4 = 0;
    }
}

if(S =='c')   // Digitar c na serial para imprimir o relatorio das saidas
{


Serial.println("AUTOMACAO RESIDENCIAL DE BRUNO GONCALVES");
Serial.println("/");
Serial.println("/");
Serial.println("Abaixo acompanhe a situacao de toda a casa");
Serial.println("/");
Serial.println("/");

if(cled1==1){Serial.println("Led 1 Ligado");}
if(cled1==0){Serial.println("Led 1 Desligado");}

if(cled2==1){Serial.println("Led 2 Ligado");}
if(cled2==0){Serial.println("Led 2 Desligado");}

if(cled3==1){Serial.println("Led 3 Ligado");}
if(cled3==0){Serial.println("Led 3 Desligado");}

if(cled4==1){Serial.println("Led 4 Ligado");}
if(cled4==0){Serial.println("Led 4 Desligado");}


}

if(S == 'r')// Reset de todo o sistema recebendo r na serial, ou seja, colocando todo o sistema desligado
{
setup();
}



 if (client)
 { // abre if client
    while (client.connected())
    { // abre while client connected
      if(client.available())
      { // abre se client available
       char c = client.read();
       if(readString.length() < 30)
       {
         readString += (c);     
       }
      
         if (c == '\n') 
         { // abre se c == /n
         
         
         // Quando acionado o botao 1 no supervisorio ethernet, contendo led1 aciona abaixo
         if(readString.indexOf("led1") >= 0)
         {
         digitalWrite(led1,!digitalRead(led1));
         if(digitalRead(led1)==1)
          {
          Serial.println("Led 1 Ligado!");cled1 = 1;
          } 
          if (digitalRead(led1)==0)
          {
          Serial.println("Led 1 Desligado!");cled1 = 0;
          } 
         }
         
         
         // Quando acionado o botao 2 no supervisorio ethernet, contendo led2 aciona abaixo
         if(readString.indexOf("led2") >= 0)
         {
          digitalWrite(led2,!digitalRead(led2));
          if(digitalRead(led2)==1)
          {
          Serial.println("Led 2 Ligado!");cled2 = 1;
          } 
          if (digitalRead(led2)==0)
          {
          Serial.println("Led 2 Desligado!");cled2 = 0;
          }
         }
         
          
          // Quando acionado o botao 3 no supervisorio ethernet, contendo led3 aciona abaixo
          if(readString.indexOf("led3") >= 0)
          {
           digitalWrite(led3,!digitalRead(led3));
            if(digitalRead(led3)==1)
            {
            Serial.println("Led 3 Ligado!");cled3 = 1;
            } 
            if (digitalRead(led3)==0)
            {
            Serial.println("Led 3 Desligado!");cled3 = 0;
            }
         }
                                 
  // Quando acionado o botao 1 no supervisorio ethernet, contendo led1 aciona abaixo
         if(readString.indexOf("led4") >= 0)
         {
         digitalWrite(led4,!digitalRead(led4));
         if(digitalRead(led4)==1)
          {
          Serial.println("Led 4 Ligado!");cled4 = 1;
          } 
          if (digitalRead(led4)==0)
          {
          Serial.println("Led 4 Desligado!");cled4 = 0;
          } 
         }                         
                                                 
                          //Inicia página HTML
                          client.println("HTTP/1.1 200 OK");
                          client.println("Content-Type: text/html");
                          // client.println("Refresh: 5"); atualiza valores
                          client.println();
                          
                           
                           // Inicio da pagina
                          client.println("<!doctype html>");       
                          client.println("<HTML>");
                          client.println("<HEAD>");
                          client.println("<title>Automacao Residencial</title>");
                          client.println("<meta name=\"viewport\" content=\"width=320\">");
                          client.println("<meta name=\"viewport\" content=\"width=device-width\">");
                          client.println("<meta charset=\"utf-8\">");
                          client.println("<meta name=\"viewport\" content=\"initial-scale=2.0, user-scalable=no\">");
                          client.println("</HEAD>");
                          client.println("<BODY>");
                          // aqui dentro vai o que aparece no site
                          client.println("<CENTER>");// centraliza todo o site      
                          client.println("<font size=\"5\" face=\"verdana\" color=\"green\">Bruno Gonçalves</font>");
                          client.println("<font size=\"5\" face=\"verdana\" color=\"red\">   -   </font>");
                          client.println("<font size=\"5\" face=\"verdana\" color=\"blue\">Automação Residencial</font><br />");
                          client.println("<BR>");
                          // botoes
                          if(digitalRead(led1)){statusled = "Ligado";}
                          else{statusled = "Desligado";} 
                       
                          client.println("<form action=\"led1\" method=\"get\">");
                          client.println("<button type=submit style=\"width:300px;height:60px\">Area Externa 01 - Desligado""</button> ");
                          client.println("</form> <br />");
                          
                          
                          
                          if(digitalRead(led2)){statusled = "Ligado";}
                          else{statusled = "Desligado";}
                       
                          client.println("<form action=\"led2\" method=\"get\">");
                          client.println("<button type=submit style=\"width:300px;height:60px\">Area Externa 02 - Desligado""</button> ");
                          client.println("</form> <br />");
                    
                    
                          if(digitalRead(led3)){statusled = "Ligado";}
                          else{statusled = "Desligado";}
                          
                          client.println("<form action=\"led3\" method=\"get\">");
                          client.println("<button type=submit style=\"width:300px;height:60px\">Area Externa 03 - Desligado""</button> ");
                          client.println("</form> <br />");
                          
                          
                          if(digitalRead(led4)){statusled = "Ligado";}
                          else{statusled = "Desligado";}
                          
                          client.println("<form action=\"led4\" method=\"get\">");
                          client.println("<button type=submit style=\"width:300px;height:60px\">Area Externa 04 - Desligado""</button> ");
                          client.println("</form> <br />");
                          
                    
                          client.println("</BODY>");
                         client.println("</HTML>");

                          readString = "";
                          
                          client.stop();
                          
                         
                     
         } // fecha se c == /n 
       } // fecha se client available
      
   } // fecha whilie client connected
      
 } // fecha if client 
} //Fecha loop





