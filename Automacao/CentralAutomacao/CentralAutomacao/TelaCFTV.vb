
Public Class TelaCFTV

    Private Sub btnVoltar_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btnVoltar.Click
        Me.Hide()
    End Sub

    Private Sub TelaCFTV_Load(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles MyBase.Load

    End Sub


    Private Sub btnAreaExterna_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btnAreaExterna.Click
        WebBrowser1.Navigate("http://labbrunog.ddns.luxvision.com.br:8091")
    End Sub

    Private Sub btnMinhaCasa_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btnMinhaCasa.Click
        WebBrowser1.Navigate("www.google.com")
    End Sub

  
End Class