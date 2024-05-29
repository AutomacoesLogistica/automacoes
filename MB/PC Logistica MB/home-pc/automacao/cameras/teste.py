import requests

url = "http://admin:logistica2019@@@192.168.10.13:8013/cgi-bin/configManager.cgi?action=getConfig&name=ChannelTitle"

payload = {}
headers = {
  'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36',
  'Accept-Language': 'pt-BR,pt;q=0.9',
  'Accept-Encoding': 'gzip, deflate',
  'Accept': 'image/avif,image/webp,image/apng,image/svg+xml,image/*,*/*;q=0.8'
}

response = requests.request("GET", url, headers=headers, data=payload)

print(response.text)
