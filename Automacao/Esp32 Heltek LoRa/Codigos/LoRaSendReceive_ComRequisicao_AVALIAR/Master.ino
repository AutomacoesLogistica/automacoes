//Compila apenas se MASTER estiver definido no arquivo principal
#ifdef MASTER

//Intervalo entre os envios
#define INTERVAL 500

//Tempo do último envio
long lastSendTime = 0;

void setup(){
  Serial.begin(115200);
  //Chama a configuração inicial do display
  setupDisplay();
  //Chama a configuração inicial do LoRa
  setupLoRa();

  display.clear();
  display.drawString(0, 0, "Master");
  display.display();
}

void loop(){
  //Se passou o tempo definido em INTERVAL desde o último envio
  if (millis() - lastSendTime > INTERVAL){
    //Marcamos o tempo que ocorreu o último envio
    lastSendTime = millis();
    //Envia o pacote para informar ao Slave que queremos receber os dados
    send();
  }

  //Verificamos se há pacotes para recebermos
  receive();
}

void send(){
  //Inicializa o pacote
  LoRa.beginPacket();
  //Envia o que está contido em "GETDATA"
  LoRa.print(GETDATA);
  //Finaliza e envia o pacote
  LoRa.endPacket();
}

void receive(){
  //Tentamos ler o pacote
  int packetSize = LoRa.parsePacket();
  
  //Verificamos se o pacote tem o tamanho mínimo de caracteres que esperamos
  if (packetSize > SETDATA.length()){
    String received = "";
    //Armazena os dados do pacote em uma string
    while(LoRa.available()){
      received += (char) LoRa.read();
    }
    //Verifica se a string possui o que está contido em "SETDATA"
    int index = received.indexOf(SETDATA);
    if(index >= 0){
      //Recuperamos a string que está após o "SETDATA",
      //que no caso serão os dados de nosso interesse
      String data = received.substring(SETDATA.length());
      //Tempo que demorou para o Master criar o pacote, enviar o pacote,
      //o Slave receber, fazer a leitura, criar um novo pacote, enviá-lo
      //e o Master receber e ler
      String waiting = String(millis() - lastSendTime);
      //Mostra no display os dados e o tempo que a operação demorou
      display.clear();
      display.drawString(0, 0, "Recebeu: " + data);
      display.drawString(0, 10, "Tempo: " + waiting + "ms");
      display.display();
    }
  }
}

#endif
