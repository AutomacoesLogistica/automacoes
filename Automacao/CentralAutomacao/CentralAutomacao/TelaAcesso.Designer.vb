<Global.Microsoft.VisualBasic.CompilerServices.DesignerGenerated()> _
Partial Class TelaAcesso
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
        Me.btnVoltar.TabIndex = 60
        Me.btnVoltar.TabStop = False
        '
        'TelaAcesso
        '
        Me.AutoScaleDimensions = New System.Drawing.SizeF(6.0!, 13.0!)
        Me.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font
        Me.BackgroundImage = Global.CentralAutomacao.My.Resources.Resources.fundo
        Me.BackgroundImageLayout = System.Windows.Forms.ImageLayout.Stretch
        Me.ClientSize = New System.Drawing.Size(1354, 742)
        Me.Controls.Add(Me.btnVoltar)
        Me.FormBorderStyle = System.Windows.Forms.FormBorderStyle.None
        Me.Name = "TelaAcesso"
        Me.Text = "TelaAcesso"
        Me.WindowState = System.Windows.Forms.FormWindowState.Maximized
        CType(Me.btnVoltar, System.ComponentModel.ISupportInitialize).EndInit()
        Me.ResumeLayout(False)

    End Sub
    Friend WithEvents btnVoltar As System.Windows.Forms.PictureBox
End Class
