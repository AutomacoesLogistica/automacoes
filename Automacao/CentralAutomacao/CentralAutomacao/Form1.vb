
Imports System.ComponentModel
Imports System.Net.Mail
Imports Microsoft.Office.Interop

' para funcionar ir em project e adicionar referencia em COM     Microsoft excel


Imports System
Imports System.Threading
Imports System.IO.Ports

Public Class Form1

    Dim Minha_Porta As Array  'COM Ports detected on the system will be stored here
    Delegate Sub SetTextCallback(ByVal [text] As String) 'Added to prevent threading errors during receiveing of data
    Public mensagem1 As String
    Public mensagem2 As String
    Public usb As Integer
    Dim tam_Mensagem As Integer
    Dim Mensagem As String
    Dim Ultima_Mensagem As String


    Public tempoAtualizarKWh As Integer
    Public valorConstanteKWH As Double
    Public ConsumoAcumulado As Double


    ' VARIAVEIS TIMER_CENAS
    Public dataAtual As Date = Now
    Public diaDaSemana As Integer = dataAtual.DayOfWeek
    Public diaDaSemanaAbreviado As String = Format(dataAtual, "ddd")
    Public diaDaSemanaExpandido As String = String.Format("{0:dddd}", dataAtual)
    Public resultado As String







    ' VARIAVEIS TELA CENA   
    Public EspacoGourmet_HorarioAbrir As String
    Public EspacoGourmet_HorarioFechar As String
    Public EspacoGourmet_Modo As Integer
    Public LabEletronica_HorarioAbrir As String
    Public LabEletronica_HorarioFechar As String
    Public LabEletronica_Modo As Integer
    Public Cozinha_HorarioAbrir As String
    Public Cozinha_HorarioFechar As String
    Public Cozinha_Modo As Integer
    Public SalaDeEstar_HorarioAbrir As String
    Public SalaDeEstar_HorarioFechar As String
    Public SalaDeEstar_Modo As Integer
    Public QuartoDeCasal_HorarioAbrir As String
    Public QuartoDeCasal_HorarioFechar As String
    Public QuartoDeCasal_Modo As Integer
    Public Quarto1_HorarioAbrir As String
    Public Quarto1_HorarioFechar As String
    Public Quarto1_Modo As Integer
    Public Quarto2_HorarioAbrir As String
    Public Quarto2_HorarioFechar As String
    Public Quarto2_Modo As Integer







    ' VARIAVEIS PARA TELA CORTINA
    Public cortinaSalaDeEstar As Integer
    Public cortinaQuartoDeCasal As Integer
    Public cortinaQuarto1 As Integer
    Public cortinaQuarto2 As Integer


    ' VARIAVEIS PARA TELA ILUMINACAO
    Public SalaDeEstarIluminacaoDaSala As Integer
    Public SalaDeEstarArandelasPainelTv As Integer
    Public SalaDeEstarLustreDaSalaDeEstar As Integer
    Public SalaDeEstarIluminacaoDaSacada As Integer

    Public Quarto1IluminacaoDoQuarto As Integer
    Public Quarto1ArandelasPainelTV As Integer
    Public Quarto1IluminacaoDoCortineiro As Integer

    Public Quarto2IluminacaoDoQuarto As Integer
    Public Quarto2ArandelasPainelTV As Integer
    Public Quarto2IluminacaoDoCortineiro As Integer

    Public CozinhaIluminacaoDaCozinha As Integer
    Public CozinhaPendentesDaIlha As Integer
    Public CozinhaIluminacaoAmbiente As Integer
    Public CozinhaIluminacaoDoCorredor As Integer

    Public QuartodeCasalIluminacaoDoQuarto As Integer
    Public QuartodeCasalArandelasPainelTV As Integer
    Public QuartodeCasalIluminacaoDoCortineiro As Integer

    Public EspacoGourmetIluminacaoAmbiente As Integer
    Public EspacoGourmetPendentesBancada As Integer
    Public EspacoGourmetIluminacaoDaChurrasqueira As Integer


    ' VARIAVEIS PARA TELA PERSIANA
    Public EspacoGourmetPersiana1 As Integer
    Public EspacoGourmetPersiana2 As Integer
    Public EspacoGourmetPersiana3 As Integer
    Public LabEletronicaPersiana As Integer
    Public CozinhaPersiana As Integer





    ' VARIAVEIS PARA TELA SKY
    Public tela As String


    ' VARIAVEIS PARA TELA CONFIGURACOES

    ' VARIAVEIS PARA TELA ENERGIA   
    Public ValorDisjuntorIluminacao1 As Integer
    Public ValorDisjuntorIluminacao2 As Integer
    Public ValorDisjuntorIluminacao3 As Integer
    Public ValorDisjuntorIluminacao4 As Integer
    Public ValorDisjuntorIluminacao5 As Integer
    Public ValorDisjuntorIluminacao6 As Integer
    Public ValorDisjuntorIluminacao7 As Integer
    Public ValorDisjuntorTomada1 As Integer
    Public ValorDisjuntorTomada2 As Integer
    Public ValorDisjuntorTomada3 As Integer
    Public ValorDisjuntorTomada4 As Integer
    Public ValorDisjuntorTomada5 As Integer
    Public ValorDisjuntorTomada6 As Integer
    Public ValorDisjuntorTomada7 As Integer
    Public valorDisj_01 As String
    Public valorDisj_02 As String
    Public valorDisj_03 As String
    Public valorDisj_04 As String
    Public valorDisj_05 As String
    Public valorDisj_06 As String
    Public valorDisj_07 As String
    Public valorDisj_08 As String
    Public valorDisj_09 As String
    Public valorDisj_10 As String
    Public valorDisj_11 As String
    Public valorDisj_12 As String
    Public valorDisj_13 As String
    Public valorDisj_14 As String

    Public msgMQTT As Integer







  

    Private Sub Form1_Load(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles MyBase.Load


        Cursor.Hide()

        Minha_Porta = IO.Ports.SerialPort.GetPortNames()
        cmbBaud.Items.Add(9600)
        cmbBaud.Items.Add(19200)
        cmbBaud.Items.Add(38400)
        cmbBaud.Items.Add(57600)
        cmbBaud.Items.Add(115200)

        For i = 0 To UBound(Minha_Porta)
            cmbPort.Items.Add(Minha_Porta(i))
        Next
        cmbPort.Text = cmbPort.Items.Item(0)    'Set cmbPort text to the first COM port detected
        cmbBaud.Text = cmbBaud.Items.Item(0)    'Set cmbBaud text to the first Baud rate on the list

        btnDisconnect.Enabled = False           'Initially Disconnect Button is Disabled
        msgMQTT = 0

        lbMensagemRecebidaMQTT.Visible = False
        tela = "Animais"

        tempoAtualizarKWh = 5 ' tempo em segundos que atualiza o envio vindo do arduino
        valorConstanteKWH = tempoAtualizarKWh / 3600






        Me.InvokeOnClick(TelaSKY.btnAnimais, e) ' Chama para manter atualizado a tela sky ao iniciar

    End Sub

    Private Sub btnAtualiza_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btnAtualiza.Click
        tbResultado.Text = Trim(tbResultado.Text)
        Dim valor As Integer
        Dim valor1 As Integer



        If tbResultado.Text <> "" Then
            valor = 0
            valor = Trim(tbResultado.TextLength)
            For i = 1 To valor
                If (Mid(tbResultado.Text, i, 1) = ",") Then
                    'valor1 = valor - 1
                    valor1 = valor
                    If valor1 <> 0 Then

                        tbResultado.Text = Mid(tbResultado.Text, 1, valor1)
                        If tbResultado.Text <> "" Then
                            tbMensagemRecebida.Text = (tbResultado.Text).Trim()
                            Me.InvokeOnClick(btnSeparar, e)
                        End If
                        tbResultado.Text = ""
                        valor1 = 0
                    End If
                    Exit For
                End If
            Next



        End If
    End Sub

    Private Sub btnSeparar_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btnSeparar.Click
        Dim tam_Mensagem As Integer
       
        Dim charr1 As Integer
      
        Dim msg1 As String
        Dim msg2 As String
        Dim msg3 As String


        ' Dados da mensagem
        '    msg_0,msg_1-msg_2^msg_3~peso*

        On Error Resume Next
        tam_Mensagem = tbMensagemRecebida.Text.Length


        Dim valor As Integer
        valor = 0

        For index As Integer = 1 To tam_Mensagem
            On Error Resume Next

            If Mid(tbMensagemRecebida.Text, index, 1) = "," Then
                charr1 = index
            End If


        Next
        Dim msg As String
        lbMensagemRecebidaMQTT.Text = "Recebido MQTT : "
        msg = ""
        msg = Mid(tbMensagemRecebida.Text, 1, CInt(charr1) - 1)


        lbMensagemRecebidaMQTT.Text = "Recebido MQTT : " + msg





        ' DISJUNTORES    DISJUNTORES    DISJUNTORES    DISJUNTORES    DISJUNTORES    DISJUNTORES    DISJUNTORES    DISJUNTORES    DISJUNTORES    DISJUNTORES    DISJUNTORES   
        ' DISJUNTORES    DISJUNTORES    DISJUNTORES    DISJUNTORES    DISJUNTORES    DISJUNTORES    DISJUNTORES    DISJUNTORES    DISJUNTORES    DISJUNTORES    DISJUNTORES   
        ' DISJUNTORES    DISJUNTORES    DISJUNTORES    DISJUNTORES    DISJUNTORES    DISJUNTORES    DISJUNTORES    DISJUNTORES    DISJUNTORES    DISJUNTORES    DISJUNTORES   
        ' DISJUNTORES    DISJUNTORES    DISJUNTORES    DISJUNTORES    DISJUNTORES    DISJUNTORES    DISJUNTORES    DISJUNTORES    DISJUNTORES    DISJUNTORES    DISJUNTORES   
        ' DISJUNTORES    DISJUNTORES    DISJUNTORES    DISJUNTORES    DISJUNTORES    DISJUNTORES    DISJUNTORES    DISJUNTORES    DISJUNTORES    DISJUNTORES    DISJUNTORES   

        'RECEBE O STATUS DOS DISJUNTORES

        If msg.Length = 16 Then

            If (Mid(msg, 1, 1) = ("*")) And (Mid(msg, 16, 1) = ("*")) Then

                ' formatoda mensagem
                '    *00000001111111*

                ValorDisjuntorIluminacao1 = CInt(Mid(msg, 2, 1))
                ValorDisjuntorIluminacao2 = CInt(Mid(msg, 3, 1))
                ValorDisjuntorIluminacao3 = CInt(Mid(msg, 4, 1))
                ValorDisjuntorIluminacao4 = CInt(Mid(msg, 5, 1))
                ValorDisjuntorIluminacao5 = CInt(Mid(msg, 6, 1))
                ValorDisjuntorIluminacao6 = CInt(Mid(msg, 7, 1))
                ValorDisjuntorIluminacao7 = CInt(Mid(msg, 8, 1))

                ValorDisjuntorTomada1 = CInt(Mid(msg, 9, 1))
                ValorDisjuntorTomada2 = CInt(Mid(msg, 10, 1))
                ValorDisjuntorTomada3 = CInt(Mid(msg, 11, 1))
                ValorDisjuntorTomada4 = CInt(Mid(msg, 12, 1))
                ValorDisjuntorTomada5 = CInt(Mid(msg, 13, 1))
                ValorDisjuntorTomada6 = CInt(Mid(msg, 14, 1))
                ValorDisjuntorTomada7 = CInt(Mid(msg, 15, 1))



                If ValorDisjuntorIluminacao1 = 1 Then
                    TelaEnergia.DisjuntorIluminacao1.Image = CentralAutomacao.My.Resources.Resources.DisjuntorON
                Else
                    TelaEnergia.DisjuntorIluminacao1.Image = CentralAutomacao.My.Resources.Resources.DisjuntorOFF
                End If
                If ValorDisjuntorIluminacao2 = 1 Then
                    TelaEnergia.DisjuntorIluminacao2.Image = CentralAutomacao.My.Resources.Resources.DisjuntorON
                Else
                    TelaEnergia.DisjuntorIluminacao2.Image = CentralAutomacao.My.Resources.Resources.DisjuntorOFF
                End If
                If ValorDisjuntorIluminacao3 = 1 Then
                    TelaEnergia.DisjuntorIluminacao3.Image = CentralAutomacao.My.Resources.Resources.DisjuntorON
                Else
                    TelaEnergia.DisjuntorIluminacao3.Image = CentralAutomacao.My.Resources.Resources.DisjuntorOFF
                End If
                If ValorDisjuntorIluminacao4 = 1 Then
                    TelaEnergia.DisjuntorIluminacao4.Image = CentralAutomacao.My.Resources.Resources.DisjuntorON
                Else
                    TelaEnergia.DisjuntorIluminacao4.Image = CentralAutomacao.My.Resources.Resources.DisjuntorOFF
                End If
                If ValorDisjuntorIluminacao5 = 1 Then
                    TelaEnergia.DisjuntorIluminacao5.Image = CentralAutomacao.My.Resources.Resources.DisjuntorON
                Else
                    TelaEnergia.DisjuntorIluminacao5.Image = CentralAutomacao.My.Resources.Resources.DisjuntorOFF
                End If
                If ValorDisjuntorIluminacao6 = 1 Then
                    TelaEnergia.DisjuntorIluminacao6.Image = CentralAutomacao.My.Resources.Resources.DisjuntorON
                Else
                    TelaEnergia.DisjuntorIluminacao6.Image = CentralAutomacao.My.Resources.Resources.DisjuntorOFF
                End If
                If ValorDisjuntorIluminacao7 = 1 Then
                    TelaEnergia.DisjuntorIluminacao7.Image = CentralAutomacao.My.Resources.Resources.DisjuntorON
                Else
                    TelaEnergia.DisjuntorIluminacao7.Image = CentralAutomacao.My.Resources.Resources.DisjuntorOFF
                End If

                If ValorDisjuntorTomada1 = 1 Then
                    TelaEnergia.DisjuntorTomada1.Image = CentralAutomacao.My.Resources.Resources.DisjuntorON
                Else
                    TelaEnergia.DisjuntorTomada1.Image = CentralAutomacao.My.Resources.Resources.DisjuntorOFF
                End If
                If ValorDisjuntorTomada2 = 1 Then
                    TelaEnergia.DisjuntorTomada2.Image = CentralAutomacao.My.Resources.Resources.DisjuntorON
                Else
                    TelaEnergia.DisjuntorTomada2.Image = CentralAutomacao.My.Resources.Resources.DisjuntorOFF
                End If
                If ValorDisjuntorTomada3 = 1 Then
                    TelaEnergia.DisjuntorTomada3.Image = CentralAutomacao.My.Resources.Resources.DisjuntorON
                Else
                    TelaEnergia.DisjuntorTomada3.Image = CentralAutomacao.My.Resources.Resources.DisjuntorOFF
                End If
                If ValorDisjuntorTomada4 = 1 Then
                    TelaEnergia.DisjuntorTomada4.Image = CentralAutomacao.My.Resources.Resources.DisjuntorON
                Else
                    TelaEnergia.DisjuntorTomada4.Image = CentralAutomacao.My.Resources.Resources.DisjuntorOFF
                End If
                If ValorDisjuntorTomada5 = 1 Then
                    TelaEnergia.DisjuntorTomada5.Image = CentralAutomacao.My.Resources.Resources.DisjuntorON
                Else
                    TelaEnergia.DisjuntorTomada5.Image = CentralAutomacao.My.Resources.Resources.DisjuntorOFF
                End If
                If ValorDisjuntorTomada6 = 1 Then
                    TelaEnergia.DisjuntorTomada6.Image = CentralAutomacao.My.Resources.Resources.DisjuntorON
                Else
                    TelaEnergia.DisjuntorTomada6.Image = CentralAutomacao.My.Resources.Resources.DisjuntorOFF
                End If
                If ValorDisjuntorTomada7 = 1 Then
                    TelaEnergia.DisjuntorTomada7.Image = CentralAutomacao.My.Resources.Resources.DisjuntorON
                Else
                    TelaEnergia.DisjuntorTomada7.Image = CentralAutomacao.My.Resources.Resources.DisjuntorOFF
                End If

            End If
        End If

        ' RECEBE O VALOR DAS CORRENTES



        Dim tamanhoMSG As Integer

        On Error Resume Next
        tamanhoMSG = msg.Length

        Dim char1 As Integer
        Dim char2 As Integer
        Dim char3 As Integer
        Dim char4 As Integer
        Dim char5 As Integer
        Dim char6 As Integer
        Dim char7 As Integer

        Dim Dif21 As Integer
        Dim Dif32 As Integer
        Dim Dif43 As Integer

        If msg.Length > 16 Then

            ' ATUALIZA OS DADOS DOS DISJUNTORES DE 08 A 14
            If (Mid(msg, 1, 7) = ("Disj-08")) And (Mid(msg, tamanhoMSG, 1) = ("<")) Then

                For index As Integer = 8 To tamanhoMSG
                    On Error Resume Next

                    If Mid(tbMensagemRecebida.Text, index, 1) = "A" Then
                        char1 = index
                    End If
                    If Mid(tbMensagemRecebida.Text, index, 1) = "B" Then
                        char2 = index
                    End If
                    If Mid(tbMensagemRecebida.Text, index, 1) = "C" Then
                        char3 = index
                    End If
                    If Mid(tbMensagemRecebida.Text, index, 1) = "D" Then
                        char4 = index
                    End If
                    If Mid(tbMensagemRecebida.Text, index, 1) = "E" Then
                        char5 = index
                    End If
                    If Mid(tbMensagemRecebida.Text, index, 1) = "F" Then
                        char6 = index
                    End If
                    char7 = tam_Mensagem - 1 ' para tirar o <
                Next
                valorDisj_08 = (Mid(msg, 8, CInt(char1) - 8))
                valorDisj_09 = (Mid(msg, CInt(char1) + 1, (CInt(char2) - 1) - (CInt(char1))))
                valorDisj_10 = (Mid(msg, CInt(char2) + 1, (CInt(char3) - 1) - (CInt(char2))))
                valorDisj_11 = (Mid(msg, CInt(char3) + 1, (CInt(char4) - 1) - (CInt(char3))))
                valorDisj_12 = (Mid(msg, CInt(char4) + 1, (CInt(char5) - 1) - (CInt(char4))))
                valorDisj_13 = (Mid(msg, CInt(char5) + 1, (CInt(char6) - 1) - (CInt(char5))))
                valorDisj_14 = (Mid(msg, CInt(char6) + 1, ((CInt(char7)) - (CInt(char6)) - 1)))
                TelaEnergia.lbDisj_08.Text = valorDisj_08
                TelaEnergia.lbDisj_09.Text = valorDisj_09
                TelaEnergia.lbDisj_10.Text = valorDisj_10
                TelaEnergia.lbDisj_11.Text = valorDisj_11
                TelaEnergia.lbDisj_12.Text = valorDisj_12
                TelaEnergia.lbDisj_13.Text = valorDisj_13
                TelaEnergia.lbDisj_14.Text = valorDisj_14
                Me.InvokeOnClick(TelaEnergia.btnCalcularTomada, e)
            End If

            ' ATUALIZA OS DADOS DOS DISJUNTORES DE 01 A 08
            If (Mid(msg, 1, 7) = ("Disj-01")) And (Mid(msg, tamanhoMSG, 1) = ("<")) Then

                For index As Integer = 8 To tamanhoMSG
                    On Error Resume Next

                    If Mid(tbMensagemRecebida.Text, index, 1) = "A" Then
                        char1 = index
                    End If
                    If Mid(tbMensagemRecebida.Text, index, 1) = "B" Then
                        char2 = index
                    End If
                    If Mid(tbMensagemRecebida.Text, index, 1) = "C" Then
                        char3 = index
                    End If
                    If Mid(tbMensagemRecebida.Text, index, 1) = "D" Then
                        char4 = index
                    End If
                    If Mid(tbMensagemRecebida.Text, index, 1) = "E" Then
                        char5 = index
                    End If
                    If Mid(tbMensagemRecebida.Text, index, 1) = "F" Then
                        char6 = index
                    End If
                    char7 = tam_Mensagem - 1 ' para tirar o <
                Next
                valorDisj_01 = (Mid(msg, 8, CInt(char1) - 8))
                valorDisj_02 = (Mid(msg, CInt(char1) + 1, (CInt(char2) - 1) - (CInt(char1))))
                valorDisj_03 = (Mid(msg, CInt(char2) + 1, (CInt(char3) - 1) - (CInt(char2))))
                valorDisj_04 = (Mid(msg, CInt(char3) + 1, (CInt(char4) - 1) - (CInt(char3))))
                valorDisj_05 = (Mid(msg, CInt(char4) + 1, (CInt(char5) - 1) - (CInt(char4))))
                valorDisj_06 = (Mid(msg, CInt(char5) + 1, (CInt(char6) - 1) - (CInt(char5))))
                valorDisj_07 = (Mid(msg, CInt(char6) + 1, ((CInt(char7)) - (CInt(char6)) - 1)))
                TelaEnergia.lbDisj_01.Text = valorDisj_01
                TelaEnergia.lbDisj_02.Text = valorDisj_02
                TelaEnergia.lbDisj_03.Text = valorDisj_03
                TelaEnergia.lbDisj_04.Text = valorDisj_04
                TelaEnergia.lbDisj_05.Text = valorDisj_05
                TelaEnergia.lbDisj_06.Text = valorDisj_06
                TelaEnergia.lbDisj_07.Text = valorDisj_07
                Me.InvokeOnClick(TelaEnergia.btnCalcularIluminacao, e)
            End If

        End If




        '*******************************************************************************************************************************************************************
        '*******************************************************************************************************************************************************************
        '*******************************************************************************************************************************************************************
        '*******************************************************************************************************************************************************************
        '*******************************************************************************************************************************************************************
        '*******************************************************************************************************************************************************************





        ' CONTROLE DAS CORTINAS    CONTROLE DAS CORTINAS    CONTROLE DAS CORTINAS    CONTROLE DAS CORTINAS    CONTROLE DAS CORTINAS    CONTROLE DAS CORTINAS    CONTROLE DAS CORTINAS   
        ' CONTROLE DAS CORTINAS    CONTROLE DAS CORTINAS    CONTROLE DAS CORTINAS    CONTROLE DAS CORTINAS    CONTROLE DAS CORTINAS    CONTROLE DAS CORTINAS    CONTROLE DAS CORTINAS   
        ' CONTROLE DAS CORTINAS    CONTROLE DAS CORTINAS    CONTROLE DAS CORTINAS    CONTROLE DAS CORTINAS    CONTROLE DAS CORTINAS    CONTROLE DAS CORTINAS    CONTROLE DAS CORTINAS   
        ' CONTROLE DAS CORTINAS    CONTROLE DAS CORTINAS    CONTROLE DAS CORTINAS    CONTROLE DAS CORTINAS    CONTROLE DAS CORTINAS    CONTROLE DAS CORTINAS    CONTROLE DAS CORTINAS   
        ' CONTROLE DAS CORTINAS    CONTROLE DAS CORTINAS    CONTROLE DAS CORTINAS    CONTROLE DAS CORTINAS    CONTROLE DAS CORTINAS    CONTROLE DAS CORTINAS    CONTROLE DAS CORTINAS   
        ' CONTROLE DAS CORTINAS    CONTROLE DAS CORTINAS    CONTROLE DAS CORTINAS    CONTROLE DAS CORTINAS    CONTROLE DAS CORTINAS    CONTROLE DAS CORTINAS    CONTROLE DAS CORTINAS   





        ' Controle Cortina Sala de Estar
        If (msg = "cortinasaladeestar_1") Then
            cortinaSalaDeEstar = 1
            TelaCortina.SalaDeEstarHorario.Text = Now
            TelaCortina.SalaDeEstarCortina.Image = CentralAutomacao.My.Resources.Resources.cortinaA
        End If
        If (msg = "cortinasaladeestar_0") Then
            cortinaSalaDeEstar = 0
            TelaCortina.SalaDeEstarHorario.Text = Now
            TelaCortina.SalaDeEstarCortina.Image = CentralAutomacao.My.Resources.Resources.cortinaF
        End If

        ' Controle Cortina Quarto de Casal
        If (msg = "cortinaquartodecasal_1") Then
            cortinaQuartoDeCasal = 1
            TelaCortina.QuartoDeCasalHorario.Text = Now
            TelaCortina.QuartoDeCasalCortina.Image = CentralAutomacao.My.Resources.Resources.cortinaA
        End If
        If (msg = "cortinaquartodecasal_0") Then
            cortinaQuartoDeCasal = 0
            TelaCortina.QuartoDeCasalHorario.Text = Now
            TelaCortina.QuartoDeCasalCortina.Image = CentralAutomacao.My.Resources.Resources.cortinaF
        End If

        ' Controle Cortina Quarto 1
        If (msg = "cortinaquarto1_1") Then
            cortinaQuarto1 = 1
            TelaCortina.Quarto1Horario.Text = Now
            TelaCortina.Quarto1Cortina.Image = CentralAutomacao.My.Resources.Resources.cortinaA
        End If
        If (msg = "cortinaquarto1_0") Then
            cortinaQuarto1 = 0
            TelaCortina.Quarto1Horario.Text = Now
            TelaCortina.Quarto1Cortina.Image = CentralAutomacao.My.Resources.Resources.cortinaF
        End If

        ' Controle Cortina Quarto 2
        If (msg = "cortinaquarto2_1") Then
            cortinaQuarto2 = 1
            TelaCortina.Quarto2Horario.Text = Now
            TelaCortina.Quarto2Cortina.Image = CentralAutomacao.My.Resources.Resources.cortinaA
        End If
        If (msg = "cortinaquarto2_0") Then
            cortinaQuarto2 = 0
            TelaCortina.Quarto2Horario.Text = Now
            TelaCortina.Quarto2Cortina.Image = CentralAutomacao.My.Resources.Resources.cortinaF
        End If

        ' Controle Todas as Cortinas

        ' Abrir Todas
        If (msg = "cortinaabrirtodas") Then
            cortinaSalaDeEstar = 1
            cortinaQuartoDeCasal = 1
            cortinaQuarto1 = 1
            cortinaQuarto2 = 1
            TelaCortina.SalaDeEstarHorario.Text = Now
            TelaCortina.QuartoDeCasalHorario.Text = Now
            TelaCortina.Quarto1Horario.Text = Now
            TelaCortina.Quarto2Horario.Text = Now
            TelaCortina.SalaDeEstarCortina.Image = CentralAutomacao.My.Resources.Resources.cortinaA
            TelaCortina.QuartoDeCasalCortina.Image = CentralAutomacao.My.Resources.Resources.cortinaA
            TelaCortina.Quarto1Cortina.Image = CentralAutomacao.My.Resources.Resources.cortinaA
            TelaCortina.Quarto2Cortina.Image = CentralAutomacao.My.Resources.Resources.cortinaA
        End If
        If (msg = "cortinafechartodas") Then
            cortinaSalaDeEstar = 0
            cortinaQuartoDeCasal = 0
            cortinaQuarto1 = 0
            cortinaQuarto2 = 0
            TelaCortina.SalaDeEstarHorario.Text = Now
            TelaCortina.QuartoDeCasalHorario.Text = Now
            TelaCortina.Quarto1Horario.Text = Now
            TelaCortina.Quarto2Horario.Text = Now
            TelaCortina.SalaDeEstarCortina.Image = CentralAutomacao.My.Resources.Resources.cortinaF
            TelaCortina.QuartoDeCasalCortina.Image = CentralAutomacao.My.Resources.Resources.cortinaF
            TelaCortina.Quarto1Cortina.Image = CentralAutomacao.My.Resources.Resources.cortinaF
            TelaCortina.Quarto2Cortina.Image = CentralAutomacao.My.Resources.Resources.cortinaF
        End If






        '*******************************************************************************************************************************************************************
        '*******************************************************************************************************************************************************************
        '*******************************************************************************************************************************************************************
        '*******************************************************************************************************************************************************************
        '*******************************************************************************************************************************************************************
        '*******************************************************************************************************************************************************************



        ' CONTROLE DAS PERSIANAS     CONTROLE DAS PERSIANAS     CONTROLE DAS PERSIANAS     CONTROLE DAS PERSIANAS     CONTROLE DAS PERSIANAS     CONTROLE DAS PERSIANAS    
        ' CONTROLE DAS PERSIANAS     CONTROLE DAS PERSIANAS     CONTROLE DAS PERSIANAS     CONTROLE DAS PERSIANAS     CONTROLE DAS PERSIANAS     CONTROLE DAS PERSIANAS    
        ' CONTROLE DAS PERSIANAS     CONTROLE DAS PERSIANAS     CONTROLE DAS PERSIANAS     CONTROLE DAS PERSIANAS     CONTROLE DAS PERSIANAS     CONTROLE DAS PERSIANAS    
        ' CONTROLE DAS PERSIANAS     CONTROLE DAS PERSIANAS     CONTROLE DAS PERSIANAS     CONTROLE DAS PERSIANAS     CONTROLE DAS PERSIANAS     CONTROLE DAS PERSIANAS    
        ' CONTROLE DAS PERSIANAS     CONTROLE DAS PERSIANAS     CONTROLE DAS PERSIANAS     CONTROLE DAS PERSIANAS     CONTROLE DAS PERSIANAS     CONTROLE DAS PERSIANAS    



        ' Controle Persiana do Espaço Gourmet
        If (msg = "espacogourmetpersiana1_1") Then
            EspacoGourmetPersiana1 = 1
            TelaPersiana.EspacoGourmetHorario.Text = Now
            TelaPersiana.EspacoGourmetPersiana1.Image = CentralAutomacao.My.Resources.Resources.persianaA
        End If
        If (msg = "espacogourmetpersiana1_0") Then
            EspacoGourmetPersiana1 = 0
            TelaPersiana.EspacoGourmetHorario.Text = Now
            TelaPersiana.EspacoGourmetPersiana1.Image = CentralAutomacao.My.Resources.Resources.persianaF
        End If

        If (msg = "espacogourmetpersiana2_1") Then
            EspacoGourmetPersiana2 = 1
            TelaPersiana.EspacoGourmetHorario.Text = Now
            TelaPersiana.EspacoGourmetPersiana2.Image = CentralAutomacao.My.Resources.Resources.persianaA
        End If
        If (msg = "espacogourmetpersiana2_0") Then
            EspacoGourmetPersiana2 = 0
            TelaPersiana.EspacoGourmetHorario.Text = Now
            TelaPersiana.EspacoGourmetPersiana2.Image = CentralAutomacao.My.Resources.Resources.persianaF
        End If

        If (msg = "espacogourmetpersiana3_1") Then
            EspacoGourmetPersiana3 = 1
            TelaPersiana.EspacoGourmetHorario.Text = Now
            TelaPersiana.EspacoGourmetPersiana3.Image = CentralAutomacao.My.Resources.Resources.persianaA
        End If
        If (msg = "espacogourmetpersiana3_0") Then
            EspacoGourmetPersiana3 = 0
            TelaPersiana.EspacoGourmetHorario.Text = Now
            TelaPersiana.EspacoGourmetPersiana3.Image = CentralAutomacao.My.Resources.Resources.persianaF
        End If

        If (msg = "espacogourmetpersianas_1") Then
            EspacoGourmetPersiana1 = 1
            EspacoGourmetPersiana2 = 1
            EspacoGourmetPersiana3 = 1
            TelaPersiana.EspacoGourmetHorario.Text = Now
            TelaPersiana.EspacoGourmetPersiana1.Image = CentralAutomacao.My.Resources.Resources.persianaA
            TelaPersiana.EspacoGourmetPersiana2.Image = CentralAutomacao.My.Resources.Resources.persianaA
            TelaPersiana.EspacoGourmetPersiana3.Image = CentralAutomacao.My.Resources.Resources.persianaA
        End If
        If (msg = "espacogourmetpersianas_0") Then
            EspacoGourmetPersiana1 = 0
            EspacoGourmetPersiana2 = 0
            EspacoGourmetPersiana3 = 0
            TelaPersiana.EspacoGourmetHorario.Text = Now
            TelaPersiana.EspacoGourmetPersiana1.Image = CentralAutomacao.My.Resources.Resources.persianaF
            TelaPersiana.EspacoGourmetPersiana2.Image = CentralAutomacao.My.Resources.Resources.persianaF
            TelaPersiana.EspacoGourmetPersiana3.Image = CentralAutomacao.My.Resources.Resources.persianaF
        End If



        ' Controle Persiana do Laboratório de Eletrônica
        If (msg = "labeletronicapersiana_1") Then
            LabEletronicaPersiana = 1
            TelaPersiana.LabEletronicaHorario.Text = Now
            TelaPersiana.LabEletronicaPersiana.Image = CentralAutomacao.My.Resources.Resources.persianaA
        End If
        If (msg = "labeletronicapersiana_0") Then
            LabEletronicaPersiana = 0
            TelaPersiana.LabEletronicaHorario.Text = Now
            TelaPersiana.LabEletronicaPersiana.Image = CentralAutomacao.My.Resources.Resources.persianaF
        End If


        ' Controle Persiana da Cozinha
        If (msg = "cozinhapersiana_1") Then
            CozinhaPersiana = 1
            TelaPersiana.CozinhaHorario.Text = Now
            TelaPersiana.CozinhaPersiana.Image = CentralAutomacao.My.Resources.Resources.persianaA
        End If
        If (msg = "cozinhapersiana_0") Then
            CozinhaPersiana = 0
            TelaPersiana.CozinhaHorario.Text = Now
            TelaPersiana.CozinhaPersiana.Image = CentralAutomacao.My.Resources.Resources.persianaF
        End If


        If (msg = "persianasabrirtodas") Then
            EspacoGourmetPersiana1 = 1
            EspacoGourmetPersiana2 = 1
            EspacoGourmetPersiana3 = 1
            LabEletronicaPersiana = 1
            CozinhaPersiana = 1
            TelaPersiana.EspacoGourmetHorario.Text = Now
            TelaPersiana.LabEletronicaHorario.Text = Now
            TelaPersiana.CozinhaHorario.Text = Now
            TelaPersiana.EspacoGourmetPersiana1.Image = CentralAutomacao.My.Resources.Resources.persianaA
            TelaPersiana.EspacoGourmetPersiana2.Image = CentralAutomacao.My.Resources.Resources.persianaA
            TelaPersiana.EspacoGourmetPersiana3.Image = CentralAutomacao.My.Resources.Resources.persianaA
            TelaPersiana.LabEletronicaPersiana.Image = CentralAutomacao.My.Resources.Resources.persianaA
            TelaPersiana.CozinhaPersiana.Image = CentralAutomacao.My.Resources.Resources.persianaA
        End If

        If (msg = "persianasfechartodas") Then
            EspacoGourmetPersiana1 = 0
            EspacoGourmetPersiana2 = 0
            EspacoGourmetPersiana3 = 0
            LabEletronicaPersiana = 0
            CozinhaPersiana = 0
            TelaPersiana.EspacoGourmetHorario.Text = Now
            TelaPersiana.LabEletronicaHorario.Text = Now
            TelaPersiana.CozinhaHorario.Text = Now
            TelaPersiana.EspacoGourmetPersiana1.Image = CentralAutomacao.My.Resources.Resources.persianaF
            TelaPersiana.EspacoGourmetPersiana2.Image = CentralAutomacao.My.Resources.Resources.persianaF
            TelaPersiana.EspacoGourmetPersiana3.Image = CentralAutomacao.My.Resources.Resources.persianaF
            TelaPersiana.LabEletronicaPersiana.Image = CentralAutomacao.My.Resources.Resources.persianaF
            TelaPersiana.CozinhaPersiana.Image = CentralAutomacao.My.Resources.Resources.persianaF
        End If




        '*******************************************************************************************************************************************************************
        '*******************************************************************************************************************************************************************
        '*******************************************************************************************************************************************************************
        '*******************************************************************************************************************************************************************
        '*******************************************************************************************************************************************************************
        '*******************************************************************************************************************************************************************





        ' TELA ILUMINACAO CASA     TELA ILUMINACAO CASA     TELA ILUMINACAO CASA     TELA ILUMINACAO CASA     TELA ILUMINACAO CASA     TELA ILUMINACAO CASA     TELA ILUMINACAO CASA    
        ' TELA ILUMINACAO CASA     TELA ILUMINACAO CASA     TELA ILUMINACAO CASA     TELA ILUMINACAO CASA     TELA ILUMINACAO CASA     TELA ILUMINACAO CASA     TELA ILUMINACAO CASA    
        ' TELA ILUMINACAO CASA     TELA ILUMINACAO CASA     TELA ILUMINACAO CASA     TELA ILUMINACAO CASA     TELA ILUMINACAO CASA     TELA ILUMINACAO CASA     TELA ILUMINACAO CASA    
        ' TELA ILUMINACAO CASA     TELA ILUMINACAO CASA     TELA ILUMINACAO CASA     TELA ILUMINACAO CASA     TELA ILUMINACAO CASA     TELA ILUMINACAO CASA     TELA ILUMINACAO CASA    
        ' TELA ILUMINACAO CASA     TELA ILUMINACAO CASA     TELA ILUMINACAO CASA     TELA ILUMINACAO CASA     TELA ILUMINACAO CASA     TELA ILUMINACAO CASA     TELA ILUMINACAO CASA    
        ' TELA ILUMINACAO CASA     TELA ILUMINACAO CASA     TELA ILUMINACAO CASA     TELA ILUMINACAO CASA     TELA ILUMINACAO CASA     TELA ILUMINACAO CASA     TELA ILUMINACAO CASA    


        ' SALA DE ESTAR

        If (msg = "se_iluminacaodasala_0") Then
            SalaDeEstarIluminacaoDaSala = 0
            Tela_Iluminacao.SalaDeEstar_IluminacaoDaSala.Image = CentralAutomacao.My.Resources.Resources.lampadas1
        End If
        If (msg = "se_iluminacaodasala_1") Then
            SalaDeEstarIluminacaoDaSala = 1
            Tela_Iluminacao.SalaDeEstar_IluminacaoDaSala.Image = CentralAutomacao.My.Resources.Resources.lampadasL
        End If

        If (msg = "se_arandelaspaineltv_0") Then
            SalaDeEstarArandelasPainelTv = 0
            Tela_Iluminacao.SalaDeEstar_ArandelasPainelTV.Image = CentralAutomacao.My.Resources.Resources.lampadas1
        End If
        If (msg = "se_arandelaspaineltv_1") Then
            SalaDeEstarArandelasPainelTv = 1
            Tela_Iluminacao.SalaDeEstar_ArandelasPainelTV.Image = CentralAutomacao.My.Resources.Resources.lampadasL
        End If
        If (msg = "se_lustredasala_0") Then
            SalaDeEstarLustreDaSalaDeEstar = 0
            Tela_Iluminacao.SalaDeEstar_LustreDaSala.Image = CentralAutomacao.My.Resources.Resources.lampadas1
        End If
        If (msg = "se_lustredasala_1") Then
            SalaDeEstarLustreDaSalaDeEstar = 1
            Tela_Iluminacao.SalaDeEstar_LustreDaSala.Image = CentralAutomacao.My.Resources.Resources.lampadasL
        End If
        If (msg = "se_iluminacaodasacada_0") Then
            SalaDeEstarIluminacaoDaSacada = 0
            Tela_Iluminacao.SalaDeEstar_IluminacaoDaSacada.Image = CentralAutomacao.My.Resources.Resources.lampadas1
        End If
        If (msg = "se_iluminacaodasacada_1") Then
            SalaDeEstarIluminacaoDaSacada = 1
            Tela_Iluminacao.SalaDeEstar_IluminacaoDaSacada.Image = CentralAutomacao.My.Resources.Resources.lampadasL
        End If

        ' QUARTO 01 

        If (msg = "q1_iluminacaodoquarto_0") Then
            Quarto1IluminacaoDoQuarto = 0
            Tela_Iluminacao.Quarto1_IluminacaoDoQuarto.Image = CentralAutomacao.My.Resources.Resources.lampadas1
        End If
        If (msg = "q1_iluminacaodoquarto_1") Then
            Quarto1IluminacaoDoQuarto = 1
            Tela_Iluminacao.Quarto1_IluminacaoDoQuarto.Image = CentralAutomacao.My.Resources.Resources.lampadasL
        End If
        If (msg = "q1_arandelaspaineltv_0") Then
            Quarto1ArandelasPainelTV = 0
            Tela_Iluminacao.Quarto1_ArandelasPainelTV.Image = CentralAutomacao.My.Resources.Resources.lampadas1
        End If
        If (msg = "q1_arandelaspaineltv_1") Then
            Quarto1ArandelasPainelTV = 1
            Tela_Iluminacao.Quarto1_ArandelasPainelTV.Image = CentralAutomacao.My.Resources.Resources.lampadasL
        End If
        If (msg = "q1_iluminacaodocortineiro_0") Then
            Quarto1IluminacaoDoCortineiro = 0
            Tela_Iluminacao.Quarto1_IluminacaoDoCortineiro.Image = CentralAutomacao.My.Resources.Resources.lampadas1
        End If
        If (msg = "q1_iluminacaodocortineiro_1") Then
            Quarto1IluminacaoDoCortineiro = 1
            Tela_Iluminacao.Quarto1_IluminacaoDoCortineiro.Image = CentralAutomacao.My.Resources.Resources.lampadasL
        End If


        ' QUARTO 02 

        If (msg = "q2_iluminacaodoquarto_0") Then
            Quarto2IluminacaoDoQuarto = 0
            Tela_Iluminacao.Quarto2_IluminacaoDoQuarto.Image = CentralAutomacao.My.Resources.Resources.lampadas1
        End If
        If (msg = "q2_iluminacaodoquarto_1") Then
            Quarto2IluminacaoDoQuarto = 1
            Tela_Iluminacao.Quarto2_IluminacaoDoQuarto.Image = CentralAutomacao.My.Resources.Resources.lampadasL
        End If
        If (msg = "q2_arandelaspaineltv_0") Then
            Quarto2ArandelasPainelTV = 0
            Tela_Iluminacao.Quarto2_ArandelasPainelTV.Image = CentralAutomacao.My.Resources.Resources.lampadas1
        End If
        If (msg = "q2_arandelaspaineltv_1") Then
            Quarto2ArandelasPainelTV = 1
            Tela_Iluminacao.Quarto2_ArandelasPainelTV.Image = CentralAutomacao.My.Resources.Resources.lampadasL
        End If
        If (msg = "q2_iluminacaodocortineiro_0") Then
            Quarto2IluminacaoDoCortineiro = 0
            Tela_Iluminacao.Quarto2_IluminacaoDoCortineiro.Image = CentralAutomacao.My.Resources.Resources.lampadas1
        End If
        If (msg = "q2_iluminacaodocortineiro_1") Then
            Quarto2IluminacaoDoCortineiro = 1
            Tela_Iluminacao.Quarto2_IluminacaoDoCortineiro.Image = CentralAutomacao.My.Resources.Resources.lampadasL
        End If


        ' COZINHA
        If (msg = "cz_iluminacaodacozinha_0") Then
            CozinhaIluminacaoDaCozinha = 0
            Tela_Iluminacao.Cozinha_IluminacaoDaCozinha.Image = CentralAutomacao.My.Resources.Resources.lampadas1
        End If
        If (msg = "cz_iluminacaodacozinha_1") Then
            CozinhaIluminacaoDaCozinha = 1
            Tela_Iluminacao.Cozinha_IluminacaoDaCozinha.Image = CentralAutomacao.My.Resources.Resources.lampadasL
        End If
        If (msg = "cz_pendentesdailha_0") Then
            CozinhaPendentesDaIlha = 0
            Tela_Iluminacao.Cozinha_PendentesDaIlha.Image = CentralAutomacao.My.Resources.Resources.lampadas1
        End If
        If (msg = "cz_pendentesdailha_1") Then
            CozinhaPendentesDaIlha = 1
            Tela_Iluminacao.Cozinha_PendentesDaIlha.Image = CentralAutomacao.My.Resources.Resources.lampadasL
        End If
        If (msg = "cz_iluminacaoambiente_0") Then
            CozinhaIluminacaoAmbiente = 0
            Tela_Iluminacao.Cozinha_IluminacaoAmbiente.Image = CentralAutomacao.My.Resources.Resources.lampadas1
        End If
        If (msg = "cz_iluminacaoambiente_1") Then
            CozinhaIluminacaoAmbiente = 1
            Tela_Iluminacao.Cozinha_IluminacaoAmbiente.Image = CentralAutomacao.My.Resources.Resources.lampadasL
        End If
        If (msg = "cz_iluminacaodocorredor_0") Then
            CozinhaIluminacaoDoCorredor = 0
            Tela_Iluminacao.Cozinha_IluminacaoCorredor.Image = CentralAutomacao.My.Resources.Resources.lampadas1
        End If
        If (msg = "cz_iluminacaodocorredor_1") Then
            CozinhaIluminacaoDoCorredor = 1
            Tela_Iluminacao.Cozinha_IluminacaoCorredor.Image = CentralAutomacao.My.Resources.Resources.lampadasL
        End If

        ' QUARTO CASAL

        If (msg = "qc_iluminacaodoquarto_0") Then
            QuartodeCasalIluminacaoDoQuarto = 0
            Tela_Iluminacao.QuartoDeCasal_IluminacaoDoQuarto.Image = CentralAutomacao.My.Resources.Resources.lampadas1
        End If
        If (msg = "qc_iluminacaodoquarto_1") Then
            QuartodeCasalIluminacaoDoQuarto = 1
            Tela_Iluminacao.QuartoDeCasal_IluminacaoDoQuarto.Image = CentralAutomacao.My.Resources.Resources.lampadasL
        End If
        If (msg = "qc_arandelaspaineltv_0") Then
            QuartodeCasalArandelasPainelTV = 0
            Tela_Iluminacao.QuartoDeCasal_ArandelasPainelTV.Image = CentralAutomacao.My.Resources.Resources.lampadas1
        End If
        If (msg = "qc_arandelaspaineltv_1") Then
            QuartodeCasalArandelasPainelTV = 1
            Tela_Iluminacao.QuartoDeCasal_ArandelasPainelTV.Image = CentralAutomacao.My.Resources.Resources.lampadasL
        End If
        If (msg = "qc_iluminacaodocortineiro_0") Then
            QuartodeCasalIluminacaoDoCortineiro = 0
            Tela_Iluminacao.QuartoDeCasal_IluminacaoDoCortineiro.Image = CentralAutomacao.My.Resources.Resources.lampadas1
        End If
        If (msg = "qc_iluminacaodocortineiro_1") Then
            QuartodeCasalIluminacaoDoCortineiro = 1
            Tela_Iluminacao.QuartoDeCasal_IluminacaoDoCortineiro.Image = CentralAutomacao.My.Resources.Resources.lampadasL
        End If


        ' ESPACO GOURMET
        If (msg = "eg_iluminacaoambiente_0") Then
            EspacoGourmetIluminacaoAmbiente = 0
            Tela_Iluminacao.EspacoGourmet_IluminaçãoAmbiente.Image = CentralAutomacao.My.Resources.Resources.lampadas1
        End If
        If (msg = "eg_iluminacaoambiente_1") Then
            EspacoGourmetIluminacaoAmbiente = 1
            Tela_Iluminacao.EspacoGourmet_IluminaçãoAmbiente.Image = CentralAutomacao.My.Resources.Resources.lampadasL
        End If
        If (msg = "eg_pendentesdabancada_0") Then
            EspacoGourmetPendentesBancada = 0
            Tela_Iluminacao.EspacoGourmet_PendentesBancada.Image = CentralAutomacao.My.Resources.Resources.lampadas1
        End If
        If (msg = "eg_pendentesdabancada_1") Then
            EspacoGourmetPendentesBancada = 1
            Tela_Iluminacao.EspacoGourmet_PendentesBancada.Image = CentralAutomacao.My.Resources.Resources.lampadasL
        End If
        If (msg = "eg_iluminacaodachurrasqueira_0") Then
            EspacoGourmetIluminacaoDaChurrasqueira = 0
            Tela_Iluminacao.EspacoGourmet_IluminacaoChurrasqueira.Image = CentralAutomacao.My.Resources.Resources.lampadas1
        End If
        If (msg = "eg_iluminacaodachurrasqueira_1") Then
            EspacoGourmetIluminacaoDaChurrasqueira = 1
            Tela_Iluminacao.EspacoGourmet_IluminacaoChurrasqueira.Image = CentralAutomacao.My.Resources.Resources.lampadasL
        End If


        If (msg = "apagartodascasa") Then

            Tela_Iluminacao.SalaDeEstar_IluminacaoDaSala.Image = CentralAutomacao.My.Resources.Resources.lampadas1
            Tela_Iluminacao.SalaDeEstar_ArandelasPainelTV.Image = CentralAutomacao.My.Resources.Resources.lampadas1
            Tela_Iluminacao.SalaDeEstar_LustreDaSala.Image = CentralAutomacao.My.Resources.Resources.lampadas1
            Tela_Iluminacao.SalaDeEstar_IluminacaoDaSacada.Image = CentralAutomacao.My.Resources.Resources.lampadas1
            Tela_Iluminacao.Quarto1_IluminacaoDoQuarto.Image = CentralAutomacao.My.Resources.Resources.lampadas1
            Tela_Iluminacao.Quarto1_ArandelasPainelTV.Image = CentralAutomacao.My.Resources.Resources.lampadas1
            Tela_Iluminacao.Quarto1_IluminacaoDoCortineiro.Image = CentralAutomacao.My.Resources.Resources.lampadas1
            Tela_Iluminacao.Quarto2_IluminacaoDoQuarto.Image = CentralAutomacao.My.Resources.Resources.lampadas1
            Tela_Iluminacao.Quarto2_ArandelasPainelTV.Image = CentralAutomacao.My.Resources.Resources.lampadas1
            Tela_Iluminacao.Quarto2_IluminacaoDoCortineiro.Image = CentralAutomacao.My.Resources.Resources.lampadas1
            Tela_Iluminacao.Cozinha_IluminacaoDaCozinha.Image = CentralAutomacao.My.Resources.Resources.lampadas1
            Tela_Iluminacao.Cozinha_PendentesDaIlha.Image = CentralAutomacao.My.Resources.Resources.lampadas1
            Tela_Iluminacao.Cozinha_IluminacaoAmbiente.Image = CentralAutomacao.My.Resources.Resources.lampadas1
            Tela_Iluminacao.Cozinha_IluminacaoCorredor.Image = CentralAutomacao.My.Resources.Resources.lampadas1
            Tela_Iluminacao.QuartoDeCasal_IluminacaoDoQuarto.Image = CentralAutomacao.My.Resources.Resources.lampadas1
            Tela_Iluminacao.QuartoDeCasal_ArandelasPainelTV.Image = CentralAutomacao.My.Resources.Resources.lampadas1
            Tela_Iluminacao.QuartoDeCasal_IluminacaoDoCortineiro.Image = CentralAutomacao.My.Resources.Resources.lampadas1
            Tela_Iluminacao.EspacoGourmet_IluminaçãoAmbiente.Image = CentralAutomacao.My.Resources.Resources.lampadas1
            Tela_Iluminacao.EspacoGourmet_PendentesBancada.Image = CentralAutomacao.My.Resources.Resources.lampadas1
            Tela_Iluminacao.EspacoGourmet_IluminacaoChurrasqueira.Image = CentralAutomacao.My.Resources.Resources.lampadas1


        End If


        '*******************************************************************************************************************************************************************
        '*******************************************************************************************************************************************************************
        '*******************************************************************************************************************************************************************
        '*******************************************************************************************************************************************************************
        '*******************************************************************************************************************************************************************
        '*******************************************************************************************************************************************************************



        ' TELA ILUMINACAO EXTERNA      TELA ILUMINACAO EXTERNA      TELA ILUMINACAO EXTERNA      TELA ILUMINACAO EXTERNA      TELA ILUMINACAO EXTERNA      TELA ILUMINACAO EXTERNA      TELA ILUMINACAO EXTERNA     
        ' TELA ILUMINACAO EXTERNA      TELA ILUMINACAO EXTERNA      TELA ILUMINACAO EXTERNA      TELA ILUMINACAO EXTERNA      TELA ILUMINACAO EXTERNA      TELA ILUMINACAO EXTERNA      TELA ILUMINACAO EXTERNA     
        ' TELA ILUMINACAO EXTERNA      TELA ILUMINACAO EXTERNA      TELA ILUMINACAO EXTERNA      TELA ILUMINACAO EXTERNA      TELA ILUMINACAO EXTERNA      TELA ILUMINACAO EXTERNA      TELA ILUMINACAO EXTERNA     
        ' TELA ILUMINACAO EXTERNA      TELA ILUMINACAO EXTERNA      TELA ILUMINACAO EXTERNA      TELA ILUMINACAO EXTERNA      TELA ILUMINACAO EXTERNA      TELA ILUMINACAO EXTERNA      TELA ILUMINACAO EXTERNA     
        ' TELA ILUMINACAO EXTERNA      TELA ILUMINACAO EXTERNA      TELA ILUMINACAO EXTERNA      TELA ILUMINACAO EXTERNA      TELA ILUMINACAO EXTERNA      TELA ILUMINACAO EXTERNA      TELA ILUMINACAO EXTERNA     
        ' TELA ILUMINACAO EXTERNA      TELA ILUMINACAO EXTERNA      TELA ILUMINACAO EXTERNA      TELA ILUMINACAO EXTERNA      TELA ILUMINACAO EXTERNA      TELA ILUMINACAO EXTERNA      TELA ILUMINACAO EXTERNA     




        ' ILUMINACAO TETO AREA DE CHURRASCO
        If (msg = "teto_0") Then
            Tela_Iluminacao.imgIluminacaoAreaChurrasco.Image = CentralAutomacao.My.Resources.Resources.lampadas1
        End If
        If (msg = "teto_1") Then
            Tela_Iluminacao.imgIluminacaoAreaChurrasco.Image = CentralAutomacao.My.Resources.Resources.lampadasL
        End If

        ' ILUMINACAO PENDENTE AREA DE CHURRASCO
        If (msg = "pendente_0") Then
            Tela_Iluminacao.imgPendenteAreaChurrasco.Image = CentralAutomacao.My.Resources.Resources.lampadas1
        End If
        If (msg = "pendente_1") Then
            Tela_Iluminacao.imgPendenteAreaChurrasco.Image = CentralAutomacao.My.Resources.Resources.lampadasL
        End If

        ' ILUMINACAO AMBIENTE AREA DE CHURRASCO
        If (msg = "quadro_0") Then
            Tela_Iluminacao.imgAmbienteAreaChurrasco.Image = CentralAutomacao.My.Resources.Resources.lampadas1
        End If
        If (msg = "quadro_1") Then
            Tela_Iluminacao.imgAmbienteAreaChurrasco.Image = CentralAutomacao.My.Resources.Resources.lampadasL
        End If


        ' ILUMINACAO ARANDELA AREA DE CHURRASCO
        If (msg = "muro_ch_0") Then
            Tela_Iluminacao.imgArandelaAreaChurrasco.Image = CentralAutomacao.My.Resources.Resources.lampadas1
        End If
        If (msg = "muro_ch_1") Then
            Tela_Iluminacao.imgArandelaAreaChurrasco.Image = CentralAutomacao.My.Resources.Resources.lampadasL
        End If

        ' ILUMINACAO ARANDELA CARROS
        If (msg = "muro_ca_0") Then
            Tela_Iluminacao.imgArandelaCarros.Image = CentralAutomacao.My.Resources.Resources.lampadas1
        End If
        If (msg = "muro_ca_1") Then
            Tela_Iluminacao.imgArandelaCarros.Image = CentralAutomacao.My.Resources.Resources.lampadasL
        End If


        ' JARDIM HORIZONTAL
        If (msg = "jardim_h_0") Then
            Tela_Iluminacao.imgJardimHorizontal.Image = CentralAutomacao.My.Resources.Resources.lampadas1
        End If
        If (msg = "jardim_h_1") Then
            Tela_Iluminacao.imgJardimHorizontal.Image = CentralAutomacao.My.Resources.Resources.lampadasL
        End If

        ' JARDIM HORIZONTAL
        If (msg = "jardim_v_0") Then
            Tela_Iluminacao.imgJardimVertical.Image = CentralAutomacao.My.Resources.Resources.lampadas1
        End If
        If (msg = "jardim_v_1") Then
            Tela_Iluminacao.imgJardimVertical.Image = CentralAutomacao.My.Resources.Resources.lampadasL
        End If


        ' VAGA DO CARRO 1   
        If (msg = "liga1") Then
            Tela_Iluminacao.imgVagaCarro1.Image = CentralAutomacao.My.Resources.Resources.lampadasL
        End If
        If (msg = "desliga1") Then
            Tela_Iluminacao.imgVagaCarro1.Image = CentralAutomacao.My.Resources.Resources.lampadas1
        End If

        ' VAGA DO CARRO 2   
        If (msg = "liga2") Then
            Tela_Iluminacao.imgVagaCarro2.Image = CentralAutomacao.My.Resources.Resources.lampadasL
        End If
        If (msg = "desliga2") Then
            Tela_Iluminacao.imgVagaCarro2.Image = CentralAutomacao.My.Resources.Resources.lampadas1
        End If

        ' VAGA DO CARRO 3
        If (msg = "liga3") Then
            Tela_Iluminacao.imgVagaCarro3.Image = CentralAutomacao.My.Resources.Resources.lampadasL
        End If
        If (msg = "desliga3") Then
            Tela_Iluminacao.imgVagaCarro3.Image = CentralAutomacao.My.Resources.Resources.lampadas1
        End If


        ' ILUMINACAO AREA DE SERVIÇO    
        If (msg = "area_0") Then
            Tela_Iluminacao.imgAreaServico.Image = CentralAutomacao.My.Resources.Resources.lampadas1
        End If
        If (msg = "area_1") Then
            Tela_Iluminacao.imgAreaServico.Image = CentralAutomacao.My.Resources.Resources.lampadasL
        End If


        ' ILUMINACAO ARANDELA DA CASA
        If (msg = "frente_0") Then
            Tela_Iluminacao.imgArandelasCasa.Image = CentralAutomacao.My.Resources.Resources.lampadas1
        End If
        If (msg = "frente_1") Then
            Tela_Iluminacao.imgArandelasCasa.Image = CentralAutomacao.My.Resources.Resources.lampadasL
        End If






        If (msg = "apagartodasexterna") Then

        End If











    End Sub

    Private Sub btnConnect_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btnConnect.Click
        SerialPort1.PortName = cmbPort.Text         'Set SerialPort1 to the selected COM port at startup
        SerialPort1.BaudRate = cmbBaud.Text         'Set Baud rate to the selected value on 

        'Other Serial Port Property
        SerialPort1.Parity = IO.Ports.Parity.None
        SerialPort1.StopBits = IO.Ports.StopBits.One
        SerialPort1.DataBits = 8            'Open our serial port
        SerialPort1.Open()

        btnConnect.Enabled = False          'Disable Connect button
        btnDisconnect.Enabled = True        'and Enable Disconnect button
        Painel_Configuracoes.Visible = False
        ' btnDisconnect.Visible = True
        lbTitulo.Visible = True

    End Sub

    Public Sub SerialPort1_DataReceived(ByVal sender As Object, ByVal e As System.IO.Ports.SerialDataReceivedEventArgs) Handles SerialPort1.DataReceived
        ReceivedText("")

        ReceivedText(SerialPort1.ReadExisting())    'Automatically called every time a data is received at the serialPort

    End Sub

    Public Sub ReceivedText(ByVal [text] As String)

        'compares the ID of the creating Thread to the ID of the calling Thread
        If Me.rtbReceived.InvokeRequired Then
            Dim x As New SetTextCallback(AddressOf ReceivedText)
            Me.Invoke(x, New Object() {(text)})
            text = ""


        Else

            Me.rtbReceived.Text &= [text]
            tbResultado.Text &= [text]

        End If

    End Sub


    Private Sub btnDisconnect_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btnDisconnect.Click
        SerialPort1.Close()             'Close our Serial Port

        btnConnect.Enabled = True
        btnDisconnect.Enabled = False
        btnDisconnect.Visible = False
        lbMensagemRecebidaMQTT.Visible = False

    End Sub
    Private Sub tbResultado_TextChanged(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles tbResultado.TextChanged

        Me.InvokeOnClick(btnAtualiza, e)
    End Sub

    Private Sub btnLampadas_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btnLampadas.Click
        Tela_Iluminacao.Show()
    End Sub

    Private Sub lbTitulo_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles lbTitulo.Click
        'lbTitulo.Visible = False
        'Painel_Configuracoes.Visible = True
    End Sub

    Private Sub btnEnergia_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btnEnergia.Click
        TelaEnergia.Show()
    End Sub

    Private Sub lbMensagem1_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles lbMensagemRecebidaMQTT.Click
        SerialPort1.Close()             'Close our Serial Port

        btnConnect.Enabled = True
        btnDisconnect.Enabled = False
        btnDisconnect.Visible = False
        lbMensagemRecebidaMQTT.Visible = False
    End Sub

    Private Sub btnPersianas_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btnPersianas.Click
        TelaPersiana.Show()
    End Sub

    Private Sub btnCameras_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btnCameras.Click
        TelaCFTV.Show()
    End Sub

    Private Sub btnCortinas_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btnCortinas.Click
        TelaCortina.Show()
    End Sub

    Private Sub btnTV_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btnTV.Click

    End Sub

    Private Sub btnProjetor_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btnProjetor.Click
        TelaProjetor.Show()
    End Sub

    Private Sub PictureBox10_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btnSKY.Click
        TelaSKY.Show()
    End Sub

    Private Sub btnConfiguracoes_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btnConfiguracoes.Click
        TelaConfiguracoes.Show()
    End Sub

    Private Sub btnPortao_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btnPortao.Click
        TelaAcesso.Show()
    End Sub

    Private Sub btnMusica_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btnMusica.Click
        TelaMusica.Show()
    End Sub

    Private Sub btnCenas_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btnCenas.Click
        TelaCenas.Panel2.Enabled = False
        TelaCenas.Show()
    End Sub

    Private Sub Timer_Cenas_Tick(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Timer_Cenas.Tick
        resultado = String.Format("Hoje é o dia da semana : {0}, ou {1}, ou {2}", diaDaSemana, diaDaSemanaAbreviado, diaDaSemanaExpandido)
        'MsgBox(resultado)
        Dim HoraAtual As String
        HoraAtual = Mid(Now, 12, 5)
        ' MsgBox(HoraAtual)





        ' BUSCANDO EVENTO DA CENA DA SALA DE ESTAR   BUSCANDO EVENTO DA CENA DA SALA DE ESTAR BUSCANDO EVENTO DA CENA DA SALA DE ESTAR   BUSCANDO EVENTO DA CENA DA SALA DE ESTAR
        ' BUSCANDO EVENTO DA CENA DA SALA DE ESTAR   BUSCANDO EVENTO DA CENA DA SALA DE ESTAR BUSCANDO EVENTO DA CENA DA SALA DE ESTAR   BUSCANDO EVENTO DA CENA DA SALA DE ESTAR
        ' BUSCANDO EVENTO DA CENA DA SALA DE ESTAR   BUSCANDO EVENTO DA CENA DA SALA DE ESTAR BUSCANDO EVENTO DA CENA DA SALA DE ESTAR   BUSCANDO EVENTO DA CENA DA SALA DE ESTAR
        ' BUSCANDO EVENTO DA CENA DA SALA DE ESTAR   BUSCANDO EVENTO DA CENA DA SALA DE ESTAR BUSCANDO EVENTO DA CENA DA SALA DE ESTAR   BUSCANDO EVENTO DA CENA DA SALA DE ESTAR
        If SalaDeEstar_Modo = 1 Then    ' Dias de Semana
            If diaDaSemanaExpandido <> "sábado" And diaDaSemanaExpandido <> "domingo" Then
                If SalaDeEstar_HorarioAbrir = HoraAtual Then
                    On Error Resume Next
                    SerialPort1.Write("cortinasaladeestar_1")
                End If
                If SalaDeEstar_HorarioFechar = HoraAtual Then
                    On Error Resume Next
                    SerialPort1.Write("cortinasaladeestar_0")
                End If
            End If

        End If
        If SalaDeEstar_Modo = 2 Then    ' Todos os Dias
            If SalaDeEstar_HorarioAbrir = HoraAtual Then
                On Error Resume Next
                SerialPort1.Write("cortinasaladeestar_1")
            End If
            If SalaDeEstar_HorarioFechar = HoraAtual Then
                On Error Resume Next
                SerialPort1.Write("cortinasaladeestar_0")
            End If
        End If

        ' BUSCANDO EVENTO DA CENA DO QUARTO DE CASAL    BUSCANDO EVENTO DA CENA DO QUARTO DE CASAL    BUSCANDO EVENTO DA CENA DO QUARTO DE CASAL    BUSCANDO EVENTO DA CENA DO QUARTO DE CASAL   
        ' BUSCANDO EVENTO DA CENA DO QUARTO DE CASAL    BUSCANDO EVENTO DA CENA DO QUARTO DE CASAL    BUSCANDO EVENTO DA CENA DO QUARTO DE CASAL    BUSCANDO EVENTO DA CENA DO QUARTO DE CASAL   
        ' BUSCANDO EVENTO DA CENA DO QUARTO DE CASAL    BUSCANDO EVENTO DA CENA DO QUARTO DE CASAL    BUSCANDO EVENTO DA CENA DO QUARTO DE CASAL    BUSCANDO EVENTO DA CENA DO QUARTO DE CASAL   
        ' BUSCANDO EVENTO DA CENA DO QUARTO DE CASAL    BUSCANDO EVENTO DA CENA DO QUARTO DE CASAL    BUSCANDO EVENTO DA CENA DO QUARTO DE CASAL    BUSCANDO EVENTO DA CENA DO QUARTO DE CASAL   
        If QuartoDeCasal_Modo = 1 Then    ' Dias de Semana
            If diaDaSemanaExpandido <> "sábado" And diaDaSemanaExpandido <> "domingo" Then
                If QuartoDeCasal_HorarioAbrir = HoraAtual Then
                    On Error Resume Next
                    SerialPort1.Write("cortinaquartodecasal_1")
                End If
                If QuartoDeCasal_HorarioFechar = HoraAtual Then
                    On Error Resume Next
                    SerialPort1.Write("cortinaquartodecasal_0")
                End If
            End If

        End If
        If QuartoDeCasal_Modo = 2 Then    ' Todos os Dias
            If QuartoDeCasal_HorarioAbrir = HoraAtual Then
                On Error Resume Next
                SerialPort1.Write("cortinaquartodecasal_1")
            End If
            If QuartoDeCasal_HorarioFechar = HoraAtual Then
                On Error Resume Next
                SerialPort1.Write("cortinaquartodecasal_0")
            End If
        End If

        ' BUSCANDO EVENTO DA CENA DO QUARTO 1    BUSCANDO EVENTO DA CENA DO QUARTO 1    BUSCANDO EVENTO DA CENA DO QUARTO 1    BUSCANDO EVENTO DA CENA DO QUARTO 1    BUSCANDO EVENTO DA CENA DO QUARTO 1   
        ' BUSCANDO EVENTO DA CENA DO QUARTO 1    BUSCANDO EVENTO DA CENA DO QUARTO 1    BUSCANDO EVENTO DA CENA DO QUARTO 1    BUSCANDO EVENTO DA CENA DO QUARTO 1    BUSCANDO EVENTO DA CENA DO QUARTO 1   
        ' BUSCANDO EVENTO DA CENA DO QUARTO 1    BUSCANDO EVENTO DA CENA DO QUARTO 1    BUSCANDO EVENTO DA CENA DO QUARTO 1    BUSCANDO EVENTO DA CENA DO QUARTO 1    BUSCANDO EVENTO DA CENA DO QUARTO 1   
        ' BUSCANDO EVENTO DA CENA DO QUARTO 1    BUSCANDO EVENTO DA CENA DO QUARTO 1    BUSCANDO EVENTO DA CENA DO QUARTO 1    BUSCANDO EVENTO DA CENA DO QUARTO 1    BUSCANDO EVENTO DA CENA DO QUARTO 1   
        If Quarto1_Modo = 1 Then    ' Dias de Semana
            If diaDaSemanaExpandido <> "sábado" And diaDaSemanaExpandido <> "domingo" Then
                If Quarto1_HorarioAbrir = HoraAtual Then
                    On Error Resume Next
                    SerialPort1.Write("cortinaquarto1_1")
                End If
                If Quarto1_HorarioFechar = HoraAtual Then
                    On Error Resume Next
                    SerialPort1.Write("cortinaquarto1_0")
                End If
            End If

        End If
        If Quarto1_Modo = 2 Then    ' Todos os Dias
            If Quarto1_HorarioAbrir = HoraAtual Then
                On Error Resume Next
                SerialPort1.Write("cortinaquarto1_1")
            End If
            If Quarto1_HorarioFechar = HoraAtual Then
                On Error Resume Next
                SerialPort1.Write("cortinaquarto1_0")
            End If
        End If

        ' BUSCANDO EVENTO DA CENA DO QUARTO 2    BUSCANDO EVENTO DA CENA DO QUARTO 2    BUSCANDO EVENTO DA CENA DO QUARTO 2    BUSCANDO EVENTO DA CENA DO QUARTO 2    BUSCANDO EVENTO DA CENA DO QUARTO 2    
        ' BUSCANDO EVENTO DA CENA DO QUARTO 2    BUSCANDO EVENTO DA CENA DO QUARTO 2    BUSCANDO EVENTO DA CENA DO QUARTO 2    BUSCANDO EVENTO DA CENA DO QUARTO 2    BUSCANDO EVENTO DA CENA DO QUARTO 2    
        ' BUSCANDO EVENTO DA CENA DO QUARTO 2    BUSCANDO EVENTO DA CENA DO QUARTO 2    BUSCANDO EVENTO DA CENA DO QUARTO 2    BUSCANDO EVENTO DA CENA DO QUARTO 2    BUSCANDO EVENTO DA CENA DO QUARTO 2    
        ' BUSCANDO EVENTO DA CENA DO QUARTO 2    BUSCANDO EVENTO DA CENA DO QUARTO 2    BUSCANDO EVENTO DA CENA DO QUARTO 2    BUSCANDO EVENTO DA CENA DO QUARTO 2    BUSCANDO EVENTO DA CENA DO QUARTO 2    
        If Quarto2_Modo = 1 Then    ' Dias de Semana
            If diaDaSemanaExpandido <> "sábado" And diaDaSemanaExpandido <> "domingo" Then
                If Quarto2_HorarioAbrir = HoraAtual Then
                    On Error Resume Next
                    SerialPort1.Write("cortinaquarto2_1")
                End If
                If Quarto2_HorarioFechar = HoraAtual Then
                    On Error Resume Next
                    SerialPort1.Write("cortinaquarto2_0")
                End If
            End If

        End If
        If Quarto2_Modo = 2 Then    ' Todos os Dias
            If Quarto2_HorarioAbrir = HoraAtual Then
                On Error Resume Next
                SerialPort1.Write("cortinaquarto2_1")
            End If
            If Quarto2_HorarioFechar = HoraAtual Then
                On Error Resume Next
                SerialPort1.Write("cortinaquarto2_0")
            End If
        End If

        ' BUSCANDO EVENTO DA CENA DO ESPACO GOURMET   BUSCANDO EVENTO DA CENA DO ESPACO GOURMET   BUSCANDO EVENTO DA CENA DO ESPACO GOURMET   BUSCANDO EVENTO DA CENA DO ESPACO GOURMET   BUSCANDO EVENTO DA CENA DO ESPACO GOURMET  
        ' BUSCANDO EVENTO DA CENA DO ESPACO GOURMET   BUSCANDO EVENTO DA CENA DO ESPACO GOURMET   BUSCANDO EVENTO DA CENA DO ESPACO GOURMET   BUSCANDO EVENTO DA CENA DO ESPACO GOURMET   BUSCANDO EVENTO DA CENA DO ESPACO GOURMET  
        ' BUSCANDO EVENTO DA CENA DO ESPACO GOURMET   BUSCANDO EVENTO DA CENA DO ESPACO GOURMET   BUSCANDO EVENTO DA CENA DO ESPACO GOURMET   BUSCANDO EVENTO DA CENA DO ESPACO GOURMET   BUSCANDO EVENTO DA CENA DO ESPACO GOURMET  
        ' BUSCANDO EVENTO DA CENA DO ESPACO GOURMET   BUSCANDO EVENTO DA CENA DO ESPACO GOURMET   BUSCANDO EVENTO DA CENA DO ESPACO GOURMET   BUSCANDO EVENTO DA CENA DO ESPACO GOURMET   BUSCANDO EVENTO DA CENA DO ESPACO GOURMET  
        If EspacoGourmet_Modo = 1 Then    ' Dias de Semana
            If diaDaSemanaExpandido <> "sábado" And diaDaSemanaExpandido <> "domingo" Then
                If EspacoGourmet_HorarioAbrir = HoraAtual Then
                    On Error Resume Next
                    SerialPort1.Write("espacogourmetpersianas_1")
                End If
                If EspacoGourmet_HorarioFechar = HoraAtual Then
                    On Error Resume Next
                    SerialPort1.Write("espacogourmetpersianas_0")
                End If
            End If

        End If
        If EspacoGourmet_Modo = 2 Then    ' Todos os Dias
            If EspacoGourmet_HorarioAbrir = HoraAtual Then
                On Error Resume Next
                SerialPort1.Write("espacogourmetpersianas_1")
            End If
            If EspacoGourmet_HorarioFechar = HoraAtual Then
                On Error Resume Next
                SerialPort1.Write("espacogourmetpersianas_0")
            End If
        End If

        ' BUSCANDO EVENTO DA CENA DO LAB ELETRONICA   BUSCANDO EVENTO DA CENA DO LAB ELETRONICA   BUSCANDO EVENTO DA CENA DO LAB ELETRONICA   BUSCANDO EVENTO DA CENA DO LAB ELETRONICA   BUSCANDO EVENTO DA CENA DO LAB ELETRONICA  
        ' BUSCANDO EVENTO DA CENA DO LAB ELETRONICA   BUSCANDO EVENTO DA CENA DO LAB ELETRONICA   BUSCANDO EVENTO DA CENA DO LAB ELETRONICA   BUSCANDO EVENTO DA CENA DO LAB ELETRONICA   BUSCANDO EVENTO DA CENA DO LAB ELETRONICA  
        ' BUSCANDO EVENTO DA CENA DO LAB ELETRONICA   BUSCANDO EVENTO DA CENA DO LAB ELETRONICA   BUSCANDO EVENTO DA CENA DO LAB ELETRONICA   BUSCANDO EVENTO DA CENA DO LAB ELETRONICA   BUSCANDO EVENTO DA CENA DO LAB ELETRONICA  
        ' BUSCANDO EVENTO DA CENA DO LAB ELETRONICA   BUSCANDO EVENTO DA CENA DO LAB ELETRONICA   BUSCANDO EVENTO DA CENA DO LAB ELETRONICA   BUSCANDO EVENTO DA CENA DO LAB ELETRONICA   BUSCANDO EVENTO DA CENA DO LAB ELETRONICA  
        If LabEletronica_Modo = 1 Then    ' Dias de Semana
            If diaDaSemanaExpandido <> "sábado" And diaDaSemanaExpandido <> "domingo" Then
                If LabEletronica_HorarioAbrir = HoraAtual Then
                    On Error Resume Next
                    SerialPort1.Write("labeletronicapersiana_1")
                End If
                If LabEletronica_HorarioFechar = HoraAtual Then
                    On Error Resume Next
                    SerialPort1.Write("labeletronicapersiana_0")
                End If
            End If

        End If
        If LabEletronica_Modo = 2 Then    ' Todos os Dias
            If LabEletronica_HorarioAbrir = HoraAtual Then
                On Error Resume Next
                SerialPort1.Write("labeletronicapersiana_1")
            End If
            If LabEletronica_HorarioFechar = HoraAtual Then
                On Error Resume Next
                SerialPort1.Write("labeletronicapersiana_0")
            End If
        End If

        ' BUSCANDO EVENTO DA CENA DA COZINHA    BUSCANDO EVENTO DA CENA DA COZINHA    BUSCANDO EVENTO DA CENA DA COZINHA    BUSCANDO EVENTO DA CENA DA COZINHA    BUSCANDO EVENTO DA CENA DA COZINHA    BUSCANDO EVENTO DA CENA DA COZINHA   
        ' BUSCANDO EVENTO DA CENA DA COZINHA    BUSCANDO EVENTO DA CENA DA COZINHA    BUSCANDO EVENTO DA CENA DA COZINHA    BUSCANDO EVENTO DA CENA DA COZINHA    BUSCANDO EVENTO DA CENA DA COZINHA    BUSCANDO EVENTO DA CENA DA COZINHA   
        ' BUSCANDO EVENTO DA CENA DA COZINHA    BUSCANDO EVENTO DA CENA DA COZINHA    BUSCANDO EVENTO DA CENA DA COZINHA    BUSCANDO EVENTO DA CENA DA COZINHA    BUSCANDO EVENTO DA CENA DA COZINHA    BUSCANDO EVENTO DA CENA DA COZINHA   
        ' BUSCANDO EVENTO DA CENA DA COZINHA    BUSCANDO EVENTO DA CENA DA COZINHA    BUSCANDO EVENTO DA CENA DA COZINHA    BUSCANDO EVENTO DA CENA DA COZINHA    BUSCANDO EVENTO DA CENA DA COZINHA    BUSCANDO EVENTO DA CENA DA COZINHA   
        If Cozinha_Modo = 1 Then    ' Dias de Semana
            If diaDaSemanaExpandido <> "sábado" And diaDaSemanaExpandido <> "domingo" Then
                If Cozinha_HorarioAbrir = HoraAtual Then
                    On Error Resume Next
                    SerialPort1.Write("cozinhapersiana_1")
                End If
                If Cozinha_HorarioFechar = HoraAtual Then
                    On Error Resume Next
                    SerialPort1.Write("cozinhapersiana_0")
                End If
            End If

        End If
        If Cozinha_Modo = 2 Then    ' Todos os Dias
            If Cozinha_HorarioAbrir = HoraAtual Then
                On Error Resume Next
                SerialPort1.Write("cozinhapersiana_1")
            End If
            If Cozinha_HorarioFechar = HoraAtual Then
                On Error Resume Next
                SerialPort1.Write("cozinhapersiana_0")
            End If
        End If

    End Sub
End Class
