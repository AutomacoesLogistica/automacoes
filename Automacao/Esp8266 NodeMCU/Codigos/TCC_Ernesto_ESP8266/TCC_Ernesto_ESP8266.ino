#include <ESP8266WiFi.h> 
const char* ssid = "TCC_ERNESTO";
const char* password = "netopires2612";

//Mapeamento de pinos do NodeMCU
#define ledPinD0    16
#define ledPinD1    5
#define ledPinD2    4
#define ledPinD3    0
#define ledPinD4    2
#define ledPinD5    14
#define ledPinD6    12
#define ledPinD7    13
#define ledPinD8    15

  int valueD0 = HIGH;
  int valueD1 = HIGH;
  int valueD2 = HIGH;
  int valueD3 = HIGH;
  int valueD4 = HIGH;
  int valueD5 = HIGH;
  int valueD6 = HIGH;
  int valueD7 = HIGH;
  int valueD8 = HIGH; 
  int cont = 0;

WiFiServer server(80);

void setup() {
  Serial.begin(9600);
  delay(10);

  pinMode(ledPinD0, OUTPUT);
  pinMode(ledPinD1, OUTPUT);
  pinMode(ledPinD2, OUTPUT);
  pinMode(ledPinD3, OUTPUT);
  pinMode(ledPinD4, OUTPUT);
  pinMode(ledPinD5, OUTPUT);
  pinMode(ledPinD6, OUTPUT);
  pinMode(ledPinD7, OUTPUT);
  pinMode(ledPinD8, OUTPUT);
   
  digitalWrite(ledPinD0, HIGH);
  digitalWrite(ledPinD1, HIGH);
  digitalWrite(ledPinD2, HIGH);
  digitalWrite(ledPinD3, HIGH);
  digitalWrite(ledPinD4, HIGH);
  digitalWrite(ledPinD5, HIGH);
  digitalWrite(ledPinD6, HIGH);
  digitalWrite(ledPinD7, HIGH);
  digitalWrite(ledPinD8, HIGH);
  //-------------------------
  Serial.println();
  Serial.println();
  Serial.print("Connecting to ");
  Serial.println(ssid);
  WiFi.begin(ssid, password);

  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.println("WiFi connected");

  server.begin();
  Serial.println("Server started");

  //------Monitor Serial IDE Arduino------
  Serial.print("Use this URL to connect: ");
  Serial.print("http://");
  Serial.print(WiFi.localIP());
  Serial.println("/");
}

void loop() {
  WiFiClient client = server.available();
  if (!client) {
    return;
  }
  //------------------------
  Serial.println("new client");
  while(!client.available()){
  delay(1);
  }
  //-------------------------
  String request = client.readStringUntil('\r');
  Serial.println(request);
  client.flush();
  //--------NodeMCU ESP8266 recebe do Android------
  if (request.indexOf("/ledPinD0=ON") != -1)  {
    digitalWrite(ledPinD0, LOW);//Coloca pino digital D0 em nível lógico "0";
    valueD0 = LOW;//Atribui nivel lógico "0" á variável valueD0;  
  }
  if (request.indexOf("/ledPinD0=OFF") != -1)  {
    digitalWrite(ledPinD0, HIGH);//Coloca pino digital D0 em nível lógico "1";
    valueD0 = HIGH;//Atribui nivel logico "1" á variável valueD0.
  }
  //--------------------------
  if (request.indexOf("/ledPinD1=ON") != -1)  {
    digitalWrite(ledPinD1, LOW);
    valueD1 = LOW;
  }
  if (request.indexOf("/ledPinD1=OFF") != -1)  {
    digitalWrite(ledPinD1, HIGH);
    valueD1 = HIGH;
  }
  //--------------------------
  if (request.indexOf("/ledPinD2=ON") != -1)  {
    digitalWrite(ledPinD2, LOW);
    valueD2 = LOW;
  }
  if (request.indexOf("/ledPinD2=OFF") != -1)  {
    digitalWrite(ledPinD2, HIGH);
    valueD2 = HIGH;
  }
  //--------------------------
  if (request.indexOf("/ledPinD3=ON") != -1)  {
    digitalWrite(ledPinD3, LOW);
    valueD3 = LOW;
  }
  if (request.indexOf("/ledPinD3=OFF") != -1)  {
    digitalWrite(ledPinD3, HIGH);
    valueD3 = HIGH;
  }
  //--------------------------
  if (request.indexOf("/ledPinD4=ON") != -1)  {
    digitalWrite(ledPinD4, LOW);
    valueD4 = LOW;
  }
  if (request.indexOf("/ledPinD4=OFF") != -1)  {
    digitalWrite(ledPinD4, HIGH);
    valueD4 = HIGH;
  }
  //--------------------------
  if (request.indexOf("/ledPinD5=ON") != -1)  {
    digitalWrite(ledPinD5, LOW);
    valueD5 = LOW;
  }
  if (request.indexOf("/ledPinD5=OFF") != -1)  {
    digitalWrite(ledPinD5, HIGH);
    valueD5 = HIGH;
  }
  //--------------------------
  if (request.indexOf("/ledPinD6=ON") != -1)  {
    digitalWrite(ledPinD6, LOW);
    valueD6 = LOW;
  }
  if (request.indexOf("/ledPinD6=OFF") != -1)  {
    digitalWrite(ledPinD6, HIGH);
    valueD6 = HIGH;
  }
  //--------------------------
  if (request.indexOf("/ledPinD7=ON") != -1)  {
    digitalWrite(ledPinD7, LOW);
    valueD7 = LOW;
  }
  if (request.indexOf("/ledPinD7=OFF") != -1)  {
    digitalWrite(ledPinD7, HIGH);
    valueD7 = HIGH;
  }
 //--------------------------
  if (request.indexOf("/ledPinD8=ON") != -1)  {
    digitalWrite(ledPinD8, LOW);
    valueD8 = LOW;
  }
  if (request.indexOf("/ledPinD8=OFF") != -1)  {
    digitalWrite(ledPinD8, HIGH);
    valueD8 = HIGH;
  }
  //--------------------------
  client.println("HTTP/1.1 200 OK");
  client.println("Content-Type: text/html");
  client.println(""); //  do not forget this one
  client.println("<!DOCTYPE HTML>");
  client.println("<html>");
  //----------------------------------------------------------
  client.print("<font size=6>");//Tamanho da fonte </font>
  client.print("<font color=#FF0000>");//Color Red
  client.print("Blog> http://sergioarduino.blogspot.com.br/");
  client.println("<br />");
  //-----------------------------
  client.print("<font size=6>");//Tamanho da fonte </font>
  client.print("<font color=#0000FF>");//Color Blue.
  client.print("Receiving status from ESP8266");
  client.println("<br/>");
  //client.println("<br />");
  //----------------------------
  client.print("<font size=10>");//Tamanho da fonte </font>
  client.print("<font color=#008000>");//Color Green. 
  //---------NodeMCU ESP8266 envia para o Android--------
  client.println("<br><br>");//Close and Open. 
  if(valueD0 == LOW) {//Testa se a variável valueD0 = nível lógico "0";
  client.print("/ledPinD0=ON");//Modifica o botão Device1 para "ON";
  } else {//Caso contrário;
    client.print("/ledPinD0=OFF");//Modifica o botão Device1 para "OFF";
  }
  client.println("<br />");
  //------------------------- 
  if(valueD1 == LOW) {
  client.print("/ledPinD1=ON");
  } else {
  client.print("/ledPinD1=OFF");
  }   
  client.println("<br />");
  //-------------------------
  if(valueD2 == LOW) {
  client.print("/ledPinD2=ON");
  } else {
  client.print("/ledPinD2=OFF");
  }   
  client.println("<br />");
  //------------------------- 
  if(valueD3 == LOW) {
  client.print("/ledPinD3=ON");
  } else {
  client.print("/ledPinD3=OFF");
  } 
  client.println("<br />");
  //------------------------- 
  if(valueD4 == LOW) {
  client.print("/ledPinD4=ON");
  } else {
  client.print("/ledPinD4=OFF");
  } 
  client.println("<br />");
  //-------------------------
  if(valueD5 == LOW) {
  client.print("/ledPinD5=ON");
  } else {
  client.print("/ledPinD5=OFF");
  }   
  client.println("<br />");
  //-------------------------
  if(valueD6 == LOW) {
  client.print("/ledPinD6=ON");
  } else {
  client.print("/ledPinD6=OFF");
  }   
  client.println("<br />");
  //-------------------------
  if(valueD7 == LOW) {
  client.print("/ledPinD7=ON");
  } else {
  client.print("/ledPinD7=OFF");
  }  
  client.println("<br />");
  //-------------------------
  if(valueD8 == LOW) {
  client.print("/ledPinD8=ON");
  } else {
  client.print("/ledPinD8=OFF");
  }  
  client.println("<br />"); 
  
  client.println("</html>");
 //-------------------------------------- 
  delay(1);
  Serial.println("Client disonnected");
  Serial.println(""); 
}

