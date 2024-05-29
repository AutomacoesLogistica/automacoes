using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Windows.Forms;
using System.Speech.Synthesis;

namespace AssitanteVirtualLogan
{
    public partial class SelecionarVoz : Form
    {
        private SpeechSynthesizer sp = new SpeechSynthesizer();
        public SelecionarVoz()
        {
            InitializeComponent();
            comboBox1.Items.Clear();
            foreach (InstalledVoice voice in sp.GetInstalledVoices())
            {
                comboBox1.Items.Add(voice.VoiceInfo.Name);
            }
        }
        
        // Form sendo carregado
        public void SelecionarVoz_Load(object sender, EventArgs e)
        {
           
        }
    }
}
