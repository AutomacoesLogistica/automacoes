Public Class Tela_Iluminacao

    Private Sub btnVoltar_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btnVoltar.Click
        Me.Hide()

    End Sub

    Private Sub imgIluminacaoAreaChurrasco_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles imgIluminacaoAreaChurrasco.Click

    End Sub

    Private Sub imgPendenteAreaChurrasco_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles imgPendenteAreaChurrasco.Click

    End Sub

    Private Sub imgAmbienteAreaChurrasco_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles imgAmbienteAreaChurrasco.Click

    End Sub

    Private Sub imgArandelaAreaChurrasco_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles imgArandelaAreaChurrasco.Click

    End Sub

    Private Sub imgVagaCarro1_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles imgVagaCarro1.Click

    End Sub

    Private Sub imgVagaCarro2_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles imgVagaCarro2.Click

    End Sub

    Private Sub imgVagaCarro3_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles imgVagaCarro3.Click

    End Sub

    Private Sub imgJardimVertical_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles imgJardimVertical.Click

    End Sub

    Private Sub imgJardimHorizontal_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles imgJardimHorizontal.Click

    End Sub

    Private Sub imgArandelasCasa_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles imgArandelasCasa.Click

    End Sub

    Private Sub imgArandelaCarros_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles imgArandelaCarros.Click

    End Sub

    Private Sub SalaDeEstar_IluminacaoDaSala_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles SalaDeEstar_IluminacaoDaSala.Click
        If Form1.SalaDeEstarIluminacaoDaSala = 0 Then
            On Error Resume Next
            Form1.SerialPort1.Write("se_iluminacaodasala_1")
        End If
        If Form1.SalaDeEstarIluminacaoDaSala = 1 Then
            On Error Resume Next
            Form1.SerialPort1.Write("se_iluminacaodasala_0")
        End If

    End Sub

    Private Sub SalaDeEstar_ArandelasPainelTV_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles SalaDeEstar_ArandelasPainelTV.Click
        If Form1.SalaDeEstarArandelasPainelTv = 0 Then
            On Error Resume Next
            Form1.SerialPort1.Write("se_arandelaspaineltv_1")
        End If
        If Form1.SalaDeEstarArandelasPainelTv = 1 Then
            On Error Resume Next
            Form1.SerialPort1.Write("se_arandelaspaineltv_0")
        End If
    End Sub

    Private Sub SalaDeEstar_LustreDaSala_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles SalaDeEstar_LustreDaSala.Click
        If Form1.SalaDeEstarLustreDaSalaDeEstar = 0 Then
            On Error Resume Next
            Form1.SerialPort1.Write("se_lustredasala_1")
        End If
        If Form1.SalaDeEstarLustreDaSalaDeEstar = 1 Then
            On Error Resume Next
            Form1.SerialPort1.Write("se_lustredasala_0")
        End If
    End Sub

    Private Sub SalaDeEstar_IluminacaoDaSacada_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles SalaDeEstar_IluminacaoDaSacada.Click
        If Form1.SalaDeEstarIluminacaoDaSacada = 0 Then
            On Error Resume Next
            Form1.SerialPort1.Write("se_iluminacaodasacada_1")
        End If
        If Form1.SalaDeEstarIluminacaoDaSacada = 1 Then
            On Error Resume Next
            Form1.SerialPort1.Write("se_iluminacaodasacada_0")
        End If
    End Sub

    Private Sub Quarto1_IluminacaoDoQuarto_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Quarto1_IluminacaoDoQuarto.Click
        If Form1.Quarto1IluminacaoDoQuarto = 0 Then
            On Error Resume Next
            Form1.SerialPort1.Write("q1_iluminacaodoquarto_1")
        End If
        If Form1.Quarto1IluminacaoDoQuarto = 1 Then
            On Error Resume Next
            Form1.SerialPort1.Write("q1_iluminacaodoquarto_0")
        End If

    End Sub

    Private Sub Quarto1_ArandelasPainelTV_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Quarto1_ArandelasPainelTV.Click
        If Form1.Quarto1ArandelasPainelTV = 0 Then
            On Error Resume Next
            Form1.SerialPort1.Write("q1_arandelaspaineltv_1")
        End If
        If Form1.Quarto1ArandelasPainelTV = 1 Then
            On Error Resume Next
            Form1.SerialPort1.Write("q1_arandelaspaineltv_0")
        End If

    End Sub

    Private Sub Quarto1_IluminacaoDoCortineiro_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Quarto1_IluminacaoDoCortineiro.Click
        If Form1.Quarto1IluminacaoDoCortineiro = 0 Then
            On Error Resume Next
            Form1.SerialPort1.Write("q1_iluminacaodocortineiro_1")
        End If
        If Form1.Quarto1IluminacaoDoCortineiro = 1 Then
            On Error Resume Next
            Form1.SerialPort1.Write("q1_iluminacaodocortineiro_0")
        End If
    End Sub

    Private Sub Quarto2_IluminacaoDoQuarto_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Quarto2_IluminacaoDoQuarto.Click
        If Form1.Quarto2IluminacaoDoQuarto = 0 Then
            On Error Resume Next
            Form1.SerialPort1.Write("q2_iluminacaodoquarto_1")
        End If
        If Form1.Quarto2IluminacaoDoQuarto = 1 Then
            On Error Resume Next
            Form1.SerialPort1.Write("q2_iluminacaodoquarto_0")
        End If
    End Sub

    Private Sub Quarto2_ArandelasPainelTV_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Quarto2_ArandelasPainelTV.Click
        If Form1.Quarto2ArandelasPainelTV = 0 Then
            On Error Resume Next
            Form1.SerialPort1.Write("q2_arandelaspaineltv_1")
        End If
        If Form1.Quarto2ArandelasPainelTV = 1 Then
            On Error Resume Next
            Form1.SerialPort1.Write("q2_arandelaspaineltv_0")
        End If
    End Sub

    Private Sub Quarto2_IluminacaoDoCortineiro_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Quarto2_IluminacaoDoCortineiro.Click
        If Form1.Quarto2IluminacaoDoCortineiro = 0 Then
            On Error Resume Next
            Form1.SerialPort1.Write("q2_iluminacaodocortineiro_1")
        End If
        If Form1.Quarto2IluminacaoDoCortineiro = 1 Then
            On Error Resume Next
            Form1.SerialPort1.Write("q2_iluminacaodocortineiro_0")
        End If
    End Sub

    Private Sub Cozinha_IluminacaoDaCozinha_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Cozinha_IluminacaoDaCozinha.Click
        If Form1.CozinhaIluminacaoDaCozinha = 0 Then
            On Error Resume Next
            Form1.SerialPort1.Write("cz_iluminacaodacozinha_1")
        End If
        If Form1.CozinhaIluminacaoDaCozinha = 1 Then
            On Error Resume Next
            Form1.SerialPort1.Write("cz_iluminacaodacozinha_0")
        End If
    End Sub

    Private Sub Cozinha_PendentesDaIlha_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Cozinha_PendentesDaIlha.Click
        If Form1.CozinhaPendentesDaIlha = 0 Then
            On Error Resume Next
            Form1.SerialPort1.Write("cz_pendentesdailha_1")
        End If
        If Form1.CozinhaPendentesDaIlha = 1 Then
            On Error Resume Next
            Form1.SerialPort1.Write("cz_pendentesdailha_0")
        End If
    End Sub

    Private Sub Cozinha_IluminacaoAmbiente_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Cozinha_IluminacaoAmbiente.Click
        If Form1.CozinhaIluminacaoAmbiente = 0 Then
            On Error Resume Next
            Form1.SerialPort1.Write("cz_iluminacaoambiente_1")
        End If
        If Form1.CozinhaIluminacaoAmbiente = 1 Then
            On Error Resume Next
            Form1.SerialPort1.Write("cz_iluminacaoambiente_0")
        End If
    End Sub

    Private Sub Cozinha_IluminacaoCorredor_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Cozinha_IluminacaoCorredor.Click
        If Form1.CozinhaIluminacaoDoCorredor = 0 Then
            On Error Resume Next
            Form1.SerialPort1.Write("cz_iluminacaodocorredor_1")
        End If
        If Form1.CozinhaIluminacaoDoCorredor = 1 Then
            On Error Resume Next
            Form1.SerialPort1.Write("cz_iluminacaodocorredor_0")
        End If
    End Sub

    Private Sub QuartoDeCasal_IluminacaoDoQuarto_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles QuartoDeCasal_IluminacaoDoQuarto.Click
        If Form1.QuartodeCasalIluminacaoDoQuarto = 0 Then
            On Error Resume Next
            Form1.SerialPort1.Write("qc_iluminacaodoquarto_1")
        End If
        If Form1.QuartodeCasalIluminacaoDoQuarto = 1 Then
            On Error Resume Next
            Form1.SerialPort1.Write("qc_iluminacaodoquarto_0")
        End If
    End Sub

    Private Sub QuartoDeCasal_ArandelasPainelTV_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles QuartoDeCasal_ArandelasPainelTV.Click
        If Form1.QuartodeCasalArandelasPainelTV = 0 Then
            On Error Resume Next
            Form1.SerialPort1.Write("qc_arandelaspaineltv_1")
        End If
        If Form1.QuartodeCasalArandelasPainelTV = 1 Then
            On Error Resume Next
            Form1.SerialPort1.Write("qc_arandelaspaineltv_0")
        End If
    End Sub

    Private Sub QuartoDeCasal_IluminacaoDoCortineiro_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles QuartoDeCasal_IluminacaoDoCortineiro.Click
        If Form1.QuartodeCasalIluminacaoDoCortineiro = 0 Then
            On Error Resume Next
            Form1.SerialPort1.Write("qc_iluminacaodocortineiro_1")
        End If
        If Form1.QuartodeCasalIluminacaoDoCortineiro = 1 Then
            On Error Resume Next
            Form1.SerialPort1.Write("qc_iluminacaodocortineiro_0")
        End If
    End Sub

    Private Sub EspacoGourmet_IluminaçãoAmbiente_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles EspacoGourmet_IluminaçãoAmbiente.Click
        If Form1.EspacoGourmetIluminacaoAmbiente = 0 Then
            On Error Resume Next
            Form1.SerialPort1.Write("eg_iluminacaoambiente_1")
        End If
        If Form1.EspacoGourmetIluminacaoAmbiente = 1 Then
            On Error Resume Next
            Form1.SerialPort1.Write("eg_iluminacaoambiente_0")
        End If
    End Sub

    Private Sub EspacoGourmet_PendentesBancada_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles EspacoGourmet_PendentesBancada.Click
        If Form1.EspacoGourmetPendentesBancada = 0 Then
            On Error Resume Next
            Form1.SerialPort1.Write("eg_pendentesdabancada_1")
        End If
        If Form1.EspacoGourmetPendentesBancada = 1 Then
            On Error Resume Next
            Form1.SerialPort1.Write("eg_pendentesdabancada_0")
        End If
    End Sub

    Private Sub EspacoGourmet_IluminacaoChurrasqueira_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles EspacoGourmet_IluminacaoChurrasqueira.Click
        If Form1.EspacoGourmetIluminacaoDaChurrasqueira = 0 Then
            On Error Resume Next
            Form1.SerialPort1.Write("eg_iluminacaodachurrasqueira_1")
        End If
        If Form1.EspacoGourmetIluminacaoDaChurrasqueira = 1 Then
            On Error Resume Next
            Form1.SerialPort1.Write("eg_iluminacaodachurrasqueira_0")
        End If
    End Sub

    Private Sub btnApagaTodasCasa_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btnApagaTodasCasa.Click
        On Error Resume Next
        Form1.SerialPort1.Write("apagartodascasa")
        
    End Sub

    Private Sub btnApagarTodasExterna_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btnApagarTodasExterna.Click
        On Error Resume Next
        Form1.SerialPort1.Write("apagartodasexterna")
    End Sub
End Class