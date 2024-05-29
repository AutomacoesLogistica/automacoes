
#include <SPI.h> //Inclui a biblioteca SPI.h
#include <Ethernet.h> //Inclui a biblioteca Ethernet.h

// Configurações para o Ethernet Shield
byte mac[] = { 0x90, 0xA2, 0xDA, 0x0D, 0x83, 0xEA }; // Entre com o valor do MAC
IPAddress ip(192,168,2,55); // Configure um IP válido 
EthernetServer server(90); //Inicializa a biblioteca EthernetServer com os valores de IP acima citados e configura a porta de acesso(80)

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
                        
                        
                        
                          
                        client.println("<BODY bgcolor='black'>");
                         client.println("<CENTER>");// centraliza todo o site      
                         client.println("<font size=\"8\" face=\"verdana\" color=\"green\">Controle Acesso</font>");
                        
                         
                          client.println("<BR><BR><BR>");
                          
                          
                          
              // cria tira escrito login e fundo cinza            
               client.println("<table width=\"400\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" bgcolor=\"#939393\" align=\"center\">"); 
               client.println("<tr height=\"35\">"); 
               client.println("<td style=\"FONT-WEIGHT: bold;color:#ffffff;FONT-FAMILY:CALIBRI\">&nbsp;&nbsp;&nbsp;&nbsp;LOGIN</td>"); 
               client.println("</tr>"); 
               client.println("</table>");
               client.println("<table width=\"400\" height=\"180\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" bgcolor=\"#ffffff\" align=\"center\">"); 
               client.println("<tr>"); 
               client.println("<td>");
               client.println("<table>");      
               
             
                          
              // APARECER ESCRITO USUARIO                           
              client.println("<td width=\"80\" align=\"center\" style='font-family:CALIBRI;font-size:13px'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;USUARIO</td>");                 
              //caixa de texto para digitacao
              client.println("<td><input type=\"text\" name=\"username\" id=\"username\" class=\"ct_text\" maxlength=\"55\"/></td>");
	      client.println("</tr>"); 
	      client.println("<tr>");

              // APARECER ESCRITO USENHA      
              client.println("<td width=\"80\" align=\"center\" style='font-family:CALIBRI;font-size:13px'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SENHA</td>");
              // caixa de texto para digitacao
             client.println("<td><input type=\"password\" name=\"password\" id=\"password\" class=\"ct_text\" maxlength=\"88\"/></td>");              

 
              //ESPAÇO DE 15 PX ABAIXO DA CAIXA PARA CRIAR OS BOTOES 
              client.println("</tr><tr height=\"15\"><td colspan=2></td></tr><tr>"); 



             // CRIAR BOTAO OK
              client.println("<td align=center><input name=\"button\" id=\"loginBtn\" type=\"button\" onclick=\"onlogin()\" value=\"  OK  \" class=\"buttonX\"/></td>");
             // CRIAR BOTAO CANCELA
             client.println("<td align=center><input class=\"buttonX\" id=\"rewBtn\" type=\"reset\" value=\"Cancela\"/></td>");
             
             
             
             
             
  
             
             
             
                          
                          
                         client.println("</BODY>");
                 	client.println("</HTML>");
	

                        
                        
                        
                        
                          client.stop();
                          
                         
                     
         } // fecha se c == /n 
       } // fecha se client available
      
   } // fecha whilie client connected
      
 } // fecha if client 
} //Fecha loop





