
#include <SPI.h> //Inclui a biblioteca SPI.h
#include <Ethernet.h> //Inclui a biblioteca Ethernet.h





// Configurações para o Ethernet Shield
byte mac[] = { 
  0x90, 0xA2, 0xDA, 0x0D, 0x83, 0xEA }; // Entre com o valor do MAC

IPAddress ip(192,168,2,5); // Configure um IP válido 
byte gateway[] = { 
  192 , 168, 1, 1 }; //Entre com o IP do Computador onde a Câmera esta instalada
byte subnet[] = { 
  255, 255, 255, 0 }; //Entre com a Máskara de Subrede
EthernetServer server(8085); //Inicializa a biblioteca EthernetServer com os valores de IP acima citados e configura a porta de acesso(80)
//======================================================================================
float RPM;
float A;
int T;
float PH;


void setup()
{

  Ethernet.begin(mac, ip);// Inicializa o Server com o IP e Mac atribuido acima

}



void loop()
{

  RPM = analogRead(A0)*1.75953079;
  A = analogRead(A1)*0.0342131;
  T = analogRead(A2)*0.97751711;
  PH = (analogRead(A3)*(0.00488759))+7;




  EthernetClient client = server.available();// Verifica se tem alguém conectado

  if (client)
  {

    boolean currentLineIsBlank = true; // A requisição HTTP termina com uma linha em branco Indica o fim da linha
    String valPag;

    while (client.connected())
    {



      //Inicia página HTML

      client.println("HTTP/1.1 200 OK");
      client.println("Content-Type: text/html");
      client.println();

      client.print("<HTML>");
      client.println("<BR><size=20><img src=https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcSobtNrNiJvQ628umpvNBvmYkQE2eLnkTRyQ9TerfwujeVFWuVvzg><img src=https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcSobtNrNiJvQ628umpvNBvmYkQE2eLnkTRyQ9TerfwujeVFWuVvzg><img src=https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcSobtNrNiJvQ628umpvNBvmYkQE2eLnkTRyQ9TerfwujeVFWuVvzg>");
      //=========================================================================================================================

      //Display da Temperatura


      client.print("<BR><BR>");
      client.print("<font size=12> <B> ROTACAO  :</B> </font>; <font size=28>  <font color=\"#ff0000\">  ");
      client.print(RPM,1);
      client.print("      *RPM</font>");
      client.print("<BR><BR>");
      client.print("<font size=12> <B> CORRENTE  : </B> </font> <font size=28>  <font color=\"#ff0000\">  ");
      client.print(A,1);
      client.print("      *A</font>");
      client.print("<BR><BR>");
      client.print("<font size=12> <B> TORQUE  : </B> </font> <font size=28>  <font color=\"#ff0000\">  ");
      client.print(T,1);
      client.print("      *Kgf</font>");
      client.print("<BR><BR>");
      client.print("<font size=12> <B> PH  : </B> </font> <font size=28>  <font color=\"#ff0000\">  ");
      client.print(PH,1);
      client.print("      *pH</font>");


      //=========================================================================================================================      

      client.print("<BR><BR><BR><BR>");

      //COD ATUAL
      client.print("<B><center><font size=14>BRUNO GONCALVES</font></B> <BR> <font size=9> ");
      client.print("Tecnico em Eletronica  Tel : (31) 8849-4604 <BR> Conselheiro Lafaiete, MG Cep 36400-000</font></center>");



      //=========================================================================================================================

      client.print(" <meta http-equiv=\"refresh\" content=\"1; url=http://192.168.1.122/\"> ");

      client.println("</HTML>");

      break;

      //Fecha if (c == '\n' && currentLineIsBlank)

    } //Fecha if (client.available())

  } //Fecha While (client.connected())

  delay(3);// Espera um tempo para o navegador receber os dados
  client.stop(); // Fecha a conexão

  //Fecha if(client)

} //Fecha loop
