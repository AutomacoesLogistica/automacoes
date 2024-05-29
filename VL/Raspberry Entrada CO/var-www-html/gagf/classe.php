<?php

class Exporta
{

	public function exportMysqlToCsv( $strQuery, $Ds_Arquivo_Destino = 'export.csv' )
	{
		$Ds_Separador_Linha = "\n";
		$Ds_Separador_Coluna = ",";
		$Ds_Caracter_Encapsular = '"';
		$Ds_Caracter_Escape = "\\";

		// Recupera os dados do servidor
		$Ds_Retorno = mysql_query( $strQuery );
		$Nr_Colunas = mysql_num_fields( $Ds_Retorno );


		$Ds_Linha_CSV = '';

		for ( $i = 0; $i < $Nr_Colunas; $i++ )
		{
			$Ds_Linha_CSV .= mysql_field_name( $Ds_Retorno, $i ) . $Ds_Separador_Coluna;
		} // end for

		$Ds_Saida = trim( substr( $Ds_Linha_CSV, 0, -1 ) );
		$Ds_Saida .= $Ds_Separador_Linha;

		// Format the data
		while ( $Ds_Linha_Banco = mysql_fetch_array( $Ds_Retorno ) )
		{
			$Ds_Linha_CSV = '';
			for ( $j = 0; $j < $Nr_Colunas; $j++ )
			{
				if ( $Ds_Linha_Banco[$j] == '0' || $Ds_Linha_Banco[$j] != '' )
				{

					if ( $Ds_Caracter_Encapsular == '' )
					{
						$Ds_Linha_CSV .= $Ds_Linha_Banco[$j];
					}
					else
					{
						$Ds_Linha_CSV .= $Ds_Caracter_Encapsular . str_replace( $Ds_Caracter_Encapsular, $Ds_Caracter_Escape . $Ds_Caracter_Encapsular, $Ds_Linha_Banco[$j] ) . $Ds_Caracter_Encapsular;
					}
				}
				else
				{
					$Ds_Linha_CSV .= '';
				}

				if ( $j < $Nr_Colunas - 1 )
				{
					$Ds_Linha_CSV .= $Ds_Separador_Coluna;
				}
			}

			$Ds_Saida .= $Ds_Linha_CSV;
			$Ds_Saida .= $Ds_Separador_Linha;
		}


			
		// Grava o arquivo físico
		if ( !is_dir( dirname( $Ds_Arquivo_Destino ) ) )
		{
			mkdir( dirname( $Ds_Arquivo_Destino ), 0755, true );
		}

		$criarArquivo = (!is_file( $Ds_Arquivo_Destino ) );
		$objTxt = fopen( $Ds_Arquivo_Destino, "w" );
		if ( $criarArquivo)
		{
			//UTF-8
			fwrite( $objTxt, pack( "CCC", 0xef, 0xbb, 0xbf ) );
		}
		
		fwrite( $objTxt, $Ds_Saida );
		fclose( $objTxt );
		

	}
	
}


?>