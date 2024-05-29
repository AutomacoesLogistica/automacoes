<Global.Microsoft.VisualBasic.CompilerServices.DesignerGenerated()> _
Partial Class Form1
    Inherits System.Windows.Forms.Form

    'Form overrides dispose to clean up the component list.
    <System.Diagnostics.DebuggerNonUserCode()> _
    Protected Overrides Sub Dispose(ByVal disposing As Boolean)
        Try
            If disposing AndAlso components IsNot Nothing Then
                components.Dispose()
            End If
        Finally
            MyBase.Dispose(disposing)
        End Try
    End Sub

    'Required by the Windows Form Designer
    Private components As System.ComponentModel.IContainer

    'NOTE: The following procedure is required by the Windows Form Designer
    'It can be modified using the Windows Form Designer.  
    'Do not modify it using the code editor.
    <System.Diagnostics.DebuggerStepThrough()> _
    Private Sub InitializeComponent()
        Me.components = New System.ComponentModel.Container
        Dim resources As System.ComponentModel.ComponentResourceManager = New System.ComponentModel.ComponentResourceManager(GetType(Form1))
        Me.FirmataVB1 = New Firmata.FirmataVB(Me.components)
        Me.DigitalPinControl1 = New Firmata.DigitalPinControl
        Me.DigitalPinControl2 = New Firmata.DigitalPinControl
        Me.DigitalPinControl3 = New Firmata.DigitalPinControl
        Me.DigitalPinControl4 = New Firmata.DigitalPinControl
        Me.DigitalPinControl5 = New Firmata.DigitalPinControl
        Me.DigitalPinControl6 = New Firmata.DigitalPinControl
        Me.DigitalPinControl7 = New Firmata.DigitalPinControl
        Me.DigitalPinControl8 = New Firmata.DigitalPinControl
        Me.DigitalPinControl9 = New Firmata.DigitalPinControl
        Me.DigitalPinControl10 = New Firmata.DigitalPinControl
        Me.DigitalPinControl11 = New Firmata.DigitalPinControl
        Me.AnalogPinControl1 = New Firmata.AnalogPinControl
        Me.AnalogPinControl2 = New Firmata.AnalogPinControl
        Me.AnalogPinControl3 = New Firmata.AnalogPinControl
        Me.AnalogPinControl4 = New Firmata.AnalogPinControl
        Me.AnalogPinControl5 = New Firmata.AnalogPinControl
        Me.AnalogPinControl6 = New Firmata.AnalogPinControl
        Me.btnSetAllInputs = New System.Windows.Forms.Button
        Me.cbPort0 = New System.Windows.Forms.CheckBox
        Me.cbPort1 = New System.Windows.Forms.CheckBox
        Me.btnClose = New System.Windows.Forms.Button
        Me.MenuStrip1 = New System.Windows.Forms.MenuStrip
        Me.FileToolStripMenuItem = New System.Windows.Forms.ToolStripMenuItem
        Me.ExitToolStripMenuItem = New System.Windows.Forms.ToolStripMenuItem
        Me.HelpToolStripMenuItem = New System.Windows.Forms.ToolStripMenuItem
        Me.HelpToolStripMenuItem1 = New System.Windows.Forms.ToolStripMenuItem
        Me.AboutToolStripMenuItem = New System.Windows.Forms.ToolStripMenuItem
        Me.ToolStrip1 = New System.Windows.Forms.ToolStrip
        Me.ToolStripLabel1 = New System.Windows.Forms.ToolStripLabel
        Me.ToolStripSeparator1 = New System.Windows.Forms.ToolStripSeparator
        Me.ToolStripLabel2 = New System.Windows.Forms.ToolStripLabel
        Me.tscbCOMList = New System.Windows.Forms.ToolStripComboBox
        Me.ToolStripLabel3 = New System.Windows.Forms.ToolStripLabel
        Me.tscbBaud = New System.Windows.Forms.ToolStripComboBox
        Me.tsbtnConnection = New System.Windows.Forms.ToolStripButton
        Me.tslblStatus = New System.Windows.Forms.ToolStripLabel
        Me.Label1 = New System.Windows.Forms.Label
        Me.Label2 = New System.Windows.Forms.Label
        Me.Label3 = New System.Windows.Forms.Label
        Me.Label4 = New System.Windows.Forms.Label
        Me.Label5 = New System.Windows.Forms.Label
        Me.Label6 = New System.Windows.Forms.Label
        Me.Label7 = New System.Windows.Forms.Label
        Me.Label8 = New System.Windows.Forms.Label
        Me.MenuStrip1.SuspendLayout()
        Me.ToolStrip1.SuspendLayout()
        Me.SuspendLayout()
        '
        'FirmataVB1
        '
        Me.FirmataVB1.Baud = 115200
        Me.FirmataVB1.BoardType = Firmata.FirmataVB.Board.DIECIMILA
        Me.FirmataVB1.COMPortName = "COM4"
        Me.FirmataVB1.WithAnalogReceiveEvents = True
        Me.FirmataVB1.WithDigitalReceiveEvents = True
        Me.FirmataVB1.WithVersionReceieveEvents = True
        '
        'DigitalPinControl1
        '
        Me.DigitalPinControl1.DigitalOutputMode = Firmata.DigitalPinControl.OutputModes.DIGITAL
        Me.DigitalPinControl1.LED = Firmata.DigitalPinControl.LEDStates.LED_DIM
        Me.DigitalPinControl1.Location = New System.Drawing.Point(369, 578)
        Me.DigitalPinControl1.Margin = New System.Windows.Forms.Padding(0)
        Me.DigitalPinControl1.MyPortReporting = False
        Me.DigitalPinControl1.Name = "DigitalPinControl1"
        Me.DigitalPinControl1.PinMode = Firmata.DigitalPinControl.PinModes.INPUT
        Me.DigitalPinControl1.PinNumber = 2
        Me.DigitalPinControl1.Port = 0
        Me.DigitalPinControl1.Size = New System.Drawing.Size(464, 50)
        Me.DigitalPinControl1.TabIndex = 0
        '
        'DigitalPinControl2
        '
        Me.DigitalPinControl2.DigitalOutputMode = Firmata.DigitalPinControl.OutputModes.DIGITAL
        Me.DigitalPinControl2.LED = Firmata.DigitalPinControl.LEDStates.LED_DIM
        Me.DigitalPinControl2.Location = New System.Drawing.Point(369, 528)
        Me.DigitalPinControl2.Margin = New System.Windows.Forms.Padding(0)
        Me.DigitalPinControl2.MyPortReporting = False
        Me.DigitalPinControl2.Name = "DigitalPinControl2"
        Me.DigitalPinControl2.PinMode = Firmata.DigitalPinControl.PinModes.INPUT
        Me.DigitalPinControl2.PinNumber = 3
        Me.DigitalPinControl2.Port = 0
        Me.DigitalPinControl2.Size = New System.Drawing.Size(464, 50)
        Me.DigitalPinControl2.TabIndex = 1
        '
        'DigitalPinControl3
        '
        Me.DigitalPinControl3.DigitalOutputMode = Firmata.DigitalPinControl.OutputModes.DIGITAL
        Me.DigitalPinControl3.LED = Firmata.DigitalPinControl.LEDStates.LED_DIM
        Me.DigitalPinControl3.Location = New System.Drawing.Point(369, 478)
        Me.DigitalPinControl3.Margin = New System.Windows.Forms.Padding(0)
        Me.DigitalPinControl3.MyPortReporting = False
        Me.DigitalPinControl3.Name = "DigitalPinControl3"
        Me.DigitalPinControl3.PinMode = Firmata.DigitalPinControl.PinModes.INPUT
        Me.DigitalPinControl3.PinNumber = 4
        Me.DigitalPinControl3.Port = 0
        Me.DigitalPinControl3.Size = New System.Drawing.Size(464, 50)
        Me.DigitalPinControl3.TabIndex = 2
        '
        'DigitalPinControl4
        '
        Me.DigitalPinControl4.DigitalOutputMode = Firmata.DigitalPinControl.OutputModes.DIGITAL
        Me.DigitalPinControl4.LED = Firmata.DigitalPinControl.LEDStates.LED_DIM
        Me.DigitalPinControl4.Location = New System.Drawing.Point(369, 428)
        Me.DigitalPinControl4.Margin = New System.Windows.Forms.Padding(0)
        Me.DigitalPinControl4.MyPortReporting = False
        Me.DigitalPinControl4.Name = "DigitalPinControl4"
        Me.DigitalPinControl4.PinMode = Firmata.DigitalPinControl.PinModes.INPUT
        Me.DigitalPinControl4.PinNumber = 5
        Me.DigitalPinControl4.Port = 0
        Me.DigitalPinControl4.Size = New System.Drawing.Size(464, 50)
        Me.DigitalPinControl4.TabIndex = 3
        '
        'DigitalPinControl5
        '
        Me.DigitalPinControl5.DigitalOutputMode = Firmata.DigitalPinControl.OutputModes.DIGITAL
        Me.DigitalPinControl5.LED = Firmata.DigitalPinControl.LEDStates.LED_DIM
        Me.DigitalPinControl5.Location = New System.Drawing.Point(369, 378)
        Me.DigitalPinControl5.Margin = New System.Windows.Forms.Padding(0)
        Me.DigitalPinControl5.MyPortReporting = False
        Me.DigitalPinControl5.Name = "DigitalPinControl5"
        Me.DigitalPinControl5.PinMode = Firmata.DigitalPinControl.PinModes.INPUT
        Me.DigitalPinControl5.PinNumber = 6
        Me.DigitalPinControl5.Port = 0
        Me.DigitalPinControl5.Size = New System.Drawing.Size(464, 50)
        Me.DigitalPinControl5.TabIndex = 4
        '
        'DigitalPinControl6
        '
        Me.DigitalPinControl6.DigitalOutputMode = Firmata.DigitalPinControl.OutputModes.DIGITAL
        Me.DigitalPinControl6.LED = Firmata.DigitalPinControl.LEDStates.LED_DIM
        Me.DigitalPinControl6.Location = New System.Drawing.Point(369, 328)
        Me.DigitalPinControl6.Margin = New System.Windows.Forms.Padding(0)
        Me.DigitalPinControl6.MyPortReporting = False
        Me.DigitalPinControl6.Name = "DigitalPinControl6"
        Me.DigitalPinControl6.PinMode = Firmata.DigitalPinControl.PinModes.INPUT
        Me.DigitalPinControl6.PinNumber = 7
        Me.DigitalPinControl6.Port = 0
        Me.DigitalPinControl6.Size = New System.Drawing.Size(464, 50)
        Me.DigitalPinControl6.TabIndex = 5
        '
        'DigitalPinControl7
        '
        Me.DigitalPinControl7.DigitalOutputMode = Firmata.DigitalPinControl.OutputModes.DIGITAL
        Me.DigitalPinControl7.LED = Firmata.DigitalPinControl.LEDStates.LED_DIM
        Me.DigitalPinControl7.Location = New System.Drawing.Point(369, 278)
        Me.DigitalPinControl7.Margin = New System.Windows.Forms.Padding(0)
        Me.DigitalPinControl7.MyPortReporting = False
        Me.DigitalPinControl7.Name = "DigitalPinControl7"
        Me.DigitalPinControl7.PinMode = Firmata.DigitalPinControl.PinModes.INPUT
        Me.DigitalPinControl7.PinNumber = 8
        Me.DigitalPinControl7.Port = 1
        Me.DigitalPinControl7.Size = New System.Drawing.Size(464, 50)
        Me.DigitalPinControl7.TabIndex = 6
        '
        'DigitalPinControl8
        '
        Me.DigitalPinControl8.DigitalOutputMode = Firmata.DigitalPinControl.OutputModes.DIGITAL
        Me.DigitalPinControl8.LED = Firmata.DigitalPinControl.LEDStates.LED_DIM
        Me.DigitalPinControl8.Location = New System.Drawing.Point(369, 228)
        Me.DigitalPinControl8.Margin = New System.Windows.Forms.Padding(0)
        Me.DigitalPinControl8.MyPortReporting = False
        Me.DigitalPinControl8.Name = "DigitalPinControl8"
        Me.DigitalPinControl8.PinMode = Firmata.DigitalPinControl.PinModes.INPUT
        Me.DigitalPinControl8.PinNumber = 9
        Me.DigitalPinControl8.Port = 1
        Me.DigitalPinControl8.Size = New System.Drawing.Size(464, 50)
        Me.DigitalPinControl8.TabIndex = 7
        '
        'DigitalPinControl9
        '
        Me.DigitalPinControl9.DigitalOutputMode = Firmata.DigitalPinControl.OutputModes.DIGITAL
        Me.DigitalPinControl9.LED = Firmata.DigitalPinControl.LEDStates.LED_DIM
        Me.DigitalPinControl9.Location = New System.Drawing.Point(369, 178)
        Me.DigitalPinControl9.Margin = New System.Windows.Forms.Padding(0)
        Me.DigitalPinControl9.MyPortReporting = False
        Me.DigitalPinControl9.Name = "DigitalPinControl9"
        Me.DigitalPinControl9.PinMode = Firmata.DigitalPinControl.PinModes.INPUT
        Me.DigitalPinControl9.PinNumber = 10
        Me.DigitalPinControl9.Port = 1
        Me.DigitalPinControl9.Size = New System.Drawing.Size(464, 50)
        Me.DigitalPinControl9.TabIndex = 8
        '
        'DigitalPinControl10
        '
        Me.DigitalPinControl10.DigitalOutputMode = Firmata.DigitalPinControl.OutputModes.DIGITAL
        Me.DigitalPinControl10.LED = Firmata.DigitalPinControl.LEDStates.LED_DIM
        Me.DigitalPinControl10.Location = New System.Drawing.Point(369, 128)
        Me.DigitalPinControl10.Margin = New System.Windows.Forms.Padding(0)
        Me.DigitalPinControl10.MyPortReporting = False
        Me.DigitalPinControl10.Name = "DigitalPinControl10"
        Me.DigitalPinControl10.PinMode = Firmata.DigitalPinControl.PinModes.INPUT
        Me.DigitalPinControl10.PinNumber = 11
        Me.DigitalPinControl10.Port = 1
        Me.DigitalPinControl10.Size = New System.Drawing.Size(464, 50)
        Me.DigitalPinControl10.TabIndex = 9
        '
        'DigitalPinControl11
        '
        Me.DigitalPinControl11.DigitalOutputMode = Firmata.DigitalPinControl.OutputModes.DIGITAL
        Me.DigitalPinControl11.LED = Firmata.DigitalPinControl.LEDStates.LED_DIM
        Me.DigitalPinControl11.Location = New System.Drawing.Point(369, 78)
        Me.DigitalPinControl11.Margin = New System.Windows.Forms.Padding(0)
        Me.DigitalPinControl11.MyPortReporting = False
        Me.DigitalPinControl11.Name = "DigitalPinControl11"
        Me.DigitalPinControl11.PinMode = Firmata.DigitalPinControl.PinModes.INPUT
        Me.DigitalPinControl11.PinNumber = 12
        Me.DigitalPinControl11.Port = 1
        Me.DigitalPinControl11.Size = New System.Drawing.Size(464, 50)
        Me.DigitalPinControl11.TabIndex = 10
        '
        'AnalogPinControl1
        '
        Me.AnalogPinControl1.AnalogValue = 0
        Me.AnalogPinControl1.ClearValues = False
        Me.AnalogPinControl1.HideWhenOff = False
        Me.AnalogPinControl1.Location = New System.Drawing.Point(12, 594)
        Me.AnalogPinControl1.Name = "AnalogPinControl1"
        Me.AnalogPinControl1.PinNumber = 0
        Me.AnalogPinControl1.Size = New System.Drawing.Size(203, 34)
        Me.AnalogPinControl1.TabIndex = 11
        '
        'AnalogPinControl2
        '
        Me.AnalogPinControl2.AnalogValue = 0
        Me.AnalogPinControl2.ClearValues = False
        Me.AnalogPinControl2.HideWhenOff = False
        Me.AnalogPinControl2.Location = New System.Drawing.Point(12, 554)
        Me.AnalogPinControl2.Name = "AnalogPinControl2"
        Me.AnalogPinControl2.PinNumber = 1
        Me.AnalogPinControl2.Size = New System.Drawing.Size(203, 34)
        Me.AnalogPinControl2.TabIndex = 12
        '
        'AnalogPinControl3
        '
        Me.AnalogPinControl3.AnalogValue = 0
        Me.AnalogPinControl3.ClearValues = False
        Me.AnalogPinControl3.HideWhenOff = False
        Me.AnalogPinControl3.Location = New System.Drawing.Point(12, 514)
        Me.AnalogPinControl3.Name = "AnalogPinControl3"
        Me.AnalogPinControl3.PinNumber = 2
        Me.AnalogPinControl3.Size = New System.Drawing.Size(203, 34)
        Me.AnalogPinControl3.TabIndex = 13
        '
        'AnalogPinControl4
        '
        Me.AnalogPinControl4.AnalogValue = 0
        Me.AnalogPinControl4.ClearValues = False
        Me.AnalogPinControl4.HideWhenOff = False
        Me.AnalogPinControl4.Location = New System.Drawing.Point(12, 474)
        Me.AnalogPinControl4.Name = "AnalogPinControl4"
        Me.AnalogPinControl4.PinNumber = 3
        Me.AnalogPinControl4.Size = New System.Drawing.Size(203, 34)
        Me.AnalogPinControl4.TabIndex = 14
        '
        'AnalogPinControl5
        '
        Me.AnalogPinControl5.AnalogValue = 0
        Me.AnalogPinControl5.ClearValues = False
        Me.AnalogPinControl5.HideWhenOff = False
        Me.AnalogPinControl5.Location = New System.Drawing.Point(12, 434)
        Me.AnalogPinControl5.Name = "AnalogPinControl5"
        Me.AnalogPinControl5.PinNumber = 4
        Me.AnalogPinControl5.Size = New System.Drawing.Size(203, 34)
        Me.AnalogPinControl5.TabIndex = 15
        '
        'AnalogPinControl6
        '
        Me.AnalogPinControl6.AnalogValue = 0
        Me.AnalogPinControl6.ClearValues = False
        Me.AnalogPinControl6.HideWhenOff = False
        Me.AnalogPinControl6.Location = New System.Drawing.Point(12, 394)
        Me.AnalogPinControl6.Name = "AnalogPinControl6"
        Me.AnalogPinControl6.PinNumber = 5
        Me.AnalogPinControl6.Size = New System.Drawing.Size(203, 34)
        Me.AnalogPinControl6.TabIndex = 16
        '
        'btnSetAllInputs
        '
        Me.btnSetAllInputs.Location = New System.Drawing.Point(369, 631)
        Me.btnSetAllInputs.Name = "btnSetAllInputs"
        Me.btnSetAllInputs.Size = New System.Drawing.Size(162, 23)
        Me.btnSetAllInputs.TabIndex = 17
        Me.btnSetAllInputs.Text = "Set all digital pins to inputs"
        Me.btnSetAllInputs.UseVisualStyleBackColor = True
        '
        'cbPort0
        '
        Me.cbPort0.Appearance = System.Windows.Forms.Appearance.Button
        Me.cbPort0.AutoSize = True
        Me.cbPort0.Location = New System.Drawing.Point(293, 341)
        Me.cbPort0.Name = "cbPort0"
        Me.cbPort0.Size = New System.Drawing.Size(31, 23)
        Me.cbPort0.TabIndex = 18
        Me.cbPort0.Text = "Off"
        Me.cbPort0.UseVisualStyleBackColor = True
        '
        'cbPort1
        '
        Me.cbPort1.Appearance = System.Windows.Forms.Appearance.Button
        Me.cbPort1.AutoSize = True
        Me.cbPort1.Location = New System.Drawing.Point(293, 88)
        Me.cbPort1.Name = "cbPort1"
        Me.cbPort1.Size = New System.Drawing.Size(31, 23)
        Me.cbPort1.TabIndex = 19
        Me.cbPort1.Tag = "1"
        Me.cbPort1.Text = "Off"
        Me.cbPort1.UseVisualStyleBackColor = True
        '
        'btnClose
        '
        Me.btnClose.Location = New System.Drawing.Point(755, 631)
        Me.btnClose.Name = "btnClose"
        Me.btnClose.Size = New System.Drawing.Size(75, 23)
        Me.btnClose.TabIndex = 20
        Me.btnClose.Text = "Close"
        Me.btnClose.UseVisualStyleBackColor = True
        '
        'MenuStrip1
        '
        Me.MenuStrip1.Items.AddRange(New System.Windows.Forms.ToolStripItem() {Me.FileToolStripMenuItem, Me.HelpToolStripMenuItem})
        Me.MenuStrip1.Location = New System.Drawing.Point(0, 0)
        Me.MenuStrip1.Name = "MenuStrip1"
        Me.MenuStrip1.Size = New System.Drawing.Size(842, 24)
        Me.MenuStrip1.TabIndex = 21
        Me.MenuStrip1.Text = "MenuStrip1"
        '
        'FileToolStripMenuItem
        '
        Me.FileToolStripMenuItem.DropDownItems.AddRange(New System.Windows.Forms.ToolStripItem() {Me.ExitToolStripMenuItem})
        Me.FileToolStripMenuItem.Name = "FileToolStripMenuItem"
        Me.FileToolStripMenuItem.Size = New System.Drawing.Size(35, 20)
        Me.FileToolStripMenuItem.Text = "File"
        '
        'ExitToolStripMenuItem
        '
        Me.ExitToolStripMenuItem.Name = "ExitToolStripMenuItem"
        Me.ExitToolStripMenuItem.Size = New System.Drawing.Size(103, 22)
        Me.ExitToolStripMenuItem.Text = "Exit"
        '
        'HelpToolStripMenuItem
        '
        Me.HelpToolStripMenuItem.DropDownItems.AddRange(New System.Windows.Forms.ToolStripItem() {Me.HelpToolStripMenuItem1, Me.AboutToolStripMenuItem})
        Me.HelpToolStripMenuItem.Name = "HelpToolStripMenuItem"
        Me.HelpToolStripMenuItem.Size = New System.Drawing.Size(40, 20)
        Me.HelpToolStripMenuItem.Text = "Help"
        '
        'HelpToolStripMenuItem1
        '
        Me.HelpToolStripMenuItem1.Name = "HelpToolStripMenuItem1"
        Me.HelpToolStripMenuItem1.Size = New System.Drawing.Size(114, 22)
        Me.HelpToolStripMenuItem1.Text = "Help"
        '
        'AboutToolStripMenuItem
        '
        Me.AboutToolStripMenuItem.Name = "AboutToolStripMenuItem"
        Me.AboutToolStripMenuItem.Size = New System.Drawing.Size(114, 22)
        Me.AboutToolStripMenuItem.Text = "About"
        '
        'ToolStrip1
        '
        Me.ToolStrip1.Items.AddRange(New System.Windows.Forms.ToolStripItem() {Me.ToolStripLabel1, Me.ToolStripSeparator1, Me.ToolStripLabel2, Me.tscbCOMList, Me.ToolStripLabel3, Me.tscbBaud, Me.tsbtnConnection, Me.tslblStatus})
        Me.ToolStrip1.Location = New System.Drawing.Point(0, 24)
        Me.ToolStrip1.Name = "ToolStrip1"
        Me.ToolStrip1.Size = New System.Drawing.Size(842, 25)
        Me.ToolStrip1.TabIndex = 22
        Me.ToolStrip1.Text = "ToolStrip1"
        '
        'ToolStripLabel1
        '
        Me.ToolStripLabel1.Name = "ToolStripLabel1"
        Me.ToolStripLabel1.Size = New System.Drawing.Size(96, 22)
        Me.ToolStripLabel1.Text = "Board Connection:"
        '
        'ToolStripSeparator1
        '
        Me.ToolStripSeparator1.Name = "ToolStripSeparator1"
        Me.ToolStripSeparator1.Size = New System.Drawing.Size(6, 25)
        '
        'ToolStripLabel2
        '
        Me.ToolStripLabel2.Name = "ToolStripLabel2"
        Me.ToolStripLabel2.Size = New System.Drawing.Size(57, 22)
        Me.ToolStripLabel2.Text = "COM Port:"
        '
        'tscbCOMList
        '
        Me.tscbCOMList.Name = "tscbCOMList"
        Me.tscbCOMList.Size = New System.Drawing.Size(121, 25)
        '
        'ToolStripLabel3
        '
        Me.ToolStripLabel3.Name = "ToolStripLabel3"
        Me.ToolStripLabel3.Size = New System.Drawing.Size(61, 22)
        Me.ToolStripLabel3.Text = "Baud Rate:"
        '
        'tscbBaud
        '
        Me.tscbBaud.Name = "tscbBaud"
        Me.tscbBaud.Size = New System.Drawing.Size(121, 25)
        '
        'tsbtnConnection
        '
        Me.tsbtnConnection.DisplayStyle = System.Windows.Forms.ToolStripItemDisplayStyle.Text
        Me.tsbtnConnection.Image = CType(resources.GetObject("tsbtnConnection.Image"), System.Drawing.Image)
        Me.tsbtnConnection.ImageTransparentColor = System.Drawing.Color.Magenta
        Me.tsbtnConnection.Name = "tsbtnConnection"
        Me.tsbtnConnection.Size = New System.Drawing.Size(51, 22)
        Me.tsbtnConnection.Text = "Connect"
        '
        'tslblStatus
        '
        Me.tslblStatus.Name = "tslblStatus"
        Me.tslblStatus.Size = New System.Drawing.Size(104, 22)
        Me.tslblStatus.Text = "No board connected"
        '
        'Label1
        '
        Me.Label1.AutoSize = True
        Me.Label1.Font = New System.Drawing.Font("Microsoft Sans Serif", 10.0!, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.Label1.Location = New System.Drawing.Point(53, 361)
        Me.Label1.Name = "Label1"
        Me.Label1.Size = New System.Drawing.Size(94, 17)
        Me.Label1.TabIndex = 23
        Me.Label1.Text = "Analog Pins"
        '
        'Label2
        '
        Me.Label2.AutoSize = True
        Me.Label2.Font = New System.Drawing.Font("Microsoft Sans Serif", 10.0!, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.Label2.Location = New System.Drawing.Point(595, 61)
        Me.Label2.Name = "Label2"
        Me.Label2.Size = New System.Drawing.Size(90, 17)
        Me.Label2.TabIndex = 24
        Me.Label2.Text = "Digital Pins"
        '
        'Label3
        '
        Me.Label3.AutoSize = True
        Me.Label3.Location = New System.Drawing.Point(290, 63)
        Me.Label3.Name = "Label3"
        Me.Label3.Size = New System.Drawing.Size(75, 13)
        Me.Label3.TabIndex = 25
        Me.Label3.Text = "Port Reporting"
        '
        'Label4
        '
        Me.Label4.AutoSize = True
        Me.Label4.Location = New System.Drawing.Point(413, 63)
        Me.Label4.Name = "Label4"
        Me.Label4.Size = New System.Drawing.Size(31, 13)
        Me.Label4.TabIndex = 26
        Me.Label4.Text = "Input"
        '
        'Label5
        '
        Me.Label5.AutoSize = True
        Me.Label5.Location = New System.Drawing.Point(463, 63)
        Me.Label5.Name = "Label5"
        Me.Label5.Size = New System.Drawing.Size(39, 13)
        Me.Label5.TabIndex = 27
        Me.Label5.Text = "Output"
        '
        'Label6
        '
        Me.Label6.AutoSize = True
        Me.Label6.Font = New System.Drawing.Font("Microsoft Sans Serif", 16.0!, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.Label6.Location = New System.Drawing.Point(11, 65)
        Me.Label6.Name = "Label6"
        Me.Label6.Size = New System.Drawing.Size(108, 26)
        Me.Label6.TabIndex = 28
        Me.Label6.Text = "Arduino>"
        '
        'Label7
        '
        Me.Label7.AutoSize = True
        Me.Label7.Font = New System.Drawing.Font("Microsoft Sans Serif", 16.0!, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.Label7.Location = New System.Drawing.Point(51, 89)
        Me.Label7.Name = "Label7"
        Me.Label7.Size = New System.Drawing.Size(121, 26)
        Me.Label7.TabIndex = 29
        Me.Label7.Text = "<Firmata>"
        '
        'Label8
        '
        Me.Label8.AutoSize = True
        Me.Label8.Font = New System.Drawing.Font("Microsoft Sans Serif", 16.0!, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.Label8.Location = New System.Drawing.Point(102, 116)
        Me.Label8.Name = "Label8"
        Me.Label8.Size = New System.Drawing.Size(111, 26)
        Me.Label8.TabIndex = 30
        Me.Label8.Text = "<VB.NET"
        '
        'Form1
        '
        Me.AutoScaleDimensions = New System.Drawing.SizeF(6.0!, 13.0!)
        Me.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font
        Me.ClientSize = New System.Drawing.Size(842, 666)
        Me.Controls.Add(Me.Label8)
        Me.Controls.Add(Me.Label7)
        Me.Controls.Add(Me.Label6)
        Me.Controls.Add(Me.Label5)
        Me.Controls.Add(Me.Label4)
        Me.Controls.Add(Me.Label3)
        Me.Controls.Add(Me.Label2)
        Me.Controls.Add(Me.Label1)
        Me.Controls.Add(Me.ToolStrip1)
        Me.Controls.Add(Me.btnClose)
        Me.Controls.Add(Me.cbPort1)
        Me.Controls.Add(Me.cbPort0)
        Me.Controls.Add(Me.btnSetAllInputs)
        Me.Controls.Add(Me.AnalogPinControl6)
        Me.Controls.Add(Me.AnalogPinControl5)
        Me.Controls.Add(Me.AnalogPinControl4)
        Me.Controls.Add(Me.AnalogPinControl3)
        Me.Controls.Add(Me.AnalogPinControl2)
        Me.Controls.Add(Me.AnalogPinControl1)
        Me.Controls.Add(Me.DigitalPinControl11)
        Me.Controls.Add(Me.DigitalPinControl10)
        Me.Controls.Add(Me.DigitalPinControl9)
        Me.Controls.Add(Me.DigitalPinControl8)
        Me.Controls.Add(Me.DigitalPinControl7)
        Me.Controls.Add(Me.DigitalPinControl6)
        Me.Controls.Add(Me.DigitalPinControl5)
        Me.Controls.Add(Me.DigitalPinControl4)
        Me.Controls.Add(Me.DigitalPinControl3)
        Me.Controls.Add(Me.DigitalPinControl2)
        Me.Controls.Add(Me.DigitalPinControl1)
        Me.Controls.Add(Me.MenuStrip1)
        Me.MainMenuStrip = Me.MenuStrip1
        Me.Name = "Form1"
        Me.Text = "Arduino <> Firmata <> VB.NET"
        Me.MenuStrip1.ResumeLayout(False)
        Me.MenuStrip1.PerformLayout()
        Me.ToolStrip1.ResumeLayout(False)
        Me.ToolStrip1.PerformLayout()
        Me.ResumeLayout(False)
        Me.PerformLayout()

    End Sub
    Friend WithEvents FirmataVB1 As Firmata.FirmataVB
    Friend WithEvents DigitalPinControl1 As Firmata.DigitalPinControl
    Friend WithEvents DigitalPinControl2 As Firmata.DigitalPinControl
    Friend WithEvents DigitalPinControl3 As Firmata.DigitalPinControl
    Friend WithEvents DigitalPinControl4 As Firmata.DigitalPinControl
    Friend WithEvents DigitalPinControl5 As Firmata.DigitalPinControl
    Friend WithEvents DigitalPinControl6 As Firmata.DigitalPinControl
    Friend WithEvents DigitalPinControl7 As Firmata.DigitalPinControl
    Friend WithEvents DigitalPinControl8 As Firmata.DigitalPinControl
    Friend WithEvents DigitalPinControl9 As Firmata.DigitalPinControl
    Friend WithEvents DigitalPinControl10 As Firmata.DigitalPinControl
    Friend WithEvents DigitalPinControl11 As Firmata.DigitalPinControl
    Friend WithEvents AnalogPinControl1 As Firmata.AnalogPinControl
    Friend WithEvents AnalogPinControl2 As Firmata.AnalogPinControl
    Friend WithEvents AnalogPinControl3 As Firmata.AnalogPinControl
    Friend WithEvents AnalogPinControl4 As Firmata.AnalogPinControl
    Friend WithEvents AnalogPinControl5 As Firmata.AnalogPinControl
    Friend WithEvents AnalogPinControl6 As Firmata.AnalogPinControl
    Friend WithEvents btnSetAllInputs As System.Windows.Forms.Button
    Friend WithEvents cbPort0 As System.Windows.Forms.CheckBox
    Friend WithEvents cbPort1 As System.Windows.Forms.CheckBox
    Friend WithEvents btnClose As System.Windows.Forms.Button
    Friend WithEvents MenuStrip1 As System.Windows.Forms.MenuStrip
    Friend WithEvents FileToolStripMenuItem As System.Windows.Forms.ToolStripMenuItem
    Friend WithEvents ExitToolStripMenuItem As System.Windows.Forms.ToolStripMenuItem
    Friend WithEvents HelpToolStripMenuItem As System.Windows.Forms.ToolStripMenuItem
    Friend WithEvents HelpToolStripMenuItem1 As System.Windows.Forms.ToolStripMenuItem
    Friend WithEvents AboutToolStripMenuItem As System.Windows.Forms.ToolStripMenuItem
    Friend WithEvents ToolStrip1 As System.Windows.Forms.ToolStrip
    Friend WithEvents ToolStripLabel1 As System.Windows.Forms.ToolStripLabel
    Friend WithEvents ToolStripSeparator1 As System.Windows.Forms.ToolStripSeparator
    Friend WithEvents ToolStripLabel2 As System.Windows.Forms.ToolStripLabel
    Friend WithEvents tscbCOMList As System.Windows.Forms.ToolStripComboBox
    Friend WithEvents ToolStripLabel3 As System.Windows.Forms.ToolStripLabel
    Friend WithEvents tscbBaud As System.Windows.Forms.ToolStripComboBox
    Friend WithEvents tsbtnConnection As System.Windows.Forms.ToolStripButton
    Friend WithEvents tslblStatus As System.Windows.Forms.ToolStripLabel
    Friend WithEvents Label1 As System.Windows.Forms.Label
    Friend WithEvents Label2 As System.Windows.Forms.Label
    Friend WithEvents Label3 As System.Windows.Forms.Label
    Friend WithEvents Label4 As System.Windows.Forms.Label
    Friend WithEvents Label5 As System.Windows.Forms.Label
    Friend WithEvents Label6 As System.Windows.Forms.Label
    Friend WithEvents Label7 As System.Windows.Forms.Label
    Friend WithEvents Label8 As System.Windows.Forms.Label

End Class
