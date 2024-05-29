/*
 * 
 * 
 * Codigo padrao para atualizar via ota - web service arquivo .bin
 * 
 * para gerar o arquivo basta clicar em Sketch>Exportar Binario Compidado, em seguida,
 * clicar em Sketch>Mostrar Pagina do Sketch e abrira a pasta onde foi gerada o arquivo, basta copiar essa URL e no navegador indicar ela!
 * 
 */
#include <ESP8266WiFi.h>
#include <ESP8266WebServer.h>
#include <ESP8266mDNS.h>
#include <ESP8266HTTPUpdateServer.h> //Biblioteca que cria o servico de atualizacÃ£o via wifi (ou Over The Air - OTA)
//Dados para conexao com WIFI
const char* Usuario      = "AutomacaoLOG"; //Nome da rede wifi da sua casa
const char* Senha  = "logistica2019@"; //Senha da rede wifi da sua casa
String local = "teste";

ESP8266HTTPUpdateServer atualizadorOTA; //Este e o objeto que permite atualizacao do programa via wifi (OTA)
ESP8266WebServer servidorWeb(80); //Servidor Web na porta 80

String dispositivo = "ESP8266 teste";
String titulo = "Atualização via OTA - " + dispositivo;
String valor_ip = "xxx.xxx.xxx";
String paginaWeb = "";
String mac = "";

void setup() 
{
  //Se vc ativou o Serial.println, devera descomentar esta linha abaixo tambem.
  Serial.begin(115200);
  ConectarWIFI();
  InicializaMDNS();
  // Iniciar servidor atualizacao OTA
  atualizadorOTA.setup(&servidorWeb);
  servidorWeb.begin();
  Serial.println("O servico de atualizacao remota (OTA) Foi iniciado com sucesso!");
  Serial.print("Abra http://");
  Serial.print(local);
  Serial.println(".local/atualizar no seu browser para iniciar a atualizacao\n");
}


void InicializaMDNS() {
  if (!MDNS.begin(local)) {
   Serial.println("Erro ao iniciar o servico mDNS!");
    while (1) {
      delay(1000);
    }
  }
  Serial.println("O servico mDNS foi iniciado com sucesso!");
  MDNS.addService("http", "tcp", 80);
}

void loop() {
  if (WiFi.status() != WL_CONNECTED) {
    ConectarWIFI();
    InicializaMDNS();
  }
  else {
    servidorWeb.handleClient();
  }
}



void Pagina()
{
 
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// DADOS QUE SERAO EXIBIDOS NO SITE

  paginaWeb = ""
  "<!DOCTYPE html><html>"
  "<head>"
  "<title>OTA</title>"
  "<meta name='viewport' content='width=device-width, initial-scale=1.0'>"
  "<meta charset='UTF-8'>"
  "<meta http-equiv='X-UA-Compatible' content='IE=edge'>"
  "</head>"
  "<body style='margin: 20px; padding: 0px; background-color: #ADD8E6'>"
    "<h1 style='color: #00008B'>"+titulo+"</h1>"
    "<h3>IP: " + valor_ip + "</h3>"
    "<h3>MAC: " + mac + "</h3>" 
    "<h3>Para atualizar o sketch basta abrir <a href='http://"+valor_ip+"/update'>http://"+valor_ip+"/update</a> e pressionar enter!</h3>" 
    "<footer>Desenvolvido por Bruno Gonçalves </footer>"
  "</body>"
  "</html>";

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

  
  servidorWeb.on("/", ChamPaginaWeb);
}//Fecha void Pagina 
void ChamPaginaWeb() {servidorWeb.send(200, "text/html", paginaWeb);}


void ConectarWIFI()
{
 WiFi.begin(Usuario, Senha);
 while (WiFi.status() != WL_CONNECTED)
 {
  delay(100);
 }
 
 valor_ip = WiFi.localIP().toString();
 mac = WiFi.macAddress();
 Pagina();

}
