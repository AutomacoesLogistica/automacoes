<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    


    var quantidade_entrada_pires = 0;
    var quantidade_saida_pires = 0;
    
    var quantidade_entrada_utmii = 0;
    var quantidade_saida_utmii = 0;
    
    var quantidade_abertura1 = 0;
    var quantidade_abertura2 = 0;
    
    var quantidade_entrada_carregamento = 0;
    var quantidade_amostragem = 0;
    
    var quantidade_saida_mg030 = 0;
    
    
    
    var cor_azul = "#00008B";
    var cor_vermelho = "#FF6347";
    
    function drawChart() 
    {
     var data = google.visualization.arrayToDataTable([
      ["Local", "Carretas", { role: "style" } ],
      ["Pires", quantidade_entrada_pires, cor_azul],
      ["Entrada UTMII", quantidade_entrada_utmii, cor_azul],
      ["Abertura I", quantidade_abertura1, cor_azul],
      ["Abertura II", quantidade_abertura2, cor_azul],
      ["Patio Produto", quantidade_entrada_carregamento, cor_azul],
      ["Amostragem", quantidade_amostragem, cor_azul],
      ["Saida UTMII", quantidade_saida_utmii, cor_azul],
      ["Saida Pires", quantidade_saida_pires, cor_azul],
      ["Saida MG-030", quantidade_saida_mg030, cor_azul]
      
     ]);


     view = new google.visualization.DataView(data);
     view.setColumns([0, 1,{ calc: "stringify",sourceColumn: 1,type: "string",role: "annotation" },2]);

      var options = {
        title: "Carregamento Miguel Burnier",
        width: 1300,
        height: 700,
        bar: {groupWidth: "95%"}, // Espessura da coluna
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("grafico_coluna"));
      chart.draw(view, options); // cria o grafico com opções
  }
  </script>


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


<div id="grafico_coluna" style="width: 900px; height: 300px;"></div>
<img id="voltar" src="./images/btn_voltar.PNG" id="voltar" onclick="javascript: location.href=`menu_ccl_mb.php?complemento=${criptografia2.value}&check=${criptografia.value}`;"/>

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
</style>