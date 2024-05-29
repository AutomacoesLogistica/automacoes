<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="utf-8"/>
<title>Gerdau :: GAGF - Bruno Gonçalves</title>
<link rel="shortcut icon" type="imagem/JPG" href="./images/gerdau.jpg";  id="favicon">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<!-- Bootstrap CSS CDN -->

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    
    
</head>
<body>
<div id="conexao">
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












<div id="div_geral">
<label id="v_encontrados">0</label>
<div class="wrapper" >
        <!-- Sidebar Holder -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3> MENU </h3>
            </div>

            <ul class="list-unstyled components">

                <li class="active">
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">UTMI</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                            <a href="#UTMI_RackLogistica" onclick="valida_ponto('Rack Logistica');">Rack Logistica </a>
                        </li>
        
                        <li>
                            <a href="#UTMI_Controles" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Controle Acesso </a>
                            <ul class="collapse list-unstyled" id="UTMI_Controles">
                                <li>
                                    <a href="#UTMI_Controle1" id="idControle1_MB" onclick="valida_ponto('Controle de Acesso 01');">&ensp;&ensp;Controle 01</a>
                                </li>
                                <li>
                                    <a href="#UTMI_Controle2" id="idControle2_MB" onclick="valida_ponto('Controle de Acesso 02');">&ensp;&ensp;Controle 02</a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a href="#UTMI_PosteBalanca02">Poste Balança 02</a>
                        </li>

                        <li>
                            <a href="#UTMI_Balanca02">Balança 02</a>
                        </li>

                        <li>
                            <a href="#UTMI_PatioExcesso">Pátio de Excesso</a>
                        </li>

                        <li>
                            <a href="#UTMI_PosteRestaurante">Poste Restaurante</a>
                        </li>

                        <li>
                            <a href="#UTMI_Balanca01">Balança 01</a>
                        </li>

                        <li>
                            <a href="#UTMI_PosteBalanca01">Poste Balança 01</a>
                        </li>

                        <li>
                            <a href="#UTMI_AutomacoesPredioUTMI">Automações Prédio UTMI </a>
                        </li>   
    
    
    
    
    
                    </ul>
                </li>




                
                <li class="active">
                    <a href="#UTMII" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">UTMII</a>
                    <ul class="collapse list-unstyled" id="UTMII">
                        <li>
                        <a href="#UTMII_TorreRadios">Torre Rádios</a>
                        </li>
                        
                        <li>
                            <a href="#UTMII_Antenas">Antenas</a>
                        </li>

                    </ul>
                </li>



                <li class="active">
                    <a href="#VL" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">VL</a>
                    <ul class="collapse list-unstyled" id="VL">
                    <li>
                        <a href="#VL_PostoGNV">Posto GNV</a>
                        </li>                        

                        <a href="#VL_NovoCCL">Novo CCL</a>
                        </li>

                        <li>
                        <a href="#VL_PainelManserv">Painel Manserv</a>
                        </li>                        

                        <li>
                        <a href="#VL_K-House">K-House</a>
                        </li>                        

                        <li>
                            <a href="#VL_Controles" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Controles Acesso </a>
                            <ul class="collapse list-unstyled" id="VL_Controles">
                                <li>
                                    <a href="#VL_Controle1" id="idControle1_VL" >&ensp;&ensp;Controle 01</a>
                                </li>
                                <li>
                                    <a href="#VL_Controle2" id="idControle2_VL">&ensp;&ensp;Controle 02</a>
                                </li>
                                <li>
                                    <a href="#VL_Controle3" id="idControle3_VL">&ensp;&ensp;Controle 03</a>
                                </li>                                
                            </ul>
                        </li>                       

                        <li>
                        <a href="#VL_Balanca02">Balança 02</a>
                        </li>                 

                        <li>
                        <a href="#VL_Balanca03">Balança 03</a>
                        </li>                 

                        <li>
                        <a href="#VL_Balanca05">Balança 05</a>
                        </li>                                         

                        <li>
                        <a href="#VL_PainelEstoque8">Painel Estoque 08</a>
                        </li>                                     

                        <li>
                        <a href="#VL_PainelSaidaCO">Painel Saída CO</a>
                        </li>                                         

                        <li>
                        <a href="#VL_SalaBranca">Sala Branca</a>
                        </li>                                         


                    </ul>
                </li>



                <li class="active">
                    <a href="#VLN" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">VLN</a>
                    <ul class="collapse list-unstyled" id="VLN">
                        <li>
                        <a href="#VLN_Rack">Rack Automações</a>
                        </li>
                        
                        <li>
                        <a href="#VLN_Controles">Controles Acesso</a>
                        </li>

                        <li>
                        <a href="#VLN_PainelSaida">Painel Saída</a>
                        </li>

                        <li>
                        <a href="#VLN_Rack">Rack Automações</a>
                        </li>
                        




                    </ul>
                </li>


                <li class="active">
                    <a href="#Patrag" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Patrag</a>
                    <ul class="collapse list-unstyled" id="Patrag">
                        
                        <li>
                        <a href="#Patrag_Rack">Rack Automação</a>
                        </li>  

                        <li>
                        <a href="#Patrag_PainelPosteSaida">Painel Poste Saída</a>
                        </li>
                        
                        <li>
                        <a href="#Patrag_PainelBalancaSaida">Painel Balança Saída</a>
                        </li>

                        <li>
                        <a href="#Patrag_PainelBalancaEntrada">Painel Balança Entrada</a>
                        </li>

                        <li>
                        <a href="#Patrag_PainelPosteEntrada">Painel Poste Entrada</a>
                        </li>

                        <li>
                        <a href="#Patrag_TorrrePatio">Painel Torre Pátio</a>
                        </li>                        

                        <li>
                        <a href="#Patrag_PainelPostePN">Painel Poste PN</a>
                        </li>

                        <li>
                        <a href="#Patrag_PainelPosteFila">Painel Controle Filas</a>
                        </li>                        

                        <li>
                        <a href="#Patrag_PainelPosteFila1">Painel Poste Fila 1</a>
                        </li>

                        <li>
                        <a href="#Patrag_PainelPosteFila2">Painel Poste Fila 2</a>
                        </li>

                        <li>
                        <a href="#Patrag_PainelPosteMG030">Painel Poste MG030</a>
                        </li>                        


                    </ul>
                </li>







            </ul>




























            <ul class="list-unstyled CTAs">
                <li>
                    <a  href="menu_automacao11.php?complemento=<?php print $criptografia ?>&check=<?php print $check ?>" class="download">Voltar</a>
                </li>
                <li>
                    <a  href="menu_aux.php?complemento=<?php print $criptografia ?>&check=<?php print $check ?>" class="download">Tela Inicial</a>
                </li>
            </ul>
        </nav>

        <!-- Page Content Holder -->
        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">


                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        
                            <h3 >Automações GERDAU</h3>
                        
                    </div>
                </div>
            </nav>
            
            <h2 id="titulo_ponto">Efetuando ajustes</h2>
            <p id="descricao1">Ponto situado em.....</p>
            
            
            <div id='fotos'>
            <img id="imagem_caminho_foto1" src=""/>
            <img id="imagem_caminho_foto2" src=""/>
            </div>            
            <h2>Desenho técnico do painel &emsp;
            <label id="addd" class="btn btn-warning" onclick="teste();">Download</label>
            <label id="btn_mapa_rede" class="btn btn-success" onclick="mapa_rede();">Visualizar Mapa Rede</label> 
      
            </h2>
            
            <div id='div_mapa_rede'>
            <label id="btn_fechar2" class="btn btn-danger" onclick="fechar();">X</label>          
            <img id="imagem_caminho_foto3" src=""/> 
             
            </div>

            <div id="exibir_fotos">
            <img id="v_imagem_foto1" src=""/> 
            <label id="btn_fechar" class="btn btn-danger" onclick="fechar();">X</label>
            </div>

            <h2 id='lb_equipamentos'>Equipamentos neste ponto</h2>
            
<div id='tabela' >
 <table  id="tabela_equipamentos"  border="5" class="table table-hover table-dark">
        <thead id='cabecalho'  >
            <tr>
                <td align="center">Nome Rede</td>
                <td align="center">IP Local</td>
                <td align="center">IP Externo</td>
                <td align="center">Equipamento</td>
                <td align="center">Instalacao</td>
                <td align="center">Backup</td>
            </tr>
        </thead>
        <tbody>
         
            
        </tbody>
    </table>
    
</div>

            <div class="line"></div>
       
            <h3 id="lb_desenvolvedor">Desenvolvido por: Bruno Gonçalves </h3>

        </div>
    </div>
 <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script type="text/javascript">
     
      function fechar()
      {
        document.getElementById('tabela').style.display='block';
        document.getElementById('lb_equipamentos').style.display='block';
        document.getElementById('exibir_fotos').style.display='none';
        document.getElementById('div_mapa_rede').style.display='none';
        document.getElementById('btn_fechar2').style.visibility='hidden';
        document.getElementById('btn_mapa_rede').style.visibility='visible';
      }



     function teste(nome)
      {
        var i_id = "id"+nome;
        //Pego a posicao top para definir onde inicia a altura da div
        var nome2 = document.getElementById(i_id).name;
        //alert(nome2);
        document.getElementById('v_imagem_foto1').src=nome2;

        document.getElementById('tabela').style.display='none';
        document.getElementById('lb_equipamentos').style.display='none';
        document.getElementById('exibir_fotos').style.display='block';
                
        //alert(nome2);
        
      }
      function teste2(nome)
      {
        var i_id = "id2"+nome;
        //Pego a posicao top para definir onde inicia a altura da div
        var nome2 = document.getElementById(i_id).name;
        //alert(nome2);
        document.getElementById('v_imagem_foto1').src=nome2;

        document.getElementById('tabela').style.display='none';
        document.getElementById('lb_equipamentos').style.display='none';
        document.getElementById('exibir_fotos').style.display='block';
                
        //alert(nome2);
        
      }
     
     function valida_ponto(ponto)
     {
       
        document.getElementById('exibir_fotos').style.display='none';


        document.getElementById('tabela').style.display='block';
        var caminho_foto3 = "";
        $.ajax({
           url: 'tela_consulta_pontos.php',
           type: 'GET',
           dataType: 'json',
           data: {'ponto': ponto},
           success: function(resultado)
           {
          
            const myArr2 = resultado.split(",");
            var id = myArr2[0];
            var site = myArr2[1];
            var area = myArr2[2];
            var caminho_foto1 = myArr2[3];
            var caminho_foto2 = myArr2[4];
            caminho_foto3 = myArr2[5];
            var descricao1 = myArr2[6];
            document.getElementById("descricao1").innerHTML = descricao1;            

            document.getElementById("titulo_ponto").innerHTML = ponto;    
            document.getElementById("imagem_caminho_foto1").src=caminho_foto1;
            document.getElementById("imagem_caminho_foto2").src=caminho_foto2;
            document.getElementById('imagem_caminho_foto3').src=caminho_foto3;
         
           }
         });
         
         $.ajax({
           url: 'tela_consulta_equipamentos.php',
           type: 'GET',
           dataType: 'json',
           data: {'ponto': ponto},
           success: function(resultado)
           {
            //Deleto todos elementos da tabela
            var quantidade = parseInt(document.getElementById('v_encontrados').innerHTML);
            // alert(quantidade);


            var quantidade_online = 0;
            var quantidade_offline = 0;
            var quantidade_bloqueado = 0;

            if (quantidade > 0)
            {
             for (var i = 1; i <= quantidade; i++) 
             {
              document.getElementById("linhas_tabela").remove();
             }
             document.getElementById('v_encontrados').innerHTML = "0";
            }
            
            const myArr2 = resultado.split(";");
            var encontrado = myArr2[0];
            if(encontrado == -99)
            {
                document.getElementById('v_encontrados').innerHTML = "0";
            }
            else
            {
                document.getElementById('v_encontrados').innerHTML = encontrado;
            }
            
            console.log("Encontrados = " + encontrado);
           
            for (var i = 1; i <= encontrado; i++) 
            {
             var msg = myArr2[i].split(',');   
             var id = msg[0];
             var nome_rede = msg[1];
             var ip = msg[2];
             var ip_externo = msg[3];
             var caminho_backup = msg[4];
             var caminho_foto_equipamento = msg[5];
             var caminho_foto_instalacao = msg[6];
             var condicao = msg[7];
             

             var dados = id + '/' + condicao;

             if(condicao == "online")
             {
                quantidade_online = quantidade_online + 1;
             }
             else if(condicao == "offline")
             {
               quantidade_offline = quantidade_offline + 1;
             }
             else if (condicao == "bloqueado")
             {
               quantidade_bloqueado = quantidade_bloqueado + 1;
             }
             else
             {
               //Pode seguranca considera offline qualquer outra coisa
               quantidade_offline = quantidade_offline + 1;
             }

             console.log(id);
             console.log(nome_rede);
             console.log(ip);
             console.log(ip_externo);
             console.log(caminho_backup);
             console.log(caminho_foto_equipamento);
             console.log(caminho_foto_instalacao);
             console.log(condicao);
             console.log (dados);
             console.log("");console.log("***********************************");console.log("");
          
             //Agora monto a tabela
             var linha = "<tr id='linhas_tabela'>";
                 if(condicao == "online")
                 {
                    
                    linha += "<td  onclick=equipamento("+id+")> <img id=equipamento"+id+" src='./images/online.png' class='online'/>" + nome_rede + "</td>";
                 }
                 else if(condicao == "offline")
                 {
                    linha += "<td onclick='equipamento("+id+")'> <img id=equipamento"+id+" src='./images/offline.png' class='offline'/>" + nome_rede + "</td>";
                 }
                 else if(condicao == "bloqueado")
                 {
                    linha += "<td onclick='equipamento("+id+")'> <img id=equipamento"+id+" src='./images/bloqueado.png' class='bloqueado'/>" + nome_rede + "</td>";
                 }                 
                 else
                 {
                    linha += "<td onclick='equipamento("+id+")'> <img id=equipamento"+id+" src='./images/offline.png' class='offline'/>" + nome_rede + "</td>";
                 }
                 
                 linha += "<td >" + ip + "</td>";
                 linha += "<td >" + ip_externo + "</td>";
                 linha += "<td><a name='"+caminho_foto_equipamento+"' id=id"+ id +" href=#"+ caminho_foto_equipamento + " class='btn btn-primary' onclick='teste("+id+")'   >Foto Equipamento</a></td>";
                 linha += "<td><a name='"+caminho_foto_instalacao+"' id=id2"+ id +" href=#"+ caminho_foto_instalacao + " class='btn btn-success' onclick='teste2("+id+")'   >Foto Instalação</a></td>";
                 linha += '<td><a href="'+ caminho_backup +'" class="btn btn-warning">Download</a></td>';
                 linha += '</tr>';
                 $("#tabela_equipamentos").append(linha); //Adiciona os elementos a tabela via jQuery
            }
            //Acabei o for, agora atualizo os dados
            var link_titulo = document.getElementById('lb_equipamentos').innerHTML = "Equipamentos neste ponto: &nbsp;&nbsp;" + encontrado + "&emsp;&emsp;<img src='./images/online.png' class='online'/> " + quantidade_online + "&ensp; <img src='./images/offline.png' class='offline'/> " + quantidade_offline + "&ensp;<img src='./images/bloqueado.png' class='bloqueado'/> " + quantidade_bloqueado + "&emsp;Disponibilidade: " +(100-(quantidade_offline/quantidade_online*100)).toFixed(1) + "%";
            
            
           
           }
         });

      }
      
      function mapa_rede()
      {
        document.getElementById('tabela').style.display='none';
        document.getElementById('lb_equipamentos').style.display='none';
        document.getElementById('exibir_fotos').style.display='none';
        document.getElementById('div_mapa_rede').style.display='block';
        document.getElementById('btn_fechar2').style.visibility='visible';
        document.getElementById('btn_mapa_rede').style.visibility='hidden';
        
      }

     function equipamento(id)
     {
       var equipamento = "equipamento"+ id; 
       //console.log(equipamento);
       var link_equipamento = document.getElementById(equipamento);  
       var url = link_equipamento.src;
       if(url.includes("online"))
       {
        console.log("online");
       }
       else if (url.includes("offline"))
       {
        console.log("offline");
       }
       else
       {
        console.log("bloqueado");
       }
     }
      document.getElementById( 'div_mapa_rede' ).style.display = 'none';
      document.getElementById('btn_fechar2').style.visibility='hidden';
      document.getElementById('btn_mapa_rede').style.visibility='visible';
      valida_ponto('Rack Logistica');
      
    </script>





</div>






</body>


<style>
.online{
    width: 18px;
    height: 18px;
    padding-right: 5px;
}
.offline{
    width: 18px;
    height: 18px;
    padding-right: 5px;
}
.bloqueado{
    width: 18px;
    height: 18px;
    padding-right: 5px;
}





DIV#exibir_fotos
{
    width: 750px;
    height: 500px;
    background-color: transparent;
}

#btn_fechar
{
    position: relative;
    left: -7%;
    top: -38.5%;
}
#btn_fechar2
{
    position: relative;
    left: 96.5%;
    
    
}


#v_imagem_foto1
{
    width: 600px;
    height: 450px;
    background-color: #ffffff;
    cursor: pointer;
    border-radius: 10px!important;
    border: 6px #000000 solid!important;
}


DIV#fotos
{
 padding-left: 13%;
 padding-bottom: 3%;
}

#cabecalho
{
    font: bold 13pt verdana;
    color:#000000;
    background-color: #ffffff;
}
IMG#imagem_caminho_foto1{
    margin: 10px;
    width: 400px;
    height: 300px;
    cursor: pointer;
    border-radius: 10px!important;
    border: 6px #000000 solid!important;

}
IMG#imagem_caminho_foto2{
    margin: 10px;
    width: 400px;
    height: 300px;
    cursor: pointer;
    border-radius: 10px!important;
    border: 6px #000000 solid!important;

}
IMG#imagem_caminho_foto3{
    
    margin-top: -51px;
    margin-left: 10px;
    width: 1180px;
    height: 850px;
    cursor: pointer;
    border-radius: 10px!important;
    border: 6px #000000 solid!important;

}
IMG#voltar{
    margin-left: 0px;
    position: absolute;
    left: 4%;
    top: 2%;
    width: 28px;
    height: 28px;
    cursor: pointer;

}
IMG#home{
    margin-left: 0px;
    position: absolute;
    left: 6.5%;
    top:  2%;
    width: 28px;
    height: 28px;
    cursor: pointer;

}


#lb_desenvolvedor{
    padding-top: -24px;
    margin-left: 30%;
    
    font: normal 14pt verdana;
}


#conexao{
    margin-left: 0%;
    position: absolute;
    padding-left:1%;
    padding-top:1%;
    text-align:left;
    font: normal 18pt verdana;
    color:#ffffff;
    left: 0%;
    top: 0%;
    width:99.9%;
    height:4.5%;
    background-color:rgba(0, 0, 0, 0.90);
}
#colaborador{
    margin-left: 0%;
    position: absolute;
    padding-left:1%;
    padding-top:1%;
    text-align:left;
    font: normal 12pt verdana;
    color:#ffffff;
    left: 22%;
    top: -10%;
}
#funcao{
    margin-left: 0px;
    position: absolute;
    padding-left:10px;
    padding-top:5px;
    text-align:left;
    font: normal 12pt verdana;
    color:#ffffff;
    left: 75%;
    top: 25%;
}
INPUT#criptografia
{
    margin-left: 0px;
    position: absolute;
    padding-left:10px;
    padding-top:5px;
    text-align:left;
    width: 300px;
    font: normal 11pt verdana;
    color:#000000;
    left: 30%;
    top: 5%;

}
INPUT#criptografia2
{
    margin-left: 0px;
    position: absolute;
    padding-left:10px;
    padding-top:5px;
    text-align:left;
    width: 100px;
    font: normal 11pt verdana;
    color:#000000;
    left: 55%;
    top: 5%;

}

@import "https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700";


body {
    font-family: 'Poppins', sans-serif;
    background: #fafafa;
}

html{
background-color: rgba(0, 0, 0, 0.8);
margin-top: -25px !important;
background-size: 100%;
}

p {
    font-family: 'Poppins', sans-serif;
    font-size: 1.1em;
    font-weight: 400;
    line-height: 1.7em;
    color: #999;
}
a, a:hover, a:focus {
    color: inherit;
    text-decoration: none;
    transition: all 0.3s;
}

.navbar {
    padding: 15px 10px;
    background: #fff;
    border: none;
    border-radius: 0;
    margin-bottom: 40px;
    box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
}


.navbar-btn {
    box-shadow: none;
    outline: none !important;
    border: none;
}

.line {
    width: 100%;
    height: 1px;
    border-bottom: 1px dashed #ddd;
    margin: 40px 0;
}
.wrapper {
    display: flex;
    width: 100%;
    align-items: stretch;
    perspective: 1400px;
}
#div_geral{
    position: absolute;  
    width: 95%;
    height: 55%;
}




#sidebar {/* Menu lateral */
    margin-top: 0%;
    margin-left: 0%;
    padding-top: 0px;
    min-width: 250px;
    max-width: 250px;
    background: rgba(0, 0, 0, 0.88);
    color: #fff;

}


#sidebar.active {
    margin-left: -250px;
    transform: rotateY(100deg);
}

#sidebar .sidebar-header {
    padding: 7px;
    background: rgba(0, 0, 0, 0.8);
}

#sidebar ul.components {
    padding: 7px 0;
    border-bottom: 2px solid #000000;
}

#sidebar ul p {
    color: #fff;
    padding: 10px;
}

#sidebar ul li a {
    padding: 10px;
    font-size: 1.1em;
    display: block;
}
#sidebar ul li a:hover {
    color: #000000;
    background: #fff;
}

#sidebar ul li.active > a, a[aria-expanded="true"] {
    color: #fff;
    background: rgba(0, 0, 0, 0.8);
}


a[data-toggle="collapse"] {
    position: relative;
}

.dropdown-toggle::after { /*setinha */
    display: block;
    position: absolute;
    top: 50%;
    right: 25px;
    transform: translateY(-50%);
}

ul ul a {
    font-size: 1em !important;
    padding-left: 30px !important;
    background: rgba(0, 0, 0, 0.7);
}


h2 {
    padding: 20px;
    color: rgba(255, 255, 255, 0.8)
}

ul.CTAs {
    padding: 20px;
}

ul.CTAs a {
    text-align: center;
    font-size: 0.9em !important;
    display: block;
    border-radius: 5px;
    margin-bottom: 5px;
}

a.download {
    background: #fff;
    color: #7386D5;
}

a.article, a.article:hover {
    background: rgba(0, 0, 0, 0.7) !important;
    color: #fff !important;
}



#content {/*tela onde ficam os dados ao lado do menu*/ 
    width: 100%;
    padding-left: 20px;
    padding-top: 67px;
    min-height: 100vh;
    transition: all 0.3s;
}

#sidebarCollapse { /* Botao clicar para esconder  */
    padding-top: 50px;
    width: 40px;
    height: 40px;
    background: #f5f5f5;
    cursor: pointer;
}

#sidebarCollapse span {
    width: 100%;
    height: 2px;
    margin: 0 auto;
    display: block;
    background: #555;
    transition: all 0.8s cubic-bezier(0.810, -0.330, 0.345, 1.375);
    transition-delay: 0.2s;
}



</style>



</html>