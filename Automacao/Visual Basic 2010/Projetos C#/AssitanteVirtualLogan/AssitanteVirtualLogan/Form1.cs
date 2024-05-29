using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Windows.Forms;
using Microsoft.Speech.Recognition; // adicionar namespace
using System.Speech.Synthesis; //Para carregar as vozes do sistema
using System.IO.Ports; // Carregado para usar a porta serial


// Para sintese é preciso o SpeechSDK 5.1, Windows 10 System.Speech ja vem
//> Project > AddReference .NET > System.Speech

namespace AssistanteVirtualLogan
{
    
    public partial class Form1 : Form
    {
        

        public SerialPort Serial = new SerialPort("COM3", 9600);
        public SpeechSynthesizer sp = new SpeechSynthesizer();
        public SpeechRecognitionEngine engine; // engine de reconhecimento
        public bool isLoganListening = true;
        public float conf;


        public Form1()
        {
            InitializeComponent();
            
        }

        public void LoadSpeech()
        {
            try
            {
                engine = new SpeechRecognitionEngine();// instancia
                engine.SetInputToDefaultAudioDevice(); // microfone

                Choices c_commandsOfSystem = new Choices();
                c_commandsOfSystem.Add(ChamadaDeFuncoes.FuncaoComoFoiODia.ToArray()); // FuncaoComoFoiODia
                c_commandsOfSystem.Add(ChamadaDeFuncoes.FuncaoDeHoras.ToArray()); // FuncaoDeHoras
                c_commandsOfSystem.Add(ChamadaDeFuncoes.FuncaoDeData.ToArray()); // FuncaoDeData
                c_commandsOfSystem.Add(ChamadaDeFuncoes.FuncaoPararDeOurvir.ToArray()); // FuncaoPararDeOuvir
                c_commandsOfSystem.Add(ChamadaDeFuncoes.FuncaoVoltarOurvir.ToArray()); // FuncaoVoltarOuvir
                c_commandsOfSystem.Add(ChamadaDeFuncoes.FuncaoOcultarMensagem.ToArray()); // FuncaoOcultarMensagem
                c_commandsOfSystem.Add(ChamadaDeFuncoes.FuncaoExibirMensagem.ToArray()); // FuncaoExibirMensagem
                c_commandsOfSystem.Add(ChamadaDeFuncoes.FuncaoMinimizarJanela.ToArray()); // FuncaoMinimizarJanela
                c_commandsOfSystem.Add(ChamadaDeFuncoes.FuncaoMaximizarJanela.ToArray()); // FuncaoMaximizarJanela
                c_commandsOfSystem.Add(ChamadaDeFuncoes.FuncaoAlterarVoz.ToArray()); // FuncaoAlterarVoz
                c_commandsOfSystem.Add(ChamadaDeFuncoes.FuncaoLigarAr.ToArray()); // FuncaoLigarAr
                c_commandsOfSystem.Add(ChamadaDeFuncoes.FuncaoDesligarAr.ToArray()); // FuncaoDesligarAr
                c_commandsOfSystem.Add(ChamadaDeFuncoes.FuncaoLigarSky.ToArray()); // FuncaoLigarSky
                c_commandsOfSystem.Add(ChamadaDeFuncoes.FuncaoDesligarSky.ToArray()); // FuncaoDesligarSky






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

        public void Form1_Load(object sender, EventArgs e)
        {
            
            LoadSpeech();
           Speaker.Speak("Já carreguei os arquivos necessários, em que posso ajudá-lo?");
            comboBox1.Items.Clear();
            Lb_Mensagem.Visible = true;
            foreach (InstalledVoice voice in sp.GetInstalledVoices())
            {
                comboBox1.Items.Add(voice.VoiceInfo.Name);
            }
                try
                {
                    Serial.Open();
                }
                catch
                {

                }
            
        }

        // método que é chamado quando algo é reconhecido
        public void rec(object s, SpeechRecognizedEventArgs e)
        {
            string speech = e.Result.Text; // String reconhecida
            conf = e.Result.Confidence;
            //Lb_Mensagem.Text = speech;


            if (conf > 0.51f) // Se a confiança do audio recebido for boa
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

                    
                    

                    // Entrando para realizar as comparaçoes
                    switch (e.Result.Grammar.Name)
                    {
                        case "sys":

                            // FUNCOES PARA O CLIMATIZADOR ********************************************************************************************************************
                            // FUNCOES PARA O CLIMATIZADOR ********************************************************************************************************************
                            // FUNCOES PARA O CLIMATIZADOR ********************************************************************************************************************
                            // FUNCOES PARA O CLIMATIZADOR ********************************************************************************************************************
                            // FUNCOES PARA O CLIMATIZADOR ********************************************************************************************************************


                            // Se o resultado for ligar o climatizador
                            if (ChamadaDeFuncoes.FuncaoLigarAr.Any(x => x == speech))
                            {
                                if (Serial.IsOpen == true)
                                {
                                    Serial.Write("ar_power");
                                }
                                                                
                               RodandoFuncoes.FuncaoLigarAr(); // Chama o metodo FuncaoLigarAr
                            }

                            // Se o resultado for desligar o climatizador
                            if (ChamadaDeFuncoes.FuncaoDesligarAr.Any(x => x == speech))
                            {
                                if (Serial.IsOpen == true)
                                {
                                    Serial.Write("ar_power");
                                }

                               RodandoFuncoes.FuncaoDesligarAr(); // Chama o metodo FuncaoLigarAr
                            }


                            // FUNÇÕES SKY /DUOSAT ****************************************************************************************************************************
                            // FUNÇÕES SKY /DUOSAT ****************************************************************************************************************************
                            // FUNÇÕES SKY /DUOSAT ****************************************************************************************************************************
                            // FUNÇÕES SKY /DUOSAT ****************************************************************************************************************************
                            // FUNÇÕES SKY /DUOSAT ****************************************************************************************************************************
                            // FUNÇÕES SKY /DUOSAT ****************************************************************************************************************************

                            // Se o resultado for ligar Sky
                            if (ChamadaDeFuncoes.FuncaoLigarSky.Any(x => x == speech))
                            {
                                if (Serial.IsOpen == true)
                                {
                                    Serial.Write("sky_power");
                                }

                                RodandoFuncoes.FuncaoLigarSky();
                            }

                            // Se o resultado for ligar Sky
                            if (ChamadaDeFuncoes.FuncaoDesligarSky.Any(x => x == speech))
                            {
                                if (Serial.IsOpen == true)
                                {
                                    Serial.Write("sky_power");
                                }

                                RodandoFuncoes.FuncaoDesligarSky();
                            }






                            // Se o resultado for igual como foi seu dia
                            if (ChamadaDeFuncoes.FuncaoComoFoiODia.Any(x => x == speech))
                            {
                                RodandoFuncoes.FuncaoComoFoiODia(); // Chama o metodo FuncaoComoFoiODia
                            }
                            
                        
                        
                            // Se o resultado for igual a "Que horas são"ou "Me diga as horas" ou "Poderia me dizer que horas são"
                            

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

                             // Se o resultado for para alterar a voz
                            if (ChamadaDeFuncoes.FuncaoAlterarVoz.Any(x => x == speech))
                            {
                                
                            }


                            
                            break;

                            

                             


                    }

                }





            }

        }
        public void audiolevel(object s, AudioLevelUpdatedEventArgs e)
        {
            this.progressBar2 .Maximum = 100;
            this.progressBar2.Value = e.AudioLevel;
        }

        public void FuncaoMinimizarJanela()
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

        public void FuncaoMaximizarJanela()
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

        private void comboBox1_SelectedIndexChanged(object sender, EventArgs e)
        {
            Speaker.SetVoice(comboBox1.SelectedItem.ToString());
            Speaker.Speak("a voz foi alterada!");
        }


       


    }
}
