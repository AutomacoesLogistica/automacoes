<?php
$curl = curl_init();


$v_cpf = isset($_GET['cpf'])?$_GET['cpf']:"vazio";

if($v_cpf != "vazio")
{
 curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://sistemas.hh2risk.com.br/ws_rest/public/api/motorista?CPF='.$v_cpf,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'User-Agent: cpprestsdk/2.9.0',
    'Authorization: Basic aW50ZWdyYWNhby5nZXJkYXU6aW50ZTIwMjI='
  ),
 ));
 $response = curl_exec($curl);
 curl_close($curl);
 //echo($response);
 
 if($response =='{"motorista":null}')
 {
  echo "cpf não encontrado no sistema!";
 }
 else
 {
  //echo "</BR>";echo "</BR>";echo "</BR>";
  $jsonObj = json_decode($response,false);
  $jsonObj3 = $jsonObj->motorista;
  $msg = $jsonObj3;
  $n = strval(json_encode($msg));
  $tec = json_decode($n);
  $tecc = $tec[0];
  $v = json_encode($tecc);
  $valor = $v;
  $jsonObj2 = json_decode($valor);
  $codigo = $jsonObj2->codigo;
  $cpf = $jsonObj2->cpf_motorista;
  $nome = $jsonObj2->nome;
  $rg = $jsonObj2->rg;
  $logradouro = $jsonObj2->logradouro;
  $cep = $jsonObj2->cep;
  $numero = $jsonObj2->numero;
  $complemento = $jsonObj2->complemento;
  $bairro = $jsonObj2->bairro;
  $cidade = $jsonObj2->cidade;
  $sigla_estado = $jsonObj2->sigla_estado;
  $pais = $jsonObj2->pais;
  $nro_cnh = $jsonObj2->nro_cnh;
  $categoria_cnh = $jsonObj2->categoria_cnh;
  $validade_cnh = $jsonObj2->validade_cnh;
  $data_nasc = $jsonObj2->data_nasc;
  $rg_emissor = $jsonObj2->rg_emissor;
  $rg_uf = $jsonObj2->rg_uf;
  $naturalidade_descricao_ibge = $jsonObj2->naturalidade_descricao_ibge;
  $naturalidade_uf_sigla = $jsonObj2->naturalidade_uf_sigla;
  $cnh_uf = $jsonObj2->cnh_uf;
  $cnh_seg = $jsonObj2->cnh_seg;
  $vigilante = $jsonObj2->vigilante;
  $nro_cnv = $jsonObj2->nro_cnv;
  $validade_cnv = $jsonObj2->validade_cnv;
  $data_admissao = $jsonObj2->data_admissao;
  $profissao = $jsonObj2->profissao;
  $trasnportador = $jsonObj2->transportador;
  $n = strval(json_encode($trasnportador));
  $tec = json_decode($n);
  $tecc = $tec[0];
  $v = json_encode($tecc);
  $valor = $v;
  $b = json_decode($valor);
  $documento_transportador = $b->documento_transportador;
  $vinculo_contratual = $b->vinculo_contratual;

  //Agora exibo os dados ***********************************************************************8
  echo "Codigo = ". $codigo;echo("</BR>");
  echo "CPF = ". $cpf;echo("</BR>");
  echo "Nome = ". $nome;echo("</BR>");
  echo "RG = ". $rg;echo("</BR>");
  echo "Endereco = ". $logradouro;echo("</BR>");
  echo "CEP = ". $cep;echo("</BR>");
  echo "Complemento = ". $complemento;echo("</BR>");
  echo "Bairro = ". $bairro;echo("</BR>");
  echo "Cidade = ". $cidade;echo("</BR>");
  echo "Estado = ". $sigla_estado;echo("</BR>");
  echo "Pais = ". $pais;echo("</BR>");
  echo "Numero CNH = ". $nro_cnh;echo("</BR>");
  echo "Categoria CNH = ". $categoria_cnh;echo("</BR>");
  echo "Validade = ". $validade_cnh;echo("</BR>");
  echo "Data Nascimento = ". $data_nasc;echo("</BR>");
  echo "RG Emissor = ". $rg_emissor;echo("</BR>");
  echo "RG UF = ". $rg_uf;echo("</BR>");
  echo "Naturalidade = ". $naturalidade_descricao_ibge;echo("</BR>");
  echo "Sigla Naturalidade = ". $naturalidade_uf_sigla;echo("</BR>");
  echo "CNH Seg = ". $cnh_seg;echo("</BR>");
  echo "CNH UF = ". $cnh_uf;echo("</BR>");
  echo "Vigilante = ". $vigilante;echo("</BR>");
  echo "Numero CNV = ". $nro_cnv;echo("</BR>");
  echo "Validade CNV = ". $validade_cnv;echo("</BR>");
  echo "Data Admissao = ". $data_admissao;echo("</BR>");
  echo "Profissao = ". $profissao;echo("</BR>");
  echo "Documento Trasnportador = ". $documento_transportador;echo("</BR>");
  echo "Vinculo Contratual = ". $vinculo_contratual;echo("</BR>");
  
 }
}
else
{
 echo "Favor inserir um cpf válido!";   
}
?>