/*
  This sketch is based on the basic MQTT example by
  http://knolleary.github.io/pubsubclient/
*/

#include <SPI.h>
#include <Ethernet.h>
#include <PubSubClient.h>

#define DEBUG 1 // Debug output to serial console

// Device settings
IPAddress deviceIp(192, 168, 0, 43);
byte deviceMac[] = { 0xAB, 0xCD, 0xFE, 0xFE, 0xFE, 0xFE };
char* deviceId  = "sensor01"; // Name of the sensor
char* stateTopic = "home-assistant/sensor01/brightness"; // MQTT topic where values are published
int sensorPin = A0; // Pin to which the sensor is connected to
char buf[4]; // Buffer to store the sensor value
int updateInterval = 1000; // Interval in miliseconds

// MQTT server settings
IPAddress mqttServer(192, 168, 0, 12);
int mqttPort = 1883;

EthernetClient ethClient;
PubSubClient client(ethClient);

void reconnect() {
  while (!client.connected()) {
#if DEBUG
    Serial.print("Attempting MQTT connection...");
#endif
    if (client.connect(deviceId)) {
#if DEBUG
      Serial.println("connected");
#endif
    } else {
#if DEBUG
      Serial.print("failed, rc=");
      Serial.print(client.state());
      Serial.println(" try again in 5 seconds");
#endif
      delay(5000);
    }
  }
}

void setup() {
  Serial.begin(57600);
  client.setServer(mqttServer, mqttPort);
  Ethernet.begin(deviceMac, deviceIp);
  delay(1500);
}

void loop() {
  if (!client.connected()) {
    reconnect();
  }
  client.loop();

  int sensorValue = analogRead(sensorPin);
#if DEBUG
  Serial.print("Sensor value: ");
  Serial.println(sensorValue);
#endif
  client.publish(stateTopic, itoa(sensorValue, buf, 10));
  delay(updateInterval);
}
