import socketserver
import requests

url_local = 'http://192.168.10.96/sockets/balanca1/salvar_leituras.php'

class MyTCPHandler(socketserver.BaseRequestHandler):
    """
    The request handler class for our server.

    It is instantiated once per connection to the server, and must
    override the handle() method to implement communication to the
    client.
    """

    def handle(self):
        # self.request is the TCP socket connected to the client
        self.data = self.request.recv(2048).strip()
        print("{} wrote:".format(self.client_address[0]))
        print(self.data)
        dados = {'mensagem': self.data}
        try:
            requisicao = requests.get(url_local,dados)
            #para POST mudar .get para .post
            texto = str(requisicao)
            print(texto[11:14])
        except Exception as e:
            print("Requisicao deu erro:", e)
        # just send back the same data, but upper-cased
        self.request.sendall(self.data.upper())

def main():
    try:
        if __name__ == "__main__":
            HOST, PORT = "192.168.10.96", 5001

            # Create the server, binding to localhost on port 9999
            with socketserver.TCPServer((HOST, PORT), MyTCPHandler) as server:
                # Activate the server; this will keep running until you
                # interrupt the program with Ctrl-C
                server.serve_forever()
    except Exception as e:
        print(e)
        main()

for i in range(1, 1000000000):
  try:
    main()
  except Exception as e:
    print(e)
    print("Restarting!")
    main()
