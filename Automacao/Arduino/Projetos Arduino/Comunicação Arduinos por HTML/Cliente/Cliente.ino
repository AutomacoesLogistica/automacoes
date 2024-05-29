#include <SPI.h>
#include <UIPEthernet.h>

/*CONFIGURACION DE LOS PARAMETROS ETHERNET CLIENTE*/

byte mac[] = { 0x90, 0xA2, 0xDA, 0x00, 0x2F, 0xE4 };
// byte ip[] = { 192, 168, 2, 178 };  OTRA FORMA DE COLOCAR LA DIRECCION IP
IPAddress ip(192, 168, 2, 178);
byte server[] = { 192, 168, 2, 125 };                 // IP DEL ARDUINO SERVIDOR
int SW;                                               // CREA LA VARIABLE DE TIPO ENTERO "SW"

EthernetClient client;                                // CREA UN CLIENTE, QUE EN ESTE CASO SE LLAMA "client"

void setup()
{
  Ethernet.begin(mac, ip, server);                    // INICIA LA LIBRERÍA ETHERNET Y LA CONFIGURACIÓN DE LA RED
  pinMode(3, INPUT);                                  // CONFIGURA EL PIN 3 DE ARDUINO COMO UNA ENTRADA DIGITAL
  pinMode(4, OUTPUT);                                 // CONFIGURA EL PIN 4 COMO SALIDA DIGITAL (sd)
  digitalWrite(4, HIGH);                              // COLOCA EL PIN 4 DE LA ARDUINO EN UN NIVEL LÓGICO ALTO
  delay(100);
  Serial.begin(9600);                                 // COMIANZA LA COMUNICACIÓN SERIAL A 9600 BAUDIOS DE VELOCIDAD
  client.flush();                                     // DESCARTA TODOS LOS DATOS ALMACENADOS EN EL BUFFER
  delay(500);
}

void loop()
{
  if (digitalRead(3) == LOW)                          // SI EL PIN DIGITAL 3 ESTA EN BAJO....... ENTONCES.....
  {
    Serial.flush();                                     // LIMPIA EL BUFFER DEL MONITOR SERIAL
    Serial.print("Esperando el boton");                 // IMPRIME EN EL MONITOR SERIAL
  }
  else                                              // CASO CONTRARIO A LA CONDICIÓN INICIAL
  {
    Serial.println("Entrada 3 en alto");              // IMPRIME EN EL MONITOR SERIAL
    client.flush();                                   // NUEVAMENTE LIMPIA LOS DATOS DEL BUFFER DE DATOS DE LA CONEXIÓN ETHERNET
    client.connect(server, 12535);                    // CONECTA EL CLIENTE AL SERVIDOR POR SU IP Y POR EL PUERTO ESPECIFICADO
    Serial.println("connected");                      // IMPRIME EN MONITO SERIAL
    delay(100);
    SW =  client.write('P');                          // LE ASIGNA LA VARIABLE "SW" EL VALOR QUE SE ESCRIBIRÁ EN EL SERVIDOR
    Serial.println(SW);                               // IMPRIME EL VALOR DE RETORNO DE LA FUNCIÓN WRITE() QUE ES EN BYTES
    delay(1000);
  }
}
