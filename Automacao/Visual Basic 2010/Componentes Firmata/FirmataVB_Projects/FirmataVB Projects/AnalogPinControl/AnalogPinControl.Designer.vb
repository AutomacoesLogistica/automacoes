<Global.Microsoft.VisualBasic.CompilerServices.DesignerGenerated()> _
Partial Class AnalogPinControl
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
        Me.lblPinNumber = New System.Windows.Forms.Label
        Me.cbOnOff = New System.Windows.Forms.CheckBox
        Me.lblPWMValue = New System.Windows.Forms.Label
        Me.pbPWMValue = New System.Windows.Forms.ProgressBar
        Me.SuspendLayout()
        '
        'lblPinNumber
        '
        Me.lblPinNumber.AutoSize = True
        Me.lblPinNumber.Font = New System.Drawing.Font("Microsoft Sans Serif", 10.0!, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.lblPinNumber.Location = New System.Drawing.Point(177, 8)
        Me.lblPinNumber.Margin = New System.Windows.Forms.Padding(0)
        Me.lblPinNumber.Name = "lblPinNumber"
        Me.lblPinNumber.Size = New System.Drawing.Size(26, 17)
        Me.lblPinNumber.TabIndex = 0
        Me.lblPinNumber.Text = "24"
        Me.lblPinNumber.TextAlign = System.Drawing.ContentAlignment.MiddleCenter
        '
        'cbOnOff
        '
        Me.cbOnOff.Appearance = System.Windows.Forms.Appearance.Button
        Me.cbOnOff.AutoSize = True
        Me.cbOnOff.Location = New System.Drawing.Point(143, 5)
        Me.cbOnOff.Name = "cbOnOff"
        Me.cbOnOff.Size = New System.Drawing.Size(31, 23)
        Me.cbOnOff.TabIndex = 1
        Me.cbOnOff.Text = "Off"
        Me.cbOnOff.UseVisualStyleBackColor = True
        '
        'lblPWMValue
        '
        Me.lblPWMValue.AutoSize = True
        Me.lblPWMValue.Enabled = False
        Me.lblPWMValue.Location = New System.Drawing.Point(108, 10)
        Me.lblPWMValue.Name = "lblPWMValue"
        Me.lblPWMValue.Size = New System.Drawing.Size(31, 13)
        Me.lblPWMValue.TabIndex = 2
        Me.lblPWMValue.Text = "0000"
        Me.lblPWMValue.TextAlign = System.Drawing.ContentAlignment.MiddleCenter
        '
        'pbPWMValue
        '
        Me.pbPWMValue.Enabled = False
        Me.pbPWMValue.Location = New System.Drawing.Point(3, 5)
        Me.pbPWMValue.Margin = New System.Windows.Forms.Padding(0)
        Me.pbPWMValue.Maximum = 1023
        Me.pbPWMValue.Name = "pbPWMValue"
        Me.pbPWMValue.Size = New System.Drawing.Size(100, 23)
        Me.pbPWMValue.Style = System.Windows.Forms.ProgressBarStyle.Continuous
        Me.pbPWMValue.TabIndex = 3
        '
        'AnalogPinControl
        '
        Me.AutoScaleDimensions = New System.Drawing.SizeF(6.0!, 13.0!)
        Me.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font
        Me.Controls.Add(Me.pbPWMValue)
        Me.Controls.Add(Me.lblPWMValue)
        Me.Controls.Add(Me.cbOnOff)
        Me.Controls.Add(Me.lblPinNumber)
        Me.Name = "AnalogControl"
        Me.Size = New System.Drawing.Size(203, 34)
        Me.ResumeLayout(False)
        Me.PerformLayout()

    End Sub
    Friend WithEvents lblPinNumber As System.Windows.Forms.Label
    Friend WithEvents cbOnOff As System.Windows.Forms.CheckBox
    Friend WithEvents lblPWMValue As System.Windows.Forms.Label
    Friend WithEvents pbPWMValue As System.Windows.Forms.ProgressBar

End Class
