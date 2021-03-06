<?php

	/**
	 * Generated by Getz Framework
	 * 
	 * @author Mário Sakamoto <mskamot@gmail.com>
	 * @see http://mariosakamoto.com/getz
	 */

	use lib\getz;
	use src\model;	 
	 
	require_once($_DOCUMENT_ROOT . "/lib/getz/Activator.php");

	if ($method == "page") {
		/*
		 * SEO
		 */
		$darth->setTitle("Imber");
		$darth->setDescription("Sistema open source online para gerenciamento de estação meteorológica");
		$darth->setKeywords("imber,estação meteorológica,uniube,tcc,uberaba");
			
		$daoFactory->beginTransaction();
		$response[0]["titles"] = $daoFactory->getTelasDao()->read("telas.identificador = '" . $screen . "'", "", true);
		$response[0]["medicoes"] = $daoFactory->getMedicoesDao()->read("", "medicoes.id desc limit 0,4", true);
		$daoFactory->close();		
		
		echo $darth->view("", $_DOCUMENT_ROOT . $_PACKAGE . "/html/header.htm");
		echo $darth->view($response, $_DOCUMENT_ROOT . $_PACKAGE . "/html/home.htm");
		echo $darth->view("", $_DOCUMENT_ROOT . $_PACKAGE . "/html/footer.htm");		
	}
	
?>