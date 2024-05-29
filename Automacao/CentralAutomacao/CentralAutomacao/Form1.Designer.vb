<Global.Microsoft.VisualBasic.CompilerServices.DesignerGenerated()> _
Partial Class Form1
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
        Me.components = New System.ComponentModel.Container()
        Me.SerialPort1 = New System.IO.Ports.SerialPort(Me.components)
        Me.Painel_Configuracoes = New System.Windows.Forms.Panel()
        Me.rtbReceived = New System.Windows.Forms.RichTextBox()
        Me.tbMensagemRecebida = New System.Windows.Forms.TextBox()
        Me.btnSeparar = New System.Windows.Forms.Button()
        Me.btnAtualiza = New System.Windows.Forms.Button()
        Me.cmbPort = New System.Windows.Forms.ComboBox()
        Me.tbResultado = New System.Windows.Forms.TextBox()
        Me.btnConnect = New System.Windows.Forms.Button()
        Me.cmbBaud = New System.Windows.Forms.ComboBox()
        Me.btnDisconnect = New System.Windows.Forms.Button()
        Me.lbMensagemRecebidaMQTT = New System.Windows.Forms.Label()
        Me.btnTV = New System.Windows.Forms.PictureBox()
        Me.btnEnergia = New System.Windows.Forms.PictureBox()
        Me.btnProjetor = New System.Windows.Forms.PictureBox()
        Me.btnLampadas = New System.Windows.Forms.PictureBox()
        Me.btnConfiguracoes = New System.Windows.Forms.PictureBox()
        Me.btnCenas = New System.Windows.Forms.PictureBox()
        Me.btnCameras = New System.Windows.Forms.PictureBox()
        Me.btnMusica = New System.Windows.Forms.PictureBox()
        Me.lbTitulo = New System.Windows.Forms.Label()
        Me.btnCortinas = New System.Windows.Forms.PictureBox()
        Me.btnPersianas = New System.Windows.Forms.PictureBox()
        Me.btnSKY = New System.Windows.Forms.PictureBox()
        Me.btnPortao = New System.Windows.Forms.PictureBox()
        Me.Timer_Cenas = New System.Windows.Forms.Timer(Me.components)
        Me.Painel_Configuracoes.SuspendLayout()
        CType(Me.btnTV, System.ComponentModel.ISupportInitialize).BeginInit()
        CType(Me.btnEnergia, System.ComponentModel.ISupportInitialize).BeginInit()
        CType(Me.btnProjetor, System.ComponentModel.ISupportInitialize).BeginInit()
        CType(Me.btnLampadas, System.ComponentModel.ISupportInitialize).BeginInit()
        CType(Me.btnConfiguracoes, System.ComponentModel.ISupportInitialize).BeginInit()
        CType(Me.btnCenas, System.ComponentModel.ISupportInitialize).BeginInit()
        CType(Me.btnCameras, System.ComponentModel.ISupportInitialize).BeginInit()
        CType(Me.btnMusica, System.ComponentModel.ISupportInitialize).BeginInit()
        CType(Me.btnCortinas, System.ComponentModel.ISupportInitialize).BeginInit()
        CType(Me.btnPersianas, System.ComponentModel.ISupportInitialize).BeginInit()
        CType(Me.btnSKY, System.ComponentModel.ISupportInitialize).BeginInit()
        CType(Me.btnPortao, System.ComponentModel.ISupportInitialize).BeginInit()
        Me.SuspendLayout()
        '
        'SerialPort1
        '
        Me.SerialPort1.PortName = "COM3"
        '
        'Painel_Configuracoes
        '
        Me.Painel_Configuracoes.Controls.Add(Me.rtbReceived)
        Me.Painel_Configuracoes.Controls.Add(Me.tbMensagemRecebida)
        Me.Painel_Configuracoes.Controls.Add(Me.btnSeparar)
        Me.Painel_Configuracoes.Controls.Add(Me.btnAtualiza)
        Me.Painel_Configuracoes.Controls.Add(Me.cmbPort)
        Me.Painel_Configuracoes.Controls.Add(Me.tbResultado)
        Me.Painel_Configuracoes.Controls.Add(Me.btnConnect)
        Me.Painel_Configuracoes.Controls.Add(Me.cmbBaud)
        Me.Painel_Configuracoes.Location = New System.Drawing.Point(346, 264)
        Me.Painel_Configuracoes.Name = "Painel_Configuracoes"
        Me.Painel_Configuracoes.Size = New System.Drawing.Size(687, 206)
        Me.Painel_Configuracoes.TabIndex = 40
        Me.Painel_Configuracoes.Visible = False
        '
        'rtbReceived
        '
        Me.rtbReceived.Font = New System.Drawing.Font("Microsoft Sans Serif", 6.75!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.rtbReceived.Location = New System.Drawing.Point(69, 111)
        Me.rtbReceived.MaxLength = 49
        Me.rtbReceived.Name = "rtbReceived"
        Me.rtbReceived.Size = New System.Drawing.Size(441, 49)
        Me.rtbReceived.TabIndex = 45
        Me.rtbReceived.Text = ""
        Me.rtbReceived.Visible = False
        '
        'tbMensagemRecebida
        '
        Me.tbMensagemRecebida.BackColor = System.Drawing.Color.White
        Me.tbMensagemRecebida.Location = New System.Drawing.Point(68, 29)
        Me.tbMensagemRecebida.Multiline = True
        Me.tbMensagemRecebida.Name = "tbMensagemRecebida"
        Me.tbMensagemRecebida.Size = New System.Drawing.Size(442, 20)
        Me.tbMensagemRecebida.TabIndex = 30
        '
        'btnSeparar
        '
        Me.btnSeparar.Location = New System.Drawing.Point(279, 82)
        Me.btnSeparar.Name = "btnSeparar"
        Me.btnSeparar.Size = New System.Drawing.Size(231, 23)
        Me.btnSeparar.TabIndex = 41
        Me.btnSeparar.Text = "Separar Dados Recebidos"
        Me.btnSeparar.UseVisualStyleBackColor = True
        '
        'btnAtualiza
        '
        Me.btnAtualiza.Location = New System.Drawing.Point(68, 82)
        Me.btnAtualiza.Name = "btnAtualiza"
        Me.btnAtualiza.Size = New System.Drawing.Size(205, 23)
        Me.btnAtualiza.TabIndex = 43
        Me.btnAtualiza.Text = "Atualiza Dados Recebidos"
        Me.btnAtualiza.UseVisualStyleBackColor = True
        '
        'cmbPort
        '
        Me.cmbPort.FormattingEnabled = True
        Me.cmbPort.Location = New System.Drawing.Point(516, 29)
        Me.cmbPort.Name = "cmbPort"
        Me.cmbPort.Size = New System.Drawing.Size(121, 21)
        Me.cmbPort.TabIndex = 28
        '
        'tbResultado
        '
        Me.tbResultado.Location = New System.Drawing.Point(68, 56)
        Me.tbResultado.Name = "tbResultado"
        Me.tbResultado.Size = New System.Drawing.Size(442, 20)
        Me.tbResultado.TabIndex = 42
        '
        'btnConnect
        '
        Me.btnConnect.Location = New System.Drawing.Point(516, 83)
        Me.btnConnect.Name = "btnConnect"
        Me.btnConnect.Size = New System.Drawing.Size(121, 38)
        Me.btnConnect.TabIndex = 27
        Me.btnConnect.Text = "Conectar"
        Me.btnConnect.UseVisualStyleBackColor = True
        '
        'cmbBaud
        '
        Me.cmbBaud.FormattingEnabled = True
        Me.cmbBaud.Location = New System.Drawing.Point(516, 56)
        Me.cmbBaud.Name = "cmbBaud"
        Me.cmbBaud.Size = New System.Drawing.Size(121, 21)
        Me.cmbBaud.TabIndex = 26
        '
        'btnDisconnect
        '
        Me.btnDisconnect.Location = New System.Drawing.Point(1261, 6)
        Me.btnDisconnect.Name = "btnDisconnect"
        Me.btnDisconnect.Size = New System.Drawing.Size(106, 23)
        Me.btnDisconnect.TabIndex = 37
        Me.btnDisconnect.Text = "Desconectar"
        Me.btnDisconnect.UseVisualStyleBackColor = True
        Me.btnDisconnect.Visible = False
        '
        'lbMensagemRecebidaMQTT
        '
        Me.lbMensagemRecebidaMQTT.AutoSize = True
        Me.lbMensagemRecebidaMQTT.BackColor = System.Drawing.Color.Transparent
        Me.lbMensagemRecebidaMQTT.Font = New System.Drawing.Font("Microsoft Sans Serif", 12.0!, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.lbMensagemRecebidaMQTT.ForeColor = System.Drawing.Color.White
        Me.lbMensagemRecebidaMQTT.Location = New System.Drawing.Point(12, 742)
        Me.lbMensagemRecebidaMQTT.Name = "lbMensagemRecebidaMQTT"
        Me.lbMensagemRecebidaMQTT.Size = New System.Drawing.Size(147, 20)
        Me.lbMensagemRecebidaMQTT.TabIndex = 44
        Me.lbMensagemRecebidaMQTT.Text = "Recebido MQTT :"
        Me.lbMensagemRecebidaMQTT.Visible = False
        '
        'btnTV
        '
        Me.btnTV.BackColor = System.Drawing.Color.Transparent
        Me.btnTV.Image = Global.CentralAutomacao.My.Resources.Resources.tv
        Me.btnTV.Location = New System.Drawing.Point(193, 149)
        Me.btnTV.Name = "btnTV"
        Me.btnTV.Size = New System.Drawing.Size(128, 122)
        Me.btnTV.SizeMode = System.Windows.Forms.PictureBoxSizeMode.StretchImage
        Me.btnTV.TabIndex = 45
        Me.btnTV.TabStop = False
        '
        'btnEnergia
        '
        Me.btnEnergia.BackColor = System.Drawing.Color.Transparent
        Me.btnEnergia.Cursor = System.Windows.Forms.Cursors.NoMove2D
        Me.btnEnergia.Image = Global.CentralAutomacao.My.Resources.Resources.energia
        Me.btnEnergia.Location = New System.Drawing.Point(414, 590)
        Me.btnEnergia.Name = "btnEnergia"
        Me.btnEnergia.Size = New System.Drawing.Size(96, 96)
        Me.btnEnergia.SizeMode = System.Windows.Forms.PictureBoxSizeMode.StretchImage
        Me.btnEnergia.TabIndex = 46
        Me.btnEnergia.TabStop = False
        '
        'btnProjetor
        '
        Me.btnProjetor.BackColor = System.Drawing.Color.Transparent
        Me.btnProjetor.Image = Global.CentralAutomacao.My.Resources.Resources.projetor
        Me.btnProjetor.Location = New System.Drawing.Point(102, 327)
        Me.btnProjetor.Name = "btnProjetor"
        Me.btnProjetor.Size = New System.Drawing.Size(127, 97)
        Me.btnProjetor.SizeMode = System.Windows.Forms.PictureBoxSizeMode.StretchImage
        Me.btnProjetor.TabIndex = 47
        Me.btnProjetor.TabStop = False
        '
        'btnLampadas
        '
        Me.btnLampadas.BackColor = System.Drawing.Color.Transparent
        Me.btnLampadas.Cursor = System.Windows.Forms.Cursors.NoMove2D
        Me.btnLampadas.Image = Global.CentralAutomacao.My.Resources.Resources.lampadas1
        Me.btnLampadas.Location = New System.Drawing.Point(1039, 149)
        Me.btnLampadas.Name = "btnLampadas"
        Me.btnLampadas.Size = New System.Drawing.Size(128, 122)
        Me.btnLampadas.SizeMode = System.Windows.Forms.PictureBoxSizeMode.StretchImage
        Me.btnLampadas.TabIndex = 48
        Me.btnLampadas.TabStop = False
        '
        'btnConfiguracoes
        '
        Me.btnConfiguracoes.BackColor = System.Drawing.Color.Transparent
        Me.btnConfiguracoes.Image = Global.CentralAutomacao.My.Resources.Resources.settings
        Me.btnConfiguracoes.Location = New System.Drawing.Point(636, 635)
        Me.btnConfiguracoes.Name = "btnConfiguracoes"
        Me.btnConfiguracoes.Size = New System.Drawing.Size(111, 86)
        Me.btnConfiguracoes.SizeMode = System.Windows.Forms.PictureBoxSizeMode.StretchImage
        Me.btnConfiguracoes.TabIndex = 49
        Me.btnConfiguracoes.TabStop = False
        '
        'btnCenas
        '
        Me.btnCenas.BackColor = System.Drawing.Color.Transparent
        Me.btnCenas.Image = Global.CentralAutomacao.My.Resources.Resources.cenario
        Me.btnCenas.Location = New System.Drawing.Point(1155, 323)
        Me.btnCenas.Name = "btnCenas"
        Me.btnCenas.Size = New System.Drawing.Size(128, 122)
        Me.btnCenas.SizeMode = System.Windows.Forms.PictureBoxSizeMode.StretchImage
        Me.btnCenas.TabIndex = 50
        Me.btnCenas.TabStop = False
        '
        'btnCameras
        '
        Me.btnCameras.BackColor = System.Drawing.Color.Transparent
        Me.btnCameras.Image = Global.CentralAutomacao.My.Resources.Resources.cftv
        Me.btnCameras.Location = New System.Drawing.Point(613, 12)
        Me.btnCameras.Name = "btnCameras"
        Me.btnCameras.Size = New System.Drawing.Size(164, 142)
        Me.btnCameras.SizeMode = System.Windows.Forms.PictureBoxSizeMode.StretchImage
        Me.btnCameras.TabIndex = 52
        Me.btnCameras.TabStop = False
        '
        'btnMusica
        '
        Me.btnMusica.BackColor = System.Drawing.Color.Transparent
        Me.btnMusica.Image = Global.CentralAutomacao.My.Resources.Resources.som
        Me.btnMusica.Location = New System.Drawing.Point(1026, 488)
        Me.btnMusica.Name = "btnMusica"
        Me.btnMusica.Size = New System.Drawing.Size(151, 153)
        Me.btnMusica.SizeMode = System.Windows.Forms.PictureBoxSizeMode.StretchImage
        Me.btnMusica.TabIndex = 53
        Me.btnMusica.TabStop = False
        '
        'lbTitulo
        '
        Me.lbTitulo.BackColor = System.Drawing.Color.Transparent
        Me.lbTitulo.CausesValidation = False
        Me.lbTitulo.Font = New System.Drawing.Font("Lucida Handwriting", 48.0!, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.lbTitulo.ForeColor = System.Drawing.Color.WhiteSmoke
        Me.lbTitulo.Location = New System.Drawing.Point(443, 276)
        Me.lbTitulo.Name = "lbTitulo"
        Me.lbTitulo.Size = New System.Drawing.Size(504, 180)
        Me.lbTitulo.TabIndex = 54
        Me.lbTitulo.Text = "Central Automação"
        Me.lbTitulo.TextAlign = System.Drawing.ContentAlignment.MiddleCenter
        '
        'btnCortinas
        '
        Me.btnCortinas.BackColor = System.Drawing.Color.Transparent
        Me.btnCortinas.Image = Global.CentralAutomacao.My.Resources.Resources.cortina2
        Me.btnCortinas.Location = New System.Drawing.Point(414, 73)
        Me.btnCortinas.Name = "btnCortinas"
        Me.btnCortinas.Size = New System.Drawing.Size(128, 122)
        Me.btnCortinas.SizeMode = System.Windows.Forms.PictureBoxSizeMode.StretchImage
        Me.btnCortinas.TabIndex = 55
        Me.btnCortinas.TabStop = False
        '
        'btnPersianas
        '
        Me.btnPersianas.BackColor = System.Drawing.Color.Transparent
        Me.btnPersianas.Image = Global.CentralAutomacao.My.Resources.Resources.cortina1
        Me.btnPersianas.Location = New System.Drawing.Point(862, 89)
        Me.btnPersianas.Name = "btnPersianas"
        Me.btnPersianas.Size = New System.Drawing.Size(115, 106)
        Me.btnPersianas.SizeMode = System.Windows.Forms.PictureBoxSizeMode.StretchImage
        Me.btnPersianas.TabIndex = 56
        Me.btnPersianas.TabStop = False
        '
        'btnSKY
        '
        Me.btnSKY.BackColor = System.Drawing.Color.Transparent
        Me.btnSKY.Image = Global.CentralAutomacao.My.Resources.Resources.sky
        Me.btnSKY.Location = New System.Drawing.Point(203, 519)
        Me.btnSKY.Name = "btnSKY"
        Me.btnSKY.Size = New System.Drawing.Size(152, 75)
        Me.btnSKY.SizeMode = System.Windows.Forms.PictureBoxSizeMode.StretchImage
        Me.btnSKY.TabIndex = 57
        Me.btnSKY.TabStop = False
        '
        'btnPortao
        '
        Me.btnPortao.BackColor = System.Drawing.Color.Transparent
        Me.btnPortao.Image = Global.CentralAutomacao.My.Resources.Resources.portao
        Me.btnPortao.Location = New System.Drawing.Point(849, 543)
        Me.btnPortao.Name = "btnPortao"
        Me.btnPortao.Size = New System.Drawing.Size(128, 122)
        Me.btnPortao.SizeMode = System.Windows.Forms.PictureBoxSizeMode.StretchImage
        Me.btnPortao.TabIndex = 58
        Me.btnPortao.TabStop = False
        '
        'Timer_Cenas
        '
        Me.Timer_Cenas.Enabled = True
        Me.Timer_Cenas.Interval = 60000
        '
        'Form1
        '
        Me.AutoScaleDimensions = New System.Drawing.SizeF(6.0!, 13.0!)
        Me.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font
        Me.BackgroundImage = Global.CentralAutomacao.My.Resources.Resources.fundo
        Me.BackgroundImageLayout = System.Windows.Forms.ImageLayout.Stretch
        Me.ClientSize = New System.Drawing.Size(1370, 781)
        Me.Controls.Add(Me.btnPortao)
        Me.Controls.Add(Me.btnSKY)
        Me.Controls.Add(Me.btnPersianas)
        Me.Controls.Add(Me.btnCortinas)
        Me.Controls.Add(Me.lbTitulo)
        Me.Controls.Add(Me.btnMusica)
        Me.Controls.Add(Me.btnCameras)
        Me.Controls.Add(Me.btnCenas)
        Me.Controls.Add(Me.btnConfiguracoes)
        Me.Controls.Add(Me.btnLampadas)
        Me.Controls.Add(Me.btnProjetor)
        Me.Controls.Add(Me.btnEnergia)
        Me.Controls.Add(Me.btnTV)
        Me.Controls.Add(Me.lbMensagemRecebidaMQTT)
        Me.Controls.Add(Me.btnDisconnect)
        Me.Controls.Add(Me.Painel_Configuracoes)
        Me.FormBorderStyle = System.Windows.Forms.FormBorderStyle.None
        Me.Name = "Form1"
        Me.Text = "Form1"
        Me.WindowState = System.Windows.Forms.FormWindowState.Maximized
        Me.Painel_Configuracoes.ResumeLayout(False)
        Me.Painel_Configuracoes.PerformLayout()
        CType(Me.btnTV, System.ComponentModel.ISupportInitialize).EndInit()
        CType(Me.btnEnergia, System.ComponentModel.ISupportInitialize).EndInit()
        CType(Me.btnProjetor, System.ComponentModel.ISupportInitialize).EndInit()
        CType(Me.btnLampadas, System.ComponentModel.ISupportInitialize).EndInit()
        CType(Me.btnConfiguracoes, System.ComponentModel.ISupportInitialize).EndInit()
        CType(Me.btnCenas, System.ComponentModel.ISupportInitialize).EndInit()
        CType(Me.btnCameras, System.ComponentModel.ISupportInitialize).EndInit()
        CType(Me.btnMusica, System.ComponentModel.ISupportInitialize).EndInit()
        CType(Me.btnCortinas, System.ComponentModel.ISupportInitialize).EndInit()
        CType(Me.btnPersianas, System.ComponentModel.ISupportInitialize).EndInit()
        CType(Me.btnSKY, System.ComponentModel.ISupportInitialize).EndInit()
        CType(Me.btnPortao, System.ComponentModel.ISupportInitialize).EndInit()
        Me.ResumeLayout(False)
        Me.PerformLayout()

    End Sub
    Friend WithEvents SerialPort1 As System.IO.Ports.SerialPort
    Friend WithEvents Painel_Configuracoes As System.Windows.Forms.Panel
    Friend WithEvents btnDisconnect As System.Windows.Forms.Button
    Friend WithEvents tbMensagemRecebida As System.Windows.Forms.TextBox
    Friend WithEvents cmbPort As System.Windows.Forms.ComboBox
    Friend WithEvents btnConnect As System.Windows.Forms.Button
    Friend WithEvents cmbBaud As System.Windows.Forms.ComboBox
    Friend WithEvents btnAtualiza As System.Windows.Forms.Button
    Friend WithEvents tbResultado As System.Windows.Forms.TextBox
    Friend WithEvents btnSeparar As System.Windows.Forms.Button
    Friend WithEvents lbMensagemRecebidaMQTT As System.Windows.Forms.Label
    Friend WithEvents rtbReceived As System.Windows.Forms.RichTextBox
    Friend WithEvents btnTV As System.Windows.Forms.PictureBox
    Friend WithEvents btnEnergia As System.Windows.Forms.PictureBox
    Friend WithEvents btnProjetor As System.Windows.Forms.PictureBox
    Friend WithEvents btnLampadas As System.Windows.Forms.PictureBox
    Friend WithEvents btnConfiguracoes As System.Windows.Forms.PictureBox
    Friend WithEvents btnCenas As System.Windows.Forms.PictureBox
    Friend WithEvents btnCameras As System.Windows.Forms.PictureBox
    Friend WithEvents btnMusica As System.Windows.Forms.PictureBox
    Public WithEvents lbTitulo As System.Windows.Forms.Label
    Friend WithEvents btnCortinas As System.Windows.Forms.PictureBox
    Friend WithEvents btnPersianas As System.Windows.Forms.PictureBox
    Friend WithEvents btnSKY As System.Windows.Forms.PictureBox
    Friend WithEvents btnPortao As System.Windows.Forms.PictureBox
    Public WithEvents Timer_Cenas As System.Windows.Forms.Timer

End Class
