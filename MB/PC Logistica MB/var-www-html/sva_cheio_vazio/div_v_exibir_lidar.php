<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src='https://cdn.plot.ly/plotly-2.16.1.min.js'></script>
</head>
<body>
<label id='titulo1' name='titulo1' >Representação Tridimensional LIDAR</label>
<div id="grafico_encerramentos" ></div> 
<div id="grafico_encerramentos2"></div> 
<?php
// 805: vazio
//819: agarrado
//817 : ok
//809 : excesso
$pesquisa_id = $_GET['id'];
$id_cheio_vazio = isset($_GET['id_cheio_vazio'])?$_GET['id_cheio_vazio']:'-';

$encontrado = 0;
$encontrado2 = 0;
$list = array();
$list2 = array();
include_once 'conexao_poste_balanca1.php';
$sql = $dbcon->query("SELECT * FROM dados_api_lidar WHERE id='$pesquisa_id'");
if(mysqli_num_rows($sql)>0)
{
 $dados = $sql->fetch_array();
 $surface_rows = $dados['num_linhas_matrix'];# Busca o Nome quando encontrar e coloca dentro do array, neste caso achará apenas 1 
 $surface_cols = $dados['num_colunas_matrix'];
 $list2 = $dados['plot_lidar'];
 $alerta = $dados['alerta'];
 $alerta2 = $dados['alerta2'];
 $dlc = $dados['dlc'];
 $dtc = $dados['dtc'];
 $tipo_veiculo = $dados['tipo_veiculo'];
 if($tipo_veiculo == "" || $tipo_veiculo == 'Nao identificado'){$tipo_veiculo = '-';}
 $condicao_veiculo = $dados['condicao_veiculo'];
 if($condicao_veiculo == "" || $condicao_veiculo == 'Nao identificado'){$condicao_veiculo = '-';}
 $data_leitura = $dados['data_leitura'];
 $hora_leitura = $dados['hora_leitura'];
 $encontrado = 1;
}
else
{
 $encontrado = 0;
}

if($encontrado == 1)
{
 include_once 'conexao_poste_balanca1_2.php';
 $sql = $dbcon->query("SELECT * FROM historico_display WHERE id_lidar='$pesquisa_id'");
 if(mysqli_num_rows($sql)>0)
 {
  $id_historico = $dados['id'];  
  $encontrado2 = 1;  
  $dados = $sql->fetch_array();
  $condicao2 = $dados['condicao2'];
  $gagf = $dados['gagf'];
  if($gagf =='-' || $gagf == ''){$gagf = '0000000';}
  $gscs = $dados['gscs'];
  if($gscs =='-' || $gscs == ''){$gscs = '0000000';}
  $material = $dados['material'];
  if($material =='-' || $material ==  ''){$material = 'Não identificado!';}
  $motorista = $dados['motorista'];
  if($motorista =='-' || $motorista ==  ''){$motorista = 'Não identificado!';}
  $destino = $dados['destino'];
  if($destino =='-' || $destino ==  ''){$destino = 'Não identificado!';}
  $ponto = $dados['ponto'];
  if($ponto =='-' || $ponto ==  ''){$ponto = 'Não identificado!';}
  if($ponto = 'mg')
  {
   $ponto = "MG030";
  }
  else if($ponto =='balanca')
  {
    $ponto = "Balança";
  }
 }
 else
 {
  $id_historico = '-';  
  $condicao2 = 'Não identificado!';
  $gagf = '0000000';
  $gscs = '0000000';
  $material = 'Não identificado!';
  $motorista = 'Não identificado!';
  $destino = 'Não identificado!';
  $ponto = 'Não identificado!';
 }

 // deixa rodar
 $list = unserialize($list2);
 //var_dump($test);
 //echo ("Numero Linhas = "). $surface_rows;
 //echo "</BR>";
 //echo ("Numero Colunas = "). $surface_cols;
 //echo "</BR>";
 //$linha = array(); //Array para montar a primeira linha e inserir na matrix recebida da SVA
 //array_push($linha,','); // Adiciono o primeiro indice como uma virgula, conforme exemplo plotly
 //for ($x = 1; $x <= $surface_cols; $x++){array_push($linha,strval(intval($x)-1));}//Crio os elementos em funcao do $surface_cols
 //array_unshift($list,$linha); // Insiro o arrei linha, que foi criada no inicio do array recebido da SVA
 $b = json_encode($list);
 ?>
 <script>
 var array = '<?php print $b ?>';
 array = JSON.parse(array);
 var b = array;
 var d = []; // Nao apagar, usa ele
 var v = []; // Nao apagar, usa ele
 var z_data=[ ]; // Nao apagar, usa ele
 var surface_rows = parseInt('<?php print $surface_rows ?>');
 var surface_cols = parseInt('<?php print $surface_cols ?>');
 for(a=0;a<surface_cols;a++)
 {
  for(i=0;i<surface_rows;i++)
  {
   v = b[i]
   d.push(v[surface_cols-a])        
  }
  z_data.push(d);
  d = [];
 }
 var data = [{
  z: z_data,
  type: 'contour',
  autocontour: false,
  contours: 
  {
   start: 0,
   end: 3300,
   size: 110
  },
  title: '',
  autosize: true,
  colorbar:
  {
   autotick: false,
   nticks: 30,
   range: [0, 4000],
  }
 }];
 var layout = {
  title: '',
  plot_bgcolor:"rgb(53,50,60)",
  paper_bgcolor:"rgb(53,50,60)",
  margin: {
   l: 35,
   r: 0,
   b: 100,
   t: 100,
  },
  height: 449,
  width: 669,
  font: 
  {
   size: 14,
   color: '#ffffff'
  },
  scene:{
   aspectmode: "manual",
   aspectratio: {
    x: 5, y: 1.8, z: 1.8,
   },
   xaxis: {
    nticks: 1,
    range: [0, 400],
    backgroundcolor: "rgb(53,50,60)",
    gridcolor: "rgb(53,50,60)",
    showbackground: true,
    zerolinecolor: "rgb(53,50,60)"
   },
   yaxis: {
    nticks: 1,
    range: [0, 60],
    backgroundcolor: "rgb(53,50,60)",
    gridcolor: "rgb(53,50,60)",
    showbackground: true,
    zerolinecolor: "rgb(53,50,60)"
   },
   zaxis: {
    nticks: 1,
    range: [0, 4000],
    backgroundcolor: "rgb(53,50,60)",
    gridcolor: "rgb(53,50,60)",
    showbackground: true,
    zerolinecolor: "rgb(53,50,60)"
   }},
  };
  var config = {
   toImageButtonOptions: {
    format: 'png', // one of png, svg, jpeg, webp
    filename: 'custom_image',
    height: 500,
    width: 700,
    scale: 1 // Multiply title/legend/axis/canvas sizes by this factor
   }
  };
  Plotly.newPlot('grafico_encerramentos', data, layout,config,{responsive: true} );
  var data = [{
   z: z_data,
   type: 'surface',
   showscale: true,
   colorbar:
   {
    autotick: false,
    nticks: 30,
    range: [0, 4000],
   }
  }];
  var layout = {
   title: '',
   height: 449,
   width: 630,
   font: 
   {
    size: 14,
    color: '#ffffff'
   },
   autosize: false,
   plot_bgcolor:"rgb(53,50,60)",
   paper_bgcolor:"rgb(53,50,60)",
   margin: {
    l: 0,
    r: 0,
    b: 0,
    t: 0,
   },
   scene:{
    aspectmode: "manual",
    aspectratio: {
    x: 3.5, y: 0.9, z: 0.8,
   },
   xaxis: {
    nticks: 1,
    range: [0, 400],
    backgroundcolor: "rgb(53,50,60)",
    gridcolor: "rgb(53,50,60)",
    showbackground: true,
    zerolinecolor: "rgb(53,50,60)"
   },
   yaxis: {
    nticks: 1,
    range: [0, 60],
    backgroundcolor: "rgb(53,50,60)",
    gridcolor: "rgb(53,50,60)",
    showbackground: true,
    zerolinecolor: "rgb(53,50,60)"
   },
   zaxis: {
    nticks: 1,
    range: [0, 4000],
    backgroundcolor: "rgb(53,50,60)",
    gridcolor: "rgb(53,50,60)",
    showbackground: true,
    zerolinecolor: "rgb(53,50,60)"
   }
  },
 };
 var config = {
  toImageButtonOptions: {
   format: 'png', // one of png, svg, jpeg, webp
   filename: 'custom_image',
   height: 500,
   width: 700,
   scale: 1 // Multiply title/legend/axis/canvas sizes by this factor
  },
 };
 Plotly.newPlot('grafico_encerramentos2', data, layout);
 </script>


<div id="grafico_encerramentos3">

<label id='id_lidar' name='id_lidar' >ID Lidar: <?php print $pesquisa_id ?></label>
<label id='id_historico' name='id_historico' >ID Historico: <?php print $id_historico ?></label>
<label id='id_cheio_vazio' name='id_cheio_vazio' >ID Cheio/Vazio: <?php print $id_cheio_vazio ?></label>
<label id='lb_data' name='lb_data' >Data Evento: <?php print $data_leitura ." " . $hora_leitura ?></label>
<label id='lb_alerta' name='lb_alerta' >Status Evento: <?php print $alerta ?></label>
<label id='lb_alerta2' name='lb_alerta2' >Status Evento2: <?php print $alerta2 ?></label>
<label id='lb_tipo_veiculo' name='lb_tipo_veiculo' >Tipo Veiculo: <?php print $tipo_veiculo ?></label>
<label id='lb_condicao_veiculo' name='lb_condicao_veiculo' >Condição Veiculo: <?php print $condicao_veiculo ?></label>
<label id='lb_dlc' name='lb_dlc' >DLC: <?php print $dlc ?></label>
<label id='lb_dtc' name='lb_dtc' >DTC: <?php print $dtc ?></label>
<label id='lb_motorista' name='lb_motorista' >Motorista: <?php print $motorista ?></label>
<label id='lb_destino' name='lb_destino' >Destino: <?php print $destino ?></label>
<label id='lb_material' name='lb_material' >Material: <?php print $material ?></label>
<label id='lb_gagf' name='lb_gagf' >GAGF: <?php print $gagf ?></label>
<label id='lb_gscs' name='lb_gscs' >GSCS: <?php print $gscs ?></label>
<label id='lb_status_processo' name='lb_status_processo' >Processo: <?php print $condicao2 ?></label>
<label id='lb_saida' name='lb_saida' >Saida pela: <?php print $ponto ?></label>
</div>
<?php
}
else
{
 $msg_erro = 'Erro, favor voltar e clicar novamente em "Imagem Lidar" '; 
?>
<div id="grafico_encerramentos3">
<label id='lb_info' name='lb_info' ><?php print $msg_erro ?></label>
</div>
<?php
}
?>
</div> 
</body>
<style>
    
LABEL#id_lidar
{
  position: absolute;
  left: 3%;
  top: 5%;
  font: normal 12pt verdana;
  color:	#FFFFFF;
}

LABEL#id_historico
{
  position: absolute;
  left: 15%;
  top: 5%;
  font: normal 12pt verdana;
  color:	#FFFFFF;
}
LABEL#id_cheio_vazio
{
  position: absolute;
  left: 30%;
  top: 5%;
  font: normal 12pt verdana;
  color:	#FFFFFF;
}
LABEL#lb_data
{
  position: absolute;
  left: 49%;
  top: 5%;
  font: normal 12pt verdana;
  color:	#FFFFFF;
}

LABEL#lb_status_processo
{
  position: absolute;
  left: 78%;
  top: 5%;
  font: normal 12pt verdana;
  color:	#FFFFFF;
}


LABEL#lb_motorista
{
  position: absolute;
  left: 3%;
  top: 26%;
  font: normal 12pt verdana;
  color:	#FFFFFF;
}
LABEL#lb_gagf
{
  position: absolute;
  left: 49%;
  top: 26%;
  font: normal 12pt verdana;
  color:	#FFFFFF;
}
LABEL#lb_destino
{
  position: absolute;
  left: 3%;
  top: 49%;
  font: normal 12pt verdana;
  color:	#FFFFFF;
}
LABEL#lb_gscs
{
  position: absolute;
  left: 49%;
  top: 49%;
  font: normal 12pt verdana;
  color:	#FFFFFF;
}

LABEL#lb_material
{
  position: absolute;
  left: 3%;
  top: 72%;
  font: normal 12pt verdana;
  color:	#FFFFFF;
}

LABEL#lb_saida
{
  position: absolute;
  left: 49%;
  top: 72%;
  font: normal 12pt verdana;
  color:	#FFFFFF;
}




























LABEL#lb_dlc
{
  position: absolute;
  left: 3%;
  top: 137%;
  font: normal 12pt verdana;
  color:	#FFFFFF;
}


LABEL#lb_dtc
{
  position: absolute;
  left: 20%;
  top: 137%;
  font: normal 12pt verdana;
  color:	#FFFFFF;
}


LABEL#lb_tipo_veiculo
{
  position: absolute;
  left: 3%;
  top: 159%;
  font: normal 12pt verdana;
  color:	#FFFFFF;
}

LABEL#lb_condicao_veiculo
{
  position: absolute;
  left: 20%;
  top: 159%;
  font: normal 12pt verdana;
  color:	#FFFFFF;
}

LABEL#lb_alerta
{
  position: absolute;
  left: 3%;
  top: 444%;
  font: normal 12pt verdana;
  color:	#FFFFFF;
}
LABEL#lb_alerta2
{
  position: absolute;
  left: 3%;
  top: 464%;
  font: normal 12pt verdana;
  color:	#FFFFFF;
}








LABEL#titulo1
{
  position: absolute;
  left: 21%;
  top: 2%;
  font: bold 30pt verdana;
  color:	#FFFFFF;
}

LABEL#lb_info
{
  position: absolute;
  left: 2%;
  top: 30%;
  font: bold 20pt verdana;
  color:	#FFFFFF;
}

DIV#grafico_encerramentos{
    margin-left: 0px;
    position: absolute;
    left: 1%;
    top: 32%;
    width: 49%;
    height: 60%;
    cursor: pointer;
    border-radius: 10px!important;
    border: 6px #000000 solid!important;
    background-color: rgb(53,50,60);

}
DIV#grafico_encerramentos2{
    padding-left: 0px;
    position: absolute;
    left: 51.5%;
    top: 32%;
    width: 46.5%;
    height: 60%;
    cursor: pointer;
    border-radius: 10px!important;
    border: 6px #000000 solid!important;
    background-color: rgb(53,50,60);
    

}
DIV#grafico_encerramentos3{
    padding-left: 0px;
    position: absolute;
    left: 1%;
    top: 12.3%;
    width: 97%;
    height: 17%;
    cursor: pointer;
    border-radius: 10px!important;
    border: 6px #000000 solid!important;
    background-color: rgb(53,50,60);
    color:#FFFFFF;
    

}
</style>
</html>
