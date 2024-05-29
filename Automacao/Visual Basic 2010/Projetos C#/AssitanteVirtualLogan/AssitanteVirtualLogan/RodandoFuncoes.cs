using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;

namespace AssistanteVirtualLogan
{

    public class RodandoFuncoes
    {
        public static void FuncaoLigarAr()
        {

            Speaker.Speak("Ligando o climatizador!", "Ligando o ar!");

        }

        public static void FuncaoDesligarAr()
        {

            Speaker.Speak("Desligando o climatizador!", "Desligando o ar!");

        }


        public static void FuncaoLigarSky()
        {

            Speaker.Speak("Ligando a Sky!", "A sky foi ligada!");

        }

        public static void FuncaoDesligarSky()
        {

            Speaker.Speak("Desligando a Sky!", "A sky foi desligada!");

        }


























        public static void FuncaoComoFoiODia()
        {

            Speaker.Speak("Foi bom, e o seu como foi?","Foi bom, fiquei tranquilo, e seu dia como foi?","Foi corrido, trabalhei bastante, e o seu como foi?"); // Comando para falar como foi o dia dele

        }                
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

            Speaker.Speak("Pois não!", "Estou aqui!", "Diga!", "Oi", "Sim", "Em que posso ajudá-lo?");

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
