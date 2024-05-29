<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Automações Gerdau</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="style5.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

</head>

<body>

    <div class="wrapper">
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
                    <a href="#" class="download">Voltar</a>
                </li>
            </ul>
        </nav>

        <!-- Page Content Holder -->
        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="navbar-btn">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        
                            <h3>Automações GERDAU</h3>
                        
                    </div>
                </div>
            </nav>
            
            <h2 id="titulo_ponto">Efetuando ajustes</h2>
            <p>Ponto situado em.....</p>
            
            <div class="line"></div>

            <h2>Lorem Ipsum Dolor</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

            <div class="line"></div>


        </div>
    </div>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script type="text/javascript">

      function valida_ponto(ponto)
      {

        console.log("clicou em Rack Logistica da UTMI");
        document.getElementById("titulo_ponto").innerHTML = ponto;
      }
      $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
                $(this).toggleClass('active');
            });
        });
    </script>
</body>

</html>