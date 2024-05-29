Imports System
Imports System.ComponentModel
Imports System.Drawing
Imports System.Windows.Forms

' DigitalPinControl.vb user control class. 
' A user control to control a microcontroller digital pin.
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

<ToolboxBitmap(GetType(DigitalPinControl), "digitalpincontrol.ico")> _
Public Class DigitalPinControl

    Public Enum LEDStates As Integer
        LED_ON = 1
        LED_OFF = 0
        LED_DIM = 2
    End Enum

    Public Enum DigitalControlType
        INPUT
        OUTPUT_BOTH
        OUTPUT_DIGITAL
        OUTPUT_PWM
        INPUT_OUTPUT
    End Enum

    Public Enum PinModes
        INPUT
        OUTPUT_DIGITAL
        OUTPUT_PWM
    End Enum

    Public Enum OutputModes
        DIGITAL
        PWM
    End Enum

    Private PinModeValue As PinModes
    Private DigitalOutputModeValue As OutputModes
    Private LEDstateValue As LEDStates
    Private Pin As Integer
    Private ControlTypeValue As DigitalControlType
    Private PWMAvailableValue As Boolean
    Private MyPortReportingValue As Boolean = False
    Private PortValue As Integer

    Public Event PinMode_Changed(ByVal PinNumber As Integer, ByVal Mode As PinModes)
    Public Event DigitalSend(ByVal PinNumber As Integer, ByVal value As Integer)
    Public Event PWMSend(ByVal PinNumber As Integer, ByVal PWMValue As Integer)

    <Description("Sets whether the Pin Control displays the PWM controls")> _
    Private Property PWMAvailable() As Boolean
        Get
            Return PWMAvailableValue
        End Get
        Set(ByVal value As Boolean)
            PWMAvailableValue = value
        End Set
    End Property

    <Description("Sets MyPortReporting on or off. This toggles the LED between dimmed and active")> _
    Public Property MyPortReporting() As Boolean
        Get
            Return MyPortReportingValue
        End Get
        Set(ByVal value As Boolean)
            MyPortReportingValue = value
            UpdateEnabledControls()
        End Set
    End Property

    <Description("Sets Pin Mode")> _
    Public Property PinMode() As PinModes
        Get
            Return PinModeValue
        End Get
        Set(ByVal value As PinModes)
            PinModeValue = value
            Debug.Print("Pin mode is: " & Me.PinModeValue)
            UpdateEnabledControls()
            RaiseEvent PinMode_Changed(Me.PinNumber, Me.PinMode)
        End Set
    End Property

    <Description("Used to set digital output mode")> _
    Public Property DigitalOutputMode() As OutputModes
        Get
            Return DigitalOutputModeValue
        End Get
        Set(ByVal value As OutputModes)
            DigitalOutputModeValue = value
        End Set
    End Property

    <Description("Arduino Pin number that this control is associated with.")> _
    Public Property PinNumber() As Integer
        ' TODO: Needs to be changed to deal with other board configurations
        ' currently using Diecimila board configuration
        Get
            Return Pin
        End Get
        Set(ByVal value As Integer)
            Select Case value
                Case 0, 1
                    Me.PWMAvailable = False
                Case 3, 5, 6, 9, 10, 11
                    'PWM available on these pins
                    Me.PWMAvailable = True
                    Pin = value
                    lblPinNumber.Text = Pin.ToString()
                Case 2, 4, 7, 8, 12, 13
                    Me.PWMAvailable = False
                    Pin = value
                    Me.DigitalOutputMode = OutputModes.DIGITAL
                    lblPinNumber.Text = Pin.ToString()
                    'MessageBox.Show("PWM is not available on this pin")
                Case Else
                    MessageBox.Show("Enter a Pin value from 0 - 13")
                    Pin = 0
            End Select
            Select Case value
                Case 0, 1, 2, 3, 4, 5, 6, 7
                    Me.PortValue = 0
                Case 8, 9, 10, 11, 12, 13
                    Me.PortValue = 1
            End Select
            UpdateEnabledControls()
        End Set
    End Property

    <Description("Sets the Port this DigitalControl is in")> _
    Public Property Port() As Integer
        Get
            Return PortValue
        End Get
        Set(ByVal value As Integer)
            PortValue = value
        End Set
    End Property

    Public Sub New()
        ' This call is required by the Windows Form Designer.
        InitializeComponent()
        UpdateEnabledControls()
    End Sub

    Public Sub New(ByVal PinNumber As Integer)
        ' This call is required by the Windows Form Designer.
        InitializeComponent()
        ' This New can be used in code allowing
        ' the pin number to be set when creating the control
        Me.PinNumber = PinNumber
        UpdateEnabledControls()
    End Sub

    <Description("LED state. Sets LED image to use")> _
    Public Property LED() As LEDStates
        'Sets the LED image to be used in the pbLED
        'PictureBox
        Get
            Return LEDstateValue
        End Get
        Set(ByVal value As LEDStates)
            LEDstateValue = value
            Select Case value
                Case LEDStates.LED_ON
                    LEDstateValue = LEDStates.LED_ON
                    pbLED.Image = My.Resources.LEDOn
                Case LEDStates.LED_OFF
                    LEDstateValue = LEDStates.LED_OFF
                    pbLED.Image = My.Resources.LEDOff
                Case LEDStates.LED_DIM
                    LEDstateValue = LEDStates.LED_DIM
                    pbLED.Image = My.Resources.LEDDim
            End Select
        End Set
    End Property

    Private Sub tbInOut_Scroll(ByVal sender As Object, ByVal e As System.EventArgs) Handles tbInOut.Scroll
        ' Sets PinMode based on value of tbInOut TrackBar
        ' and DigitalOutputMode property
        If tbInOut.Value = 0 Then
            'Input
            Me.PinMode = PinModes.INPUT
        Else
            ' Value = 1 one of two output modes
            If Me.DigitalOutputMode = OutputModes.DIGITAL Then
                'Digital
                Me.PinMode = PinModes.OUTPUT_DIGITAL
            Else
                'PWM
                Me.PinMode = PinModes.OUTPUT_PWM
            End If
        End If
    End Sub

    Private Sub rbOutDigi_Click(ByVal sender As Object, ByVal e As System.EventArgs) Handles rbOutDigi.Click, rbOutPWM.Click
        'Handles click on either rbOutDigi or rbPWM radio buttons
        Select Case sender.name
            Case "rbOutDigi"
                Me.DigitalOutputMode = OutputModes.DIGITAL
                Me.PinMode = PinModes.OUTPUT_DIGITAL
            Case "rbOutPWM"
                Me.DigitalOutputMode = OutputModes.PWM
                Me.PinMode = PinModes.OUTPUT_PWM
        End Select
    End Sub

    Public Sub UpdateEnabledControls()
        ' Enables or disables relevant controls for each
        ' PinMode
        Select Case PinModeValue
            Case PinModes.INPUT
                If MyPortReportingValue = False Then
                    Me.LED = LEDStates.LED_DIM
                Else
                    Me.LED = LEDStates.LED_OFF
                End If

                'Digital controls visible but disabled
                rbOutDigi.Enabled = False
                cbOnOff.Enabled = False

                If Me.PWMAvailable = True Then
                    'PWM controls visible but disabled
                    rbOutPWM.Visible = True
                    rbOutPWM.Enabled = False
                    tbPWM.Visible = True
                    tbPWM.Enabled = False
                Else
                    'PWM controls not visible and disabled
                    rbOutPWM.Visible = False
                    rbOutPWM.Enabled = False
                    tbPWM.Visible = False
                    tbPWM.Enabled = False
                End If

            Case PinModes.OUTPUT_DIGITAL
                Me.LED = LEDStates.LED_DIM
                'Digital controls visible and enabled
                rbOutDigi.Enabled = True
                rbOutDigi.Checked = True
                cbOnOff.Enabled = True

                If Me.PWMAvailable = True Then
                    rbOutPWM.Visible = True
                    rbOutPWM.Enabled = True
                    tbPWM.Visible = True
                    tbPWM.Enabled = False
                Else
                    rbOutPWM.Visible = False
                    tbPWM.Visible = False
                    rbOutDigi.Checked = True
                End If

            Case PinModes.OUTPUT_PWM
                Me.LED = LEDStates.LED_DIM
                rbOutDigi.Enabled = True
                rbOutPWM.Enabled = True
                rbOutPWM.Visible = True
                rbOutPWM.Checked = True
                cbOnOff.Enabled = False
                tbPWM.Enabled = True
                tbPWM.Visible = True
        End Select
    End Sub

    Private Sub cbOnOff_CheckedChanged(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles cbOnOff.CheckedChanged
        'Changes colour of cbOnOff background based on checked
        'or not checked. Raises DigitalSend event
        'which will be handled by parent form to send
        'serial message to pin
        If cbOnOff.Checked Then
            cbOnOff.Text = "On"
            cbOnOff.BackColor = Color.Red
            RaiseEvent DigitalSend(Me.PinNumber, 1)
        Else
            cbOnOff.Text = "Off"
            cbOnOff.BackColor = Color.FromKnownColor(KnownColor.Control)
            RaiseEvent DigitalSend(Me.PinNumber, 0)
        End If
    End Sub

    Private Sub tbPWM_Scroll(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles tbPWM.Scroll
        'Raises event that sends PinNumber and PWM value as arguments
        'to be handled by parent form to send PWM via serial to pin
        RaiseEvent PWMSend(Me.PinNumber, tbPWM.Value)
    End Sub

End Class
