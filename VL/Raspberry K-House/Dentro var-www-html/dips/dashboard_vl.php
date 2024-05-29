<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!--https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js    /     ./javascript/javascript_ajax.js-->
    <!--<link rel="stylesheet" type="text/css" href="./css/dashboard_vl.css" />-->
    <title>Dashboard VL</title>
</head>
<body onload='atualizar2();'>
    

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<!--"https://www.gstatic.com/charts/loader.js"  

https://www.gstatic.com/charts/loader.js   - ./javascript/javascript_loader.js
-->

  <script type="text/javascript">
   
   google.charts.load("current", {packages:['corechart']});
   google.charts.setOnLoadCallback(drawChart);  

     

    //Entrada CO 
    var n_entrada_co = 0;
    var ultima_placa_entrada_co = ' -- ';
    var lb_ultima_placa_entrada_co = '00:00:00';

    //Entrada BH 
    var n_entrada_bh = 0;
    var ultima_placa_entrada_bh = ' -- ';
	var lb_ultima_placa_entrada_bh = '00:00:00';

    //Controles 
    var n_controles = 0;
    var ultima_placa_controles = ' -- ';
	var lb_ultima_placa_controles = '00:00:00';

	//Estoques 
    var n_estoques = 0;
    var ultima_placa_estoques = ' -- ';
	var lb_ultima_placa_estoques = '00:00:00';

    //Excesso 
    var n_Excesso = 0;
    var ultima_placa_Excesso = ' -- ';
	var lb_ultima_placa_excesso = '00:00:00';

    //Amostragem
    var n_amostragem = 0;
    var ultima_placa_amostragem = ' -- ';
	var lb_ultima_placa_amostragem = '00:00:00';

    //Balancas 
    var n_balancas = 0;
    var ultima_placa_balancas = ' -- ';
	var lb_ultima_placa_balancas = '00:00:00';

    //Saida CO 
    var n_saida_co = 0;
    var ultima_placa_saida_co = ' -- ';
	var lb_ultima_placa_saida_co = '00:00:00';

    //Saida BH 
    var n_saida_bh = 0;
    var ultima_placa_saida_bh = ' -- ';
	var lb_ultima_placa_saida_bh = '00:00:00';



    //variaveis limites
    var limite_entradas = 0;
    var limite_controles = 0;
    var limite_estoques = 0;
    var limite_excesso = 0;
    var limite_amostragem = 0;
    var limite_balancas = 0;
    var limite_saidas = 0;


    // Variaveis para grafico pizza
    var abaixo_10 = 0;
    var abaixo_20 = 0;
    var acima_20 = 0;
    var acima_30 = 0;
    var acima_40 = 0;
    var acima_1h = 0;
    var acima_3h = 0;

    //Crio as variaveis para os dados do turno de movimentacoes
    var turno1 = 'X';
    var turno2 = 'X';
    var turno3 = 'X';
    var v_turno1 = 0;
    var v_turno2 = 0;
    var v_turno3 = 0;
    var v_dia = 0;

    
    //variaveis para tempo medio
    var ref_turno = 'x';
    var tm_v_turno_entradas_a_controles = '00.0';
    var tm_v_dia_entradas_a_controles = '00.0';
    var tm_v_mes_entradas_a_controles = '00.0';
    var tm_v_ano_entradas_a_controles = '00.0';

    var tm_v_turno_entrada_a_saidas = '00.0';
    var tm_v_dia_entrada_a_saidas = '00.0';
    var tm_v_mes_entrada_a_saidas = '00.0';
    var tm_v_ano_entrada_a_saidas = '00.0';

    var tm_v_turno_controles_a_saidas = '00.0';
    var tm_v_dia_controles_a_saidas = '00.0';
    var tm_v_mes_controles_a_saidas = '00.0';
    var tm_v_ano_controles_a_saidas = '00.0';

    var tm_v_turno_controles_a_balancas = '00.0';
    var tm_v_dia_controles_a_balancas = '00.0';
    var tm_v_mes_controles_a_balancas = '00.0';
    var tm_v_ano_controles_a_balancas = '00.0';






    var tm_limite_entradas_a_controles = '00.0';
    var tm_limite_entradas_a_saidas = '00.0';
    var tm_limite_controles_a_saidas = '00.0';
    var tm_limite_controles_a_balancas = '00.0';
    var tm_limite_balancas_a_saidas = '00.0';



    <?php
    date_default_timezone_set('America/Sao_Paulo');
    $data1 = date('d/m/Y');
    $data = isset($_GET['data'])?$_GET['data']:$data1;
    $hora = date('H:i:s');
    $hora2 = date('H:i:s');
   
    
    //Primeiro busco as 10 ultimas tags no banco
    $encontrado_placas = 0;
    $epcs = array();
    
    include_once 'conexao_dashboard.php';
    $sql = $dbcon->query("SELECT * FROM validacoes_feitas2 WHERE data_validacao='$data'");
    if(mysqli_num_rows($sql)>0)
    {
     while($dados = $sql->fetch_array())
     { 
      $v_epc = trim($dados['placa_ou_tag']);
      $v_epc = trim($v_epc);
      if (in_array($v_epc, $epcs))
      { 
       //echo "Tem a tag, nao pode salvar!";
       //echo 'nao pode';
      }
      else
      {
       //echo ' Nao tem a tag, pode salvar!';  
       //Insere no array e conta quantas tags tem no dia!
       array_push($epcs,trim($v_epc));
       $encontrado_placas = intval($encontrado_placas)+1;
      }   
     } 
    }
    




    //Variaveis para o giro
    $numero_viajens = 0;
    $numero_motoristas = 0;


   
    //atualizo dashboard
    include_once 'conexao_dashboard.php';
    $sql = $dbcon->query("UPDATE atualizacao SET data_atualizacao='$data',hora_atualizacao='$hora' WHERE ponto='Dashboard'");
    

    
    $data_inicio2 = '';
    $data_inicio2 = $data; // Para calculo de diferenca de horas
    $mensagem3 = explode('/',$data_inicio2);
    
    $referencia_ttp_ca_a_saida = 0;
    $referencia_ttp_entrada_a_saida = 0;

    $valor_do_mes = $mensagem3[1];
    
    $data_inicio2 = $mensagem3[2].'/'.$mensagem3[1].'/'.$mensagem3[0];
    $data_inicio2 = $data_inicio2. ' ' . $hora;
    $desconsiderar =  0;
    
    $vezes = isset($_GET['vezes'])? $_GET['vezes']:'-1';
    $nvezes = isset($_GET['nvezes'])? $_GET['nvezes']:'-1';
    $tempo = isset($_GET['tempo'])? $_GET['tempo']:'-1';
    if($tempo == '-1'){$tempo = 30000;}
    if($nvezes == '-1'){$nvezes = 5;}
    if($vezes != '-1'){$vezes = intval($vezes)+1;}

    // Busco os dados do ttp mes
    // Busco os limites
    // Conecto no banco e busco os valores
    include_once 'conexao_dashboard.php';
    $filtro = '/'.$valor_do_mes.'/'; // puxa filtrando o mes atual
    $encontrado = 0;
    $encontrado_entrada = 0;
    $ttp_dia = 0;
    $ttp_dia_entrada = 0;
    $ttp_mes = 0;
    $ttp_mes_entrada = 0;
    $sql = $dbcon->query("SELECT * FROM lista_turno_dashboard WHERE data like '%". $filtro . "%'");
    if(mysqli_num_rows($sql)>0)
    {
     while($dados = $sql->fetch_array())
     { 
       $ref_ttp_dia = $dados['ttp_dia'];
       $ref_ttp_dia_entrada = $dados['ttp_dia_entrada'];
       if(floatval($ref_ttp_dia) >0)
       {
        $ttp_dia = floatval($ttp_dia)+$ref_ttp_dia;   
        $encontrado = intval($encontrado)+1;   
       }
       if(floatval($ref_ttp_dia_entrada) >0)
       {
        $ttp_dia_entrada = floatval($ttp_dia_entrada)+$ref_ttp_dia_entrada;   
        $encontrado_entrada = intval($encontrado_entrada)+1;   
       }

     }
    }
    
    if(intval($encontrado) >0)
    {
     $ttp_mes =  floatval( floatval($ttp_dia)/intval($encontrado) );
     ?>
     console.log('TTP mês :  <?php print $ttp_mes ?>');
     <?php

     //Agora faço o uptade dentro da tabela de mes
     $ttp_mes = number_format($ttp_mes, 1, '.', '');
     include_once 'conexao_dashboard.php';
     $sql = $dbcon->query("UPDATE movimentacoes_2022 SET ttp_mes='$ttp_mes' WHERE mes='$valor_do_mes'");
    }
    
    if(intval($encontrado_entrada) >0)
    {
     $ttp_mes_entrada =  floatval( floatval($ttp_dia_entrada)/intval($encontrado_entrada) );
     ?>
     console.log('TTP mês entrada :  <?php print $ttp_mes_entrada ?>');
     <?php

     //Agora faço o uptade dentro da tabela de mes
     $ttp_mes_entrada = number_format($ttp_mes_entrada, 1, '.', '');
     include_once 'conexao_dashboard.php';
     $sql = $dbcon->query("UPDATE movimentacoes_2022 SET ttp_mes_entrada='$ttp_mes_entrada' WHERE mes='$valor_do_mes'");
    }




    // Busco os limites
    // Conecto no banco e busco os valores
    include_once 'conexao_dashboard.php';
    $sql = $dbcon->query("SELECT * FROM limites");
    if(mysqli_num_rows($sql)>0)
    {
     while($dados = $sql->fetch_array())
     { 
       $referencia = $dados['referencia'];
       $veiculos = $dados['veiculos'];
       $limite_ttp = $dados['limite_em_minutos'];
       if($referencia == 'entradas')
       {
         $referencia_ttp_entrada_a_saida = $limite_ttp;
         ?>
         limite_entradas ='<?php print $veiculos ?>';         
         <?php  
       }
       else if($referencia == 'controles')
       {
        $referencia_ttp_ca_a_saida = $limite_ttp;   
        ?>
        limite_controles ='<?php print $veiculos ?>';         
        <?php  
       }
       else if($referencia == 'excesso')
       {
        ?>
        limite_excesso ='<?php print $veiculos ?>';         
        <?php  
       }
       else if($referencia == 'estoques')
       {
        ?>
        limite_estoques ='<?php print $veiculos ?>';         
        <?php  
       }
       else if($referencia == 'amostragem')
       {
        ?>
        limite_amostragem ='<?php print $veiculos ?>';         
        <?php  
       }
       else if($referencia == 'balancas')
       {
        ?>
        limite_balancas ='<?php print $veiculos ?>';         
        <?php  
       }
       else if($referencia == 'saidas')
       {
        ?>
        limite_saidas ='<?php print $veiculos ?>';         
        <?php  
       }



     } // Fecha whille
    } // Fecha if 
    include_once 'conexao_dashboard.php';
    $sql = $dbcon->query("SELECT * FROM atualizacao WHERE condicao='Erro'");
    if(mysqli_num_rows($sql)>0)
    {
     while($dados = $sql->fetch_array())
     {
         $encontrado_erros = intval($encontrado_erros) + 1; 
     }
    }


    // Busco as letras do turno
    $ref_turno = 'X';
    $turno1 = 'X';
    $turno2 = 'X';
    $turno3 = 'X';

    $v_turno1 = '0';
    $v_turno2 = '0';
    $v_turno3 = '0';
    $v_dia = '0';
    
    $enc_antena = 0;
    $enc_job = 0;
    //Conecto e busco valores de encerramentos antenas e job
    include_once 'conexao_dashboard.php';
    $sql = $dbcon->query("SELECT * FROM lista_turno_dashboard WHERE data='$data' ORDER BY id ASC LIMIT 1");
    if(mysqli_num_rows($sql)>0)
    {
     $dados = $sql->fetch_array();   
     $enc_antena = $dados['antena'];
     $enc_job = $dados['job'];
     
     $turno1 = $dados['turno1'];
     $ttp_turno1 = $dados['ttp_turno1'];
     $turno2 = $dados['turno2'];
     $ttp_turno2 = $dados['ttp_turno2'];
     $turno3 = $dados['turno3'];
     $ttp_turno3 = $dados['ttp_turno3'];
     $ttp_dia = $dados['ttp_dia'];

     if(strlen($enc_antena)==1)
     {
      $enc_antena = '0'. intval($enc_antena);   
     }
     if(strlen($enc_job)==1)
     {
      $enc_job = '0'. intval($enc_job);   
     }

     if($enc_antena == '00'){$enc_antena = '0';}
     if($enc_job == '00'){$enc_job = '0';}

    }
    
    // Conecto no banco e busco os valores
    include_once 'conexao_dashboard.php';
    $sql = $dbcon->query("SELECT * FROM lista_turno_dashboard WHERE data='$data'");
    if(mysqli_num_rows($sql)>0)
    {
     while($dados = $sql->fetch_array())
     { 
      $turno1 = $dados['turno1'];
      $v_turno1 = $dados['v_turno1'];   
      
      $turno2 = $dados['turno2'];
      $v_turno2 = $dados['v_turno2'];   

      $turno3 = $dados['turno3'];
      $v_turno3 = $dados['v_turno3'];   
      
      $job_v_turno1 = $dados['job_v_turno1'];
      $job_v_turno2 = $dados['job_v_turno2'];
      $job_v_turno3 = $dados['job_v_turno3'];

      $ant_v_turno1 = $dados['ant_v_turno1'];
      $ant_v_turno2 = $dados['ant_v_turno2'];
      $ant_v_turno3 = $dados['ant_v_turno3'];
     }
    }
    
    if(intval($v_turno1>1))
    {
     $v_turno1 = $v_turno1 . ' Viagens';
    }
    else
    {
        $v_turno1 = $v_turno1 . ' Viagem';
    }

    if(intval($v_turno2>1))
    {
     $v_turno2 = $v_turno2 . ' Viagens';
    }
    else
    {
        $v_turno2 = $v_turno2 . ' Viagem';
    }

    if(intval($v_turno3>1))
    {
     $v_turno3 = $v_turno3 . ' Viagens';
    }
    else
    {
        $v_turno3 = $v_turno3 . ' Viagem';
    }


    $valor_hora = explode(':',$hora);
    $valor_hora = $valor_hora[0];
    if(intval($valor_hora)>=0 && intval($valor_hora)<8)
     {
       //Turno 1
       $turno_atual = 'Turno Atual: ' . $turno1;
       $ref_turno = $turno1;
     }
     else if(intval($valor_hora)>=8 && intval($valor_hora)<17)
     {
       //Turno 1
       $turno_atual = 'Turno Atual: ' .$turno2;
       $ref_turno = $turno2;
     }
     else if(intval($valor_hora)>=17 && intval($valor_hora)<23)
     {
       //Turno 3
       $turno_atual = 'Turno Atual: ' .$turno3;
       $ref_turno = $turno3;
     }
     else{
         //erro
         $turno_atual = 'Não Identificado!';
         $ref_turno = 'X';
     }
	 $ref_turno = 'v_turno_'.strtolower($ref_turno);
     $u_ref_turno ='u_'.strtolower($ref_turno);
	 // Conecto no banco e busco os valores de tempo medio
    include_once 'conexao_dashboard.php';

    $sql = $dbcon->query("SELECT * FROM tempo_medio WHERE referencia='entradas_a_controles' LIMIT 1");
    if(mysqli_num_rows($sql)>0)
    {
     $encontrado = 0;   
     while($dados = $sql->fetch_array())
     { 
      $tm_v_turno_entradas_a_controles = $dados[$ref_turno];
      $u_tm_v_turno_entradas_a_controles = $dados[$u_ref_turno];
      $tm_v_dia_entradas_a_controles = $dados['v_dia'];
      $u_tm_v_dia_entradas_a_controles = $dados['u_v_dia'];
	  $tm_v_mes_entradas_a_controles = $dados['v_mes'];
	  $tm_v_ano_entradas_a_controles = $dados['v_ano'];
	  $tm_limite_entradas_a_controles = $dados['limite'];
     }
	}
    include_once 'conexao_dashboard.php';
    $sql = $dbcon->query("SELECT * FROM tempo_medio WHERE referencia='entradas_a_saidas' LIMIT 1");
    if(mysqli_num_rows($sql)>0)
    {
     $encontrado = 0;   
     while($dados = $sql->fetch_array())
     { 
      $tm_v_turno_entradas_a_saidas = $dados[$ref_turno];
	  $u_tm_v_turno_entradas_a_saidas = $dados[$u_ref_turno];
      $tm_v_dia_entradas_a_saidas = $dados['v_dia'];
      $u_tm_v_dia_entradas_a_saidas = $dados['u_v_dia'];
	  $tm_v_mes_entradas_a_saidas = $dados['v_mes'];
	  $tm_v_ano_entradas_a_saidas = $dados['v_ano'];
	  $tm_limite_entradas_a_saidas = $dados['limite'];
     }
	}

    include_once 'conexao_dashboard.php';
    $sql = $dbcon->query("SELECT * FROM tempo_medio WHERE referencia='controles_a_saidas' LIMIT 1");
    if(mysqli_num_rows($sql)>0)
    {
     $encontrado = 0;   
     while($dados = $sql->fetch_array())
     { 
      $tm_v_turno_controles_a_saidas = $dados[$ref_turno];
      $u_tm_v_turno_controles_a_saidas = $dados[$u_ref_turno];
	  $tm_v_dia_controles_a_saidas = $dados['v_dia'];
      $u_tm_v_dia_controles_a_saidas = $dados['u_v_dia'];
	  $tm_v_mes_controles_a_saidas = $dados['v_mes'];
	  $tm_v_ano_controles_a_saidas = $dados['v_ano'];
	  $tm_limite_controles_a_saidas = $dados['limite'];
     }
	}

    include_once 'conexao_dashboard.php';
    $sql = $dbcon->query("SELECT * FROM tempo_medio WHERE referencia='controles_a_balancas' LIMIT 1");
    if(mysqli_num_rows($sql)>0)
    {
     $encontrado = 0;   
     while($dados = $sql->fetch_array())
     { 
      $tm_v_turno_controles_a_balancas = $dados[$ref_turno];
      $u_tm_v_turno_controles_a_balancas = $dados[$u_ref_turno];
	  $tm_v_dia_controles_a_balancas = $dados['v_dia'];
      $u_tm_v_dia_controles_a_balancas = $dados['u_v_dia'];
	  $tm_v_mes_controles_a_balancas = $dados['v_mes'];
	  $tm_v_ano_controles_a_balancas = $dados['v_ano'];
	  $tm_limite_controles_a_balancas = $dados['limite'];
     }
	}









    include_once 'conexao_dashboard.php';
    $sql = $dbcon->query("SELECT * FROM tempo_medio WHERE referencia='balancas_a_saidas' LIMIT 1");
    if(mysqli_num_rows($sql)>0)
    {
     $encontrado = 0;   
     while($dados = $sql->fetch_array())
     { 
      $tm_v_turno_balancas_a_saidas = $dados[$ref_turno];
      $u_tm_v_turno_balancas_a_saidas = $dados[$u_ref_turno];
	  $tm_v_dia_balancas_a_saidas = $dados['v_dia'];
	  $tm_v_mes_balancas_a_saidas = $dados['v_mes'];
	  $tm_v_ano_balancas_a_saidas = $dados['v_ano'];
	  $tm_limite_balancas_a_saidas = $dados['limite'];
     }
	}



  
    //CALCULO O VALOR DO GIRO TOTAL
    //echo $tabela;
    
    date_default_timezone_set('America/Sao_Paulo');
    $data1 = date('d/m/Y');
    $data = isset($_GET['data'])?$_GET['data']:$data1;
    //$hora = date('H:i:s');
    $vdata = explode('/',$data);
    $dia = intval($vdata[0]);
    $mes = intval($vdata[1]);
    $ano = intval($vdata[2]);
    $numero_tabela = 0;
    $pesquisa_mes = 'mes_'.$mes; //exemplo mes_8
    $pesquisa_ano = 'ano_2022';
    $encontrados = 0;
    
    if(intval($mes)>6)
    {
     $numero_tabela = 2;
     $pesquisa_dia = 'mes'.(intval($mes)-6).'_dia_'.$dia; //exemplo mes1_dia4
    }   
    else
    {
     $numero_tabela = 1;
     $pesquisa_dia = 'mes'.$mes.'_dia_'.$dia; //exemplo mes1_dia4
    }
    
    
    //AGORA BUSCO O RANKING DAS TRANSPORTADORAS NO DIA
    $tabela = 'cadastro_motoristas'.$numero_tabela; //Se mes menor que 7 , busca no cadastro_transportadoras1, senão busca no no cadastro_transportadoras2
    
    
    include_once 'conexao_dashboard.php';
    $sql = $dbcon->query("SELECT * FROM $tabela WHERE CAST($pesquisa_dia AS DECIMAL)>0 ");
    if(mysqli_num_rows($sql)>0)
    {
     while($dados = $sql->fetch_array())
     {
      $numero_motoristas = intval($numero_motoristas)+1;
      $numero_viajens = intval($numero_viajens) + intval($dados[$pesquisa_dia]); 
     }
    }
    
    $total_movimentacoes = intval($v_turno1)+intval($v_turno2)+intval($v_turno3);
    
    $giro = floatval(($total_movimentacoes)/($numero_motoristas));
    $giro = number_format($giro,3,",",".");
    
    ?>



   console.log("Giro e : " + '<?php print $giro ?>');
   
    
    turno1 = '<?php print $turno1 ?>';
     turno2 = '<?php print $turno2 ?>';
     turno3 = '<?php print $turno3 ?>';
     v_turno1 = '<?php print $v_turno1 ?>';
     v_turno2 = '<?php print $v_turno2 ?>';
     v_turno3 = '<?php print $v_turno3 ?>';
     v_dia = parseInt(v_turno1) + parseInt(v_turno2) + parseInt(v_turno3);
     
	 
	 
	 tm_v_turno_entradas_a_controles = '<?php print $tm_v_turno_entradas_a_controles?>';
     u_tm_v_turno_entradas_a_controles = '<?php print $u_tm_v_turno_entradas_a_controles?>';
	 tm_v_dia_entradas_a_controles = '<?php print $tm_v_dia_entradas_a_controles?>';
	 tm_v_mes_entradas_a_controles = '<?php print $tm_v_mes_entradas_a_controles?>';
	 tm_v_ano_entradas_a_controles = '<?php print $tm_v_ano_entradas_a_controles?>';
	 tm_limite_entradas_a_controles = '<?php print $tm_limite_entradas_a_controles ?>';
	 
	 tm_v_turno_entradas_a_saidas = '<?php print $tm_v_turno_entradas_a_saidas?>';
     u_tm_v_turno_entradas_a_saidas = '<?php print $u_tm_v_turno_entradas_a_saidas?>';
	 tm_v_dia_entradas_a_saidas = '<?php print $tm_v_dia_entradas_a_saidas?>';
	 tm_v_mes_entradas_a_saidas = '<?php print $tm_v_mes_entradas_a_saidas?>';
	 tm_v_ano_entradas_a_saidas = '<?php print $tm_v_ano_entradas_a_saidas?>';
	 tm_limite_entradas_a_saidas = '<?php print $tm_limite_entradas_a_saidas ?>';

     tm_v_turno_controles_a_saidas = '<?php print $tm_v_turno_controles_a_saidas?>';
     u_tm_v_turno_controles_a_saidas = '<?php print $u_tm_v_turno_controles_a_saidas?>';
     tm_v_dia_controles_a_saidas = '<?php print $tm_v_dia_controles_a_saidas?>';
     tm_v_mes_controles_a_saidas = '<?php print $tm_v_mes_controles_a_saidas?>';
     tm_v_ano_controles_a_saidas = '<?php print $tm_v_ano_controles_a_saidas?>';
     tm_limite_controles_a_saidas = '<?php print $tm_limite_controles_a_saidas ?>';

     tm_v_turno_controles_a_balancas = '<?php print $tm_v_turno_controles_a_balancas?>';
     u_tm_v_turno_controles_a_balancas = '<?php print $u_tm_v_turno_controles_a_balancas?>';
     tm_v_dia_controles_a_balancas = '<?php print $tm_v_dia_controles_a_balancas?>';
     tm_v_mes_controles_a_balancas = '<?php print $tm_v_mes_controles_a_balancas?>';
     tm_v_ano_controles_a_balancas = '<?php print $tm_v_ano_controles_a_balancas?>';
     tm_limite_controles_a_balancas = '<?php print $tm_limite_controles_a_balancas ?>';


     tm_limite_entradas_a_controles = '<?php print $tm_limite_entradas_a_controles ?>';
     u_tm_limite_entradas_a_controles = '<?php print $u_tm_limite_entradas_a_controles ?>';
     tm_limite_entradas_a_saidas = '<?php print $tm_limite_entradas_a_saidas ?>';
     tm_limite_controles_a_saidas = '<?php print $tm_limite_controles_a_saidas ?>';
     tm_limite_controles_a_balancas = '<?php print $tm_limite_controles_a_balancas ?>';
     tm_limite_balancas_a_saidas = '<?php print $tm_limite_balancas_a_saidas ?>';

	 
	 //alert(tm_v_turno_entradas_a_controles);
	 



     var numero_viagens = v_dia;

     if(parseInt(v_dia) <2)
     {
       v_dia = v_dia.toString() + ' Viagem';  
     }
     else
     {
      v_dia = v_dia.toString() + ' Viagens';   
     }

    
     <?php

     






    // Conecto no banco e busco os valores
    include_once 'conexao_dashboard.php';

    $sql = $dbcon->query("SELECT * FROM dashboard WHERE data_leitura='$data' ORDER BY hora_leitura ASC");
    if(mysqli_num_rows($sql)>0)
    {
     $encontrado = 0;   
     $tamanho_data = 0;
     $tamanho_hora = 0;

     while($dados = $sql->fetch_array())
     { 
      $tamanho_data = $dados['data_leitura'];
      $tamanho_hora = $dados['hora_leitura'];
      $tamanho_data = strlen($tamanho_data);
      $tamanho_hora = strlen($tamanho_hora);
      
      if($tamanho_data==10 && $tamanho_hora==8)
      {   
        $desconsiderar = 0;   
        $encontrado = intval($encontrado)+1;
        $ponto = $dados['ponto'];
        $placa_cavalo = $dados['placa_cavalo'];
        $placa_carreta = $dados['placa_carreta'];
        $data_leitura = $dados['data_leitura'];
        
        $hora_leitura = $dados['hora_leitura'];
        $mensagem6 = explode('/',$data_leitura);
        $data_fim2 = $mensagem6[2].'/'.$mensagem6[1].'/'.$mensagem6[0];
        $data_fim2 = $data_fim2. ' ' .$hora_leitura;
        $data_inicio = new DateTime($data_inicio2);
        $data_fim = new DateTime($data_fim2);
        $dateInterval = $data_inicio->diff($data_fim);
        $mensagem = $dateInterval->format("%H:%I:%S");
        $mensagem = explode(':',$mensagem);
        $hora = $mensagem[0];
        $minuto = $mensagem[1];
        $segundo = $mensagem[2];
    
        // Faço o calculo para saber se nao esta acima do permitido para contar
        // Hoje considerei acima de 3 horas sai da conta
        if($hora == "0")
        {
            if($ponto == "Saida CO" || $ponto == "Saida CO LD" || $ponto == "Saida LE" || $ponto == "Saida BH")
            {
            }
            else
            {
            //  echo 'Nao tem 1 hora';
                    $desconsiderar = 0;
                    //Agora verifico quantos minutos tem
                    if(intval($minuto) <20)
                    {
                    ?>
                    abaixo_20 = abaixo_20 + 1;
                    <?php
                    }
                    else if (intval($minuto)>=20 && intval($minuto <30)) // acima de 20 e menor que 30min
                    {
                    ?>
                    acima_20 = acima_20  + 1;
                    <?php
                    }
                    else if (intval($minuto)>=30 && intval($minuto <40)) // acima de 29 e menor que 30min
                    {
                    ?>
                    acima_30 = acima_30 + 1;
                    <?php
                    }
                    else if (intval($minuto)>=40 && intval($minuto <60)) // acima de 39 e menor que 60min
                    {
                    ?>
                    acima_40 = acima_40 + 1;
                    <?php
                    }
            } // Fecha else para menos que 3 horas e nao é saida

        } // Fecha if se <3 horas
        else
        {
            //Agora trato de tem mais de 1 ou mais de 3
            if(intval($hora)>=3)
            {
            //echo ('Tem mais de 3 horas');
            // Desconsidero o valor
            $desconsiderar = 1;
            ?>
            acima_3h = acima_3h + 1;
            <?php
            }
            else
            {
            // echo ('Tem menos de 3 horas');
            $desconsiderar = 0;
            ?>
            acima_1h = acima_1h + 1;
            <?php  
            }
        
        } //Fecha else
        
        if($desconsiderar == 0)
        {
                //Trato o ponto
                if($ponto == 'Entrada CO')
                {
                $lb_ultima_placa_entrada_co = $hora_leitura;
                    if($placa_carreta !="")
                    {
                        ?>
                        ultima_placa_entrada_co = '<?php print $placa_carreta ?>';
                        <?php   
                    }
                    else if($placa_cavalo !="")
                    {
                        ?>
                        ultima_placa_entrada_co = '<?php print $placa_cavalo ?>';
                        <?php
                    }
                    else
                    {
                        ?>
                        ultima_placa_entrada_co = " -- ";
                        <?php
                    }    
                    ?>
                    n_entrada_co = n_entrada_co + 1;
                    <?php
                }
                else if($ponto == 'Entrada BH')
                {
                $lb_ultima_placa_entrada_bh = $hora_leitura;

                    if($placa_carreta !="")
                    {
                        ?>
                        ultima_placa_entrada_bh = '<?php print $placa_carreta ?>';
                        <?php   
                    }
                    else if($placa_cavalo !="")
                    {
                        ?>
                        ultima_placa_entrada_bh = '<?php print $placa_cavalo ?>';
                        <?php
                    }
                    else
                    {
                        ?>
                        ultima_placa_entrada_bh = " -- ";
                        <?php
                    }    
                    ?>
                    n_entrada_bh = n_entrada_bh + 1;
                    <?php
                }
                else if($ponto == 'Controle 1' || $ponto == 'Controle 2' || $ponto == 'Controle 3')
                {
                $lb_ultima_placa_controles = $hora_leitura;
                    if($placa_carreta !="")
                    {
                        ?>
                        ultima_placa_controles = '<?php print $placa_carreta ?>';
                        <?php   
                    }
                    else if($placa_cavalo !="")
                    {
                        ?>
                        ultima_placa_controles = '<?php print $placa_cavalo ?>';
                        <?php
                    }
                    else
                    {
                        ?>
                        ultima_placa_controles = " -- ";
                        <?php
                    }    
                    ?>
                    n_controles = n_controles + 1;
                    <?php 
                }
                else if($ponto == 'Estoques')
                {
                $lb_ultima_placa_estoques = $hora_leitura;

                    if($placa_carreta !="")
                    {
                        ?>
                        ultima_placa_estoques = '<?php print $placa_carreta ?>';
                        <?php   
                    }
                    else if($placa_cavalo !="")
                    {
                        ?>
                        ultima_placa_estoques = '<?php print $placa_cavalo ?>';
                        <?php
                    }
                    else
                    {
                        ?>
                        ultima_placa_estoques = " -- ";
                        <?php
                    }    
                    ?>
                    n_estoques = n_estoques + 1;
                    <?php
                }
                else if($ponto == 'Excesso 1' || $ponto == 'Excesso 2' || $ponto == 'Excesso')
                {
                $lb_ultima_placa_excesso = $hora_leitura;
                    if($placa_carreta !="")
                    {
                        ?>
                        ultima_placa_Excesso = '<?php print $placa_carreta ?>';
                        <?php   
                    }
                    else if($placa_cavalo !="")
                    {
                        ?>
                        ultima_placa_Excesso = '<?php print $placa_cavalo ?>';
                        <?php
                    }
                    else
                    {
                        ?>
                        ultima_placa_Excesso = " -- ";
                        <?php
                    }    
                    ?>
                    n_Excesso = n_Excesso + 1;
                    <?php
                }
                else if($ponto == 'Amostragem' || $ponto == 'Amostragem 1' || $ponto == 'Amostragem 2')
                {
                $lb_ultima_placa_amostragem = $hora_leitura;
                    if($placa_carreta !="")
                    {
                        ?>
                        ultima_placa_amostragem = '<?php print $placa_carreta ?>';
                        <?php   
                    }
                    else if($placa_cavalo !="")
                    {
                        ?>
                        ultima_placa_amostragem = '<?php print $placa_cavalo ?>';
                        <?php
                    }
                    else
                    {
                        ?>
                        ultima_placa_amostragem = " -- ";
                        <?php
                    }    
                    ?>
                    n_amostragem = n_amostragem + 1;
                    <?php
                }
                else if($ponto == 'Balancas' || $ponto == 'Balanca 1' || $ponto == 'Balanca 2' || $ponto == 'Balanca 3' || $ponto == 'Balanca 4' || $ponto == 'Balanca 5')
                {
                $lb_ultima_placa_balancas = $hora_leitura;
                    if($placa_carreta !="")
                    {
                        ?>
                        ultima_placa_balancas = '<?php print $placa_carreta ?>';
                        <?php   
                    }
                    else if($placa_cavalo !="")
                    {
                        ?>
                        ultima_placa_balancas = '<?php print $placa_cavalo ?>';
                        <?php
                    }
                    else
                    {
                        ?>
                        ultima_placa_balancas = " -- ";
                        <?php
                    }    
                    ?>
                    n_balancas = n_balancas + 1;
                    <?php
                }
                else if($ponto == 'Saida CO')
                {
                $lb_ultima_placa_saida_co = $hora_leitura;
                    if($placa_carreta !="")
                    {
                        ?>
                        ultima_placa_saida_co = '<?php print $placa_carreta ?>';
                        <?php   
                    }
                    else if($placa_cavalo !="")
                    {
                        ?>
                        ultima_placa_saida_co = '<?php print $placa_cavalo ?>';
                        <?php
                    }
                    else
                    {
                        ?>
                        ultima_placa_saida_co = " -- ";
                        <?php
                    }    
                    ?>
                    n_saida_co = n_saida_co + 1;
                    <?php
                }
                else if($ponto == 'Saida BH')
                {
                $lb_ultima_placa_saida_bh = $hora_leitura;
                    if($placa_carreta !="")
                    {
                        ?>
                        ultima_placa_saida_bh = '<?php print $placa_carreta ?>';
                        <?php   
                    }
                    else if($placa_cavalo !="")
                    {
                        ?>
                        ultima_placa_saida_bh = '<?php print $placa_cavalo ?>';
                        <?php
                    }
                    else
                    {
                        ?>
                        ultima_placa_saida_bh = " -- ";
                        <?php
                    }    
                    ?>
                    n_saida_bh = n_saida_bh + 1;
                    <?php
                }
             } 
            } //Fecha if desconsiderar == 0
     }//fecha whille
	 

    }//Fecha if


    ?>


    //alert (n_entrada_co);
    var quantidade_entrada_co = n_entrada_co;
    var quantidade_entrada_bh = n_entrada_bh;
    var quantidade_ca = n_controles;
    var quantidade_estoques = 0; // nao habilitado ainda!
    var quantidade_Excesso = n_Excesso;
    var quantidade_balancas = n_balancas;
    var quantidade_saida_co = n_saida_co;
    var quantidade_saida_bh = n_saida_bh;
    var quantidade_estoques = n_estoques;
	var quantidade_amostragem = n_amostragem;
    
    
    var cor_azul = "#00008B";
    var cor_vermelho = "#FF4500";
    
    var cor_entrada_co = '';
    var cor_entrada_bh = '';
    var cor_controles = '';
    var cor_estoques = '';
    var cor_excesso = '';
    var cor_amostragem = '';
    var cor_balancas = '';
    var cor_saida_co = '';
    var cor_saida_bh = '';

  // console.log(quantidade_ca + ' Limite : ' + limite_controles);

   if(quantidade_entrada_co >= limite_entradas)
   {
    cor_entrada_co = cor_vermelho;
   }
   else
   {
    cor_entrada_co = cor_azul;
   }



   if(quantidade_entrada_bh >= limite_entradas)
   {
    cor_entrada_bh = cor_vermelho;
   }
   else
   {
    cor_entrada_bh = cor_azul;
   }


   if(quantidade_ca >= limite_controles)
   {
    cor_controles = cor_vermelho;
   }
   else
   {
    cor_controles = cor_azul;
   }

   if( quantidade_estoques >= limite_estoques)
   {
    cor_estoques = cor_vermelho;
   }
   else
   {
    cor_estoques = cor_azul;
   }



   if(quantidade_Excesso >= limite_excesso )
   {
    cor_excesso = cor_vermelho;
   }
   else
   {
    cor_excesso = cor_azul;
   }

  if( quantidade_amostragem >= limite_amostragem)
  {
    cor_amostragem = cor_vermelho;
  }
  else
  {
    cor_amostragem = cor_azul;
  }



   if( quantidade_balancas >= limite_balancas)
   {
    cor_balancas = cor_vermelho;
   }
   else
   {
    cor_balancas = cor_azul;
   }



   if ( quantidade_saida_co >= limite_saidas)
   {
    cor_saida_co = cor_vermelho;
   }
   else
   {
    cor_saida_co = cor_azul;
   }




   if ( quantidade_saida_bh >= limite_saidas)
   {
    cor_saida_bh = cor_vermelho;
   }
   else
   {
    cor_saida_bh = cor_azul;
   }




   

   function drawChart() 
    {

     var data = google.visualization.arrayToDataTable([
      ["Local", "Carretas", { role: "style" } ],
      ["Entrada CO", quantidade_entrada_co, cor_entrada_co],
      ["Entrada BH", quantidade_entrada_bh, cor_entrada_bh],
      ["Controles 1, 2 e 3", quantidade_ca, cor_controles],
      ["Estoques", quantidade_estoques, cor_estoques],
      ["Excesso", quantidade_Excesso, cor_excesso],
      ["Amostragem", quantidade_amostragem, cor_amostragem],
      ["Balancas", quantidade_balancas, cor_balancas],
      ["Saída CO", quantidade_saida_co, cor_saida_co],
      ["Saída BH", quantidade_saida_bh, cor_saida_bh],
      
     ]);



     view = new google.visualization.DataView(data);
     view.setColumns([0, 1,{ calc: "stringify",sourceColumn: 1,type: "string",role: "annotation" },2]);
     
      var options = 
      {
        title: "",
        bar: {groupWidth: "94%"}, // Espessura da coluna
        legend: { position: "none" },
       'chartArea': {'width': '92%', 'height': '50%'},
        vAxis: 
        {
         title: '',viewWindow: {min: 0,},
        },
        hAxis: 
        {
         title: '',viewWindow: {min: 0,},
        },
      };
      
      
      
      var chart = new google.visualization.ColumnChart(document.getElementById("grafico_coluna"));
      
      chart.draw(view, options); // cria o grafico com opções
      google.visualization.events.addListener(chart, 'select', selectHandler);

     function selectHandler() 
     {
      var selection = chart.getSelection();
      
      var message = '';
      for (var i = 0; i < selection.length; i++) 
      {
       var item = selection[i];
       if (item.row != null && item.column != null) 
       {
        var str = data.getFormattedValue(item.row, item.column);
        var indice_coluna_selecionada = item.row;
        var quantidade_coluna = str;
        var label = (data.cache[item.row]);
        label = (label[0].Me);
        
        message = 'Indice: ' + indice_coluna_selecionada + ' Quantidade: ' + quantidade_coluna + ' Label: ' + label;
       }
     }  //Fecha o for
     if (message == '') 
     {
      message = 'Erro!';
  }
  
  
  //Agora trata o que faz com a mensagem
  if(label == 'Entrada CO')
  {
   location.href='./coluna_dashboard.php?label=Entrada CO&quantidade='+quantidade_coluna;
  }
  else if (label == 'Entrada BH')
  {
    location.href='./coluna_dashboard.php?label=Entrada BH&quantidade='+quantidade_coluna;
  }
  else if (label == 'Controles 1, 2 e 3')
  {
    location.href='./coluna_dashboard.php?label=Controles 1, 2 e 3&quantidade='+quantidade_coluna;
  }
  else if (label == 'Estoques')
  {
    location.href='./coluna_dashboard.php?label=Estoques&quantidade='+quantidade_coluna;      
  }
  else if (label == 'Excesso')
  {
    location.href='./coluna_dashboard.php?label=Excesso&quantidade='+quantidade_coluna;    
  }
  else if (label == 'Amostragem')
  {
    location.href='./coluna_dashboard.php?label=Amostragem&quantidade='+quantidade_coluna;   
  }
  else if (label == 'Balancas')
  {
    location.href='./coluna_dashboard.php?label=Balancas&quantidade='+quantidade_coluna;   
  }
  else if (label == 'Saída CO')
  {
    location.href='./coluna_dashboard.php?label=Saída CO&quantidade='+quantidade_coluna;    
  }
  else if (label == 'Saída BH')
  {
    location.href='./coluna_dashboard.php?label=Saída BH&quantidade='+quantidade_coluna;   
  }
  else
  {
    alert(message);
        
  }




        }
  
    }



    </script>


<script type="text/javascript" src="./charts_pizza.js"></script>
    <script type="text/javascript">

      
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

     
      



      function drawChart() 
      {
       var data = new google.visualization.DataTable();
        


       data.addColumn('string', 'Topping');
       data.addColumn('number', 'Slices');
       data.addRows([
        ['Abaixo de 20 min', abaixo_20],
        ['Acima de 20 min', acima_20],
        ['Acima de 30 min', acima_30],
        ['Acima de 40 min', acima_40],
        ['Acima de 1 hora', acima_1h],
        ['Acima de 3 horas', acima_3h],
      ]);
      var options = {
        title: "",
        legend: { position: "right" },
        'chartArea': {'width': '85%', 'height': '75%'},
        pieSliceText: 'percentage',
        'is3D':true
      };
       var chart = new google.visualization.PieChart(document.getElementById('grafico_permanencia'));
       chart.draw(data, options);
      }



// ********************************************************************************************************************
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
//window.location="login.php";
</script>
<?php
}
?>



<div id="grafico_coluna"></div>
<label id="titulo">Várzea do Lopes</label>
<img id="configuracoes" src="./images/configuracoes.png" onclick='configurar();'/>
<img id="atualizacao" src="./images/atualizacao.png" onclick='atualizar();'/>
<label id="lb_turno_atual" onclick="javascript: location.href='./tela_resumo_motoristas.php?vezes=0'">Turno Atual: Letra D </label>
<label id="lb_atualizacao" onclick="javascript: location.href='./tela_resumo_transportadoras.php?vezes=0'">17:39:05 - 19/02/2022</label>
<img id="voltar"  hidden="hidden" src="./images/btn_voltar.png"  onclick="javascript: location.href=`menu_ccl_mb.php?complemento=${criptografia2.value}&check=${criptografia.value}`;"/>
<div id='div_alerta'>
<img id="img_alerta" src="./images/alerta.png"  onclick="javascript: location.href='./tela_dispositivos.php'"/>
<label id='lb_n_alertas' name='lb_n_alertas'>0</label>
</div>


<script>

var link_alerta = document.getElementById('div_alerta');
link_alerta.style.visibility = 'hidden';

function clicou_alerta()
{
    alert('clicou alerta');
}


function pisca() 
{
 // Alerta de erros de dispositivos
 setInterval
 (
  function() 
  {
   //console.log('rodou');
   link_alerta.style.visibility = (link_alerta.style.visibility == 'hidden' ? '' : 'hidden');
  },1200
 );
}


function pisca_status1()
{
 //Alerta de status_1
 setInterval
 (
  function() 
  {
   link_status1.style.visibility = (link_status1.style.visibility == 'hidden' ? '' : 'hidden');
  },tempo_status1
 );
}
function pisca_status1_1()
{
 //Alerta de status_1_1
 setInterval
 (
  function() 
  {
   link_status1_1.style.visibility = (link_status1_1.style.visibility == 'hidden' ? '' : 'hidden');
  },tempo_status1_1
 );
}

function pisca_status2()
{
 //Alerta de status_2
 setInterval
 (
  function() 
  {
   link_status2.style.visibility = (link_status2.style.visibility == 'hidden' ? '' : 'hidden');
  },tempo_status2
 );
}

function pisca_status2_1()
{
 //Alerta de status_2_1
 setInterval
 (
  function() 
  {
   link_status2_1.style.visibility = (link_status2_1.style.visibility == 'hidden' ? '' : 'hidden');
  },tempo_status2_1
 );
}


function pisca_status3()
{
 //Alerta de status_3
 setInterval
 (
  function() 
  {
   link_status3.style.visibility = (link_status3.style.visibility == 'hidden' ? '' : 'hidden');
  },tempo_status3
 );
}

function pisca_status3_1()
{
 //Alerta de status_3_1
 setInterval
 (
  function() 
  {
   link_status3_1.style.visibility = (link_status3_1.style.visibility == 'hidden' ? '' : 'hidden');
  },tempo_status3_1
 );
}


function pisca_status4()
{
 //Alerta de status_4
 setInterval
 (
  function() 
  {
   link_status4.style.visibility = (link_status4.style.visibility == 'hidden' ? '' : 'hidden');
  },tempo_status4
 );
}

function pisca_status4_1()
{
 //Alerta de status_4_1
 setInterval
 (
  function() 
  {
   link_status4_1.style.visibility = (link_status4_1.style.visibility == 'hidden' ? '' : 'hidden');
  },tempo_status4_1
 );
}

var encontrados_erro = '<?php print $encontrado_erros ?>';
var link_n_alertas = document.getElementById('lb_n_alertas');
link_n_alertas.innerHTML = encontrados_erro;
if(encontrados_erro==0)
{
     //console.log('Nao tem erros, todos estao OK!');
}
else
{
 pisca();  
 //console.log( 'Existem '+ encontrados_erro + ' dispositivos com problema!');
}




var link_horario = window.document.getElementById('lb_atualizacao');
//alert(link_horario.innerHTML);
link_horario.innerHTML = '<?php print $hora2 ?>'+ " - " + '<?php print $data ?>';


var link_turno_atual = window.document.getElementById('lb_turno_atual');
link_turno_atual.innerHTML = '<?php print $turno_atual ?>';
</script>


<div id="alerta_tags" hidden='hidden'>
<img id="alerta" src="./images/alerta.png" hidden='hidden'/>
<label id='titulo_alerta1' hidden='hidden'>Tags</label>
<img id="cavalo" src="./images/cavalo_alerta.png" hidden='hidden'/>
<label id="alerta_cavalo" hidden='hidden'>1</label>
<img id="carreta" src="./images/carreta_alerta.png" hidden='hidden'/>
<label id="alerta_carreta" hidden='hidden'>3</label>

</div>




</script>


<div id="ultima_placa_entrada_co">
    <label id='lb_placa_entrada_co'>AVX-0422</label>
</div>


<div id="ultima_placa_entrada_bh">
<label id='lb_placa_entrada_bh'>WQR-3212</label>
</div>

<div id="ultima_placa_controles">
<label id='lb_placa_controles'>XWQ-1231</label>
</div>


<div id="ultima_placa_estoques">
<label id='lb_placa_estoques'>CWL-1337</label>
</div>


<div id="ultima_placa_Excesso">
<label id='lb_placa_Excesso'>VRX-0109</label>
</div>

<div id="ultima_placa_amostragem">
<label id='lb_placa_amostragem'>WER-0459</label>
</div>

<div id="ultima_placa_balancas">
<label id='lb_placa_balancas'>POQ-9912</label>
</div>


<div id="ultima_placa_saida_co">
<label id='lb_placa_saida_co'>QAS-1211</label>
    
</div>



<div id="ultima_placa_saida_bh">
<label id='lb_placa_saida_bh'>POO-1A76</label>
</div>

<label id='lb_ultima_placa_entrada_co'>00:00:00</label>
<label id='lb_ultima_placa_entrada_bh'>00:00:00</label>
<label id='lb_ultima_placa_controles'>00:00:00</label>
<label id='lb_ultima_placa_estoques'>00:00:00</label>
<label id='lb_ultima_placa_excesso'>00:00:00</label>
<label id='lb_ultima_placa_amostragem'>00:00:00</label>
<label id='lb_ultima_placa_balancas'>00:00:00</label>
<label id='lb_ultima_placa_saida_co'>00:00:00</label>
<label id='lb_ultima_placa_saida_bh'>00:00:00</label>


<label id="titulo_movimentacoes_turno" hidden='hidden'></label>
<label id="titulo_movimentacoes_turno2" hidden='hidden'></label>
<label id="titulo_movimentacoes_turno3" hidden='hidden'></label>
<label id="titulo_movimentacoes_turno_1" hidden='hidden'></label>
<label id="titulo_movimentacoes_turno_2" hidden='hidden'></label>
<label id="titulo_movimentacoes_turno_3" hidden='hidden'></label>



<script>
    
var link_placa_entrada_co = window.document.getElementById('lb_placa_entrada_co');
link_placa_entrada_co.innerHTML = ultima_placa_entrada_co;


var link_placa_entrada_bh = window.document.getElementById('lb_placa_entrada_bh');
link_placa_entrada_bh.innerHTML = ultima_placa_entrada_bh;

var link_placa_controles = window.document.getElementById('lb_placa_controles');
link_placa_controles.innerHTML = ultima_placa_controles;

var link_placa_estoques = window.document.getElementById('lb_placa_estoques');
link_placa_estoques.innerHTML = ultima_placa_estoques;

var link_placa_Excesso = window.document.getElementById('lb_placa_Excesso');
link_placa_Excesso.innerHTML = ultima_placa_Excesso;

var link_placa_amostragem = window.document.getElementById('lb_placa_amostragem');
link_placa_amostragem.innerHTML = ultima_placa_amostragem;

var link_placa_balancas = window.document.getElementById('lb_placa_balancas');
link_placa_balancas.innerHTML = ultima_placa_balancas;

var link_placa_saida_co = window.document.getElementById('lb_placa_saida_co');
link_placa_saida_co.innerHTML = ultima_placa_saida_co;

var link_placa_saida_bh = window.document.getElementById('lb_placa_saida_bh');
link_placa_saida_bh.innerHTML = ultima_placa_saida_bh;





//LINK PARA ATUALIZAR HORARIO DAS PLACAS
var link_lb_ultima_placa_entrada_co = window.document.getElementById('lb_ultima_placa_entrada_co');
link_lb_ultima_placa_entrada_co.innerHTML = '<?php print $lb_ultima_placa_entrada_co ?>';


var link_lb_ultima_placa_entrada_bh = window.document.getElementById('lb_ultima_placa_entrada_bh');
link_lb_ultima_placa_entrada_bh.innerHTML = '<?php print $lb_ultima_placa_entrada_bh ?>'

var link_lb_ultima_placa_controles = window.document.getElementById('lb_ultima_placa_controles');
link_lb_ultima_placa_controles.innerHTML = '<?php print $lb_ultima_placa_controles ?>'

var link_lb_ultima_placa_estoques = window.document.getElementById('lb_ultima_placa_estoques');
link_lb_ultima_placa_estoques.innerHTML = '<?php print $lb_ultima_placa_estoques ?>'

var link_lb_ultima_placa_excesso = window.document.getElementById('lb_ultima_placa_excesso');
link_lb_ultima_placa_excesso.innerHTML = '<?php print $lb_ultima_placa_excesso?>'

var link_lb_ultima_placa_amostragem = window.document.getElementById('lb_ultima_placa_amostragem');
link_lb_ultima_placa_amostragem.innerHTML = '<?php print $lb_ultima_placa_amostragem?>'

var link_lb_ultima_placa_balancas = window.document.getElementById('lb_ultima_placa_balancas');
link_lb_ultima_placa_balancas.innerHTML = '<?php print $lb_ultima_placa_balancas?>'

var link_lb_ultima_placa_saida_co = window.document.getElementById('lb_ultima_placa_saida_co');
link_lb_ultima_placa_saida_co.innerHTML = '<?php print $lb_ultima_placa_saida_co?>'


var link_lb_ultima_placa_saida_bh = window.document.getElementById('lb_ultima_placa_saida_bh');
link_lb_ultima_placa_saida_bh.innerHTML = '<?php print $lb_ultima_placa_saida_bh?>'




//alert(ultima_placa_entrada_co);

//Atualizo as movimentacoes
var link_turno1 = window.document.getElementById('titulo_movimentacoes_turno');
link_turno1.innerHTML = turno1;
var link_v_turno1 = window.document.getElementById('titulo_movimentacoes_turno_1');
link_v_turno1.innerHTML = v_turno1;

var link_turno2 = window.document.getElementById('titulo_movimentacoes_turno2');
link_turno2.innerHTML = turno2;
var link_v_turno2 = window.document.getElementById('titulo_movimentacoes_turno_2');
link_v_turno2.innerHTML = v_turno2;


var link_turno3 = window.document.getElementById('titulo_movimentacoes_turno3');
link_turno3.innerHTML = turno3;
var link_v_turno3 = window.document.getElementById('titulo_movimentacoes_turno_3');
link_v_turno3.innerHTML = v_turno3;



</script>


<div id="grafico_permanencia">


</div>


<div id="ttp" onclick='clicou_ttp();'>
<label id="titulo_ttp">Tempo de Permanência</label>
<label id="titulo_ttp_agora">TTP Dia</label>
<label id="titulo_ttp_agora1">0 MIN</label>
<label id="titulo_ttp_mes">TTP Mês</label>
<label id="titulo_ttp_mes1">0 MIN</label>
<label id="titulo_giro">GIRO ( Dia )</label>
<label id="titulo_giro1"><?php print $giro ?></label>

</div>



<div id="outros"></div>
<div id="tempos_medios">
<div id='fundo'></div>    
<label id="titulo_tm" onclick='clicou_chamar_ttp();'>Tempos Médio</label>
<label id="titulo_enc_antena"  onclick="javascript: location.href='./tela_resumo_giro_detalhado.php?vezes=0'">Antena: <?php print $enc_antena ?></label>
<label id="titulo_enc_job">JOB: </label>
<label id="titulo_enc_job2"><?php print $enc_job ?></label>
<label id="titulo_tm_turno">Turno</label>
<label id="titulo_tm_dia">Dia</label>
<label id="titulo_tm_mes">Mês</label>
<label id="titulo_tm_ano">Ano</label>

<img id="img_tm_1" src="./images/seta.png"/>
<img id="img_status_1" src="./images/aumentou.png"/>
<img id="img_status_1_1" src="./images/diminuiu.png"/>
<label id="tm_1">Entradas à CA's:</label>
<label id="tm_1_turno">00.0 MIN</label>
<label id="tm_1_dia">00.0 MIN</label>
<label id="tm_1_mes">00.0 MIN</label>
<label id="tm_1_ano">00.0 MIN</label>

<img id="img_tm_2" src="./images/seta.png"/>
<img id="img_status_2" src="./images/diminuiu.png"/>
<img id="img_status_2_1" src="./images/aumentou.png"/>
<label id="tm_2">Entradas à Saídas:</label>
<label id="tm_2_turno">00.0 MIN</label>
<label id="tm_2_dia">00.0 MIN</label>
<label id="tm_2_mes">00.0 MIN</label>
<label id="tm_2_ano">00.0 MIN</label>

<img id="img_tm_3" src="./images/seta.png"/>
<img id="img_status_3" src="./images/diminuiu.png"/>
<img id="img_status_3_1" src="./images/aumentou.png"/>
<label id="tm_3">CA's à Saídas:</label>
<label id="tm_3_turno">00.0 MIN</label>
<label id="tm_3_dia">00.0 MIN</label>
<label id="tm_3_mes">00.0 MIN</label>
<label id="tm_3_ano">00.0 MIN</label>

<img id="img_tm_4" src="./images/seta.png"/>
<img id="img_status_4" src="./images/manteve.png"/>
<img id="img_status_4_1" src="./images/manteve.png"/>
<label id="tm_4">CA's à Balanças:</label>
<label id="tm_4_turno">25.0 MIN</label>
<label id="tm_4_dia">27.2 MIN</label>
<label id="tm_4_mes">23.5 MIN</label>
<label id="tm_4_ano">24.1 MIN</label>





<script>

function clicou_ttp()
{
 //alert('clicou_ttp');
 var valor_do_mes = <?php print $valor_do_mes ?>;

 if (parseInt(valor_do_mes)<10)
 {
    location.href='./tela_encerramentos.php?mes=0'+ valor_do_mes;
 }
 else
 {
    location.href='./tela_encerramentos.php?mes='+ valor_do_mes; 
 }
 
}

function clicou_chamar_ttp()
{
    location.href='./tela_ttp.php';   
}



//Atualizo os tempos medios

//PARA DADOS RELACIONADOS A >>>>>>>>>>> ENTRADAS A CONTROLES <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
var link_tm_1_turno = window.document.getElementById('tm_1_turno');
var link_tm_1_dia = window.document.getElementById('tm_1_dia');
var link_tm_1_mes = window.document.getElementById('tm_1_mes');
var link_tm_1_ano = window.document.getElementById('tm_1_ano');

link_tm_1_turno.innerHTML = tm_v_turno_entradas_a_controles;
link_tm_1_dia.innerHTML = tm_v_dia_entradas_a_controles;
link_tm_1_mes.innerHTML = tm_v_mes_entradas_a_controles;
link_tm_1_ano.innerHTML = tm_v_ano_entradas_a_controles;

var limite_entradas_a_controles = '<?php print $tm_limite_entradas_a_controles ?>';
limite_entradas_a_controles = parseFloat(limite_entradas_a_controles);

var valor_link_tm_1_turno = parseFloat(link_tm_1_turno.innerHTML);
var valor_link_tm_1_dia = parseFloat(link_tm_1_dia.innerHTML);
var valor_link_tm_1_mes = parseFloat(link_tm_1_mes.innerHTML);
var valor_link_tm_1_ano = parseFloat(link_tm_1_ano.innerHTML);

link_tm_1_turno.innerHTML = tm_v_turno_entradas_a_controles + ' MIN';
link_tm_1_dia.innerHTML = tm_v_dia_entradas_a_controles + ' MIN';
link_tm_1_mes.innerHTML = tm_v_mes_entradas_a_controles + ' MIN';
link_tm_1_ano.innerHTML = tm_v_ano_entradas_a_controles + ' MIN';

if(valor_link_tm_1_turno > limite_entradas_a_controles)
{
 link_tm_1_turno.style.backgroundColor = '#FF6347'; // Cor vermelho
}
else
{
 link_tm_1_turno.style.backgroundColor = '#32CD32'; // Cor verde
}


if(valor_link_tm_1_dia > limite_entradas_a_controles)
{
 link_tm_1_dia.style.backgroundColor = '#FF6347'; // Cor vermelho
}
else
{
 link_tm_1_dia.style.backgroundColor = '#32CD32'; // Cor verde
}

if(valor_link_tm_1_mes > limite_entradas_a_controles)
{
 link_tm_1_mes.style.backgroundColor = '#FF6347'; // Cor vermelho
}
else
{
 link_tm_1_mes.style.backgroundColor = '#32CD32'; // Cor verde
}

if(valor_link_tm_1_ano > limite_entradas_a_controles)
{
 link_tm_1_ano.style.backgroundColor = '#FF6347'; // Cor vermelho
}
else
{
 link_tm_1_ano.style.backgroundColor = '#32CD32'; // Cor verde
}







//PARA DADOS RELACIONADOS A >>>>>>>>>>> ENTRADAS A SAIDAS <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
var link_tm_2_turno = window.document.getElementById('tm_2_turno');
var link_tm_2_dia = window.document.getElementById('tm_2_dia');
var link_tm_2_mes = window.document.getElementById('tm_2_mes');
var link_tm_2_ano = window.document.getElementById('tm_2_ano');

link_tm_2_turno.innerHTML = tm_v_turno_entradas_a_saidas;
link_tm_2_dia.innerHTML = tm_v_dia_entradas_a_saidas;
link_tm_2_mes.innerHTML = tm_v_mes_entradas_a_saidas;
link_tm_2_ano.innerHTML = tm_v_ano_entradas_a_saidas;

var limite_entradas_a_saidas = '<?php print $tm_limite_entradas_a_saidas ?>';
limite_entradas_a_saidas = parseFloat(limite_entradas_a_saidas);

var valor_link_tm_2_turno = parseFloat(link_tm_2_turno.innerHTML);
var valor_link_tm_2_dia = parseFloat(link_tm_2_dia.innerHTML);
var valor_link_tm_2_mes = parseFloat(link_tm_2_mes.innerHTML);
var valor_link_tm_2_ano = parseFloat(link_tm_2_ano.innerHTML);

link_tm_2_turno.innerHTML = tm_v_turno_entradas_a_saidas + ' MIN';
link_tm_2_dia.innerHTML = tm_v_dia_entradas_a_saidas + ' MIN';
link_tm_2_mes.innerHTML = '<?php print $ttp_mes_entrada ?>' + ' MIN';
link_tm_2_ano.innerHTML = tm_v_ano_entradas_a_saidas + ' MIN';

if(valor_link_tm_2_turno > limite_entradas_a_saidas)
{
 link_tm_2_turno.style.backgroundColor = '#FF6347'; // Cor vermelho
}
else
{
 link_tm_2_turno.style.backgroundColor = '#32CD32'; // Cor verde
}


if(valor_link_tm_2_dia > limite_entradas_a_saidas)
{
 link_tm_2_dia.style.backgroundColor = '#FF6347'; // Cor vermelho
}
else
{
 link_tm_2_dia.style.backgroundColor = '#32CD32'; // Cor verde
}

if(valor_link_tm_2_mes > limite_entradas_a_saidas)
{
 link_tm_2_mes.style.backgroundColor = '#FF6347'; // Cor vermelho
}
else
{
 link_tm_2_mes.style.backgroundColor = '#32CD32'; // Cor verde
}

if(valor_link_tm_2_ano > limite_entradas_a_saidas)
{
 link_tm_2_ano.style.backgroundColor = '#FF6347'; // Cor vermelho
}
else
{
 link_tm_2_ano.style.backgroundColor = '#32CD32'; // Cor verde
}


//PARA DADOS RELACIONADOS A >>>>>>>>>>> CONTROLES A SAIDAS <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
var link_tm_3_turno = window.document.getElementById('tm_3_turno');
var link_tm_3_dia = window.document.getElementById('tm_3_dia');
var link_tm_3_mes = window.document.getElementById('tm_3_mes');
var link_tm_3_ano = window.document.getElementById('tm_3_ano');

link_tm_3_turno.innerHTML = tm_v_turno_controles_a_saidas;
link_tm_3_dia.innerHTML = tm_v_dia_controles_a_saidas;
link_tm_3_mes.innerHTML = tm_v_mes_controles_a_saidas;
link_tm_3_ano.innerHTML = tm_v_ano_controles_a_saidas;

var limite_controles_a_saidas = '<?php print $tm_limite_controles_a_saidas ?>';
limite_controles_a_saidas = parseFloat(limite_controles_a_saidas);

var valor_link_tm_3_turno = parseFloat(link_tm_3_turno.innerHTML);
var valor_link_tm_3_dia = parseFloat(link_tm_3_dia.innerHTML);
var valor_link_tm_3_mes = parseFloat(link_tm_3_mes.innerHTML);
var valor_link_tm_3_ano = parseFloat(link_tm_3_ano.innerHTML);

link_tm_3_turno.innerHTML = tm_v_turno_controles_a_saidas + ' MIN';
link_tm_3_dia.innerHTML = tm_v_dia_controles_a_saidas + ' MIN';
link_tm_3_mes.innerHTML = '<?php print $ttp_mes ?>' + ' MIN';
link_tm_3_ano.innerHTML = tm_v_ano_controles_a_saidas + ' MIN';

if(valor_link_tm_3_turno > limite_controles_a_saidas)
{
 link_tm_3_turno.style.backgroundColor = '#FF6347'; // Cor vermelho
}
else
{
 link_tm_3_turno.style.backgroundColor = '#32CD32'; // Cor verde
}


if(valor_link_tm_3_dia > limite_controles_a_saidas)
{
 link_tm_3_dia.style.backgroundColor = '#FF6347'; // Cor vermelho
}
else
{
 link_tm_3_dia.style.backgroundColor = '#32CD32'; // Cor verde
}

if(valor_link_tm_3_mes > limite_controles_a_saidas)
{
 link_tm_3_mes.style.backgroundColor = '#FF6347'; // Cor vermelho
}
else
{
 link_tm_3_mes.style.backgroundColor = '#32CD32'; // Cor verde
}

if(valor_link_tm_3_ano > limite_controles_a_saidas)
{
 link_tm_3_ano.style.backgroundColor = '#FF6347'; // Cor vermelho
}
else
{
 link_tm_3_ano.style.backgroundColor = '#32CD32'; // Cor verde
}



//PARA DADOS RELACIONADOS A >>>>>>>>>>> CONTROLES A BALANCAS <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
var link_tm_4_turno = window.document.getElementById('tm_4_turno');
var link_tm_4_dia = window.document.getElementById('tm_4_dia');
var link_tm_4_mes = window.document.getElementById('tm_4_mes');
var link_tm_4_ano = window.document.getElementById('tm_4_ano');

link_tm_4_turno.innerHTML = tm_v_turno_controles_a_balancas;
link_tm_4_dia.innerHTML = tm_v_dia_controles_a_balancas;
link_tm_4_mes.innerHTML = tm_v_mes_controles_a_balancas;
link_tm_4_ano.innerHTML = tm_v_ano_controles_a_balancas;

var limite_controles_a_balancas = '<?php print $tm_limite_controles_a_balancas ?>';
limite_controles_a_balancas = parseFloat(limite_controles_a_balancas);

var valor_link_tm_4_turno = parseFloat(link_tm_4_turno.innerHTML);
var valor_link_tm_4_dia = parseFloat(link_tm_4_dia.innerHTML);
var valor_link_tm_4_mes = parseFloat(link_tm_4_mes.innerHTML);
var valor_link_tm_4_ano = parseFloat(link_tm_4_ano.innerHTML);

link_tm_4_turno.innerHTML = tm_v_turno_controles_a_balancas + ' MIN';
link_tm_4_dia.innerHTML = tm_v_dia_controles_a_balancas + ' MIN';
link_tm_4_mes.innerHTML = tm_v_mes_controles_a_balancas + ' MIN';
link_tm_4_ano.innerHTML = tm_v_ano_controles_a_balancas + ' MIN';

if(valor_link_tm_4_turno > limite_controles_a_balancas)
{
 link_tm_4_turno.style.backgroundColor = '#FF6347'; // Cor vermelho
}
else
{
 link_tm_4_turno.style.backgroundColor = '#32CD32'; // Cor verde
}


if(valor_link_tm_4_dia > limite_controles_a_balancas)
{
 link_tm_4_dia.style.backgroundColor = '#FF6347'; // Cor vermelho
}
else
{
 link_tm_4_dia.style.backgroundColor = '#32CD32'; // Cor verde
}

if(valor_link_tm_4_mes > limite_controles_a_balancas)
{
 link_tm_4_mes.style.backgroundColor = '#FF6347'; // Cor vermelho
}
else
{
 link_tm_4_mes.style.backgroundColor = '#32CD32'; // Cor verde
}

if(valor_link_tm_4_ano > limite_controles_a_balancas)
{
 link_tm_4_ano.style.backgroundColor = '#FF6347'; // Cor vermelho
}
else
{
 link_tm_4_ano.style.backgroundColor = '#32CD32'; // Cor verde
}



</script>



<label id="titulo_movimentacoes_turno">Turno 1 (<?php print $turno1 ?>)</label>
<label id="titulo_movimentacoes_turno_1"><?php print $v_turno1 ?></label>
<label id="titulo_movimentacoes_turno_1_ant">Ant: 0</label>
<label id="titulo_movimentacoes_turno_1_job">JOB: 0</label>

<label id="titulo_movimentacoes_turno2">Turno 2 (<?php print $turno2 ?>)</label>
<label id="titulo_movimentacoes_turno_2"><?php print $v_turno2 ?></label>
<label id="titulo_movimentacoes_turno_2_ant">Ant: 0</label>
<label id="titulo_movimentacoes_turno_2_job">JOB: 0</label>

<label id="titulo_movimentacoes_turno3">Turno 3 (<?php print $turno3 ?>)</label>
<label id="titulo_movimentacoes_turno_3"><?php print $v_turno3 ?></label>
<label id="titulo_movimentacoes_turno_3_ant">Ant: 0</label>
<label id="titulo_movimentacoes_turno_3_job">JOB: 0</label>

<label id="titulo_movimentacoes_dia">Movimentações: </label>
<label id="titulo_movimentacoes_dia_1"></label>

<label id="titulo_placas_dia_1">000</label>
<img id="motorista" src="./images/motorista.png" />
<label id="titulo_placas_dia_2">000</label>
<img id="placas" src="./images/placas.png" />
</div>




<script>

//  TRATA OS JOBS ******************************************************************************
var numero_jobs = '<?php print $enc_job ?>';


var porcentagem_job = (numero_jobs/numero_viagens)*100;

var link_enc_job2 = document.getElementById('titulo_enc_job2');
//console.log(porcentagem_job);
if(porcentagem_job>=10)
{
 //Alerta   
 link_enc_job2.style.color = "#FF4500";
// console.log('alerta');
}
else
{
 link_enc_job2.style.color = "#000000"; // Esta abaixo de 10%
 //console.log('ok');
}



var link_v_dia = window.document.getElementById('titulo_movimentacoes_dia');
link_v_dia.innerHTML = "Movimentações: "+v_dia;
console.log("dado = "+v_dia);


function atualizar()
{
  //alert('entrou');
  
        
document.location.reload(true);
}

function configurar()
{
  alert('Em desenvolvimento!');
  
        

}




function atualizar2()
{

  //alert('entrou');
    
    $.ajax({
           url: 'verifica_dispositivos.php',
           type: 'GET',
           
           success: function(resultado){
               console.log('Atualizado dispositivos!');
           }
        });
    
    $.ajax({
           url: 'verifica_tempo.php',
           type: 'GET',
          
           success: function(resultado){
               console.log('Removidos : '+resultado);
           }
        });

}


var link_vezes = '<?php print $vezes ?>';
var link_nvezes = '<?php print $nvezes ?>';
var link_tempo = '<?php print $tempo ?>';

//Aqui faz a transicao de telas
if( link_vezes >= link_nvezes)
{
 location.href='./tela_resumo_giro_detalhado.php?vezes=0$nvezes=3';//Por default passo 2
}
else
{
 if(link_vezes != '-1')
 {
    window.setTimeout( "location.href=`./dashboard_vl.php?vezes=${'<?php print $vezes ?>'}&nvezes=${'<?php print $nvezes ?>'}&tempo=${'<?php print $tempo ?>'}`",link_tempo);
 }   


}
</script>
<h3 id="lb_desenvolvedor">Desenvolvido por: Bruno Gonçalves </h3>


<script>



var ant_v_turno1 = '<?php print $ant_v_turno1 ?>';
var ant_v_turno2 = '<?php print $ant_v_turno2 ?>';
var ant_v_turno3 = '<?php print $ant_v_turno3 ?>';
var job_v_turno1 = '<?php print $job_v_turno1 ?>';
var job_v_turno2 = '<?php print $job_v_turno2 ?>';
var job_v_turno3 = '<?php print $job_v_turno3 ?>';

var dez_porcento_job1 = 0;
var dez_porcento_job2 = 0;
var dez_porcento_job3 = 0;


dez_porcento_job1 = (ant_v_turno1*10)/100;
dez_porcento_job2 = (ant_v_turno2*10)/100;
dez_porcento_job3 = (ant_v_turno3*10)/100;

var link_ant_v_turno1 = document.getElementById('titulo_movimentacoes_turno_1_ant'); 
var link_ant_v_turno2 = document.getElementById('titulo_movimentacoes_turno_2_ant'); 
var link_ant_v_turno3 = document.getElementById('titulo_movimentacoes_turno_3_ant'); 

var link_job_v_turno1 = document.getElementById('titulo_movimentacoes_turno_1_job'); 
var link_job_v_turno2 = document.getElementById('titulo_movimentacoes_turno_2_job'); 
var link_job_v_turno3 = document.getElementById('titulo_movimentacoes_turno_3_job'); 

link_ant_v_turno1.innerHTML = 'Ant: ' + ant_v_turno1;
link_ant_v_turno2.innerHTML = 'Ant: ' + ant_v_turno2;
link_ant_v_turno3.innerHTML = 'Ant: ' + ant_v_turno3;




if(job_v_turno1>dez_porcento_job1)
{
 //Vermelho
 link_job_v_turno1.innerHTML = ' - JOB: '+'<b><font color="#F00000">' + job_v_turno1 + '</b></font>';
}
else
{
 // Verde
 link_job_v_turno1.innerHTML = ' - JOB: '+'<b><font color="#008000">' + job_v_turno1 + '</b></font>';
}


if(job_v_turno2>dez_porcento_job2)
{
 //Vermelho
 link_job_v_turno2.innerHTML = ' - JOB: '+'<b><font color="#F00000">' + job_v_turno2 + '</b></font>';
}
else
{
 // Verde
 link_job_v_turno2.innerHTML = ' - JOB: '+'<b><font color="#008000">' + job_v_turno2 + '</b></font>';
}


if(job_v_turno3>dez_porcento_job3)
{
 //Vermelho
 link_job_v_turno3.innerHTML = ' - JOB: '+'<b><font color="#F00000">' + job_v_turno3 + '</b></font>';
}
else
{
 // Verde
 link_job_v_turno3.innerHTML = ' - JOB: '+'<b><font color="#008000">' + job_v_turno3 + '</b></font>';
}

// TTP DO DIA *******************************************************************************
var ttp_dia = '<?php print $ttp_dia ?>';
var link_ttp_dia = document.getElementById('titulo_ttp_agora1');
var referencia_ca_a_saida = '<?php print $referencia_ttp_ca_a_saida ?>';
if(ttp_dia<=referencia_ca_a_saida)
{
 //Verde   
 link_ttp_dia.innerHTML = '<b><font color="#008000">' + ttp_dia + ' MIN</b></font>';    
}
else
{
 //Vermelho
 link_ttp_dia.innerHTML = '<b><font color="#F00000">' + ttp_dia + ' MIN</b></font>';    
}

//TTP DO MES **********************************************************************************

var ttp_mes= '<?php print $ttp_mes ?>';
var link_ttp_mes = document.getElementById('titulo_ttp_mes1');
var referencia_ca_a_saida = '<?php print $referencia_ttp_ca_a_saida ?>';
if(ttp_mes<=referencia_ca_a_saida)
{
 //Verde   
 link_ttp_mes.innerHTML = '<b><font color="#008000">' + ttp_mes + ' MIN</b></font>';    
}
else
{
 //Vermelho
 link_ttp_mes.innerHTML = '<b><font color="#F00000">' + ttp_mes + ' MIN</b></font>';    
}





// COMANDO PARA PISCAR A IMAGEM STATUS1 *****************************************
var link_status1 = document.getElementById('img_status_1');
var link_valor1 = parseFloat('<?php print $tm_v_turno_entradas_a_controles ?>');
var link_u_valor1 = parseFloat('<?php print $u_tm_v_turno_entradas_a_controles ?>');
//console.log( 'Valor1 = ' + link_valor1);
//console.log( 'UValor1 = ' + link_u_valor1);

if(link_valor1>link_u_valor1)
{
 //console.log('maior');  
 link_status1.src="./images/aumentou.png";
}
else if(link_valor1<link_u_valor1)
{
 //console.log('menor');   
 link_status1.src="./images/diminuiu.png";
}
else
{
 //console.log('igual');   
 link_status1.src="./images/manteve.png";
}



link_status1.style.visibility = 'hidden';
var tempo_status1 = 1000;
nome_imagem1 = link_status1.src.toString();
if( nome_imagem1.indexOf("aumentou") != -1 )
{
 tempo_status1 = 500;
 pisca_status1();
}
else if( nome_imagem1.indexOf("diminuiu") != -1 )
{
 tempo_status1 = 1500;
 pisca_status1();
}
else if (nome_imagem1.indexOf("manteve") != -1)
{
 link_status1.style.visibility = 'visible'   
}
//****************************************************************************** */

// COMANDO PARA PISCAR A IMAGEM STATUS1_1 *****************************************
var link_status1_1 = document.getElementById('img_status_1_1');
var link_valor1_1 = parseFloat('<?php print $tm_v_dia_entradas_a_controles ?>');
var link_u_valor1_1 = parseFloat('<?php print $u_tm_v_dia_entradas_a_controles ?>');
//console.log( 'Valor1 = ' + link_valor1);
//console.log( 'UValor1 = ' + link_u_valor1);

if(link_valor1_1>link_u_valor1_1)
{
 //console.log('maior');  
 link_status1_1.src="./images/aumentou.png";
}
else if(link_valor1_1<link_u_valor1_1)
{
 //console.log('menor');   
 link_status1_1.src="./images/diminuiu.png";
}
else
{
 //console.log('igual');   
 link_status1_1.src="./images/manteve.png";
}
link_status1_1.style.visibility = 'hidden';
var tempo_status1_1 = 1000;
nome_imagem1_1 = link_status1_1.src.toString();
if( nome_imagem1_1.indexOf("aumentou") != -1 )
{
 tempo_status1_1 = 500;
 pisca_status1_1();
}
else if( nome_imagem1_1.indexOf("diminuiu") != -1 )
{
 tempo_status1_1 = 1500;
 pisca_status1_1();
}
else if (nome_imagem1_1.indexOf("manteve") != -1)
{
 link_status1_1.style.visibility = 'visible'   
}
//****************************************************************************** */


// COMANDO PARA PISCAR A IMAGEM STATUS2 *****************************************
var link_status2 = document.getElementById('img_status_2');
var link_valor2 = parseFloat('<?php print $tm_v_turno_entradas_a_saidas ?>');
var link_u_valor2 = parseFloat('<?php print $u_tm_v_turno_entradas_a_saidas ?>');
//console.log( 'Valor1 = ' + link_valor1);
//console.log( 'UValor1 = ' + link_u_valor1);

if(link_valor2>link_u_valor2)
{
 //console.log('maior');  
 link_status2.src="./images/aumentou.png";
}
else if(link_valor2<link_u_valor2)
{
 //console.log('menor');   
 link_status2.src="./images/diminuiu.png";
}
else
{
 //console.log('igual');   
 link_status2.src="./images/manteve.png";
}


link_status2.style.visibility = 'hidden';
var tempo_status2 = 1000;
nome_imagem2 = link_status2.src.toString();
if( nome_imagem2.indexOf("aumentou") != -1 )
{
 tempo_status2 = 500;
 pisca_status2();
}
else if( nome_imagem2.indexOf("diminuiu") != -1 )
{
 tempo_status2 = 1500;
 pisca_status2();
}
else if (nome_imagem2.indexOf("manteve") != -1)
{
 link_status2.style.visibility = 'visible'   
}
//****************************************************************************** */


// COMANDO PARA PISCAR A IMAGEM STATUS2_1 *****************************************
var link_status2_1 = document.getElementById('img_status_2_1');
var link_valor2_1 = parseFloat('<?php print $tm_v_dia_entradas_a_saidas ?>');
var link_u_valor2_1 = parseFloat('<?php print $u_tm_v_dia_entradas_a_saidas ?>');
//console.log( 'Valor1 = ' + link_valor1);
//console.log( 'UValor1 = ' + link_u_valor1);

if(link_valor2_1>link_u_valor2_1)
{
 //console.log('maior');  
 link_status2_1.src="./images/aumentou.png";
}
else if(link_valor2_1<link_u_valor2_1)
{
 //console.log('menor');   
 link_status2_1.src="./images/diminuiu.png";
}
else
{
 //console.log('igual');   
 link_status2_1.src="./images/manteve.png";
}
link_status2_1.style.visibility = 'hidden';
var tempo_status2_1 = 1000;
nome_imagem2_1 = link_status2_1.src.toString();
if( nome_imagem2_1.indexOf("aumentou") != -1 )
{
 tempo_status2_1 = 500;
 pisca_status2_1();
}
else if( nome_imagem2_1.indexOf("diminuiu") != -1 )
{
 tempo_status2_1 = 1500;
 pisca_status2_1();
}
else if (nome_imagem2_1.indexOf("manteve") != -1)
{
 link_status2_1.style.visibility = 'visible'   
}
//****************************************************************************** */



// COMANDO PARA PISCAR A IMAGEM STATUS3 *****************************************
var link_status3 = document.getElementById('img_status_3');
var link_valor3 = parseFloat('<?php print $tm_v_turno_controles_a_saidas ?>');
var link_u_valor3 = parseFloat('<?php print $u_tm_v_turno_controles_a_saidas ?>');
//console.log( 'Valor1 = ' + link_valor1);
//console.log( 'UValor1 = ' + link_u_valor1);

if(link_valor3>link_u_valor3)
{
 //console.log('maior');  
 link_status3.src="./images/aumentou.png";
}
else if(link_valor3<link_u_valor3)
{
 //console.log('menor');   
 link_status3.src="./images/diminuiu.png";
}
else
{
 //console.log('igual');   
 link_status3.src="./images/manteve.png";
}



link_status3.style.visibility = 'hidden';
var tempo_status3 = 1000;
nome_imagem3 = link_status3.src.toString();
if( nome_imagem3.indexOf("aumentou") != -1 )
{
 tempo_status3 = 500;
 pisca_status3();
}
else if( nome_imagem3.indexOf("diminuiu") != -1 )
{
 tempo_status3 = 1500;
 pisca_status3();
}
else if (nome_imagem3.indexOf("manteve") != -1)
{
 link_status3.style.visibility = 'visible'   
}
//****************************************************************************** */

// COMANDO PARA PISCAR A IMAGEM STATUS3_1 *****************************************
var link_status3_1 = document.getElementById('img_status_3_1');
var link_valor3_1 = parseFloat('<?php print $tm_v_dia_controles_a_saidas ?>');
var link_u_valor3_1 = parseFloat('<?php print $u_tm_v_dia_controles_a_saidas ?>');
//console.log( 'Valor1 = ' + link_valor1);
//console.log( 'UValor1 = ' + link_u_valor1);

if(link_valor3_1>link_u_valor3_1)
{
 //console.log('maior');  
 link_status3_1.src="./images/aumentou.png";
}
else if(link_valor3_1<link_u_valor3_1)
{
 //console.log('menor');   
 link_status3_1.src="./images/diminuiu.png";
}
else
{
 //console.log('igual');   
 link_status3_1.src="./images/manteve.png";
}
link_status3_1.style.visibility = 'hidden';
var tempo_status3_1 = 1000;
nome_imagem3_1 = link_status3_1.src.toString();
if( nome_imagem3_1.indexOf("aumentou") != -1 )
{
 tempo_status3_1 = 500;
 pisca_status3_1();
}
else if( nome_imagem3_1.indexOf("diminuiu") != -1 )
{
 tempo_status3_1 = 1500;
 pisca_status3_1();
}
else if (nome_imagem3_1.indexOf("manteve") != -1)
{
 link_status3_1.style.visibility = 'visible'   
}
//****************************************************************************** */




// COMANDO PARA PISCAR A IMAGEM STATUS4 *****************************************
var link_status4 = document.getElementById('img_status_4');
var link_valor4 = parseFloat('<?php print $tm_v_turno_controles_a_balancas ?>');
var link_u_valor4 = parseFloat('<?php print $u_tm_v_turno_controles_a_balancas ?>');
//console.log( 'Valor1 = ' + link_valor1);
//console.log( 'UValor1 = ' + link_u_valor1);

if(link_valor4>link_u_valor4)
{
 //console.log('maior');  
 link_status4.src="./images/aumentou.png";
}
else if(link_valor4<link_u_valor4)
{
 //console.log('menor');   
 link_status4.src="./images/diminuiu.png";
}
else
{
 //console.log('igual');   
 link_status4.src="./images/manteve.png";
}

link_status4.style.visibility = 'hidden';
var tempo_status4 = 1000;
nome_imagem4 = link_status4.src.toString();
if( nome_imagem4.indexOf("aumentou") != -1 )
{
 tempo_status4 = 500;
 pisca_status4();
}
else if( nome_imagem4.indexOf("diminuiu") != -1 )
{
 tempo_status4 = 1500;
 pisca_status4();
}
else if (nome_imagem4.indexOf("manteve") != -1)
{
 link_status4.style.visibility = 'visible'   
}
//****************************************************************************** */

// COMANDO PARA PISCAR A IMAGEM STATUS4_1 *****************************************
var link_status4_1 = document.getElementById('img_status_4_1');
var link_valor4_1 = parseFloat('<?php print $tm_v_dia_controles_a_balancas ?>');
var link_u_valor4_1 = parseFloat('<?php print $u_tm_v_dia_controles_a_balancas ?>');
//console.log( 'Valor1 = ' + link_valor1);
//console.log( 'UValor1 = ' + link_u_valor1);

if(link_valor4_1>link_u_valor4_1)
{
 //console.log('maior');  
 link_status4_1.src="./images/aumentou.png";
}
else if(link_valor4_1<link_u_valor4_1)
{
 //console.log('menor');   
 link_status4_1.src="./images/diminuiu.png";
}
else
{
 //console.log('igual');   
 link_status4_1.src="./images/manteve.png";
}
link_status4_1.style.visibility = 'hidden';
var tempo_status4_1 = 1000;
nome_imagem4_1 = link_status4_1.src.toString();
if( nome_imagem4_1.indexOf("aumentou") != -1 )
{
 tempo_status4_1 = 500;
 pisca_status4_1();
}
else if( nome_imagem4_1.indexOf("diminuiu") != -1 )
{
 tempo_status4_1 = 1500;
 pisca_status4_1();
}
else if (nome_imagem4_1.indexOf("manteve") != -1)
{
 link_status4_1.style.visibility = 'visible'   
}
//****************************************************************************** */








document.getElementById('titulo_placas_dia_1').innerHTML = <?php print $numero_motoristas ?>; // Motoristas
document.getElementById('titulo_placas_dia_2').innerHTML = <?php print $encontrado_placas ?>; // Placas

console.log("Placas = "+ '<?php print $encontrado_placas ?>');




    //Calculo do giro
    var v_giro= '<?php print $giro ?>';
    var link_giro = document.getElementById('titulo_giro1');
    if(v_giro>=3.0)
    {
     //Verde   
     link_giro.innerHTML = '<b><font color="#008000">' + v_giro + ' </b></font>';    
    }
    else
    {
     //Vermelho
     link_giro.innerHTML = '<b><font color="#F00000">' + v_giro + ' </b></font>';    
    }



</script>





</body>
</html>
<style>


    
#lb_desenvolvedor{
    margin-left: 0px;
    position: absolute;
    left: 40%;
    top: 95%;
    font: normal 12pt verdana;
    color: rgba(0,0,0,0.7);
}
IMG#voltar{
    margin-left: 0px;
    position: absolute;
    left: 5px;
    top: 5px;
    width: 20px;
    height: 20px;
    cursor: pointer;

}
IMG#img_alerta{
    margin-left: 0px;
    position: absolute;
    left:94%;
    top: 4.3%;
    width: 42px;
    height: 46px;
    cursor: pointer;

}
LABEL#lb_n_alertas{
    position: absolute;
    left: 96%;
    top: 8%;
    font-style: italic;
	font-weight: bold;
	font-size: 12px;
	font-family: arial, sans-serif;
    background-color: #FF4500;
    width: 26px;
    padding-top: 5px;
   
    height: 22px;
    text-align: center;
    color: rgb(255,255,255);
    border-radius: 14px!important;
}

IMG#configuracoes{
    margin-left: 0px;
    position: absolute;
    left: 64%;
    top: 4.3%;
    width: 40px;
    height: 40px;
    cursor: pointer;

}


IMG#atualizacao{
    margin-left: 0px;
    position: absolute;
    left: 67.5%;
    top: 4.3%;
    width: 40px;
    height: 40px;
    cursor: pointer;

}
IMG#alerta{
    margin-left: 0px;
    position: absolute;
    left: 5%;
    top: 4%;
    width: 30px;
    height: 30px;
    cursor: pointer;

}
IMG#cavalo{
    margin-left: 0px;
    position: absolute;
    left: 3%;
    top: 30%;
    width: 50px;
    height: 40px;
    cursor: pointer;

}
IMG#carreta{
    margin-left: 0px;
    position: absolute;
    left: 3%;
    top: 60%;
    width: 58px;
    height: 32px;
    cursor: pointer;

}
DIV#grafico_coluna{
    margin-left: 0px;
    position: absolute;
    left: 3%;
    top: 2%;
    width: 95%;
    height: 45%;
    cursor: pointer;
    border-radius: 10px!important;
    border: 6px #000000 solid!important;

}

DIV#alerta_tags{
    margin-left: 0px;
    position: absolute;
    left: 88%;
    top: 4%;
    width: 9%;
    height: 20%;
    cursor: pointer;
    background-color: #E6E6FA;
    border-radius: 10px!important;
    border: 4px #000000 solid!important;

}
LABEL#titulo_alerta1{
    position: absolute;
    left: 35%;
    top: 6%;
    font-style: italic;
	font-weight: bold;
	font-size: 20px;
	font-family: arial, sans-serif;
}




DIV#grafico_permanencia{
    margin-left: 0px;
    position: absolute;
    left: 63%;
    top: 50%;
    width: 35%;
    height: 45%;
    margin: 0px;
    padding-left: 0px;
    cursor: pointer;
    border-radius: 10px!important;
    border: 6px #000000 solid!important;

}





DIV#outros{
    margin-left: 0px;
    position: absolute;
    left: 3%;
    top: 50%;
    width: 58.3%;
    height: 45%;
    cursor: pointer;
    background-color: rgb(255,255,255);
    border-radius: 10px!important;
    border: 6px #000000 solid!important;

}

DIV#tempos_medios{
    margin-left: 0px;
    position: absolute;
    left: 5%;
    top: 52%;
    width: 55.3%;
    height: 30%;
    cursor: pointer;
    background-color: transparent;


}

DIV#fundo{
    margin-left: 0px;
    position: absolute;
    left: -1%;
    top: 15%;
    width: 101.5%;
    height: 93%;
    cursor: pointer;
    background-color:  #E6E6FA;
    border-radius: 2px!important;
    border: 2px #000000 solid!important;


}
LABEL#titulo_tm{
    position: absolute;
    left: 4%;
    top: -2%;
    font-style: italic;
	font-weight: bold;
	font-size: 27px;
	font-family: arial, sans-serif;
}

LABEL#titulo_enc_antena{
    position: absolute;
    left: 52%;
    top: -2%;
    font-style: italic;
	font-weight: bold;
	font-size: 27px;
	font-family: arial, sans-serif;
}
LABEL#titulo_enc_job{
    position: absolute;
    left: 80%;
    top: -2%;
    font-style: italic;
	font-weight: bold;
	font-size: 27px;
	font-family: arial, sans-serif;
}
LABEL#titulo_enc_job2{
    position: absolute;
    left: 89%;
    top: -2%;
    font-style: italic;
	font-weight: bold;
	font-size: 27px;
	font-family: arial, sans-serif;
}

LABEL#titulo_tm_turno{
    position: absolute;
    left: 37%;
    top: 18%;
    font-style: italic;
	font-weight: bold;
	font-size: 25px;
	font-family: arial, sans-serif;
}
LABEL#titulo_tm_dia{
    position: absolute;
    left: 57%;
    top: 18%;
    font-style: italic;
	font-weight: bold;
	font-size: 25px;
	font-family: arial, sans-serif;
}
LABEL#titulo_tm_mes{
    position: absolute;
    left: 73%;
    top: 18%;
    font-style: italic;
	font-weight: bold;
	font-size: 25px;
	font-family: arial, sans-serif;
}
LABEL#titulo_tm_ano{
    position: absolute;
    left: 89%;
    top: 18%;
    font-style: italic;
	font-weight: bold;
	font-size: 25px;
	font-family: arial, sans-serif;
}


IMG#img_tm_1{
    margin-left: 0px;
    position: absolute;
    left: 0%;
    top: 35%;
    width: 39px;
    height: 28px;
    cursor: pointer;

}
IMG#img_status_1{
    margin-left: 0px;
    position: absolute;
    left: 31%;
    top: 37%;
    width: 20px;
    height: 20px;
    cursor: pointer;

}
IMG#img_status_1_1{
    margin-left: 0px;
    position: absolute;
    left: 50%;
    top: 37%;
    width: 20px;
    height: 20px;
    cursor: pointer;

}
LABEL#tm_1{
    position: absolute;
    left: 7%;
    top: 35%;
    font-style: italic;
	font-weight: bold;
	font-size: 20px;
	font-family: arial, sans-serif;
}
LABEL#tm_1_turno{
    position: absolute;
    left: 34.5%;
    top: 34%;
    font-style: italic;
	font-weight: bold;
	font-size: 20px;
	font-family: arial, sans-serif;
    border-radius: 0px!important;
    border: 2px #000000 solid!important;
    padding-top: 5px;
    padding-bottom: 5px;
    width: 12.9%;
    text-align:center;
    
}
LABEL#tm_1_dia{
    position: absolute;
    left: 53%;
    top: 34%;
    font-style: italic;
	font-weight: bold;
	font-size: 20px;
	font-family: arial, sans-serif;
    border-radius: 0px!important;
    border: 2px #000000 solid!important;
    padding-top: 5px;
    padding-bottom: 5px;
    width: 12.9%;
    text-align:center;

}
LABEL#tm_1_mes{
    position: absolute;
    left: 69.5%;
    top: 34%;
    font-style: italic;
	font-weight: bold;
	font-size: 20px;
	font-family: arial, sans-serif;
    border-radius: 0px!important;
    border: 2px #000000 solid!important;
    padding-top: 5px;
    padding-bottom: 5px;
    width: 12.9%;
    text-align:center;
    
}
LABEL#tm_1_ano{
    position: absolute;
    left: 86%;
    top: 34%;
    font-style: italic;
	font-weight: bold;
	font-size: 20px;
	font-family: arial, sans-serif;
    border-radius: 0px!important;
    border: 2px #000000 solid!important;
    padding-top: 5px;
    padding-bottom: 5px;
    width: 12.9%;
    text-align:center;

}


IMG#img_tm_2{
    margin-left: 0px;
    position: absolute;
    left: 0%;
    top: 54%;
    width: 39px;
    height: 28px;
    cursor: pointer;

}
IMG#img_status_2{
    margin-left: 0px;
    position: absolute;
    left: 31%;
    top: 56%;
    width: 20px;
    height: 20px;
    cursor: pointer;

}
IMG#img_status_2_1{
    margin-left: 0px;
    position: absolute;
    left: 50%;
    top: 56%;
    width: 20px;
    height: 20px;
    cursor: pointer;

}
LABEL#tm_2{
    position: absolute;
    left: 7%;
    top: 54%;
    font-style: italic;
	font-weight: bold;
	font-size: 20px;
	font-family: arial, sans-serif;
}
LABEL#tm_2_turno{
    position: absolute;
    left: 34.5%;
    top: 51%;
    font-style: italic;
	font-weight: bold;
	font-size: 20px;
	font-family: arial, sans-serif;
    border-radius: 0px!important;
    border: 2px #000000 solid!important;
    padding-top: 5px;
    padding-bottom: 5px;
    width: 12.9%;
    text-align:center;

}
LABEL#tm_2_dia{
    position: absolute;
    left: 53%;
    top: 51%;
    font-style: italic;
	font-weight: bold;
	font-size: 20px;
	font-family: arial, sans-serif;
    border-radius: 0px!important;
    border: 2px #000000 solid!important;
    padding-top: 5px;
    padding-bottom: 5px;
    width: 12.9%;
    text-align:center;

}
LABEL#tm_2_mes{
    position: absolute;
    left: 69.5%;
    top: 51%;
    font-style: italic;
	font-weight: bold;
	font-size: 20px;
	font-family: arial, sans-serif;
    border-radius: 0px!important;
    border: 2px #000000 solid!important;
    padding-top: 5px;
    padding-bottom: 5px;
    width: 12.9%;
    text-align:center;

}
LABEL#tm_2_ano{
    position: absolute;
    left: 86%;
    top: 51%;
    font-style: italic;
	font-weight: bold;
	font-size: 20px;
	font-family: arial, sans-serif;
    border-radius: 0px!important;
    border: 2px #000000 solid!important;
    padding-top: 5px;
    padding-bottom: 5px;
    width: 12.9%;
    text-align:center;


}


IMG#img_tm_3{
    margin-left: 0px;
    position: absolute;
    left: 0%;
    top: 72%;
    width: 39px;
    height: 28px;
    cursor: pointer;

}
IMG#img_status_3{
    margin-left: 0px;
    position: absolute;
    left: 31%;
    top: 73%;
    width: 20px;
    height: 20px;
    cursor: pointer;

}
IMG#img_status_3_1{
    margin-left: 0px;
    position: absolute;
    left: 50%;
    top: 73%;
    width: 20px;
    height: 20px;
    cursor: pointer;

}
LABEL#tm_3{
    position: absolute;
    left: 7%;
    top: 72%;
    font-style: italic;
	font-weight: bold;
	font-size: 20px;
	font-family: arial, sans-serif;
}
LABEL#tm_3_turno{
    position: absolute;
    left: 34.5%;
    top: 68%;
    font-style: italic;
	font-weight: bold;
	font-size: 20px;
	font-family: arial, sans-serif;
    border-radius: 0px!important;
    border: 2px #000000 solid!important;
    padding-top: 5px;
    padding-bottom: 5px;
    width: 12.9%;
    text-align:center;

}
LABEL#tm_3_dia{
    position: absolute;
    left: 53%;
    top: 68%;
    font-style: italic;
	font-weight: bold;
	font-size: 20px;
	font-family: arial, sans-serif;
    border-radius: 0px!important;
    border: 2px #000000 solid!important;
    padding-top: 5px;
    padding-bottom: 5px;
    width: 12.9%;
    text-align:center;

}
LABEL#tm_3_mes{
    position: absolute;
    left: 69.5%;
    top: 68%;
    font-style: italic;
	font-weight: bold;
	font-size: 20px;
	font-family: arial, sans-serif;
    border-radius: 0px!important;
    border: 2px #000000 solid!important;
    padding-top: 5px;
    padding-bottom: 5px;
    width: 12.9%;
    text-align:center;

}
LABEL#tm_3_ano{
    position: absolute;
    left: 86%;
    top: 68%;
    font-style: italic;
	font-weight: bold;
	font-size: 20px;
	font-family: arial, sans-serif;
    border-radius: 0px!important;
    border: 2px #000000 solid!important;
    padding-top: 5px;
    padding-bottom: 5px;
    width: 12.9%;
    text-align:center;


}

IMG#img_tm_4{
    margin-left: 0px;
    position: absolute;
    left: 0%;
    top: 90%;
    width: 39px;
    height: 28px;
    cursor: pointer;

}
IMG#img_status_4{
    margin-left: 0px;
    position: absolute;
    left: 31%;
    top: 89%;
    width: 20px;
    height: 20px;
    cursor: pointer;

}
IMG#img_status_4_1{
    margin-left: 0px;
    position: absolute;
    left: 50%;
    top: 89%;
    width: 20px;
    height: 20px;
    cursor: pointer;

}
LABEL#tm_4{
    position: absolute;
    left: 7%;
    top: 90%;
    font-style: italic;
	font-weight: bold;
	font-size: 20px;
	font-family: arial, sans-serif;
}
LABEL#tm_4_turno{
    position: absolute;
    left: 34.5%;
    top: 85%;
    font-style: italic;
	font-weight: bold;
	font-size: 20px;
	font-family: arial, sans-serif;
    border-radius: 0px!important;
    border: 2px #000000 solid!important;
    padding-top: 5px;
    padding-bottom: 5px;
    width: 12.9%;
    text-align:center;

}
LABEL#tm_4_dia{
    position: absolute;
    left: 53%;
    top: 85%;
    font-style: italic;
	font-weight: bold;
	font-size: 20px;
	font-family: arial, sans-serif;
    border-radius: 0px!important;
    border: 2px #000000 solid!important;
    padding-top: 5px;
    padding-bottom: 5px;
    width: 12.9%;
    text-align:center;

}
LABEL#tm_4_mes{
    position: absolute;
    left: 69.5%;
    top: 85%;
    font-style: italic;
	font-weight: bold;
	font-size: 20px;
	font-family: arial, sans-serif;
    border-radius: 0px!important;
    border: 2px #000000 solid!important;
    padding-top: 5px;
    padding-bottom: 5px;
    width: 12.9%;
    text-align:center;

}
LABEL#tm_4_ano{
    position: absolute;
    left: 86%;
    top: 85%;
    font-style: italic;
	font-weight: bold;
	font-size: 20px;
	font-family: arial, sans-serif;
    border-radius: 0px!important;
    border: 2px #000000 solid!important;
    padding-top: 5px;
    padding-bottom: 5px;
    width: 12.9%;
    text-align:center;


}


LABEL#titulo_movimentacoes_turno{
    position: absolute;
    left: 7%;
    top: 113%;
    font-style: italic;
	font-weight: bold;
	font-size: 20px;
	font-family: arial, sans-serif;
}
LABEL#titulo_movimentacoes_turno_1{
    position: absolute;
    left: 3%;
    top: 124%;
    font-style: italic;
	font-weight: bold;
	font-size: 18px;
	text-align: center;
    font-family: arial, sans-serif;
    border-radius: 10px!important;
    border: 2px #000000 solid!important;
    padding-top: 1px;
    padding-bottom: 8px;
    padding-left: 17px;
    padding-right: 17px;
    width: 15%;
    height: 15%;
    background-color: #E6E6FA;
}
LABEL#titulo_movimentacoes_turno_1_ant{
    position: absolute;
    left: 4.5%;
    top: 134%;
    font-style: italic;
	font-weight: bold;
	font-size: 16px;
	text-align: center;
    font-family: arial, sans-serif;
}
LABEL#titulo_movimentacoes_turno_1_job{
    position: absolute;
    left: 12.5%;
    top: 134%;
    font-style: italic;
	font-weight: bold;
	font-size: 16px;
	text-align: center;
    font-family: arial, sans-serif;
}
LABEL#titulo_movimentacoes_turno2{
    position: absolute;
    left: 27%;
    top: 113%;
    text-align: center;
    font-style: italic;
	font-weight: bold;
	font-size: 20px;
	font-family: arial, sans-serif;
}
LABEL#titulo_movimentacoes_turno_2{
    position: absolute;
    left: 23.5%;
    top: 124%;
    font-style: italic;
	font-weight: bold;
	font-size: 18px;
    text-align: center;
	font-family: arial, sans-serif;
    border-radius: 10px!important;
    border: 2px #000000 solid!important;
    padding-top: 1px;
    padding-bottom: 8px;
    padding-left: 17px;
    padding-right: 17px;
    width: 15%;
    height: 15%;
    background-color: #E6E6FA;
}
LABEL#titulo_movimentacoes_turno_2_ant{
    position: absolute;
    left: 25%;
    top: 134%;
    font-style: italic;
	font-weight: bold;
	font-size: 16px;
	text-align: center;
    font-family: arial, sans-serif;
}
LABEL#titulo_movimentacoes_turno_2_job{
    position: absolute;
    left: 33%;
    top: 134%;
    font-style: italic;
	font-weight: bold;
	font-size: 16px;
	text-align: center;
    font-family: arial, sans-serif;
}




LABEL#titulo_movimentacoes_turno3{
    position: absolute;
    left: 47%;
    top: 113%;
    font-style: italic;
	font-weight: bold;
	font-size: 20px;
	font-family: arial, sans-serif;
}
LABEL#titulo_movimentacoes_turno_3{
    position: absolute;
    left: 44%;
    top: 124%;
    font-style: italic;
	font-weight: bold;
	font-size: 18px;
    text-align: center;
	font-family: arial, sans-serif;
    border-radius: 10px!important;
    border: 2px #000000 solid!important;
    padding-top: 1px;
    padding-bottom: 8px;
    padding-left: 17px;
    padding-right: 17px;
    width: 15%;
    height: 15%;
    background-color: #E6E6FA;
}
LABEL#titulo_movimentacoes_turno_3_ant{
    position: absolute;
    left: 45.5%;
    top: 134%;
    font-style: italic;
	font-weight: bold;
	font-size: 16px;
	text-align: center;
    font-family: arial, sans-serif;
}
LABEL#titulo_movimentacoes_turno_3_job{
    position: absolute;
    left: 53.5%;
    top: 134%;
    font-style: italic;
	font-weight: bold;
	font-size: 16px;
	text-align: center;
    font-family: arial, sans-serif;
}

LABEL#titulo_movimentacoes_dia{
    position: absolute;
    left: 68.5%;
    top: 113%;
    font-style: italic;
	font-weight: bold;
	font-size: 20px;
	font-family: arial, sans-serif;
}
LABEL#titulo_movimentacoes_dia_1{
    position: absolute;
    left: 69%;
    top: 124%;
    font-style: italic;
	font-weight: bold;
	font-size: 20px;
    text-align: center;
	font-family: arial, sans-serif;
    border-radius: 10px!important;
    border: 2px #000000 solid!important;
    padding-top: 2px;
    padding-bottom: 12px;
    padding-left: 17px;
    padding-right: 17px;
    width: 24%;
    height: 13%;
    background-color: #E6E6FA;
}




IMG#motorista{
    margin-left: 0px;
    position: absolute;
    left: 70%;
    top: 127%;
    width: 40px;
    height: 40px;
    cursor: pointer;

}
LABEL#titulo_placas_dia_1{
    position: absolute;
    left: 76%;
    top: 129%;
    font-style: italic;
	font-weight: bold;
	font-size: 26px;
    font-family: arial, sans-serif;
    
}

IMG#placas{
    margin-left: 0px;
    position: absolute;
    left: 83%;
    top: 127.5%;
    width: 70px;
    height: 36px;
    cursor: pointer;

}
LABEL#titulo_placas_dia_2{
    position: absolute;
    left: 92%;
    top: 129%;
    font-style: italic;
	font-weight: bold;
	font-size: 26px;
    font-family: arial, sans-serif;
    
}
DIV#ttp{
    margin-left: 0px;
    position: absolute;
    left: 85.5%;
    top: 72%;
    width: 11%;
    height: 21%;
    background-color: #E6E6FA;
    cursor: pointer;
    border-radius: 8px!important;
    border: 4px #000000 solid!important;

}


LABEL#alerta_cavalo{
    position: absolute;
    left: 58%;
    top: 27%;
    font-style: italic;
    color: #00008B;
	font-weight: bold;
	font-size: 36px;
	font-family: arial;
}

LABEL#alerta_carreta{
    position: absolute;
    left: 58%;
    top: 55%;
    font-style: italic;
    color: #00008B;
	font-weight: bold;
	font-size: 36px;
	font-family: arial;
}


LABEL#titulo_ttp{
    position: absolute;
    left: -120%;
    top: -100%;
    font-style: italic;
	font-weight: bold;
	font-size: 25px;
	font-family: arial, sans-serif;
}
LABEL#titulo_ttp_agora{
    position: absolute;
    left: 5%;
    top: 3%;
    font-style: italic;
	font-weight: bold;
	font-size: 20px;
	font-family: arial, sans-serif;
}
LABEL#titulo_ttp_agora1{
    position: absolute;
    left: 13%;
    top: 13%;
    font-style: normal;
	font-weight: bold;
    color: #FF6347;
	font-size: 30px;
	font-family: arial, sans-serif;
}

LABEL#titulo_ttp_mes{
    position: absolute;
    left: 5%;
    top: 33%;
    font-style: italic;
	font-weight: bold;
	font-size: 20px;
	font-family: arial, sans-serif;
}
LABEL#titulo_ttp_mes1{
    position: absolute;
    left: 13%;
    top: 45%;
    font-style: normal;
	font-weight: bold;
    color: #32CD32;
	font-size: 30px;
	font-family: arial, sans-serif;
}
LABEL#titulo_giro{
    position: absolute;
    left: 5%;
    top: 65%;
    font-style: italic;
	font-weight: bold;
	font-size: 20px;
	font-family: arial, sans-serif;
}
LABEL#titulo_giro1{
    position: absolute;
    left: 13%;
    top: 77%;
    font-style: normal;
	font-weight: bold;
    color: red;
	font-size: 30px;
	font-family: arial, sans-serif;
}





LABEL#titulo{
    position: absolute;
    left: 42%;
    top: 5%;
    font-style: italic;
	font-weight: bold;
	font-size: 30px;
	font-family: arial, sans-serif;


}

LABEL#lb_turno_atual{
    position: absolute;
    left: 15%;
    top: 5%;
    font-style: italic;
	font-weight: bold;
	font-size: 30px;
	font-family: arial, sans-serif;


}

LABEL#lb_atualizacao{
    position: absolute;
    left: 71.4%;
    top: 5%;
    font-style: italic;
	font-weight: bold;
	font-size: 30px;
	font-family: arial, sans-serif;


}
DIV#ultima_placa_entrada_co{
    margin-left: 0px;
    position: absolute;
    left: 7.5%;
    top: 40%;
    width: 130px;
    height: 28px;
    font-style: normal;
	font-weight: bold;
	font-size: 24px;
    text-align: center;
	font-family: arial;
    cursor: pointer;
    background-color: #E6E6FA;
    border-radius: 0px!important;
    border: 4px #000000 solid!important;
}
LABEL#lb_ultima_placa_entrada_co{
    margin-left: 0px;
    position: absolute;
    left: 7.5%;
    top: 44.5%;
	width: 130px;
    height: 30px;
	text-align: center;
    font-style: normal;
	font-weight: bold;
	font-size: 22px;
	color: rgb(20,80,30);
    text-align: center;
	font-family: arial;

}


DIV#ultima_placa_entrada_bh{
    margin-left: 0px;
    position: absolute;
    left: 17.2%;
    top: 40%;
    width: 130px;
    height: 28px;
    font-style: normal;
	font-weight: bold;
	font-size: 24px;
    text-align: center;
	font-family: arial;
    cursor: pointer;
    background-color: #E6E6FA;
    border-radius: 0px!important;
    border: 4px #000000 solid!important;
}
LABEL#lb_ultima_placa_entrada_bh{
    margin-left: 0px;
    position: absolute;
    left: 17.2%;
    top: 44.5%;
	width: 130px;
    height: 30px;
	text-align: center;
    font-style: normal;
	font-weight: bold;
	font-size: 22px;
	color: rgb(20,80,30);
    text-align: center;
	font-family: arial;

}
DIV#ultima_placa_controles{
    margin-left: 0px;
    position: absolute;
    left: 26.8%;
    top: 40%;
    width: 130px;
    height: 28px;
    font-style: normal;
	font-weight: bold;
	font-size: 24px;
    text-align: center;
	font-family: arial;
    cursor: pointer;
    background-color: #E6E6FA;
    border-radius: 0px!important;
    border: 4px #000000 solid!important;
}
LABEL#lb_ultima_placa_controles{
    margin-left: 0px;
    position: absolute;
    left: 26.8%;
    top: 44.5%;
	width: 130px;
    height: 30px;
	text-align: center;
    font-style: normal;
	font-weight: bold;
	font-size: 22px;
	color: rgb(20,80,30);
    text-align: center;
	font-family: arial;

}



DIV#ultima_placa_estoques{
    margin-left: 0px;
    position: absolute;
    left: 36.5%;
    top: 40%;
    width: 130px;
    height: 28px;
    font-style: normal;
	font-weight: bold;
	font-size: 24px;
    text-align: center;
	font-family: arial;
    cursor: pointer;
    background-color: #E6E6FA;
    border-radius: 0px!important;
    border: 4px #000000 solid!important;
}
LABEL#lb_ultima_placa_estoques{
    margin-left: 0px;
    position: absolute;
    left: 37%;
    top: 44.5%;
	width: 130px;
    height: 30px;
	text-align: center;
    font-style: normal;
	font-weight: bold;
	font-size: 22px;
	color: rgb(20,80,30);
    text-align: center;
	font-family: arial;

}



DIV#ultima_placa_Excesso{
    margin-left: 0px;
    position: absolute;
    left: 46.2%;
    top: 40%;
    width: 130px;
    height: 28px;
    font-style: normal;
	font-weight: bold;
	font-size: 24px;
    text-align: center;
	font-family: arial;
    cursor: pointer;
    background-color: #E6E6FA;
    border-radius: 0px!important;
    border: 4px #000000 solid!important;
}
LABEL#lb_ultima_placa_excesso{
    margin-left: 0px;
    position: absolute;
    left: 46.2%;
    top: 44.5%;
	width: 130px;
    height: 30px;
	text-align: center;
    font-style: normal;
	font-weight: bold;
	font-size: 22px;
	color: rgb(20,80,30);
    text-align: center;
	font-family: arial;

}


DIV#ultima_placa_amostragem{
    margin-left: 0px;
    position: absolute;
    left: 56%;
    top: 40%;
    width: 130px;
    height: 28px;
    font-style: normal;
	font-weight: bold;
	font-size: 24px;
    text-align: center;
	font-family: arial;
    cursor: pointer;
    background-color: #E6E6FA;
    border-radius: 0px!important;
    border: 4px #000000 solid!important;
}
LABEL#lb_ultima_placa_amostragem{
    margin-left: 0px;
    position: absolute;
    left: 56%;
    top: 44.5%;
	width: 130px;
    height: 30px;
	text-align: center;
    font-style: normal;
	font-weight: bold;
	font-size: 22px;
	color: rgb(20,80,30);
    text-align: center;
	font-family: arial;

}


DIV#ultima_placa_balancas{
    margin-left: 0px;
    position: absolute;
    left: 65.8%;
    top: 40%;
    width: 130px;
    height: 28px;
    font-style: normal;
	font-weight: bold;
	font-size: 24px;
    text-align: center;
	font-family: arial;
    cursor: pointer;
    background-color: #E6E6FA;
    border-radius: 0px!important;
    border: 4px #000000 solid!important;
}

LABEL#lb_ultima_placa_balancas{
    margin-left: 0px;
    position: absolute;
    left: 66%;
    top: 44.5%;
	width: 130px;
    height: 30px;
	text-align: center;
    font-style: normal;
	font-weight: bold;
	font-size: 22px;
	color: rgb(20,80,30);
    text-align: center;
	font-family: arial;

}

DIV#ultima_placa_saida_co{
    margin-left: 0px;
    position: absolute;
    left: 75.5%;
    top: 40%;
    width: 130px;
    height: 28px;
    font-style: normal;
	font-weight: bold;
	font-size: 24px;
    text-align: center;
	font-family: arial;
    cursor: pointer;
    background-color: #E6E6FA;
    border-radius: 0px!important;
    border: 4px #000000 solid!important;
}
LABEL#lb_ultima_placa_saida_co{
    margin-left: 0px;
    position: absolute;
    left: 76%;
    top: 44.5%;
	width: 130px;
    height: 30px;
	text-align: center;
    font-style: normal;
	font-weight: bold;
	font-size: 22px;
	color: rgb(20,80,30);
    text-align: center;
	font-family: arial;

}


DIV#ultima_placa_saida_bh{
    margin-left: 0px;
    position: absolute;
    left: 85.2%;
    top: 40%;
    width: 130px;
    height: 28px;
    font-style: normal;
	font-weight: bold;
	font-size: 24px;
    text-align: center;
	font-family: arial;
    cursor: pointer;
    background-color: #E6E6FA;
    border-radius: 0px!important;
    border: 4px #000000 solid!important;
}
LABEL#lb_ultima_placa_saida_bh{
    margin-left: 0px;
    position: absolute;
    left: 85.5%;
    top: 44.5%;
	width: 130px;
    height: 30px;
	text-align: center;
    font-style: normal;
	font-weight: bold;
	font-size: 22px;
	color: rgb(20,80,30);
    text-align: center;
	font-family: arial;

}



body{

margin-top: 0px;
}
html{
background: url("../images/tela_gerdau_logo.png")center;
margin-top: 0px !important;
background-size: 160%;

}
</style>