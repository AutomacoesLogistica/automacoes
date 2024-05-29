<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
 
    <?php
    error_reporting(0);
     $tag_carreta = '';
     date_default_timezone_set('America/Sao_Paulo');
     $data = date('d/m/Y');
     $hora = date('H:i:s');
     $mensagem2 = explode('/',$data);
     $mensagem2 = $mensagem2[2].'/'.$mensagem2[1].'/'.$mensagem2[0];
     $data_agora = $mensagem2 . ' ' . $hora;  
     echo($data_agora);    
     echo'</BR>';
     $tag = isset($_GET['epc'])?$_GET['epc']:'vazio';
     $equipamento = substr($tag,0,6);
     if($equipamento == '442002')
     {
      $tag_cavalo = 'vazio';
      $tag_carreta = $tag;
     }
     else if ($equipamento == '442001')
     {
      $tag_carreta = 'vazio';
      $tag_cavalo = $tag;
     }
    else
    {
     $equipamento = '';
    }
     $encontrados_dashboard = 0;
     $encontrados_historico = 0;
     $id_banco_dashboard = 0;
     $id_banco_historico = 0;
     $valor_ponto = 0;


     //echo ($equipamento);
    if($tag_carreta != 'vazio') // Ja busco pela tag da carreta
    {

     print('</BR>');
     print('Buscando por tag de carreta! - Tag: ' .$tag_carreta);
     print('</BR>');
     // Agora conecto no banco e busco os dados
     include_once 'conexao_dashboard.php';
     $sql = $dbcon->query("SELECT * FROM dashboard WHERE epc_carreta='$tag_carreta' AND (tipo='Entrada') ORDER BY id DESC LIMIT 1");
     if(mysqli_num_rows($sql)>0)
     {
      while($dados = $sql->fetch_array())
      { 
       $id_banco_dashboard = $dados['id'];
       $encontrados_dashboard = 1;
	   echo('ID no banco é '. $id_banco_dashboard);
      }
     } // Fecho if do banco
     else
     {
	  $encontrados_dashboard = -2;
       //TEM QUE CRIAR NO BANCO POIS DEIXOU DE LER NA ENTRADA POR ALGUM MOTIVO!






       //FALTA CRIAR ESTA PARTE







      }
        
     
     
     // Agora conecto no banco historico e busco os dados
     include_once 'conexao_dashboard.php';
     $sql = $dbcon->query("SELECT * FROM historico WHERE epc_carreta='$tag_carreta' AND (v_status!='Controle Acesso' AND v_status!='Saiu da Planta' AND $encontrados_dashboard != 0) ORDER BY id DESC LIMIT 1");
     if(mysqli_num_rows($sql)>0)
     {
      while($dados = $sql->fetch_array())
      { 
       $id_banco_historico = $dados['id'];
       $valor_ponto = intval($dados['valor_ponto']);
       $encontrados_historico = 1;
      }
     } // Fecho if do banco
     else
     {
       //TEM QUE CRIAR NO BANCO POIS DEIXOU DE LER NA ENTRADA POR ALGUM MOTIVO!
 
 
 
 
 
 
       //FALTA CRIAR ESTA PARTE
 
     }
 
 
 
 
 
 
 
 
  
    } // Fecha if carreta

    else if ($tag_cavalo != 'vazio')
    {
     print('</BR>');
     print('Buscando por tag de cavalo! - Tag: ' .$tag_cavalo);
     print('</BR>');
     
     // Agora conecto no banco e busco os dados
     include_once 'conexao_dashboard.php';
     $sql = $dbcon->query("SELECT * FROM dashboard WHERE epc_cavalo='$tag_cavalo' AND (tipo='Entrada') ORDER BY id DESC LIMIT 1");
     if(mysqli_num_rows($sql)>0)
     {
      while($dados = $sql->fetch_array())
      { 
       $id_banco_dashboard = $dados['id'];
       $encontrados_dashboard = 1;
      }
     } // Fecho if do banco
     else
     {
	  $encontrados_dashboard = -3; // ainda a decider se vou tratar ou nao
	  
       //Não encontrou, falta criar o historico para ele, pois faltou leitura na entrada






     }
     // Agora conecto no banco historico e busco os dados
     include_once 'conexao_dashboard.php';
     $sql = $dbcon->query("SELECT * FROM historico WHERE epc_cavalo='$tag_cavalo' AND (v_status!='Controle Acesso' AND v_status!='Saiu da Planta' AND $encontrados_dashboard != 0)  ORDER BY id DESC LIMIT 1");
     if(mysqli_num_rows($sql)>0)
     {
      while($dados = $sql->fetch_array())
      { 
       $id_banco_historico = $dados['id'];
       $valor_ponto = intval($dados['valor_ponto']);
       $encontrados_historico = 1;
      }
     } // Fecho if do banco
     else
     {
       // Não encontrou, agora faço leitura para ele na entrada

       //FALTA FAZER
     }
     
    }
    else
    {
      //Nao busca
      print('Sem tag!');
    }






     echo($id_banco_historico);

     if($encontrados_dashboard == 1) //Posso atualizar 
     {
      include_once 'conexao_dashboard.php';
      $sql = $dbcon->query("UPDATE dashboard SET tipo='Controle', ponto='Controle 2', data_leitura='$data', hora_leitura='$hora' WHERE id='$id_banco_dashboard'");
     }

     if($encontrados_historico == 1) // Posso atualizar
     {
      $valor_ponto = intval($valor_ponto + 1);
      $ponto = 'ponto'.$valor_ponto; 
      $data_leitura = 'data_leitura'.$valor_ponto;
      $hora_leitura = 'hora_leitura'.$valor_ponto;

      include_once 'conexao_dashboard.php';
      $sql = $dbcon->query("UPDATE historico SET v_status='Controle Acesso',valor_ponto='$valor_ponto', $ponto='Controle 2', $data_leitura='$data', $hora_leitura='$hora' WHERE id='$id_banco_historico'");
     
      //Agora atualizo o tempo entre CA 
      $sql = $dbcon->query("SELECT * FROM historico WHERE id='$id_banco_historico'");
      if(mysqli_num_rows($sql)>0)
      {
        while($dados = $sql->fetch_array())
        {
          $data_leitura1 = $dados['data_leitura1'];
          $hora_leitura1 = $dados['hora_leitura1'];
          $turno = $dados['turno'];
          $data_leitura2 = $dados['data_leitura2'];
          $hora_leitura2 = $dados['hora_leitura2'];
          
        } // fecha while
      } //Fecha if

       //agora inverto e calculo o tempo
       $mensagem1 = explode('/',$data_leitura1);
       $mensagem1 = $mensagem1[2].'/'.$mensagem1[1].'/'.$mensagem1[0];
       $data_inicio = $mensagem1 . ' ' . $hora_leitura1;  

       $mensagem2 = explode('/',$data_leitura2);
       $mensagem2 = $mensagem2[2].'/'.$mensagem2[1].'/'.$mensagem2[0];
       $data_fim = $mensagem2 . ' ' . $hora_leitura2;  

       //Agora calculo a diferença
  $data_inicio = new DateTime($data_inicio);
  $data_fim = new DateTime($data_fim);
  // Resgata diferença entre as datas
  $dateInterval = $data_inicio->diff($data_fim);
  $mensagem = $dateInterval->format("%D/%M/%Y %H:%I:%S");
  $mensagem1 = explode(' ',$mensagem);
  $vmensagem1 = explode('/',$mensagem1[0]);
  $dia = $vmensagem1[0];
  $mes = $vmensagem1[1];
  $ano = $vmensagem1[2];
  $mensagem = explode(':',$mensagem1[1]);
  $hora = $mensagem[0];
  $minuto = $mensagem[1];
  $segundo = $mensagem[2];
  echo("*********************************Resumo ****************************</BR>");
  echo('ID: '.$id_banco_historico);echo("</BR>");
  echo('Dia: '.$dia);echo("</BR>");
  echo('Mês: '.$mes);echo("</BR>");
  echo('Ano: '.$ano);echo("</BR>");
  echo('Hora: '.$hora);echo("</BR>");
  echo('Minuto: '.$minuto);echo("</BR>");
  echo('Segundo: '.$segundo);echo("</BR>");

   if($dia == 0 && $mes == 0 && $ano == 0)
   {
    $tempo = (intval($hora)*60)+ intval($minuto);
    $tempo = floatval($tempo);
    $tempo = number_format($tempo, 1, '.', '');
    echo 'Tempo = : '.$tempo;
    
    //Agora atualizo o tempo
    if($turno='A')
    {
      $turno = 'v_turno_a';
    }
    else if($turno='B')
    {
      $turno = 'v_turno_b';
    }
    else if($turno='C')
    {
      $turno = 'v_turno_c';
    }
    else
    {
      $turno = 'v_turno_d';
    }

    //Conecto e busco os valores
    $sql = $dbcon->query("SELECT * FROM tempo_medio WHERE referencia='entradas_a_controles' LIMIT 1");
    if(mysqli_num_rows($sql)>0)
    {
      while($dados = $sql->fetch_array())
      {
       $tempo_turno = $dados[$turno];
       $tempo_dia = $dados['v_dia'];
       $tempo_mes = $dados['v_mes'];
       $tempo_ano = $dados['v_ano'];
      }
    }

    //Agora faço a media deles
    $tempo_turno = (floatval($tempo_turno)+floatval($tempo))/2;
    $tempo_turno = number_format($tempo_turno, 1, '.', '');

    $tempo_dia = (floatval($tempo_dia)+floatval($tempo))/2;
    $tempo_dia = number_format($tempo_dia, 1, '.', '');
  
    $tempo_mes = (floatval($tempo_mes)+floatval($tempo))/2;
    $tempo_mes = number_format($tempo_mes, 1, '.', '');
  
    $tempo_ano = (floatval($tempo_ano)+floatval($tempo))/2;
    $tempo_ano = number_format($tempo_ano, 1, '.', '');
  
    //echo'</BR>';
    //echo ' Tempo dia: '. $tempo_dia . ' - Tempo turno: '. $tempo_turno;
   
    
    //Agora atualizo no banco tempo medio
    //pego a hora atual
    date_default_timezone_set('America/Sao_Paulo');
    $data_atualizacao = date('d/m/Y');
    $hora_atualizacao = date('H:i:s');
    
    //Tratando para nao ficar sem o zero a esquerda no numero
    $valor_tempo_turno = explode('.',$tempo_turno);
    $valor_tempo_turno = intval($valor_tempo_turno[0]);
    if($valor_tempo_turno<10)
    {
    $tempo_turno = '0'.$tempo_turno;
    }

    $valor_tempo_dia = explode('.',$tempo_dia);
    $valor_tempo_dia = intval($valor_tempo_dia[0]);
    
    if($valor_tempo_dia<10)
    {
    $tempo_dia = '0'.$tempo_dia;
    }





    $valor_tempo_mes = explode('.',$tempo_mes);
    $valor_tempo_mes = intval($valor_tempo_mes[0]);

    if($valor_tempo_mes<10)
    {
    $tempo_mes = '0'. $tempo_mes;
    }


    $valor_tempo_ano = explode('.',$tempo_ano);
    $valor_tempo_ano = intval($valor_tempo_ano[0]);
 
    if($valor_tempo_ano<10)
    {
    $tempo_ano = '0'.$valor_tempo_ano;
    }

    include_once 'conexao_dashboard.php';
    $sql = $dbcon->query("UPDATE tempo_medio SET $turno='$tempo_turno', v_dia='$tempo_dia', v_ano='$tempo_ano', v_mes='$tempo_mes', data_atualizacao='$data_atualizacao', hora_atualizacao='$hora_atualizacao' WHERE referencia='entradas_a_controles'");
   
   }   
   
   


     } // Fecha $encontrados_historico == 1
     
	 
	 if($encontrados_dashboard == -2 AND $tag_carreta != 'vazio') //Não existe pois perdeu nas entradas, entao crio com o ponto para traz em vazio
     {
	  // Agora conecto no banco e busco os dados
     include_once 'conexao_dashboard.php';
     $sql = $dbcon->query("SELECT * FROM dashboard WHERE epc_carreta='$tag_carreta' AND (tipo='Controle') ORDER BY id DESC LIMIT 1");
     if(mysqli_num_rows($sql)>0)
     {
	 //Ja existe! foi criado antes e feito isso para nao criar duas vezes ou mais
      while($dados = $sql->fetch_array())
      { 
       
	   echo (' Ja existe e foi criado 1 vez! </BR> ');
	   $id_banco_dashboard = $dados['id'];
	   }
	 }
	 else
	 {
	  //PODE CRIAR POIS É A PRIMEIRA VEZ!
	  //Busco a placa
	  // Agora conecto no banco de placas e pelas tags consulto qual sao as placas
	  include_once 'conexao_dashboard.php';
      $sql = $dbcon->query("SELECT * FROM lista_tags WHERE tag='$tag_carreta'");
      if(mysqli_num_rows($sql)>0)
	  {
       while($dados = $sql->fetch_array())
	   {
        $placa_carreta = $dados['placa'];
       }
	   $placa_cavalo = '';
	  }
	  else
	  {
	   $placa_carreta = '';
	   $placa_cavalo = '';
	   }

	  include_once 'conexao_dashboard.php';
      $sql = $dbcon->query("INSERT INTO dashboard (epc_cavalo,epc_carreta,placa_cavalo,placa_carreta,tipo,ponto,data_leitura,hora_leitura) VALUES ('-','$tag_carreta','$placa_cavalo','$placa_carreta','Controle', 'Controle 2', '$data', '$hora')");
     
	 //Busco o turno
	 
$turno1 = '';
$turno2 = '';
$turno3 = '';
$turno_atual = '';
//Busco o turno atual
include_once 'conexao_dashboard.php';
$sql = $dbcon->query("SELECT * FROM lista_turno_dashboard WHERE data='$data'");
if(mysqli_num_rows($sql)>0)
{
while($dados = $sql->fetch_array())
{ 
 $turno1 = $dados['turno1'];
 $turno2 = $dados['turno2'];
 $turno3 = $dados['turno3'];
}
}

$valor_hora = explode(':',$hora);
$valor_hora = $valor_hora[0];
if(intval($valor_hora)>=0 && intval($valor_hora)<8)
{
  //Turno 1
  $turno_atual = $turno1;  
}
else if(intval($valor_hora)>=8 && intval($valor_hora)<17)
{
  //Turno 2
  $turno_atual = $turno2;  
}
else if(intval($valor_hora)>=17 && intval($valor_hora)<23)
{
  //Turno 3
  $turno_atual = $turno3;  
}
else{
    //erro
    $turno_atual = '-';
}
	 
	 
	  //Agora crio no historico
	  include_once 'conexao_dashboard.php';
	$sql = $dbcon->query("INSERT INTO historico SET 
	epc_cavalo='-',
	epc_carreta ='$tag_carreta',
	placa_cavalo='-',
	placa_carreta='$placa_carreta',
	turno='$turno_atual',
	v_status='Controle Acesso',
	encerrado_por='-',
	valor_ponto='2',
	ponto1='Entrada CO',
	data_leitura1='-',
	hora_leitura1='-',
	ponto2='Controle 2',
	data_leitura2='$data',
	hora_leitura2='$hora',
	ponto3='',
	data_leitura3='',
	hora_leitura3='',
	ponto4='',
	data_leitura4='',
	hora_leitura4='',
	ponto5='',
	data_leitura5='',
	hora_leitura5='',
	ponto6='',
	data_leitura6='',
	hora_leitura6='',
	ponto7='',
	data_leitura7='',
	hora_leitura7='',
	ponto8='',
	data_leitura8='',
	hora_leitura8='',
	ponto9='',
	data_leitura9='',
	hora_leitura9='',
	ponto10='',
	data_leitura10='',
	hora_leitura10='',
	ponto11='',
	data_leitura11='',
	hora_leitura11='',
	ponto12='',
	data_leitura12='',
	hora_leitura12='',
	ponto13='',
	data_leitura13='',
	hora_leitura13='',
	ponto14='',
	data_leitura14='',
	hora_leitura14='',
	ponto15='',
	data_leitura15='',
	hora_leitura15=''
	");
	 
	 
	 } // Fecha else de pode crair pois é a primeira vez
	} // Fecha if encontrados  == -2
  
  
  
  //CHAMO PARA ATUALIZAR DISPOSITIVOS
  //ATENCAO: OS DADOS NA VARIAVEL PARAMETRO FORAM SO PARA DEIXAR AQUI PARA QUANDO NECESSARIO PASSAR ALGUM, NESSE CASO NAO USA!
  $parametros = [
    'name' => 'Wayne',
    'id' => 2,
  ];
  $postdata = http_build_query($parametros);
  $ch = curl_init();
  curl_setopt($ch,CURLOPT_URL, 'http://192.168.30.124/dips/verifica_tempo.php');
  curl_setopt($ch,CURLOPT_POST, true);
  curl_setopt($ch,CURLOPT_POSTFIELDS, $postdata);
  curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
  
  
  ?>
</body>
</html>