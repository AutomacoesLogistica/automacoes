Public Class TelaEnergia
    Public valorDisj01 As Double
    Public valorDisj02 As Double
    Public valorDisj03 As Double
    Public valorDisj04 As Double
    Public valorDisj05 As Double
    Public valorDisj06 As Double
    Public valorDisj07 As Double
    Public valorDisj01a As Double
    Public valorDisj02a As Double
    Public valorDisj03a As Double
    Public valorDisj04a As Double
    Public valorDisj05a As Double
    Public valorDisj06a As Double
    Public valorDisj07a As Double

    Public valorDisj08 As Double
    Public valorDisj09 As Double
    Public valorDisj10 As Double
    Public valorDisj11 As Double
    Public valorDisj12 As Double
    Public valorDisj13 As Double
    Public valorDisj14 As Double
    Public valorDisj08a As Double
    Public valorDisj09a As Double
    Public valorDisj10a As Double
    Public valorDisj11a As Double
    Public valorDisj12a As Double
    Public valorDisj13a As Double
    Public valorDisj14a As Double

    Public corrente_total As Double
    Public corrente_1 As Double
    Public corrente_2 As Double
    Public consumo_total As Double
    Public consumo_1 As Double
    Public consumo_2 As Double
    Public Potencia_Total As Double


    Private Sub PictureBox1_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles DisjuntorIluminacao2.Click

    End Sub

    Private Sub btnVoltar_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btnVoltar.Click
        Me.Hide()
    End Sub

    Public Sub btnCalcularIluminacao_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btnCalcularIluminacao.Click


        

        valorDisj01 = (Form1.valorDisj_01 / 10)
        valorDisj02 = (Form1.valorDisj_02 / 10)
        valorDisj03 = (Form1.valorDisj_03 / 10)
        valorDisj04 = (Form1.valorDisj_04 / 10)
        valorDisj05 = (Form1.valorDisj_05 / 10)
        valorDisj06 = (Form1.valorDisj_06 / 10)
        valorDisj07 = (Form1.valorDisj_07 / 10)

        lbConsumo_01.Text = CStr(FormatNumber((valorDisj01 * 127.0) / 1000.0 * Form1.valorConstanteKWH, 3))
        valorDisj01a = FormatNumber((valorDisj01 * 127.0) / 1000.0, 3)
        lbConsumo_01.Text = CStr(lbConsumo_01.Text) + " KWh"

        lbConsumo_02.Text = CStr(FormatNumber((valorDisj02 * 127.0) / 1000.0 * Form1.valorConstanteKWH, 3))
        valorDisj02a = FormatNumber((valorDisj02 * 127.0) / 1000.0, 3)
        lbConsumo_02.Text = CStr(lbConsumo_02.Text) + " KWh"

        lbConsumo_03.Text = CStr(FormatNumber((valorDisj03 * 127.0) / 1000.0 * Form1.valorConstanteKWH, 3))
        valorDisj03a = FormatNumber((valorDisj03 * 127.0) / 1000.0, 3)
        lbConsumo_03.Text = CStr(lbConsumo_03.Text) + " KWh"

        lbConsumo_04.Text = CStr(FormatNumber((valorDisj04 * 127.0) / 1000.0 * Form1.valorConstanteKWH, 3))
        valorDisj04a = FormatNumber((valorDisj04 * 127.0) / 1000.0, 3)
        lbConsumo_04.Text = CStr(lbConsumo_04.Text) + " KWh"

        lbConsumo_05.Text = CStr(FormatNumber((valorDisj05 * 127.0) / 1000.0 * Form1.valorConstanteKWH, 3))
        valorDisj05a = FormatNumber((valorDisj05 * 127.0) / 1000.0, 3)
        lbConsumo_05.Text = CStr(lbConsumo_05.Text) + " KWh"

        lbConsumo_06.Text = CStr(FormatNumber((valorDisj06 * 127.0) / 1000.0 * Form1.valorConstanteKWH, 3))
        valorDisj06a = FormatNumber((valorDisj06 * 127.0) / 1000.0, 3)
        lbConsumo_06.Text = CStr(lbConsumo_06.Text) + " KWh"

        lbConsumo_07.Text = CStr(FormatNumber((valorDisj07 * 127.0) / 1000.0 * Form1.valorConstanteKWH, 3))
        valorDisj07a = FormatNumber((valorDisj07 * 127.0) / 1000.0, 3)
        lbConsumo_07.Text = CStr(lbConsumo_07.Text) + " KWh"


        lbDisj_01a07.Text = CStr(FormatNumber((valorDisj01 + valorDisj02 + valorDisj03 + valorDisj04 + valorDisj05 + valorDisj06 + valorDisj07), 1))
        lbDisj_01a07.Text = CStr(lbDisj_01a07.Text) + " A"

        lbConsumo_01a07.Text = CStr(FormatNumber((valorDisj01a + valorDisj02a + valorDisj03a + valorDisj04a + valorDisj05a + valorDisj06a + valorDisj07a), 3))
        lbConsumo_01a07.Text = CStr(lbConsumo_01a07.Text) + " KWh"

        lbDisj_01.Text = lbDisj_01.Text + " A "
        lbDisj_02.Text = lbDisj_02.Text + " A "
        lbDisj_03.Text = lbDisj_03.Text + " A "
        lbDisj_04.Text = lbDisj_04.Text + " A "
        lbDisj_05.Text = lbDisj_05.Text + " A "
        lbDisj_06.Text = lbDisj_06.Text + " A "
        lbDisj_07.Text = lbDisj_07.Text + " A "



        ' ADQUIRINDO A CORRENTE TOTAL

        corrente_1 = CStr(FormatNumber((valorDisj01 + valorDisj02 + valorDisj03 + valorDisj04 + valorDisj05 + valorDisj06 + valorDisj07), 1))
        corrente_2 = CStr(FormatNumber((valorDisj08 + valorDisj09 + valorDisj10 + valorDisj11 + valorDisj12 + valorDisj13 + valorDisj14), 1))
        corrente_total = corrente_1 + corrente_2
        lbCorrenteTotal.Text = CStr(FormatNumber(corrente_total, 1)) + " A"

        '  ADQUIRINDO O CONSUMO TOTAL

        consumo_1 = CStr(FormatNumber((valorDisj01a + valorDisj02a + valorDisj03a + valorDisj04a + valorDisj05a + valorDisj06a + valorDisj07a), 3))
        consumo_2 = CStr(FormatNumber((valorDisj08a + valorDisj09a + valorDisj10a + valorDisj11a + valorDisj12a + valorDisj13a + valorDisj14a), 3))
        consumo_total = consumo_1 + consumo_2

        Form1.ConsumoAcumulado = Form1.ConsumoAcumulado + (FormatNumber(consumo_total, 3))
        lbConsumoTotal.Text = CStr(FormatNumber(Form1.ConsumoAcumulado, 3)) + " KWh"

        ' ADQUIRINDO A POTENCIA TOTAL
        Potencia_Total = FormatNumber((corrente_total * 127.0), 1)

        If Potencia_Total > 1000 Then
            Potencia_Total = (Potencia_Total / 1000)
            lbPotenciaTotal.Text = CStr(Potencia_Total) + " kW"

        Else
            lbPotenciaTotal.Text = CStr(Potencia_Total) + " W"
        End If


    End Sub


    Private Sub btnCalcularTomada_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btnCalcularTomada.Click


       

        valorDisj08 = (Form1.valorDisj_08 / 10)
        valorDisj09 = (Form1.valorDisj_09 / 10)
        valorDisj10 = (Form1.valorDisj_10 / 10)
        valorDisj11 = (Form1.valorDisj_11 / 10)
        valorDisj12 = (Form1.valorDisj_12 / 10)
        valorDisj13 = (Form1.valorDisj_13 / 10)
        valorDisj14 = (Form1.valorDisj_14 / 10)

        lbConsumo_08.Text = CStr(FormatNumber((valorDisj08 * 127.0) / 1000.0 * Form1.valorConstanteKWH, 3))
        valorDisj08a = FormatNumber((valorDisj08 * 127.0) / 1000.0, 3)
        lbConsumo_08.Text = CStr(lbConsumo_08.Text) + " KWh"


        lbConsumo_09.Text = CStr(FormatNumber((valorDisj09 * 127.0) / 1000.0 * Form1.valorConstanteKWH, 3))
        valorDisj09a = FormatNumber((valorDisj09 * 127.0) / 1000.0, 3)
        lbConsumo_09.Text = CStr(lbConsumo_09.Text) + " KWh"

        lbConsumo_10.Text = CStr(FormatNumber((valorDisj10 * 127.0) / 1000.0 * Form1.valorConstanteKWH, 3))
        valorDisj10a = FormatNumber((valorDisj10 * 127.0) / 1000.0, 3)
        lbConsumo_10.Text = CStr(lbConsumo_10.Text) + " KWh"

        lbConsumo_11.Text = CStr(FormatNumber((valorDisj11 * 127.0) / 1000.0 * Form1.valorConstanteKWH, 3))
        valorDisj11a = FormatNumber((valorDisj11 * 127.0) / 1000.0, 3)
        lbConsumo_11.Text = CStr(lbConsumo_11.Text) + " KWh"

        lbConsumo_12.Text = CStr(FormatNumber((valorDisj12 * 127.0) / 1000.0 * Form1.valorConstanteKWH, 3))
        valorDisj12a = FormatNumber((valorDisj12 * 127.0) / 1000.0, 3)
        lbConsumo_12.Text = CStr(lbConsumo_12.Text) + " KWh"

        lbConsumo_13.Text = CStr(FormatNumber((valorDisj13 * 127.0) / 1000.0 * Form1.valorConstanteKWH, 3))
        valorDisj13a = FormatNumber((valorDisj13 * 127.0) / 1000.0, 3)
        lbConsumo_13.Text = CStr(lbConsumo_13.Text) + " KWh"

        lbConsumo_14.Text = CStr(FormatNumber((valorDisj14 * 127.0) / 1000.0 * Form1.valorConstanteKWH, 3))
        valorDisj14a = FormatNumber((valorDisj14 * 127.0) / 1000.0, 3)
        lbConsumo_14.Text = CStr(lbConsumo_14.Text) + " KWh"


        lbDisj_08a14.Text = CStr(FormatNumber((valorDisj08 + valorDisj09 + valorDisj10 + valorDisj11 + valorDisj12 + valorDisj13 + valorDisj14), 1))
        lbDisj_08a14.Text = CStr(lbDisj_08a14.Text) + " A"

        lbConsumo_08a14.Text = CStr(FormatNumber((valorDisj08a + valorDisj09a + valorDisj10a + valorDisj11a + valorDisj12a + valorDisj13a + valorDisj14a), 3))
        lbConsumo_08a14.Text = CStr(lbConsumo_08a14.Text) + " KWh"


        lbDisj_08.Text = lbDisj_08.Text + " A "
        lbDisj_09.Text = lbDisj_09.Text + " A "
        lbDisj_10.Text = lbDisj_10.Text + " A "
        lbDisj_11.Text = lbDisj_11.Text + " A "
        lbDisj_12.Text = lbDisj_12.Text + " A "
        lbDisj_13.Text = lbDisj_13.Text + " A "
        lbDisj_14.Text = lbDisj_14.Text + " A "


        ' ADQUIRINDO A CORRENTE TOTAL

        corrente_1 = CStr(FormatNumber((valorDisj01 + valorDisj02 + valorDisj03 + valorDisj04 + valorDisj05 + valorDisj06 + valorDisj07), 1))
        corrente_2 = CStr(FormatNumber((valorDisj08 + valorDisj09 + valorDisj10 + valorDisj11 + valorDisj12 + valorDisj13 + valorDisj14), 1))
        corrente_total = corrente_1 + corrente_2
        lbCorrenteTotal.Text = CStr(FormatNumber(corrente_total, 1)) + " A"

        '  ADQUIRINDO O CONSUMO TOTAL

        consumo_1 = CStr(FormatNumber((valorDisj01a + valorDisj02a + valorDisj03a + valorDisj04a + valorDisj05a + valorDisj06a + valorDisj07a), 3))
        consumo_2 = CStr(FormatNumber((valorDisj08a + valorDisj09a + valorDisj10a + valorDisj11a + valorDisj12a + valorDisj13a + valorDisj14a), 3))
        consumo_total = consumo_1 + consumo_2

        Form1.ConsumoAcumulado = Form1.ConsumoAcumulado + (FormatNumber(consumo_total, 3))
        lbConsumoTotal.Text = CStr(FormatNumber(Form1.ConsumoAcumulado, 3)) + " KWh"


        ' ADQUIRINDO A POTENCIA TOTAL
        Potencia_Total = CStr(FormatNumber((corrente_total * 127.0), 1))

        If Potencia_Total > 1000 Then
            Potencia_Total = (Potencia_Total / 1000)
            lbPotenciaTotal.Text = CStr(Potencia_Total) + " kW"

        Else
            lbPotenciaTotal.Text = CStr(Potencia_Total) + " W"
        End If



    End Sub

    
End Class