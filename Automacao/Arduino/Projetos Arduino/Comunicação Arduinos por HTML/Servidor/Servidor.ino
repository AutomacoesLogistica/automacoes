#include <SPI.h>
#include <UIPEthernet.h>

/*CONFIGURACION DE LOS PARAMETROS ETHERNET SERVIDOR*/

byte mac[] = { 0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED };
// byte ip[] = { 192, 168, 1, 123 }; OTRA FORMA DE ESCRIBIR LA DIRECCIÓN IP
IPAddress ip(192, 168, 2, 125);                      // DIRECCIÓN IP ASIGNADA AL SERVIDOR
byte gateway[] = { 192, 168, 2, 1 };                 // LA DIRECCIÓN DE PUERTA DE ENLACE AL ROUTER
byte subnet[] = { 255, 255, 255, 0 };                // LA MÁSCARA SUBNET DEL ROUTER

EthernetServer server = EthernetServer(12535);       // CREA UN SERVIDOR QUE ESTA ATENTO A CONEXIONES ENTRANTES POR UN PUERTO DADO

void setup()
{
  Ethernet.begin(mac, ip, gateway, subnet);          // INICIA LA LIBRERÍA ETHERNET Y LA CONFIGURACIÓN DE LA RED
  server.begin();                                    // INDICA AL SERVIDOR QUE COMIENCE A RECIBIR CONEXIONES ENTRANTES

  pinMode(4, OUTPUT);                                // CONFIGURA EL PIN 4 DE ARDUINO COMO SALIDA
  pinMode(3, OUTPUT);                                // CONFIGURA EL PIN 3 DE ARDUINO COMO SALIDA
  digitalWrite(4, HIGH);                             // DESHABILITA LA MEMORIA SD
  Serial.begin(9600);                                // COMIENZA LA COMUNICACIÓN SERIAL A 9600 BAUDIOS
  Serial.print("server is at ");                     // IMPRIME EN EL MONITOR SERIAL
  Serial.println(Ethernet.localIP());                // IMPRIME LA IP LOCAL EN EL MONITOR SERIAL
}

void loop()
{
  EthernetClient client = server.available();        // COMIENZA A LEER LO QUE ESTA ENTRANDO EN EL BUFFER DEL SERVIDOR
  if (client)
  { // SI EL CLIENTE ESTA CONECTADO.... ENTONCES.....
    Serial.println("client connected");              // IMPRIME EN EL PUERTO SERIAL
    while (client.connected())                       // MIENTRAS EL CLIENTE ESTÉ CONECTADO..... HACE.....
    {
      int c = client.read();                       // CREA LA VARIALBE DE TIPO ENTERO "C" EN DONDE SE ALMACENA LO LEIDO EN EL BUFFER
      if (c == 'P')                                // SI EL ENTERO "C" ES IGUAL AL VALOR ASCII 80 QUE EQUIVALE AL VALOR 'P'
      {
        Serial.println(c);                           // IMPRIME EN EL MONITOR SERIAL EL VALOR DE LA VARIABLE "C"
        digitalWrite(3, HIGH);                       // ENTONCES ASIGNA EL VALOR "HIGH" O 5 VOLTS AL PIN 3 DE ARDUINO
        delay(2000);                                 // DEMORA 2 SEGUNDOS
        digitalWrite(3, LOW);                        // ASIGNA EL VALOR "LOW" O 0 VOTLS AL PIN 3 DE ARDUINO (ENCIENDE Y APAGA EL LED)
      }
    }
    delay(500);
  }
}
