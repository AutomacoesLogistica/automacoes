' Arduino <> Firmata <> Visual Basic .NET 
' ArduinoFirmataVBExtended
' Program to demonstrate the use of FirmataVB, DigitalPinControl
' and AnalogPinControl components
' The program communicates with an Arduino Diecimila 
' running the freely available Standard Firmata Library (see links below
' for info on Firmata)
' Copyright (c) 2009 Andrew Craigie. All rights reserved
' http://www.acraigie.com

'This program is free software: you can redistribute it and/or modify
'it under the terms of the GNU General Public License as published by
'the Free Software Foundation, either version 3 of the License, or
'(at your option) any later version.

'This program is distributed in the hope that it will be useful,
'but WITHOUT ANY WARRANTY; without even the implied warranty of
'MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
'GNU General Public License for more details.

'You should have received a copy of the GNU General Public License
'along with this program.  If not, see <http://www.gnu.org/licenses/>.

' 
' Firmata is a generic protocol for communicating with microcontrollers 
' from software on a host computer
' Firmata library http://www.firmata.org and http://sourceforge.net/projects/firmata

Public Class Form1
    Private DigitalPins As New Hashtable
    Private AnalogPins As New Hashtable
    Private Sub Form1_Load(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles MyBase.Load
        FillCOMsCombo()
        FillBaudCombo()
        UpdateToolStrip()

        For Each ctrl As System.Windows.Forms.Control In Me.Controls
            Dim ThisCtrl As Firmata.DigitalPinControl = Nothing
            If TypeOf ctrl Is Firmata.DigitalPinControl Then
                ThisCtrl = ctrl
                DigitalPins.Add(CStr(ThisCtrl.PinNumber), ThisCtrl)
                AddHandler ThisCtrl.DigitalSend, AddressOf DigitalPinControl_DigitalSend
                AddHandler ThisCtrl.PinMode_Changed, AddressOf DigitalPinControl_PinMode_Changed
                AddHandler ThisCtrl.PWMSend, AddressOf DigitalPinControl_PWMSend
            End If
        Next

        For Each ctrl As System.Windows.Forms.Control In Me.Controls
            Dim ThisCtrl As Firmata.AnalogPinControl = Nothing
            If TypeOf ctrl Is Firmata.AnalogPinControl Then
                ThisCtrl = ctrl
                AnalogPins.Add(CStr(ThisCtrl.PinNumber), ThisCtrl)
                AddHandler ThisCtrl.AnalogOnOff_Changed, AddressOf AnalogPinControl_AnalogOnOff_Changed
            End If

        Next

        'If FirmataVB1 IsNot Nothing Then
        'FirmataVB1.Connect("COM4", 115200)
        'End If

    End Sub

    Private Sub DigitalPinControl_DigitalSend(ByVal PinNumber As Integer, ByVal value As Integer)
        FirmataVB1.DigitalWrite(PinNumber, value)
    End Sub

    Private Sub DigitalPinControl_PinMode_Changed(ByVal PinNumber As Integer, ByVal Mode As Firmata.DigitalPinControl.PinModes)
        If FirmataVB1.PortOpen = True Then
            FirmataVB1.PinMode(PinNumber, Mode)
        End If
    End Sub

    Private Sub DigitalPinControl_PWMSend(ByVal PinNumber As Integer, ByVal PWMValue As Integer)
        FirmataVB1.AnalogWrite(PinNumber, PWMValue)
    End Sub

    Private Sub AnalogPinControl_AnalogOnOff_Changed(ByVal PinNumber As Integer, ByVal OnOff As Integer)
        FirmataVB1.AnalogPinReport(PinNumber, OnOff)

    End Sub

    Private Sub btnClose_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btnClose.Click
        If FirmataVB1.PortOpen = True Then
            FirmataVB1.Disconnect()
        End If
        Me.Close()
    End Sub

    Private Sub cbPort_CheckedChanged(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles cbPort1.CheckedChanged, cbPort0.CheckedChanged
        Dim cbOnOff As System.Windows.Forms.CheckBox
        cbOnOff = sender
        Dim portNumber As Integer
        portNumber = CInt(cbOnOff.Tag)
        Dim OnOff As Integer = 0

        If cbOnOff.Checked = True Then
            cbOnOff.Text = "On"
            OnOff = 1
            FirmataVB1.DigitalPortReport(portNumber, OnOff)
            For Each de As DictionaryEntry In DigitalPins
                Dim ctrl As Firmata.DigitalPinControl
                ctrl = DigitalPins(de.Key)
                If ctrl.Port = portNumber Then
                    ctrl.MyPortReporting = True
                End If
            Next
        Else
            cbOnOff.Text = "Off"
            OnOff = 0
            FirmataVB1.DigitalPortReport(portNumber, OnOff)
            For Each de As DictionaryEntry In DigitalPins
                Dim ctrl As Firmata.DigitalPinControl
                ctrl = DigitalPins(de.Key)
                If ctrl.Port = portNumber Then
                    ctrl.MyPortReporting = False
                End If
            Next
        End If
    End Sub

    Private Sub ExitToolStripMenuItem_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles ExitToolStripMenuItem.Click
        ' Dispose of components then
        If Not FirmataVB1 Is Nothing Then
            FirmataVB1.Disconnect()
            FirmataVB1 = Nothing
        End If
        Me.Close()
    End Sub

    Private Sub AboutToolStripMenuItem_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles AboutToolStripMenuItem.Click
        System.Diagnostics.Process.Start("http://www.acraigie.com/programming/firmatavb/default.html")
    End Sub

    Private Sub HelpToolStripMenuItem1_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles HelpToolStripMenuItem1.Click
        System.Diagnostics.Process.Start("http://www.acraigie.com/programming/firmatavb/default.html")
    End Sub

    Public Sub FillCOMsCombo()
        tscbCOMList.Items.AddRange(FirmataVB1.COMPortList())
        tscbCOMList.Text = Firmata.FirmataVB.DEFAULT_COM_PORT
        ' or set it to the COM port property of this instance of FirmataVB ...
        ' tscbCOMList.Text = FirmataVB1.PortName 
    End Sub

    Public Sub FillBaudCombo()
        tscbBaud.Items.AddRange(FirmataVB1.CommonBaudRates())
        tscbBaud.Text = Firmata.FirmataVB.DEFAULT_BAUD_RATE
        ' or set it to the Baud property of this instance of FirmataVB
        ' tscbBaud.text = FirmataVB1.Baud 
    End Sub

    Private Sub tscbCOMList_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles tscbCOMList.Click
        If tscbCOMList.Text <> "" Then
            FirmataVB1.COMPortName = tscbCOMList.Text
        End If
    End Sub

    Private Sub tscbBaud_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles tscbBaud.Click
        If tscbBaud.Text <> "" Then
            FirmataVB1.Baud = CInt(tscbBaud.Text)
        End If
    End Sub

    Private Sub tsbtnConnection_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles tsbtnConnection.Click
        If tsbtnConnection.Text = "Connect" Then
            FirmataVB1.Connect(tscbCOMList.Text, CInt(tscbBaud.Text))
            FirmataVB1.QueryVersion()
            UpdateToolStrip()
        Else
            FirmataVB1.Disconnect()
            UpdateToolStrip()
        End If
    End Sub

    Public Sub UpdateToolStrip()
        If (tscbCOMList.Text <> "" And tscbBaud.Text <> "") And FirmataVB1.PortOpen() = False Then
            tsbtnConnection.Enabled = True
            tsbtnConnection.Text = "Connect"
            tslblStatus.Text = ""
            tslblStatus.BackColor = Color.Green
            tscbCOMList.Enabled = True
            tscbBaud.Enabled = True
        ElseIf FirmataVB1.PortOpen() = True Then
            tsbtnConnection.Enabled = True
            tsbtnConnection.Text = "Disconnect"
            ' Need a property of FirmataVB to get port name in use
            tslblStatus.Text = FirmataVB1.PortName() & " is connected"
            tslblStatus.BackColor = Color.LightPink
            tscbCOMList.Enabled = False
            tscbBaud.Enabled = False
        Else
            tsbtnConnection.Enabled = False
            tsbtnConnection.Text = "Connect"
            tslblStatus.Text = ""
            tslblStatus.BackColor = Color.Green
            tscbCOMList.Enabled = True
            tscbBaud.Enabled = True
        End If
    End Sub

    ' Handles clicking the Set all to Inputs button
    ' cycles through Pins hashtable and sends a set input message
    ' to the board for each pin. Here for convenience when
    ' testing    
    Private Sub btnSetAllInputs_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btnSetAllInputs.Click
        For Each de As DictionaryEntry In DigitalPins
            FirmataVB1.PinMode(CInt(de.Key), Firmata.FirmataVB.INPUT)
        Next
    End Sub

    ' Handles clicking of either Port Reporting on/off checkboxes
    ' Firmata V 2.0 does not support digital reporting of individual
    ' pins
    Private Sub cbPort0_CheckedChanged(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles cbPort0.CheckedChanged, cbPort1.CheckedChanged
        Dim digitalReportOnOff As System.Windows.Forms.CheckBox
        digitalReportOnOff = sender

        Dim portNumber As Integer
        portNumber = CInt(digitalReportOnOff.Tag)
        Dim onOff As Integer = 0

        If digitalReportOnOff.Checked = True Then
            digitalReportOnOff.Text = "On"
            onOff = 1
            FirmataVB1.DigitalPortReport(portNumber, onOff)
            ' Set LED graphic in port to active
            For Each de As DictionaryEntry In DigitalPins
                Dim ctrl As Firmata.DigitalPinControl
                ctrl = DigitalPins(de.Key)
                If ctrl.Port = portNumber Then
                    ctrl.MyPortReporting = True
                End If
            Next
        Else
            digitalReportOnOff.Text = "Off"
            onOff = 0
            FirmataVB1.DigitalPortReport(portNumber, onOff)
            ' Set LED graphic in port to dimmed
            For Each de As DictionaryEntry In DigitalPins
                Dim ctrl As Firmata.DigitalPinControl
                ctrl = DigitalPins(de.Key)
                If ctrl.Port = portNumber Then
                    ctrl.MyPortReporting = False
                End If
            Next
        End If
    End Sub

    ' Handles FirmataVB_AnalogMessaageReceived
    Private Sub FirmataVB1_AnalogMessageReceieved(ByVal pin As Integer, ByVal value As Integer) Handles FirmataVB1.AnalogMessageReceieved
        Dim AnalogPin As Firmata.AnalogPinControl
        AnalogPin = AnalogPins(CStr(pin))
        ' Call the SetAnalogValue sub rather than
        ' try to set the AnalogValue property directly
        ' SetAnalogValue has code in it to make the
        ' call in a threadsafe way
        AnalogPin.SetAnalogValue(value)
        ' NOT - AnalogPin.AnalogValue = value

    End Sub

    ' Handles FirmataVB_DigitalMessageReceieved. 
    Private Sub FirmataVB1_DigitalMessageReceieved(ByVal portNumber As Integer, ByVal portData As Integer) Handles FirmataVB1.DigitalMessageReceieved
        ' We could simply do a DigitalRead for each DigitalControl but
        ' at least only doing a port at a time saves some time
        ' Ideally we want an event that is fired by FirmataVB that
        ' sends as it's arguments the PinNumber and On/Off
        Select Case portNumber
            Case 0 ' Cycle through Port 0 pins - pins 2 to 7. (Pins 0/1 are RX/TX pins)
                For i As Integer = 2 To 7 ' Need to come up with a simple way of setting the range from the 
                    ' DigitalControls on the Form and the board being used
                    Dim value As Integer
                    value = FirmataVB1.DigitalRead(i)
                    Dim PinControl As Firmata.DigitalPinControl
                    PinControl = DigitalPins(CStr(i))
                    Select Case value
                        Case 1
                            PinControl.LED = Firmata.DigitalPinControl.LEDStates.LED_ON
                        Case 0
                            If PinControl.PinMode = Firmata.DigitalPinControl.PinModes.INPUT Then
                                PinControl.LED = Firmata.DigitalPinControl.LEDStates.LED_OFF
                            Else
                                PinControl.LED = Firmata.DigitalPinControl.LEDStates.LED_DIM
                            End If
                    End Select
                Next
            Case 1 ' Cycle through Port 1 pins - pins 8 - 12. (Pin 13 is LED pin)
                For i As Integer = 8 To 12
                    Dim value As Integer
                    value = FirmataVB1.DigitalRead(i)
                    Dim PinControl As Firmata.DigitalPinControl
                    PinControl = DigitalPins(CStr(i))
                    Select Case value
                        Case 1
                            PinControl.LED = Firmata.DigitalPinControl.LEDStates.LED_ON
                        Case 0
                            If PinControl.PinMode = Firmata.DigitalPinControl.PinModes.INPUT Then
                                PinControl.LED = Firmata.DigitalPinControl.LEDStates.LED_OFF
                            Else
                                PinControl.LED = Firmata.DigitalPinControl.LEDStates.LED_DIM
                            End If

                    End Select
                Next
        End Select

    End Sub

    Private Sub FirmataVB1_VersionInfoReceieved(ByVal majorVersion As Integer, ByVal minorVersion As Integer) Handles FirmataVB1.VersionInfoReceieved
        ' Update label or other control in thread safe way
        ' to display Major and Minor version info
        Debug.Print("Majorversion: " & majorVersion & " Minorversion: " & minorVersion)
    End Sub
End Class
