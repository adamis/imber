<?php
	date_default_timezone_set("America/Sao_Paulo");
	include_once '../connection/connection.php';		
	include_once '../adapter/MedicoesCRUD.php';
	include_once '../dao/Medicoes.php';
	
	$connection;
	$inicial;
	$final;
		
	// Definimos o nome do arquivo que sera exportado
	
	
	
	if (isset ( $_POST ['inicial'] )) {
		$inicial = $_POST ['inicial'];
	}
	if (isset ( $_POST ['final'] )) {
		$final = $_POST ['final'];
	}
	
	$arquivo = 'Dados '.str_replace('T',' ',(str_replace(':','-',$inicial)).' - '.str_replace('T',' ',str_replace(':','-',$final))).'.xls';
	
	$connection = new Connection();		
	$medicoesCRUD = new MedicoesCRUD ( $connection );
	
	$where = 'data_hora BETWEEN \''.$inicial.'\' AND \''.$final.'\'';
	
	$listMedicoes = $medicoesCRUD->read($where);
	
	// Criamos uma tabela HTML com o formato da planilha
	
	$html = ' <style> ';
		$html .= ' td{						 
						 border:solid 1px #000;
					}
				';		
		$html .= ' table{						
						 border:solid 1px #000;
						}
				';
		
	$html .= ' </style> ';
	
	$html .= '<table>';
	$html .= '<tr>';
	$html .= '<td colspan="7" style="text-align:center; font-size:50px;" ><b>Dados Meteorológicos</b></tr>';
	$html .= '</tr>';
	
	$html .= '<tr>';
		$html .= '<td>';
		
			$html .= 'Indice';
		
		$html .= '</td>';
		
		$html .= '<td>';
		
			$html .= 'Leitura';
		
		$html .= '</td>';
		
		$html .= '<td>';
		
			$html .= 'Altura ao Nivel do Mar';
		
		$html .= '</td>';
		
		$html .= '<td>';
		
			$html .= 'Humidade do Ar';
		
		$html .= '</td>';
		
		$html .= '<td>';
		
			$html .= 'Humidade do Solo';
		
		$html .= '</td>';
		
		$html .= '<td>';
		
			$html .= 'Pressão Atmosferica';
		
		$html .= '</td>';
		
		$html .= '<td>';
		
			$html .= 'Temperatura do Ar';
		
		$html .= '</td>';
		
	$html .= '</tr>';
	
	for ($i = 0; $i < sizeof($listMedicoes); $i++) {
		$html .= '<tr>';
		
			$html .= '<td>';
				
				$html .= $listMedicoes[$i]->getId();
				
			$html .= '</td>';
		
			$html .= '<td>';
			
				$html .= $listMedicoes[$i]->getData_hora();
			
			$html .= '</td>';
			
			$html .= '<td style="text-align:left;">';
			
				$html .= $listMedicoes[$i]->getAltura_mar();
			
			$html .= '</td>';
			
			$html .= '<td style="text-align:left;">';
			
				$html .= $listMedicoes[$i]->getHumidade_ar();
			
			$html .= '</td>';			
			
			$html .= '<td style="text-align:left;">';
			
				$html .= $listMedicoes[$i]->getHumidade_solo();
			
			$html .= '</td>';
			
			$html .= '<td style="text-align:left;">';
			
				$html .= $listMedicoes[$i]->getPressao_ar();
			
			$html .= '</td>';
			
			$html .= '<td style="text-align:left;">';
			
				$html .= $listMedicoes[$i]->getTemperatura_ar();
			
			$html .= '</td>';
			
			
		$html .= '</tr>';
	}
	
	$html .= '</table>';
	
	/*
	* Criando e exportando planilhas do Excel	
	*/

	// ConfiguraÃ§Ãµes header para forÃ§ar o download
	header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
	header ("Cache-Control: no-cache, must-revalidate");
	header ("Pragma: no-cache");
	header ("Content-type: application/x-msexcel");
	header ("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
	header ("Content-Description: PHP Generated Data" );
	// Envia o conteÃºdo do arquivo
	echo $html;
	exit;
		
?>