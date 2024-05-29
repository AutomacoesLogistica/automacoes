/*
 * HTTP Client POST Request
 * Copyright (c) 2018, circuits4you.com
 * All rights reserved.
 * https://circuits4you.com 
 * Connects to WiFi HotSpot. */

#include <ESP8266WiFi.h>
#include <WiFiClient.h> 
#include <ESP8266WebServer.h>
#include <ESP8266HTTPClient.h>



//Web/Server address to read/write from 
const char *host = "10.10.25.229";   //https://circuits4you.com website or IP address of server

//=======================================================================
//                    Power on setup
//=======================================================================

IPAddress staticIP(10,10,25,87);
IPAddress gateway(10,10,25,1);
IPAddress mascara(255,255,255,0);
const char *Usuario     = "GAGF";
const char *Senha = "logistica2019@";

void setup() {
  delay(1000);
  Serial.begin(115200);
  delay(1000);
  WiFi.mode(WIFI_STA);
  WiFi.begin(Usuario, Senha);
   WiFi.config(staticIP, gateway, mascara); 
  Serial.println("");

  Serial.print("Connecting");
  // Wait for connection
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

  //If connection successful show IP address in serial monitor
  Serial.println("");
  Serial.print("Connected to ");
  Serial.println(Usuario);
  Serial.print("IP address: ");
  Serial.println(WiFi.localIP());  //IP address assigned to your ESP
}

//=======================================================================
//                    Main Program Loop
//=======================================================================
void loop() {
  HTTPClient http;    //Declare object of class HTTPClient

  String ADCData, station, postData;
  
  station = "A";

  String msg = "testando o envio dos dados";
  //Post Data
  
  
  http.begin("http://10.10.25.229/Teste/postdemo.php");              //Specify request destination
  http.addHeader("Content-Type", "application/x-www-form-urlencoded");    //Specify content-type header

  String httpCode = "";
  httpCode = http.POST("status=" + msg + "&station=" + station);   //Send the request
  
  String payload = http.getString();    //Get the response payload
  
  //Serial.println(httpCode);   //Print HTTP return code
  Serial.println(payload);    //Print request response payload

  http.end();  //Close connection
  
  delay(5000);  //Post Data at every 5 seconds
}
//=======================================================================
