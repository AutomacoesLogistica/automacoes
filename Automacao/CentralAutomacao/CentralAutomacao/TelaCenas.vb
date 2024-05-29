Public Class TelaCenas
    Public ValorDaHoraLigar As Integer
    Public ValorDaHoraDesligar As Integer
    Public ValorDoMinutoLigar As Integer
    Public ValorDoMinutoDesligar As Integer

    Private Sub btnVoltar_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btnVoltar.Click
        Me.Hide()
        Panel2.Enabled = False

    End Sub

    Private Sub btnMais_HorarioParaLigar_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btnMais_HorarioParaLigar.Click
        btnValidado.Visible = False
        ValorDaHoraLigar = ValorDaHoraLigar + 1
      
        If ValorDaHoraLigar < 10 Then
            horaLigar.Text = "0" + CStr(ValorDaHoraLigar)
        End If
        If ValorDaHoraLigar >= 10 And ValorDaHoraLigar < 24 Then
            horaLigar.Text = CStr(ValorDaHoraLigar)
        End If
        If ValorDaHoraLigar = 24 Then
            ValorDaHoraLigar = 0
            horaLigar.Text = "00"
        End If



    End Sub

    Private Sub TelaCenas_Load(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles MyBase.Load

    End Sub

    Private Sub btnMaisM_HorarioParaLigar_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btnMaisM_HorarioParaLigar.Click
        btnValidado.Visible = False
        ValorDoMinutoLigar = ValorDoMinutoLigar + 1

        If ValorDoMinutoLigar < 10 Then
            minutoLigar.Text = "0" + CStr(ValorDoMinutoLigar)
        End If
        If ValorDoMinutoLigar >= 10 And ValorDoMinutoLigar < 60 Then
            minutoLigar.Text = CStr(ValorDoMinutoLigar)
        End If
        If ValorDoMinutoLigar = 60 Then
            ValorDoMinutoLigar = 0
            minutoLigar.Text = "00"
        End If
    End Sub

    Private Sub btnMaisH_HorarioParaDesligar_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btnMaisH_HorarioParaDesligar.Click
        btnValidado.Visible = False
        ValorDaHoraDesligar = ValorDaHoraDesligar + 1

        If ValorDaHoraDesligar < 10 Then
            horaDesligar.Text = "0" + CStr(ValorDaHoraDesligar)
        End If
        If ValorDaHoraDesligar >= 10 And ValorDaHoraDesligar < 24 Then
            horaDesligar.Text = CStr(ValorDaHoraDesligar)
        End If
        If ValorDaHoraDesligar = 24 Then
            ValorDaHoraDesligar = 0
            horaDesligar.Text = "00"
        End If
    End Sub

    Private Sub btnMaisM_HorarioParaDesligar_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btnMaisM_HorarioParaDesligar.Click
        btnValidado.Visible = False
        ValorDoMinutoDesligar = ValorDoMinutoDesligar + 1

        If ValorDoMinutoDesligar < 10 Then
            minutoDesligar.Text = "0" + CStr(ValorDoMinutoDesligar)
        End If
        If ValorDoMinutoDesligar >= 10 And ValorDoMinutoDesligar < 60 Then
            minutoDesligar.Text = CStr(ValorDoMinutoDesligar)
        End If
        If ValorDoMinutoDesligar = 60 Then
            ValorDoMinutoDesligar = 0
            minutoDesligar.Text = "00"
        End If
    End Sub

    Private Sub btnMenosH_HorarioParaLigar_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btnMenosH_HorarioParaLigar.Click
        btnValidado.Visible = False
        ValorDaHoraLigar = ValorDaHoraLigar - 1

        If ValorDaHoraLigar < 10 And ValorDaHoraLigar > 0 Then
            horaLigar.Text = "0" + CStr(ValorDaHoraLigar)
        End If
        If ValorDaHoraLigar >= 10 And ValorDaHoraLigar < 24 Then
            horaLigar.Text = CStr(ValorDaHoraLigar)
        End If
        If ValorDaHoraLigar = 0 Then
            ValorDaHoraLigar = 24
            horaLigar.Text = "24"
        End If
        If ValorDaHoraLigar = -1 Then
            ValorDaHoraLigar = 23
            horaLigar.Text = "23"
        End If

    End Sub

    Private Sub btnMenosH_HorarioParaDesligar_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btnMenosH_HorarioParaDesligar.Click
        btnValidado.Visible = False
        ValorDaHoraDesligar = ValorDaHoraDesligar - 1

        If ValorDaHoraDesligar < 10 And ValorDaHoraDesligar > 0 Then
            horaDesligar.Text = "0" + CStr(ValorDaHoraDesligar)
        End If
        If ValorDaHoraDesligar >= 10 And ValorDaHoraDesligar < 24 Then
            horaDesligar.Text = CStr(ValorDaHoraDesligar)
        End If
        If ValorDaHoraDesligar = 0 Then
            ValorDaHoraDesligar = 24
            horaDesligar.Text = "24"
        End If
        If ValorDaHoraDesligar = -1 Then
            ValorDaHoraDesligar = 23
            horaDesligar.Text = "23"
        End If
    End Sub

    Private Sub btnMenosM_HorarioParaLigar_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btnMenosM_HorarioParaLigar.Click
        btnValidado.Visible = False
        ValorDoMinutoLigar = ValorDoMinutoLigar - 1

        If ValorDoMinutoLigar < 10 And ValorDoMinutoLigar > 0 Then
            minutoLigar.Text = "0" + CStr(ValorDoMinutoLigar)
        End If
        If ValorDoMinutoLigar >= 10 And ValorDoMinutoLigar < 60 Then
            minutoLigar.Text = CStr(ValorDoMinutoLigar)
        End If
        If ValorDoMinutoLigar = 0 Then
            ValorDoMinutoLigar = 60
            minutoLigar.Text = "00"
        End If
        If ValorDoMinutoLigar = -1 Then
            ValorDoMinutoLigar = 59
            minutoLigar.Text = "59"
        End If

    End Sub

    Private Sub btnMenosM_HorarioParaDesligar_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btnMenosM_HorarioParaDesligar.Click
        btnValidado.Visible = False
        ValorDoMinutoDesligar = ValorDoMinutoDesligar - 1

        If ValorDoMinutoDesligar < 10 And ValorDoMinutoDesligar > 0 Then
            minutoDesligar.Text = "0" + CStr(ValorDoMinutoDesligar)
        End If
        If ValorDoMinutoDesligar >= 10 And ValorDoMinutoDesligar < 60 Then
            minutoDesligar.Text = CStr(ValorDoMinutoDesligar)
        End If
        If ValorDoMinutoDesligar = 0 Then
            ValorDoMinutoDesligar = 60
            minutoDesligar.Text = "00"
        End If
        If ValorDoMinutoDesligar = -1 Then
            ValorDoMinutoDesligar = 59
            minutoDesligar.Text = "59"
        End If
    End Sub

  
    Private Sub btnSalvarDadosCena_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btnSalvarDadosCena.Click
        btnValidado.Visible = True

        If lbNomeDaCena.Text = "Cortina da Sala de Estar" Then
            SalaDeEstar_HoraAbrir.Text = horaLigar.Text
            SalaDeEstar_MinutoAbrir.Text = minutoLigar.Text
            SalaDeEstar_HoraFechar.Text = horaDesligar.Text
            SalaDeEstar_MinutoFechar.Text = minutoDesligar.Text
            Form1.SalaDeEstar_HorarioAbrir = SalaDeEstar_HoraAbrir.Text + ":" + SalaDeEstar_MinutoAbrir.Text
            Form1.SalaDeEstar_HorarioFechar = SalaDeEstar_HoraFechar.Text + ":" + SalaDeEstar_MinutoFechar.Text
            If horaLigar.Text = "00" And minutoLigar.Text = "00" And horaDesligar.Text = "00" And minutoDesligar.Text = "00" Then
                Form1.SalaDeEstar_Modo = 0
            Else
                If btnDiasDeSemana.Enabled = False Then
                    Form1.SalaDeEstar_Modo = 1
                End If
                If btnTodosOsDias.Enabled = False Then
                    Form1.SalaDeEstar_Modo = 2
                End If
            End If
        End If

        If lbNomeDaCena.Text = "Cortina do Quarto de Casal" Then
            QuartoDeCasal_HoraAbrir.Text = horaLigar.Text
            QuartoDeCasal_MinutoAbrir.Text = minutoLigar.Text
            QuartoDeCasal_HoraFechar.Text = horaDesligar.Text
            QuartoDeCasal_MinutoFechar.Text = minutoDesligar.Text
            Form1.QuartoDeCasal_HorarioAbrir = QuartoDeCasal_HoraAbrir.Text + ":" + QuartoDeCasal_MinutoAbrir.Text
            Form1.QuartoDeCasal_HorarioFechar = QuartoDeCasal_HoraFechar.Text + ":" + QuartoDeCasal_MinutoFechar.Text
            If horaLigar.Text = "00" And minutoLigar.Text = "00" And horaDesligar.Text = "00" And minutoDesligar.Text = "00" Then
                Form1.QuartoDeCasal_Modo = 0
            Else
                If btnDiasDeSemana.Enabled = False Then
                    Form1.QuartoDeCasal_Modo = 1
                End If
                If btnTodosOsDias.Enabled = False Then
                    Form1.QuartoDeCasal_Modo = 2
                End If
            End If
        End If

        If lbNomeDaCena.Text = "Cortina do Quarto 1" Then
            Quarto1_HoraAbrir.Text = horaLigar.Text
            Quarto1_MinutoAbrir.Text = minutoLigar.Text
            Quarto1_HoraFechar.Text = horaDesligar.Text
            Quarto1_MinutoFechar.Text = minutoDesligar.Text
            Form1.Quarto1_HorarioAbrir = Quarto1_HoraAbrir.Text + ":" + Quarto1_MinutoAbrir.Text
            Form1.Quarto1_HorarioFechar = Quarto1_HoraFechar.Text + ":" + Quarto1_MinutoFechar.Text
            If horaLigar.Text = "00" And minutoLigar.Text = "00" And horaDesligar.Text = "00" And minutoDesligar.Text = "00" Then
                Form1.Quarto1_Modo = 0
            Else
                If btnDiasDeSemana.Enabled = False Then
                    Form1.Quarto1_Modo = 1
                End If
                If btnTodosOsDias.Enabled = False Then
                    Form1.Quarto1_Modo = 2
                End If
            End If
        End If

        If lbNomeDaCena.Text = "Cortina do Quarto 2" Then
            Quarto2_HoraAbrir.Text = horaLigar.Text
            Quarto2_MinutoAbrir.Text = minutoLigar.Text
            Quarto2_HoraFechar.Text = horaDesligar.Text
            Quarto2_MinutoFechar.Text = minutoDesligar.Text
            Form1.Quarto2_HorarioAbrir = Quarto2_HoraAbrir.Text + ":" + Quarto2_MinutoAbrir.Text
            Form1.Quarto2_HorarioFechar = Quarto2_HoraFechar.Text + ":" + Quarto2_MinutoFechar.Text
            If horaLigar.Text = "00" And minutoLigar.Text = "00" And horaDesligar.Text = "00" And minutoDesligar.Text = "00" Then
                Form1.Quarto2_Modo = 0
            Else
                If btnDiasDeSemana.Enabled = False Then
                    Form1.Quarto2_Modo = 1
                End If
                If btnTodosOsDias.Enabled = False Then
                    Form1.Quarto2_Modo = 2
                End If
            End If
        End If


        If lbNomeDaCena.Text = "Persiana do Espaço Gourmet" Then
            EspacoGourmet_HoraAbrir.Text = horaLigar.Text
            EspacoGourmet_MinutoAbrir.Text = minutoLigar.Text
            EspacoGourmet_HoraFechar.Text = horaDesligar.Text
            EspacoGourmet_MinutoFechar.Text = minutoDesligar.Text
            Form1.EspacoGourmet_HorarioAbrir = EspacoGourmet_HoraAbrir.Text + ":" + EspacoGourmet_MinutoAbrir.Text
            Form1.EspacoGourmet_HorarioFechar = EspacoGourmet_HoraFechar.Text + ":" + EspacoGourmet_MinutoFechar.Text
            If horaLigar.Text = "00" And minutoLigar.Text = "00" And horaDesligar.Text = "00" And minutoDesligar.Text = "00" Then
                Form1.EspacoGourmet_Modo = 0
            Else
                If btnDiasDeSemana.Enabled = False Then
                    Form1.EspacoGourmet_Modo = 1
                End If
                If btnTodosOsDias.Enabled = False Then
                    Form1.EspacoGourmet_Modo = 2
                End If
            End If
        End If


        If lbNomeDaCena.Text = "Persiana do Lab. Eletrônica" Then
            labEletronica_HoraAbrir.Text = horaLigar.Text
            labEletronica_MinutoAbrir.Text = minutoLigar.Text
            labEletronica_HoraFechar.Text = horaDesligar.Text
            labEletronica_MinutoFechar.Text = minutoDesligar.Text
            Form1.LabEletronica_HorarioAbrir = labEletronica_HoraAbrir.Text + ":" + labEletronica_MinutoAbrir.Text
            Form1.LabEletronica_HorarioFechar = labEletronica_HoraFechar.Text + ":" + labEletronica_MinutoFechar.Text
            If horaLigar.Text = "00" And minutoLigar.Text = "00" And horaDesligar.Text = "00" And minutoDesligar.Text = "00" Then
                Form1.LabEletronica_Modo = 0
            Else
                If btnDiasDeSemana.Enabled = False Then
                    Form1.LabEletronica_Modo = 1
                End If
                If btnTodosOsDias.Enabled = False Then
                    Form1.LabEletronica_Modo = 2
                End If
            End If
        End If

        If lbNomeDaCena.Text = "Persiana da Cozinha" Then
            Cozinha_HoraAbrir.Text = horaLigar.Text
            Cozinha_MinutoAbrir.Text = minutoLigar.Text
            Cozinha_HoraFechar.Text = horaDesligar.Text
            Cozinha_MinutoFechar.Text = minutoDesligar.Text
            Form1.Cozinha_HorarioAbrir = Cozinha_HoraAbrir.Text + ":" + Cozinha_MinutoAbrir.Text
            Form1.Cozinha_HorarioFechar = Cozinha_HoraFechar.Text + ":" + Cozinha_MinutoFechar.Text
            If horaLigar.Text = "00" And minutoLigar.Text = "00" And horaDesligar.Text = "00" And minutoDesligar.Text = "00" Then
                Form1.Cozinha_Modo = 0
            Else
                If btnDiasDeSemana.Enabled = False Then
                    Form1.Cozinha_Modo = 1
                End If
                If btnTodosOsDias.Enabled = False Then
                    Form1.Cozinha_Modo = 2
                End If
            End If
        End If





    End Sub

    Private Sub btnDiasDeSemana_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btnDiasDeSemana.Click
        btnDesativado.Enabled = True
        btnDiasDeSemana.Enabled = False
        btnTodosOsDias.Enabled = True
    End Sub

    Private Sub btnTodosOsDias_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btnTodosOsDias.Click
        btnDesativado.Enabled = True
        btnDiasDeSemana.Enabled = True
        btnTodosOsDias.Enabled = False
    End Sub

    Private Sub Button3_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Button3.Click
        btnValidado.Visible = False
    End Sub

    Private Sub Button5_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Button5.Click
        btnValidado.Visible = False
    End Sub
End Class