<Global.Microsoft.VisualBasic.CompilerServices.DesignerGenerated()> _
Partial Class TelaMusica
    Inherits System.Windows.Forms.Form

    'Form overrides dispose to clean up the component list.
    <System.Diagnostics.DebuggerNonUserCode()> _
    Protected Overrides Sub Dispose(ByVal disposing As Boolean)
        Try
            If disposing AndAlso components IsNot Nothing Then
                components.Dispose()
            End If
        Finally
            MyBase.Dispose(disposing)
        End Try
    End Sub

    'Required by the Windows Form Designer
    Private components As System.ComponentModel.IContainer

    'NOTE: The following procedure is required by the Windows Form Designer
    'It can be modified using the Windows Form Designer.  
    'Do not modify it using the code editor.
    <System.Diagnostics.DebuggerStepThrough()> _
    Private Sub InitializeComponent()
        Dim resources As System.ComponentModel.ComponentResourceManager = New System.ComponentModel.ComponentResourceManager(GetType(TelaMusica))
        Me.btnVoltar = New System.Windows.Forms.PictureBox()
        Me.btnAbrir = New System.Windows.Forms.Button()
        Me.AxWindowsMediaPlayer1 = New AxWMPLib.AxWindowsMediaPlayer()
        Me.OpenFileDialog1 = New System.Windows.Forms.OpenFileDialog()
        Me.btnStop = New System.Windows.Forms.Button()
        Me.btnProximo = New System.Windows.Forms.Button()
        Me.btnAnterior = New System.Windows.Forms.Button()
        Me.btnPlay = New System.Windows.Forms.Button()
        Me.Panel1 = New System.Windows.Forms.Panel()
        Me.btnVolMenos = New System.Windows.Forms.Button()
        Me.btnVolMais = New System.Windows.Forms.Button()
        CType(Me.btnVoltar, System.ComponentModel.ISupportInitialize).BeginInit()
        CType(Me.AxWindowsMediaPlayer1, System.ComponentModel.ISupportInitialize).BeginInit()
        Me.SuspendLayout()
        '
        'btnVoltar
        '
        Me.btnVoltar.BackColor = System.Drawing.Color.Transparent
        Me.btnVoltar.Image = Global.CentralAutomacao.My.Resources.Resources.V
        Me.btnVoltar.Location = New System.Drawing.Point(1293, 12)
        Me.btnVoltar.Name = "btnVoltar"
        Me.btnVoltar.Size = New System.Drawing.Size(49, 51)
        Me.btnVoltar.SizeMode = System.Windows.Forms.PictureBoxSizeMode.StretchImage
        Me.btnVoltar.TabIndex = 61
        Me.btnVoltar.TabStop = False
        '
        'btnAbrir
        '
        Me.btnAbrir.Location = New System.Drawing.Point(12, 12)
        Me.btnAbrir.Name = "btnAbrir"
        Me.btnAbrir.Size = New System.Drawing.Size(106, 36)
        Me.btnAbrir.TabIndex = 62
        Me.btnAbrir.Text = "Abrir"
        Me.btnAbrir.UseVisualStyleBackColor = True
        '
        'AxWindowsMediaPlayer1
        '
        Me.AxWindowsMediaPlayer1.AccessibleRole = System.Windows.Forms.AccessibleRole.TitleBar
        Me.AxWindowsMediaPlayer1.Enabled = True
        Me.AxWindowsMediaPlayer1.Location = New System.Drawing.Point(12, 149)
        Me.AxWindowsMediaPlayer1.Name = "AxWindowsMediaPlayer1"
        Me.AxWindowsMediaPlayer1.OcxState = CType(resources.GetObject("AxWindowsMediaPlayer1.OcxState"), System.Windows.Forms.AxHost.State)
        Me.AxWindowsMediaPlayer1.Size = New System.Drawing.Size(332, 241)
        Me.AxWindowsMediaPlayer1.TabIndex = 63
        '
        'OpenFileDialog1
        '
        Me.OpenFileDialog1.FileName = "OpenFileDialog1"
        Me.OpenFileDialog1.Multiselect = True
        '
        'btnStop
        '
        Me.btnStop.Location = New System.Drawing.Point(238, 12)
        Me.btnStop.Name = "btnStop"
        Me.btnStop.Size = New System.Drawing.Size(106, 36)
        Me.btnStop.TabIndex = 64
        Me.btnStop.Text = "Parar"
        Me.btnStop.UseVisualStyleBackColor = True
        '
        'btnProximo
        '
        Me.btnProximo.Location = New System.Drawing.Point(238, 54)
        Me.btnProximo.Name = "btnProximo"
        Me.btnProximo.Size = New System.Drawing.Size(106, 36)
        Me.btnProximo.TabIndex = 65
        Me.btnProximo.Text = "Proximo"
        Me.btnProximo.UseVisualStyleBackColor = True
        '
        'btnAnterior
        '
        Me.btnAnterior.Location = New System.Drawing.Point(126, 54)
        Me.btnAnterior.Name = "btnAnterior"
        Me.btnAnterior.Size = New System.Drawing.Size(106, 36)
        Me.btnAnterior.TabIndex = 66
        Me.btnAnterior.Text = "Anterior"
        Me.btnAnterior.UseVisualStyleBackColor = True
        '
        'btnPlay
        '
        Me.btnPlay.Location = New System.Drawing.Point(126, 12)
        Me.btnPlay.Name = "btnPlay"
        Me.btnPlay.Size = New System.Drawing.Size(106, 36)
        Me.btnPlay.TabIndex = 67
        Me.btnPlay.Text = "Tocar"
        Me.btnPlay.UseVisualStyleBackColor = True
        '
        'Panel1
        '
        Me.Panel1.Location = New System.Drawing.Point(408, 39)
        Me.Panel1.Name = "Panel1"
        Me.Panel1.Size = New System.Drawing.Size(455, 298)
        Me.Panel1.TabIndex = 68
        '
        'btnVolMenos
        '
        Me.btnVolMenos.Location = New System.Drawing.Point(126, 107)
        Me.btnVolMenos.Name = "btnVolMenos"
        Me.btnVolMenos.Size = New System.Drawing.Size(106, 36)
        Me.btnVolMenos.TabIndex = 70
        Me.btnVolMenos.Text = "Vol -"
        Me.btnVolMenos.UseVisualStyleBackColor = True
        '
        'btnVolMais
        '
        Me.btnVolMais.Location = New System.Drawing.Point(238, 107)
        Me.btnVolMais.Name = "btnVolMais"
        Me.btnVolMais.Size = New System.Drawing.Size(106, 36)
        Me.btnVolMais.TabIndex = 69
        Me.btnVolMais.Text = "Vol +"
        Me.btnVolMais.UseVisualStyleBackColor = True
        '
        'TelaMusica
        '
        Me.AutoScaleDimensions = New System.Drawing.SizeF(6.0!, 13.0!)
        Me.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font
        Me.BackgroundImage = Global.CentralAutomacao.My.Resources.Resources.fundo
        Me.BackgroundImageLayout = System.Windows.Forms.ImageLayout.Stretch
        Me.ClientSize = New System.Drawing.Size(1354, 742)
        Me.Controls.Add(Me.btnVolMenos)
        Me.Controls.Add(Me.btnVolMais)
        Me.Controls.Add(Me.Panel1)
        Me.Controls.Add(Me.btnPlay)
        Me.Controls.Add(Me.btnAnterior)
        Me.Controls.Add(Me.btnProximo)
        Me.Controls.Add(Me.btnStop)
        Me.Controls.Add(Me.AxWindowsMediaPlayer1)
        Me.Controls.Add(Me.btnAbrir)
        Me.Controls.Add(Me.btnVoltar)
        Me.FormBorderStyle = System.Windows.Forms.FormBorderStyle.None
        Me.IsMdiContainer = True
        Me.Name = "TelaMusica"
        Me.Text = "TelaMusica"
        Me.WindowState = System.Windows.Forms.FormWindowState.Maximized
        CType(Me.btnVoltar, System.ComponentModel.ISupportInitialize).EndInit()
        CType(Me.AxWindowsMediaPlayer1, System.ComponentModel.ISupportInitialize).EndInit()
        Me.ResumeLayout(False)

    End Sub
    Friend WithEvents btnVoltar As System.Windows.Forms.PictureBox
    Friend WithEvents btnAbrir As System.Windows.Forms.Button
    Friend WithEvents AxWindowsMediaPlayer1 As AxWMPLib.AxWindowsMediaPlayer
    Friend WithEvents OpenFileDialog1 As System.Windows.Forms.OpenFileDialog
    Friend WithEvents btnStop As System.Windows.Forms.Button
    Friend WithEvents btnProximo As System.Windows.Forms.Button
    Friend WithEvents btnAnterior As System.Windows.Forms.Button
    Friend WithEvents btnPlay As System.Windows.Forms.Button
    Friend WithEvents Panel1 As System.Windows.Forms.Panel
    Friend WithEvents btnVolMenos As System.Windows.Forms.Button
    Friend WithEvents btnVolMais As System.Windows.Forms.Button
End Class
