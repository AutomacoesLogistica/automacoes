

#include "Arduino.h"
#include "SoftwareSerial.h"
#include "DFRobotDFPlayerMini.h"

//Inicia a serial por software nos pinos 10 e 11
SoftwareSerial mySoftwareSerial(10, 11); // RX, TX

DFRobotDFPlayerMini myDFPlayer;

char buf;
int buf1;
int pausa = 0;
int equalizacao = 0;

void setup()
{
  //Comunicacao serial com o modulo
  mySoftwareSerial.begin(9600);
  //Inicializa a serial do Arduino
  Serial.begin(115200);

  //Verifica se o modulo esta respondendo e se o
  //cartao SD foi encontrado
  Serial.println();
  Serial.println(F("DFRobot DFPlayer Mini"));
  Serial.println(F("Inicializando modulo DFPlayer... (3~5 segundos)"));
  if (!myDFPlayer.begin(mySoftwareSerial))
  {
    Serial.println(F("Nao inicializado:"));
    Serial.println(F("1.Cheque as conexoes do DFPlayer Mini"));
    Serial.println(F("2.Insira um cartao SD"));
    while (true);
  }
  Serial.println();
  Serial.println(F("Modulo DFPlayer Mini inicializado!"));

  //Definicoes iniciais
  myDFPlayer.setTimeOut(500); //Timeout serial 500ms
  myDFPlayer.volume(18); //Volume 5
  myDFPlayer.EQ(0); //Equalizacao normal
  //myDFPlayer.play(1); // Inicia módulo já tocando música 1
  
  //Mostra o menu de comandos
  Serial.println();
  Serial.print("Numero de arquivos no cartao SD: ");
  Serial.println(myDFPlayer.readFileCounts(DFPLAYER_DEVICE_SD));
  menu_opcoes();
}

void loop()
{
 
  //Aguarda a entrada de dados pela serial
  while (Serial.available() > 0)
  {
    buf = Serial.read();

     if ((buf >= '1') && (buf <= '9'))
    {
      Serial.print("Reproduzindo musica: ");
      Serial.println(buf);
      buf = buf - 48;
      myDFPlayer.play(buf);
      menu_opcoes();
    }
   
    //Reproducao
   
    
    //Parada
    if (buf == 's')
    {
      myDFPlayer.stop();
      Serial.println("Musica parada!");
      menu_opcoes();
    }
    
    //Pausa/Continua a musica
    if (buf == 'p')
    {
      pausa = !pausa;
      if (pausa == 0)
      {
        Serial.println("Continua musica...");
        myDFPlayer.start();
      }
      if (pausa == 1)
      {
        Serial.println("Musica pausada...");
        myDFPlayer.pause();
      }
      menu_opcoes();
    }
    
     //Seleciona equalizacao
    if (buf == 'e')
    {
      equalizacao++;
      myDFPlayer.EQ(equalizacao);
      Serial.print("Equalizacao: ");
      Serial.println(equalizacao);
      if (equalizacao == 6)
      {
        equalizacao = 0;
      }
      if(equalizacao == 0){
        Serial.println("0 = Normal");
      }
       if(equalizacao == 1){
        Serial.println("1 = Pop");
      }
       if(equalizacao == 2){
        Serial.println("2 = Rock");
      }
       if(equalizacao == 3){
        Serial.println("3 = Jazz");
      }
       if(equalizacao == 4){
        Serial.println("4 = Classic");
      }
       if(equalizacao == 5){
        Serial.println("5 = Bass");
      }
      
      
   
    }
    
    //Aumenta volume
    if (buf == '+')
    {
      myDFPlayer.volumeUp();
      Serial.print("Volume atual:");
      Serial.println(myDFPlayer.readVolume());
      menu_opcoes();
    }
     if (buf == '<')
    {
      myDFPlayer.previous(); 
      Serial.println("Previous:");
      Serial.print("Faixa atual:");
      Serial.println(myDFPlayer.readCurrentFileNumber()-1); 
      menu_opcoes();
    }
     if (buf == '>')
    {
     myDFPlayer.next(); 
      Serial.println("next:");
      Serial.print("Faixa atual:");
      Serial.println(myDFPlayer.readCurrentFileNumber()+1); 
      menu_opcoes();
    }
    
    //Diminui volume
    if (buf == '-')
    {
      myDFPlayer.volumeDown();
      Serial.print("Volume atual:");
      Serial.println(myDFPlayer.readVolume());
      menu_opcoes();
    }
   if (buf == 'c')
    {
      
      Serial.print("Faixa atual:");
      Serial.println(myDFPlayer.readCurrentFileNumber()); 
      menu_opcoes();
    }
      if (buf == 'l')
    {
      myDFPlayer.enableLoop(); //enable loop.
      Serial.println("Loop ativado");
      menu_opcoes();
    }
      if (buf == 'd')
    {
      myDFPlayer.disableLoop(); //enable loop.
      Serial.println("Loop desativado");
      menu_opcoes();
    }
     
  }
  if (buf == '*') {
     
   ler();
    }
   
}

void menu_opcoes()
{/*
  Serial.println();
  Serial.println(F("=================================================================================================================================="));
  Serial.println(F("Comandos:"));
  Serial.println(F(" [1-9] Para selecionar o arquivo MP3"));
  Serial.println(F(" [s] parar reproducao"));
  Serial.println(F(" [p] pausa/continua a musica"));
  Serial.println(F(" [e] seleciona equalizacao"));
  Serial.println(F(" [c] mostra a faixa atual"));
  Serial.println(F(" [+ or -] aumenta ou diminui o volume"));
  Serial.println(F(" [< or >] avança ou retrocede a faixa"));
  Serial.println(F(" [l] enable loop"));
  Serial.println(F(" [d] disable loop"));
  Serial.println();
   Serial.println(F("================================================================================================================================="));
*/
}
void ler()
{
   while (Serial.available() > 0) {

    // look for the next valid integer in the incoming serial stream:
    
    int a = Serial.parseInt();
    // do it again:
   Serial.print("reproduzindo faixa: "); 
 Serial.println(a); 
 myDFPlayer.play(a); 
    // look for the newline. That's the end of your
    // sentence:
    
  }
}
