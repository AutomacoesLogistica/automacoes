<HTML>
	<HEAD>
		<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />		
		<TITLE> Controle em PHP </TITLE>
		<style>
			body{
				text-align:center;
			}
		</style>
	</HEAD>	
	<BODY>
		<?
			$conexaoArduino = fopen("COM4", "w");
			fwrite($conexaoArduino, $_REQUEST["numero"]);
			fclose($conexaoArduino)
		?>		
			<a href = "http://10.10.25.87:8585/controle/index.php?numero=1"> Ligar lâmpada</a>
			<br><br>
			<a href = "http//10.10.25.87:8585/controle/index.php?numero=0"> Desligar lâmpada</a>
	</BODY>
</HTML>

