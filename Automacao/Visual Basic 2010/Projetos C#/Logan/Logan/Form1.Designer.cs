namespace Logan
{
    partial class Form1
    {
        /// <summary>
        /// Required designer variable.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary>
        /// Clean up any resources being used.
        /// </summary>
        /// <param name="disposing">true if managed resources should be disposed; otherwise, false.</param>
        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Windows Form Designer generated code

        /// <summary>
        /// Required method for Designer support - do not modify
        /// the contents of this method with the code editor.
        /// </summary>
        private void InitializeComponent()
        {
            this.progressBar1 = new System.Windows.Forms.ProgressBar();
            this.Lb_Mensagem = new System.Windows.Forms.Label();
            this.SuspendLayout();
            // 
            // progressBar1
            // 
            this.progressBar1.Anchor = System.Windows.Forms.AnchorStyles.Top;
            this.progressBar1.BackColor = System.Drawing.Color.FromArgb(((int)(((byte)(192)))), ((int)(((byte)(192)))), ((int)(((byte)(255)))));
            this.progressBar1.Location = new System.Drawing.Point(158, 164);
            this.progressBar1.Name = "progressBar1";
            this.progressBar1.Size = new System.Drawing.Size(123, 14);
            this.progressBar1.TabIndex = 0;
            // 
            // Lb_Mensagem
            // 
            this.Lb_Mensagem.AutoSize = true;
            this.Lb_Mensagem.BackColor = System.Drawing.Color.FromArgb(((int)(((byte)(128)))), ((int)(((byte)(255)))), ((int)(((byte)(255)))));
            this.Lb_Mensagem.Location = new System.Drawing.Point(12, 283);
            this.Lb_Mensagem.Name = "Lb_Mensagem";
            this.Lb_Mensagem.Size = new System.Drawing.Size(71, 13);
            this.Lb_Mensagem.TabIndex = 1;
            this.Lb_Mensagem.Text = "Reconhecido";
            this.Lb_Mensagem.Visible = false;
            // 
            // Form1
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.BackgroundImage = global::Jarvis.Properties.Resources.jarvis;
            this.BackgroundImageLayout = System.Windows.Forms.ImageLayout.Stretch;
            this.ClientSize = new System.Drawing.Size(434, 305);
            this.Controls.Add(this.Lb_Mensagem);
            this.Controls.Add(this.progressBar1);
            this.MinimumSize = new System.Drawing.Size(450, 344);
            this.Name = "Form1";
            this.Text = "Jarvis";
            this.Load += new System.EventHandler(this.Form1_Load);
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private System.Windows.Forms.ProgressBar progressBar1;
        private System.Windows.Forms.Label Lb_Mensagem;
    }
}

