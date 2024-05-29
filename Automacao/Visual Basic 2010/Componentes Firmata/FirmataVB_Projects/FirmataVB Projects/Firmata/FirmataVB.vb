Imports System
Imports System.ComponentModel
Imports System.Drawing
Imports System.Windows.Forms

' FirmataVB.vb component class. 
' A component that allows .NET programs to communicate with 
' microcontrollers running the Standard Firmata Library
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

'Acknowledgements:
'This code is adapted from the following works:
' Arduino.java - Arduino/Firmata library for Processing
' Copyright (c) 2006-08 David A. Mellis
' http://www.arduino.cc/playground/uploads/Interfacing/Ardiuno.java.txt

'Most constant definitions, values and comments; indications of
'required methods if converted to a class and 'Macros' taken from:
'Firmata.h - Firmata library
'Copyright (c) 2007-2008 Free Software Foundation
'distributed under the GNU Lesser General Public License
'
' And obviously using the Firmata V2.0 Protocol
' http://www.firmata.org
' http://sourceforge.net/projects/firmata
' 
<ToolboxBitmap(GetType(FirmataVB), "FirmataVB.ico")> _
Public Class FirmataVB
    Inherits System.ComponentModel.Component

    'Type of board to connect to
    Public Enum Board
        DUEMILANOVE = 0
        DIECIMILA = 1
        NANO = 2
        MEGA = 3
        LILYPAD = 4
        MINI = 5
        WIRING = 6
        OTHER = 7
    End Enum



    Private total_analog_pins As Integer = 0
    Private total_digital_pins As Integer = 0
    Private total_ports As Integer = 0
    Private analog_port As Integer = 0

    'Version numbers for the protocol
    Public Const FIRMATA_MAJOR_VERSION As Integer = 2   'for non-compatible changes
    Public Const FIRMATA_MINOR_VERSION As Integer = 0   'for backwards compatible changes
    Public Const VERSION_BLINK_PIN As Integer = 13      'digital pin to blink version on

    Public Const MAX_DATA_BYTES As Byte = 32    'Maximum number of data bytes in non-Sysex messages

    'Message command bytes (128-255 / 0x80-0xFF)
    Public Const DIGITAL_MESSAGE As Byte = 144  '0x90 send data for digital pin
    Public Const ANALOG_MESSAGE As Byte = 224   '0xE0 send data for an analog pin (or PWM)
    Public Const REPORT_ANALOG As Byte = 192    '0xC0 enable analog input by pin number
    Public Const REPORT_DIGITAL As Byte = 208   '0xD0 enable digital input by port pair

    Public Const SET_PIN_MODE As Byte = 244     '0xF4 set a pin to INPUT/OUTPUT/ANALOG/PWM/SERVO - 0/1/2/3/4

    Public Const REPORT_VERSION As Byte = 249   '0xF9 report protocol version
    Public Const SYSTEM_RESET As Byte = 255     '0xFF reset from MIDI

    Public Const START_SYSEX As Byte = 240      '0xF0 start a MIDI Sysex message
    Public Const END_SYSEX As Byte = 247        '0xF7 end a MIDI Sysex message

    'Extended command set using Sysex (0-127 / 0x00-0x7F)
    '0x00-0x7F reserved for custom commands
    Public Const SERVO_CONFIG As Byte = 112     '0x70 set maximum angle, minPulse, maxPulse, frequency
    Public Const FIRMATA_STRING As Byte = 113   '0x71 a string message with 14-bits per character
    Public Const REPORT_FIRMWARE As Byte = 121  '0x79 report name and version of the firmware
    Public Const SYSEX_NON_REALTIME As Byte = 126   '0x7E MIDI reserved for non-realtime messages
    Public Const SYSEX_REALTIME As Byte = 127   '0x7F MIDI reserved for realtime messages

    'pin modes
    Public Const INPUT As Integer = 0       '0x00
    Public Const OUTUPT As Integer = 1      '0x01
    Public Const LOW As Integer = 0         '0x00
    Public Const HIGH As Integer = 1        '0x01
    Public Const ANALOG As Byte = 2         '0x02 analog pin in analogInput mode
    Public Const PWM As Byte = 3            '0x03 digital pin in PWM output mode
    Public Const SERVO As Byte = 4          '0x04 digital pin in Servo output mode


    'Own constants
    Public Const DEFAULT_COM_PORT As String = "COM2"    'COM port name that my arduino is usually connected to
    Public Const DEFAULT_BAUD_RATE As String = "115200" 'Baud rate usually used for talking to Arduino running Firmata

    'Variable definitions
    'firmware name and version
    Private firmwareVersionCount As Byte
    Private firmwareVersionVector() As Byte
    'input message handling
    Private waitForData As Integer = 0                  'this flag says the next serial input will be data
    Private executeMultiByteCommand As Integer = 0      'execute this after getting multi-byte data
    Private multiByteChannel As Integer = 0             'channel data for multiByteCommands
    Private storedInputData(MAX_DATA_BYTES) As Integer  'multi-byte data
    'Sysex
    Private parsingSysex As Boolean
    Private sysexBytesRead As Integer

    'Most of above taken from Firmata.h - header file

    'Array of common baud rates
    Private BaudRatesListValues() As String = New String() {"300", "1200", "2400", "4800", "9600", "14400", "19200", _
                                             "28800", "38400", "57600", "115200"}
    Private serialPortConnected As Boolean = False

    Private digitalOutputData() As Integer = {0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0}
    Private digitalInputData() As Integer = {0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0}
    Private analogInputData() As Integer = {0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0}

    Private majorVersion As Integer = 0
    Private minorVersion As Integer = 0

    Private analogReadBuffer() As Byte = {0, 0}
    Private countLoop As Integer = 0
    Private LSB As Integer = 0
    Private MSB As Integer = 0

    Private BoardTypeValue As Board
    Private WithDigitalReceiveEventsValue As Boolean = True
    Private WithAnalogRecieveEventsValue As Boolean = True
    Private WithVersionReceieveEventsValue As Boolean = True

    Private components As System.ComponentModel.IContainer

    Public Sub New(ByVal container As System.ComponentModel.IContainer)
        MyClass.New()

        'Required for Windows.Forms Class Composition Designer support
        If (container IsNot Nothing) Then
            container.Add(Me)
        End If

    End Sub

    Public Sub New()
        MyBase.New()
        'This cal is required by the Component Designer
        InitializeComponent()

    End Sub

    Protected Overrides Sub Dispose(ByVal disposing As Boolean)
        Try
            If disposing AndAlso components IsNot Nothing Then
                components.Dispose()
            End If
        Finally
            MyBase.Dispose(disposing)
        End Try

    End Sub

    Private Sub InitializeComponent()
        Me.components = New System.ComponentModel.Container
        Me.SerialPort1 = New System.IO.Ports.SerialPort(Me.components)

        'SerialPort1
        Me.SerialPort1.PortName = DEFAULT_COM_PORT
        Me.SerialPort1.BaudRate = DEFAULT_BAUD_RATE

    End Sub

    ' Overloaded New constructor that accetps COMPort name, Baud rate and Board type
    <Description("Overloaded New constructor with arguments")> _
    Public Sub New(ByVal COMPort As String, ByVal BaudRate As Integer, Optional ByVal BoardType As Board = Board.DIECIMILA)
        If COMPort <> "" Then
            Me.COMPortName = COMPort
        End If
        If BaudRate <> 0 Then
            Me.Baud = BaudRate
        End If
        Me.BoardType = BoardType
    End Sub


    ' Should a digital receive raise an event?
    <Description("Set this to true if you want the WithDigitalReceiveEventsValue event raised when a Digital Message is received")> _
    Public Property WithDigitalReceiveEvents() As Boolean
        Get
            Return WithDigitalReceiveEventsValue
        End Get
        Set(ByVal value As Boolean)
            WithDigitalReceiveEventsValue = value
        End Set
    End Property

    ' Should an analog receive raise an event?
    <Description("Set this to true if you want the WithAnalogRecieveEventsValue event raised when an Analog Message is received")> _
    Public Property WithAnalogReceiveEvents() As Boolean
        Get
            Return WithAnalogRecieveEventsValue
        End Get
        Set(ByVal value As Boolean)
            WithAnalogRecieveEventsValue = value
        End Set
    End Property

    ' Should a version recieve raise an event?
    <Description("Set this to true if you want the WithVersionReceieveEventsValue event raised when a Version Report message is received")> _
    Public Property WithVersionReceieveEvents() As Boolean
        Get
            Return WithVersionReceieveEventsValue
        End Get
        Set(ByVal value As Boolean)
            WithVersionReceieveEventsValue = value
        End Set
    End Property

    ' Get the COM port name in use
    <Description("Returns the PortName used by the SerialPort component in this class")> _
    Public ReadOnly Property PortName() As String
        Get
            Return SerialPort1.PortName
        End Get
    End Property

    ' Get and Set board type
    <Description("Gets and Sets the Board type the software is going to communicate with")> _
    Public Property BoardType() As Board
        Get
            Return BoardTypeValue
        End Get
        Set(ByVal value As Board)
            BoardTypeValue = value
            Select Case BoardTypeValue
                Case Board.DUEMILANOVE
                    total_analog_pins = 0
                    total_digital_pins = 0
                    total_ports = 0
                    analog_port = 0
                Case Board.DIECIMILA
                    total_analog_pins = 8
                    total_digital_pins = 22
                    total_ports = 3
                    analog_port = 2
                    'Others need to be specified
            End Select
        End Set
    End Property

    ' Is the serial port used in this class open?
    <Description("Returns the current state of the SerialPort used in this class. Open/Closed - True/False")> _
    Public ReadOnly Property PortOpen() As Boolean
        Get
            Return SerialPort1.IsOpen
        End Get
    End Property

    ' Get or set the PortName of the serial port
    <Description("Gets and Sets the PortName of the SerialPort used in this class")> _
    Public Property COMPortName() As String
        Get
            Return SerialPort1.PortName
        End Get
        Set(ByVal value As String)
            If value <> "" Then
                SerialPort1.PortName = value
            End If
        End Set
    End Property

    ' Get or set the Baud rate of the serial port
    <Description("Gets and Sets the Baud rate used by the SerialPort")> _
    Public Property Baud() As Integer
        Get
            Return SerialPort1.BaudRate
        End Get
        Set(ByVal value As Integer)
            If value <> 0 Then
                SerialPort1.BaudRate = value
            End If
        End Set
    End Property

    ' Return string array of available COM port names
    <Description("Returns a string array of available Serial Ports.")> _
    Public Function COMPortList() As String()
        'Returns a list of COM ports
        Return System.IO.Ports.SerialPort.GetPortNames()
    End Function

    ' Return string array of common baud rates
    <Description("Returns a string array of common Baud rates")> _
    Public Function CommonBaudRates() As String()
        Return BaudRatesListValues
    End Function

    ' Returns data for individual Analog pin
    <Description("Returns an analog value for an individual Analog pin")> _
    Public Function AnalogRead(ByVal pin As Integer) As Integer
        Return analogInputData(pin)
    End Function

    ' Returns On/Off data for an individual Digital Pin
    <Description("Retuns On/Off data for an individual Digital Pin")> _
    Public Function DigitalRead(ByVal pin As Integer) As Integer
        Return digitalInputData(pin >> 3) >> (pin And 7) And 1
    End Function

    ' Simple Connect sub - connects to SerialPort using properties set at 
    ' design time
    <Description("Opens the SerialPort with design time properties")> _
    Public Sub Connect()
        Try
            If SerialPort1.IsOpen() Then
                Me.Disconnect()
            End If
            SerialPort1.Open()
        Catch ex As Exception
            MessageBox.Show("Problem opening COM port" & vbCrLf & ex.ToString())
        End Try
    End Sub

    ' Opens the SerialPort with PortName and Baud as passed in arguments
    <Description("Open the SerialPort with given PortName and Baud")> _
    Public Sub Connect(ByVal COMPort As String, ByVal Baud As Integer)
        Try
            If SerialPort1.IsOpen() Then
                Me.Disconnect()
            End If
            Me.COMPortName = COMPort
            Me.Baud = Baud
            SerialPort1.Open()
        Catch ex As Exception
            MessageBox.Show("Problem opening COM port" & vbCrLf & ex.ToString())
        End Try
    End Sub

    ' Close the SerialPort
    <Description("Close the SerialPort")> _
    Public Sub Disconnect()
        Try
            If SerialPort1.IsOpen() Then
                SerialPort1.Close()
            End If
        Catch ex As Exception
            MessageBox.Show("Problem closing COM port" & vbCrLf & ex.ToString())
        End Try
    End Sub

    ' Releases any SerialPort resources
    '<Description("Releases SerialPort resources")> _
    'Private Sub FirmataVB_Disposed(ByVal sender As Object, ByVal e As System.EventArgs) Handles Me.Disposed
    '    If Not SerialPort1 Is Nothing Then
    '        If SerialPort1.IsOpen() Then
    '            SerialPort1.Close()
    '            SerialPort1 = Nothing
    '        Else
    '            SerialPort1 = Nothing
    '        End If
    '    End If
    'End Sub

    ' Send Version report request
    <Description("Semd a vesion report query")> _
    Public Sub QueryVersion()
        Dim sendBuffer() As Byte = {0}
        sendBuffer(0) = REPORT_VERSION
        Try
            SerialPort1.Write(sendBuffer, 0, 1)
        Catch ex As Exception
            MessageBox.Show("Problem sending Version Request" & vbCrLf & ex.ToString())
        End Try
    End Sub

    ' Send Query Firmware Name and Version
    <Description("Send a Firmware Name and Version query")> _
    Public Sub QueryFirmware()
        Dim sendBuffer() As Byte = {0}
        sendBuffer(0) = REPORT_FIRMWARE
        StartSysex()
        Try
            SerialPort1.Write(sendBuffer, 0, 1)
        Catch ex As Exception
            MessageBox.Show("Problem Querying Firmware" & vbCrLf & ex.ToString())
        End Try
        EndSysex()
    End Sub

    ' Send a Start Sysex message
    <Description("Sends a Start Sysex message")> _
    Public Sub StartSysex()
        Dim sendBuffer() As Byte = {0}
        sendBuffer(0) = START_SYSEX
        Try
            SerialPort1.Write(sendBuffer, 0, 1)
        Catch ex As Exception
            MessageBox.Show("Problem sending Start Sysex" & vbCrLf & ex.ToString())
        End Try
    End Sub

    ' Send an End Sysex message
    <Description("Sends an End Sysex message")> _
    Public Sub EndSysex()
        Dim sendBuffer() As Byte = {0}
        sendBuffer(0) = END_SYSEX
        Try
            SerialPort1.Write(sendBuffer, 0, 1)
        Catch ex As Exception
            MessageBox.Show("Problem sending End Sysex" & vbCrLf & ex.ToString())
        End Try
    End Sub

    ' Set an individual pin mode
    <Description("Sends an individual Pin Mode message")> _
    Public Sub PinMode(ByVal pin As Integer, ByVal mode As Integer)
        Dim pinModeMessage() As Byte = {0, 0, 0}
        pinModeMessage(0) = SET_PIN_MODE
        pinModeMessage(1) = pin
        pinModeMessage(2) = mode
        Try
            SerialPort1.Write(pinModeMessage, 0, 3)
        Catch ex As Exception
            MessageBox.Show("Problem sending pinMode message" & vbCrLf & ex.ToString())
        End Try
    End Sub

    ' Sends a message to turn Analog Pin reporting on or off
    <Description("Sends a message to turn Analog Pin reportng on or off for a pin")> _
    Public Sub AnalogPinReport(ByVal pin As Integer, ByVal mode As Integer)
        Dim analogPinReportMessage(1) As Byte
        analogPinReportMessage(0) = REPORT_ANALOG Or pin
        analogPinReportMessage(1) = mode
        Try
            SerialPort1.Write(analogPinReportMessage, 0, 2)
        Catch ex As Exception
            MessageBox.Show("Problem sending analog pin enable/disable message" & vbCrLf & ex.ToString())
        End Try
    End Sub

    ' Turns digital port reporting on or off
    <Description("Sends a message to toggle reporting for a whole digital port")> _
    Public Sub DigitalPortReport(ByVal port As Integer, ByVal onOff As Integer)
        Dim digitalPortReportMessage(1) As Byte
        digitalPortReportMessage(0) = REPORT_DIGITAL Or port
        digitalPortReportMessage(1) = onOff
        Try
            SerialPort1.Write(digitalPortReportMessage, 0, 2)
            'Debug.Print("Digital port report sent: Port: " & digitalPortReportMessage(0) & " OnOff = " & digitalPortReportMessage(1))
        Catch ex As Exception
            MessageBox.Show("Problem sending analog pin enable/disable message" & vbCrLf & ex.ToString())
        End Try
    End Sub

    ' Sends on or off to a pin
    <Description("Sends an On or Off message to an individual Digital Pin")> _
    Public Sub DigitalWrite(ByVal pin As Integer, ByVal value As Integer)
        Dim portNumber As Integer
        portNumber = (pin >> 3) And 15
        Dim adjustment As Integer
        adjustment = (1 << (pin And 7))
        Dim digitalWriteBuffer() As Byte = {0, 0, 0}

        If (value = 0) Then
            digitalOutputData(portNumber) = digitalOutputData(portNumber) And (Not adjustment)
        Else
            digitalOutputData(portNumber) = digitalOutputData(portNumber) Or adjustment
        End If

        digitalWriteBuffer(0) = DIGITAL_MESSAGE Or portNumber
        digitalWriteBuffer(1) = digitalOutputData(portNumber) And 127
        digitalWriteBuffer(2) = digitalOutputData(portNumber) >> 7

        Try
            SerialPort1.Write(digitalWriteBuffer, 0, 3)
        Catch ex As Exception
            MessageBox.Show("Problem with digitalWrite" & vbCrLf & ex.ToString)
        End Try

    End Sub

    ' Sends PWM value to a digital pin
    <Description("Sends a PWM value to a digital pin. 0 - 255")> _
    Public Sub AnalogWrite(ByVal pin As Integer, ByVal value As Integer)
        Dim analogWriteBuffer() As Byte = {0, 0, 0}
        analogWriteBuffer(0) = ANALOG_MESSAGE Or (pin And 15)
        analogWriteBuffer(1) = value And 127
        analogWriteBuffer(2) = (value >> 7) And 127

        Try
            SerialPort1.Write(analogWriteBuffer, 0, 3)
        Catch ex As Exception
            MessageBox.Show("Problem with analogWrite" & vbCrLf & ex.ToString())
        End Try
    End Sub



    ' Stores portData (bit masked On/Off data) for a whole port in 
    ' digitalInputData array
    <Description("Puts but masked On/Off data for a whole digital port into array")> _
    Public Sub SetDigitalInputs(ByVal portNumber As Integer, ByVal portData As Integer)
        digitalInputData(portNumber) = portData
        ' Raise event if property set
        If WithDigitalReceiveEventsValue = True Then
            RaiseEvent DigitalMessageReceieved(portNumber, portData)
        End If
        ' TODO create a way of raising an event and 
        ' sending pin number and on/off without
        ' host form having to poll each pin

    End Sub

    ' Stores analog value data in array for each analog pin
    <Description("Stores analog value data in array")> _
    Public Sub SetAnalogInput(ByVal pin As Integer, ByVal value As Integer)
        analogInputData(pin) = value
        ' Raise event if property set
        If WithAnalogRecieveEventsValue = True Then
            RaiseEvent AnalogMessageReceieved(pin, value)
        End If
    End Sub

    ' Handles SerialPort Datarecieved
    <Description("Handles SerialPort Datareceived event")> _
    Private Sub SerialPort1_DataReceived(ByVal sender As Object, ByVal e As System.IO.Ports.SerialDataReceivedEventArgs) Handles SerialPort1.DataReceived
        'Invoke the procedure to process input

        ProcessInput()

    End Sub

    'Public Sub ProcessSysexMessage()
    'TODO
    'End Sub

    ' Main procedure to process receieved serial data
    <Description("Processes receieved serial data")> _
    Public Sub ProcessInput()
        Do While SerialPort1.BytesToRead > 0
            Dim inputData As Integer
            inputData = CInt(SerialPort1.ReadByte)
            'Debug.Print("Input data: " & inputData)
            Dim command As Integer

            If parsingSysex = True Then
                If (inputData = END_SYSEX) Then
                    'stop sysex byte
                    parsingSysex = False
                    'fire off handler function
                    'ProcessSysexMessage()
                Else
                    'normal data byte - add to buffer
                    storedInputData(sysexBytesRead) = inputData
                    sysexBytesRead = sysexBytesRead + 1
                End If
            ElseIf (waitForData > 0 And inputData < 128) Then
                waitForData = waitForData - 1
                storedInputData(waitForData) = inputData

                If ((waitForData = 0) And executeMultiByteCommand <> 0) Then
                    Select Case executeMultiByteCommand
                        Case ANALOG_MESSAGE
                            SetAnalogInput(multiByteChannel, (storedInputData(0) << 7) + storedInputData(1))
                            'raise event to be consumed by form coding
                        Case DIGITAL_MESSAGE
                            SetDigitalInputs(multiByteChannel, (storedInputData(0) << 7) + storedInputData(1))
                            'Debug.Print("Digital message received")
                        Case SET_PIN_MODE
                            'setPinMode(storedInputData(1), storedInputData(0))
                        Case REPORT_ANALOG
                            'reportAnalog(multiByteChannel, storedInputData(0))
                        Case REPORT_DIGITAL
                            'reportDigital(multiByteChannel, stroedInputData(0)) 
                        Case REPORT_VERSION
                            SetVersion(storedInputData(1), storedInputData(0))
                    End Select
                    executeMultiByteCommand = 0
                End If
            Else
                'remove channel info from command byte if less than 0xF0
                If (inputData < 240) Then
                    command = inputData And 240
                    multiByteChannel = inputData And 15
                Else
                    command = inputData
                End If

                Select Case command
                    Case ANALOG_MESSAGE
                        waitForData = 2
                        executeMultiByteCommand = command
                    Case DIGITAL_MESSAGE
                        waitForData = 2
                        executeMultiByteCommand = command
                    Case SET_PIN_MODE
                        waitForData = 2
                        executeMultiByteCommand = command
                    Case REPORT_ANALOG
                    Case REPORT_DIGITAL
                        waitForData = 1 'two data bytes needed
                        executeMultiByteCommand = command
                    Case START_SYSEX
                        parsingSysex = True
                        sysexBytesRead = 0
                    Case SYSTEM_RESET
                        'systemReset()
                    Case REPORT_VERSION
                        waitForData = 2
                        executeMultiByteCommand = command
                End Select
            End If
        Loop
    End Sub

    ' Stores version number data
    <Description("Stores received version number data")> _
    Public Sub SetVersion(ByVal majorVersion As Integer, ByVal minorVersion As Integer)
        majorVersion = majorVersion
        minorVersion = minorVersion
        If WithVersionReceieveEventsValue = True Then
            RaiseEvent VersionInfoReceieved(majorVersion, minorVersion)
        End If

    End Sub

    Public Event DigitalMessageReceieved(ByVal portNumber As Integer, ByVal portData As Integer)
    Public Event AnalogMessageReceieved(ByVal pin As Integer, ByVal value As Integer)
    Public Event VersionInfoReceieved(ByVal majorVersion As Integer, ByVal minorVersion As Integer)
    Public WithEvents SerialPort1 As System.IO.Ports.SerialPort

    Protected Overrides Sub Finalize()
        MyBase.Finalize()
    End Sub
End Class
