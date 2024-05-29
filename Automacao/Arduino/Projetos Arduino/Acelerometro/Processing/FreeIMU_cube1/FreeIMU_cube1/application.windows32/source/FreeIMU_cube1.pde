
/**
 
 Visualize a cube which will assumes the orientation described
 in a quaternion coming from the serial port. 
 
 INSTRUCTIONS: 
 This program has to be run when you have the FreeIMU_quaternion
 program running on your Arduino and the Arduino connected to your PC.
 Remember to set the serialPort variable below to point to the name the
 Arduino serial port has in your system. You can get the port using the
 Arduino IDE from Tools->Serial Port: the selected entry is what you have
 to use as serialPort variable.
 
 
 Copyright (C) 2011 Fabio Varesano - http://www.varesano.net/
 
 This program is free software: you can redistribute it and/or modify
 it under the terms of the version 3 GNU General Public License as
 published by the Free Software Foundation.
 
 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.
 
 You should have received a copy of the GNU General Public License
 along with this program.  If not, see <http://www.gnu.org/licenses/>.
 
 ****
 
 Edited by Antonio Hermida Vazquez Ago 2013
 This is a "little more graphic" version 
 After to see this gorgeus program I started to think how to see the real board.
 This is my contribution. 
 Of course anyone can put his own board to get the same result
 
 
 
 
 */

import processing.serial.*;

Serial myPort;  // Create object from Serial class

//final String serialPort = "/dev/ttyUSB9"; // replace this with your serial port. On windows you will need something like "COM1".
final String serialPort = "/dev/tty.usbmodem1d11"; // replace this with your serial port. On windows you will need something like "COM1".


float [] q = new float [8];
float [] hq = null;
float [] Euler = new float [3]; // psi, theta, phi

int lf = 10; // 10 is '\n' in ASCII
byte[] inBuffer = new byte[22]; // this is the number of chars on each line from the Arduino (including /r/n)

PFont font;
//final int VIEW_SIZE_X = 1024, VIEW_SIZE_Y = 768;
int VIEW_SIZE_X = 800, VIEW_SIZE_Y = 600;

PImage topside, downside, frontside, rightside;


void setup() 
{
  size(800, 600, P3D);
  textureMode(NORMAL);
  fill(255);
  stroke(color(44, 48, 32));



  myPort = new Serial(this, Serial.list()[0], 115200);

  // The font must be located in the sketch's "data" directory to load successfully
  font = loadFont("CourierNew36.vlw"); 


  // Loading the textures to the cube
  // The png files alow to put the board holes so can increase  realism 

  topside = loadImage("MPU6050 A.png");//Top Side
  downside = loadImage("MPU6050 B.png");//Botm side
  frontside = loadImage("MPU6050 E.png"); //Wide side
  rightside = loadImage("MPU6050 F.png");// Narrow side



  delay(100);
  myPort.clear();
  myPort.write("1");
}


float decodeFloat(String inString) {
  byte [] inData = new byte[4];

  if (inString.length() == 8) {
    inData[0] = (byte) unhex(inString.substring(0, 2));
    inData[1] = (byte) unhex(inString.substring(2, 4));
    inData[2] = (byte) unhex(inString.substring(4, 6));
    inData[3] = (byte) unhex(inString.substring(6, 8));
  }

  int intbits = (inData[3] << 24) | ((inData[2] & 0xff) << 16) | ((inData[1] & 0xff) << 8) | (inData[0] & 0xff);
  return Float.intBitsToFloat(intbits);
}


void readQ() {
  if (myPort.available() >= 18) {
    String inputString = myPort.readStringUntil('\n');
    //print(inputString);
    if (inputString != null && inputString.length() > 0) {
      String [] inputStringArr = split(inputString, ",");
      //println(inputStringArr[1]);
      if (inputStringArr.length >= 3) { // q1,q2,q3,q4,\r\n so we have 5 elements
        
        q[0] = float(inputStringArr[0]);
        q[1] = float(inputStringArr[1]);
        q[2] = float(inputStringArr[2]);
        q[3] = 0;
        
        
        /*
                q[1] = float(inputStringArr[1]);
        q[2] = float(inputStringArr[2]);
        q[3] = float(inputStringArr[3]);
       */
        
      }
    }
  }
}


/*
From
 * Texture Cube
 * by Dave Bollinger.
 I only Added multiple sides textured. AHV Ago 2013
 */

void topboard(PImage imag) {
  beginShape(QUADS);
  texture(imag);
  // -Y "top" face
  vertex(-20, -1, -15, 0, 0);
  vertex( 20, -1, -15, 1, 0);
  vertex( 20, -1, 15, 1, 1);
  vertex(-20, -1, 15, 0, 1);

  endShape();
}

void botomboard(PImage imag) {
  beginShape(QUADS);
  texture(imag);

  // +Y "bottom" face
  vertex(-20, 1, 15, 0, 0);
  vertex( 20, 1, 15, 1, 0);
  vertex( 20, 1, -15, 1, 1);
  vertex(-20, 1, -15, 0, 1);

  endShape();
}


void sideboarda(PImage imag) {
  beginShape(QUADS);
  texture(imag);

  // +Z "front" face
  vertex(-20, -1, 15, 0, 0);
  vertex( 20, -1, 15, 1, 0);
  vertex( 20, 1, 15, 1, 1);
  vertex(-20, 1, 15, 0, 1);

  // -Z "back" face
  vertex( 20, -1, -15, 0, 0);
  vertex(-20, -1, -15, 1, 0);
  vertex(-20, 1, -15, 1, 1);
  vertex( 20, 1, -15, 0, 1);


  endShape();
}

void sideboardb(PImage imag) {
  beginShape(QUADS);
  texture(imag);

  // +X "right" face
  vertex( 20, -1, 15, 0, 0);
  vertex( 20, -1, -15, 1, 0);
  vertex( 20, 1, -15, 1, 1);
  vertex( 20, 1, 15, 0, 1);

  // -X "left" face
  vertex(-20, -1, -15, 0, 0);
  vertex(-20, -1, 15, 1, 0);
  vertex(-20, 1, 15, 1, 1);
  vertex(-20, 1, -15, 0, 1);

  endShape();
}







void drawCube() {  
  pushMatrix();
  translate(VIEW_SIZE_X/2, VIEW_SIZE_Y/2 + 50, 0);
  //scale(5,5,5);
  scale(10);

  // a demonstration of the following is at 
  // http://www.varesano.net/blog/fabio/ahrs-sensor-fusion-orientation-filter-3d-graphical-rotating-cube
  rotateZ(-Euler[2]);
  rotateX(-Euler[1]);
  rotateY(-Euler[0]);


  topboard(topside);
  botomboard(downside);
  sideboarda(frontside);
  sideboardb(rightside);


  popMatrix();
}


void draw() {
  background(#000000);
  //fill(#ffffff);

  readQ();


  if (hq != null) { // use home quaternion
    quaternionToEuler(quatProd(hq, q), Euler);
    text("Disable home position by pressing \"n\"", 20, VIEW_SIZE_Y - 30);
  } else {
    quaternionToEuler(q, Euler);
    text("Point FreeIMU's X axis to your monitor then press \"h\"", 20, VIEW_SIZE_Y - 30);
  }

  textFont(font, 20);
  textAlign(LEFT, TOP);
  text("Dados:\n" + q[0] + "\n" + q[1] + "\n" + q[2] + "\n" + q[3], 20, 20);
  text("Euler Angles:\nYaw (psi)  : " + degrees(Euler[0]) + "\nPitch (theta): " + degrees(Euler[1]) + "\nRoll (phi)  : " + degrees(Euler[2]), 200, 20);

  drawCube();
}


void keyPressed() {
  if (key == 'h') {
    q[1] = -1;
    println("pressed h");

    // set hq the home quaternion as the quatnion conjugate coming from the sensor fusion
    hq = quatConjugate(q);
  } else if (key == 'n') {
    println("pressed n");
    q[1]=1;
    //hq = null;
  }
}

// See Sebastian O.H. Madwick report 
// "An efficient orientation filter for inertial and intertial/magnetic sensor arrays" Chapter 2 Quaternion representation

void quaternionToEuler(float [] q, float [] euler) {
  euler[0] = atan2(2 * q[1] * q[2] - 2 * q[0] * q[3], 2 * q[0]*q[0] + 2 * q[1] * q[1] - 1); // psi
  euler[1] = -asin(2 * q[1] * q[3] + 2 * q[0] * q[2]); // theta
  euler[2] = atan2(2 * q[2] * q[3] - 2 * q[0] * q[1], 2 * q[0] * q[0] + 2 * q[3] * q[3] - 1); // phi
}

float [] quatProd(float [] a, float [] b) {
  float [] q = new float[4];

  q[0] = a[0] * b[0] - a[1] * b[1] - a[2] * b[2] - a[3] * b[3];
  q[1] = a[0] * b[1] + a[1] * b[0] + a[2] * b[3] - a[3] * b[2];
  q[2] = a[0] * b[2] - a[1] * b[3] + a[2] * b[0] + a[3] * b[1];
  q[3] = a[0] * b[3] + a[1] * b[2] - a[2] * b[1] + a[3] * b[0];

  return q;
}

// returns a quaternion from an axis angle representation
float [] quatAxisAngle(float [] axis, float angle) {
  float [] q = new float[4];

  float halfAngle = angle / 2.0;
  float sinHalfAngle = sin(halfAngle);
  q[0] = cos(halfAngle);
  q[1] = -axis[0] * sinHalfAngle;
  q[2] = -axis[1] * sinHalfAngle;
  q[3] = -axis[2] * sinHalfAngle;

  return q;
}

// return the quaternion conjugate of quat
float [] quatConjugate(float [] quat) {
  float [] conj = new float[4];

  conj[0] = quat[0];
  conj[1] = -quat[1];
  conj[2] = -quat[2];
  conj[3] = -quat[3];

  return conj;
}