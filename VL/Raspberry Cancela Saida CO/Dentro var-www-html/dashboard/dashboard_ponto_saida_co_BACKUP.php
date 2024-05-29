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
	 $turno = '';
     $mensagem2 = explode('/',$data);
	 $dia = $mensagem2[0];
	 $mes = $mensagem2[1];
	 $ano = $mensagem2[2];
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
     $sql = $dbcon->query("SELECT * FROM dashboard WHERE epc_carreta='$tag_carreta' AND data_leitura='$data' AND tipo!='Saida' ORDER BY id DESC LIMIT 1");
     if(mysqli_num_rows($sql)>0)
     {
      while($dados = $sql->fetch_array())
      { 
       $id_banco_dashboard = $dados['id'];
       $encontrados_dashboard = 1;
      }
     } // Fecho if do banco
   mysqli_close();
	 echo 'ID banco dashboard : ' . $id_banco_dashboard;
	 echo '</BR>';
     // Agora conecto no banco historico e busco os dados
     include_once 'conexao_dashboard.php';
     $sql = $dbcon->query("SELECT * FROM historico WHERE epc_carreta='$tag_carreta' AND v_status!='Saiu da Planta' ORDER BY id DESC LIMIT 1");
     if(mysqli_num_rows($sql)>0)
     {
      while($dados = $sql->fetch_array())
      { 
       $id_banco_historico = $dados['id'];
       $valor_ponto = intval($dados['valor_ponto']);
       $encontrados_historico = 1;
	   $turno = $dados['turno'];
      }
     } // Fecho if do banco
     mysqli_close();
	   echo 'ID banco historico : ' . $id_banco_historico;
	   echo '</BR>';
    } // Fecha if carreta
    else if ($tag_cavalo != 'vazio')
    {
     print('</BR>');
     print('Buscando por tag de cavalo! - Tag: ' .$tag_cavalo);
     print('</BR>');
     
     // Agora conecto no banco e busco os dados
     include_once 'conexao_dashboard.php';
     $sql = $dbcon->query("SELECT * FROM dashboard WHERE epc_cavalo='$tag_cavalo' AND data_leitura='$data' AND tipo!='Saida' ORDER BY id DESC LIMIT 1");
     if(mysqli_num_rows($sql)>0)
     {
      while($dados = $sql->fetch_array())
      { 
       $id_banco_dashboard = $dados['id'];
       $encontrados_dashboard = 1;
      }
     } // Fecho if do banco
   mysqli_close();
   echo 'ID banco dashboard : ' . $id_banco_dashboard;
	 echo '</BR>';
     // Agora conecto no banco historico e busco os dados
     include_once 'conexao_dashboard.php';
     $sql = $dbcon->query("SELECT * FROM historico WHERE epc_cavalo='$tag_cavalo'  AND v_status!='Saiu da Planta' ORDER BY id DESC LIMIT 1");
     if(mysqli_num_rows($sql)>0)
     {
      while($dados = $sql->fetch_array())
      { 
       $id_banco_historico = $dados['id'];
       $valor_ponto = intval($dados['valor_ponto']);
       $encontrados_historico = 1;
	   $turno = $dados['turno'];
      }
     } // Fecho if do banco
     
    }
    else
    {
      //Nao busca
      print('Sem tag!');
    }
    mysqli_close();




     if($encontrados_dashboard == 1) //Posso atualizar 
     {
      include_once 'conexao_dashboard.php';
      $sql = $dbcon->query("UPDATE dashboard SET tipo='Saida', ponto='Saida CO', data_leitura='$data', hora_leitura='$hora' WHERE id='$id_banco_dashboard'");
      mysqli_close();  
    }
     if($encontrados_historico == 1) // Posso atualizar
     {
      $valor_ponto = intval($valor_ponto + 1);
      $ponto = 'ponto'.$valor_ponto; 
      $data_leitura = 'data_leitura'.$valor_ponto;
      $hora_leitura = 'hora_leitura'.$valor_ponto;

      include_once 'conexao_dashboard.php';
      $sql = $dbcon->query("UPDATE historico SET encerrado_por='Antena',v_status='Saiu da Planta',valor_ponto='$valor_ponto', $ponto='Saida CO', $data_leitura='$data', $hora_leitura='$hora' WHERE id='$id_banco_historico'");
      mysqli_close(); 
	   }

	 if($encontrados_historico == 1 || $encontrados_dashboard == 1 )
	 {
		 //Agora atualizo nas movimenta��es
		 echo $dia;
		 echo '</BR>';
		 echo $mes;
		 echo '</BR>';
		 echo $ano;
		 echo '</BR>';
		 
		 $valor_dia_tabela = intval($dia);
		 $n_movimentacoes_dia = 0;
		 $n_movimentacoes_mes = 0;
		 $valor_dia_tabela = 'v_'.$valor_dia_tabela;
		 echo $valor_dia_tabela;
		 // Atualizo no dia e mes
		 echo '</BR>';
		 echo '</BR>';
		 include_once 'conexao_dashboard.php';
		 $sql = $dbcon->query("SELECT * FROM movimentacoes_2022 WHERE mes='$mes' LIMIT 1");
		 if(mysqli_num_rows($sql)>0)
		 {
		  while($dados = $sql->fetch_array())
		  { 
		   $n_movimentacoes_mes = $dados['quantidade'];
		   $n_movimentacoes_dia = $dados[$valor_dia_tabela];
		  }
		 }
		 mysqli_close();
     //Atualizo o n de movimentacoes
		 $n_movimentacoes_mes = intval($n_movimentacoes_mes) + 1;
		 $n_movimentacoes_dia = intval($n_movimentacoes_dia) + 1;
		 
		echo ('Movimentacoes no dia : ' . $n_movimentacoes_mes);
		echo '</BR>';
		echo ('Movimentacoes no mes : ' . $n_movimentacoes_dia); 
		echo '</BR>';
		

		
		/*
		NAO VOLTAR POIS JA ESTA HABILITADO ISSO NO DASBOARD QUANDO VERIFICA ENCERRAMENTOS PELA ANTENA!
    NAO VOLTAR POIS JA ESTA HABILITADO ISSO NO DASBOARD QUANDO VERIFICA ENCERRAMENTOS PELA ANTENA!
    NAO VOLTAR POIS JA ESTA HABILITADO ISSO NO DASBOARD QUANDO VERIFICA ENCERRAMENTOS PELA ANTENA!
    
    // Atualizo no turno
		include_once 'conexao_dashboard.php';
		$sql = $dbcon->query("SELECT * FROM lista_turno_dashboard WHERE data='$data' LIMIT 1");
		if(mysqli_num_rows($sql)>0)
		{
		 while($dados = $sql->fetch_array())
		 { 
		  $turno1 = $dados['turno1'];
		  $turno2 = $dados['turno2'];
		  $turno3 = $dados['turno3'];
		  $v_turno1 = $dados['v_turno1'];
		  $v_turno2 = $dados['v_turno2'];
		  $v_turno3 = $dados['v_turno3'];
		 }
		}
		if($turno1 == $turno)
		{
		 $v_turno1 = intval($v_turno1) + 1;
		 echo 'Turno1  - Quantidade : ' . $v_turno1;
    }
		else if($turno2 == $turno)
		{
		 $v_turno2 = intval($v_turno2) + 1;
		 echo 'Turno2  - Quantidade : ' . $v_turno2;
    }
		else if($turno3 == $turno)
		{
		 $v_turno3 = intval($v_turno3) + 1;
		 echo 'Turno3  - Quantidade : ' . $v_turno3;
    }
		else
		{
		 echo 'Turno passado esta em folga!';
		}
		//Agora atualizo todos os valores
		include_once 'conexao_dashboard.php';
		$sql = $dbcon->query("UPDATE lista_turno_dashboard SET v_turno1='$v_turno1',v_turno2='$v_turno2',v_turno3='$v_turno3' WHERE data='$data'");
		
    
    NAO VOLTAR POIS JA ESTA HABILITADO ISSO NO DASBOARD QUANDO VERIFICA ENCERRAMENTOS PELA ANTENA!
    */

    echo ('Valor dia tabela = ' . $valor_dia_tabela);
		include_once 'conexao_dashboard.php';
		$sql = $dbcon->query("UPDATE movimentacoes_2022 SET quantidade='$n_movimentacoes_mes', $valor_dia_tabela='$n_movimentacoes_dia' WHERE mes='$mes'");
    mysqli_close();
		 
		 
     } // Fecha se encontrado =1	 
    ?>
</body>
</html>