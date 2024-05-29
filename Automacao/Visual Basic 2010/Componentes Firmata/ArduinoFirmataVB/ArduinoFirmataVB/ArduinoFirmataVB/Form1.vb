' Arduino <> Firmata <> Visual Basic .NET
' ArduinoFirmataVB
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

        If FirmataVB1 IsNot Nothing Then
            FirmataVB1.Connect("COM4", 115200)
        End If

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

    Private Sub btnSetAllInputs_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btnSetAllInputs.Click
        For Each de As DictionaryEntry In DigitalPins
            FirmataVB1.PinMode(CInt(de.Key), Firmata.FirmataVB.INPUT)
        Next
    End Sub

    Private Sub FirmataVB1_AnalogMessageReceieved(ByVal pin As Integer, ByVal value As Integer) Handles FirmataVB1.AnalogMessageReceieved
        Dim AnalogPin As Firmata.AnalogPinControl
        AnalogPin = AnalogPins(CStr(pin))
        AnalogPin.SetAnalogValue(value)
    End Sub

    Private Sub FirmataVB1_DigitalMessageReceieved(ByVal portNumber As Integer, ByVal portData As Integer) Handles FirmataVB1.DigitalMessageReceieved
        For i As Integer = 2 To 12
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
    End Sub

End Class
