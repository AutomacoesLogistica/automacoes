#include <UIPEthernet.h>

EthernetServer server = EthernetServer(80);

void setup()
{
 Serial.begin(57600);

 uint8_t mac[6] = {0x00,0x01,0x02,0x03,0x04,0x05};
 IPAddress myIP(192,168,2,93);

 Ethernet.begin(mac,myIP);

 server.begin();
}

void loop()
{
 size_t size;

 if (EthernetClient client = server.available())
 {
 while((size = client.available()) > 0)
 {
 uint8_t* msg = (uint8_t*)malloc(size);
 size = client.read(msg,size);
 Serial.write(msg,size);
 free(msg);
 }
 client.println("<h1>Hello World!</h1>");
 client.stop();
 }
}
