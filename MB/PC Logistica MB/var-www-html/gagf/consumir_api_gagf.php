
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8"/>
<title>Gerdau :: GAGF - Bruno Gonçalves</title>
<link rel="shortcut icon" type="imagem/JPG" href="./images/gerdau.jpg";  id="favicon">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</head>
<body>
<h2 id="lb_titulo">Consultando dados API no do GAGF</h2>
<!--<h3 id="lb_servidor">https://gerdauyardserviced90aa8583.us2.hana.ondemand.com/gerdau-yard-service/rest/schedule/getScheduleDetailByTruck - Qualidade!</h3>-->
<h3 id="lb_servidor">https://gerdauyardserviceda335bbb3.us2.hana.ondemand.com/gerdau-yard-service/rest/schedule/getScheduleDetailByTruck - Producao!</h3>

<fieldset id="formulario1_1"><legend>Dados para Pesquisa</legend>
Insira a TAG ou Placa: <input style="padding-left: 10px;" id="tag_ou_placa" name="tag_ou_placa" type="text" maxlength="24" />
&nbsp;&nbsp;<input id="btn_Pesquisar" type="submit" onclick="pesquisar(tag_ou_placa.value)" value="Efetuar Consulta"/><br/>

<label id='status' name='status'>Status do Processo:</label>
<input id="v_status" name="v_status" type="text"/>

</fieldset>

<input id="v_resposta" name="v_resposta" type="text" hidden='hidden'/>



<fieldset id="formulario1"><legend>Dados do Processo</legend>
<label id='motorista' name='motorista'>Motorista:</label>
<input style="padding-left: 10px;" id="v_motorista" name="v_motorista" type="text" maxlength="100" />
<label id='cpf' name='cpf'>CPF:</label>
<input id="v_cpf" name="v_cpf" type="text"/>
<label id='celular' name='celular'>Tel:</label>
<input id="v_celular" name="v_celular" type="text"/>
<label id='cnh' name='cnh'>CNH:</label>
<input id="v_cnh" name="v_cnh" type="text"/>
<label id='origem' name='origem'>Origem:</label>
<input style="padding-left: 10px;" id="v_origem" name="v_origem" type="text" maxlength="100" />
<label id='destino' name='destino'>Destino:</label>
<input style="padding-left: 10px;" id="v_destino" name="v_destino" type="text" maxlength="100" />
<label id='rota' name='rota'>Rota:</label>
<input style="padding-left: 10px;" id="v_rota" name="v_rota" type="text" maxlength="100" />
<label id='material' name='material'>Material:</label>
<input style="padding-left: 10px;" id="v_material" name="v_material" type="text" maxlength="100" />
<label id='estoque' name='estoque'>Estoque:</label>
<input style="padding-left: 10px;" id="v_estoque" name="v_estoque" type="text" maxlength="100" />
<label id='previsao_carga' name='previsao_carga'>Data da Previsão Carga:</label>
<input style="padding-left: 10px;" id="v_previsao_carga" name="v_previsao_carga" type="text" maxlength="100" />
<label id='n_previsao_carga' name='n_previsao_carga'>N° Previsão Carga:</label>
<input style="padding-left: 10px;" id="v_n_previsao_carga" name="v_n_previsao_carga" type="text" maxlength="100" />
<label id='n_id_gscs' name='n_id_gscs'>N° ID GSCS:</label>
<input style="padding-left: 10px;" id="v_n_id_gscs" name="v_n_id_gscs" type="text" maxlength="100" />
<label id='n_ticket' name='n_ticket'>N° Ticket SAP:</label>
<input style="padding-left: 10px;" id="v_n_ticket" name="v_n_ticket" type="text" maxlength="100" />
<label id='n_nomination' name='n_nomination'>Nomination:</label>
<input style="padding-left: 10px;" id="v_n_nomination" name="v_n_nomination" type="text" maxlength="100" />
<label id='peso_bruto' name='peso_bruto'>Peso Bruto:</label>
<input style="padding-left: 10px;" id="v_peso_bruto" name="v_peso_bruto" type="text" maxlength="100" />
<label id='peso_liquido' name='peso_liquido'>Peso Liquido:</label>
<input style="padding-left: 10px;" id="v_peso_liquido" name="v_peso_liquido" type="text" maxlength="100" />
<label id='tara' name='tara'>Tara:</label>
<input style="padding-left: 10px;" id="v_tara" name="v_tara" type="text" maxlength="100" />
<label id='tempo_deslocamento' name='tempo_deslocamento'>Tempo Deslocamento:</label>
<input style="padding-left: 10px;" id="v_tempo_deslocamento" name="v_tempo_deslocamento" type="text" maxlength="100" />
<label id='tipo_conjunto' name='tipo_conjunto'>Tipo Conjunto:</label>
<input style="padding-left: 10px;" id="v_tipo_conjunto" name="v_tipo_conjunto" type="text" maxlength="100" />
<label id='operador' name='operador'>Operador Carregamento:</label>
<input style="padding-left: 10px;" id="v_operador" name="v_operador" type="text" maxlength="100" />
<label id='placa_carreta' name='placa_carreta'>Placa Carreta:</label>
<input style="padding-left: 10px;" id="v_placa_carreta" name="v_placa_carreta" type="text" maxlength="100" />
<label id='tipo_carreta' name='tipo_carreta'>Tipo Carreta:</label>
<input style="padding-left: 10px;" id="v_tipo_carreta" name="v_tipo_carreta" type="text" maxlength="100" />
<label id='trasnportadora_carreta' name='trasnportadora_carreta'>Transp. Carreta:</label>
<input style="padding-left: 10px;" id="v_trasnportadora_carreta" name="v_trasnportadora_carreta" type="text" maxlength="100" />






<label id='placa_cavalo' name='placa_cavalo'>Placa Cavalo:</label>
<input style="padding-left: 10px;" id="v_placa_cavalo" name="v_placa_cavalo" type="text" maxlength="100" />
<label id='tipo_cavalo' name='tipo_cavalo'>Tipo Cavalo:</label>
<input style="padding-left: 10px;" id="v_tipo_cavalo" name="v_tipo_cavalo" type="text" maxlength="100" />
<label id='trasnportadora_cavalo' name='trasnportadora_cavalo'>Transp. Cavalo:</label>
<input style="padding-left: 10px;" id="v_trasnportadora_cavalo" name="v_trasnportadora_cavalo" type="text" maxlength="100" />
</fieldset>

<script>

function pesquisar(tag_ou_placa)
{
 var link_tag_ou_placa = document.getElementById('tag_ou_placa').value;
 if(link_tag_ou_placa == "")
 {
  alert('Atenção: \nFavor inserir uma tag ou placa para realizar a consulta!');
 }
 else
 {
  var tag_ou_placa = link_tag_ou_placa;//"442001000000000000000419";   
  //var url = "https://gerdauyardserviced90aa8583.us2.hana.ondemand.com/gerdau-yard-service/rest/schedule/getScheduleDetailByTruck?tagOrPlate="+tag_ou_placa; QUALIDADE
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
 
 }   
}

function validar_dados(mensagem)
{
 if(mensagem == '{"errorCode":"java.lang.NullPointerException","errorMsg":"Erro não mapeado"}')
 {
 alert('Atenção: \nDados inseridos estão incorretos ou não foi localizado no sistema!')
 statusProcesso= '-';
    if(statusProcesso== ""){statusProcesso= "-";}
    var link_status = window.document.getElementById('v_status');
    link_status.value = statusProcesso;
    if(link_status.value == 'Concluído')
    {
        link_status.style.backgroundColor ='rgb(0,220,0)';
    }
    else if(link_status.value == 'Cancelado')
    {
        link_status.style.backgroundColor ='rgb(192,192,192)';
    }
    else
    {
        link_status.style.backgroundColor ='rgb(255,255,0)';
    }

    celular = "-";
    window.document.getElementById('v_celular').value = celular;

    cnh= "-";
    window.document.getElementById('v_cnh').value = cnh;

    cpf= "-";
    window.document.getElementById('v_cpf').value = cpf;

    nome= "-";
    window.document.getElementById('v_motorista').value = nome;

    origem= "-";
    window.document.getElementById('v_origem').value = origem;
     
    destino= "-";
    window.document.getElementById('v_destino').value = destino;

    rota= "-";
    window.document.getElementById('v_rota').value = rota;
    
    material= "-";
    window.document.getElementById('v_material').value = material;

    estoque= "-";
    window.document.getElementById('v_estoque').value = estoque;

    dataPrevisaoCarga= "-";
    window.document.getElementById('v_previsao_carga').value = dataPrevisaoCarga;

    idProcessoGagf= "-";
    window.document.getElementById('v_n_previsao_carga').value = idProcessoGagf;

    idProcessoGscs= "-";
    window.document.getElementById('v_n_id_gscs').value = idProcessoGscs;

    window.document.getElementById('v_n_ticket').value = '-';
    
    nomination= "-";
    window.document.getElementById('v_n_nomination').value = nomination;

    pesoBruto= "-";
    window.document.getElementById('v_peso_bruto').value = pesoBruto;

    pesoMaterialCarregado= "-";
    window.document.getElementById('v_peso_liquido').value = pesoMaterialCarregado;

    window.document.getElementById('v_tara').value = '-';
    
    tempoDeslocamento= "-";
    window.document.getElementById('v_tempo_deslocamento').value = tempoDeslocamento;

    tipoConjunto= "-";
    window.document.getElementById('v_tipo_conjunto').value = tipoConjunto;

    window.document.getElementById('v_operador').value = '-';


    placaCarreta= "-";
    estadoCarreta= "-";
    tipoCarreta= "-";
    transportadoraCarreta= "-";
    window.document.getElementById('v_placa_carreta').value = placaCarreta +' / '+ estadoCarreta ;

    placaCavalo= "-";
    estadoCavalo= "-";
    tipoCavalo= "-";
    transportadoraCavalo= "-";
    window.document.getElementById('v_placa_cavalo').value = placaCavalo +' / '+ estadoCavalo ;

    window.document.getElementById('v_tipo_carreta').value = tipoCarreta;
    window.document.getElementById('v_trasnportadora_carreta').value= transportadoraCarreta;
    window.document.getElementById('v_tipo_cavalo').value = tipoCavalo;
    window.document.getElementById('v_trasnportadora_cavalo').value = transportadoraCavalo;


 }
 else
 { 
    const obj = JSON.parse(mensagem);
    

    statusProcesso= obj.scheduleDetail.statusProcesso;
    if(statusProcesso== ""){statusProcesso= "-";}
    var link_status = window.document.getElementById('v_status');
    link_status.value = statusProcesso;
    if(link_status.value == 'Concluído')
    {
        link_status.style.backgroundColor ='rgb(0,220,0)';
    }
    else if(link_status.value == 'Cancelado')
    {
        link_status.style.backgroundColor ='rgb(192,192,192)';
    }
    else
    {
        link_status.style.backgroundColor ='rgb(255,255,0)';
    }






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
    window.document.getElementById('v_celular').value = celular;

    cnh= obj.scheduleDetail.cnh;
    if(cnh== ""){cnh= "-";}
    window.document.getElementById('v_cnh').value = cnh;

    cpf= obj.scheduleDetail.cpf;
    if(cpf== ""){cpf= "-";}
    window.document.getElementById('v_cpf').value = cpf;

    nome= obj.scheduleDetail.nome;
    if(nome== ""){nome= "-";}
    window.document.getElementById('v_motorista').value = nome;

    origem= obj.scheduleDetail.origem;
    if(origem== ""){origem= "-";}
    window.document.getElementById('v_origem').value = origem;

    destino= obj.scheduleDetail.destino;
    if(destino== ""){destino= "-";}
    window.document.getElementById('v_destino').value = destino;

    rota= obj.scheduleDetail.rota;
    if(rota== ""){rota= "-";}
    window.document.getElementById('v_rota').value = rota;
    
    material= obj.scheduleDetail.material;
    if(material== ""){material= "-";}
    window.document.getElementById('v_material').value = material;

    estoque= obj.scheduleDetail.estoque;
    if(estoque== ""){estoque= "-";}
    window.document.getElementById('v_estoque').value = estoque;

    dataPrevisaoCarga= obj.scheduleDetail.dataPrevisaoCarga;
    if(dataPrevisaoCarga== ""){dataPrevisaoCarga= "-";}
    window.document.getElementById('v_previsao_carga').value = dataPrevisaoCarga;

    idProcessoGagf= obj.scheduleDetail.idProcessoGagf;
    if(idProcessoGagf== ""){idProcessoGagf= "-";}
    window.document.getElementById('v_n_previsao_carga').value = idProcessoGagf;

    idProcessoGscs= obj.scheduleDetail.idProcessoGscs;
    if(idProcessoGscs== ""){idProcessoGscs= "-";}
    window.document.getElementById('v_n_id_gscs').value = idProcessoGscs;

    window.document.getElementById('v_n_ticket').value = '-';
    
    nomination= obj.scheduleDetail.nomination;
    if(nomination== ""){nomination= "-";}
    window.document.getElementById('v_n_nomination').value = nomination;

    pesoBruto= obj.scheduleDetail.pesoBruto;
    if(pesoBruto== ""){pesoBruto= "-";}else{pesoBruto = pesoBruto + ' KG';}
    window.document.getElementById('v_peso_bruto').value = pesoBruto;

    pesoMaterialCarregado= obj.scheduleDetail.pesoMaterialCarregado;
    if(pesoMaterialCarregado== ""){pesoMaterialCarregado= "-";}else{pesoMaterialCarregado = pesoMaterialCarregado + ' KG';}
    window.document.getElementById('v_peso_liquido').value = pesoMaterialCarregado;

    window.document.getElementById('v_tara').value = '-';
    
    tempoDeslocamento= obj.scheduleDetail.tempoDeslocamento;
    if(tempoDeslocamento== ""){tempoDeslocamento= "-";}
    window.document.getElementById('v_tempo_deslocamento').value = tempoDeslocamento;

    tipoConjunto=obj.scheduleDetail.tipoConjunto;
    if(tipoConjunto== ""){tipoConjunto= "-";}
    window.document.getElementById('v_tipo_conjunto').value = tipoConjunto;

    window.document.getElementById('v_operador').value = '-';


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

   if(tipoCarreta.includes('Cavalo'))
   {
    //Esta invertido resposta do GAGF
    //Preciso alterar aqui
    antes_tipoCarreta = tipoCarreta;
    antes_tipoCavalo = tipoCavalo;
    antes_placaCavalo = placaCavalo;
    antes_placaCarreta = placaCarreta;

    //Agora inverto
    tipoCarreta = antes_tipoCavalo;
    tipoCavalo = antes_tipoCarreta;
    placaCarreta = antes_placaCavalo;
    placaCavalo = antes_placaCarreta;
   }




    window.document.getElementById('v_placa_cavalo').value = placaCavalo +' / '+ estadoCavalo ;
    window.document.getElementById('v_placa_carreta').value = placaCarreta +' / '+ estadoCarreta ;

    window.document.getElementById('v_tipo_carreta').value = tipoCarreta;
    window.document.getElementById('v_trasnportadora_carreta').value= transportadoraCarreta;
    window.document.getElementById('v_tipo_cavalo').value = tipoCavalo;
    window.document.getElementById('v_trasnportadora_cavalo').value = transportadoraCavalo;

    }
}
</script>












<h3 id="lb_desenvolvedor">Desenvolvido por: Bruno Gonçalves </h3>



</body>

<script>

</script>

<style>


#lb_titulo{
    margin-left: 0px;
    position: absolute;
    left: 70px;
    top: 1%;
}
#lb_servidor{
    margin-left: 0px;
    position: absolute;
    color: rgb(2,20,200);
    left: 70px;
    top: 6%;
}

#formulario1_1{
    position: absolute;
    left:70px;
    top: 15%;
    margin-left:0px;
    padding-top:10px;
    padding-bottom:0px;
    padding-left:20px;
    width:1190px;
    height: 10%;
    text-align:left;
    border-radius: 6px!important;
    border-color: #191970;
    border-style: solid!important;
}
LABEL#status{
    position: absolute;
    left:64%;
    top: 7%;
    margin-left:20px;
    text-align:left;
}
INPUT#v_status{
    position: absolute;
    left:77%;
    top: 6%;
    padding-left:10px;
    width: 18%;
    height: 30%;
    text-align:left;
}








#formulario1{
    position: absolute;
    left:70px;
    top: 30%;
    margin-left:0px;
    padding-top:20px;
    padding-bottom:20px;
    padding-left:20px;
    width:1190px;
    height: 50%;
    text-align:left;
    border-radius: 6px!important;
    border-color: #191970;
    border-style: solid!important;
}
LABEL#motorista{
    position: absolute;
    left:2%;
    top: 7%;
    text-align:left;
}
INPUT#v_motorista{
    position: absolute;
    left:8%;
    top: 6%;
    padding-left:10px;
    width:40%;
    height: 5%;
    text-align:left;
}
LABEL#cpf{
    position: absolute;
    left:51%;
    top: 7%;
    margin-left:20px;
    text-align:left;
}
INPUT#v_cpf{
    position: absolute;
    left:56%;
    top: 6%;
    padding-left:10px;
    width: 8%;
    height: 5%;
    text-align:left;
}
LABEL#celular{
    position: absolute;
    left:67%;
    top: 7%;
    text-align:left;
}
INPUT#v_celular{
    position: absolute;
    left:70%;
    top: 6%;
    padding-left:8px;
    width: 12%;
    height: 5%;
    text-align:left;
}

LABEL#cnh{
    position: absolute;
    left:84%;
    top: 7%;
    text-align:left;
}
INPUT#v_cnh{
    position: absolute;
    left:88%;
    top: 6%;
    padding-left:10px;
    width: 9%;
    height: 5%;
    text-align:left;
}


LABEL#origem{
    position: absolute;
    left:2%;
    top: 16%;
    text-align:left;
}
INPUT#v_origem{
    position: absolute;
    left:8%;
    top: 15%;
    padding-left:10px;
    width:25%;
    height: 5%;
    text-align:left;
}

LABEL#destino{
    position: absolute;
    left:37%;
    top: 16%;
    text-align:left;
}
INPUT#v_destino{
    position: absolute;
    left:43%;
    top: 15%;
    padding-left:10px;
    width:25%;
    height: 5%;
    text-align:left;
}

LABEL#rota{
    position: absolute;
    left:72%;
    top: 16%;
    text-align:left;
}
INPUT#v_rota{
    position: absolute;
    left:76%;
    top: 15%;
    padding-left:10px;
    width:21%;
    height: 5%;
    text-align:left;
}

LABEL#material{
    position: absolute;
    left:2%;
    top: 25%;
    text-align:left;
}
INPUT#v_material{
    position: absolute;
    left:8%;
    top: 24%;
    padding-left:10px;
    width:30%;
    height: 5%;
    text-align:left;
}

LABEL#estoque{
    position: absolute;
    left:42%;
    top: 25%;
    text-align:left;
}
INPUT#v_estoque{
    position: absolute;
    left:48%;
    top: 24%;
    padding-left:10px;
    width:12%;
    height: 5%;
    text-align:left;
}

LABEL#previsao_carga{
    position: absolute;
    left:64%;
    top: 25%;
    text-align:left;
}
INPUT#v_previsao_carga{
    position: absolute;
    left:78%;
    top: 24%;
    padding-left:10px;
    width:19%;
    height: 5%;
    text-align:left;
}

LABEL#n_previsao_carga{
    position: absolute;
    left:2%;
    top: 34%;
    text-align:left;
}
INPUT#v_n_previsao_carga{
    position: absolute;
    left:13%;
    top: 33%;
    padding-left:10px;
    width:10%;
    height: 5%;
    text-align:left;
}

LABEL#n_id_gscs{
    position: absolute;
    left:27%;
    top: 34%;
    text-align:left;
}
INPUT#v_n_id_gscs{
    position: absolute;
    left:35%;
    top: 33%;
    padding-left:10px;
    width:10%;
    height: 5%;
    text-align:left;
}
LABEL#n_ticket{
    position: absolute;
    left:48%;
    top: 34%;
    text-align:left;
}
INPUT#v_n_ticket{
    position: absolute;
    left:57%;
    top: 33%;
    padding-left:10px;
    width:10%;
    height: 5%;
    text-align:left;
}

LABEL#n_nomination{
    position: absolute;
    left:72%;
    top: 34%;
    text-align:left;
}
INPUT#v_n_nomination{
    position: absolute;
    left:80%;
    top: 33%;
    padding-left:10px;
    width:17%;
    height: 5%;
    text-align:left;
}

LABEL#peso_bruto{
    position: absolute;
    left:2%;
    top: 44%;
    text-align:left;
}
INPUT#v_peso_bruto{
    position: absolute;
    left:9%;
    top: 43%;
    padding-left:10px;
    width:10%;
    height: 5%;
    text-align:left;
}

LABEL#peso_liquido{
    position: absolute;
    left:24%;
    top: 44%;
    text-align:left;
}
INPUT#v_peso_liquido{
    position: absolute;
    left:32%;
    top: 43%;
    padding-left:10px;
    width:10%;
    height: 5%;
    text-align:left;
}

LABEL#tara{
    position: absolute;
    left:47%;
    top: 44%;
    text-align:left;
}
INPUT#v_tara{
    position: absolute;
    left:51%;
    top: 43%;
    padding-left:10px;
    width:10%;
    height: 5%;
    text-align:left;
}


LABEL#tempo_deslocamento{
    position: absolute;
    left:65%;
    top: 44%;
    text-align:left;
}
INPUT#v_tempo_deslocamento{
    position: absolute;
    left:78%;
    top: 43%;
    padding-left:10px;
    width:19%;
    height: 5%;
    text-align:left;
}



LABEL#tipo_conjunto{
    position: absolute;
    left:2%;
    top: 54%;
    text-align:left;
}
INPUT#v_tipo_conjunto{
    position: absolute;
    left:11%;
    top: 53%;
    padding-left:10px;
    width: 23%;
    height: 5%;
    text-align:left;
}

LABEL#operador{
    position: absolute;
    left:37%;
    top: 54%;
    text-align:left;
}
INPUT#v_operador{
    position: absolute;
    left:51%;
    top: 53%;
    padding-left:10px;
    width: 33%;
    height: 5%;
    text-align:left;
}

LABEL#placa_carreta{
    position: absolute;
    left:2%;
    top: 64%;
    text-align:left;
}
INPUT#v_placa_carreta{
    position: absolute;
    left:11%;
    top: 64%;
    padding-left:10px;
    width: 8%;
    height: 5%;
    text-align:left;
}

LABEL#tipo_carreta{
    position: absolute;
    left:22%;
    top: 64%;
    text-align:left;
}
INPUT#v_tipo_carreta{
    position: absolute;
    left:30%;
    top: 63%;
    padding-left:10px;
    width: 20%;
    height: 5%;
    text-align:left;
}
LABEL#trasnportadora_carreta{
    position: absolute;
    left:53%;
    top: 64%;
    text-align:left;
}
INPUT#v_trasnportadora_carreta{
    position: absolute;
    left:62%;
    top: 63%;
    padding-left:10px;
    width: 35%;
    height: 5%;
    text-align:left;
}


LABEL#placa_cavalo{
    position: absolute;
    left:2%;
    top: 74%;
    text-align:left;
}
INPUT#v_placa_cavalo{
    position: absolute;
    left:11%;
    top: 73%;
    padding-left:10px;
    width: 8%;
    height: 5%;
    text-align:left;
}



LABEL#tipo_cavalo{
    position: absolute;
    left:22%;
    top: 74%;
    text-align:left;
}
INPUT#v_tipo_cavalo{
    position: absolute;
    left:30%;
    top: 73%;
    padding-left:10px;
    width: 20%;
    height: 5%;
    text-align:left;
}
LABEL#trasnportadora_cavalo{
    position: absolute;
    left:53%;
    top: 74%;
    text-align:left;
}
INPUT#v_trasnportadora_cavalo{
    position: absolute;
    left:62%;
    top: 73%;
    padding-left:10px;
    width: 35%;
    height: 5%;
    text-align:left;
}










IMG#voltar{
    margin-left: 0px;
    position: absolute;
    left: 5px;
    top: 2%;
    width: 28px;
    height: 28px;
    cursor: pointer;

}
IMG#home{
    margin-left: 0px;
    position: absolute;
    left: 38px;
    top:  2%;
    width: 28px;
    height: 28px;
    cursor: pointer;

}


#lb_desenvolvedor{
    margin-left: 0px;
    position: absolute;
    left: 40%;
    top: 88%;
}


#conexao{
    margin-left: 0%;
    position: absolute;
    padding-left:1%;
    padding-top:1%;
    text-align:left;
    font: normal 18pt verdana;
    color:#ffffff;
    left: 3%;
    top: 0%;
    width:92.9%;
    height:3%;
    background-color:#29A1AB;
}
#colaborador{
    margin-left: 0%;
    position: absolute;
    padding-left:1%;
    padding-top:1%;
    text-align:left;
    font: normal 11pt verdana;
    color:#ffffff;
    left: 6%;
    top: -10%;
}
#funcao{
    margin-left: 0px;
    position: absolute;
    padding-left:10px;
    padding-top:5px;
    text-align:left;
    font: normal 11pt verdana;
    color:#ffffff;
    left: 75%;
    top: 5%;
}

INPUT#criptografia
{
    margin-left: 0px;
    position: absolute;
    padding-left:10px;
    padding-top:5px;
    text-align:left;
    width: 300px;
    font: normal 11pt verdana;
    color:#000000;
    left: 30%;
    top: 5%;

}
INPUT#criptografia2
{
    margin-left: 0px;
    position: absolute;
    padding-left:10px;
    padding-top:5px;
    text-align:left;
    width: 100px;
    font: normal 11pt verdana;
    color:#000000;
    left: 55%;
    top: 5%;

}

body{

}
html{
background: url("./images/tela_gerdau.png");
margin-top: -25px !important;
background-size: 100%;
}
</style>



</html>