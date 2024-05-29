Public Class TelaMusica

    Private Sub btnVoltar_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btnVoltar.Click
        Me.Hide()
    End Sub

    Private Sub Button1_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btnAbrir.Click
        If OpenFileDialog1.ShowDialog = DialogResult.OK Then
            AxWindowsMediaPlayer1.URL = OpenFileDialog1.FileName
            OpenFileDialog1.ShowDialog()
        End If
    End Sub

    Private Sub btnStop_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btnStop.Click
        AxWindowsMediaPlayer1.Ctlcontrols.pause()
    End Sub

    Private Sub btnPlay_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btnPlay.Click
        AxWindowsMediaPlayer1.Ctlcontrols.play()
    End Sub

    Private Sub btnProximo_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btnProximo.Click
        AxWindowsMediaPlayer1.Ctlcontrols.next()
    End Sub

    Private Sub btnAnterior_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btnAnterior.Click
        AxWindowsMediaPlayer1.Ctlcontrols.previous()
    End Sub

    Private Sub btnVolMais_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btnVolMais.Click
        AxWindowsMediaPlayer1.mediaCollection.getAll()
    End Sub

    Private Sub Panel1_Paint(ByVal sender As System.Object, ByVal e As System.Windows.Forms.PaintEventArgs) Handles Panel1.Paint

    End Sub
End Class