Imports System
Imports System.ComponentModel
Imports System.Drawing
Imports System.Windows.Forms

' AnalogPinControl.vb - A user control for  
' A user control to control a microcontroller analog pin.
' The microcontroller should be running the Standard Firmata
' protocol. The control relies on an instance of the FirmataVB
' component being present in the project.
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

<ToolboxBitmap(GetType(AnalogPinControl), "AnalogPinControl.ico")> _
Public Class AnalogPinControl
    Private PinNumberValue As Integer = 0
    Private HideWhenOffValue As Boolean = False
    Private ClearValuesValue As Boolean = False
    Private AnalogValueValue As Integer = 0


    <Description("The number of the board pin this control relates to")> _
    Public Property PinNumber() As Integer
        Get
            Return PinNumberValue
            lblPinNumber.Text = PinNumberValue.ToString()
        End Get
        Set(ByVal value As Integer)
            PinNumberValue = value
            lblPinNumber.Text = PinNumberValue.ToString()
        End Set
    End Property

    <Description("Sets if the Progress Bar and Label controls showing the analog value should be hidden when Off")> _
    Public Property HideWhenOff() As Boolean
        Get
            Return HideWhenOffValue
        End Get
        Set(ByVal value As Boolean)
            HideWhenOffValue = value
        End Set
    End Property

    <Description("Sets whether the Progress Bar and Label controls showing the analog values should be set to zero when turned off")> _
    Public Property ClearValues() As Boolean
        Get
            Return ClearValuesValue
        End Get
        Set(ByVal value As Boolean)
            ClearValuesValue = value
        End Set
    End Property

    <Description("Gets or sets the analog value displayed by the control")> _
    Public Property AnalogValue() As Integer
        Get
            Return AnalogValueValue
        End Get
        Set(ByVal value As Integer)
            AnalogValueValue = value
            lblPWMValue.Text = CStr(value)
            pbPWMValue.Value = value

        End Set
    End Property

    Delegate Sub AnalogValueCallback(ByVal value As Integer)

    <Description("Sets the analog value in a threadsafe way")> _
    Public Sub SetAnalogValue(ByVal value As Integer)
        If value >= 0 And value <= 1023 Then
            ' Following code necessary for 'threadsafe' operation
            ' the sub is called from the thread receiving serial
            ' data and the label is the thread dealing with the GUI (Form)
            If Me.lblPWMValue.InvokeRequired Then
                Dim d As New AnalogValueCallback(AddressOf SetAnalogValue)
                Me.Invoke(d, New Object() {value})
            Else
                Me.AnalogValue = value
            End If

        Else
            Throw New Exception("Analog value must be between 0 and 1023")
        End If
    End Sub

    <Description("Handles the CheckedChanged events the On/Off checkbox")> _
    Public Sub cbOnOff_CheckedChanged(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles cbOnOff.CheckedChanged
        If cbOnOff.Text = "Off" Then
            'Turn it On
            cbOnOff.Text = "On"
            UpdateControls(1)
            RaiseEvent AnalogOnOff_Changed(PinNumberValue, 1)
        Else
            'Turn it Off
            cbOnOff.Text = "Off"
            UpdateControls(0)
            RaiseEvent AnalogOnOff_Changed(PinNumberValue, 0)
        End If
    End Sub

    Public Sub UpdateControls(ByVal OnOff As Integer)
        Select Case OnOff
            Case 0 ' Off
                lblPWMValue.Enabled = False
                pbPWMValue.Enabled = False
                If HideWhenOffValue = True Then
                    lblPWMValue.Visible = False
                    pbPWMValue.Visible = False
                End If
                If ClearValuesValue = True Then
                    lblPWMValue.Text = "0000"
                    pbPWMValue.Value = 0
                End If
            Case 1 ' On
                lblPWMValue.Enabled = True
                pbPWMValue.Enabled = True
                lblPWMValue.Visible = True
                pbPWMValue.Visible = True
        End Select
    End Sub

    Public Sub New()

        ' This call is required by the Windows Form Designer.
        InitializeComponent()
        Me.PinNumber = 0
        UpdateControls(0)

    End Sub

    <Description("Raised when the On/Off checkbox value changes")> _
    Public Event AnalogOnOff_Changed(ByVal PinNumber As Integer, ByVal OnOff As Integer)

End Class