#!/bin/bash
 
xset s noblank
xset s off
xset -dpms
 
unclutter -idle 0.5 -root &
 
sed -i 's/"exited_cleanly":false/"exited_cleanly":true/' /home/pi/.config/chromium/Default/Preferences
sed -i 's/"exit_type":"Crashed"/"exit_type":"Normal"/' /home/pi/.config/chromium/Default/Preferences
 
/usr/bin/chromium-browser --noerrdialogs --disable-infobars --incognito --disable-translate --kios http://svatech.com.br:5030/#/login &
#http://localhost/Display_Raspberry/MB/raspbery_display_balanca01_patrag.php &
 
while true; do
xdotool keydown ctrl+Tab; xdotool keyup ctrl+Tab;
sleep 20
done
