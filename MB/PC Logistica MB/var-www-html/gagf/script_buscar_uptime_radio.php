<?php
require('./api/routeros_api.class.php');
$valor_ip = isset($_GET['ip'])?$_GET['ip']:"vazio";
$usuario = isset($_GET['usuario'])?$_GET['usuario']:"vazio";
$senha = isset($_GET['senha'])?$_GET['senha']:"vazio";

if($valor_ip != "vazio" && $usuario != "vazio" && $senha != "vazio")
{
 $API = new RouterosAPI();
 $API->debug = false;
 $result = [];
 $quantidade_interfaces = 0;
 $msg = "";
 if ($API->connect($valor_ip, $usuario, $senha)) 
 {
  //Caso conecte com sucesso realiza o comando abaixo
  $API->write('/system/resource/print'); // Comando a executar no terminal
  $READ = $API->read(false);
  //var_dump($READ);
  $ARRAY = $API->parseResponse($READ);
  $quantidade_interfaces = 1;//intval(count($ARRAY));
  $result = ($ARRAY);
  //var_dump($result);
  
  $API->disconnect();

  $resto = "";
  if($quantidade_interfaces >0)
  {
   //var_dump($result);  
   
    $mensagem = $result[0];
    $v = json_encode($mensagem);
    //echo($v);
    $b = json_decode($v);
    $uptime = $b->uptime;
    $version = $b->version;
    
    //$v_uptime = "5w1d23h26m30s";
    $v_uptime = $uptime;
    
    $v_ant = 0;
    
    if (strpos($v_uptime, 'w') == true) 
    {
      //echo "Contem Semana";
      $vmsg = explode("w",$v_uptime);
      if(intval($vmsg[0])>1)
      {
        $v_uptime = $vmsg[0] . " semanas, ";
      }
      else
      {
        $v_uptime = $vmsg[0] . " semana, ";
      }
      
      $resto = $vmsg[1];
      //echo $resto . "</BR>";
      $v_ant = 1;
    }
    else
    {
     $resto = $v_uptime;
     $v_ant = 0;
    }

    $vmsg = $v_uptime;

    // Agora trato se possui dias ************************************************************************************
    if (strpos($resto, 'd') == true) 
    {
      //echo "Contem dia";
      $vmsg = explode("d",$resto);
      if(intval($vmsg[0])>1)
      {
        if($v_ant == 0)
        {
            $v_uptime = $vmsg[0] . " dias, ";
        }
        else
        {
            $v_uptime = $v_uptime. $vmsg[0] . " dias, ";
        }
        
      }
      else
      {
        if($v_ant == 0)
        {
         $v_uptime = $vmsg[0] . " dia, ";
        } 
        else
        {
         $v_uptime = $v_uptime. $vmsg[0] . " dia, ";
        }
        
      }
      $resto = $vmsg[1];
      $v_ant = 1;
    }
    else
    {
      $resto = $v_uptime;  
      $v_ant = 0;
    }
   
    $vmsg = $v_uptime;

    // Agora trato se possui horas ************************************************************************************
    if (strpos($resto, 'h') == true) 
    {
      //echo "Contem horas";
      $vmsg = explode("h",$resto);
      
      if(intval($vmsg[0])>1)
      {
        if($v_ant == 0)
        {
            $v_uptime = $vmsg[0] . " horas, ";
        }
        else
        {
            $v_uptime = $v_uptime. $vmsg[0] . " horas, ";
        }
        
      }
      else
      {
        if($v_ant == 0)
        {
         $v_uptime = $vmsg[0] . " hora, ";
        } 
        else
        {
         $v_uptime = $v_uptime. $vmsg[0] . " hora, ";
        }
        
      }
      $resto = $vmsg[1];
      $v_ant = 1;
    }
    else
    {
      $resto = $v_uptime;  
      $v_ant = 0;
    }
   
    $vmsg = $v_uptime;

    // Agora trato se possui minutos ************************************************************************************
    if (strpos($resto, 'm') == true) 
    {
      //echo "Contem minutos";
      $vmsg = explode("m",$resto);
      
      if(intval($vmsg[0])>1)
      {
        if($v_ant == 0)
        {
            $v_uptime = $vmsg[0] . " minutos e ";
        }
        else
        {
            $v_uptime = $v_uptime. $vmsg[0] . " minutos e ";
        }
        
      }
      else
      {
        if($v_ant == 0)
        {
         $v_uptime = $vmsg[0] . " minuto e ";
        } 
        else
        {
         $v_uptime = $v_uptime. $vmsg[0] . " minuto e ";
        }
        
      }
      $resto = $vmsg[1];
      $v_ant = 1;
    }
    else
    {
      $resto = $v_uptime;  
      $v_ant = 0;
    }
    

    $vmsg = $v_uptime;

    // Agora trato se possui segundos ************************************************************************************
    if (strpos($resto, 's') == true) 
    {
      //echo "Contem segundos";
      $vmsg = explode("s",$resto);
      
      if(intval($vmsg[0])>1)
      {
        if($v_ant == 0)
        {
            $v_uptime = $vmsg[0] . " segundos";
        }
        else
        {
            $v_uptime = $v_uptime. $vmsg[0] . " segundos";
        }
        
      }
      else
      {
        if($v_ant == 0)
        {
         $v_uptime = $vmsg[0] . " segundo";
        } 
        else
        {
         $v_uptime = $v_uptime. $vmsg[0] . " segundo";
        }
        
      }
      $resto = $vmsg[1];
      $v_ant = 1;
    }
    else
    {
      $resto = $v_uptime;  
      $v_ant = 0;
    }


    echo $uptime;  
   
  } // Fecha quantidade >0
  
 } // Fecha if ($API->connect($valor_ip, $usuario, $senha))
 else
 {
  echo "Erro conexao!";
 }
}
else
{
 echo "Erro parametros!";  
}
?>
