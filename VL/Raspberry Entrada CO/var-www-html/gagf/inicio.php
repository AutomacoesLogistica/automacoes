<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="excellentexport.js"></script>
    <title>Document</title>
    <style>
            table, tr, td {
                border: 1px black solid;
            }
        </style>
</head>
<body>
    <?php
    $mes = "Abril";
     $nome = 'Lista_Excesso_MB_'.$mes.'.csv';
    ?>
     <table id="datatable" border= 1px; >
                <thead >
                  <tr>
                      <th class="th1">Data</th>
                      <th class="th2">Nº GSCS</th>
                      <th class="th3">Placa</th>
                      <th class="th4">Capacidade</th>
                      <th class="th4">Peso Bruto</th>
                      <th class="th4">Assertividade</th>
                      <th class="th4">Trasnsportadora</th>
                  </tr><tr>
                      <td class="th1">10/02/2020 09:33:33</td>
                      <td class="th2">1234567</td>
                      <td class="th3">OGH-1234/RJ</td>
                      <td class="th4">41500</td>
                      <td class="th5">41235</td>
                      <td class="th6">92.33%</td>
                      <td class="th7">SILVANO SANTOS DA ROCHA EIRELI</td>
                  </tr><tr>
                      <td class="th1">10/02/2020 09:33:33</td>
                      <td class="th2">1234567</td>
                      <td class="th3">OGH-1234/RJ</td>
                      <td class="th4">41500</td>
                      <td class="th5">41235</td>
                      <td class="th6">92.33%</td>
                      <td class="th7">SILVANO SANTOS DA ROCHA EIRELI</td>
                  </tr><tr>
                      <td class="th1">10/02/2020 09:33:33</td>
                      <td class="th2">1234567</td>
                      <td class="th3">OGH-1234/RJ</td>
                      <td class="th4">41500</td>
                      <td class="th5">41235</td>
                      <td class="th6">92.33%</td>
                      <td class="th7">SILVANO SANTOS DA ROCHA EIRELI</td>
                  </tr><tr>
                      <td class="th1">10/02/2020 09:33:33</td>
                      <td class="th2">1234567</td>
                      <td class="th3">OGH-1234/RJ</td>
                      <td class="th4">41500</td>
                      <td class="th5">41235</td>
                      <td class="th6">92.33%</td>
                      <td class="th7">SILVANO SANTOS DA ROCHA EIRELI</td>
                  </tr><tr>
                      <td class="th1">10/02/2020 09:33:33</td>
                      <td class="th2">1234567</td>
                      <td class="th3">OGH-1234/RJ</td>
                      <td class="th4">41500</td>
                      <td class="th5">41235</td>
                      <td class="th6">92.33%</td>
                      <td class="th7">SILVANO SANTOS DA ROCHA EIRELI</td>
                  </tr><tr>
                      <td class="th1">10/02/2020 09:33:33</td>
                      <td class="th2">1234567</td>
                      <td class="th3">OGH-1234/RJ</td>
                      <td class="th4">41500</td>
                      <td class="th5">41235</td>
                      <td class="th6">92.33%</td>
                      <td class="th7">SILVANO SANTOS DA ROCHA EIRELI</td>
                  </tr><tr>
                      <td class="th1">10/02/2020 09:33:33</td>
                      <td class="th2">1234567</td>
                      <td class="th3">OGH-1234/RJ</td>
                      <td class="th4">41500</td>
                      <td class="th5">41235</td>
                      <td class="th6">92.33%</td>
                      <td class="th7">SILVANO SANTOS DA ROCHA EIRELI</td>
                  </tr><tr>
                      <td class="th1">10/02/2020 09:33:33</td>
                      <td class="th2">1234567</td>
                      <td class="th3">OGH-1234/RJ</td>
                      <td class="th4">41500</td>
                      <td class="th5">41235</td>
                      <td class="th6">92.33%</td>
                      <td class="th7">SILVANO SANTOS DA ROCHA EIRELI</td>
                  </tr><tr>
                      <td class="th1">10/02/2020 09:33:33</td>
                      <td class="th2">1234567</td>
                      <td class="th3">OGH-1234/RJ</td>
                      <td class="th4">41500</td>
                      <td class="th5">41235</td>
                      <td class="th6">92.33%</td>
                      <td class="th7">SILVANO SANTOS DA ROCHA EIRELI</td>
                  </tr><tr>
                      <td class="th1">10/02/2020 09:33:33</td>
                      <td class="th2">1234567</td>
                      <td class="th3">OGH-1234/RJ</td>
                      <td class="th4">41500</td>
                      <td class="th5">41235</td>
                      <td class="th6">92.33%</td>
                      <td class="th7">SILVANO SANTOS DA ROCHA EIRELI</td>
                  </tr><tr>
                      <td class="th1">10/02/2020 09:33:33</td>
                      <td class="th2">1234567</td>
                      <td class="th3">OGH-1234/RJ</td>
                      <td class="th4">41500</td>
                      <td class="th5">41235</td>
                      <td class="th6">92.33%</td>
                      <td class="th7">SILVANO SANTOS DA ROCHA EIRELI</td>
                  </tr>
                  
                </tbody>
              </table>
     <a download='somedatafff.csv' href="#" onclick="return ExcellentExport.csv(this, 'datatable');">Export to CSV</a>
        <br/>

</body>
</html>