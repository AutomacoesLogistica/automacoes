using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;

namespace Logan
{
    public class RodandoFuncoes
    {
        public static void FuncaoDeHoras()
        {

            Speaker.Speak(DateTime.Now.ToShortTimeString()); // Comando para falar as horas

        }
        public static void FuncaoDeData()
        {

            Speaker.Speak(DateTime.Now.ToShortDateString()); // Comando para falar a data

        }
        public static void FuncaoPararDeOuvir()
        {

            Speaker.Speak("Ok mestre, estou no aguardo de seu comando!");

        }
        public static void FuncaoVoltarOuvir()
        {

            Speaker.Speak("Pois não!","Estou aqui!","Diga!","Oi","Sim","Em que posso ajudá-lo?");

        }
        public static void FuncaoOcultarMensagem()
        {

            Speaker.Speak("Ok, as mensagens não serão mais exibidas!");


        }
        public static void FuncaoExibirMensagem()
        {

            Speaker.Speak("Pois não, exibindo as mensagens!");

        }
        
    }
}
