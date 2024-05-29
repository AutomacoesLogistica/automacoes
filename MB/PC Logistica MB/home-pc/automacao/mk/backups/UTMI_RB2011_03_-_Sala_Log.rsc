# jun/12/2023 16:40:52 by RouterOS 7.9
# software id = WNEL-1ML6
#
# model = RB2011UiAS
# serial number = E7E00FE2666E
/interface bridge
add name=bridge1
/interface ethernet
set [ find default-name=ether1 ] name="ether1 - Chega Link - Vem RB2011 01"
set [ find default-name=ether2 ] name="ether2 - Painel Escada"
set [ find default-name=ether3 ] name="ether3 - Raspberry Portal CCL"
set [ find default-name=ether4 ] name="ether4 - Raspberry Dashboard CCL"
set [ find default-name=ether5 ] name="ether5 - CIP850 IP: 07"
set [ find default-name=ether6 ] name="ether6 - Mesa PTZ IP: 06"
set [ find default-name=ether7 ] name="ether7 - TIP450 CCL IP: 08"
set [ find default-name=ether8 ] name="ether8 - NVR1 IP: 09"
set [ find default-name=ether9 ] name="ether9 - NVR2 IP: 10"
set [ find default-name=ether10 ] name="ether10 - CAM Sala Rack Logistica"
/interface list
add name=WAN
add name=LAN
/interface lte apn
set [ find default=yes ] ip-type=ipv4 use-network-apn=no
/interface wireless security-profiles
set [ find default=yes ] supplicant-identity=MikroTik
/port
set 0 name=serial0
/interface bridge port
add bridge=bridge1 ingress-filtering=no interface=\
    "ether1 - Chega Link - Vem RB2011 01"
add bridge=bridge1 ingress-filtering=no interface="ether2 - Painel Escada"
add bridge=bridge1 ingress-filtering=no interface=\
    "ether3 - Raspberry Portal CCL"
add bridge=bridge1 ingress-filtering=no interface=\
    "ether4 - Raspberry Dashboard CCL"
add bridge=bridge1 ingress-filtering=no interface="ether5 - CIP850 IP: 07"
add bridge=bridge1 ingress-filtering=no interface="ether6 - Mesa PTZ IP: 06"
add bridge=bridge1 ingress-filtering=no interface=\
    "ether7 - TIP450 CCL IP: 08"
add bridge=bridge1 ingress-filtering=no interface="ether8 - NVR1 IP: 09"
add bridge=bridge1 ingress-filtering=no interface="ether9 - NVR2 IP: 10"
add bridge=bridge1 ingress-filtering=no interface=\
    "ether10 - CAM Sala Rack Logistica"
add bridge=bridge1 ingress-filtering=no interface=sfp1
/ip neighbor discovery-settings
set discover-interface-list=!dynamic
/ip settings
set max-neighbor-entries=8192
/ipv6 settings
set disable-ipv6=yes max-neighbor-entries=8192
/interface list member
add interface="ether1 - Chega Link - Vem RB2011 01" list=WAN
add interface="ether2 - Painel Escada" list=LAN
add interface="ether3 - Raspberry Portal CCL" list=LAN
add interface="ether4 - Raspberry Dashboard CCL" list=LAN
add interface="ether5 - CIP850 IP: 07" list=LAN
add interface="ether6 - Mesa PTZ IP: 06" list=LAN
add interface="ether7 - TIP450 CCL IP: 08" list=LAN
add interface="ether8 - NVR1 IP: 09" list=LAN
add interface="ether9 - NVR2 IP: 10" list=LAN
add interface="ether10 - CAM Sala Rack Logistica" list=LAN
add interface=sfp1 list=LAN
/interface ovpn-server server
set auth=sha1,md5
/ip address
add address=192.168.10.3/24 interface="ether2 - Painel Escada" network=\
    192.168.10.0
add address=192.168.10.3/24 interface="ether1 - Chega Link - Vem RB2011 01" \
    network=192.168.10.0
add address=192.168.10.3/24 interface="ether3 - Raspberry Portal CCL" \
    network=192.168.10.0
add address=192.168.10.3/24 interface="ether4 - Raspberry Dashboard CCL" \
    network=192.168.10.0
add address=192.168.10.3/24 interface="ether5 - CIP850 IP: 07" network=\
    192.168.10.0
add address=192.168.10.3/24 interface="ether6 - Mesa PTZ IP: 06" network=\
    192.168.10.0
add address=192.168.10.3/24 interface="ether7 - TIP450 CCL IP: 08" network=\
    192.168.10.0
add address=192.168.10.3/24 interface="ether8 - NVR1 IP: 09" network=\
    192.168.10.0
add address=192.168.10.3/24 interface="ether9 - NVR2 IP: 10" network=\
    192.168.10.0
add address=192.168.10.3/24 interface="ether10 - CAM Sala Rack Logistica" \
    network=192.168.10.0
/ip dns
set servers=8.8.8.8
/ip firewall nat
add action=masquerade chain=srcnat
/ip route
add disabled=no dst-address=0.0.0.0/0 gateway=192.168.10.1
/lcd
set backlight-timeout=never default-screen=stats
/lcd interface
set sfp1 disabled=yes
set "ether2 - Painel Escada" disabled=yes
set "ether3 - Raspberry Portal CCL" disabled=yes
set "ether4 - Raspberry Dashboard CCL" disabled=yes
set "ether5 - CIP850 IP: 07" disabled=yes
set "ether6 - Mesa PTZ IP: 06" disabled=yes
set "ether7 - TIP450 CCL IP: 08" disabled=yes
set "ether8 - NVR1 IP: 09" disabled=yes
set "ether9 - NVR2 IP: 10" disabled=yes
set "ether10 - CAM Sala Rack Logistica" disabled=yes
/system clock
set time-zone-name=America/Sao_Paulo
/system identity
set name="UTMI_RB2011_03 - Sala Log"
/system note
set show-at-login=no
/system ntp client
set enabled=yes
/system ntp client servers
add address=a.ntp.br
add address=b.ntp.br
/system script
add dont-require-permissions=no name=backup_ftp owner=admin policy=\
    ftp,reboot,read,write,policy,test,password,sniff,sensitive,romon source=":\
    log warning \"***************************************\"\r\
    \n# Conex\E3o FTP\r\
    \n:global host 192.168.10.96\r\
    \n:global usuario radios\r\
    \n:global senha radios2023\r\
    \n:global diretorio /home/radios/ftp/files\r\
    \n# Pega o nome do Router\r\
    \n:global identifica [/system identity get name ];\r\
    \n# Gera data no formato AAAA-MM-DD\r\
    \n:global data [/system clock get date]\r\
    \n:global meses (\"jan\",\"feb\",\"mar\",\"apr\",\"may\",\"jun\",\"jul\",\
    \"aug\",\"sep\",\"oct\",\"nov\",\"dec\");\r\
    \n:global ano ([:pick \$data 7 11])\r\
    \n:global mestxt ([:pick \$data 0 3])\r\
    \n:global mm ([ :find \$meses \$mestxt -1 ] + 1);\r\
    \n:if (\$mm < 10) do={ :set mm (\"0\" . \$mm); }\r\
    \n:global mes ([:pick \$ds 7 11] . \$mm . [:pick \$ds 4 6])\r\
    \n:global dia ([:pick \$data 4 6])\r\
    \n:log info \"Gerando backup: \$identifica.backup\";\r\
    \n/system backup save name=\"\$identifica\";\r\
    \n:log info \"Gerando export: \$identifica.rsc\";\r\
    \n/export file=\"\$identifica\"\r\
    \n:log info \"Processando...\";\r\
    \n:delay 5s\r\
    \n:log info \"Conectando FTP Server...\";\r\
    \n:log info \"Enviando Backup [\$identifica.backup] ...\";\r\
    \n/tool fetch address=\$host src-path=\"\$identifica.backup\" user=\"\$usu\
    ario\" password=\"\$senha\" port=21 upload=yes mode=ftp dst-path=\"\$diret\
    orio.'/'.\$identifica.backup\"\r\
    \n:log info \"Enviando Export [\$identifica.rsc] ...\";\r\
    \n/tool fetch address=\$host src-path=\"\$identifica.rsc\" user=\"\$usuari\
    o\" password=\"\$senha\" port=21 upload=yes mode=ftp dst-path=\"\$diretori\
    o.'/'.\$identifica.rsc\"\r\
    \n:delay 1\r\
    \n:log info \"Backup enviado com sucesso...\";\r\
    \n:log info \"Removendo arquivos...\";\r\
    \n /file remove \"\$identifica.backup\"\r\
    \n /file remove \"\$identifica.rsc\"\r\
    \n:log info \"Rotina de backup finalizada...\";\r\
    \n:log warning \"***************************************\";"
add dont-require-permissions=no name=script1 owner=admin policy=\
    ftp,reboot,read,write,policy,test,password,sniff,sensitive,romon source="t\
    ool fetch address=\"192.168.10.96\" mode=ftp user=\"radios\" password=\"ra\
    dios2023\" src-path=\"UTMI_RB2011_03 - Sala Log.backup\" dst-path=\"/home/\
    radios/ftp/files/UTMI_RB2011_03 - Sala Log.backup\" upload=yes"
add dont-require-permissions=no name=script2 owner=admin policy=\
    ftp,reboot,read,write,policy,test,password,sniff,sensitive,romon source="#\
    \_Criando Vari\E1veis\r\
    \n:global arquivo ( [/system identity get name] );\r\
    \n\r\
    \n# Gerando Arquivo Backup\r\
    \n:log info \"Iniciando Backup...\"\r\
    \n/system backup save name=\$arquivo\r\
    \n:log info \"Backup Concluido\"\r\
    \n\r\
    \n# Gerando Arquivo export\r\
    \n/export file=\$arquivo\r\
    \n:log info \"Tempo aproximado 5s\"\r\
    \n:delay 5s\r\
    \n\r\
    \n# Enviando arquivo de Backup\r\
    \n:log info \"Enviando Backup por FTP...\"\r\
    \n:log info \"Tempo aproximado 5s\"\r\
    \n/tool fetch address=10.50.1.5 src-path=\"\$arquivo.rsc\" user=testuser m\
    ode=ftp password=mudarsenha dst-path=\"'/backup_mikrotik/'.\$arquivo.rsc\"\
    \_upload=yes\r\
    \n:delay 15s\r\
    \n\r\
    \n/tool fetch address=10.50.1.5 src-path=\"\$arquivo.backup\" user=testuse\
    r mode=ftp password=mudarsenha dst-path=\"'/backup_mikrotik/'.\$arquivo.ba\
    ckup\" upload=yes\r\
    \n:log info \"Backup Enviando com Sucesso\"\r\
    \n\r\
    \n# Deletando Arquivos de Backup\r\
    \n:log info \"Deletando Arquivos na RB\"\r\
    \n/file remove \"\$arquivo.backup\"\r\
    \n/file remove \"\$arquivo.rsc\"\r\
    \n:log info \"Arquivos Deletados\""
/tool romon
set enabled=yes
