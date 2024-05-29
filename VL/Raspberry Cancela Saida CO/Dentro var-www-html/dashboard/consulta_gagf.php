<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta GAGF e atualiza dados</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    </head>

<body>
    

<?php
$placa = isset($_GET['placa'])?$_GET['placa']:'vazio';

if($placa != 'vazio')
{
?>
    
    <script>
    
    /*

        ATENÇÃO: PARA VL ESPECIFICAMENTE O ULTIMO SEMPRE E O PROCESSO FILHO, COM ISSO NAO VEM DADOS DE PESAGEM, VAMOS SOLICITAR PARA VIR
        OS 2 ULTIMOS PROCESSO, TENHO QUE ALTERAR AQUI PARA ME ENVIAR O ANTEPENULTIMO E NAO O ULTIMO!

    */
    
    
    var link_tag_ou_placa = '<?php print $placa ?>';   
    var tag_ou_placa = link_tag_ou_placa;//"442001000000000000000419";   
    var url = "https://gerdauyardserviceda335bbb3.us2.hana.ondemand.com/gerdau-yard-service/rest/schedule/getScheduleDetailByTruck?tagOrPlate="+tag_ou_placa; // PRODUCAO
    
    var myHeaders = new Headers();
    myHeaders.append("Authorization", "Basic c2VydmljZV9hcGlfc2NoZWR1bGU6TWluQDMyMU1pbkA=");
    var requestOptions = 
    {
    method: 'GET',
    headers: myHeaders,
    redirect: 'follow'
    };
    
    fetch(url, requestOptions)
    .then(response => response.text())
    .then(result => validar_dados(result))
    .catch(error => console.log('error', error));

    function validar_dados(mensagem)
    {
    if(mensagem == '{"errorCode":"java.lang.NullPointerException","errorMsg":"Erro não mapeado"}')
    {
    //alert('Atenção: \nDados inseridos estão incorretos ou não foi localizado no sistema!')
    console.log("nao encontrado");
    }
    else
    { 
    //Trata pois existe o dado!
    const obj = JSON.parse(mensagem);
    statusProcesso= obj.scheduleDetail.statusProcesso;
    if(statusProcesso== ""){statusProcesso= "-";}
    celular = obj.scheduleDetail.celular;
    if(celular == "")
    {
    celular = "-";
    }
    else
    {
    vcelular = celular.split(" ");
    celular = "+"+vcelular[0]+" ("+vcelular[1].substring(0,2)+ ") "+ vcelular[1].substring(2,7)+'-'+ vcelular[1].substring(7,11);
    //celular = vcelular[0]
    }
    cnh= obj.scheduleDetail.cnh;
    if(cnh== ""){cnh= "-";}
    cpf= obj.scheduleDetail.cpf;
    if(cpf== ""){cpf= "-";}
    nome= obj.scheduleDetail.nome;
    if(nome== ""){nome= "-";}
    origem= obj.scheduleDetail.origem;
    if(origem== ""){origem= "-";}
    destino= obj.scheduleDetail.destino;
    if(destino== ""){destino= "-";}
    rota= obj.scheduleDetail.rota;
    if(rota== ""){rota= "-";}
    material= obj.scheduleDetail.material;
    if(material== ""){material= "-";}
    estoque= obj.scheduleDetail.estoque;
    if(estoque== ""){estoque= "-";}
    dataPrevisaoCarga= obj.scheduleDetail.dataPrevisaoCarga;
    if(dataPrevisaoCarga== ""){dataPrevisaoCarga= "-";}
    idProcessoGagf_filho= obj.scheduleDetail.idProcessoGagf;
    if(idProcessoGagf_filho== ""){idProcessoGagf_filho= "-";}
    idProcessoGscs_filho= obj.scheduleDetail.idProcessoGscs;
    if(idProcessoGscs_filho== ""){idProcessoGscs_filho= "-";}
    ticket= obj.scheduleDetail.ticket;
    if(ticket =="" || ticket=="-" || ticket =='0'){ticket = 'Não identificado!';}
    nomination= obj.scheduleDetail.nomination;
    if(nomination== ""){nomination= "-";}
    pesoBruto= obj.scheduleDetail.pesoBruto;
    if(pesoBruto== ""){pesoBruto= "-";}else{pesoBruto = pesoBruto;} // OBS: Nao colocar KG pois ira ser salvo em banco para realizar contar posteriormete
    pesoMaterialCarregado= obj.scheduleDetail.pesoMaterialCarregado;
    if(pesoMaterialCarregado== ""){pesoMaterialCarregado= "-";}else{pesoMaterialCarregado;}
    tempoDeslocamento= obj.scheduleDetail.tempoDeslocamento;
    if(tempoDeslocamento== ""){tempoDeslocamento= "-";}
    tipoConjunto=obj.scheduleDetail.tipoConjunto;
    if(tipoConjunto== ""){tipoConjunto= "-";}
    placaCarreta= obj.scheduleDetail.placaCarreta;
    if(placaCarreta== ""){placaCarreta= "-";}
    estadoCarreta= obj.scheduleDetail.estadoCarreta;
    if(estadoCarreta== ""){estadoCarreta= "-";}
    tipoCarreta= obj.scheduleDetail.tipoCarreta;
    if(tipoCarreta== ""){tipoCarreta= "-";}
    transportadoraCarreta= obj.scheduleDetail.transportadoraCarreta;
    if(transportadoraCarreta== ""){transportadoraCarreta= "-";}
    placaCavalo= obj.scheduleDetail.placaCavalo;
    if(placaCavalo== ""){placaCavalo= "-";}
    estadoCavalo= obj.scheduleDetail.estadoCavalo;
    if(estadoCavalo== ""){estadoCavalo= "-";}
    tipoCavalo= obj.scheduleDetail.tipoCavalo;
    if(tipoCavalo== ""){tipoCavalo= "-";}
    transportadoraCavalo= obj.scheduleDetail.transportadoraCavalo;
    if(transportadoraCavalo== ""){transportadoraCavalo= "-";}
    } // fecha o else que pode tratar

    //Agora passo os dados para o php salvar no banco via AJAX
    //alert(dados);
    $.ajax({
           url: 'verifica_respostas_gagf.php',
           type: 'GET',
           dataType: 'json',
           data: {
            'statusProcesso': statusProcesso,
            'cnh': cnh,
            'cpf': cpf,
            'nome': nome,
            'ceular': celular,
            'origem': origem,
            'email': '-',
            'destino': destino,
            'rota': rota,
            'material': material,
            'estoque': estoque,
            'dataPrevisaoCarga': dataPrevisaoCarga,
            'idProcessoGagf_pai': '0',
            'idProcessoGscs_pai': '0',
            'idProcessoGagf_filho': idProcessoGagf_filho,
            'idProcessoGscs_filho': idProcessoGscs_filho,
            'ticket': ticket,
            'nomination': nomination,
            'pesoBruto': pesoBruto,
            'tara': '-',
            'pesoMaterialCarregado': pesoMaterialCarregado,
            'tempoDeslocamento': tempoDeslocamento,
            'tipoConjunto': tipoConjunto,
            'placaCarreta': placaCarreta,
            'estadoCarreta': estadoCarreta,
            'tipoCarreta': tipoCarreta,
            'transportadoraCarreta': transportadoraCarreta,
            'placaCavalo': placaCavalo,
            'estadoCavalo': estadoCavalo,
            'tipoCavalo': tipoCavalo,
            'transportadoraCavalo': transportadoraCavalo
           },
           success: function(resultado)
           {
            if(resultado == "ok")
            {
             console.log(cnh);
             console.log(cpf);
             console.log(nome);
             console.log(origem);
             console.log(destino);
             console.log(rota);
             console.log(material);
             console.log(estoque);
             console.log(dataPrevisaoCarga);
             console.log(idProcessoGagf_filho);
             console.log(idProcessoGscs_filho);
             console.log(ticket);
             console.log(nomination);
             console.log(pesoBruto);
             console.log(pesoMaterialCarregado);
             console.log(tempoDeslocamento);
             console.log(tipoConjunto);
             console.log(placaCarreta);
             console.log(estadoCarreta);
             console.log(tipoCarreta);
             console.log(transportadoraCarreta);
             console.log(placaCavalo);
             console.log(estadoCavalo);
             console.log(tipoCavalo);
             console.log(transportadoraCavalo);
            }
            else
            {
                console.log(resultado);
            } 
           }
        });


    } // Fecha function que trata os dados
    </script>
<?php    
} //Nao pode consultar
else
{
 echo "Falta os dados para a consulta!" ; 
}
?>











































</body>
</html>