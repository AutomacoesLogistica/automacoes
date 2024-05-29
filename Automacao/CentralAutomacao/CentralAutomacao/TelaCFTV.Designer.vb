<Global.Microsoft.VisualBasic.CompilerServices.DesignerGenerated()> _
Partial Class TelaCFTV
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
        Me.btnMinhaCasa = New System.Windows.Forms.Button()
        Me.btnAreaExterna = New System.Windows.Forms.Button()
        Me.WebBrowser1 = New System.Windows.Forms.WebBrowser()
        CType(Me.btnVoltar, System.ComponentModel.ISupportInitialize).BeginInit()
        Me.SuspendLayout()
        '
        'btnVoltar
        '
        Me.btnVoltar.BackColor = System.Drawing.Color.Transparent
        Me.btnVoltar.Image = Global.CentralAutomacao.My.Resources.Resources.V
        Me.btnVoltar.Location = New System.Drawing.Point(1309, 12)
        Me.btnVoltar.Name = "btnVoltar"
        Me.btnVoltar.Size = New System.Drawing.Size(49, 51)
        Me.btnVoltar.SizeMode = System.Windows.Forms.PictureBoxSizeMode.StretchImage
        Me.btnVoltar.TabIndex = 54
        Me.btnVoltar.TabStop = False
        '
        'btnMinhaCasa
        '
        Me.btnMinhaCasa.AutoSize = True
        Me.btnMinhaCasa.BackColor = System.Drawing.SystemColors.ControlText
        Me.btnMinhaCasa.FlatStyle = System.Windows.Forms.FlatStyle.System
        Me.btnMinhaCasa.Font = New System.Drawing.Font("Microsoft Sans Serif", 14.25!, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.btnMinhaCasa.ForeColor = System.Drawing.Color.White
        Me.btnMinhaCasa.Location = New System.Drawing.Point(12, 12)
        Me.btnMinhaCasa.Name = "btnMinhaCasa"
        Me.btnMinhaCasa.Size = New System.Drawing.Size(162, 33)
        Me.btnMinhaCasa.TabIndex = 102
        Me.btnMinhaCasa.Text = "Minha Casa"
        Me.btnMinhaCasa.TextImageRelation = System.Windows.Forms.TextImageRelation.ImageBeforeText
        Me.btnMinhaCasa.UseVisualStyleBackColor = False
        '
        'btnAreaExterna
        '
        Me.btnAreaExterna.AutoSize = True
        Me.btnAreaExterna.BackColor = System.Drawing.SystemColors.ControlText
        Me.btnAreaExterna.FlatStyle = System.Windows.Forms.FlatStyle.System
        Me.btnAreaExterna.Font = New System.Drawing.Font("Microsoft Sans Serif", 14.25!, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.btnAreaExterna.ForeColor = System.Drawing.Color.White
        Me.btnAreaExterna.Location = New System.Drawing.Point(180, 12)
        Me.btnAreaExterna.Name = "btnAreaExterna"
        Me.btnAreaExterna.Size = New System.Drawing.Size(162, 33)
        Me.btnAreaExterna.TabIndex = 103
        Me.btnAreaExterna.Text = "Area Externa"
        Me.btnAreaExterna.TextImageRelation = System.Windows.Forms.TextImageRelation.ImageBeforeText
        Me.btnAreaExterna.UseVisualStyleBackColor = False
        '
        'WebBrowser1
        '
        Me.WebBrowser1.Location = New System.Drawing.Point(41, 69)
        Me.WebBrowser1.MinimumSize = New System.Drawing.Size(20, 20)
        Me.WebBrowser1.Name = "WebBrowser1"
        Me.WebBrowser1.Size = New System.Drawing.Size(1268, 685)
        Me.WebBrowser1.TabIndex = 104
        Me.WebBrowser1.Url = New System.Uri("http://www.google.com", System.UriKind.Absolute)
        '
        'TelaCFTV
        '
        Me.AutoScaleDimensions = New System.Drawing.SizeF(6.0!, 13.0!)
        Me.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font
        Me.BackgroundImage = Global.CentralAutomacao.My.Resources.Resources.fundo
        Me.BackgroundImageLayout = System.Windows.Forms.ImageLayout.Stretch
        Me.ClientSize = New System.Drawing.Size(1370, 781)
        Me.Controls.Add(Me.WebBrowser1)
        Me.Controls.Add(Me.btnAreaExterna)
        Me.Controls.Add(Me.btnMinhaCasa)
        Me.Controls.Add(Me.btnVoltar)
        Me.FormBorderStyle = System.Windows.Forms.FormBorderStyle.None
        Me.Name = "TelaCFTV"
        Me.Text = "TelaCFTV"
        Me.WindowState = System.Windows.Forms.FormWindowState.Maximized
        CType(Me.btnVoltar, System.ComponentModel.ISupportInitialize).EndInit()
        Me.ResumeLayout(False)
        Me.PerformLayout()

    End Sub
    Friend WithEvents btnVoltar As System.Windows.Forms.PictureBox
    Friend WithEvents btnMinhaCasa As System.Windows.Forms.Button
    Friend WithEvents btnAreaExterna As System.Windows.Forms.Button
    Friend WithEvents WebBrowser1 As System.Windows.Forms.WebBrowser
End Class
