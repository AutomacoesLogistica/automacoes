using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Windows.Forms;
using Microsoft.Speech.Recognition; // adicionar namespace

// Para sintese é preciso o SpeechSDK 5.1, Windows 10 System.Speech ja vem
//> Project > AddReference .NET > System.Speech

namespace Logan
{
    public partial class Form1 : Form
    {
        private SpeechRecognitionEngine engine; // engine de reconhecimento
        private bool isLoganListening = true;
        
        public Form1()
        {
            InitializeComponent();
        }

        private void LoadSpeech()
        {
            try
            {
                engine = new SpeechRecognitionEngine();// instancia
                engine.SetInputToDefaultAudioDevice(); // microfone

                Choices c_commandsOfSystem = new Choices();
                c_commandsOfSystem.Add(ChamadaDeFuncoes.FuncaoDeHoras.ToArray()); // FuncaoDeHoras
                c_commandsOfSystem.Add(ChamadaDeFuncoes.FuncaoDeData.ToArray()); // FuncaoDeData
                c_commandsOfSystem.Add(ChamadaDeFuncoes.FuncaoPararDeOurvir.ToArray()); // FuncaoPararDeOuvir
                c_commandsOfSystem.Add(ChamadaDeFuncoes.FuncaoVoltarOurvir.ToArray()); // FuncaoVoltarOuvir
                c_commandsOfSystem.Add(ChamadaDeFuncoes.FuncaoOcultarMensagem.ToArray()); // FuncaoOcultarMensagem
                c_commandsOfSystem.Add(ChamadaDeFuncoes.FuncaoExibirMensagem.ToArray()); // FuncaoExibirMensagem
                c_commandsOfSystem.Add(ChamadaDeFuncoes.FuncaoMinimizarJanela.ToArray()); // FuncaoMinimizarJanela
                c_commandsOfSystem.Add(ChamadaDeFuncoes.FuncaoMaximizarJanela.ToArray()); // FuncaoMaximizarJanela
                
                GrammarBuilder gb_commandsOfSystem = new GrammarBuilder();
                gb_commandsOfSystem.Append(c_commandsOfSystem);

                Grammar g_commandsOfSystem = new Grammar(gb_commandsOfSystem);
                g_commandsOfSystem.Name = "sys";


                // carregar a gramatica
                engine.LoadGrammar(g_commandsOfSystem);
                engine.SpeechRecognized += new EventHandler<SpeechRecognizedEventArgs>(rec);
                engine.AudioLevelUpdated += new EventHandler<AudioLevelUpdatedEventArgs>(audiolevel);
                engine.RecognizeAsync(RecognizeMode.Multiple);// iniciar reconhecimento
                Speaker.Speak("estou carregando os arquivos.");// Assim que iniciar o programa fala isto

            }
            catch (Exception ex)
            {
                MessageBox.Show("Ocorreu no LoadSpeech(): " + ex.Message);
            }



        }

        private void Form1_Load(object sender, EventArgs e)
        {
            LoadSpeech();
            Speaker.Speak("Já carreguei os arquivos necessários, em que posso ajudá-lo?");
        }

        // método que é chamado quando algo é reconhecido
        private void rec(object s, SpeechRecognizedEventArgs e)
        {
            string speech = e.Result.Text; // String reconhecida
            float conf = e.Result.Confidence;

            if (conf > 0.70f) // Se a confiança do audio recebido for boa
            {


                // Chamand função para exibir / esconder mensagem recebida
                if (ChamadaDeFuncoes.FuncaoOcultarMensagem.Any(x => x == speech))
                {
                    Lb_Mensagem.Visible = false;
                    RodandoFuncoes.FuncaoOcultarMensagem(); // Chama o void para ocultar as mensagens recebidas
                }

                if (ChamadaDeFuncoes.FuncaoExibirMensagem.Any(x => x == speech))
                {
                    Lb_Mensagem.Visible = true;
                    RodandoFuncoes.FuncaoExibirMensagem(); // Chama o void para exibir as mensagens recebidas
                }
                
                
                // Chamando função de parar de ouvir
                if (ChamadaDeFuncoes.FuncaoPararDeOurvir.Any(x => x == speech))
                {
                    isLoganListening = false;
                    RodandoFuncoes.FuncaoPararDeOuvir(); // Chama o void para responder que parou de ouvir
                }
                else if (ChamadaDeFuncoes.FuncaoVoltarOurvir.Any(x => x == speech))
                {
                    isLoganListening = true;
                    RodandoFuncoes.FuncaoVoltarOuvir(); // Chama o void para falar que voltou a ouvir
                }
                






                // So ouve se o Logan estiver ouvindo
                if (isLoganListening == true)
                {

                    Lb_Mensagem.Text = e.Result.Text;
                    // Entrando para realizar as comparaçoes
                    switch (e.Result.Grammar.Name)
                    {
                        case "sys":

                            // Se o resultado for igual a "Que horas são"ou "Me diga as horas" ou "Poderia me dizer que horas são"
                            if (ChamadaDeFuncoes.FuncaoDeHoras.Any(x => x == speech))
                            {
                                RodandoFuncoes.FuncaoDeHoras(); // Chama o metodo para falar as horas
                            }

                            // Se o resultado for referente as perguntas de data
                            if (ChamadaDeFuncoes.FuncaoDeData.Any(x => x == speech))
                            {
                                RodandoFuncoes.FuncaoDeData(); // Chama o metodo para falar as horas
                            }


                            // Se o resultado for para minimizar a janela
                            if (ChamadaDeFuncoes.FuncaoMinimizarJanela.Any(x => x == speech))
                            {
                                FuncaoMinimizarJanela(); // Chama o metodo para minimizar a janela
                            }

                            // Se o resultado for para maximizar a janela
                            if (ChamadaDeFuncoes.FuncaoMaximizarJanela.Any(x => x == speech))
                            {
                                FuncaoMaximizarJanela(); // Chama o metodo para maximizar a janela
                            }

                            break;





                    }
                    
                }
                
               



            }
        
        }
        private void audiolevel(object s, AudioLevelUpdatedEventArgs e)
        {
         this.progressBar1.Maximum = 100;
         this.progressBar1.Value = e.AudioLevel;
        }

        private void FuncaoMinimizarJanela()
        {
            
            // Comandos para minimzar a janela
            if (this.WindowState == FormWindowState.Normal || this.WindowState == FormWindowState.Maximized)
            {
                this.WindowState = FormWindowState.Minimized;
                Speaker.Speak("Como quiser!", "Ok, minimizando a janela");

            }
            else
            {
                Speaker.Speak("A janela já está minimizada!", "Não posso realizar esta tarefa pois a janela ja está minimizada!");
            }
        }

        private void FuncaoMaximizarJanela()
        {

            // Comandos para maximizar a janela
            if (this.WindowState == FormWindowState.Minimized)
            {
                this.WindowState = FormWindowState.Normal;
                Speaker.Speak("Como quiser!", "Ok, voltando a janela para o modo normal!", "Janela em modo normal!");

            }
            else
            {
                Speaker.Speak("A janela já está em modo normal!", "Não posso realizar esta tarefa pois a janela ja está em modo normal!");
            }
        }



    }
}
