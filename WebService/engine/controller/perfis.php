<?php
	include_once '../connection/connection.php';
	include_once '../connection/PermissionCRUD.php';
	include_once '../adapter/PerfisCRUD.php';
				
	if (isset ( $_POST['token'] )) {
		$token = $_POST['token'];
	}
		
?>