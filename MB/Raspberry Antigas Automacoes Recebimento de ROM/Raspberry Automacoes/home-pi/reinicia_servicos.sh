
#!/bin/bash

service mysql status | grep 'active (running)' > /dev/null 2>&1

if [ $? != 0 ]
then
        sudo service mysql restart > /dev/null
fi

service saidas status | grep 'active (running)' > /dev/null 2>&1

if [ $? != 0 ]
then
        sudo service saidas restart > /dev/null
fi


service gscs status | grep 'active (running)' > /dev/null 2>&1

if [ $? != 0 ]
then
        sudo service gscs restart > /dev/null
fi


service lora status | grep 'active (running)' > /dev/null 2>&1

if [ $? != 0 ]
then
        sudo service lora restart > /dev/null
fi

