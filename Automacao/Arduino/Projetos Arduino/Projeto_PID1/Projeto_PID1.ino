class PID
{
  public:
	double Erro;
	double Amostra;
	double Ultima_Amostra;
	double kP, kI, kD;      
	double Controle_P, Controle_I, Controle_D;
	double Controle_PID;
	
	double setPoint;
	long Ultimo_Processamento;
	
	PID(double _kP, double _kI, double _kD)
	{
		kP = _kP;
		kI = _kI;
		kD = _kD;
	}
	
	
	
	void addNovaAmostra(double _Amostra)
	{
		Amostra = _Amostra;
	}
	
	void setSetPoint(double _setPoint)
	{
		setPoint = _setPoint;
	}
	
	double Processamento_PID()
	{
	 // Implementação PID
	 Erro = setPoint - Amostra;
	 
	 
	 float Fator_Tempo = (millis() - Ultimo_Processamento) / 1000.0;
	 Ultimo_Processamento = millis();
	 //P
	 Controle_P = Erro * kP;
	 //I
   Controle_I = Controle_I + (Erro * kI) * Fator_Tempo;
   //D
	 Controle_D = ( Ultima_Amostra - Amostra ) * kD / Fator_Tempo;
   Ultima_Amostra = Amostra;
	 // Soma tudo
	 Controle_PID = Controle_P + Controle_I + Controle_D;
   return Controle_PID;
	} // Fecha double process

}; // Não retirar o ; pois ele fecha o class



#define pSENSOR         A1
#define pCONTROLE       3

PID meuPid(1.0, 0, 0); // Constantes kp, ki e kd
int controlePwm = 50;

void setup() 
{
	Serial.begin(9600);
	pinMode(pSENSOR, INPUT);
	pinMode(pCONTROLE, OUTPUT);
}



void loop() {
	
	// Lê temperatura
	double temperatura = analogRead(pSENSOR);
	 temperatura = map(temperatura, 0, 1023, 0, 100); //Cria um map proporcional
	
	// Manda pro objeto PID!
	meuPid.addNovaAmostra(temperatura);
	
	
	// Converte para controle
	controlePwm = (meuPid.Processamento_PID() + 50);
	// Saída do controle
	analogWrite(pCONTROLE, controlePwm);
	
}
