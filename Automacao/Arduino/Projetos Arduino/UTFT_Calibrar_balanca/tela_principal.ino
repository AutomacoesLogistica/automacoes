 void tela_principal()
 {
  TELA = 0;
  myGLCD.clrScr();//limpa a tela
  
  // Faz o escrito em cima  ******************************************************** 
  myGLCD.setColor(255, 0, 0);
  myGLCD.setBackColor(255, 0, 0);
  myGLCD.fillRect(0,0,799,20);
  myGLCD.setColor(255, 255, 255);  
  myGLCD.print("* Auxiliador para Calibracao das Balancas *", CENTER, 2);
  // *********************************************************************************
  
 // Faz a tela ficar preta  
  myGLCD.setColor(0, 0, 0);  
  myGLCD.fillRect(1,21,799,464);
  
  
  // Faz a escrita de seleção da correia
  myGLCD.setColor(255,255,255); // Cor da escrita
  myGLCD.setBackColor(0, 0, 0);// Cor de fundo da escrita
  myGLCD.print(" Selecione a correia transportadora desejada! ", CENTER, 45);// Escrita
  
  // Correia TC-BP-106
  myGLCD.setColor(255, 255, 255);  
  myGLCD.fillRect(99,80,289,110);
  myGLCD.setColor(0,0,0); // Cor da escrita
  myGLCD.setBackColor(255, 255, 255);// Cor de fundo da escrita
  myGLCD.print(" TC-BP-106 ", 109,90 );// Escrita

  // Correia TC-BP-107
  myGLCD.setColor(255, 255, 255);  
  myGLCD.fillRect(309,80,499,110);
  myGLCD.setColor(0,0,0); // Cor da escrita
  myGLCD.setBackColor(255, 255, 255);// Cor de fundo da escrita
  myGLCD.print(" TC-BP-107 ", 319,90 );// Escrita

  // Correia TC-BP-108
  myGLCD.setColor(255, 255, 255);  
  myGLCD.fillRect(519,80,709,110);
  myGLCD.setColor(0,0,0); // Cor da escrita
  myGLCD.setBackColor(255, 255, 255);// Cor de fundo da escrita
  myGLCD.print(" TC-BP-108 ", 529,90 );// Escrita

  // Correia TC-BP-109
  myGLCD.setColor(255, 255, 255);  
  myGLCD.fillRect(99,130,289,160);
  myGLCD.setColor(0,0,0); // Cor da escrita
  myGLCD.setBackColor(255, 255, 255);// Cor de fundo da escrita
  myGLCD.print(" TC-BP-109 ", 109,140 );// Escrita
  
  // Correia TC-FG-111
  myGLCD.setColor(255, 255, 255);  
  myGLCD.fillRect(309,130,499,160);
  myGLCD.setColor(0,0,0); // Cor da escrita
  myGLCD.setBackColor(255, 255, 255);// Cor de fundo da escrita
  myGLCD.print(" TC-FG-111 ", 319,140 );// Escrita
  
    // Faz a escrita de seleção o peso de referencia
  myGLCD.setColor(255,255,255); // Cor da escrita
  myGLCD.setBackColor(0, 0, 0);// Cor de fundo da escrita
  myGLCD.print(" Totalizacao de pesos usados para o fluxo ! ", CENTER, 185);// Escrita

   // Pesos de 40 KG
  myGLCD.setColor(255, 255, 255);  
  myGLCD.fillRect(200,220,390,250);
  myGLCD.setColor(0,0,0); // Cor da escrita
  myGLCD.setBackColor(255, 255, 255);// Cor de fundo da escrita
  myGLCD.print("   40 Kg   ", 210,230 );// Escrita

  //Pesos de 80 KG
  myGLCD.setColor(255, 255, 255);  
  myGLCD.fillRect(410,220,600,250);
  myGLCD.setColor(0,0,0); // Cor da escrita
  myGLCD.setBackColor(255, 255, 255);// Cor de fundo da escrita
  myGLCD.print("   80 Kg   ", 420,230 );// Escrita
  
  
  
  // Escritas de confirmação
   // Faz a escrita de seleção da correia
   myGLCD.setColor(255,255,255); // Cor da escrita
   myGLCD.setBackColor(0, 0, 0);// Cor de fundo da escrita
   myGLCD.print("Selecionado a correia : ", 40, 280);// Escrita
   myGLCD.print("Selecionado o peso : ", 40, 310);// Escrita  
  
 // Faz o escrito embaixo  ********************************************************** 
  myGLCD.setColor(64, 64, 64);  
  myGLCD.fillRect(0,460,799,484);
  myGLCD.setColor(255,255,0);
  myGLCD.setBackColor(64, 64, 64);
  myGLCD.print("< Bruno Goncalves - (31) 98369-1000 >", CENTER, 462);
 // *********************************************************************************
 loop();  
}

