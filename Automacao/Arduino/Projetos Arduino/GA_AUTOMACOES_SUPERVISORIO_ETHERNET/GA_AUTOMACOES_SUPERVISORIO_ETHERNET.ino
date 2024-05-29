
#include <SPI.h> //Inclui a biblioteca SPI.h
#include <Ethernet.h> //Inclui a biblioteca Ethernet.h

// Configurações para o Ethernet Shield
byte mac[] = { 0x90, 0xA2, 0xDA, 0x0D, 0x83, 0xEA }; // Entre com o valor do MAC
IPAddress ip(192,168,1,108); // Configure um IP válido 
EthernetServer server(8092); //Inicializa a biblioteca EthernetServer com os valores de IP acima citados e configura a porta de acesso(80)

int led1 = 5;
int led2 = 6;
int led3 = 7;

int cled1,cled2,cled3;  // variaveis para imprimir o relatorio do check das saidas

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
 digitalWrite(led1,LOW);
 digitalWrite(led2,LOW);
 digitalWrite(led3,LOW);
cled1,cled2,cled3 = 0;
}


void loop()
{ // abre loop

 EthernetClient client = server.available();// Verifica se tem alguém conectado

  while (Serial.available()) {
    delay(3);  
    char c = Serial.read();
    readString += c; 
  }
  if (readString.length() >0) {

   
// Aciona Led 1 Pela Serial
if(readString.indexOf("SINAIS[0]")>=0)
{
 digitalWrite(led1, !digitalRead(led1));
    if(digitalRead(led1)==1)
    {
    Serial.println("Luz do Quarto Ligada!");cled1 = 1;
    } 
    if (digitalRead(led1)==0)
    {
    Serial.println("Luz do Quarto Desligada!");cled1 = 0;
    }  
}



// Aciona Led 2 Pela Serial
if(readString.indexOf("SINAIS[1]")>=0)
{
  digitalWrite(led2, !digitalRead(led2));
    if(digitalRead(led2)==1)
    {
    Serial.println("Luz da Sala Ligada!");cled2 = 1;
    } 
    if (digitalRead(led2)==0)
    {
    Serial.println("Luz da Sala Desligada!");cled2 = 0;
    }
}

// Aciona Led 3 Pela Serial
if(readString.indexOf("SINAIS[2]")>=0)
{
 digitalWrite(led3, !digitalRead(led3));
    if(digitalRead(led3)==1)
    {
    Serial.println("Luz da Copa Ligada!");cled3 = 1;
    } 
    if (digitalRead(led3)==0)
    {
    Serial.println("Luz da Copa Desligada!");cled3 = 0;
    }

}

if(readString =="status")   // Digitar c na serial para imprimir o relatorio das saidas
{


Serial.println("GA Automacoes");
Serial.println("/");
Serial.println("/");
Serial.println("Acompanhe abaixo toda a situacao da casa");
Serial.println("/");
Serial.println("/");

if(cled1==1){Serial.println("Luz do Quarto Ligada");}
if(cled1==0){Serial.println("Luz do Quarto Desligada");}

if(cled2==1){Serial.println("Luz da Sala Ligada");}
if(cled2==0){Serial.println("Luz da Sala Desligada");}

if(cled3==1){Serial.println("Luz da Copa Ligada");}
if(cled3==0){Serial.println("Luz da Copa Desligada");}


}

if(readString == "r")// Reset de todo o sistema recebendo r na serial, ou seja, colocando todo o sistema desligado
{
setup();
}
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
         if(readString.indexOf("SINAIS[0]") >= 0)
         {
         digitalWrite(led1,!digitalRead(led1));
         if(digitalRead(led1)==1)
          {
          Serial.println("Luz do Quarto Ligada!");cled1 = 1;
          } 
          if (digitalRead(led1)==0)
          {
          Serial.println("Luz do Quarto Desligada!");cled1 = 0;
          } 
         }
         
         
         // Quando acionado o botao 2 no supervisorio ethernet, contendo led2 aciona abaixo
         if(readString.indexOf("SINAIS[1]") >= 0)
         {
          digitalWrite(led2,!digitalRead(led2));
          if(digitalRead(led2)==1)
          {
          Serial.println("Luz da Sala Ligada!");cled2 = 1;
          } 
          if (digitalRead(led2)==0)
          {
          Serial.println("Luz da Sala Desligada!");cled2 = 0;
          }
         }
         
          
          // Quando acionado o botao 3 no supervisorio ethernet, contendo led3 aciona abaixo
          if(readString.indexOf("SINAIS[2]") >= 0)
          {
            digitalWrite(led3,!digitalRead(led3));
            if(digitalRead(led3)==1)
            {
            Serial.println("Luz da Copa Ligada!");cled3 = 1;
            } 
            if (digitalRead(led3)==0)
            {
            Serial.println("Luz da Copa Desligada!");cled3 = 0;
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
                          client.println("<title>Tutorial</title>");
                          client.println("<meta name=\"viewport\" content=\"width=320\">");
                          client.println("<meta name=\"viewport\" content=\"width=device-width\">");
                          client.println("<meta charset=\"utf-8\">");
                          client.println("<meta name=\"viewport\" content=\"initial-scale=1.0, user-scalable=no\">");
                          client.println("</HEAD>");
                          client.println("<BODY>");
                          // aqui dentro vai o que aparece no site
                          client.println("<CENTER>");// centraliza todo o site      
                          client.println("<font size=\"5\" face=\"verdana\" color=\"red\">Automacao</font>");
                          client.println("<font size=\"5\" face=\"verdana\" color=\"red\">   </font>");
                          client.println("<font size=\"5\" face=\"verdana\" color=\"red\">Residencial</font><br />");
                    
                          // botoes
                          if(digitalRead(led1))
                          {
                           statusled = "Ligada";
                          }
                          else
                          {
                            statusled = "Desligada";
                          } 
                          client.println("<BR>");
                          client.println("<form action=\"SINAIS[0]\" method=\"get\">");
                          client.println("<button type=submit style=\"width:200px;\">Luz do Quarto - "+statusled+"</button> ");
                          client.println("</form> <br />");
                          
                          
                          
                          if(digitalRead(led2))
                          {
                           statusled = "Ligada";
                          }
                          else
                          {
                            statusled = "Desligada";
                          }
                          client.println("<form action=\"SINAIS[1]\" method=\"get\">");
                          client.println("<button type=submit style=\"width:200px; color=red\">Luz da Sala - "+statusled+"</button> ");
                          client.println("</form> <br />");
                    
                    
                          if(digitalRead(led3))
                          {
                           statusled = "Ligada";
                          }
                          else
                          {
                            statusled = "Desligada";
                          }
                          client.println("<form action=\"SINAIS[2]\" method=\"get\">");
                          client.println("<button type=submit style=\"width:200px;\">Luz da Copa - "+statusled+"</button> ");
                          client.println("</form> <br />");
                    
                    
                         
                    
                          client.println("</BODY>");
                          client.print(" <meta http-equiv=\"refresh\" content=\"3; url=http://192.168.2.55:90\"> ");
                          client.println("</HTML>");

                          readString = "";
                          
                          client.stop();
                          
                         
                     
         } // fecha se c == /n 
       } // fecha se client available
      
   } // fecha whilie client connected
      
 } // fecha if client 
readString = "";
} //Fecha loop





