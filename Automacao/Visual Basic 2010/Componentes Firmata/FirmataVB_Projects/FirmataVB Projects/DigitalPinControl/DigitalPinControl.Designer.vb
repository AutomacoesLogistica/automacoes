<Global.Microsoft.VisualBasic.CompilerServices.DesignerGenerated()> _
Partial Class DigitalPinControl
    Inherits System.Windows.Forms.UserControl

    'UserControl1 overrides dispose to clean up the component list.
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
        Me.rbOutDigi = New System.Windows.Forms.RadioButton
        Me.rbOutPWM = New System.Windows.Forms.RadioButton
        Me.tbInOut = New System.Windows.Forms.TrackBar
        Me.cbOnOff = New System.Windows.Forms.CheckBox
        Me.tbPWM = New System.Windows.Forms.TrackBar
        Me.pbLED = New System.Windows.Forms.PictureBox
        Me.lblPinNumber = New System.Windows.Forms.Label
        Me.ToolTip1 = New System.Windows.Forms.ToolTip(Me.components)
        CType(Me.tbInOut, System.ComponentModel.ISupportInitialize).BeginInit()
        CType(Me.tbPWM, System.ComponentModel.ISupportInitialize).BeginInit()
        CType(Me.pbLED, System.ComponentModel.ISupportInitialize).BeginInit()
        Me.SuspendLayout()
        '
        'rbOutDigi
        '
        Me.rbOutDigi.AutoSize = True
        Me.rbOutDigi.Location = New System.Drawing.Point(114, 15)
        Me.rbOutDigi.Name = "rbOutDigi"
        Me.rbOutDigi.Size = New System.Drawing.Size(54, 17)
        Me.rbOutDigi.TabIndex = 1
        Me.rbOutDigi.Text = "Digital"
        Me.ToolTip1.SetToolTip(Me.rbOutDigi, "Selects digital output On (1) / Off (0)")
        Me.rbOutDigi.UseVisualStyleBackColor = True
        '
        'rbOutPWM
        '
        Me.rbOutPWM.AutoSize = True
        Me.rbOutPWM.Location = New System.Drawing.Point(210, 15)
        Me.rbOutPWM.Name = "rbOutPWM"
        Me.rbOutPWM.Size = New System.Drawing.Size(52, 17)
        Me.rbOutPWM.TabIndex = 2
        Me.rbOutPWM.Text = "PWM"
        Me.ToolTip1.SetToolTip(Me.rbOutPWM, "Selects PWM output 0 - 255")
        Me.rbOutPWM.UseVisualStyleBackColor = True
        '
        'tbInOut
        '
        Me.tbInOut.LargeChange = 1
        Me.tbInOut.Location = New System.Drawing.Point(58, 1)
        Me.tbInOut.Maximum = 1
        Me.tbInOut.Name = "tbInOut"
        Me.tbInOut.Size = New System.Drawing.Size(56, 45)
        Me.tbInOut.TabIndex = 3
        Me.tbInOut.TickStyle = System.Windows.Forms.TickStyle.Both
        Me.ToolTip1.SetToolTip(Me.tbInOut, "Move to change pin from Input (left) to Output (right)")
        '
        'cbOnOff
        '
        Me.cbOnOff.Appearance = System.Windows.Forms.Appearance.Button
        Me.cbOnOff.AutoSize = True
        Me.cbOnOff.Enabled = False
        Me.cbOnOff.Location = New System.Drawing.Point(167, 12)
        Me.cbOnOff.Name = "cbOnOff"
        Me.cbOnOff.Size = New System.Drawing.Size(31, 23)
        Me.cbOnOff.TabIndex = 4
        Me.cbOnOff.Text = "Off"
        Me.ToolTip1.SetToolTip(Me.cbOnOff, "Click to send digital message to pin On (1) / Off (0)")
        Me.cbOnOff.UseVisualStyleBackColor = True
        '
        'tbPWM
        '
        Me.tbPWM.Enabled = False
        Me.tbPWM.Location = New System.Drawing.Point(258, 11)
        Me.tbPWM.Margin = New System.Windows.Forms.Padding(0)
        Me.tbPWM.Maximum = 255
        Me.tbPWM.Name = "tbPWM"
        Me.tbPWM.Size = New System.Drawing.Size(206, 45)
        Me.tbPWM.TabIndex = 5
        Me.tbPWM.TickFrequency = 10
        Me.ToolTip1.SetToolTip(Me.tbPWM, "Drag to send PWM value to pin 0 - 255")
        '
        'pbLED
        '
        Me.pbLED.Image = My.Resources.Resources.LEDDim
        Me.pbLED.InitialImage = Nothing
        Me.pbLED.Location = New System.Drawing.Point(30, 10)
        Me.pbLED.Margin = New System.Windows.Forms.Padding(0)
        Me.pbLED.Name = "pbLED"
        Me.pbLED.Size = New System.Drawing.Size(26, 26)
        Me.pbLED.TabIndex = 6
        Me.pbLED.TabStop = False
        Me.ToolTip1.SetToolTip(Me.pbLED, "LED shows digital input")
        '
        'lblPinNumber
        '
        Me.lblPinNumber.AutoSize = True
        Me.lblPinNumber.Font = New System.Drawing.Font("Microsoft Sans Serif", 10.0!, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.lblPinNumber.Location = New System.Drawing.Point(2, 15)
        Me.lblPinNumber.Margin = New System.Windows.Forms.Padding(0)
        Me.lblPinNumber.Name = "lblPinNumber"
        Me.lblPinNumber.Size = New System.Drawing.Size(26, 17)
        Me.lblPinNumber.TabIndex = 7
        Me.lblPinNumber.Text = "12"
        Me.lblPinNumber.TextAlign = System.Drawing.ContentAlignment.MiddleLeft
        '
        'DigitalControl
        '
        Me.AutoScaleDimensions = New System.Drawing.SizeF(6.0!, 13.0!)
        Me.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font
        Me.Controls.Add(Me.lblPinNumber)
        Me.Controls.Add(Me.pbLED)
        Me.Controls.Add(Me.tbPWM)
        Me.Controls.Add(Me.cbOnOff)
        Me.Controls.Add(Me.tbInOut)
        Me.Controls.Add(Me.rbOutPWM)
        Me.Controls.Add(Me.rbOutDigi)
        Me.Margin = New System.Windows.Forms.Padding(0)
        Me.Name = "DigitalControl"
        Me.Size = New System.Drawing.Size(464, 50)
        CType(Me.tbInOut, System.ComponentModel.ISupportInitialize).EndInit()
        CType(Me.tbPWM, System.ComponentModel.ISupportInitialize).EndInit()
        CType(Me.pbLED, System.ComponentModel.ISupportInitialize).EndInit()
        Me.ResumeLayout(False)
        Me.PerformLayout()

    End Sub
    Friend WithEvents rbOutDigi As System.Windows.Forms.RadioButton
    Friend WithEvents rbOutPWM As System.Windows.Forms.RadioButton
    Friend WithEvents tbInOut As System.Windows.Forms.TrackBar
    Friend WithEvents cbOnOff As System.Windows.Forms.CheckBox
    Friend WithEvents tbPWM As System.Windows.Forms.TrackBar
    Friend WithEvents pbLED As System.Windows.Forms.PictureBox
    Friend WithEvents lblPinNumber As System.Windows.Forms.Label
    Friend WithEvents ToolTip1 As System.Windows.Forms.ToolTip

End Class