/*
  Web Server
 
 Um web server simples que mostra os valores das portas analogicas
 usando um shield Arduino Wiznet Ethernet. 
 
 Circuit:
 * Ethernet shield conectado nas portas 10, 11, 12, 13
 * Entradas analogicas conectadas nas portas A0 ate A5 (opcional)
 
 criado em 18 Dez 2009
 por David A. Mellis
 modificado 9 Abr 2012
 por Tom Igoe
 
 */

#include <SPI.h>
#include <Ethernet.h>

// Entre com um endereco MAC e um endereco IP para sua controladora, abaixo.
// O endereco IP sera dependente da rede local:
byte mac[] = { 
  0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED };
IPAddress ip(192,168,1,177);

// Inicia a biblioteca Ethernet server
// com o endereco IP e a porta que voce deseja usar
// (porta 80 e padrao para HTTP):
EthernetServer server(80);

void setup() {
 // Abre a comunicacao serial e espera pela abertura:
  Serial.begin(9600);
   while (!Serial) {
    ; // espera pela abertura da porta para conectar. Necessario apenas para o Leonardo
  }


  // inicia a conexao Ethernet e o servidor:
  Ethernet.begin(mac, ip);
  server.begin();
  Serial.print("servidor esta em ");
  Serial.println(Ethernet.localIP());
}


void loop() {
  // aguarda por clientes chegando
  EthernetClient client = server.available();
  if (client) {
    Serial.println("novo cliente");
    // uma requisicao http termina com uma linha em branco
    boolean currentLineIsBlank = true;
    while (client.connected()) {
      if (client.available()) {
        char c = client.read();
        Serial.write(c);
        // se voce receber um fim de linha (recebendo um caractere de 
        // nova linha) e esta esta vazia, entao a requisicao http terminou,
        // entao voce pode enviar a resposta
        if (c == '\n' && currentLineIsBlank) {
          // envia um cabecalho padrao http como resposta
          client.println("HTTP/1.1 200 OK");
          client.println("Content-Type: text/html");
          client.println("Connnection: close");
          client.println();
          
          client.println("<H1>Bruno Goncalves/H1>");
          break;
        }
        if (c == '\n') {
          // iniciando uma nova linha
          currentLineIsBlank = true;
        } 
        else if (c != '\r') {
          // se recebermos um caractere na nova linha, significa que ela nao e vazia
          currentLineIsBlank = false;
        }
      }
    }
    // da tempo ao navegador para lidar com os dados recebidos
    delay(1);
    // fecha a conexao:
    client.stop();
    Serial.println("cliente desconectado");
  }
}
