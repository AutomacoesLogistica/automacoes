/*
 * 
 * 
 * 
 * 
 * AINDA SOMENTE O AUDIO SAINDO
 * 
 * 
 * RECEBE NA PORTA A0 E ENVIA A SAIDA PRO AUTO FALANTE NAS SAIDAS 9 E 10
 * 
 */


#define SAMPLE_RATE 320000
volatile unsigned int sampleData;



void setup() {
  
  pinMode(9,OUTPUT);
  pinMode(10,OUTPUT);
  
  /******* Set up timer1 ********/
  ICR1 = 10* (1600000/SAMPLE_RATE);                 // For PWM generation. Timer TOP value.
 
  TCCR1A = _BV(COM1A1) | _BV(COM1B1) | _BV(COM1B0);  //Enable the timer port/pin as output
  TCCR1A |= _BV(WGM11);                              //WGM11,12,13 all set to 1 = fast PWM/w ICR TOP
  TCCR1B = _BV(WGM13) | _BV(WGM12) | _BV(CS10);      //CS10 = no prescaling

  /******** Set up the ADC ******/
  ADMUX = _BV(REFS0);                                // Set analog reference to 5v
  ADCSRB |= _BV(ADTS1) | _BV(ADTS2);                 // Attach ADC to TIMER1 Overflow interrupt
    
  byte prescaleByte = 0;                             // Adjusts the ADC prescaler depending on sample rate for best quality audio

  if(      SAMPLE_RATE < 8900){  prescaleByte = B00000111;} //128
  else if( SAMPLE_RATE < 18000){ prescaleByte = B00000110;} //ADC division factor 64 (16MHz / 64 / 13clock cycles = 19230 Hz Max Sample Rate )
  else if( SAMPLE_RATE < 27000){ prescaleByte = B00000101;} //32  (38461Hz Max)
  else if( SAMPLE_RATE < 65000){ prescaleByte = B00000100;} //16  (76923Hz Max)
  else   {                       prescaleByte = B00000011;} //8  (fast as hell)

  ADCSRA = prescaleByte;                        // Set the prescaler
  ADCSRA |= _BV(ADEN) | _BV(ADATE);             // ADC Enable, Auto-trigger enable


  TIMSK1 = _BV(TOIE1);          //Enable the TIMER1 interrupt to begin everything
}




ISR(TIMER1_OVF_vect){
  
  OCR1A = OCR1B = ADCL | ADCH << 8;  // Read the ADC values directly into the timer compare register.
  
}



void loop() {


}

