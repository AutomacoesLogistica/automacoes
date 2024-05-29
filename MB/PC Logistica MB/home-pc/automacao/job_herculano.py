import requests
import pyodbc
import time
from time import gmtime, strftime
from datetime import datetime

url_local = 'http://192.168.10.96/herculano/hora.php'


#DADOS CONEXAO COM A HERCULANO SQL SERVER ************************************************

#Dados servidor herculano
server = '200.209.137.130'
db = 'MINA_WEB' 
username = 'GERDAU' 
password = 'G3rd@u' 
#driver='{SQL Server}'
#print (pyodbc.drivers())
#drivers = pyodbc.drivers()
#driver = drivers[0]
#print(driver)
driver='ODBC Driver 18 for SQL Server'

dados_conexao = ("DRIVER="+driver+";"
                 "Server="+server+";"
                 "Database="+db+";"
                 "UID="+username+";"
                 "PWD="+password+";"
                 "Encrypt=no;"
                 )


while(1):
    #Busco a data e hora
    try:
        dados = {'a': 'a'}
        texto = None
        requisicao = requests.get(url_local,dados)
        horario = str(requisicao.text)
        horario = horario.split(',')
        data_atual = horario[0]
        hora_atual = horario[1]
        print(data_atual + ' - ' + hora_atual)
        #Quebro os valores
        dia_agora = int(data_atual[0:2])
        mes_agora = int(data_atual[3:5])
        ano_agora = int(data_atual[6:10])        
        hora_agora = int(str(int(hora_atual[0:2])))
        minuto_agora = int(hora_atual[3:5])
        segundo_agora = str(hora_atual[6:8])

        leitura_agora = datetime(int(ano_agora),int(mes_agora), int(dia_agora), int(hora_agora), int(minuto_agora), int(segundo_agora)) #Ano, mes, dia, hora, minuto, segundos


    except Exception as e:
        print("Requisicao deu erro:", e)

    #Verifico se existem placas com status_processo='Controle Acesso!' e com tempo >=30min
    conexao = pyodbc.connect(dados_conexao)
    cursor = conexao.cursor()
    
    data_consulta = data_atual # data do dia
    
    cursor.execute(f"SELECT TOP 5 * FROM INTEGRACAO_GERDAU_HM WHERE (data_saida_origem='{data_consulta}' AND status_processo='Controle de Acesso!' ) ORDER BY ID Desc" ) #Faz um insert na tabela vendas
    dados = cursor.fetchall() 
    encontrados = 0
    array_id = []
    array_status_processo = []
    array_data_saida = []
    array_hora_saida = []

    for w in dados:
      encontrados = encontrados+1
      ID = w[0]
      data_saida = w[12]
      hora_saida = w[13]
      status_processo = w[18]
      array_id.append(ID)
      array_status_processo.append(status_processo)
      array_data_saida.append(data_saida)
      array_hora_saida.append(hora_saida)
      
    v_encontrados = (len(array_id)) # quantidade encontrada

    if(v_encontrados>0):
       print("Imprimindo os dados *************************************************") 
       numero = 0 # NAO MUDAR
       for x in array_id:
         #Calculo a diferenca de hora para saber de sem mais de 30min
         data_banco = array_data_saida[numero]
         horario_banco = array_hora_saida[numero]
         #Quebro os valores
         dia_banco = int(data_banco[0:2])
         mes_banco = int(data_banco[3:5])
         ano_banco = int(data_banco[6:10])        
         hora_banco = int(str(int(horario_banco[0:2])))
         minuto_banco = int(horario_banco[3:5])
         segundo_banco = str(horario_banco[6:8])
              
         ultima_leitura = datetime(int(ano_banco), int(mes_banco), int(dia_banco), int(hora_banco), int(minuto_banco), int(segundo_banco))

         resposta= str(leitura_agora - ultima_leitura)
         #print(resposta)
         resposta = resposta.split(':')
         v_hora = int(resposta[0])
         v_minuto = int(resposta[1])
         v_segundo = int(resposta[2])               
         resposta_em_minutos = int(  ((int(resposta[0])*3600)+(int(resposta[1])*60))/60)
         #print(resposta_em_minutos)
         
         if(resposta_em_minutos>30 and resposta_em_minutos <200):
            diferenca = str(resposta_em_minutos)
            print ( "ID = " + str(array_id[numero]) + "  - Status_Processo = " + array_status_processo[numero] + " - Data saida = " + array_data_saida[numero] + " - Hora saida = " + array_hora_saida[numero] + " - Diferenca = " + diferenca)                       
            #Caso chegou ate aqui, faço UPDATE no banco encerrando as viagens via JOB
            conexao = pyodbc.connect(dados_conexao)
            cursor = conexao.cursor()
            ID = array_id[numero]
            data_saida = data_atual
            hora_saida = hora_atual
            cursor.execute(f"UPDATE INTEGRACAO_GERDAU_HM SET  data_saida_origem='{data_saida}',hora_saida_origem='{hora_saida}',status_processo='Saindo da Planta!' WHERE ID='{ID}'" )
            cursor.commit() 
            print('Finalizado UPDATE!')



            #******************************************************
         numero = numero +1
    else:
       print("Sem dados!")

    cursor.commit()    
    print('Aguardando tempo para rodar o JOB novamente')    
    time.sleep(1800) # 30 MIN