<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
<script src="https://code.jquery.com/jquery-3.5.0.js"></script> 
</head>
<body>
<div id="dados_que_serao_convertidos" >
        <strong>Testando Converter HMTL para FOTO</strong><hr/>
        <table border= 1px; >
  <thead >
    <tr>
    	<th class="th1">Data</th>
    	<th class="th2">Nº GSCS</th>
    	<th class="th3">Placa</th>
        <th class="th4">Capacidade</th>
        <th class="th5">Bruto</th>
        <th class="th6">Assertividade</th>
        <th class="th7">Transportadora</th>
    </tr>
  </thead>
  <tbody>
    <tr>
    	<td class="th1">10/02/2020 09:33:33</td>
    	<td class="th2">1234567</td>
    	<td class="th3">OGH-1234/RJ</td>
        <td class="th4">41500</td>
        <td class="th5">41235</td>
        <td class="th6">92.33%</td>
        <td class="th7">SILVANO SANTOS DA ROCHA EIRELI</td>
    </tr>
    <tr>
    	<td class="th1">10/02/2020 09:33:33</td>
    	<td class="th2">1234567</td>
    	<td class="th3">OGH-1234/RJ</td>
        <td class="th4">41500</td>
        <td class="th5">41235</td>
        <td class="th6">92.33%</td>
        <td class="th7">SILVANO SANTOS DA ROCHA EIRELI</td>
    </tr><tr>
    	<td class="th1">10/02/2020 09:33:33</td>
    	<td class="th2">1234567</td>
    	<td class="th3">OGH-1234/RJ</td>
        <td class="th4">41500</td>
        <td class="th5">41235</td>
        <td class="th6">92.33%</td>
        <td class="th7">SILVANO SANTOS DA ROCHA EIRELI</td>
    </tr><tr>
    	<td class="th1">10/02/2020 09:33:33</td>
    	<td class="th2">1234567</td>
    	<td class="th3">OGH-1234/RJ</td>
        <td class="th4">41500</td>
        <td class="th5">41235</td>
        <td class="th6">92.33%</td>
        <td class="th7">SILVANO SANTOS DA ROCHA EIRELI</td>
    </tr>
    
  </tbody>
</table>

        </p>
    </div>
    <input id="btn_ver1" type="button" value="Ver_Imagem" onclick='clicou_ver();'/>
    <input id="btn_Visualizar_Imagem" type="button" value="Visualisar" hidden='hidden'/>
    <a id="btn_Baixar_Arquivo1" href="#" onclick='clicou_baixar();'>Download</a>
    <a id="btn_Baixar_Arquivo" href="#" >Download</a>
    <br/>
    <h3>Preview :</h3>
    <div id="div_que_exibira_foto">
    </div>
    <?php
    error_reporting(0);
    unlink('./upload/baixando.png'); 
    ?>

<script>
 function clicou_ver()
 {
  $("#btn_Visualizar_Imagem").click();
 } // Fecha function clicou_ver

function clicou_baixar()
{
    var element = $("#dados_que_serao_convertidos"); // global variable
    var getCanvas; // global variable

    var imgageData = getCanvas.toDataURL("image/png");
    var nome_arquivo = 'baixando'+'.png';
    var newData = imgageData.replace(/^data:image\/png/, "data:application/octet-stream");
    $("#btn_Baixar_Arquivo").attr("download", nome_arquivo).attr("href", newData);    

}


$(document).ready(function(){

	
var element = $("#dados_que_serao_convertidos"); // global variable
var getCanvas; // global variable
 
    $("#btn_Visualizar_Imagem").on('click', function () {
         html2canvas(element, {
         onrendered: function (canvas) {
                $("#div_que_exibira_foto").append(canvas);
                getCanvas = canvas;
             }
        
        });
        
    });

	$("#btn_Baixar_Arquivo").on('click', function () {
               
        var imgageData = getCanvas.toDataURL("image/png");
        var nome_arquivo = 'baixando'+'.png';
        var newData = imgageData.replace(/^data:image\/png/, "data:application/octet-stream");
        $("#btn_Baixar_Arquivo").attr("download", nome_arquivo).attr("href", newData);
    
	});

});

function verificar_emails()
{
 alert('envia o email2');
   $.ajax({
           url: 'email.php',
           type: 'GET',
           dataType: 'html',
           data: 'valor=Bruno',
           cache: false,
           processData: false,
           contentType: false,
           timeout: 8000,
           success: function(resultado){
           //$("#resposta").html(resultado);
           }
       });
} // Fecha verificar emails

//setTimeout("location.reload(true);",10000); // recarrega a pagina em 5 segundos




</script>
</body>
</html>
             