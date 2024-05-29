<?php
$tabela  = $_GET['tabela'];
$tipo = isset($_GET['tipo'])? $_GET['tipo']:'Todos';
$modelo =isset($_GET['modelo'])? $_GET['modelo']:'Todos';
$ordem =isset($_GET['ordem'])? $_GET['ordem']:'id';
$vstatus =isset($_GET['vstatus'])? $_GET['vstatus']:'Todos';


$filtro = "";

if($ordem =="nome_a_z")
{
 $filtro = "nome ASC";
}
else if ($ordem == "nome_z_a")
{
  $filtro = "nome DESC";
}
else if ($ordem == "ip_um_a_dez")
{
  $filtro = "id ASC"; // ATENÇÃO : No mudar o id, pois ip é texto e da erro, o id é na pratica a sequencia de ip tambem
}
else if ($ordem == "ip_dez_a_um")
{
  $filtro = "id DESC"; // ATENÇÃO : No mudar o id, pois ip é texto e da erro, o id é na pratica a sequencia de ip tambem
}
else if($ordem == "usados")
{
  $condicao = "apenas_usados";
}
else
{
  $filtro = "id ASC";
}

//echo $tipo;
//echo "</BR>";
//echo $modelo;

//echo "</BR>";echo "</BR>";echo "</BR>";echo "</BR>";
include_once 'conexao_portal_gestao.php';
$encontrado = 0;
$ultimo_encontrado = 0;
$mensagem_json = "";
//Crio os arrays para receber os dados
$array_id = array();
$array_nome_rede = array();
$array_ip = array();
$array_gateway = array();
$array_mascara = array();
$array_modelo = array();
$array_tipo = array();
$array_informacao_adicional = array();
$array_ativo = array();
$array_status = array();
$array_usuario = array();
$array_senha = array();
$array_disponivel = array();
$array_editado_por = array();
$array_data = array();
$array_hora = array();
$array_comando_especial = array();
$array_versao = array();
$array_radius = array();
$array_files = array();


if($tipo == "Todos" && $modelo=="Todos")
{ 
    include_once 'conexao_portal_gestao.php';
    if($condicao == "apenas_usados")
    {
      $sql = $dbcon->query("SELECT * FROM $tabela WHERE (disponivel='Não') ORDER BY id ASC");
    }
    else
    {
      if($vstatus == "Todos" )
      {
        $sql = $dbcon->query("SELECT * FROM $tabela WHERE (status='Online' OR status='Offline' OR status='Bloqueado') ORDER BY $filtro");
      }
      else
      {
        $sql = $dbcon->query("SELECT * FROM $tabela WHERE status='$vstatus' ORDER BY $filtro"); 
      }
    }
    
    if(mysqli_num_rows($sql)>0)
    {
    while($dados = $sql->fetch_array())
    {
      
      $id = $dados['id'];
      $nome_rede = $dados['nome'];
      $ip = $dados['ip'];
      $gateway = $dados['gateway'];
      $mascara = $dados['mascara'];
      $modelo = $dados['modelo'];
      $tipo = $dados['tipo'];
      $informacao_adicional = $dados['informacao_adicional'];
      $ativo = $dados['ativo'];
      $status = $dados['status'];
      $usuario = $dados['usuario'];
      $senha = $dados['senha'];
      $disponivel = $dados['disponivel'];
      $editado_por = $dados['editado_por'];
      $data = $dados['data'];
      $hora = $dados['hora'];
      $comando_especial = $dados['comando_especial'];
      $versao = $dados['versao'];
      $radius = $dados['radius'];
      $files = $dados['files'];
    
    
    
      //Agora salvo dentro dos arrays
      $array_id[$encontrado] = $id;
      $array_nome_rede[$encontrado] = $nome_rede;
      $array_ip[$encontrado] = $ip;
      $array_gateway[$encontrado] = $gateway;
      $array_mascara[$encontrado] = $mascara;
      $array_modelo[$encontrado] = $modelo;
      $array_tipo[$encontrado] = $tipo;
      $array_informacao_adicional[$encontrado] = $informacao_adicional;
      $array_ativo[$encontrado] = $ativo;
      $array_status[$encontrado] = $status;
      $array_usuario[$encontrado] = $usuario;
      $array_senha[$encontrado] = $senha;
      $array_disponivel[$encontrado] = $disponivel;
      $array_editado_por[$encontrado] = $editado_por;
      $array_data[$encontrado] = $data;
      $array_hora[$encontrado] = $hora;
      $array_comando_especial[$encontrado] = $comando_especial;
      $array_versao[$encontrado] = $versao;
      $array_radius[$encontrado] = $radius;
      $array_files[$encontrado] = $files;
    
      //Agora atribuo 1 para pular a posicao de memoria no array e tambem informar quantos elementos foram encontrados
      $encontrado = intval($encontrado)+1; 
      $ultimo_encontrado = $encontrado; 
    } 
    }
  
} //Fecho if = "Todos"
else
{

  if($tipo == "Todos")
  { // $tipo = todos e $modelo nao
    if($vstatus == "Todos" )
    {
      $sql = $dbcon->query("SELECT * FROM $tabela WHERE ((status='Online' OR status='Offline' OR status='Bloqueado')AND modelo='$modelo') ORDER BY $filtro");
    }
    else
    {
      $sql = $dbcon->query("SELECT * FROM $tabela WHERE (modelo='$modelo' AND status='$vstatus') ORDER BY $filtro");
    }

    if(mysqli_num_rows($sql)>0)
    {
     while($dados = $sql->fetch_array())
     {
      
      $id = $dados['id'];
      $nome_rede = $dados['nome'];
      $ip = $dados['ip'];
      $gateway = $dados['gateway'];
      $mascara = $dados['mascara'];
      $modelo = $dados['modelo'];
      $tipo = $dados['tipo'];
      $informacao_adicional = $dados['informacao_adicional'];
      $ativo = $dados['ativo'];
      $status = $dados['status'];
      $usuario = $dados['usuario'];
      $senha = $dados['senha'];
      $disponivel = $dados['disponivel'];
      $editado_por = $dados['editado_por'];
      $data = $dados['data'];
      $hora = $dados['hora'];
      $comando_especial = $dados['comando_especial'];
      $versao = $dados['versao'];
      $radius = $dados['radius'];
      $files = $dados['files'];
    
    
    
      //Agora salvo dentro dos arrays
      $array_id[$encontrado] = $id;
      $array_nome_rede[$encontrado] = $nome_rede;
      $array_ip[$encontrado] = $ip;
      $array_gateway[$encontrado] = $gateway;
      $array_mascara[$encontrado] = $mascara;
      $array_modelo[$encontrado] = $modelo;
      $array_tipo[$encontrado] = $tipo;
      $array_informacao_adicional[$encontrado] = $informacao_adicional;
      $array_ativo[$encontrado] = $ativo;
      $array_status[$encontrado] = $status;
      $array_usuario[$encontrado] = $usuario;
      $array_senha[$encontrado] = $senha;
      $array_disponivel[$encontrado] = $disponivel;
      $array_editado_por[$encontrado] = $editado_por;
      $array_data[$encontrado] = $data;
      $array_hora[$encontrado] = $hora;
      $array_comando_especial[$encontrado] = $comando_especial;
      $array_versao[$encontrado] = $versao;
      $array_radius[$encontrado] = $radius;
      $array_files[$encontrado] = $files;
    
      //Agora atribuo 1 para pular a posicao de memoria no array e tambem informar quantos elementos foram encontrados
      $encontrado = intval($encontrado)+1; 
      $ultimo_encontrado = $encontrado; 
     } 
    }
    
  }
  else if ($modelo == "Todos")
  {
    if($vstatus == "Todos" )
    {
      if($tipo==">>> Mikrotik")
      {
        $sql = $dbcon->query("SELECT * FROM $tabela WHERE ((status='Online' OR status='Offline' OR status='Bloqueado')AND ( tipo='Switch Gerenciavel' OR tipo='SXT' OR tipo='Base Box' OR tipo='Rede' OR tipo='Groove'  ) ) ORDER BY $filtro");
      }
      else
      {
        $sql = $dbcon->query("SELECT * FROM $tabela WHERE ((status='Online' OR status='Offline' OR status='Bloqueado')AND tipo='$tipo') ORDER BY $filtro");
      }
      
    }
    else
    {
     if($tipo == ">>> Mikrotik")
     {
      $sql = $dbcon->query("SELECT * FROM $tabela WHERE ( ( tipo='Switch Gerenciavel' OR tipo='SXT' OR tipo='Base Box' OR tipo='Rede' OR tipo='Groove' )     AND status='$vstatus') ORDER BY $filtro");
     }
     else
     {
      $sql = $dbcon->query("SELECT * FROM $tabela WHERE (tipo='$tipo' AND status='$vstatus') ORDER BY $filtro");
     }
      
    }
    if(mysqli_num_rows($sql)>0)
    {
     while($dados = $sql->fetch_array())
     {
      
      $id = $dados['id'];
      $nome_rede = $dados['nome'];
      $ip = $dados['ip'];
      $gateway = $dados['gateway'];
      $mascara = $dados['mascara'];
      $modelo = $dados['modelo'];
      $tipo = $dados['tipo'];
      $informacao_adicional = $dados['informacao_adicional'];
      $ativo = $dados['ativo'];
      $status = $dados['status'];
      $usuario = $dados['usuario'];
      $senha = $dados['senha'];
      $disponivel = $dados['disponivel'];
      $editado_por = $dados['editado_por'];
      $data = $dados['data'];
      $hora = $dados['hora'];
      $comando_especial = $dados['comando_especial'];
      $versao = $dados['versao'];
      $radius = $dados['radius'];
      $files = $dados['files'];
    
    
    
      //Agora salvo dentro dos arrays
      $array_id[$encontrado] = $id;
      $array_nome_rede[$encontrado] = $nome_rede;
      $array_ip[$encontrado] = $ip;
      $array_gateway[$encontrado] = $gateway;
      $array_mascara[$encontrado] = $mascara;
      $array_modelo[$encontrado] = $modelo;
      $array_tipo[$encontrado] = $tipo;
      $array_informacao_adicional[$encontrado] = $informacao_adicional;
      $array_ativo[$encontrado] = $ativo;
      $array_status[$encontrado] = $status;
      $array_usuario[$encontrado] = $usuario;
      $array_senha[$encontrado] = $senha;
      $array_disponivel[$encontrado] = $disponivel;
      $array_editado_por[$encontrado] = $editado_por;
      $array_data[$encontrado] = $data;
      $array_hora[$encontrado] = $hora;
      $array_comando_especial[$encontrado] = $comando_especial;
      $array_versao[$encontrado] = $versao;
      $array_radius[$encontrado] = $radius;
      $array_files[$encontrado] = $files;

      //Agora atribuo 1 para pular a posicao de memoria no array e tambem informar quantos elementos foram encontrados
      $encontrado = intval($encontrado)+1; 
      $ultimo_encontrado = $encontrado; 
     } 
    }
  }
  else
  {
    //Nenhum é igual a todos
    if($vstatus == "Todos" )
    {
      $sql = $dbcon->query("SELECT * FROM $tabela WHERE ((status='Online' OR status='Offline' OR status='Bloqueado')AND modelo='$modelo' AND tipo='$tipo') ORDER BY $filtro");
    }
    else
    {
      $sql = $dbcon->query("SELECT * FROM $tabela WHERE (modelo='$modelo' AND tipo='$tipo' AND status='$vstatus') ORDER BY $filtro");
    }
    
    if(mysqli_num_rows($sql)>0)
    {
     while($dados = $sql->fetch_array())
     {
      
      $id = $dados['id'];
      $nome_rede = $dados['nome'];
      $ip = $dados['ip'];
      $gateway = $dados['gateway'];
      $mascara = $dados['mascara'];
      $modelo = $dados['modelo'];
      $tipo = $dados['tipo'];
      $informacao_adicional = $dados['informacao_adicional'];
      $ativo = $dados['ativo'];
      $status = $dados['status'];
      $usuario = $dados['usuario'];
      $senha = $dados['senha'];
      $disponivel = $dados['disponivel'];
      $editado_por = $dados['editado_por'];
      $data = $dados['data'];
      $hora = $dados['hora'];
      $comando_especial = $dados['comando_especial'];
      $versao = $dados['versao'];
      $radius = $dados['radius'];
      $files = $dados['files'];
    
    
    
      //Agora salvo dentro dos arrays
      $array_id[$encontrado] = $id;
      $array_nome_rede[$encontrado] = $nome_rede;
      $array_ip[$encontrado] = $ip;
      $array_gateway[$encontrado] = $gateway;
      $array_mascara[$encontrado] = $mascara;
      $array_modelo[$encontrado] = $modelo;
      $array_tipo[$encontrado] = $tipo;
      $array_informacao_adicional[$encontrado] = $informacao_adicional;
      $array_ativo[$encontrado] = $ativo;
      $array_status[$encontrado] = $status;
      $array_usuario[$encontrado] = $usuario;
      $array_senha[$encontrado] = $senha;
      $array_disponivel[$encontrado] = $disponivel;
      $array_editado_por[$encontrado] = $editado_por;
      $array_data[$encontrado] = $data;
      $array_hora[$encontrado] = $hora;
      $array_comando_especial[$encontrado] = $comando_especial;
      $array_versao[$encontrado] = $versao;
      $array_radius[$encontrado] = $radius;
      $array_files[$encontrado] = $files;
    
      //Agora atribuo 1 para pular a posicao de memoria no array e tambem informar quantos elementos foram encontrados
      $encontrado = intval($encontrado)+1; 
      $ultimo_encontrado = $encontrado; 
     } 
    }

  }
  













} //Fecho if != Todos

if($encontrado == 0)
{
 // Sem dados
 $mensagem_json = "-99;vazio";
 echo json_encode($mensagem_json);
}
else
{
 //Encontrou equipamentos
 //Faço o for relacionado a quantidade encontrada
 for ($x = 0; $x < $encontrado; $x++) 
 {
   if($x == 0)
   {
    $mensagem_json = $encontrado . ';' . $array_id[$x] . ',' . $array_nome_rede[$x] . ',' . $array_ip[$x] . ',' . $array_gateway[$x]  . ',' . $array_mascara[$x] . ',' . $array_modelo[$x] .',' .$array_tipo[$x]  . ',' . $array_informacao_adicional[$x]  . ',' . $array_ativo[$x] . ',' . $array_status[$x]  .','. $array_usuario[$x]  .','.  $array_senha[$x]  .','. $array_disponivel[$x]  .','.  $array_editado_por[$x]  .','. $array_data[$x]  .','. $array_hora[$x]  . ',' . $array_comando_especial[$x]  . ','  . $array_versao[$x]  . ',' . $array_radius[$x]  . ',' . $array_files[$x]  . ';'      ;
   }
   else
   {
    if( $x>0 && $x != ( $ultimo_encontrado -1 ))
    {
      $mensagem_json = $mensagem_json . $array_id[$x] . ',' . $array_nome_rede[$x] . ',' . $array_ip[$x]  . ',' . $array_gateway[$x]  . ',' . $array_mascara[$x] . ',' . $array_modelo[$x] .',' .$array_tipo[$x] . ',' . $array_informacao_adicional[$x]  . ',' . $array_ativo[$x] . ',' . $array_status[$x]  .','. $array_usuario[$x]  .','.  $array_senha[$x]  .','. $array_disponivel[$x]  .','.  $array_editado_por[$x]  .','. $array_data[$x]  .','. $array_hora[$x]  . ',' . $array_comando_especial[$x]  . ','  . $array_versao[$x]  . ',' . $array_radius[$x]  . ',' . $array_files[$x]  . ';'      ;
    }
    else if($x == ($ultimo_encontrado-1) )
    {
        $mensagem_json = $mensagem_json . $array_id[$x] . ',' . $array_nome_rede[$x] . ',' . $array_ip[$x] . ',' . $array_gateway[$x]  . ',' . $array_mascara[$x] . ',' . $array_modelo[$x] .',' .$array_tipo[$x] . ',' . $array_informacao_adicional[$x] . ',' . $array_ativo[$x] . ',' . $array_status[$x]  .','. $array_usuario[$x]  .','.  $array_senha[$x]  .','. $array_disponivel[$x]  .','.  $array_editado_por[$x] .','. $array_data[$x]  .','. $array_hora[$x]  . ',' .  $array_comando_especial[$x] . ','  . $array_versao[$x]  . ',' . $array_radius[$x] . ',' . $array_files[$x];
    }
   }
 }

 echo json_encode($mensagem_json);

}


 ?>
