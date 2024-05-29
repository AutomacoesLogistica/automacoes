Public Class TelaPersiana

    Private Sub btnVoltar_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btnVoltar.Click
        Me.Hide()
    End Sub

  
    Private Sub EspacoGourmetPersiana1_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles EspacoGourmetPersiana1.Click
        If EspacoGourmetAcionamentoSimultaneo.Checked = False Then
            If Form1.EspacoGourmetPersiana1 = 1 Then
                Form1.SerialPort1.Write("espacogourmetpersiana1_0")
            End If

            If Form1.EspacoGourmetPersiana1 = 0 Then
                Form1.SerialPort1.Write("espacogourmetpersiana1_1")
            End If

        Else
            If Form1.EspacoGourmetPersiana1 = 1 Then
                Form1.SerialPort1.Write("espacogourmetpersianas_0")
            End If
            If Form1.EspacoGourmetPersiana1 = 0 Then
                Form1.SerialPort1.Write("espacogourmetpersianas_1")
            End If

            End If




    End Sub

    Private Sub EspacoGourmetPersiana2_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles EspacoGourmetPersiana2.Click
        If EspacoGourmetAcionamentoSimultaneo.Checked = False Then
            If Form1.EspacoGourmetPersiana2 = 1 Then
                Form1.SerialPort1.Write("espacogourmetpersiana2_0")
            End If

            If Form1.EspacoGourmetPersiana2 = 0 Then
                Form1.SerialPort1.Write("espacogourmetpersiana2_1")
            End If
        Else



        End If

    End Sub

    Private Sub EspacoGourmetPersiana3_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles EspacoGourmetPersiana3.Click
        If EspacoGourmetAcionamentoSimultaneo.Checked = False Then
            If Form1.EspacoGourmetPersiana3 = 1 Then
                Form1.SerialPort1.Write("espacogourmetpersiana3_0")
            End If

            If Form1.EspacoGourmetPersiana3 = 0 Then
                Form1.SerialPort1.Write("espacogourmetpersiana3_1")
            End If
        Else



        End If
    End Sub

    Private Sub EspacoGourmetPersianaConfigurarCena_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles EspacoGourmetPersianaConfigurarCena.Click
        TelaCenas.lbNomeDaCena.Text = "Persiana do Espaço Gourmet"
        TelaCenas.horaLigar.Text = TelaCenas.EspacoGourmet_HoraAbrir.Text
        TelaCenas.minutoLigar.Text = TelaCenas.EspacoGourmet_MinutoAbrir.Text
        TelaCenas.horaDesligar.Text = TelaCenas.EspacoGourmet_HoraFechar.Text
        TelaCenas.minutoDesligar.Text = TelaCenas.EspacoGourmet_MinutoFechar.Text
        TelaCenas.Panel2.Enabled = True
        TelaCenas.ValorDaHoraLigar = CInt(TelaCenas.horaLigar.Text)
        TelaCenas.ValorDoMinutoLigar = CInt(TelaCenas.minutoLigar.Text)
        TelaCenas.ValorDaHoraDesligar = CInt(TelaCenas.horaDesligar.Text)
        TelaCenas.ValorDoMinutoDesligar = CInt(TelaCenas.minutoDesligar.Text)
        If Form1.EspacoGourmet_Modo = 0 Then
            TelaCenas.btnDesativado.Enabled = False
            TelaCenas.btnDiasDeSemana.Enabled = True
            TelaCenas.btnTodosOsDias.Enabled = True
        End If
        If Form1.EspacoGourmet_Modo = 1 Then
            TelaCenas.btnDesativado.Enabled = True
            TelaCenas.btnDiasDeSemana.Enabled = False
            TelaCenas.btnTodosOsDias.Enabled = True
        End If
        If Form1.EspacoGourmet_Modo = 2 Then
            TelaCenas.btnDesativado.Enabled = True
            TelaCenas.btnDiasDeSemana.Enabled = True
            TelaCenas.btnTodosOsDias.Enabled = False
        End If
        TelaCenas.Show()

    End Sub

    Private Sub EspacoGourmetAcionamentoSimultaneo_CheckedChanged(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles EspacoGourmetAcionamentoSimultaneo.CheckedChanged
        If EspacoGourmetAcionamentoSimultaneo.Checked = True Then
            EspacoGourmetAcionamentoIndividual.Checked = False

        End If

    End Sub

    Private Sub EspacoGourmetAcionamentoIndividual_CheckedChanged(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles EspacoGourmetAcionamentoIndividual.CheckedChanged
        If EspacoGourmetAcionamentoIndividual.Checked = True Then
            EspacoGourmetAcionamentoSimultaneo.Checked = False
        End If

        
    End Sub

    Private Sub LabEletronicaPersiana_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles LabEletronicaPersiana.Click
        If Form1.LabEletronicaPersiana = 1 Then
            Form1.SerialPort1.Write("labeletronicapersiana_0")
        End If

        If Form1.LabEletronicaPersiana = 0 Then
            Form1.SerialPort1.Write("labeletronicapersiana_1")
        End If
    End Sub

    Private Sub LabEletronicaConfigurarCena_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles LabEletronicaConfigurarCena.Click
        TelaCenas.lbNomeDaCena.Text = "Persiana do Lab. Eletrônica"
        TelaCenas.horaLigar.Text = TelaCenas.labEletronica_HoraAbrir.Text
        TelaCenas.minutoLigar.Text = TelaCenas.labEletronica_MinutoAbrir.Text
        TelaCenas.horaDesligar.Text = TelaCenas.labEletronica_HoraFechar.Text
        TelaCenas.minutoDesligar.Text = TelaCenas.labEletronica_MinutoFechar.Text
        TelaCenas.Panel2.Enabled = True
        TelaCenas.ValorDaHoraLigar = CInt(TelaCenas.horaLigar.Text)
        TelaCenas.ValorDoMinutoLigar = CInt(TelaCenas.minutoLigar.Text)
        TelaCenas.ValorDaHoraDesligar = CInt(TelaCenas.horaDesligar.Text)
        TelaCenas.ValorDoMinutoDesligar = CInt(TelaCenas.minutoDesligar.Text)
        If Form1.LabEletronica_Modo = 0 Then
            TelaCenas.btnDesativado.Enabled = False
            TelaCenas.btnDiasDeSemana.Enabled = True
            TelaCenas.btnTodosOsDias.Enabled = True
        End If
        If Form1.LabEletronica_Modo = 1 Then
            TelaCenas.btnDesativado.Enabled = True
            TelaCenas.btnDiasDeSemana.Enabled = False
            TelaCenas.btnTodosOsDias.Enabled = True
        End If
        If Form1.LabEletronica_Modo = 2 Then
            TelaCenas.btnDesativado.Enabled = True
            TelaCenas.btnDiasDeSemana.Enabled = True
            TelaCenas.btnTodosOsDias.Enabled = False
        End If
        TelaCenas.Show()
    End Sub

    Private Sub CozinhaPersiana_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles CozinhaPersiana.Click
        If Form1.CozinhaPersiana = 1 Then
            Form1.SerialPort1.Write("cozinhapersiana_0")
        End If

        If Form1.CozinhaPersiana = 0 Then
            Form1.SerialPort1.Write("cozinhapersiana_1")
        End If
    End Sub

    Private Sub CozinhaConfigurarCena_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles CozinhaConfigurarCena.Click
        TelaCenas.lbNomeDaCena.Text = "Persiana da Cozinha"
        TelaCenas.horaLigar.Text = TelaCenas.Cozinha_HoraAbrir.Text
        TelaCenas.minutoLigar.Text = TelaCenas.Cozinha_MinutoAbrir.Text
        TelaCenas.horaDesligar.Text = TelaCenas.Cozinha_HoraFechar.Text
        TelaCenas.minutoDesligar.Text = TelaCenas.Cozinha_MinutoFechar.Text
        TelaCenas.Panel2.Enabled = True
        TelaCenas.ValorDaHoraLigar = CInt(TelaCenas.horaLigar.Text)
        TelaCenas.ValorDoMinutoLigar = CInt(TelaCenas.minutoLigar.Text)
        TelaCenas.ValorDaHoraDesligar = CInt(TelaCenas.horaDesligar.Text)
        TelaCenas.ValorDoMinutoDesligar = CInt(TelaCenas.minutoDesligar.Text)
        If Form1.Cozinha_Modo = 0 Then
            TelaCenas.btnDesativado.Enabled = False
            TelaCenas.btnDiasDeSemana.Enabled = True
            TelaCenas.btnTodosOsDias.Enabled = True
        End If
        If Form1.Cozinha_Modo = 1 Then
            TelaCenas.btnDesativado.Enabled = True
            TelaCenas.btnDiasDeSemana.Enabled = False
            TelaCenas.btnTodosOsDias.Enabled = True
        End If
        If Form1.Cozinha_Modo = 2 Then
            TelaCenas.btnDesativado.Enabled = True
            TelaCenas.btnDiasDeSemana.Enabled = True
            TelaCenas.btnTodosOsDias.Enabled = False
        End If
        TelaCenas.Show()
    End Sub

    Private Sub EspacoGourmetMais_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles EspacoGourmetMais.Click

    End Sub

    Private Sub EspacoGourmetMenos_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles EspacoGourmetMenos.Click

    End Sub

    Private Sub EspacoGourmetSalva_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles EspacoGourmetSalva.Click

    End Sub

    Private Sub LabEletronicaMais_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles LabEletronicaMais.Click

    End Sub

    Private Sub LabEletronicaMenos_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles LabEletronicaMenos.Click

    End Sub

    Private Sub LabEletronicaSalva_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles LabEletronicaSalva.Click

    End Sub

    Private Sub CozinhaMais_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles CozinhaMais.Click

    End Sub

    Private Sub CozinhaMenos_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles CozinhaMenos.Click

    End Sub

    Private Sub CozinhaSalva_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles CozinhaSalva.Click

    End Sub

    Private Sub btnPersianaAbrirTodas_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btnPersianaAbrirTodas.Click
        Form1.SerialPort1.Write("persianasabrirtodas")
    End Sub

    Private Sub btnPersianaFecharTodas_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btnPersianaFecharTodas.Click
        Form1.SerialPort1.Write("persianasfechartodas")
    End Sub
End Class