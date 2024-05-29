using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Speech.Synthesis; // Namespace

namespace Logan
{
    public class Speaker
    {
        private static SpeechSynthesizer sp = new SpeechSynthesizer();
        public static void Speak(string text)
        {
           // caso ele esteja falando
           if(sp.State == SynthesizerState.Speaking)
              sp.SpeakAsyncCancelAll();
           sp.SpeakAsync(text);
        }
        public static void Speak(params string[] texts)
        {
            Random rnd = new Random();
            Speak(texts[rnd.Next(0,texts.Length)]);
        }

    }
}
