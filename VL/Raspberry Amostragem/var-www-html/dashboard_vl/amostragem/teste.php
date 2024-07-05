<?php
date_default_timezone_set('America/Sao_Paulo');
$data_leitura = date('d/m/Y');
$hora_leitura = date('H:i:s');
$dia = (substr($data_leitura,0,2));
$mes = (substr($data_leitura,3,2)); // extrai o mes atual
$ano = (substr($data_leitura,6,4)); // extrai o ano atual


$numero_materiais = 0;
$numero_trasportadoras = 0;

$array_materiais = [];
$array_lista_materiais = [];
$array_v_materiais = [];

$array_transportadoras = [];
$array_lista_transportadoras = [];
$array_v_transportadoras = [];

$encontrados = 0;
$numero_amostragem = 0;
$hora_zero = 0;
$hora_um = 0;
$hora_dois = 0;
$hora_tres = 0;
$hora_quatro = 0;
$hora_cinco = 0;
$hora_seis = 0;
$hora_sete = 0;
$hora_oito = 0;
$hora_nove = 0;
$hora_dez = 0;
$hora_onze = 0;
$hora_doze = 0;
$hora_treze = 0;
$hora_quatorze = 0;
$hora_quize = 0;
$hora_dezesseis = 0;
$hora_dezessete = 0;
$hora_dezoito = 0;
$hora_dezenove = 0;
$hora_vinte = 0;
$hora_vinte_e_um = 0;
$hora_vinte_e_dois = 0;
$hora_vinte_e_tres = 0;
$v_turno1 = 0;
$v_turno2 = 0;
$v_turno3 = 0;
$v_turnoX = 0;

$turno1 = 'X';
$turno2 = 'X';
$turno3 = 'X';

$tabela = 'lista_turno_'.$ano.'_lmn';

include_once 'conexao_amostragem.php';
$sql = $dbcon->query("SELECT * FROM $tabela WHERE data='$data_leitura'");
if(mysqli_num_rows($sql)>0)
{
 $dados = $sql->fetch_array();
 $turno1 = $dados['turno1'];
 $turno2 = $dados['turno2'];
 $turno3 = $dados['turno3'];

}



include_once 'conexao_amostragem.php';
$sql = $dbcon->query("SELECT * FROM amostragem WHERE data_leitura='$data_leitura'");
if(mysqli_num_rows($sql)>0)
{
 while($dados = $sql->fetch_array())
 { 
  $encontrados = intval($encontrados) + 1;
  $amostrado = $dados['amostrado'];
  if($amostrado == "sim")
  {
    $numero_amostragem = intval($numero_amostragem)+1;
  }
  //Agora trato os valores para hora
  $hora = intval($dados['hora']);
  if($hora == 0)
  {
   $hora_zero = intval($hora_zero) +1;
  }
  else if($hora == 1)
  {
   $hora_um = intval($hora_um) + 1;
  }
  else if($hora == 2)
  {
    $hora_dois = intval($hora_dois) + 1;
  }
  else if($hora == 3)
  {
    $hora_tres = intval($hora_tres) + 1;
  }
  else if($hora == 4)
  {
    $hora_quatro = intval($hora_quatro) + 1;
  }
  else if($hora == 5)
  {
    $hora_cinco = intval($hora_cinco) + 1;
  }
  else if($hora == 6)
  {
    $hora_seis = intval($hora_seis) + 1;
  }
  else if($hora == 7)
  {
    $hora_sete = intval($hora_sete)+1;
  }
  else if($hora == 8)
  {
    $hora_oito = intval($hora_oito) + 1;
  }
  else if($hora == 9)
  {
    $hora_nove = intval($hora_nove) + 1;
  }
  else if($hora == 10)
  {
    $hora_dez = intval($hora_dez) + 1;
  }
  else if($hora == 11)
  {
    $hora_onze = intval($hora_onze) + 1;
  }
  else if($hora == 12)
  {
    $hora_doze = intval($hora_doze) + 1;
  }
  else if($hora == 13)
  {
    $hora_treze = intval($hora_treze) + 1;
  }
  else if($hora == 14)
  {
    $hora_quatorze = intval($hora_quatorze) + 1;
  }
  else if($hora == 15)
  {
    $hora_quize = intval($hora_quize) + 1;
  }
  else if($hora == 16)
  {
    $hora_dezesseis = intval($hora_dezesseis) + 1;
  }
  else if($hora == 17)
  {
    $hora_dezessete = intval($hora_dezessete) + 1;
  }
  else if($hora == 18)
  {
    $hora_dezoito = intval($hora_dezoito) + 1;
  }
  else if($hora == 19)
  {
    $hora_dezenove = intval($hora_dezenove) + 1;
  }
  else if($hora == 20)
  {
    $hora_vinte = intval($hora_vinte) + 1;
  }
  else if($hora == 21)
  {
    $hora_vinte_e_um = intval($hora_vinte_e_um) + 1;
  }
  else if($hora == 22)
  {
    $hora_vinte_e_dois = intval($hora_vinte_e_dois) + 1;
  }
  else if($hora == 23)
  {
    $hora_vinte_e_tres = intval($hora_vinte_e_tres) + 1;
  }
  if($amostrado == "sim")
  {
    //Agora trato a quantitade por turno
    $vv_turno = $dados['turno'];
    if($vv_turno == $turno1)
    {
    $v_turno1 = intval($v_turno1)+1;
    }
    else if($vv_turno == $turno2)
    {
    $v_turno2 = intval($v_turno2)+1;
    }
    else if($vv_turno == $turno3)
    {
    $v_turno3 = intval($v_turno3)+1;
    }
    else
    {
      $v_turnoX = intval($v_turnoX) + 1;
    }
 }
  //Busco dados de materiais mas porem dos que foram amostrados!
  if($amostrado == "sim")
  {
    $v_materiais = $dados['material'];
    array_push($array_lista_materiais, $v_materiais);
    if($v_materiais != "")
    {
      if(in_array($v_materiais, $array_materiais, true))
      {
      
      }
      else
      {
       array_push($array_materiais, $v_materiais);
       $numero_materiais = intval($numero_materiais)+1;
      }
    } // Fecha if($v_materiais != "")
   }

  //Busco dados de transportadoras mas porem dos que foram amostrados!
  if($amostrado == "sim")
  {
    $v_transportadoras = $dados['transportadora'];
    array_push($array_lista_transportadoras, $v_transportadoras);
    if($v_transportadoras != "")
    {
      if(in_array($v_transportadoras, $array_transportadoras, true))
      {
      
      }
      else
      {
       array_push($array_transportadoras, $v_transportadoras);
       $numero_trasportadoras = intval($numero_trasportadoras)+1;
      }
    } // Fecha if($v_materiais != "")
   }









 } //Fecha o Whille
} // Fecha o if de consulta


//Agora busco dados para o mes
$encontrado_mes = 0;
$amostrado_mes = 0;
$aderencia_mes = 0;

include_once 'conexao_amostragem.php';
$sql = $dbcon->query("SELECT * FROM amostragem WHERE mes='$mes'");
if(mysqli_num_rows($sql)>0)
{
  while($dados = $sql->fetch_array())
  {
    $encontrado_mes = intval($encontrado_mes) + 1; 
    $v_amostrado_mes = $dados['amostrado'];
    if($v_amostrado_mes == "sim")
    {
      $amostrado_mes = intval($amostrado_mes) + 1;
    }
  }

}







if(intval($encontrados)>0)
{
 $numero_passagem_pela_balanca2 = intval($encontrados);

 $aderencia_dia = ($numero_amostragem/$numero_passagem_pela_balanca2)*100;
 $aderencia_dia = strval(number_format($aderencia_dia,2,",","")) . " %";
 
 $aderencia_mes = ($amostrado_mes/$encontrado_mes)*100;
 $aderencia_mes = strval(number_format($aderencia_mes,2,",","")) . " %";


 echo "Encontrados = " . $encontrados;
 echo "</BR>";
 echo "Numero de amostragens = " . $numero_amostragem;
 echo "</BR>";
 echo "Aderencia_dia = ".$aderencia_dia;
 echo "</BR>";
 echo "Listagem por turno ******************";
 echo "</BR>";
 echo "Turno 1 ( ".$turno1.") = " . $v_turno1;
 echo "</BR>";
 echo "Turno 2 ( ".$turno2.") = " . $v_turno2;
 echo "</BR>";
 echo "Turno 3 ( ".$turno3.") = " .$v_turno3;
 echo "</BR>";
 echo "Turno X = " . $v_turnoX;
 echo "</BR>";
 echo "</BR>";
 echo "Dados referentes a materiais ****************";
 echo "</BR>";
 echo "Numero de materiais encontrados = " . intval($numero_materiais);

 echo "</BR>";echo "</BR>";echo "</BR>";
 $array_v_materiais = json_encode(array_count_values($array_lista_materiais));
 $jsonObj = json_decode($array_v_materiais);
 
 if(intval($numero_materiais) == 1)
 {
  $m0 = $array_materiais[0];
  $quantidade_material_zero = $jsonObj->$m0;
  echo "Quantidade material 0 = " . intval($quantidade_material_zero);
  echo "</BR>";
 }
 else if(intval($numero_materiais) == 2)
 {
  $m0 = $array_materiais[0];
  $m1 = $array_materiais[1];
  $quantidade_material_zero = $jsonObj->$m0;
  $quantidade_material_um = $jsonObj->$m1;
  echo "Quantidade material 0 = " . intval($quantidade_material_zero);
  echo "</BR>";
  echo "Quantidade material 1 = " . intval($quantidade_material_um);
  echo "</BR>";
 }
 else if(intval($numero_materiais) == 3)
 {
  $m0 = $array_materiais[0];
  $m1 = $array_materiais[1];
  $m2 = $array_materiais[2];
  $quantidade_material_zero = $jsonObj->$m0;
  $quantidade_material_um = $jsonObj->$m1;
  $quantidade_material_dois = $jsonObj->$m2;
  echo "Quantidade material 0 = " . intval($quantidade_material_zero);
  echo "</BR>";
  echo "Quantidade material 1 = " . intval($quantidade_material_um);
  echo "</BR>";
  echo "Quantidade material 2 = " . intval($quantidade_material_dois);
  echo "</BR>";
 }
 else if(intval($numero_materiais) == 4)
 {
  $m0 = $array_materiais[0];
  $m1 = $array_materiais[1];
  $m2 = $array_materiais[2];
  $m3 = $array_materiais[3];
  $quantidade_material_zero = $jsonObj->$m0;
  $quantidade_material_um = $jsonObj->$m1;
  $quantidade_material_dois = $jsonObj->$m2;
  $quantidade_material_tres = $jsonObj->$m3;
  echo "Quantidade material 0 = " . intval($quantidade_material_zero);
  echo "</BR>";
  echo "Quantidade material 1 = " . intval($quantidade_material_um);
  echo "</BR>";
  echo "Quantidade material 2 = " . intval($quantidade_material_dois);
  echo "</BR>";
  echo "Quantidade material 3 = " . intval($quantidade_material_tres);
  echo "</BR>";
 }
 else if(intval($numero_materiais) == 5)
 {
  $m0 = $array_materiais[0];
  $m1 = $array_materiais[1];
  $m2 = $array_materiais[2];
  $m3 = $array_materiais[3];
  $m4 = $array_materiais[4];
  $quantidade_material_zero = $jsonObj->$m0;
  $quantidade_material_um = $jsonObj->$m1;
  $quantidade_material_dois = $jsonObj->$m2;
  $quantidade_material_tres = $jsonObj->$m3;
  $quantidade_material_quatro = $jsonObj->$m4;
  echo "Quantidade material 0 = " . intval($quantidade_material_zero);
  echo "</BR>";
  echo "Quantidade material 1 = " . intval($quantidade_material_um);
  echo "</BR>";
  echo "Quantidade material 2 = " . intval($quantidade_material_dois);
  echo "</BR>";
  echo "Quantidade material 3 = " . intval($quantidade_material_tres);
  echo "</BR>";
  echo "Quantidade material 4 = " . intval($quantidade_material_quatro);
  echo "</BR>";
  
 }

 echo "</BR>";echo "</BR>";echo "</BR>";
 
 echo "</BR>";
 for ($x = 0; $x < intval($numero_materiais); $x++) {
  echo "> ". $array_materiais[$x] ."</BR>";
}

echo "</BR>";
echo "</BR>";
echo "Agora dados referente ao mes ************************";
echo "</BR>";
echo "Numero de amostragens no mes = " . $amostrado_mes;
echo "</BR>";
echo "Numero de passagem pela balanca no mes = " . $encontrado_mes;
echo "</BR>";
echo "Aderencia no mes = " . $aderencia_mes;


echo "</BR>";echo "</BR>";echo "</BR>";






echo "Dados de transportadoras ******************";
echo "</BR>";
echo "Encontrados = " . $numero_trasportadoras;
echo "</BR>";
//var_dump($array_transportadoras);
//var_dump($array_lista_transportadoras);

$array_v_transportadoras = (array_count_values($array_lista_transportadoras));
arsort($array_v_transportadoras);
$vezes=0;
$array_transp = [];
$array_v_transp = [];
foreach ($array_v_transportadoras as $key => $val) {
  //echo "$key = $val</BR>";
  $array_transp[$vezes] = $key;
  $array_v_transp[$vezes] = $val;
  $vezes = intval($vezes) + 1;

}
var_dump($array_v_transp);
$tamanho_array = count($array_transp);

echo "</BR>";
echo "Tamanho do array é : " . $tamanho_array;
echo "</BR>";

if(intval($tamanho_array)<=5)
{
echo $array_transp[0] .' : '. $array_v_transp[0];
echo "</BR>";
echo $array_transp[1] .' : '. $array_v_transp[1];
echo "</BR>";
echo $array_transp[2] .' : '. $array_v_transp[2];
echo "</BR>";
echo $array_transp[3] .' : '. $array_v_transp[3];
echo "</BR>";
echo $array_transp[4] .' : '. $array_v_transp[4];
echo "</BR>";

}
else
{
  echo $array_transp[0] .' : '. $array_v_transp[0];
  echo "</BR>";
  echo $array_transp[1] .' : '. $array_v_transp[1];
  echo "</BR>";
  echo $array_transp[2] .' : '. $array_v_transp[2];
  echo "</BR>";
  
  $faltam = intval($tamanho_array)-5;
  $quantidade = 0;
  for ($x = 0; $x < intval($faltam); $x++) {
        $quantidade = intval($quantidade)+ intval($array_v_transp[5+intval($x)]) ."</BR>";
  }
  echo "Outros : " . $quantidade;

  


}









}

?>