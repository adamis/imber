<?php
	date_default_timezone_set("America/Sao_Paulo");
	include_once '../connection/connection.php';	
	include_once '../adapter/MedicoesCRUD.php';
	include_once '../dao/Medicoes.php';
	
	$connection;
	
	if (isset ( $_GET['dt_inicial'] )) {
		$inicial = $_GET['dt_inicial'];
	}
	if (isset ( $_GET['dt_final'] )) {
		$final = $_GET['dt_final'];
	}
	
	$connection = new Connection();		
	$medicoesCRUD = new MedicoesCRUD ( $connection );
	$date = date('Y-m-d H:i');
		
	$where = 'data_hora BETWEEN \''.$inicial.'\' AND \''.$final.'\'';
	
	$listMedicoes = $medicoesCRUD->read($where);
	
	echo json_encode($listMedicoes);
	
?>