<?php
	date_default_timezone_set("America/Sao_Paulo");
	include_once '../connection/connection.php';	
	include_once '../adapter/MedicoesCRUD.php';
	include_once '../dao/Medicoes.php';
	
	$connection;
	
	if (isset ( $_REQUEST ['temperatura'] )) {
		$temperatura = $_REQUEST ['temperatura'];
	}
	if (isset ( $_REQUEST ['pressao'] )) {
		$pressao = $_REQUEST ['pressao'];
	}
	if (isset ( $_REQUEST ['altitude'] )) {
		$altitude = $_REQUEST ['altitude'];
	}
	if (isset ( $_REQUEST ['umidadeSolo'] )) {
		$umidadeSolo = $_REQUEST ['umidadeSolo'];
	}
	if (isset ( $_REQUEST ['umidadeAr'] )) {
		$umidadeAr = $_REQUEST ['umidadeAr'];
	}
	
	$connection = new Connection();		
	$medicoesCRUD = new MedicoesCRUD ( $connection );
	$date = date('Y-m-d H:i');
	
	$medicoes = new Medicoes();	
	$medicoes->setData_Hora($date);
	$medicoes->setAltura_mar($altitude);
	$medicoes->setHumidade_ar($umidadeAr);
	$medicoes->setHumidade_solo($umidadeSolo);
	$medicoes->setPressao_ar($pressao);
	$medicoes->setTemperatura_ar($temperatura);
	$medicoes->setCadastrado($date);
	$medicoes->setModificado($date);
	
	if($medicoesCRUD->create($medicoes) == 1){
		echo "ok";
	}else{
		echo "fail";
	}
	
?>