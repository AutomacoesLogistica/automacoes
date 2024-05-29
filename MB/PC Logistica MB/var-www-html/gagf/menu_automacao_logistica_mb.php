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

<script src="https://code.jquery.com/jquery-2.2.3.min.js" integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo=" crossorigin="anonymous"></script>
        
    
</head>
<body>
<div id="conexao">
<label id="colaborador"></label>
<label id="funcao"></label>
<label id='lb_ref_nome_tabela' hidden='hidden'></label>
<label id='lb_ref_ip' hidden='hidden'></label>
<label id='lb_ref_ip2' hidden='hidden'></label>
<label id='lb_ref_url_equipamento' hidden='hidden'></label>
<label id='lb_ref_ordem' hidden='hidden'></label>
<label id='lb_ref_status' hidden='hidden'></label>

<input type="text" name="criptografia" id="criptografia" value="ssss" hidden="hidden"/>
<input type="text" name="criptografia2" id="criptografia2" value="ssss" hidden="hidden"/>

</div>



<?php
// Busca o usuario passado e verifica no sistema
$ip = $_SERVER['REMOTE_ADDR'];
if($ip == "192.168.10.1")
{
 //echo('remoto');
 ?>
 <script>document.getElementById('lb_ref_ip').innerHTML = "Remoto";</script>
 <?php
}
else
{
  //echo('local')
  ?>
 <script>document.getElementById('lb_ref_ip').innerHTML = "Local";</script>
 <?php
}
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
                <h3>MENU</h3>
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
                    <a href="#Patrag2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Patrag</a>
                    <ul class="collapse list-unstyled" id="Patrag2">
                        
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


                <li>
                  <a href="#vlans" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">VLANs </a>
                  <ul class="collapse list-unstyled" id="vlans">
                    <!-- VLANS CFTV ******************************************************************************************************************* -->
                    <a href="#vlans_cftv" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">CFTV</a>
                    <ul class="collapse list-unstyled" id="vlans_cftv">
                      <li>
                        <a href="#rede_cento_sessenta_dez_xx" onclick="valida_rede('Rede 192.160.10.XX,Todos,Todos,Todos,Todos');">192.160.10.XX ID (170)</a>
                      </li>
                      <li>
                        <a href="#rede_cento_sessenta_vinte_xx" onclick="valida_rede('Rede 192.160.20.XX,Todos,Todos,Todos,Todos');">192.160.20.XX  ID (180)</a>
                      </li>                        
                      <li>
                        <a href="#rede_cento_sessenta_trinta_xx" onclick="valida_rede('Rede 192.160.30.XX,Todos,Todos,Todos,Todos');">192.160.30.XX ID (190)</a>
                      </li>                        
                      <li>
                        <a href="#rede_cento_sessenta_quarenta_xx" onclick="valida_rede('Rede 192.160.40.XX,Todos,Todos,Todos,Todos');">192.160.40.XX ID (200) </a>
                      </li> 
                    </ul>

                    <!-- VLANS VOIP ******************************************************************************************************************* -->
                    <a href="#vlans_voip" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">VOIP</a>
                    <ul class="collapse list-unstyled" id="vlans_voip">
                      <li>
                        <a href="#rede_cento_sessenta_um_dez_xx" onclick="valida_rede('Rede 192.161.10.XX,Todos,Todos,Todos,Todos');">192.161.10.XX ID (171)</a>
                      </li>
                      <li>
                        <a href="#rede_cento_sessenta_um_vinte_xx" onclick="valida_rede('Rede 192.161.20.XX,Todos,Todos,Todos,Todos');">192.161.20.XX ID (181)</a>
                      </li>                        
                      <li>
                        <a href="#rede_cento_sessenta_um_trinta_xx" onclick="valida_rede('Rede 192.161.30.XX,Todos,Todos,Todos,Todos');">192.161.30.XX ID (191)</a>
                      </li>
                      <li>
                        <a href="#rede_cento_sessenta_um_quarenta_xx" onclick="valida_rede('Rede 192.161.40.XX,Todos,Todos,Todos,Todos');">192.161.40.XX ID (201)</a>
                      </li>
                    </ul>

                    <!-- VLANS Automacoes ******************************************************************************************************************* -->
                    <a href="#vlans_automacoes" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Automacoes</a>
                    <ul class="collapse list-unstyled" id="vlans_automacoes">
                      <li>
                        <a href="#rede_cento_sessenta_dois_dez_xx" onclick="valida_rede('Rede 192.162.10.XX,Todos,Todos,Todos,Todos');">192.162.10.XX ID (172)</a>
                      </li>
                      <li>
                        <a href="#rede_cento_sessenta_dois_vinte_xx" onclick="valida_rede('Rede 192.162.20.XX,Todos,Todos,Todos,Todos');">192.162.20.XX ID (182)</a>
                      </li>
                      <li>
                        <a href="#rede_cento_sessenta_dois_trinta_xx" onclick="valida_rede('Rede 192.162.30.XX,Todos,Todos,Todos,Todos');">192.162.30.XX ID (192)</a>
                      </li>
                      <li>
                        <a href="#rede_cento_sessenta_dois_quarenta_xx" onclick="valida_rede('Rede 192.162.40.XX,Todos,Todos,Todos,Todos');">192.162.40.XX ID (202)</a>
                      </li>
                     </ul>                    

                  </ul>
                </li>



                <li class="active">
                    <a href="#rede" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">REDE</a>











                    <ul class="collapse list-unstyled" id="rede">
                       




                        <li>
                            <a href="#rede_dez_xx" onclick="valida_rede('Rede 192.168.10.XX,Todos,Todos,Todos,Todos');">192.168.10.XX</a>
                        </li>
                        <li>
                            <a href="#rede_onze_xx" onclick="valida_rede('Rede 192.168.11.XX,Todos,Todos,Todos,Todos');">192.168.11.XX</a>
                        </li>
                        <li>
                            <a href="#rede_doze_xx" onclick="valida_rede('Rede 192.168.12.XX,Todos,Todos,Todos,Todos');">192.168.12.XX</a>
                        </li>
                        <li>
                            <a href="#rede_vinte_xx" onclick="valida_rede('Rede 192.168.20.XX,Todos,Todos,Todos,Todos');">192.168.20.XX</a>
                        </li>
                        <li>
                            <a href="#rede_trinta_xx" onclick="valida_rede('Rede 192.168.30.XX,Todos,Todos,Todos,Todos');">192.168.30.XX</a>
                        </li>
                        <li>
                            <a href="#rede_quarenta_xx" onclick="valida_rede('Rede 192.168.40.XX,Todos,Todos,Todos,Todos');">192.168.40.XX</a>
                        </li>
                        <li>
                            <a href="#rede_dez_cem_vinte_e_tres_xx" onclick="valida_rede('Rede 10.100.23.XX,Todos,Todos,Todos,Todos');">10.100.23.XX</a>
                        </li>         
                        <li>
                            <a href="#rede_acessos_xx" onclick="valida_rede('Rede Acessos,Todos,Todos,Todos,Todos');">Rede Acessos</a>
                        </li>                         
                        <li>
                            <a href="#rede_gerdau" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Rede GERDAU </a>
                            <ul class="collapse list-unstyled" id="rede_gerdau">
                                <li>
                                    <a href="#rede_gerdau_utmi" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">UTMI </a>
                                    <ul class="collapse list-unstyled" id="rede_gerdau_utmi">
                                        <li>
                                            <a href="#gerdau_utmi_bal1" id="gerdau_utmi_bal1" onclick="valida_rede('Rede GERDAU UTMI - Balanca 1,Todos,Todos,Todos,Todos');">&ensp;&ensp;Balanca 1</a>
                                        </li>
                                        <li>
                                            <a href="#gerdau_utmi_bal2" id="gerdau_utmi_bal2" onclick="valida_rede('Rede GERDAU UTMI - Balanca 2,Todos,Todos,Todos,Todos');">&ensp;&ensp;Balanca 2</a>
                                        </li>
                                        <li>
                                            <a href="#gerdau_utmi_amostragem" id="gerdau_utmi_amostragem" onclick="valida_rede('Rede GERDAU UTMI - Amostragem,Todos,Todos,Todos,Todos');">&ensp;&ensp;Amostragem</a>
                                        </li>
                                        <li>
                                            <a href="#gerdau_utmi_escritorio" id="gerdau_utmi_escritorio" onclick="valida_rede('Rede GERDAU UTMI - Escritorio,Todos,Todos,Todos,Todos');">&ensp;&ensp;Escritorio/CCL</a>
                                        </li>

                                    </ul>
                                </li>

                                <li>
                                    <a href="#rede_gerdau_vl" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">VL </a>
                                    <ul class="collapse list-unstyled" id="rede_gerdau_vl">
                                        <li>
                                            <a href="#gerdau_vl_bal2" id="gerdau_vl_bal2" onclick="valida_rede('Rede GERDAU VL - Balanca 2,Todos,Todos,Todos,Todos');">&ensp;&ensp;Balanca 2</a>
                                        </li>
                                        <li>
                                            <a href="#gerdau_vl_bal3" id="gerdau_vl_bal3" onclick="valida_rede('Rede GERDAU VL - Balanca 3,Todos,Todos,Todos,Todos');">&ensp;&ensp;Balanca 3</a>
                                        </li>
                                        <li>
                                            <a href="#gerdau_vl_bal5" id="gerdau_vl_bal5" onclick="valida_rede('Rede GERDAU VL - Balanca 5,Todos,Todos,Todos,Todos');">&ensp;&ensp;Balanca 5</a>
                                        </li>
                                        <li>
                                            <a href="#gerdau_vl_ca1" id="gerdau_vl_ca1" onclick="valida_rede('Rede GERDAU VL - Controle de Acesso 1,Todos,Todos,Todos,Todos');">&ensp;&ensp;Controle Acesso 1</a>
                                        </li>
                                        <li>
                                            <a href="#gerdau_vl_ca2" id="gerdau_vl_ca2" onclick="valida_rede('Rede GERDAU VL - Controle de Acesso 2,Todos,Todos,Todos,Todos');">&ensp;&ensp;Controle Acesso 2</a>
                                        </li>
                                        <li>
                                            <a href="#gerdau_vl_ca3" id="gerdau_vl_ca3" onclick="valida_rede('Rede GERDAU VL - Controle de Acesso 3,Todos,Todos,Todos,Todos');">&ensp;&ensp;Controle Acesso 3</a>
                                        </li>
                                        <li>
                                            <a href="#gerdau_vl_ccl" id="gerdau_vl_ccl" onclick="valida_rede('Rede GERDAU VL - CCL,Todos,Todos,Todos,Todos');">&ensp;&ensp;CCL</a>
                                        </li>
                                        <li>
                                            <a href="#gerdau_vl_k-house" id="gerdau_vl_k-house" onclick="valida_rede('Rede GERDAU VL - K-House,Todos,Todos,Todos,Todos');">&ensp;&ensp;K-House</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#rede_gerdau_vln" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">VLN </a>
                                    <ul class="collapse list-unstyled" id="rede_gerdau_vln">
                                        <li>
                                            <a href="#gerdau_vln_bal" id="gerdau_vln_bal" onclick="valida_rede('Rede GERDAU VLN - Balanca,Todos,Todos,Todos,Todos');">&ensp;&ensp;Balanca</a>
                                        </li>
                                        <li>
                                            <a href="#gerdau_vln_escritorio" id="gerdau_vln_escritorio" onclick="valida_rede('Rede GERDAU VLN - Escritorio,Todos,Todos,Todos,Todos');">&ensp;&ensp;Escritorio</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#rede_gerdau_patrag" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">PATRAG </a>
                                    <ul class="collapse list-unstyled" id="rede_gerdau_patrag">
                                        <li>
                                            <a href="#gerdau_patrag_balanca" id="gerdau_patrag_balanca" onclick="valida_rede('Rede GERDAU PATRAG - Balanca,Todos,Todos,Todos,Todos');">&ensp;&ensp;Balanca</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#rede_gerdau_usina" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">UOB </a>
                                    <ul class="collapse list-unstyled" id="rede_gerdau_usina">
                                        <li>
                                            <a href="#gerdau_usina_noroeste" id="gerdau_usina_noroeste" onclick="valida_rede('Rede GERDAU Usina - NOROESTE,Todos,Todos,Todos,Todos');">&ensp;&ensp;Portaria NOROESTE</a>
                                        </li>
                                        <li>
                                            <a href="#gerdau_usina_p6" id="gerdau_usina_p6" onclick="valida_rede('Rede GERDAU Usina - P6,Todos,Todos,Todos,Todos');">&ensp;&ensp;P6</a>
                                        </li>

                                    </ul>
                                </li>

                            </ul>
                        </li>
      
                    </ul>
                </li>


                <li class="active">
                    <a href="#gestao" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Gestão</a>
                    <ul class="collapse list-unstyled" id="gestao">
                        <li>
                            <a href="#usuarios\" onclick="valida_gestao_usuarios('');">Gestão de Usuários</a>
                        </li>
                        <li>
                            <a href="#dashboard\" onclick="valida_dashboard('');">Dashboard</a>
                        </li>

                      </ul>
                </li>


                <li class="active">
                    <a href="#softwares" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Softwares</a>
                    <ul class="collapse list-unstyled" id="softwares">
                        <li>
                            <a href="#software_winbox\" onclick="valida_ponto('');">Winbox</a>
                        </li>
                    </ul>
                </li>                

                <li class="active">
                    <a href="#firmwares" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Firmares</a>
                    <ul class="collapse list-unstyled" id="firmwares">
                        <li>
                            <a href="#software_winbox\" onclick="valida_ponto('Firmwares');">Câmeras</a>
                        </li>
                        <li>
                            <a href="#software_winbox\" onclick="valida_ponto('Firmwares');">NVR</a>
                        </li>
                        <li>
                            <a href="#software_winbox\" onclick="valida_ponto('Firmwares');">Câmeras</a>
                        </li>
                        <li>
                            <a href="#software_winbox\" onclick="valida_ponto('Firmwares');">Câmeras</a>
                        </li>

                    </ul>
                </li>













            <ul class="list-unstyled CTAs">
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
            <h2 id='lb_desenho'>Desenho técnico do painel &emsp;
            <label id="btn_download" class="btn btn-warning" onclick="teste();">Download</label>
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

            <h2 id='lb_filtro'>Filtro de dados: </h2>
            <div id='filtro'>
            
            <label id="lb_dados_modelo2">Modelo :  </label>
                <select id="select_dados_modelo2">
                <?php
                include_once 'conexao_portal_gestao.php';
                $sql = $dbcon->query("SELECT * FROM tabela_modelo ORDER BY modelo ASC");
                if(mysqli_num_rows($sql)>0)
                {
                while($dados = $sql->fetch_array())
                {
                    $modelo = $dados['modelo'];
                    ?>
                    <option value="<?php print $modelo ?>"><?php print $modelo ?></option>
                    <?php
                }
                ?>
                <option value="<?php print "Todos" ?>"><?php print "Todos" ?></option>
                <?php
                }
                ?>
                </select>
                           


                <label id="lb_dados_tipo2">Tipo :  </label>
                <select id="select_dados_tipo2">
                <?php
                include_once 'conexao_portal_gestao.php';
                $sql = $dbcon->query("SELECT * FROM tabela_tipo ORDER BY tipo ASC");
                if(mysqli_num_rows($sql)>0)
                {
                while($dados = $sql->fetch_array())
                {
                    $tipo = $dados['tipo'];
                    ?>
                    <option value="<?php print $tipo ?>"><?php print $tipo ?></option>
                    <?php
                }
                ?>
                <option value="<?php print ">>> Mikrotik" ?>"><?php print ">>> Mikrotik" ?></option>
                <option value="<?php print "Todos" ?>"><?php print "Todos" ?></option>
                <?php
                }
                
                ?>
                </select>
                <label id="btn_filtrar" class="btn btn-warning" onclick="Filtrar();">Filtrar</label> 
                <label id="btn_limpar" class="btn btn-success" onclick="Limpar();">Limpar</label> 
            </div>
            <script>
                document.getElementById('select_dados_modelo2').value='Todos';
                document.getElementById('select_dados_tipo2').value='Todos';
            </script>


            <h2 id='lb_equipamentos'>Equipamentos neste ponto</h2>
            
<div id='tabela' >
 <table  id="tabela_equipamentos"  border="5" class="table table-hover table-dark">
        <thead id='cabecalho'  >
            <tr>
                <td align="center" id='col1'>Nome Rede</td>
                <td align="center"id='col2'>IP Local</td>
                <td align="center"id='col3'>IP Externo</td>
                <td align="center"id='col4'>Equipamento</td>
                <td align="center"id='col5'>Instalacao</td>
                <td align="center"id='col6'>Backup</td>
            </tr>
        </thead>
        <tbody>
         
            
        </tbody>
    </table>


</div>


<div id='div_gestao'>
<table  id="tabela_usuarios"  border="5" class="table table-hover table-dark">
        <thead id='cabecalho'  >
            <tr>
                <td align="center" id='col1'>Nome Usuário</td>
                <td align="center"id='col2'>Descricao</td>
            </tr>
        </thead>
        <tbody>
       </tbody>
    </table>
    </BR>
    <input type="button" id="btn_adicionar_usuario" name="btn_adicionar_usuario" class='btn btn-success' value="Adicionar usuário" onclick='adiciona_usuario();'/>";
</div>
<div id='div_dashboard'>
  
</div>






<div id="div_camera">
<h2 id="titulo_camera"><b>Dados para ajuste do equipamento</b></h2>

<input type="button" name='btn_cameras_reiniciar' id='btn_cameras_reiniciar' class='btn btn-warning'  onclick='comando_reiniciar_camera()' value='Reiniciar Câmera' >

<input type="button" name='btn_cameras_ntp' id='btn_cameras_ntp' class='btn btn-primary'  onclick='comando_ntp_camera()' value='Sincronizar NTP' >

<input type="button" name='btn_cameras_buscar_nome' id='btn_cameras_buscar_nome' class='btn btn-primary'  onclick='comando_buscar_nome_camera()' value='Buscar Nome' >

<input type="button" name='btn_cameras_buscar_versao' id='btn_cameras_buscar_versao' class='btn btn-primary'  onclick='comando_buscar_versao_camera()' value='Buscar Versão' >
<input type="button" name='btn_cameras_buscar_modelo' id='btn_cameras_buscar_modelo' class='btn btn-primary'  onclick='comando_buscar_modelo_camera()' value='Buscar Modelo' >
</BR></BR>
<label id='lb_ref_ip_camera' >IP do equipamento = XX </label>
</BR></BR>
<label id='lb_ref_nome_camera' >Nome do equipamento = XX </label>
&emsp;&emsp;<input type="button" name='btn_cameras_setar_nome' id='btn_cameras_setar_nome' class='btn btn-primary'  onclick='alert("Em desenvolvimento!");' value='Definir Nome' >

</BR></BR>
<label id='lb_ref_modelo_camera' >Modelo do equipamento = XX </label>
</BR></BR>
<label id='lb_ref_versao_camera' >Versão de firmware do equipamento = XX </label>
</BR></BR>
<input type="button" name='btn_cameras_sair' id='btn_cameras_sair' class='btn btn-danger'  onclick='comando_sair_camera()' value='Sair' >
<img id="imagem_carregando_camera" src="./images/carregando.gif"/>
</div>



<div id="div_radio">
<h2 id="titulo_radio"><b>Dados para ajuste do equipamento Mikrotik</b></h2>
<input type="button" name='btn_radio_reiniciar' id='btn_radio_reiniciar' class='btn btn-warning'  onclick='comando_reiniciar_radio()' value='Reiniciar' >
<input type="button" name='btn_radio_radius' id='btn_radio_radius' class='btn btn-success'  onclick='comando_habilita_radius_radio()' value='Habilitar RADIUS' >
<input type="button" name='btn_radio_grupos' id='btn_radio_grupos' class='btn btn-success'  onclick='comando_habilita_grupos_radio()' value='Ativa Grupos' >
<input type="button" name='btn_radio_ntp' id='btn_radio_ntp' class='btn btn-primary'  onclick='comando_habilita_ntp_radio()' value='Ativar NTP' >
<input type="button" name='btn_radio_buscar_nome' id='btn_radio_buscar_nome' class='btn btn-primary'  onclick='comando_buscar_nome_radio()' value='Buscar Nome' >
<input type="button" name='btn_radio_buscar_uptime' id='btn_radio_buscar_uptime' class='btn btn-primary'  onclick='comando_buscar_uptime_radio()' value='Buscar UPTIME' >
<input type="button" name='btn_radio_buscar_versao' id='btn_radio_buscar_versao' class='btn btn-primary'  onclick='comando_buscar_versao_radio()' value='Buscar Versão' >
<input type="button" name='btn_radio_buscar_modelo' id='btn_radio_buscar_modelo' class='btn btn-primary'  onclick='comando_buscar_modelo_radio()' value='Buscar Modelo' >

</BR></BR>
<label id='lb_ref_ip_radio' >IP do equipamento = XX </label><label id='lb_ref_uptime_radio' >&emsp;&emsp;&emsp;UPTIME = -- &emsp;&emsp;&emsp;<input type="button" name='btn_radio_primeiro_acesso' id='btn_radio_primeiro_acesso' class='btn btn-success'  onclick='comando_primeiro_acesso_radio()' value='Primeiro Acesso!' hidden='hidden'></label>
</BR></BR>
<label id='lb_ref_nome_radio' >Nome do equipamento = XX </label>
&emsp;&emsp;<input type="button" name='btn_radio_setar_nome' id='btn_radio_setar_nome' class='btn btn-primary'  onclick='alert("Em desenvolvimento!");' value='Definir Nome' >
</BR></BR>
<label id='lb_ref_modelo_radio' >Modelo do equipamento = XX &emsp;&emsp;&emsp;S/N = XX </label>
</BR></BR>
<label id='lb_ref_versao_radio' >Versão de firmware do equipamento = XX </label>

</BR></BR>

<input type="button" name='btn_radio_sair' id='btn_radio_sair' class='btn btn-danger'  onclick='comando_sair_radio()' value='Sair' >

<img id="imagem_carregando_radio" src="./images/carregando.gif"/>


</div>





<div id="div_dados">

<label id="lb_dados_titulo">Editando dados do IP 192.168.10.1  </label>
<label id="lb_dados_nome">Nome Rede :  </label>
<input type="text" name="txt_dados_nome" id="txt_dados_nome" value="UTMI_RB2011_01 - Sala Log" >

<label id="lb_dados_gateway">Gateway :  </label>
<input type="text" name="txt_dados_gateway" id="txt_dados_gateway" value="192.168.10.1" >
<input type="text" name="txt_dados_ip" id="txt_dados_ip" value="" hidden='hidden' >
<input type="text" name="txt_dados_id" id="txt_dados_id" value="" hidden='hidden' >

<label id="lb_dados_mascara">Mascara :  </label>
<input type="text" name="txt_dados_mascara" id="txt_dados_mascara" value="255.255.255.0" >

<label id="lb_dados_modelo">Modelo :  </label>
<select id="select_dados_modelo">
  <?php
  include_once 'conexao_portal_gestao.php';
  $sql = $dbcon->query("SELECT * FROM tabela_modelo ORDER BY modelo ASC");
  if(mysqli_num_rows($sql)>0)
  {
   while($dados = $sql->fetch_array())
   {
    $modelo = $dados['modelo'];
    ?>
    <option value="<?php print $modelo ?>"><?php print $modelo ?></option>
    <?php
   }
  }
 ?>
</select>

<label id="lb_dados_tipo">Tipo :  </label>
<select id="select_dados_tipo">
<?php
  include_once 'conexao_portal_gestao.php';
  $sql = $dbcon->query("SELECT * FROM tabela_tipo ORDER BY tipo ASC");
  if(mysqli_num_rows($sql)>0)
  {
   while($dados = $sql->fetch_array())
   {
    $tipo = $dados['tipo'];
    ?>
    <option value="<?php print $tipo ?>"><?php print $tipo ?></option>
    <?php
   }
   
 }
 ?>
</select>
<label id="lb_dados_informacao">Informações Adicionais : </label>

<textarea id="text_area_informacao" name="text_area_informacao" rows="5" cols="70">Sem informações adicionais</textarea>
<label id="lb_dados_status">Condição :  Online</label>

<label id="lb_dados_id">ID : 01 </label>

<label id="lb_dados_ativo">Ativo :  </label>
<input type="radio" id="radio_ativo_sim" name="option_ativo" value="Sim">
<label id='lb_radio_ativo_sim' for="radio_ativo_sim">Sim</label>
<input type="radio" id="radio_ativo_nao" name="option_ativo" value="Não">
<label id='lb_radio_ativo_nao' for="radio_ativo_nao">Não</label>

<label id="lb_dados_usuario">Usuario : </label>
<input type="text" name="txt_dados_usuario" id="txt_dados_usuario" value="" >

<label id="lb_dados_senha">Senha : </label>
<input type="text" name="txt_dados_senha" id="txt_dados_senha" value="" >

<label id="lb_dados_editado_por">Ultima edição : BRUNO GONCALVES - 10/05/2023 às 10:10:22</label>

<input type="button" name='btn_dados_salvar' id='btn_dados_salvar' class='btn btn-primary' onclick='comando_salvar()' value='Salvar' >
<input type="button" name='btn_dados_apagar' id='btn_dados_apagar' class='btn btn-warning' onclick='comando_disponibilizar()' value='Disponibilizar IP' >
<input type="button" name='btn_dados_sair' id='btn_dados_sair' class='btn btn-danger'  onclick='comando_sair()' value='Sair' >
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
      function valida_gestao_usuarios()
      {
       console.log ( " GESTAO USUARIOS ******************************"); 
       document.getElementById( 'div_camera' ).style.display = 'none';
       document.getElementById( 'div_radio' ).style.display = 'none';
       document.getElementById( 'div_dados' ).style.display = 'none';
       document.getElementById( 'div_mapa_rede' ).style.display = 'none';
       document.getElementById('btn_fechar2').style.visibility='hidden';
       document.getElementById('lb_filtro').style.display='none';
       document.getElementById('filtro').style.display='none';
       document.getElementById('btn_mapa_rede').style.visibility='hidden';
       document.getElementById('exibir_fotos').style.display='none';
       document.getElementById('div_dados').style.display='none';
       document.getElementById('tabela').style.display='none';
       document.getElementById('lb_filtro').style.display='none';
       document.getElementById('filtro').style.display='none';
       document.getElementById('exibir_fotos').style.display='none';
       document.getElementById('imagem_caminho_foto1').style.display='none';
       document.getElementById('imagem_caminho_foto2').style.display='none';
       document.getElementById('imagem_caminho_foto3').style.display='none';
       document.getElementById('lb_desenho').style.display='none';
       document.getElementById('btn_download').style.display='none';
       document.getElementById('btn_mapa_rede').style.display='none';
       document.getElementById('tabela').style.display='none';
       document.getElementById('titulo_ponto').style.display='block';
       document.getElementById('titulo_ponto').innerHTML = "Gestão de usuários do sistema";
       document.getElementById('descricao1').style.display='none';
       document.getElementById('lb_equipamentos').style.display='none';
       document.getElementById('div_gestao').style.display='block';
       document.getElementById('div_dashboard').style.display='none';
       var funcao  = document.getElementById('funcao').innerHTML;
       if(funcao != "")
       {
        const myArr2 = funcao.split(":");
        funcao = myArr2[1];
       }
       else
       {
        funcao == "vazio";
       }
       //Preenchendo a tabela de usuarios
       $.ajax({
        url: 'tela_consulta_usuarios.php',
        type: 'GET',
        dataType: 'json',
        data: {'a': 'a'},
        success: function(resultado)
        {
         //console.log(resultado);
         //Deleto todos elementos da tabela
         var quantidade = parseInt(document.getElementById('v_encontrados').innerHTML);
         // alert(quantidade);
         console.log ( "Quantidade = " + quantidade);
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
         var quantidade_usado = 0;
 
         for (var i = 1; i <= encontrado; i++) 
         {
          var msg = myArr2[i].split(','); 
          var id = msg[0];
          var nome = msg[1];
          var perfil = msg[2];
          var status = msg[3];

          if(perfil == "full")
          {
           perfil = "Desenvolvedor";
          }
          else if(perfil == "suporte")
          {
           perfil = "Suporte";
          }  
          console.log(id);
          console.log(nome);
          console.log(perfil);
          console.log("******************");
          var linha = "<tr id='linhas_tabela'>";
          linha += "<td >";

          if(status == "ativo")
          {
           linha += "<img id=equipamento"+id+" src='./images/online.png' class='online'/>&emsp;" ;
          }
          else// "Bloqueado")
          {
           linha += "<img id=equipamento"+id+" src='./images/bloqueado.png' class='bloqueado'/>&emsp;"  ;
           perfil = perfil + "&emsp;&emsp;<b>>>>> Bloqueado! <<<</b>";
          }                 
          

          
          
          if(funcao.includes("Desenvolvedor")==true)
          {
           linha += "<a name='"+nome+"' id=id"+ id +" href=#"+ nome + " class='btn btn-primary' onclick='edita_usuario("+id+")'>Editar Usuario</a>";
          }
          else
          {
           if(funcao.includes("Administrador")==true)
           {
            if(perfil == "Desenvolvedor")
            {
             id = "-1"; 
             linha += "<a name='"+nome+"' id=id"+ id +" href=#"+ nome + " class='btn btn-primary' onclick='edita_usuario("+id+");'>Editar Usuario</a>";
            }
            else
            {
              linha += "<a name='"+nome+"' id=id"+ id +" href=#"+ nome + " class='btn btn-primary' onclick='edita_usuario("+id+")'>Editar Usuario</a>";   
            }
           }
          }

          linha += "&emsp;&emsp;"+nome + " </td>";
          
          //linha += "<td><a name='"+caminho_foto_instalacao+"' id=id2"+ id +" href=#"+ caminho_foto_instalacao + " class='btn btn-success' onclick='teste2("+id+")'   >Foto Instalação</a></td>";
                
          linha += "<td >" + perfil + "</td>";
          linha += '</tr>';
          $("#tabela_usuarios").append(linha); //Adiciona os elementos a tabela via jQuery
         } 
        }
      });   
      }











      function edita_usuario(id)
      {
       if(id == "-1")
       {
        alert("Sem permissao!");
       } 
       else
       {
        alert("clicou editar usuario"); 
       }



      }
      function valida_dashboard()
      {
       console.log ( " Dashboard ******************************"); 
       document.getElementById( 'div_camera' ).style.display = 'none';
       document.getElementById( 'div_radio' ).style.display = 'none';
       document.getElementById( 'div_dados' ).style.display = 'none';
       document.getElementById( 'div_mapa_rede' ).style.display = 'none';
       document.getElementById('btn_fechar2').style.visibility='hidden';
       document.getElementById('lb_filtro').style.display='none';
       document.getElementById('filtro').style.display='none';
       document.getElementById('btn_mapa_rede').style.visibility='hidden';
       document.getElementById('exibir_fotos').style.display='none';
       document.getElementById('div_dados').style.display='none';
       document.getElementById('tabela').style.display='none';
       document.getElementById('lb_filtro').style.display='none';
       document.getElementById('filtro').style.display='none';
       document.getElementById('exibir_fotos').style.display='none';
       document.getElementById('imagem_caminho_foto1').style.display='none';
       document.getElementById('imagem_caminho_foto2').style.display='none';
       document.getElementById('imagem_caminho_foto3').style.display='none';
       document.getElementById('lb_desenho').style.display='none';
       document.getElementById('btn_download').style.display='none';
       document.getElementById('btn_mapa_rede').style.display='none';
       document.getElementById('tabela').style.display='none';
       document.getElementById('titulo_ponto').style.display='block';
       document.getElementById('titulo_ponto').innerHTML = "Dashboard Disponibilidade da Rede";
       document.getElementById('descricao1').style.display='none';
       document.getElementById('lb_equipamentos').style.display='none';
       document.getElementById('div_gestao').style.display='none';
       document.getElementById('div_dashboard').style.display='block';

      }



      function comando_ntp_camera()
      {
        //Ativa icone gif
        document.getElementById('imagem_carregando_camera').style.display='block';
        //alert("clicou NTP");
        var ip = document.getElementById('lb_ref_ip2').innerHTML; //Pega o ip do equipamento
        if(ip != "vazio")
        {//Pode ajustar
         //alert(ip);
         var porta = 0;
         var v_ip = ip.split(".");
         v_ip = (v_ip[3]); //Pega a ultima divisao do ip para calcular a porta padrao
         if(v_ip <100)
         {
          porta = "80" + (v_ip).toString();
         }
         else
         {
          porta = "8" + (v_ip).toString();
         }
         //alert(porta);
         var ip_completo = (ip + ":" + porta).toString();
         //passo via ajax para realizar o ajuste
         $.ajax({
           url: 'script_setar_ntp_camera.php',
           type: 'GET',
           dataType: 'html',
           data: {'ip': ip_completo },
           success: function(resultado)
           {
            document.getElementById('imagem_carregando_camera').style.display='none'; //oculta gif
            alert(resultado); //Ja tras a resposta se deu certo ou nao!
           }
        });

        }
        else
        {
          document.getElementById('imagem_carregando_camera').style.display='none'; // oculta gif
          alert("Não é possivel realizar o ajuste no momento!");
        }
        

      }

      function comando_reiniciar_camera()
      {
        //Ativa imagem gif
        document.getElementById('imagem_carregando_camera').style.display='block';
        //alert("clicou NTP");
        var ip = document.getElementById('lb_ref_ip2').innerHTML; //Pega o ip do equipamento
        if(ip != "vazio")
        {//Pode ajustar
         //alert(ip);
         var porta = 0;
         var v_ip = ip.split(".");
         v_ip = (v_ip[3]); //Pega a ultima divisao do ip para calcular a porta padrao
         if(v_ip <100)
         {
          porta = "80" + (v_ip).toString();
         }
         else
         {
          porta = "8" + (v_ip).toString();
         }
         //alert(porta);
         var ip_completo = (ip + ":" + porta).toString();
         //passo via ajax para realizar o ajuste
         $.ajax({
           url: 'script_reiniciar_camera.php',
           type: 'GET',
           dataType: 'html',
           data: {'ip': ip_completo },
           success: function(resultado)
           {
            document.getElementById('imagem_carregando_camera').style.display='none'; // oculta gif
            alert(resultado); //Ja tras a resposta se deu certo ou nao!
           }
        });

        }
        else
        {
          document.getElementById('imagem_carregando_camera').style.display='none'; // oculta gif
          alert("Não é possivel realizar o ajuste no momento!");
        }
      }
      function comando_reiniciar_radio()
      {
        //Ativa imagem gif
        document.getElementById('imagem_carregando_radio').style.display='block';
        //alert("clicou NTP");
        var ip = document.getElementById('lb_ref_ip2').innerHTML; //Pega o ip do equipamento
        if(ip != "vazio")
        {//Pode ajustar
         //alert(ip);
         var porta = 8728;
         var v_ip = ip.split(".");
         v_ip = (v_ip[3]); //Pega a ultima divisao do ip para calcular a porta padrao
         //alert(porta);
         var ip_completo = (ip + ":" + porta).toString();
         //passo via ajax para realizar o ajuste
         
         $.ajax({
           url: 'script_reiniciar_radio.php',
           type: 'GET',
           dataType: 'html',
           data: {'ip': ip_completo, 'usuario':'bruno','senha':'268300' },
           success: function(resultado)
           {
            document.getElementById('imagem_carregando_radio').style.display='none'; // oculta gif
            alert(resultado); //Ja tras a resposta se deu certo ou nao!
           }
         });
        }
        else
        {
          document.getElementById('imagem_carregando_camera').style.display='none'; // oculta gif
          alert("Não é possivel realizar o ajuste no momento!");
        }
        
        
      }      


      function comando_habilita_grupos_radio()
      {
        //Ativa imagem gif
        document.getElementById('imagem_carregando_radio').style.display='block';
        var nome_tabela = document.getElementById('lb_ref_nome_tabela').innerHTML;

        //alert("clicou NTP");
        var ip = document.getElementById('lb_ref_ip2').innerHTML; //Pega o ip do equipamento
        if(ip != "vazio")
        {//Pode ajustar
         //alert(ip);
         var porta = 8728;
         var v_ip = ip.split(".");
         v_ip = (v_ip[3]); //Pega a ultima divisao do ip para calcular a porta padrao
         //alert(porta);
         var ip_completo = (ip + ":" + porta).toString();
         //passo via ajax para realizar o ajuste
         
         $.ajax({
           url: 'script_habilita_grupos_skin_radio.php',
           type: 'GET',
           dataType: 'html',
           data: {'ip': ip_completo, 'usuario':'bruno','senha':'268300','tabela': nome_tabela,'ip2': ip },
           success: function(resultado)
           {
            document.getElementById('imagem_carregando_radio').style.display='none'; // oculta gif
            if(resultado.includes("tudo_ok")==true)
            {
              alert("Ativado usuarios com sucesso!");
            }
            else if(resultado.includes("ja_cadastrado")==true)
            {
              alert("Função já habilitada para o equipamento!"); 
            }
            else
            {
              alert(resultado);
            }
            
           }
         });
        }
        else
        {
          document.getElementById('imagem_carregando_camera').style.display='none'; // oculta gif
          alert("Não é possivel realizar o ajuste no momento!");
        }
        
        
      }      









      function comando_habilita_radius_radio()
      {
        //Ativa imagem gif
        document.getElementById('imagem_carregando_radio').style.display='block';
        //alert("clicou NTP");
        var ip = document.getElementById('lb_ref_ip2').innerHTML; //Pega o ip do equipamento
        if(ip != "vazio")
        {//Pode ajustar
         //alert(ip);
         var porta = 8728;
         var v_ip = ip.split(".");
         v_ip = (v_ip[3]); //Pega a ultima divisao do ip para calcular a porta padrao
         //alert(porta);
         var ip_completo = (ip + ":" + porta).toString();
         //passo via ajax para realizar o ajuste
         
         $.ajax({
           url: 'script_habilita_radius_radio.php',
           type: 'GET',
           dataType: 'html',
           data: {'ip': ip_completo, 'usuario':'bruno','senha':'268300' },
           success: function(resultado)
           {
            document.getElementById('imagem_carregando_radio').style.display='none'; // oculta gif
            if(resultado.includes("tudo_ok")==true)
            {
              alert("Ativado RADIUS com sucesso!");
            }
            else
            {
              alert(resultado);
            }
            
           }
         });
        }
        else
        {
          document.getElementById('imagem_carregando_camera').style.display='none'; // oculta gif
          alert("Não é possivel realizar o ajuste no momento!");
        }
        
        
      }      


      function comando_primeiro_acesso_radio()
      {
        //Ativa imagem gif
        document.getElementById('imagem_carregando_radio').style.display='block';
        //alert("clicou NTP");
        var ip = document.getElementById('lb_ref_ip2').innerHTML; //Pega o ip do equipamento
        if(ip != "vazio")
        {//Pode ajustar
         //alert(ip);
         var porta = 8728;
         var v_ip = ip.split(".");
         v_ip = (v_ip[3]); //Pega a ultima divisao do ip para calcular a porta padrao
         //alert(porta);
         var ip_completo = (ip + ":" + porta).toString();
         //passo via ajax para realizar o ajuste
         
         $.ajax({
           url: 'script_primeiro_acesso_radio.php',
           type: 'GET',
           dataType: 'html',
           data: {'ip': ip_completo, 'usuario':'admin','senha':'logistica2019@@' },
           success: function(resultado)
           {
            document.getElementById('imagem_carregando_radio').style.display='none'; // oculta gif
            if(resultado.includes("tudo_ok")==true)
            {
              alert("Ativado primeiro acesso com sucesso!");
            }
            else
            {
              alert(resultado);
            }
            
           }
         });
        }
        else
        {
          document.getElementById('imagem_carregando_camera').style.display='none'; // oculta gif
          alert("Não é possivel realizar o ajuste no momento!");
        }
        
        
      }      


      function comando_buscar_uptime_radio()
      {
        //Ativa imagem gif
        document.getElementById('imagem_carregando_radio').style.display='block';
        //alert("clicou NTP");
        var ip = document.getElementById('lb_ref_ip2').innerHTML; //Pega o ip do equipamento
        if(ip != "vazio")
        {//Pode ajustar
         //alert(ip);
         var porta = 8728;
         var v_ip = ip.split(".");
         v_ip = (v_ip[3]); //Pega a ultima divisao do ip para calcular a porta padrao
         //alert(porta);
         var ip_completo = (ip + ":" + porta).toString();
         //passo via ajax para realizar o ajuste
         
         $.ajax({
           url: 'script_buscar_uptime_radio.php',
           type: 'GET',
           dataType: 'html',
           data: {'ip': ip_completo, 'usuario':'bruno','senha':'268300' },
           success: function(resultado)
           {
            document.getElementById('imagem_carregando_radio').style.display='none'; // oculta gif
            //alert(resultado); //Ja tras a resposta se deu certo ou nao!
            document.getElementById('lb_ref_uptime_radio').innerHTML = "&emsp;&emsp;&emsp;UPTIME = " + resultado + '&emsp;&emsp;&emsp;<input type="button" name="btn_radio_primeiro_acesso" id="btn_radio_primeiro_acesso" class="btn btn-success"  onclick="comando_primeiro_acesso_radio()" value="Primeiro Acesso!" ></label>';
           }
         });
        }
        else
        {
          document.getElementById('imagem_carregando_camera').style.display='none'; // oculta gif
          alert("Não é possivel realizar o ajuste no momento!");
        }
        
        
      }      

      function comando_buscar_versao_radio()
      {
        //Ativa imagem gif
        document.getElementById('imagem_carregando_radio').style.display='block';
        var nome_tabela = document.getElementById('lb_ref_nome_tabela').innerHTML;

        //alert("clicou NTP");
        var ip = document.getElementById('lb_ref_ip2').innerHTML; //Pega o ip do equipamento
        if(ip != "vazio")
        {//Pode ajustar
         //alert(ip);
         var porta = 8728;
         var v_ip = ip.split(".");
         v_ip = (v_ip[3]); //Pega a ultima divisao do ip para calcular a porta padrao
         //alert(porta);
         var ip_completo = (ip + ":" + porta).toString();
         //passo via ajax para realizar o ajuste
         // alert(nome_tabela);
         $.ajax({
           url: 'script_buscar_versao_radio.php',
           type: 'GET',
           dataType: 'html',
           data: {'ip': ip_completo, 'usuario':'bruno','senha':'268300','versao':'7.7','tabela': nome_tabela,'ip2': ip },
           success: function(resultado)
           {
            document.getElementById('imagem_carregando_radio').style.display='none'; // oculta gif
            //alert(resultado); //Ja tras a resposta se deu certo ou nao!
            document.getElementById('lb_ref_versao_radio').innerHTML = "Versão de firmware do equipamento = " + resultado;
           }
         });
        }
        else
        {
          document.getElementById('imagem_carregando_camera').style.display='none'; // oculta gif
          alert("Não é possivel realizar o ajuste no momento!");
        }
      }      

      function comando_habilita_ntp_radio()
      {
        //Ativa imagem gif
        document.getElementById('imagem_carregando_radio').style.display='block';
        //alert("clicou NTP");
        var ip = document.getElementById('lb_ref_ip2').innerHTML; //Pega o ip do equipamento
        if(ip != "vazio")
        {//Pode ajustar
         //alert(ip);
         var porta = 8728;
         var v_ip = ip.split(".");
         v_ip = (v_ip[3]); //Pega a ultima divisao do ip para calcular a porta padrao
         //alert(porta);
         var ip_completo = (ip + ":" + porta).toString();
         //passo via ajax para realizar o ajuste
         
         $.ajax({
           url: 'script_habilita_ntp_radio.php',
           type: 'GET',
           dataType: 'html',
           data: {'ip': ip_completo, 'usuario':'bruno','senha':'268300'},
           success: function(resultado)
           {
            if(resultado.includes("tudo_ok")==true)
            {
              alert("Ativado servidor NTP com sucesso!");
            }
            else
            {
              alert(resultado);
            }
            document.getElementById('imagem_carregando_radio').style.display='none'; // oculta gif
           }
         });
        }
        else
        {
          document.getElementById('imagem_carregando_camera').style.display='none'; // oculta gif
          alert("Não é possivel realizar o ajuste no momento!");
        }
      }      


















      function comando_buscar_nome_radio()
      {
        //Ativa imagem gif
        document.getElementById('imagem_carregando_radio').style.display='block';
        //alert("clicou NTP");
        var ip = document.getElementById('lb_ref_ip2').innerHTML; //Pega o ip do equipamento
        if(ip != "vazio")
        {//Pode ajustar
         //alert(ip);
         var porta = 8728;
         var v_ip = ip.split(".");
         v_ip = (v_ip[3]); //Pega a ultima divisao do ip para calcular a porta padrao
         //alert(porta);
         var ip_completo = (ip + ":" + porta).toString();
         //passo via ajax para realizar o ajuste
         
         $.ajax({
           url: 'script_buscar_nome_radio.php',
           type: 'GET',
           dataType: 'html',
           data: {'ip': ip_completo, 'usuario':'bruno','senha':'268300' },
           success: function(resultado)
           {
            document.getElementById('imagem_carregando_radio').style.display='none'; // oculta gif
            //alert(resultado); //Ja tras a resposta se deu certo ou nao!
            document.getElementById('lb_ref_nome_radio').innerHTML = "Nome do equipamento = " + resultado;
           }
         });
        }
        else
        {
          document.getElementById('imagem_carregando_camera').style.display='none'; // oculta gif
          alert("Não é possivel realizar o ajuste no momento!");
        }
        
        
      }      

      function comando_buscar_modelo_radio()
      {
        //Ativa imagem gif
        document.getElementById('imagem_carregando_radio').style.display='block';
        //alert("clicou NTP");
        var ip = document.getElementById('lb_ref_ip2').innerHTML; //Pega o ip do equipamento
        if(ip != "vazio")
        {//Pode ajustar
         //alert(ip);
         var porta = 8728;
         var v_ip = ip.split(".");
         v_ip = (v_ip[3]); //Pega a ultima divisao do ip para calcular a porta padrao
         //alert(porta);
         var ip_completo = (ip + ":" + porta).toString();
         //passo via ajax para realizar o ajuste
         
         $.ajax({
           url: 'script_buscar_modelo_radio.php',
           type: 'GET',
           dataType: 'html',
           data: {'ip': ip_completo, 'usuario':'bruno','senha':'268300' },
           success: function(resultado)
           {
            document.getElementById('imagem_carregando_radio').style.display='none'; // oculta gif
            var v = resultado.split(";");
            //alert(resultado); //Ja tras a resposta se deu certo ou nao!
            document.getElementById('lb_ref_modelo_radio').innerHTML = "Modelo do equipamento = " + v[0] + "&emsp;&emsp;&emsp;S/N = " + v[1];
           }
         });
        }
        else
        {
          document.getElementById('imagem_carregando_camera').style.display='none'; // oculta gif
          alert("Não é possivel realizar o ajuste no momento!");
        }
        
        
      }   

      function comando_buscar_nome_camera()
      {
        //Ativa gif
        document.getElementById('imagem_carregando_camera').style.display='block';
      
        //alert("clicou NTP");
        var ip = document.getElementById('lb_ref_ip2').innerHTML; //Pega o ip do equipamento
        if(ip != "vazio")
        {//Pode ajustar
         //alert(ip);
         var porta = 0;
         var v_ip = ip.split(".");
         v_ip = (v_ip[3]); //Pega a ultima divisao do ip para calcular a porta padrao
         if(v_ip <100)
         {
          porta = "80" + (v_ip).toString();
         }
         else
         {
          porta = "8" + (v_ip).toString();
         }
         //alert(porta);
         var ip_completo = (ip + ":" + porta).toString();
         //passo via ajax para realizar o ajuste
         $.ajax({
           url: 'script_buscar_nome_camera.php',
           type: 'GET',
           dataType: 'html',
           data: {'ip': ip_completo },
           success: function(resultado)
           {
            document.getElementById('imagem_carregando_camera').style.display='none'; // oculta gif
            if(resultado != "Erro dados!" && resultado != "Erro!")
            //alert(resultado); //responde com o nome da camera!
            document.getElementById('lb_ref_nome_camera').innerHTML = "Nome do equipamento = " + resultado;
           }
        });

        }
        else
        {
          document.getElementById('imagem_carregando_camera').style.display='none'; // oculta gif
          alert("Não é possivel realizar o ajuste no momento!");
        }
        

      }

      function comando_buscar_versao_camera()
      {
        //Ativa gif
        document.getElementById('imagem_carregando_camera').style.display='block'; 
        //alert("clicou NTP");
        var ip = document.getElementById('lb_ref_ip2').innerHTML; //Pega o ip do equipamento
        if(ip != "vazio")
        {//Pode ajustar
         //alert(ip);
         var porta = 0;
         var v_ip = ip.split(".");
         v_ip = (v_ip[3]); //Pega a ultima divisao do ip para calcular a porta padrao
         if(v_ip <100)
         {
          porta = "80" + (v_ip).toString();
         }
         else
         {
          porta = "8" + (v_ip).toString();
         }
         //alert(porta);
         var ip_completo = (ip + ":" + porta).toString();
         //passo via ajax para realizar o ajuste
         $.ajax({
           url: 'script_buscar_versao_camera.php',
           type: 'GET',
           dataType: 'html',
           data: {'ip': ip_completo },
           success: function(resultado)
           {
            document.getElementById('imagem_carregando_camera').style.display='none'; // oculta gif
            if(resultado != "Erro dados!" && resultado != "Erro!")
            //alert(resultado); //responde com o nome da camera!
            document.getElementById('lb_ref_versao_camera').innerHTML = "Versão de firmware do equipamento = " + resultado;
           }
        });

        }
        else
        {
          document.getElementById('imagem_carregando_camera').style.display='none'; // oculta gif
          alert("Não é possivel realizar o ajuste no momento!");
        }
        

      }

      function comando_buscar_modelo_camera()
      {
        //Ativa gif
        document.getElementById('imagem_carregando_camera').style.display='block';
        //alert("clicou NTP");
        var ip = document.getElementById('lb_ref_ip2').innerHTML; //Pega o ip do equipamento
        if(ip != "vazio")
        {//Pode ajustar
         //alert(ip);
         var porta = 0;
         var v_ip = ip.split(".");
         v_ip = (v_ip[3]); //Pega a ultima divisao do ip para calcular a porta padrao
         if(v_ip <100)
         {
          porta = "80" + (v_ip).toString();
         }
         else
         {
          porta = "8" + (v_ip).toString();
         }
         //alert(porta);
         var ip_completo = (ip + ":" + porta).toString();
         //passo via ajax para realizar o ajuste
         $.ajax({
           url: 'script_buscar_modelo_camera.php',
           type: 'GET',
           dataType: 'html',
           data: {'ip': ip_completo },
           success: function(resultado)
           {
            document.getElementById('imagem_carregando_camera').style.display='none'; // oculta gif
            if(resultado != "Erro dados!" && resultado != "Erro!")
            //alert(resultado); //responde com o nome da camera!
            document.getElementById('lb_ref_modelo_camera').innerHTML = "Modelo do equipamento = " + resultado;
           }
        });

        }
        else
        {
          document.getElementById('imagem_carregando_camera').style.display='none'; // oculta gif
          alert("Não é possivel realizar o ajuste no momento!");
        }

      }






      function ordem_nome_a_z()
      {
        var ordem = document.getElementById('lb_ref_ordem');
        ordem.innerHTML = "nome_a_z";
        Filtrar();
      }
      function ordem_usados()
      {
        var ordem = document.getElementById('lb_ref_ordem');
        ordem.innerHTML = "usados";
        Filtrar();
      }


      function ordem_nome_z_a()
      {
        var ordem = document.getElementById('lb_ref_ordem');
        ordem.innerHTML = "nome_z_a";
        Filtrar();
      }

      function ordem_ip_um_a_dez()
      {
        var ordem = document.getElementById('lb_ref_ordem');
        ordem.innerHTML = "ip_um_a_dez";
        Filtrar();
      }
      function ordem_ip_dez_a_um()
      {
        var ordem = document.getElementById('lb_ref_ordem');
        ordem.innerHTML = "ip_dez_a_um";
        Filtrar();
      }


      function ordem_online()
      {
        var v_status = document.getElementById('lb_ref_status');
        v_status.innerHTML = "Online";
        Filtrar();
      }
      function ordem_offline()
      {
        var v_status = document.getElementById('lb_ref_status');
        v_status.innerHTML = "Offline";
        Filtrar();
      }
      function ordem_bloqueado()
      {
        var v_status = document.getElementById('lb_ref_status');
        v_status.innerHTML = "Bloqueado";
        Filtrar();
      }
      function ordem_todos()
      {
        var v_status = document.getElementById('lb_ref_status');
        v_status.innerHTML = "Todos";
        Filtrar();
      }


      function comando_salvar()
      {
        //alert('salvar');
         
        //Dados para referencia da tabela e qual ID alterar
         var id =  document.getElementById('txt_dados_id').value;
         var nome_tabela = document.getElementById('lb_ref_nome_tabela').innerHTML;

         //Dados dos campos a alterar
         var status = document.getElementById('lb_dados_status').innerHTML ;
         //Trato o valor staus pois vem escrito Ex = Condicao : Offline
         var  vmsg = status.split(':'); // Separo no :
         status = vmsg[1].trim(); // Pego o status e dou trim para retirar o espaco ficando apenas o status puro ( "Online", "Offline" ou "Bloqueado")
         var nome = document.getElementById('txt_dados_nome').value;
         var gateway = document.getElementById('txt_dados_gateway').value;
         var mascara = document.getElementById('txt_dados_mascara').value;
         var informacao_adicional = document.getElementById('text_area_informacao').value;
         var usuario = document.getElementById('txt_dados_usuario').value;
         var senha = document.getElementById('txt_dados_senha').value;
         var editado_por = colaborador; //Busca o usuario logado
         var ativo = '';
         var x = document.getElementById("radio_ativo_sim");
          if(x.checked == true)
          {
            ativo = 'Sim';
          }
          else
          {
            ativo = 'Não';
          }
          //alert("Ativo = " + ativo + "\nStatus = " + status);      
          var modelo = document.getElementById('select_dados_modelo').value;
          var tipo = document.getElementById('select_dados_tipo').value;

         //Busco a data e hora para validar o horario da alteração
         <?php
         date_default_timezone_set('America/Sao_Paulo');
         $v_data = date('d/m/Y');
         $v_hora = date('H:i:s');
         ?>
         
         var data = '<?php print $v_data ?>';
         var hora = '<?php print $v_hora ?>';
         
         //Agora passo via ajax para efetuar o salvamento dos dados!
         $.ajax({
           url: 'tela_salvar_edicao_rede.php',
           type: 'GET',
           dataType: 'html',
           data: {'id': id,'tabela':nome_tabela,'nome':nome,'gateway':gateway,'mascara':mascara,'informacao':informacao_adicional,'usuario':usuario,'senha':senha,'editado_por':editado_por,'ativo':ativo,'status':status ,'data':data,'hora':hora,'modelo':modelo,'tipo':tipo },
           success: function(resultado)
           {
            if(resultado =='ok')
            {
             //alert("Atenção " + colaborador + "\nDados alterados com sucesso!");   
            }
            else
            {
             alert('Falha ao tentar alterar os dados, por favor, tente novamente!');   
            }
           }
        });

         // ********************************************************

         //Agora fecho os dados e volto a reexibir a tabela
         document.getElementById('tabela').style.display='block';
         document.getElementById('div_dados').style.display='none';

         //Agora atualiza clicando novamente
         //var referencia = document.getElementById('titulo_ponto').innerHTML;
         //valida_rede(referencia); //Passo o nome clicado
         var link_btn_filtrar = document.getElementById('btn_filtrar');
         link_btn_filtrar.click();
      }
      function Filtrar()
      {

       var link_modelo = document.getElementById('select_dados_modelo2').value;
       var link_tipo = document.getElementById('select_dados_tipo2').value;
       var link_nome_tabela = document.getElementById('lb_ref_nome_tabela').innerHTML; 
       var link_ordem = document.getElementById('lb_ref_ordem').innerHTML; 
       var link_status = document.getElementById('lb_ref_status').innerHTML; 
       
       if(link_ordem == "")
       {
        link_ordem = "ip_a_z";

       }
       if(link_status == "")
       {
        link_status = "Todos";
       }


       //alert(link_status);
       if (link_nome_tabela == "rede_cento_sessenta_dez_xx")
       {
         ponto = "Rede 192.160.10.XX";  
       }
       else if (link_nome_tabela == "rede_cento_sessenta_vinte_xx")
       {
         ponto = "Rede 192.160.20.XX";  
       }
       else if (link_nome_tabela == "rede_cento_sessenta_trinta_xx")
       {
         ponto = "Rede 192.160.30.XX";  
       }       
       else if (link_nome_tabela == "rede_cento_sessenta_quarenta_xx")
       {
         ponto = "Rede 192.160.40.XX";  
       }       
       else if (link_nome_tabela == "rede_cento_sessenta_um_dez_xx")
       {
         ponto = "Rede 192.161.10.XX";  
       }       
       else if (link_nome_tabela == "rede_cento_sessenta_um_vinte_xx")
       {
         ponto = "Rede 192.161.20.XX";  
       }              
       else if (link_nome_tabela == "rede_cento_sessenta_um_trinta_xx")
       {
         ponto = "Rede 192.161.30.XX";  
       }              
       else if (link_nome_tabela == "rede_cento_sessenta_um_quarenta_xx")
       {
         ponto = "Rede 192.161.40.XX";  
       }              
       else if (link_nome_tabela == "rede_cento_sessenta_dois_dez_xx")
       {
         ponto = "Rede 192.162.10.XX";  
       }       
       else if (link_nome_tabela == "rede_cento_sessenta_dois_vinte_xx")
       {
         ponto = "Rede 192.162.20.XX";  
       }       
       else if (link_nome_tabela == "rede_cento_sessenta_dois_trinta_xx")
       {
         ponto = "Rede 192.162.30.XX";  
       }       
       else if (link_nome_tabela == "rede_cento_sessenta_dois_quarenta_xx")
       {
         ponto = "Rede 192.162.40.XX";  
       }       
       else if (link_nome_tabela == "rede_dez_xx")
       {
         ponto = "Rede 192.168.10.XX";  
       }
       else if (link_nome_tabela == "rede_onze_xx")
       {
         ponto = "Rede 192.168.11.XX";  
       }
       else if (link_nome_tabela == "rede_doze_xx")
       {
         ponto = "Rede 192.168.12.XX";  
       }       
       else if (link_nome_tabela == "rede_vinte_xx")
       {
         ponto = "Rede 192.168.20.XX";
       }
       else if (link_nome_tabela == "rede_trinta_xx")
       {
         ponto = "Rede 192.168.30.XX";
       }
       else if (link_nome_tabela == "rede_quarenta_xx")
       {
         ponto = "Rede 192.168.40.XX";
       }
       else if (link_nome_tabela == "rede_dez_cem_vinte_e_tres_xx")
       {
         ponto = "Rede 10.100.23.XX";  
       }       
       else if (link_nome_tabela == "rede_acessos_xx")
       {
         ponto = "Rede Acessos";
       }
       else if (link_nome_tabela == "gerdau_utmi_balanca_um")
       {
         ponto = "Rede GERDAU UTMI - Balanca 1";
       }
       else if (link_nome_tabela == "gerdau_utmi_balanca_dois")
       {
         ponto = "Rede GERDAU UTMI - Balanca 2";
       }        
       else if (link_nome_tabela == "gerdau_utmi_amostragem")
       {
         ponto = "Rede GERDAU UTMI - Amostragem";
       }                
       else if (link_nome_tabela == "gerdau_utmi_escritorio")
       {
         ponto = "Rede GERDAU UTMI - Escritorio";
       }        
       else if (link_nome_tabela == "gerdau_vl_balanca_dois")
       {
         ponto = "Rede GERDAU VL - Balanca 2";
       }        
       else if (link_nome_tabela == "gerdau_vl_balanca_tres")
       {
         ponto = "Rede GERDAU VL - Balanca 3";
       }        
       else if (link_nome_tabela == "gerdau_vl_balanca_cinco")
       {
         ponto = "Rede GERDAU VL - Balanca 5";
       }        
       else if (link_nome_tabela == "gerdau_vl_ca_um")
       {
         ponto = "Rede GERDAU VL - Controle de Acesso 1";
       }        
       else if (link_nome_tabela == "gerdau_vl_ca_dois")
       {
         ponto = "Rede GERDAU VL - Controle de Acesso 2";
       }        
       else if (link_nome_tabela == "gerdau_vl_ca_tres")
       {
         ponto = "Rede GERDAU VL - Controle de Acesso 3";
       }        
       else if (link_nome_tabela == "gerdau_vl_ccl")
       {
         ponto = "Rede GERDAU VL - CCL";
       }                
       else if (link_nome_tabela == "gerdau_vl_k_house")
       {
         ponto = "Rede GERDAU VL - K-House";
       }        
       else if (link_nome_tabela == "gerdau_vln_balanca")
       {
         ponto = "Rede GERDAU VLN - Balanca";
       }        
       else if (link_nome_tabela == "gerdau_vln_escritorio")
       {
         ponto = "Rede GERDAU VLN - Escritorio";
       }        
       else if (link_nome_tabela == "gerdau_patrag_balanca")
       {
         ponto = "Rede GERDAU PATRAG - Balanca";
       }        
       else if (link_nome_tabela == "gerdau_uob_noroeste")
       {
         ponto = "Rede GERDAU Usina - Noroeste";
       }        
       else if (link_nome_tabela == "gerdau_uob_p_seis")
       {
         ponto = "Rede GERDAU Usina - P6";
       }         

       




       console.log("Nome da tabela filtrar = " + link_nome_tabela + "  - Ponto = " + ponto + "  - Ordem = " + link_ordem);
       valida_rede(ponto + ',' + link_modelo + ',' + link_tipo + ',' + link_ordem + ','+ link_status);
      }
      
      function Limpar()
      {
       document.getElementById('select_dados_modelo2').value = "Todos";
       document.getElementById('select_dados_tipo2').value = "Todos";
       var link_modelo = document.getElementById('select_dados_modelo2').value;
       var link_tipo = document.getElementById('select_dados_tipo2').value;
       var link_nome_tabela = document.getElementById('lb_ref_nome_tabela').innerHTML; 
       var link_ordem = document.getElementById('lb_ref_ordem').innerHTML; 
       var link_status = document.getElementById('lb_ref_status').innerHTML; 
       link_status.innerHTML = "Todos"; // Para atualizar na lb
       link_status = "Todos"; // para atualizar na passagem de parametro

       if (link_nome_tabela == "rede_dez_xx")
       {
         ponto = "Rede 192.168.10.XX";  
       }
       else if (link_nome_tabela == "rede_onze_xx")
       {
         ponto = "Rede 192.168.11.XX";  
       }
       else if (link_nome_tabela == "rede_doze_xx")
       {
         ponto = "Rede 192.168.12.XX";  
       }       
       else if (link_nome_tabela == "rede_vinte_xx")
       {
         ponto = "Rede 192.168.20.XX";
       }
       else if (link_nome_tabela == "rede_trinta_xx")
       {
         ponto = "Rede 192.168.30.XX";
       }
       else if (link_nome_tabela == "rede_quarenta_xx")
       {
         ponto = "Rede 192.168.40.XX";
       }
       else if (link_nome_tabela == "rede_dez_cem_vinte_e_tres_xx")
       {
         ponto = "Rede 10.100.23.XX";
       }       
       else if (link_nome_tabela == "rede_acessos_xx")
       {
         ponto = "Rede Acessos";
       }       
       else if (link_nome_tabela == "gerdau_utmi_balanca_um")
       {
         ponto = "Rede GERDAU UTMI - Balanca 1";
       }
       else if (link_nome_tabela == "gerdau_utmi_balanca_dois")
       {
         ponto = "Rede GERDAU UTMI - Balanca 2";
       }        
       else if (link_nome_tabela == "gerdau_utmi_amostragem")
       {
         ponto = "Rede GERDAU UTMI - Amostragem";
       }                
       else if (link_nome_tabela == "gerdau_utmi_escritorio")
       {
         ponto = "Rede GERDAU UTMI - Escritorio";
       }        
       else if (link_nome_tabela == "gerdau_vl_balanca_dois")
       {
         ponto = "Rede GERDAU VL - Balanca 2";
       }        
       else if (link_nome_tabela == "gerdau_vl_balanca_tres")
       {
         ponto = "Rede GERDAU VL - Balanca 3";
       }        
       else if (link_nome_tabela == "gerdau_vl_balanca_cinco")
       {
         ponto = "Rede GERDAU VL - Balanca 5";
       }        
       else if (link_nome_tabela == "gerdau_vl_ca_um")
       {
         ponto = "Rede GERDAU VL - Controle de Acesso 1";
       }        
       else if (link_nome_tabela == "gerdau_vl_ca_dois")
       {
         ponto = "Rede GERDAU VL - Controle de Acesso 2";
       }        
       else if (link_nome_tabela == "gerdau_vl_ca_tres")
       {
         ponto = "Rede GERDAU VL - Controle de Acesso 3";
       }        
       else if (link_nome_tabela == "gerdau_vl_ccl")
       {
         ponto = "Rede GERDAU VL - CCL";
       }                
       else if (link_nome_tabela == "gerdau_vl_k_house")
       {
         ponto = "Rede GERDAU VL - K-House";
       }        
       else if (link_nome_tabela == "gerdau_vln_balanca")
       {
         ponto = "Rede GERDAU VLN - Balanca";
       }        
       else if (link_nome_tabela == "gerdau_vln_escritorio")
       {
         ponto = "Rede GERDAU VLN - Escritorio";
       }        
       else if (link_nome_tabela == "gerdau_patrag_balanca")
       {
         ponto = "Rede GERDAU PATRAG - Balanca";
       }        
       else if (link_nome_tabela == "gerdau_uob_noroeste")
       {
         ponto = "Rede GERDAU Usina - Noroeste";
       }        
       else if (link_nome_tabela == "gerdau_uob_p_seis")
       {
         ponto = "Rede GERDAU Usina - P6";
       }         

       




       console.log("Nome da tabela filtrar = " + link_nome_tabela + "  - Ponto = " + ponto);
       valida_rede(ponto + ',' + link_modelo + ',' + link_tipo + ',' + link_ordem + ',' + link_status);
        
      }

      function comando_sair()
      {
        //Agora fecho os dados e volto a reexibir a tabela
        document.getElementById('tabela').style.display='block';
        document.getElementById('div_dados').style.display='none';
        
      }
      function comando_sair_camera()
      {
        //Agora fecho os dados e volto a reexibir a tabela
        document.getElementById('tabela').style.display='block';
        document.getElementById('div_camera').style.display='none';
        document.getElementById('lb_filtro').style.display='block';
        document.getElementById('filtro').style.display='block';
        document.getElementById('imagem_carregando_camera').style.display='none'; // oculta gif
        document.getElementById('div_dados').style.display='none';
      }

      function comando_sair_radio()
      {
        //Agora fecho os dados e volto a reexibir a tabela
        document.getElementById('tabela').style.display='block';
        document.getElementById('div_radio').style.display='none';
        document.getElementById('lb_filtro').style.display='block';
        document.getElementById('filtro').style.display='block';
        document.getElementById('imagem_carregando_camera').style.display='none'; // oculta gif
        document.getElementById('div_dados').style.display='none';
        //habilita o botao
        document.getElementById('btn_radio_radius').value="Habilitar RADIUS";
        document.getElementById('btn_radio_radius').disabled=false;
        document.getElementById('btn_radio_primeiro_acesso').disabled=false;
      }



      function comando_disponibilizar()
      {
        //alert('disponibilizar');
        //Dados para referencia da tabela e qual ID alterar
        var id =  document.getElementById('txt_dados_id').value;
        var nome_tabela = document.getElementById('lb_ref_nome_tabela').innerHTML;

         //Dados dos campos a alterar
         var nome = "IP disponivel para utlização";
         var gateway = "-";
         var mascara ="255.255.255.0";
         var informacao_adicional = "Sem dados complementares";
         var usuario = "admin";
         var senha = "admin";
         var editado_por = colaborador; //Busca o usuario logado
         var ativo = 'Não';
         var disponivel = "Sim";
         var modelo = "N/A";
         var tipo = "N/A";
         

         //Busco a data e hora para validar o horario da alteração
         <?php
         date_default_timezone_set('America/Sao_Paulo');
         $v_data = date('d/m/Y');
         $v_hora = date('H:i:s');
         ?>
         
         var data = '<?php print $v_data ?>';
         var hora = '<?php print $v_hora ?>';
         
         //Agora passo via ajax para efetuar o salvamento dos dados!
         $.ajax({
           url: 'tela_disponibilizar_ip.php',
           type: 'GET',
           dataType: 'html',
           data: {'id': id,'tabela':nome_tabela,'nome':nome,'gateway':gateway,'mascara':mascara,'informacao':informacao_adicional,'usuario':usuario,'senha':senha,'editado_por':editado_por,'ativo':ativo,'disponivel':disponivel,'data':data,'hora':hora,'modelo':modelo,'tipo':tipo },
           success: function(resultado)
           {
            if(resultado =='ok')
            {
             //alert("Atenção " + colaborador + "\nDados alterados com sucesso!");   
            }
            else
            {
             alert('Falha ao tentar alterar os dados, por favor, tente novamente!');   
            }
           }
        });

         // ********************************************************

         //Agora fecho os dados e volto a reexibir a tabela
         document.getElementById('tabela').style.display='block';
         document.getElementById('div_dados').style.display='none';

         //Agora atualiza clicando novamente
         //var referencia = document.getElementById('titulo_ponto').innerHTML;
         //valida_rede(referencia); //Passo o nome clicado
         var link_btn_filtrar = document.getElementById('btn_filtrar');
         link_btn_filtrar.click();


      }



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
     

      function valida_rede(ponto) // Para validar os pontos de rede
      {
        //Habilito exibir fluxo rede
        document.getElementById('lb_filtro').style.display='block';
        document.getElementById('filtro').style.display='block';
        document.getElementById('titulo_ponto').style.display='block';
        document.getElementById('descricao1').style.display='block';
        document.getElementById('lb_equipamentos').style.display='block';
        document.getElementById('div_gestao').style.display='none';
        document.getElementById('div_dashboard').style.display='none';
        document.getElementById('div_camera').style.display='none';
        document.getElementById('div_radio').style.display='none';

        
        mensagem = ponto.split(',');
        ponto = mensagem[0];
        modelo = mensagem[1];
        tipo = mensagem[2];
        ordem = mensagem[3];
        status = mensagem[4];
        
        
        console.log("Valida_rede = " + ponto + ","+modelo+","+tipo+","+ordem+","+status);
        
        document.getElementById('exibir_fotos').style.display='none';
        document.getElementById('imagem_caminho_foto1').style.display='none';
        document.getElementById('imagem_caminho_foto2').style.display='none';
        document.getElementById('imagem_caminho_foto3').style.display='none';
        document.getElementById('lb_desenho').style.display='none';
        document.getElementById('btn_download').style.display='none';
        document.getElementById('btn_mapa_rede').style.display='none';
        document.getElementById('tabela').style.display='block';
        document.getElementById('div_dados').style.display='none';

        document.getElementById('col1').innerHTML = "Nome de Rede <img id='img_ordem_nome_a_z' src='./images/a_z.png' onclick='ordem_nome_a_z()'/>  <img id='img_ordem_nome_z_a' src='./images/z_a.png' onclick='ordem_nome_z_a()'/> <img id='img_ordem_usados' src='./images/usados.png' onclick='ordem_usados()'/> ";
        document.getElementById('col2').innerHTML = "IP<img id='img_ordem_ip_um_a_dez' src='./images/um_a_dez.png' onclick='ordem_ip_um_a_dez()'/>  <img id='img_ordem_ip_dez_a_um' src='./images/dez_a_um.png' onclick='ordem_ip_dez_a_um()'/> ";
        document.getElementById('col3').innerHTML = "Modelo";
        document.getElementById('col4').innerHTML = "Tipo";
        document.getElementById('col5').innerHTML = "Condição</BR> <img id='img_ordem_online' src='./images/online.png' onclick='ordem_online()'/> <img id='img_ordem_offline' src='./images/offline.png' onclick='ordem_offline()'/> <img id='img_ordem_bloqueado' src='./images/bloqueado.png' onclick='ordem_bloqueado()'/><img id='img_ordem_todos' src='./images/ttt.png' onclick='ordem_todos()'/>               ";
        document.getElementById('col6').innerHTML = "Ultima Edição";

        var tabela = "";
        //alert(ponto);
        if (ponto == "Rede 192.160.10.XX")
        {
          tabela = "rede_cento_sessenta_dez_xx";  
        }
        else if (ponto == "Rede 192.160.20.XX")
        {
          tabela = "rede_cento_sessenta_vinte_xx";  
        }
        else if (ponto == "Rede 192.160.30.XX")
        {
          tabela = "rede_cento_sessenta_trinta_xx";  
        }
        else if (ponto == "Rede 192.160.40.XX")
        {
          tabela = "rede_cento_sessenta_quarenta_xx";  
        }

        else if (ponto == "Rede 192.161.10.XX")
        {
          tabela = "rede_cento_sessenta_um_dez_xx";  
        }
        else if (ponto == "Rede 192.161.20.XX")
        {
          tabela = "rede_cento_sessenta_um_vinte_xx";  
        }
        else if (ponto == "Rede 192.161.30.XX")
        {
          tabela = "rede_cento_sessenta_um_trinta_xx";  
        }
        else if (ponto == "Rede 192.161.40.XX")
        {
          tabela = "rede_cento_sessenta_um_quarenta_xx";  
        }

        else if (ponto == "Rede 192.162.10.XX")
        {
          tabela = "rede_cento_sessenta_dois_dez_xx";  
        }
        else if (ponto == "Rede 192.162.20.XX")
        {
          tabela = "rede_cento_sessenta_dois_vinte_xx";  
        }
        else if (ponto == "Rede 192.162.30.XX")
        {
          tabela = "rede_cento_sessenta_dois_trinta_xx";  
        }
        else if (ponto == "Rede 192.162.40.XX")
        {
          tabela = "rede_cento_sessenta_dois_quarenta_xx";  
        }

        else if (ponto == "Rede 192.168.10.XX")
        {
          tabela = "rede_dez_xx";  
        }
        else if (ponto == "Rede 192.168.11.XX")
        {
          tabela = "rede_onze_xx";  
        }
        else if (ponto == "Rede 192.168.12.XX")
        {
          tabela = "rede_doze_xx";  
        }        
        else if (ponto == "Rede 192.168.20.XX")
        {
          tabela = "rede_vinte_xx";
        }
        else if (ponto == "Rede 192.168.30.XX")
        {
          tabela = "rede_trinta_xx";
        }
        else if (ponto == "Rede 192.168.40.XX")
        {
          tabela = "rede_quarenta_xx";
        }
        else if (ponto == "Rede 10.100.23.XX")
        {
          tabela = "rede_dez_cem_vinte_e_tres_xx";
        }        
        else if (ponto == "Rede Acessos")
        {
          tabela = "rede_acessos_xx";
        }        
        else if (ponto == "Rede GERDAU UTMI - Balanca 1")
        {
          tabela = "gerdau_utmi_balanca_um";
        }
        else if (ponto == "Rede GERDAU UTMI - Balanca 2")
        {
          tabela = "gerdau_utmi_balanca_dois";
        }        
        else if (ponto == "Rede GERDAU UTMI - Amostragem")
        {
          tabela = "gerdau_utmi_amostragem";
        }                
        else if (ponto == "Rede GERDAU UTMI - Escritorio")
        {
          tabela = "gerdau_utmi_escritorio";
        }        
        else if (ponto == "Rede GERDAU VL - Balanca 2")
        {
          tabela = "gerdau_vl_balanca_dois";
        }        
        else if (ponto == "Rede GERDAU VL - Balanca 3")
        {
          tabela = "gerdau_vl_balanca_tres";
        }        
        else if (ponto == "Rede GERDAU VL - Balanca 5")
        {
          tabela = "gerdau_vl_balanca_cinco";
        }        
        else if (ponto == "Rede GERDAU VL - Controle de Acesso 1")
        {
          tabela = "gerdau_vl_ca_um";
        }        
        else if (ponto == "Rede GERDAU VL - Controle de Acesso 2")
        {
          tabela = "gerdau_vl_ca_dois";
        }        
        else if (ponto == "Rede GERDAU VL - Controle de Acesso 3")
        {
          tabela = "gerdau_vl_ca_tres";
        }        
        else if (ponto == "Rede GERDAU VL - CCL")
        {
          tabela = "gerdau_vl_ccl";
        }                
        else if (ponto == "Rede GERDAU VL - K-House")
        {
          tabela = "gerdau_vl_k_house";
        }        
        else if (ponto == "Rede GERDAU VLN - Balanca")
        {
          tabela = "gerdau_vln_balanca";
        }        
        else if (ponto == "Rede GERDAU VLN - Escritorio")
        {
          tabela = "gerdau_vln_escritorio";
        }        
        else if (ponto == "Rede GERDAU PATRAG - Balanca")
        {
          tabela = "gerdau_patrag_balanca";
        }        
        else if (ponto == "Rede GERDAU Usina - Noroeste")
        {
          tabela = "gerdau_uob_noroeste";
        }        
        else if (ponto == "Rede GERDAU Usina - P6")
        {
          tabela = "gerdau_uob_p_seis";
        }        





        else
        {
            tabela = "teste";
        }
        // alert(tabela)
        document.getElementById('lb_ref_nome_tabela').innerHTML = tabela;
        
        var caminho_foto3 = "";
        
        $.ajax({
           url: 'tela_consulta_pontos.php',
           type: 'GET',
           dataType: 'json',
           data: {'ponto': ponto},
           success: function(resultado)
           {
            //console.log(resultado);
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
         console.log("");
         console.log("");
         console.log("Nome da tabela = " + tabela);
         console.log("Tipo = " + tipo);
         console.log("Modelo = " + modelo);
         console.log("Ordem = " + ordem);
         console.log("Status = " + status);
         

         console.log("");
         console.log("");

         $.ajax({
           url: 'tela_consulta_pontos_rede.php',
           type: 'GET',
           dataType: 'json',
           data: {'tabela': tabela, 'tipo':tipo , 'modelo': modelo ,'ordem': ordem , 'vstatus': status},
           success: function(resultado)
           {
            //console.log(resultado);
            //Deleto todos elementos da tabela
            var quantidade = parseInt(document.getElementById('v_encontrados').innerHTML);
            // alert(quantidade);


            var quantidade_online = 0;
            var quantidade_offline = 0;
            var quantidade_bloqueado = 0;
            console.log ( "Quantidade = " + quantidade);
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
            
            var quantidade_usado = 0;

            for (var i = 1; i <= encontrado; i++) 
            {
             var msg = myArr2[i].split(','); 
             var id = msg[0];
             var nome = msg[1];
             var ip = msg[2];
             var gateway = msg[3];
             var mascara = msg[4];
             var modelo = msg[5];
             var tipo = msg[6];
             var informacao_adicional = msg[7];
             var ativo = msg[8];
             var status = msg[9];
             var usuario = msg[10];
             var senha = msg[11];
             var disponivel = msg[12];
             if(disponivel =="Não"){quantidade_usado = quantidade_usado +1;}
             var editado_por = msg[13];
             var data = msg[14];
             var hora = msg[15];
             var comando_especial = msg[16];
             var versao = msg[17];
             var radius = msg[18];
             var files = msg[19];

             if (id == 2)
             {
              console.log(id);
              console.log(nome);
              console.log(ip);
              console.log(gateway);
              console.log(mascara);
              console.log(modelo);
              console.log(tipo);
              console.log(informacao_adicional);
              console.log(ativo);
              console.log(status);
              console.log(usuario);
              console.log (senha);
              console.log (disponivel);
              console.log (editado_por);
              console.log (data);
              console.log (hora);
              console.log(comando_especial);
              console.log(versao);
              console.log(radius);
              console.log(files);
              console.log("");console.log("***********************************");console.log("");
             }
                        
          

             //Agora monto a tabela
             var linha = "<tr id='linhas_tabela'>";
                 if(status == "Online")
                 {
                    
                    linha += "<td  onclick=equipamento("+id+")> <img id=equipamento"+id+" src='./images/online.png' class='online'/>" ;
                 }
                 else if(status == "Offline")
                 {
                    linha += "<td onclick='equipamento("+id+")'> <img id=equipamento"+id+" src='./images/offline.png' class='offline'/>"  ;
                 }
                 else if(status == "Bloqueado")
                 {
                    linha += "<td onclick='equipamento("+id+")'> <img id=equipamento"+id+" src='./images/bloqueado.png' class='bloqueado'/>"  ;
                 }                 
                 else
                 {
                    linha += "<td onclick='equipamento("+id+")'> <img id=equipamento"+id+" src='./images/offline.png' class='offline'/>" ;
                 }
                  
                                                 
                 if( (tipo == "Câmera" || tipo == "PTZ" ||tipo == "NVR")  && status == "Online")
                  {
                    //Permite configuracoes para a camera
                    linha += "<img id=configuracoes src='./images/configuracao.png' class='configuracao' onclick='funcao_camera("+id+")' />" + nome ;
                  }
                  else if((tipo == "Switch Gerenciavel" || tipo == "SXT" || tipo == "Groove") && status == "Online")
                  {
                    
                    linha += "<img id=configuracoes src='./images/configuracao.png' class='configuracao' onclick='funcao_radio("+id+")'  />" + nome  ;
                  }
                  else
                  {
                    linha += nome;
                  }

                  
               


                 if(nome == "IP disponivel para utlização")
                 {
                    linha += "&nbsp;&nbsp;&nbsp;&nbsp;<a name='"+nome+"' id=id"+ id +" href=#"+ nome + " class='btn btn-primary' onclick='adicionar("+id+")'   >Cadastrar IP</a></td>"; 
                 }
                 else
                 {



                  if((tipo == "Switch Gerenciavel" || tipo == "SXT" || tipo == "Groove") && status == "Online")
                  {
                     
                    if(versao != "vazio")
                    {
                      if(parseFloat(versao).toFixed(1)>=7.7)
                      {
                        // Versao esta ok!
                        versao = "OK";
                      }
                      else
                      {
                        linha += "</BR>Versão: " + parseFloat(versao).toFixed(1) + " - Atualizar! &nbsp;&nbsp;  ";
                      }
                        
                    }
                    else
                    {
                      //Nao tem informacao no banco, necessario solicitar
                      linha += "</BR>Versão: ??&nbsp;&nbsp;";
                    }




                    if(radius == "Sim")
                    {
                      //linha += "&nbspRADIUS: OK";
                      radius = 'OK';
                    }
                    else
                    {
                      linha += "&nbspRADIUS: Pendente&nbsp;&nbsp;";
                    }

                    

                    if(files == "Sim")
                    {
                      files = "OK";
                    }
                    else
                    {
                      if (ip == "192.168.10.01" || ip == "192.168.20.01" || ip == "192.168.30.01" || ip == "192.168.40.01")
                      {
                        files = "OK"; //Considero OK pq nao terao acesso!
                      }
                      else
                      {
                       linha += "</BR>Pendente Skins&nbsp;&nbsp;";
                      }
                    }


                    if(versao == "OK" && radius == "OK" && files == "OK")
                    {
                      linha +="</BR> >>>>>>> Tudo OK!";
                    }
                      linha +="</td>"; 

                    } //fecha if((tipo == "Switch Gerenciavel" || tipo == "SXT" || tipo == "Groove"))
                  
                 }

                 if(disponivel =="Não")
                 {
                    linha += "<td  onclick=equipamento("+id+")><img id=equipamento"+ip+" src='./images/editar.png' class='editar'  onclick=comando_editar('"+id+"')  /> " + ip + "</td>";
                 }
                 else //IP Vago!
                 {
                    linha += "<td >" + ip + "</td>";
                 
                 }
                 linha += "<td >" + modelo + "</td>";
                 linha += "<td >" + tipo + "</td>";
                 linha += "<td >" + status + "</td>";
                 linha += "<td >" + editado_por + "</td>";
                 linha += '</tr>';

                 $("#tabela_equipamentos").append(linha); //Adiciona os elementos a tabela via jQuery
                 
                
            }
            //Acabei o for, agora atualizo os dados
            var link_titulo = document.getElementById('lb_equipamentos').innerHTML = "Dispostivos nessa rede: &nbsp;&nbsp;" + quantidade_usado  + "&emsp;&emsp; " + "Quantidade IPs disponíveis: " + (parseInt(encontrado)- parseInt(quantidade_usado));
            
            
           
           }
         });
      } // Fecha function valida_rede *******************************************************      


         function funcao_camera(comando)
         {
          var id = comando;
          var nome_tabela = document.getElementById('lb_ref_nome_tabela').innerHTML;
          var url_do_equipamento = "";
          document.getElementById('lb_ref_url_equipamento').innerHTML = ""; // Limpo a variavel
          $.ajax({
           url: 'tela_responde_comando_especial.php',
           type: 'GET',
           dataType: 'html',
           data: {'id': id,'tabela':nome_tabela },
           success: function(resultado)
           {

            document.getElementById('lb_ref_url_equipamento').innerHTML = resultado;
            //Agora inicio a tratativa e exibiçao para camera ************************
            var link_ip = document.getElementById('lb_ref_ip').innerHTML;
            var lb_ref_url_equipamento = document.getElementById('lb_ref_url_equipamento').innerHTML;
            console.log("Comando especial = " + lb_ref_url_equipamento );
            if(lb_ref_url_equipamento != "")
            {
             var mm = lb_ref_url_equipamento.split('"');
             var xx = mm[1].split(';');
             var ip = (xx[1]);
             document.getElementById('lb_ref_ip2').innerHTML = ip; //Coloca o valor do ip na label oculta
             if(lb_ref_url_equipamento == "vazio")
             {
              url_do_equipamento = "Sem dados no momento!";
             }
             else
             {
              console.log(mm[1]);
              if(mm[1] =="vazio")
              {
                url_do_equipamento= "Sem dados no momento!";
              }
              else
              {
               lb_ref_url_equipamento = mm[1];
               var url_do_equipamento ="";
               var msg = lb_ref_url_equipamento.split('#');
               if(link_ip == "Remoto")
               {
                url_do_equipamento = msg[1]+"/webfig/#Interfaces";
               }
               else
               {
                //Estou local
                url_do_equipamento = msg[0]+"/webfig/#Interfaces";
               }
              }
              
             }
            }
            else
            {
            url_do_equipamento = 'Sem dados no momento!';
            }
            //console.log("Rodou 2 ***********************");
            document.getElementById('lb_ref_ip_camera').innerHTML = "IP do equipamento = " + ip;
            document.getElementById('lb_ref_nome_camera').innerHTML = "Nome do equipamento = XX";
            document.getElementById('lb_ref_modelo_camera').innerHTML = "Modelo do equipamento = XX";
            document.getElementById('lb_ref_versao_camera').innerHTML = "Versão de firmware do equipamento = XX";
            document.getElementById('imagem_carregando_camera').style.display='none';
            atualiza_cameras(url_do_equipamento);
           } //Fecha o sucess
          }); //Fecha ajax
          


          
         //console.log("Rodou 1 ***********************");
         //alert(url_do_equipamento);

         }
         function funcao_radio(comando)
         {
          var id = comando;
          var nome_tabela = document.getElementById('lb_ref_nome_tabela').innerHTML;
          var url_do_equipamento = "";
          document.getElementById('lb_ref_url_equipamento').innerHTML = ""; // Limpo a variavel
          var funcao  = document.getElementById('funcao').innerHTML;
          var radius = "vazio";

          if(funcao != "")
          {
           const myArr2 = funcao.split(":");
           funcao = myArr2[1];
          }
          else
          {
           funcao == "vazio";
          }
          $.ajax({
           url: 'tela_responde_comando_especial.php',
           type: 'GET',
           dataType: 'html',
           data: {'id': id,'tabela':nome_tabela },
           success: function(resultado)
           {
            document.getElementById('lb_ref_url_equipamento').innerHTML = resultado;
            //Agora inicio a tratativa e exibiçao para camera ************************
            var link_ip = document.getElementById('lb_ref_ip').innerHTML;
            var lb_ref_url_equipamento = document.getElementById('lb_ref_url_equipamento').innerHTML;
            console.log("Comando especial = " + lb_ref_url_equipamento );
            if(lb_ref_url_equipamento != "")
            {
             var mm = lb_ref_url_equipamento.split('"');
             var xx = mm[1].split(';');
             var ip = (xx[1]);
             radius = (xx[2]); // Retorna Sim ou vazio
             document.getElementById('lb_ref_ip2').innerHTML = ip; //Coloca o valor do ip na label oculta
             if(lb_ref_url_equipamento == "vazio")
             {
              url_do_equipamento = "Sem dados no momento!";
             }
             else
             {
              console.log(mm[1]);
              if(mm[1] =="vazio")
              {
                url_do_equipamento= "Sem dados no momento!";
              }
              else
              {
               lb_ref_url_equipamento = mm[1];
               var url_do_equipamento ="";
               var msg = lb_ref_url_equipamento.split('#');
               if(link_ip == "Remoto")
               {
                url_do_equipamento = msg[1]+"/webfig/#Interfaces";
               }
               else
               {
                //Estou local
                url_do_equipamento = msg[0]+"/webfig/#Interfaces";
               }
              }
              
             }
            }
            else
            {
            url_do_equipamento = 'Sem dados no momento!';
            }
            
            //console.log("Rodou 2 ***********************");
            document.getElementById('lb_ref_ip_radio').innerHTML = "IP do equipamento = " + ip;
            comando_buscar_uptime_radio();
            //alert(radius);
            if(radius == "vazio")
            {
             //Permite o botao!
             document.getElementById('btn_radio_primeiro_acesso').style.display='block';
            }
            else
            {
              //oculta o botao!
              document.getElementById('btn_radio_primeiro_acesso').style.display='none';
            }
            document.getElementById('lb_ref_nome_radio').innerHTML = "Nome do equipamento = XX";
            document.getElementById('lb_ref_modelo_radio').innerHTML = "Modelo do equipamento = XX &emsp;&emsp;&emsp;S/N = XX";
            document.getElementById('lb_ref_versao_radio').innerHTML = "Versão de firmware do equipamento = XX";
            document.getElementById('imagem_carregando_radio').style.display='none';
            var ip = document.getElementById('lb_ref_ip2').innerHTML; //Pega o ip do equipamento
            
            if(ip != "vazio")
            {//Pode ajustar
             //alert(ip);
             var porta = 8728;
             var v_ip = ip.split(".");
             v_ip = (v_ip[3]); //Pega a ultima divisao do ip para calcular a porta padrao
             //alert(porta);
             var ip_completo = (ip + ":" + porta).toString();
             //passo via ajax para realizar o ajuste
             //verifico se ja tem radius habilitado, se sim, ja bloqueio o botao
             $.ajax({
             url: 'script_verifica_radius_radio.php',
             type: 'GET',
             dataType: 'html',
             data: {'ip': ip_completo, 'usuario':'bruno','senha':'268300' ,'ip2':ip,'tabela':nome_tabela},
             success: function(resultado)
             {
              document.getElementById('imagem_carregando_radio').style.display='none'; // oculta gif
              if(resultado.includes("ja_habilitado")==true)
              {
               //Bloqueio o botao
               document.getElementById('btn_radio_radius').disabled=true;
               document.getElementById('btn_radio_radius').value="RADIUS OK";
               document.getElementById('btn_radio_primeiro_acesso').disabled=true;
              } 
              else
              {
               //habilita o botao
               document.getElementById('btn_radio_radius').value="Habilitar RADIUS";
               document.getElementById('btn_radio_radius').disabled=false;
               document.getElementById('btn_radio_primeiro_acesso').disabled=false;
              }
             }
             });
            }//Fecha ip != vazio         
            
            atualiza_radios(url_do_equipamento);

           } //Fecha o sucess
          }); //Fecha ajax
          


          
         //console.log("Rodou 1 ***********************");
         //alert(url_do_equipamento);
         }

        function comando_editar(id)
        {
          var nome_tabela = document.getElementById('lb_ref_nome_tabela').innerHTML; 
          //alert("cliquei em editar o ID = " + id +  " da tabela " + nome_tabela);
          //Faço uma consulta externa para me trazer os dados
          
        $.ajax({
           url: 'tela_consulta_pontos_rede2.php',
           type: 'GET',
           dataType: 'html',
           data: {'tabela': nome_tabela,'id': id},
           success: function(resultado)
           {
             var msg = resultado.split(','); 
             var id = msg[0];
             var nome = msg[1];
             var ip = msg[2];
             var gateway = msg[3];
             var mascara = msg[4];
             var modelo = msg[5];
             var tipo = msg[6];
             var informacao_adicional = msg[7];
             var ativo = msg[8];
             var status = msg[9];
             var usuario = msg[10];
             var senha = msg[11];
             var disponivel = msg[12];
             var editado_por = msg[13];
             var data = msg[14];
             var hora = msg[15];
             
             console.log('XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX')
             console.log(id);
             console.log(nome);
             console.log(ip);
             console.log(gateway);
             console.log(mascara);
             console.log(modelo);
             console.log(tipo);
             console.log(informacao_adicional);
             console.log(ativo);
             console.log(status);
             console.log(usuario);
             console.log (senha);
             console.log (disponivel);
             console.log (editado_por);
             console.log (data);
             console.log (hora);
             console.log("");console.log("***********************************");console.log("");
             
            
            document.getElementById('lb_dados_titulo').innerHTML = 'Editando dados do IP '+ ip;
            document.getElementById('lb_dados_status').innerHTML = "Condição : " + status;
            document.getElementById('txt_dados_ip').value = ip;
            document.getElementById('txt_dados_id').value = id;
            document.getElementById('txt_dados_nome').value = nome;
            document.getElementById('txt_dados_gateway').value = gateway;
            document.getElementById('txt_dados_mascara').value = mascara;
            document.getElementById('text_area_informacao').value = informacao_adicional;
            document.getElementById('lb_dados_id').innerHTML = 'ID : '+ id;
            document.getElementById('txt_dados_usuario').value = usuario;
            document.getElementById('txt_dados_senha').value = senha;
            document.getElementById('lb_dados_editado_por').innerHTML = 'Ultima edição : '+ editado_por + ' - ' + data + ' às ' + hora;
           if(ativo == "Sim")
           {
            $("#radio_ativo_sim").prop("checked", true);
            
           }
           else
           {
            $("#radio_ativo_nao").prop("checked", true);
           }
           document.getElementById('select_dados_modelo').value = modelo; 
           document.getElementById('select_dados_tipo').value = tipo; 
            

            
           }
          });
         //Agora fecho os dados e volto a reexibir a tabela
         document.getElementById('tabela').style.display='none';
         document.getElementById('div_dados').style.display='block';
         document.getElementById('div_radio').style.display='none';
         document.getElementById('div_camera').style.display='none';


        }








      function adicionar(id)
      {
        //alert("Clicou em adicionar o IP " + id );
        var nome_tabela = document.getElementById('lb_ref_nome_tabela').innerHTML;
       // alert(nome_tabela);
        document.getElementById('tabela').style.display='none'; //Oculta a tabela
        document.getElementById('div_dados').style.display='block';
        
        $.ajax({
           url: 'tela_consulta_pontos_rede2.php',
           type: 'GET',
           dataType: 'html',
           data: {'tabela': nome_tabela,'id': id},
           success: function(resultado)
           {
             var msg = resultado.split(','); 
             var id = msg[0];
             var nome = msg[1];
             var ip = msg[2];
             var gateway = msg[3];
             var mascara = msg[4];
             var modelo = msg[5];
             var tipo = msg[6];
             var informacao_adicional = msg[7];
             var ativo = msg[8];
             var status = msg[9];
             var usuario = msg[10];
             var senha = msg[11];
             var disponivel = msg[12];
             var editado_por = msg[13];
             var data = msg[14];
             var hora = msg[15];
             
             console.log('XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX')
             console.log(id);
             console.log(nome);
             console.log(ip);
             console.log(gateway);
             console.log(mascara);
             console.log(modelo);
             console.log(tipo);
             console.log(informacao_adicional);
             console.log(ativo);
             console.log(status);
             console.log(usuario);
             console.log (senha);
             console.log (disponivel);
             console.log (editado_por);
             console.log (data);
             console.log (hora);
             console.log("");console.log("***********************************");console.log("");
             
            
            document.getElementById('lb_dados_titulo').innerHTML = 'Editando dados do IP '+ ip;
            document.getElementById('txt_dados_ip').value = ip;
            document.getElementById('txt_dados_id').value = id;
            document.getElementById('txt_dados_nome').value = nome;
            document.getElementById('txt_dados_gateway').value = gateway;
            document.getElementById('txt_dados_mascara').value = mascara;
            document.getElementById('text_area_informacao').value = informacao_adicional;
            document.getElementById('lb_dados_id').innerHTML = 'ID : '+ id;
            document.getElementById('txt_dados_usuario').value = usuario;
            document.getElementById('txt_dados_senha').value = senha;
            document.getElementById('lb_dados_editado_por').innerHTML = 'Ultima edição : '+ editado_por + ' - ' + data + ' às ' + hora;
           if(ativo == "Sim")
           {
            $("#radio_ativo_sim").prop("checked", true);
            
           }
           else
           {
            $("#radio_ativo_nao").prop("checked", true);
           }
           document.getElementById('select_dados_modelo').value = modelo; 
           document.getElementById('select_dados_tipo').value = tipo; 
            

            
           }
        });
        
      }


      function valida_ponto(ponto)
      {
       
        document.getElementById('exibir_fotos').style.display='none';
        document.getElementById('div_dados').style.display='none';
        document.getElementById('titulo_ponto').style.display='block';
        document.getElementById('descricao1').style.display='block';
        document.getElementById('div_gestao').style.display='none';
        document.getElementById('div_dashboard').style.display='none';



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
      } // Fecha function valida_ponto *******************************************************
      

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
        /*
       //alert("Clicou para editar")
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

     */
    }
    function atualiza_cameras(comando)
    {
     document.getElementById('tabela').style.display='none';
     document.getElementById('lb_equipamentos').style.display='none';
     document.getElementById('filtro').style.display='none';
     document.getElementById('lb_filtro').style.display='none';
     document.getElementById('div_radio').style.display='none';
     document.getElementById('div_dados').style.display='none';
     document.getElementById('div_camera').style.display='block';
     
     //alert(comando);
     console.log("");console.log("");
     console.log("Entrou");
    }
    function atualiza_radios(comando)
    {
     document.getElementById('tabela').style.display='none';
     document.getElementById('lb_equipamentos').style.display='none';
     document.getElementById('filtro').style.display='none';
     document.getElementById('lb_filtro').style.display='none';
     document.getElementById('div_radio').style.display='block';
     document.getElementById('div_dados').style.display='none';
     document.getElementById('div_camera').style.display='none';
     
     //alert(comando);
     console.log("");console.log("");
     console.log("Entrou");
    }
     
     //Verifica se deixa habilitado o botao de ajustes div_radio de primeiro acesso pelo perfil
     var funcao  = document.getElementById('funcao').innerHTML;
     if(funcao != "")
     {
      const myArr2 = funcao.split(":");
      funcao = myArr2[1];
     } 
     if(funcao.includes("Desenvolvedor")==true)
     {
      //Permite o botao!
      document.getElementById('btn_radio_primeiro_acesso').style.display='block';
     }
     else
     {
      //oculta o botao!
      document.getElementById('btn_radio_primeiro_acesso').style.display='none';
     }
     
     

      document.getElementById( 'div_camera' ).style.display = 'none';
      document.getElementById( 'div_radio' ).style.display = 'none';
      document.getElementById( 'div_dados' ).style.display = 'none';
      document.getElementById( 'div_mapa_rede' ).style.display = 'none';
      document.getElementById('btn_fechar2').style.visibility='hidden';
      document.getElementById('lb_filtro').style.display='none';
      document.getElementById('filtro').style.display='none';
      document.getElementById('btn_mapa_rede').style.visibility='visible';
      valida_ponto('Rack Logistica');

      


    
    </script>





</div>






</body>


<style>

#titulo_camera{
    color: rgba(0, 0, 0, 0.8);
}
#titulo_radio{
    color: rgba(0, 0, 0, 0.8);
}



LABEL#lb_dados_titulo{
    position: relative;
    top: 15px;
    left: 20px;
    font: bold 18pt verdana;
    color:#000000;

}




LABEL#lb_dados_nome{
    position: relative;
    top: 75px;
    left: -450px;
    font: bold 14pt arial;
    color: #000000;

}
INPUT#txt_dados_nome{
    position: relative;
    top: 75px;
    left: -440px;
    width: 350px;
    height: 28px;
    padding-left: 8px;
    padding-top: 2px;
    padding-bottom: 2px;
    font: bold 14pt arial;
    background-color: rgba(0, 0, 0, 0.1);
    color: #000000;

}


LABEL#lb_dados_gateway{
    position: relative;
    top: 80px;
    left: 30px;
    font: bold 14pt arial;
    color: #000000;

}
INPUT#txt_dados_gateway{
    position: relative;
    top: 80px;
    left: 40px;
    width: 150px;
    height: 28px;
    padding-left: 8px;
    padding-top: 2px;
    padding-bottom: 2px;
    font: bold 14pt arial;
    background-color: rgba(0, 0, 0, 0.1);
    color: #000000;

}

LABEL#lb_dados_mascara{
    position: relative;
    top: 80px;
    left: 90px;
    font: bold 14pt arial;
    color: #000000;

}
INPUT#txt_dados_mascara{
    position: relative;
    top: 80px;
    left: 100px;
    width: 150px;
    height: 28px;
    padding-left: 8px;
    padding-top: 2px;
    padding-bottom: 2px;
    font: bold 14pt arial;
    background-color: rgba(0, 0, 0, 0.1);
    color: #000000;

}


LABEL#lb_dados_modelo{
    position: relative;
    top: 80px;
    left: 130px;
    font: bold 14pt arial;
    color: #000000;

}
SELECT#select_dados_modelo{
    position: relative;
    top: 80px;
    left: 150px;
    width: 150px;
    height: 28px;
    padding-left: 8px;
    padding-top: 2px;
    padding-bottom: 2px;
    font: bold 14pt arial;
    background-color: rgba(0, 0, 0, 0.1);
    color: #000000;

}
#lb_filtro{
    position: relative;
    top: 2px;
    font: 10pt;
    padding: 20px;
    color: rgba(255, 255, 255, 0.8)

}
LABEL#lb_dados_modelo2{
    position: relative;
    top: 10px;
    left: 20px;
    font: bold 20pt arial;
    color: rgba(255, 255, 255, 0.8);
}



SELECT#select_dados_modelo2{
    position: relative;
    top: 10px;
    left: 40px;
    width: 250px;
    height: 40px;
    padding-left: 8px;
    padding-top: 2px;
    padding-bottom: 2px;
    font: bold 18pt arial;
    color: rgba(255, 255, 255, 0.8);
    background-color: #999;

}

LABEL#lb_dados_tipo2{
    position: relative;
    top: 10px;
    left: 60px;
    font: bold 20pt arial;
    color: rgba(255, 255, 255, 0.8);

}

SELECT#select_dados_tipo2{
    position: relative;
    top: 10px;
    left: 70px;
    width: 250px;
    height: 40px;
    padding-left: 8px;
    padding-top: 2px;
    padding-bottom: 2px;
    font: bold 18pt arial;
    color: rgba(255, 255, 255, 0.8);
    background-color: #999;

}

LABEL#btn_filtrar{
    position: relative;
    top: 10px;
    left: 90px;
    width: 150px;
    height: 40px;
    font: normal 16pt arial;


}

LABEL#btn_limpar{
    position: relative;
    top: 10px;
    left: 90px;
    width: 150px;
    height: 40px;
    font: normal 16pt arial;


}






LABEL#lb_dados_tipo{
    position: relative;
    top: 40px;
    left: -135px;
    font: bold 14pt arial;
    color: #000000;

}

SELECT#select_dados_tipo{
    position: relative;
    top: 40px;
    left: -115px;
    width: 205px;
    height: 28px;
    padding-left: 8px;
    padding-top: 2px;
    padding-bottom: 2px;
    font: bold 14pt arial;
    background-color: rgba(0, 0, 0, 0.1);
    color: #000000;

}




LABEL#lb_dados_status{
    position: relative;
    top: -212px;
    left: 620px;
    font: bold 14pt verdana;
    color:#000000;

}

LABEL#lb_dados_informacao{
    position: relative;
    top: 90px;
    left: 30px;
    font: bold 14pt arial;
    color:#000000;

}

TEXTAREA#text_area_informacao{
    position: relative;
    top: 90px;
    left: 30px;
    font: normal 14pt verdana;
    color:#000000;

}

LABEL#lb_dados_id{
    position: relative;
    top: -210px;
    left: 660px;
    font: bold 14pt verdana;
    color:#000000;

}

LABEL#lb_dados_ativo{
    position: relative;
    top: -72px;
    left: 60px;
    font: bold 14pt arial;
    color:#000000;

}
#radio_ativo_sim{
    position: relative;
    top: -70px;
    left: 70px;
    font: bold 14pt arial;
    color:#000000;
}
LABEL#lb_radio_ativo_sim{
    position: relative;
    top: -70px;
    left: 75px;
    font: bold 14pt arial;
    color:#000000;
}

#radio_ativo_nao{
    position: relative;
    top: -70px;
    left: 105px;
    font: bold 14pt arial;
    color:#000000;
}

LABEL#lb_radio_ativo_nao{
    position: relative;
    top: -70px;
    left: 110px;
    font: bold 14pt arial;
    color:#000000;
}

LABEL#lb_dados_usuario{
    position: relative;
    top: 90px;
    left: -410px;
    font: bold 14pt arial;
    color:#000000;
}

INPUT#txt_dados_usuario{
    position: relative;
    top: 90px;
    left: -400px;
    width: 200px;
    height: 28px;
    padding-left: 8px;
    padding-top: 2px;
    padding-bottom: 2px;
    font: bold 14pt arial;
    color:#000000;
}

LABEL#lb_dados_senha{
    position: relative;
    top: 90px;
    left: -390px;
    font: bold 14pt arial;
    color:#000000;
}

INPUT#txt_dados_senha{
    position: relative;
    top: 90px;
    left: -380px;
    width: 180px;
    height: 28px;
    padding-left: 8px;
    padding-top: 2px;
    padding-bottom: 2px;
    font: bold 14pt arial;
    color:#000000;
}

LABEL#lb_dados_editado_por{
    position: relative;
    top: 120px;
    left: 30px;
    font: bold 14pt arial;
    color:#000000;
}


INPUT#btn_dados_salvar{
    position: relative;
    top: 58px;
    left: 65px;
    width: 150px;
    height: 35px;
    padding-left: 8px;
    padding-top: 2px;
    padding-bottom: 2px;
    font: normal 14pt arial;
    color:#ffffff;
}

INPUT#btn_dados_apagar{
    position: relative;
    top: 58px;
    left: 75px;
    width: 200px;
    height: 35px;
    padding-left: 8px;
    padding-top: 2px;
    padding-bottom: 2px;
    font: normal 14pt arial;
    color:#000000;
}

INPUT#btn_dados_sair{
    position: relative;
    top: 65px;
    left: 614px;
    width: 150px;
    height: 35px;
    padding-left: 8px;
    padding-top: 2px;
    padding-bottom: 2px;
    font: normal 14pt arial;
    color:#000000;
}

INPUT#btn_cameras_sair{
    position: relative;
    width: 150px;
    height: 35px;
    padding-left: 8px;
    padding-top: 2px;
    padding-bottom: 2px;
    font: normal 14pt arial;
    color:#000000;
}

INPUT#btn_radio_sair{
    position: relative;
    width: 150px;
    height: 35px;
    padding-left: 8px;
    padding-top: 2px;
    padding-bottom: 2px;
    font: normal 14pt arial;
    color:#000000;
}
DIV#filtro
{
    width: 100%;
    height: 70px;
    background-color: transparent;
}













.configuracao{
    width: 25px;
    height: 25px;
    padding-right: 5px;
}
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
.editar{
    width: 28px;
    height: 28px;
    padding-right: 2px;
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

DIV#div_gestao
{
    padding-left: 20px;
    width: 1200px;
    height: 550px;
    background-color:	transparent;

}

DIV#div_dashboard
{
  position: relative;
  padding-left: 20px;
  width: 1200px;
  height: 650px;
  background-color: 	#DCDCDC;
  cursor: pointer;
  border-radius: 10px!important;
  border: 6px #000000 solid!important;
}




DIV#div_camera
{
    padding-left: 20px;
    width: 1200px;
    height: 450px;
    background-color: 	#DCDCDC;
    cursor: pointer;
    border-radius: 10px!important;
    border: 6px #000000 solid!important;
}
DIV#div_radio
{
    padding-left: 20px;
    width: 1200px;
    height: 470px;
    background-color: 	#DCDCDC;
    cursor: pointer;
    border-radius: 10px!important;
    border: 6px #000000 solid!important;
}
DIV#div_dados
{
    margin-left: 50px;
    width: 1000px;
    height: 450px;
    background-color: 	#DCDCDC;
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
IMG#img_ordem_nome_a_z{
    margin-left: 20px;
    width: 36px;
    height: 36px;
    cursor: pointer;
    border-radius: 8px!important;
    border: 4px #555 solid!important;

}
IMG#img_ordem_nome_z_a{
    margin-left: 2px;
    width: 36px;
    height: 36px;
    cursor: pointer;
    border-radius: 8px!important;
    border: 4px #555 solid!important;

}
IMG#img_ordem_usados{
    margin-left: 2px;
    width: 36px;
    height: 36px;
    cursor: pointer;
    border-radius: 8px!important;
    border: 4px #555 solid!important;

}
IMG#img_ordem_ip_um_a_dez{
    margin-left: 20px;
    width: 36px;
    height: 36px;
    cursor: pointer;
    border-radius: 8px!important;
    border: 4px #555 solid!important;

}
IMG#img_ordem_ip_dez_a_um{
    margin-left: 2px;
    width: 36px;
    height: 36px;
    cursor: pointer;
    border-radius: 8px!important;
    border: 4px #555 solid!important;

}
IMG#img_ordem_online{
    margin-left: 1px;
    width: 16px;
    height: 16px;
    cursor: pointer;
}
IMG#img_ordem_offline{
    margin-left: 1px;
    width: 16px;
    height: 16px;
    cursor: pointer;
}
IMG#img_ordem_bloqueado{
    margin-left: 1px;
    width: 16px;
    height: 16px;
    cursor: pointer;
}
IMG#img_ordem_todos{
    margin-left: 3px;
    width: 16px;
    height: 16px;
    cursor: pointer;
}








IMG#imagem_carregando_camera{
    position: absolute;
    top: 50%;
    left: 48%;
    width: 100px;
    height: 100px;
}
IMG#imagem_carregando_radio{
    position: absolute;
    top: 50%;
    left: 48%;
    width: 100px;
    height: 100px;
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