<!DOCTYPE html>
<html>
  <head>
<script type="text/javascript" src="./charts_colunamix.js"></script>
<script type="text/javascript" src="./charts_pizza.js"></script>
    

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    


    var reader = "Entrada CO";
    var quantidade = 6;
    var cor_azul = "#00008B";
    var cor_vermelho = "#FF6347";

    function drawChart() 
    {
     var data = google.visualization.arrayToDataTable([
      ["Local", "Carretas", { role: "style" } ],
      [reader, quantidade, cor_azul],
      ["Controles\n Acessos \n( 1 , 2 , 3 )", 10, cor_vermelho],
      ["Controles\n Acessos\n Frota Cativa", 2, cor_azul],
      ["Pátios\n Carregamento", 3, cor_azul],
      ["Balanças", 2, cor_azul],
      ["Saida CO\n ( 1 , 2 )", 6, cor_azul],
      ["Entrada BH", 2, cor_azul],
      ["Saída BH", 0, cor_azul],
     ]);


     view = new google.visualization.DataView(data);
     view.setColumns([0, 1,{ calc: "stringify",sourceColumn: 1,type: "string",role: "annotation" },2]);

      var options = {
        title: "Carregamento Várzea do Lopes",
        bar: {groupWidth: "95%"}, // Espessura da coluna
        legend: { position: "none" },
        backgroundColor: '#E4E4E4',
        
        
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("grafico_coluna"));
      chart.draw(view, options); // cria o grafico com opções
  }
  </script>

</head>
<div id="conexao" hidden="hidden">
<label id="colaborador"></label>
<label id="funcao"></label>

<input type="text" name="criptografia" id="criptografia" value="ssss" hidden="hidden"/>
<input type="text" name="criptografia2" id="criptografia2" value="ssss" hidden="hidden"/>
</div>
<?php
// Busca o usuario passado e verifica no sistema
$usuario = "";
$tipo = "";
$criptografia = "";
$usuario_criptografado = "";
include_once 'conexao2.php';
$complemento = $_GET['complemento'];
$check = $_GET['check'];
$registro = (floatval($complemento))/1.5;
$nome = "";
// Desfazendo a criptografia
for ($i=0; $i < strlen($check)-1; $i+=2)
{
 $nome .= chr(hexdec($check[$i].$check[$i+1]));
}

$sql = $dbcon->query("SELECT * FROM pessoas WHERE registro='$registro' AND nome='$nome'");
if(mysqli_num_rows($sql)>0){
while($dados = $sql->fetch_array()){
$usuario = $dados['nome'];# Busca o Nome quando encontrar e coloca dentro do array, neste caso achará apenas 1
$tipo = $dados['tipo_usuario'];
$criptografia = $dados['criptografia'];
}
// deixa rodar
?>
<script>
var usuario = window.document.getElementById('colaborador');
var colaborador = "<?php print $usuario ?>";
usuario.innerHTML = "Usuario : "  + colaborador;
var lfuncao = window.document.getElementById('funcao');
var funcao = "<?php print $tipo ?>";
lfuncao.innerHTML = "Perfil : " + funcao;
var lusuario_criptografado = "<?php print $check ?>";
var link_criptografia = window.document.getElementById('criptografia');
link_criptografia.value = lusuario_criptografado;
var lcriptografia = "<?php print $criptografia ?>";
var link_criptografia2 = window.document.getElementById('criptografia2');
link_criptografia2.value = lcriptografia;
</script>
<?php


}else{
?>
<script language="JavaScript">
//window.Notification="Senha Incorreta!";
window.location="login.php";
</script>
<?php
}
?>

<div id="grafico_coluna"></div>
<img id="voltar" src="./images/btn_voltar.PNG" onclick="javascript: location.href=`menu_ccl_vl.php?complemento=${criptografia2.value}&check=${criptografia.value}`;"/>

<img id="transito" src="./images/btn_avancar.PNG" />
<label id="info_transito">Em trânsito</label>
<label id="info2_transito">12</label>
<style>
IMG#voltar{
    margin-left: 0px;
    position: absolute;
    left: 5px;
    top: 5px;
    width: 28px;
    height: 28px;
    cursor: pointer;

}
IMG#transito{
    margin-left: 0px;
    position: absolute;
    left: 1220px;
    top: 200px;
    width: 80px;
    height: 80px;
    cursor: pointer;

}
Label#info_transito{
    margin-left: 0px;
    position: absolute;
    font: bold 15pt Times;
    color: black;
    background-color: none;
    left: 1205px;
    top: 170px;   
}
Label#info2_transito{
    margin-left: 0px;
    position: absolute;
    font: bold 25pt Times;
    color: black;
    background-color: none;
    left: 1245px;
    top: 290px;   
}
#grafico_coluna{
    margin:0px;
    padding:0px;
    position: absolute;
    left: -140px;
    top: -30px;
    width: 1500px;
    height: 600px;
    
}

body{
    background-color: #E4E4E4;
}
</style>

</body>
</html>