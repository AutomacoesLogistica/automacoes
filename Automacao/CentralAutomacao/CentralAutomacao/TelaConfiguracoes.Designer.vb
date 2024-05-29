<Global.Microsoft.VisualBasic.CompilerServices.DesignerGenerated()> _
Partial Class TelaConfiguracoes
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
        Me.btnVoltar = New System.Windows.Forms.PictureBox()
        Me.btnDesconectar = New System.Windows.Forms.Button()
        Me.btnConectar = New System.Windows.Forms.Button()
        Me.opSim = New System.Windows.Forms.RadioButton()
        Me.opNao = New System.Windows.Forms.RadioButton()
        Me.Label7 = New System.Windows.Forms.Label()
        Me.lbConectado = New System.Windows.Forms.Label()
        CType(Me.btnVoltar, System.ComponentModel.ISupportInitialize).BeginInit()
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
        Me.btnVoltar.TabIndex = 59
        Me.btnVoltar.TabStop = False
        '
        'btnDesconectar
        '
        Me.btnDesconectar.Font = New System.Drawing.Font("Microsoft Sans Serif", 9.75!, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.btnDesconectar.Location = New System.Drawing.Point(161, 12)
        Me.btnDesconectar.Name = "btnDesconectar"
        Me.btnDesconectar.Size = New System.Drawing.Size(129, 34)
        Me.btnDesconectar.TabIndex = 60
        Me.btnDesconectar.Text = "Desconectar"
        Me.btnDesconectar.UseVisualStyleBackColor = True
        '
        'btnConectar
        '
        Me.btnConectar.Font = New System.Drawing.Font("Microsoft Sans Serif", 9.75!, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.btnConectar.Location = New System.Drawing.Point(26, 11)
        Me.btnConectar.Name = "btnConectar"
        Me.btnConectar.Size = New System.Drawing.Size(129, 34)
        Me.btnConectar.TabIndex = 97
        Me.btnConectar.Text = "Conectar"
        Me.btnConectar.UseVisualStyleBackColor = True
        '
        'opSim
        '
        Me.opSim.AutoSize = True
        Me.opSim.BackColor = System.Drawing.Color.Transparent
        Me.opSim.Font = New System.Drawing.Font("Microsoft Sans Serif", 15.75!, System.Drawing.FontStyle.Bold)
        Me.opSim.ForeColor = System.Drawing.Color.White
        Me.opSim.Location = New System.Drawing.Point(327, 17)
        Me.opSim.Name = "opSim"
        Me.opSim.Size = New System.Drawing.Size(134, 29)
        Me.opSim.TabIndex = 98
        Me.opSim.Text = "Visualizar"
        Me.opSim.UseVisualStyleBackColor = False
        '
        'opNao
        '
        Me.opNao.AutoSize = True
        Me.opNao.BackColor = System.Drawing.Color.Transparent
        Me.opNao.Checked = True
        Me.opNao.Font = New System.Drawing.Font("Microsoft Sans Serif", 15.75!, System.Drawing.FontStyle.Bold)
        Me.opNao.ForeColor = System.Drawing.Color.White
        Me.opNao.Location = New System.Drawing.Point(489, 17)
        Me.opNao.Name = "opNao"
        Me.opNao.Size = New System.Drawing.Size(183, 29)
        Me.opNao.TabIndex = 99
        Me.opNao.TabStop = True
        Me.opNao.Text = "Não Visualizar"
        Me.opNao.UseVisualStyleBackColor = False
        '
        'Label7
        '
        Me.Label7.AutoSize = True
        Me.Label7.BackColor = System.Drawing.Color.Transparent
        Me.Label7.Font = New System.Drawing.Font("Microsoft Sans Serif", 12.0!, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.Label7.ForeColor = System.Drawing.Color.White
        Me.Label7.Location = New System.Drawing.Point(22, 49)
        Me.Label7.Name = "Label7"
        Me.Label7.Size = New System.Drawing.Size(180, 20)
        Me.Label7.TabIndex = 102
        Me.Label7.Text = "Último Acionamento :"
        Me.Label7.TextAlign = System.Drawing.ContentAlignment.MiddleLeft
        '
        'lbConectado
        '
        Me.lbConectado.AutoSize = True
        Me.lbConectado.BackColor = System.Drawing.Color.Transparent
        Me.lbConectado.Font = New System.Drawing.Font("Microsoft Sans Serif", 12.0!, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.lbConectado.ForeColor = System.Drawing.Color.White
        Me.lbConectado.Location = New System.Drawing.Point(208, 49)
        Me.lbConectado.Name = "lbConectado"
        Me.lbConectado.Size = New System.Drawing.Size(118, 20)
        Me.lbConectado.TabIndex = 103
        Me.lbConectado.Text = "--/--/---- --:--:--"
        Me.lbConectado.TextAlign = System.Drawing.ContentAlignment.MiddleLeft
        '
        'TelaConfiguracoes
        '
        Me.AutoScaleDimensions = New System.Drawing.SizeF(6.0!, 13.0!)
        Me.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font
        Me.BackgroundImage = Global.CentralAutomacao.My.Resources.Resources.fundo
        Me.BackgroundImageLayout = System.Windows.Forms.ImageLayout.Stretch
        Me.ClientSize = New System.Drawing.Size(1354, 742)
        Me.Controls.Add(Me.Label7)
        Me.Controls.Add(Me.lbConectado)
        Me.Controls.Add(Me.opNao)
        Me.Controls.Add(Me.opSim)
        Me.Controls.Add(Me.btnConectar)
        Me.Controls.Add(Me.btnDesconectar)
        Me.Controls.Add(Me.btnVoltar)
        Me.FormBorderStyle = System.Windows.Forms.FormBorderStyle.None
        Me.Name = "TelaConfiguracoes"
        Me.Text = "TelaConfiguracoes"
        Me.WindowState = System.Windows.Forms.FormWindowState.Maximized
        CType(Me.btnVoltar, System.ComponentModel.ISupportInitialize).EndInit()
        Me.ResumeLayout(False)
        Me.PerformLayout()

    End Sub
    Friend WithEvents btnVoltar As System.Windows.Forms.PictureBox
    Friend WithEvents btnDesconectar As System.Windows.Forms.Button
    Friend WithEvents btnConectar As System.Windows.Forms.Button
    Friend WithEvents opSim As System.Windows.Forms.RadioButton
    Friend WithEvents opNao As System.Windows.Forms.RadioButton
    Friend WithEvents Label7 As System.Windows.Forms.Label
    Friend WithEvents lbConectado As System.Windows.Forms.Label
End Class
