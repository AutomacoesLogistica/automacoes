
// --- Mapeamento de Hardware ---
#define ch1   2 //Acelerador > BAIXO: 1084   CENTRO: 1490   CIMA: 1903
#define ch2   3 //Aileron > todo para ESQUERDA:1886   CENTRO: 1495     DIREITA: 1100
#define ch3   4 //Profundor > BAIXO: 1240   CENTRO: 1420   CIMA: 1610
#define ch4   5 //Leme > todo para ESQUERDA:1680   CENTRO: 1480     DIREITA: 1290
#define ch5   6 //Chave GEAR Atuada para cima proximo ao peito: 1084 , atuada para baixo proximo ao chao: 1880



#define manda_tinta 13
#define saida_ed 12
#define rele_saida_ed 11
#define saida_bc 10
#define rele_saida_bc 9


// --- Protótipo das funções auxiliares ---
void read_channels();      //Função para leitura das entradas dos canais
void test_channels();      //Testa os 8 canais do Turnigy9x

 
// --- Declaração de variáveis globais ---

//variáveis para os canais do rádio
int canal_01 = 0, 
    canal_02 = 0, 
    canal_03 = 0, 
    canal_04 = 0, 
    canal_05 = 0;
    
 
 


// --- Configurações iniciais ---
void setup()
{ 
     
  // -- Direção dos I/Os --
  pinMode(ch1, INPUT); //Entrada para o canal 1 do rádio
  pinMode(ch2, INPUT); //Entrada para o canal 2 do rádio
  pinMode(ch3, INPUT); //Entrada para o canal 3 do rádio
  pinMode(ch4, INPUT); //Entrada para o canal 4 do rádio
  pinMode(ch5, INPUT); //Entrada para o canal 5 do rádio

  pinMode(saida_ed, OUTPUT); //Saida para esquerda e direita
  pinMode(rele_saida_ed, OUTPUT); //Saida para rele alimenta esquerda e direita
  digitalWrite(rele_saida_ed,LOW); // Inicia desligado
  pinMode(saida_bc, OUTPUT); //Saida para baixo e cima
  pinMode(rele_saida_bc, OUTPUT); //Saida para rele alimenta baixo e cima
  digitalWrite(rele_saida_bc,LOW); // Inicia desligado
  pinMode(manda_tinta,OUTPUT); // Saida para mandar tinta
  digitalWrite(manda_tinta,LOW);
  
  Serial.begin(9600);            //Inicia comunicação Serial com 9600 de baud rate
   
  
} //end setup


//Loop infinito
void loop()
{
    read_channels(); //Lê os 8 primeiros canais do rádio
   
    test_channels(); //Testa os canais e envia informação para o Serial Monitor
    
    
    delay(100);
    
    
} //end loop


//Funções auxiliares
void read_channels() //Faz a leitura dos 6 primeiros canais do rádio
{
  canal_01 = pulseIn(ch1, HIGH, 25000); //Lê pulso em nível alto do canal 1 e armazena na variável canal_01
  canal_02 = pulseIn(ch2, HIGH, 25000); //Lê pulso em nível alto do canal 2 e armazena na variável canal_02
  canal_03 = pulseIn(ch3, HIGH, 25000); //Lê pulso em nível alto do canal 3 e armazena na variável canal_03
  canal_04 = pulseIn(ch4, HIGH, 25000); //Lê pulso em nível alto do canal 4 e armazena na variável canal_04
  canal_05 = pulseIn(ch5, HIGH, 25000); //Lê pulso em nível alto do canal 5 e armazena na variável canal_05

   

} //end read channels


void test_channels() //Testa os canais via serial monitor (comentar esta função e só chamar quando necessário)
{
  
   /*
      Serial.print("Valor:  ");
      Serial.print(canal_01);
      Serial.print(" | ");
      Serial.print(canal_02);
      Serial.print(" | ");
      Serial.print(canal_03);
      Serial.print(" | ");
      Serial.print(canal_04);
      Serial.print(" | ");
      Serial.print(canal_05);
      Serial.print(" | ");
      Serial.print(canal_06);
      Serial.print(" | ");
      Serial.println("");
      Serial.println("");
      Serial.print("Canal:  ");
      Serial.print("  01  ");
      Serial.print("|");
      Serial.print("  02  ");
      Serial.print("|");
      Serial.print("  03  ");
      Serial.print("|");
      Serial.print("  04  ");
      Serial.print("|");
      Serial.print("  05  ");
      Serial.print("|");
      Serial.print("|");
      Serial.println("");
      Serial.println("");
      
 */
//Aileron > todo para ESQUERDA:1886   CENTRO: 1495     DIREITA: 1100
 if(canal_02 <2000 && canal_02 > 1700) //Desloca para esquerda
 {
  digitalWrite(saida_ed,HIGH); 
  Serial.println("Esquerda");
  digitalWrite(rele_saida_ed,HIGH); // Liga alimentação do motor 
 }
 else if(canal_02 <1350 && canal_02 > 1000) //Desloca para esquerda
 {
  digitalWrite(saida_ed,LOW);
  Serial.println("Direita"); 
  digitalWrite(rele_saida_ed,HIGH); // Liga alimentação do motor
 }
 else if (canal_02 <1550 && canal_02 > 1450) //Centro
 {
  digitalWrite(saida_ed,LOW); // Centro
  digitalWrite(rele_saida_ed,LOW); // Desliga alimentação do motor
 }
   
 //Chave GEAR Atuada para cima proximo ao peito: 1084 , atuada para baixo proximo ao chao: 1880
 //Ativar mandar tinta
 if(canal_05 < 1100)// Acionada proxima ao peito aciona tinta
 {
  digitalWrite(manda_tinta,HIGH);
 }
 else
 {
  digitalWrite(manda_tinta,LOW);
 }


//Profundor > BAIXO: 1240   CENTRO: 1420   CIMA: 1610
//Canal3
if(canal_03 <1300 && canal_03 > 900) //Desce
{
 digitalWrite(saida_bc,HIGH); 
 Serial.println("BAIXO");
 digitalWrite(rele_saida_bc,HIGH); // Liga alimentação do motor 
 }
 else if(canal_03 <1950 && canal_03 > 1550) //CIMA
 {
  digitalWrite(saida_bc,LOW);
  Serial.println("CIMA"); 
  digitalWrite(rele_saida_bc,HIGH); // Liga alimentação do motor
 }
 else if(canal_03 <1380 && canal_03 > 1490) //Centro
 {
  digitalWrite(saida_bc,LOW); // Centro
  digitalWrite(rele_saida_bc,LOW); // Desliga alimentação do motor
 }


} //end test_channels
