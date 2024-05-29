void aciona_portao()
{
   // Comando Abrir
   if (contador == 0 && digitalRead(ent_portg_fechado)==LOW)
   {
    contador = 1;
    abrir();
   }

   // Comando Fechar
   if (contador == 3 && digitalRead(ent_portg_aberto)==LOW)
   {
    contador = 4;
    fechar();
   }

}
