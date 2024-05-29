Public Class TelaCortina

    Private Sub btnVoltar_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btnVoltar.Click
        Me.Hide()
    End Sub

    Private Sub Panel2_Paint(ByVal sender As System.Object, ByVal e As System.Windows.Forms.PaintEventArgs)

    End Sub

    Private Sub SalaDeEstarCortina_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles SalaDeEstarCortina.Click

        If Form1.cortinaSalaDeEstar = 1 Then
            Form1.SerialPort1.Write("cortinasaladeestar_0")
        End If

        If Form1.cortinaSalaDeEstar = 0 Then
            Form1.SerialPort1.Write("cortinasaladeestar_1")
        End If
    End Sub

    Private Sub SalaDeEstarConfigurarCena_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles SalaDeEstarConfigurarCena.Click
        TelaCenas.lbNomeDaCena.Text = "Cortina da Sala de Estar"
        TelaCenas.horaLigar.Text = TelaCenas.SalaDeEstar_HoraAbrir.Text
        TelaCenas.minutoLigar.Text = TelaCenas.SalaDeEstar_MinutoAbrir.Text
        TelaCenas.horaDesligar.Text = TelaCenas.SalaDeEstar_HoraFechar.Text
        TelaCenas.minutoDesligar.Text = TelaCenas.SalaDeEstar_MinutoFechar.Text
        TelaCenas.Panel2.Enabled = True
        TelaCenas.ValorDaHoraLigar = CInt(TelaCenas.horaLigar.Text)
        TelaCenas.ValorDoMinutoLigar = CInt(TelaCenas.minutoLigar.Text)
        TelaCenas.ValorDaHoraDesligar = CInt(TelaCenas.horaDesligar.Text)
        TelaCenas.ValorDoMinutoDesligar = CInt(TelaCenas.minutoDesligar.Text)
        If Form1.SalaDeEstar_Modo = 0 Then
            TelaCenas.btnDesativado.Enabled = False
            TelaCenas.btnDiasDeSemana.Enabled = True
            TelaCenas.btnTodosOsDias.Enabled = True
        End If
        If Form1.SalaDeEstar_Modo = 1 Then
            TelaCenas.btnDesativado.Enabled = True
            TelaCenas.btnDiasDeSemana.Enabled = False
            TelaCenas.btnTodosOsDias.Enabled = True
        End If
        If Form1.SalaDeEstar_Modo = 2 Then
            TelaCenas.btnDesativado.Enabled = True
            TelaCenas.btnDiasDeSemana.Enabled = True
            TelaCenas.btnTodosOsDias.Enabled = False
        End If
        TelaCenas.Show()


    End Sub

    Private Sub QuartoDeCasalCortina_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles QuartoDeCasalCortina.Click
        If Form1.cortinaQuartoDeCasal = 1 Then
            Form1.SerialPort1.Write("cortinaquartodecasal_0")
        End If

        If Form1.cortinaQuartoDeCasal = 0 Then
            Form1.SerialPort1.Write("cortinaquartodecasal_1")
        End If
    End Sub

    Private Sub QuartoDeCasalConfigurarCena_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles QuartoDeCasalConfigurarCena.Click
        TelaCenas.lbNomeDaCena.Text = "Cortina do Quarto de Casal"

        TelaCenas.horaLigar.Text = TelaCenas.QuartoDeCasal_HoraAbrir.Text
        TelaCenas.minutoLigar.Text = TelaCenas.QuartoDeCasal_MinutoAbrir.Text
        TelaCenas.horaDesligar.Text = TelaCenas.QuartoDeCasal_HoraFechar.Text
        TelaCenas.minutoDesligar.Text = TelaCenas.QuartoDeCasal_MinutoFechar.Text
        TelaCenas.Panel2.Enabled = True

        TelaCenas.ValorDaHoraLigar = CInt(TelaCenas.horaLigar.Text)
        TelaCenas.ValorDoMinutoLigar = CInt(TelaCenas.minutoLigar.Text)
        TelaCenas.ValorDaHoraDesligar = CInt(TelaCenas.horaDesligar.Text)
        TelaCenas.ValorDoMinutoDesligar = CInt(TelaCenas.minutoDesligar.Text)

        If Form1.QuartoDeCasal_Modo = 0 Then
            TelaCenas.btnDesativado.Enabled = False
            TelaCenas.btnDiasDeSemana.Enabled = True
            TelaCenas.btnTodosOsDias.Enabled = True
        End If
        If Form1.QuartoDeCasal_Modo = 1 Then
            TelaCenas.btnDesativado.Enabled = True
            TelaCenas.btnDiasDeSemana.Enabled = False
            TelaCenas.btnTodosOsDias.Enabled = True
        End If
        If Form1.QuartoDeCasal_Modo = 2 Then
            TelaCenas.btnDesativado.Enabled = True
            TelaCenas.btnDiasDeSemana.Enabled = True
            TelaCenas.btnTodosOsDias.Enabled = False
        End If


        TelaCenas.Show()
    End Sub

    Private Sub Quarto1Cortina_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Quarto1Cortina.Click
        If Form1.cortinaQuarto1 = 1 Then
            Form1.SerialPort1.Write("cortinaquarto1_0")
        End If

        If Form1.cortinaQuarto1 = 0 Then
            Form1.SerialPort1.Write("cortinaquarto1_1")
        End If
    End Sub

    Private Sub Quarto1ConfigurarCena_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Quarto1ConfigurarCena.Click
        TelaCenas.lbNomeDaCena.Text = "Cortina do Quarto 1"

        TelaCenas.horaLigar.Text = TelaCenas.Quarto1_HoraAbrir.Text
        TelaCenas.minutoLigar.Text = TelaCenas.Quarto1_MinutoAbrir.Text
        TelaCenas.horaDesligar.Text = TelaCenas.Quarto1_HoraFechar.Text
        TelaCenas.minutoDesligar.Text = TelaCenas.Quarto1_MinutoFechar.Text
        TelaCenas.Panel2.Enabled = True

        TelaCenas.ValorDaHoraLigar = CInt(TelaCenas.horaLigar.Text)
        TelaCenas.ValorDoMinutoLigar = CInt(TelaCenas.minutoLigar.Text)
        TelaCenas.ValorDaHoraDesligar = CInt(TelaCenas.horaDesligar.Text)
        TelaCenas.ValorDoMinutoDesligar = CInt(TelaCenas.minutoDesligar.Text)


        If Form1.Quarto1_Modo = 0 Then
            TelaCenas.btnDesativado.Enabled = False
            TelaCenas.btnDiasDeSemana.Enabled = True
            TelaCenas.btnTodosOsDias.Enabled = True
        End If
        If Form1.Quarto1_Modo = 1 Then
            TelaCenas.btnDesativado.Enabled = True
            TelaCenas.btnDiasDeSemana.Enabled = False
            TelaCenas.btnTodosOsDias.Enabled = True
        End If
        If Form1.Quarto1_Modo = 2 Then
            TelaCenas.btnDesativado.Enabled = True
            TelaCenas.btnDiasDeSemana.Enabled = True
            TelaCenas.btnTodosOsDias.Enabled = False
        End If


        TelaCenas.Show()
    End Sub

    Private Sub Quarto2Cortina_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Quarto2Cortina.Click
        If Form1.cortinaQuarto2 = 1 Then
            Form1.SerialPort1.Write("cortinaquarto2_0")
        End If

        If Form1.cortinaQuarto2 = 0 Then
            Form1.SerialPort1.Write("cortinaquarto2_1")
        End If
    End Sub

    Private Sub Quarto2ConfigurarCena_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Quarto2ConfigurarCena.Click
        TelaCenas.lbNomeDaCena.Text = "Cortina do Quarto 2"

        TelaCenas.horaLigar.Text = TelaCenas.Quarto2_HoraAbrir.Text
        TelaCenas.minutoLigar.Text = TelaCenas.Quarto2_MinutoAbrir.Text
        TelaCenas.horaDesligar.Text = TelaCenas.Quarto2_HoraFechar.Text
        TelaCenas.minutoDesligar.Text = TelaCenas.Quarto2_MinutoFechar.Text
        TelaCenas.Panel2.Enabled = True

        TelaCenas.ValorDaHoraLigar = CInt(TelaCenas.horaLigar.Text)
        TelaCenas.ValorDoMinutoLigar = CInt(TelaCenas.minutoLigar.Text)
        TelaCenas.ValorDaHoraDesligar = CInt(TelaCenas.horaDesligar.Text)
        TelaCenas.ValorDoMinutoDesligar = CInt(TelaCenas.minutoDesligar.Text)


        If Form1.Quarto2_Modo = 0 Then
            TelaCenas.btnDesativado.Enabled = False
            TelaCenas.btnDiasDeSemana.Enabled = True
            TelaCenas.btnTodosOsDias.Enabled = True
        End If
        If Form1.Quarto2_Modo = 1 Then
            TelaCenas.btnDesativado.Enabled = True
            TelaCenas.btnDiasDeSemana.Enabled = False
            TelaCenas.btnTodosOsDias.Enabled = True
        End If
        If Form1.Quarto2_Modo = 2 Then
            TelaCenas.btnDesativado.Enabled = True
            TelaCenas.btnDiasDeSemana.Enabled = True
            TelaCenas.btnTodosOsDias.Enabled = False
        End If


        TelaCenas.Show()
    End Sub

    Private Sub SalaDeEstarMais_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles SalaDeEstarMais.Click
        Form1.SerialPort1.Write("cortinasaladeestarmais")
    End Sub

    Private Sub SalaDeEstarMenos_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles SalaDeEstarMenos.Click
        Form1.SerialPort1.Write("cortinasaladeestarmenos")
    End Sub

    Private Sub SalaDeEstarSalvar_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles SalaDeEstarSalvar.Click
        Form1.SerialPort1.Write("cortinasaladeestarsalvar")
    End Sub

    Private Sub QuartoDeCasalMais_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles QuartoDeCasalMais.Click
        Form1.SerialPort1.Write("cortinaquartodecasalmais")
    End Sub

    Private Sub QuartoDeCasalMenos_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles QuartoDeCasalMenos.Click
        Form1.SerialPort1.Write("cortinaquartodecasalmenos")
    End Sub

    Private Sub QuartoDeCasalSalvar_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles QuartoDeCasalSalvar.Click
        Form1.SerialPort1.Write("cortinaquartodecasalsalvar")
    End Sub

    Private Sub Quarto1Mais_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Quarto1Mais.Click
        Form1.SerialPort1.Write("cortinaquarto1mais")
    End Sub

    Private Sub Quarto1Menos_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Quarto1Menos.Click
        Form1.SerialPort1.Write("cortinaquarto1menos")
    End Sub

    Private Sub Quarto1Salvar_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Quarto1Salvar.Click
        Form1.SerialPort1.Write("cortinaquarto1salvar")
    End Sub

    Private Sub Quarto2Mais_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Quarto2Mais.Click
        Form1.SerialPort1.Write("cortinaquarto2mais")
    End Sub

    Private Sub Quarto2Menos_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Quarto2Menos.Click
        Form1.SerialPort1.Write("cortinaquarto2menos")
    End Sub

    Private Sub Quarto2Salvar_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Quarto2Salvar.Click
        Form1.SerialPort1.Write("cortinaquarto2salvar")
    End Sub

    Private Sub CortinaAbrirTodas_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles CortinaAbrirTodas.Click
        Form1.SerialPort1.Write("cortinaabrirtodas")

    End Sub

    Private Sub CortinaFecharTodas_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles CortinaFecharTodas.Click
        Form1.SerialPort1.Write("cortinafechartodas")
    End Sub
End Class