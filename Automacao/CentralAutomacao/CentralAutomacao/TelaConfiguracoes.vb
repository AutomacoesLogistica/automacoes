Public Class TelaConfiguracoes

    Private Sub btnVoltar_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btnVoltar.Click
        Me.Hide()
    End Sub

    Private Sub btnDesconectar_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btnDesconectar.Click

        Form1.SerialPort1.Close()             'Close our Serial Port
        btnDesconectar.Enabled = False
        btnConectar.Enabled = True
        Form1.lbMensagemRecebidaMQTT.Visible = False

        lbConectado.Text = "--/--/---- --:--:--"
    End Sub

 

    Private Sub TelaConfiguracoes_Load(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles MyBase.Load
        
    End Sub

    Private Sub btnConectar_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btnConectar.Click
        btnDesconectar.Enabled = True
        btnConectar.Enabled = False
        lbConectado.Text = Now
        Me.InvokeOnClick(Form1.btnConnect, e)
    End Sub

  
    Private Sub Label7_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Label7.Click

    End Sub
End Class