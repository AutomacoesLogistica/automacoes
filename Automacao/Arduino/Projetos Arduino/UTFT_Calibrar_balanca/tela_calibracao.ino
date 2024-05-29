void tela_calibracao()
{
 TELA = 1; 
 myGLCD.clrScr();//limpa a tela
  
  // Faz o escrito em cima  ******************************************************** 
  myGLCD.setColor(255, 0, 0);
  myGLCD.setBackColor(255, 0, 0);
  myGLCD.fillRect(0,0,799,20);
  myGLCD.setColor(255, 255, 255);  
  myGLCD.print("* Auxiliador para Calibracao das Balancas *", CENTER, 2);
  // *********************************************************************************
  
  // Faz a tela ficar preta  
  myGLCD.setColor(223, 185, 137);    
  myGLCD.fillRect(1,21,799,464);

  // Faz a escrita de tempos de 10 Metros
  myGLCD.setColor(0, 0, 0);    
  myGLCD.fillRect(0,40,799,65);
  myGLCD.setColor(255,255,255); // Cor da escrita
  myGLCD.setBackColor(0, 0, 0);// Cor de fundo da escrita
  myGLCD.print(" Tempos referente aos 10 Metros ", CENTER, 45);// Escrita
  // tempo 10 m 01
  myGLCD.setColor(255, 255, 255);  
  myGLCD.fillRect(60,80,180,110);
  myGLCD.setColor(0,0,0); // Cor da escrita
  myGLCD.setBackColor(255, 255, 255);// Cor de fundo da escrita
  // tempo 10 m 02
  myGLCD.setColor(255, 255, 255);  
  myGLCD.fillRect(200,80,320,110);
  myGLCD.setColor(0,0,0); // Cor da escrita
  myGLCD.setBackColor(255, 255, 255);// Cor de fundo da escrita
  // tempo 10 m 03
  myGLCD.setColor(255, 255, 255);  
  myGLCD.fillRect(340,80,460,110);
  myGLCD.setColor(0,0,0); // Cor da escrita
  myGLCD.setBackColor(255, 255, 255);// Cor de fundo da escrita
  // tempo 10 m 04
  myGLCD.setColor(255, 255, 255);  
  myGLCD.fillRect(480,80,600,110);
  myGLCD.setColor(0,0,0); // Cor da escrita
  myGLCD.setBackColor(255, 255, 255);// Cor de fundo da escrita
  // tempo 10 m 05
  myGLCD.setColor(255, 255, 255);  
  myGLCD.fillRect(620,80,740,110);
  myGLCD.setColor(0,0,0); // Cor da escrita
  myGLCD.setBackColor(255, 255, 255);// Cor de fundo da escrita


 

 // Faz a escrita de tempos totais
  myGLCD.setColor(0, 0, 0);    
  myGLCD.fillRect(0,135,799,160);  
  myGLCD.setColor(255,255,255); // Cor da escrita
  myGLCD.setBackColor(0, 0, 0);// Cor de fundo da escrita
  myGLCD.print(" Tempos Referentes a Volta Completa da Correia ", CENTER, 140);// Escrita
 // tempo total 01
  myGLCD.setColor(255, 255, 255);  
  myGLCD.fillRect(60,170,180,200);
  myGLCD.setColor(0,0,0); // Cor da escrita
  myGLCD.setBackColor(255, 255, 255);// Cor de fundo da escrita
  // tempo total 02
  myGLCD.setColor(255, 255, 255);  
  myGLCD.fillRect(200,170,320,200);
  myGLCD.setColor(0,0,0); // Cor da escrita
  myGLCD.setBackColor(255, 255, 255);// Cor de fundo da escrita
  // tempo total 03
  myGLCD.setColor(255, 255, 255);  
  myGLCD.fillRect(340,170,460,200);
  myGLCD.setColor(0,0,0); // Cor da escrita
  myGLCD.setBackColor(255, 255, 255);// Cor de fundo da escrita
  // tempo total 04
  myGLCD.setColor(255, 255, 255);  
  myGLCD.fillRect(480,170,600,200);
  myGLCD.setColor(0,0,0); // Cor da escrita
  myGLCD.setBackColor(255, 255, 255);// Cor de fundo da escrita
  // tempo total 05
  myGLCD.setColor(255, 255, 255);  
  myGLCD.fillRect(620,170,740,200);
  myGLCD.setColor(0,0,0); // Cor da escrita
  myGLCD.setBackColor(255, 255, 255);// Cor de fundo da escrita

  // Faz a tela ficar azul nos dados
  myGLCD.setColor(33, 170, 35);  
  myGLCD.fillRect(0,225,799,459);

  // Faz a escrita de tempos totais
  myGLCD.setColor(0, 0, 0);  
  myGLCD.fillRect(0,225,799,255);
  myGLCD.setColor(255,255,255); // Cor da escrita
  myGLCD.setBackColor(0, 0, 0);// Cor de fundo da escrita
  myGLCD.print(" Resultados Obtidos para Calibracao ", CENTER, 230);// Escrita

  myGLCD.setColor(255, 255, 255); 
  myGLCD.setBackColor(33, 170, 35);// Cor de fundo da escrita
  myGLCD.print(" Tempo 10 m ", 35, 280);// Escrita
  myGLCD.print("s ", 305, 280);// Escrita
  myGLCD.print(" Tempo Volta ", 385, 280);// Escrita
  myGLCD.print("s ", 705, 280);// Escrita
  myGLCD.print(" Velocidade ", 35, 320);// Escrita
  myGLCD.print("m/s ", 345, 320);// Escrita
  myGLCD.print(" Fluxo ", 470, 320);// Escrita  
  myGLCD.print("t/h ", 705, 320);// Escrita 
  myGLCD.print(" Comprimento Correia ", 35, 360);// Escrita  
  myGLCD.print("m ", 485, 360);// Escrita 
    
  // tempo 5 metros  
  myGLCD.setColor(255, 255, 255);  
  myGLCD.fillRect(240,270,300,300);
  myGLCD.setColor(0,0,0); // Cor da escrita
  myGLCD.setBackColor(255, 255, 255);// Cor de fundo da escrita
  // tempo volta  
  myGLCD.setColor(255, 255, 255);  
  myGLCD.fillRect(590,270,700,300);
  myGLCD.setColor(0,0,0); // Cor da escrita
  myGLCD.setBackColor(255, 255, 255);// Cor de fundo da escrita
   // Velocidade
  myGLCD.setColor(255, 255, 255);  
  myGLCD.fillRect(240,310,340,340);
  myGLCD.setColor(0,0,0); // Cor da escrita
  myGLCD.setBackColor(255, 255, 255);// Cor de fundo da escrita
  // Fluxo
  myGLCD.setColor(255, 255, 255);  
  myGLCD.fillRect(580,310,700,340);
  myGLCD.setColor(0,0,0); // Cor da escrita
  myGLCD.setBackColor(255, 255, 255);// Cor de fundo da escrita
  // Comprimento da correia
  myGLCD.setColor(255, 255, 255);  
  myGLCD.fillRect(380,355,480,385);
  myGLCD.setColor(0,0,0); // Cor da escrita
  myGLCD.setBackColor(255, 255, 255);// Cor de fundo da escrita

 // Botao Voltar
  myGLCD.setColor(0, 128, 35);  
  myGLCD.fillRect(580,380,700,420);
  myGLCD.setColor(127,255,0); // Cor da escrita
  myGLCD.setBackColor(0, 128, 35);// Cor de fundo da escrita
  myGLCD.print("Voltar", 590,390 );// Escrita












  // Faz o escrito embaixo  ********************************************************** 
  myGLCD.setColor(64, 64, 64);  
  myGLCD.fillRect(0,460,799,484);
  myGLCD.setColor(255,255,0);
  myGLCD.setBackColor(64, 64, 64);
  myGLCD.print("< Bruno Goncalves - (31) 98369-1000 >", CENTER, 462);
  // *********************************************************************************















}
