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
	
	/*
	 * Filters
	 */
	$where = "";
	
	if ($search != "")
		$where = "temas.tema LIKE \"%" . $search . "%\"";	
		
	if ($code != "")
		$where = "temas.id = " . $code;
		
	if ($order != "") {
		$o = explode("<gz>", $order);

		$limit = $o[0] . " " . $o[1] . " LIMIT " . 
				(($position * $itensPerPage) - $itensPerPage) . ", " . $itensPerPage;
				
	} else
		$limit = "temas.id DESC LIMIT " . 
				(($position * $itensPerPage) - $itensPerPage) . ", " . $itensPerPage;	
	
	/**************************************************
	 * Webpage
	 **************************************************/		
	
	/*
	 * Page
	 */
	if ($method == "page") {
		/*
		 * SEO
		 */
		$darth->setTitle($screen);
		$darth->setDescription("");
		$darth->setKeywords("");
		
		$daoFactory->beginTransaction();
		$response[0]["temas"] = $daoFactory->getTemasDao()->read($where, $limit, true);
		$daoFactory->close();

		echo $darth->view("", $_DOCUMENT_ROOT . $_PACKAGE . "/html/header.htm");
		echo $darth->view($response, $_DOCUMENT_ROOT . $_PACKAGE . "/html/temas.htm");
		echo $darth->view("", $_DOCUMENT_ROOT . $_PACKAGE . "/html/footer.htm");
	}
	
	/**************************************************
	 * Webservice
	 **************************************************/	

	/*
	 * Method
	 */
	else if ($method == "method")
		echo "Parameters: " . (isset($_GET["parameters"]) ? $_GET["parameters"] : "");	 
	
	/*
	 * Create
	 *
	else if ($method == "ws-create") {
		$temas = new model\Temas();
		$temas->setTema(logicNull($form[0]));
		$temas->setIdentificador(logicNull($form[1]));
		$temas->setCor_primaria(logicNull($form[2]));
		$temas->setCor_secundaria(logicNull($form[3]));
		$temas->setCor_texto(logicNull($form[4]));
		
		if (isset($_FILES["upload"])) {
			$upload = new getz\Upload($_FILES["upload"], 1800);
			$temas->setFoto($upload->getName());
		} else 
			$temas->setFoto("");
			
		$temas->setCadastrado(date("Y-m-d H:i:s", (time() - 3600 * 3)));
		$temas->setModificado(date("Y-m-d H:i:s", (time() - 3600 * 3)));
		
		$daoFactory->beginTransaction();
		$resultDao = $daoFactory->getTemasDao()->create($temas);

		if ($resultDao) {
			$daoFactory->commit();
			$response[0]["message"] = "success";
		} else {							
			$daoFactory->rollback();
			$response[0]["message"] = "error";
		}

		$daoFactory->close();

		echo $darth->json($response);
	}
	*/
	
	/*
	 * Read
	 *
	else if ($method == "ws-read") {
		$daoFactory->beginTransaction();
		$response[0]["temas"] = $daoFactory->getTemasDao()->read($where, $limit, false);
		$daoFactory->close();

		echo $darth->json($response[0]["temas"]);
	}
	*/
	
	/*
	 * Update
	 *
	else if ($method == "ws-update") {	
		$temas = new model\Temas();
		$temas->setId($code);
		$temas->setTema(logicNull($form[0]));
		$temas->setIdentificador(logicNull($form[1]));
		$temas->setCor_primaria(logicNull($form[2]));
		$temas->setCor_secundaria(logicNull($form[3]));
		$temas->setCor_texto(logicNull($form[4]));
		
		$where = "temas.id = " . $code;
		
		$daoFactory->beginTransaction();
		$temasDao = $daoFactory->getTemasDao()->read($where, "", false);
		$daoFactory->close();
			
		if (isset($_FILES["upload"])) {
			if ($temasDao[0]["temas.foto"] != "") {	
				unlink($_DOCUMENT_ROOT . "/res/img/mdpi/" . $temasDao[0]["temas.foto"]);
				unlink($_DOCUMENT_ROOT . "/res/img/hdpi/" . $temasDao[0]["temas.foto"]);
			}
			
			$upload = new getz\Upload($_FILES["upload"], 1800);
			$temas->setFoto($upload->getName());
		} else 
			$temas->setFoto($temasDao[0]["temas.foto"]);
			
		$temas->setCadastrado(date("Y-m-d H:i:s", (time() - 3600 * 3)));
		$temas->setModificado(date("Y-m-d H:i:s", (time() - 3600 * 3)));
		
		$daoFactory->beginTransaction();
		$resultDao = $daoFactory->getTemasDao()->update($temas);

		if ($resultDao) {
			$daoFactory->commit();
			$response[0]["message"] = "success";
		} else {							
			$daoFactory->rollback();
			$response[0]["message"] = "error";
		}

		$daoFactory->close();

		echo $darth->json($response);
	}
	*/
	
	/* 
	 * Delete
	 *
	else if ($method == "ws-delete") {
		$result = true;
		$lines = explode("<gz>", $code);

		$daoFactory->beginTransaction();

		for ($i = 0; $i < sizeof($lines); $i++) {
			$where = "temas.id = " . $lines[$i];
			
			$temasDao = $daoFactory->getTemasDao()->read($where, "", false);
			
			if ($temasDao[0]["temas.foto"] != "") {	
				unlink($_DOCUMENT_ROOT . "/res/img/mdpi/" . $temasDao[0]["temas.foto"]);
				unlink($_DOCUMENT_ROOT . "/res/img/hdpi/" . $temasDao[0]["temas.foto"]);
			}
			
			$resultDao = $daoFactory->getTemasDao()->delete($where);
			$result = !$result ? false : (!$resultDao ? false : true);
		}

		if ($result) {
			$daoFactory->commit();
			$response[0]["message"] = "success";
		} else {							
			$daoFactory->rollback();
			$response[0]["message"] = "error";
		}

		$daoFactory->close();

		echo $darth->json($response);
	} 	
	*/
	
	/**************************************************
	 * System
	 **************************************************/	
	
	else {
		if (!getActiveSession($_ROOT . $_MODULE)) 
			echo "<script>goTo(\"/login/1\");</script>";
		else {
			/*
			 * Create
			 */
			if ($method == "stateCreate") {
				if (!getPermission($_ROOT . $_MODULE, $daoFactory, $screen, $method))
					echo "<script>goTo(\"/login/1\");</script>";	
				else {
					$daoFactory->beginTransaction();
					$response[0]["titles"] = $daoFactory->getTelasDao()->read("telas.identificador = '" . $screen . "'", "", true);
					$daoFactory->close();

					echo $darth->view(getMenu($daoFactory, $_USER, $screen), $_DOCUMENT_ROOT . $_PACKAGE . "/html/menus/menusCST.htm");
					echo $darth->view($response, $_DOCUMENT_ROOT . $_PACKAGE . "/html/temas/temasCRT.htm");
				}
			}

			/*
			 * Read
			 */
			else if ($method == "stateRead") {
				if (!getPermission($_ROOT . $_MODULE, $daoFactory, $screen, $method))
					echo "<script>goTo(\"/login/1\");</script>";	
				else {
					$daoFactory->beginTransaction();
					$response[0]["titles"] = $daoFactory->getTelasDao()->read("telas.identificador = '" . $screen . "'", "", true);
					$response[0]["temas"] = $daoFactory->getTemasDao()->read($where, $limit, true);
					$daoFactory->close();

					echo $darth->view(getMenu($daoFactory, $_USER, $screen), $_DOCUMENT_ROOT . $_PACKAGE . "/html/menus/menusCST.htm");
					echo $darth->view($response, $_DOCUMENT_ROOT . $_PACKAGE . "/html/temas/temasRD.htm");
				}
			}

			/*
			 * Update
			 */
			else if ($method == "stateUpdate") {
				if (!getPermission($_ROOT . $_MODULE, $daoFactory, $screen, $method))
					echo "<script>goTo(\"/login/1\");</script>";	
				else {
					$daoFactory->beginTransaction();
					$response[0]["titles"] = $daoFactory->getTelasDao()->read("telas.identificador = '" . $screen . "'", "", true);
					$response[0]["temas"] = $daoFactory->getTemasDao()->read($where, "", true);
					$daoFactory->close();

					echo $darth->view(getMenu($daoFactory, $_USER, $screen), $_DOCUMENT_ROOT . $_PACKAGE . "/html/menus/menusCST.htm");
					echo $darth->view($response, $_DOCUMENT_ROOT . $_PACKAGE . "/html/temas/temasUPD.htm");
				}
			}

			/*
			 * Called
			 */
			else if ($method == "stateCalled") {
				if (!getPermission($_ROOT . $_MODULE, $daoFactory, $screen, $method))
					echo "<script>goTo(\"/login/1\");</script>";	
				else {
					/*
					 * Insert your foreign key here
					 */
					if ($where != "")
						$where .= " AND temas.@_FOREIGN_KEY = " . $base;
					else 
						$where = "temas.@_FOREIGN_KEY = " . $base;
						
					$daoFactory->beginTransaction();
					$response[0]["titles"] = $daoFactory->getTelasDao()->read("telas.identificador = '" . $screen . "'", "", true);
					$response[0]["temas"] = $daoFactory->getTemasDao()->read($where, $limit, true);
					$daoFactory->close();

					echo $darth->view(getMenu($daoFactory, $_USER, $screen), $_DOCUMENT_ROOT . $_PACKAGE . "/html/menus/menusCST.htm");
					echo $darth->view($response, $_DOCUMENT_ROOT . $_PACKAGE . "/html/temas/temasCLL.htm");
				}
			}

			/*
			 * Screen
			 */
			else if ($method == "screen") {
				if ($base != "") {
					$arrBase = explode("<gz>", $base);
					
					if (sizeof($arrBase) > 1)
						$where = "temas.@_FOREIGN_KEY = " . $arrBase[1];
				}
				
				$limit = "temas.id DESC LIMIT " . (($position * 5) - 5) . ", 5";

				$daoFactory->beginTransaction();
				$response[0]["titles"] = $daoFactory->getTelasDao()->read("telas.identificador = '" . $screen . "'", "", true);
				$response[0]["temas"] = $daoFactory->getTemasDao()->read($where, $limit, true);
				$daoFactory->close();

				echo $darth->view($response, $_DOCUMENT_ROOT . $_PACKAGE . "/html/temas/temasSCR.htm") . 
						"<size>" . $response[0]["temas"][0]["temas.size"] . "<theme>" . 
						$_USER[0]["usuarios"][0]["temas.identificador"];
			}

			/*
			 * Screen handler
			 */
			else if ($method == "screenHandler") {	
				$where = "";

				// Get value from combo
				$cmb = explode("<gz>", $search);

				if ($cmb[1] != "")
					$where = "temas.id = " . $cmb[1];

				$daoFactory->beginTransaction();
				$response[0]["temas"] = $daoFactory->getTemasDao()->comboScr($where);
				$daoFactory->close();

				echo $darth->view($response, $_DOCUMENT_ROOT . $_PACKAGE . "/html/temas/temasCMB.htm");
			}

			/*
			 * Create
			 */
			else if ($method == "create") {
				if (!getPermission($_ROOT . $_MODULE, $daoFactory, $screen, $method)) {
					$response[0]["message"] = "permission";
					
					echo $darth->json($response);
				} else {
					$temas = new model\Temas();
					$temas->setTema(logicNull($form[0]));
					$temas->setIdentificador(logicNull($form[1]));
					$temas->setCor_primaria(logicNull($form[2]));
					$temas->setCor_secundaria(logicNull($form[3]));
					$temas->setCor_texto(logicNull($form[4]));
					
					/*
					 * Upload File
					 */
					if (isset($_FILES["upload"])) {
						$upload = new getz\Upload($_FILES["upload"], 1800);
						$temas->setFoto($upload->getName());
					} else 
						$temas->setFoto("");
						
					$temas->setCadastrado(date("Y-m-d H:i:s", (time() - 3600 * 3)));
					$temas->setModificado(date("Y-m-d H:i:s", (time() - 3600 * 3)));
					
					$daoFactory->beginTransaction();
					$resultDao = $daoFactory->getTemasDao()->create($temas);

					if ($resultDao) {
						$id = $daoFactory->getConnection()->insertId();
						$temasDao = $daoFactory->getTemasDao()->read("temas.id = " . $id, "", false);
						
						$daoFactory->commit();
						$response[0]["message"] = "success";
				
						/*
						 * Write
						 */
						$buffer = file_get_contents("../../mod/cms/css/style.css");
						$find = "." . logicNull($form[1]) . "";
						$pos = strpos($buffer, $find);
					
						if ($pos === false) {
							$fo = fopen("../../mod/cms/css/style.css", "a");
							$fw = fwrite($fo, "

/*
 * " . logicNull($form[0]) . "
 *
 * @see http://mariosakamoto.com/getz/themes
 */ 						
." . logicNull($form[1]) . " { 
	background: url(\"../../../res/img/hdpi/" . $temasDao[0]["temas.foto"] . "\") no-repeat top center, linear-gradient(#" . 
			logicNull($form[3]) . ", #" . logicNull($form[2]) . "); 
	-webkit-background-size: cover;
	-moz-background-size: cover;
	-o-background-size: cover;
	background-size: cover;
	border: solid 1px #" . logicNull($form[2]) . ";
	color: #" . logicNull($form[4]) . " !important;
}

." . logicNull($form[1]) . ":hover { 
	background: url(\"../../../res/img/hdpi/" . $temasDao[0]["temas.foto"] . "\") no-repeat top center, linear-gradient(#" . 
			logicNull($form[3]) . ", #" . logicNull($form[2]) . "); 
	-webkit-background-size: cover;
	-moz-background-size: cover;
	-o-background-size: cover;
	background-size: cover;
	border: solid 1px #" . logicNull($form[2]) . ";
	color: #" . logicNull($form[4]) . " !important;
}");

							fclose($fo);
						}				
					} else {							
						$daoFactory->rollback();
						$response[0]["message"] = "error";
					}

					$daoFactory->close();

					echo $darth->json($response);
				}
			}

			/*
			 * Action update
			 */
			else if ($method == "update") {	
				if (!getPermission($_ROOT . $_MODULE, $daoFactory, $screen, $method)) {
					$response[0]["message"] = "permission";
					
					echo $darth->json($response);
				} else {
					$temas = new model\Temas();
					$temas->setId($code);
					$temas->setTema(logicNull($form[0]));
					$temas->setIdentificador(logicNull($form[1]));
					$temas->setCor_primaria(logicNull($form[2]));
					$temas->setCor_secundaria(logicNull($form[3]));
					$temas->setCor_texto(logicNull($form[4]));
					
					/*
					 * Get object
					 */
					$where = "temas.id = " . $code;
					
					$daoFactory->beginTransaction();
					$temasDao = $daoFactory->getTemasDao()->read($where, "", false);
					$daoFactory->close();
						
					/*
					 * Upload File
					 */
					if (isset($_FILES["upload"])) {
						if ($temasDao[0]["temas.foto"] != "") {	
							/*
							 * Unlink
							 */
							unlink($_DOCUMENT_ROOT . "/res/img/mdpi/" . $temasDao[0]["temas.foto"]);
							unlink($_DOCUMENT_ROOT . "/res/img/hdpi/" . $temasDao[0]["temas.foto"]);
						}
						
						$upload = new getz\Upload($_FILES["upload"], 1800);
						$temas->setFoto($upload->getName());
					} else 
						$temas->setFoto($temasDao[0]["temas.foto"]);
						
					$temas->setCadastrado(date("Y-m-d H:i:s", (time() - 3600 * 3)));
					$temas->setModificado(date("Y-m-d H:i:s", (time() - 3600 * 3)));
					
					$daoFactory->beginTransaction();
					$resultDao = $daoFactory->getTemasDao()->update($temas);

					if ($resultDao) {
						$daoFactory->commit();
						$response[0]["message"] = "success";
					} else {							
						$daoFactory->rollback();
						$response[0]["message"] = "error";
					}

					$daoFactory->close();

					echo $darth->json($response);
				}
			}
			
			/* 
			 * Action delete
			 */
			else if ($method == "delete") {
				if (!getPermission($_ROOT . $_MODULE, $daoFactory, $screen, $method)) {
					$response[0]["message"] = "permission";
					
					echo $darth->json($response);
				} else {
					$result = true;
					$lines = explode("<gz>", $code);

					$daoFactory->beginTransaction();

					for ($i = 1; $i < sizeof($lines); $i++) {
						$where = "temas.id = " . $lines[$i];
						
						/*
						 * Unlink
						 */
						$temasDao = $daoFactory->getTemasDao()->read($where, "", false);
						
						if ($temasDao[0]["temas.foto"] != "") {	
							unlink($_DOCUMENT_ROOT . "/res/img/mdpi/" . $temasDao[0]["temas.foto"]);
							unlink($_DOCUMENT_ROOT . "/res/img/hdpi/" . $temasDao[0]["temas.foto"]);
						}
						
						$resultDao = $daoFactory->getTemasDao()->delete($where);
						$result = !$result ? false : (!$resultDao ? false : true);
					}

					if ($result) {
						$daoFactory->commit();
						$response[0]["message"] = "success";
					} else {							
						$daoFactory->rollback();
						$response[0]["message"] = "error";
					}

					$daoFactory->close();

					echo $darth->json($response);	
				}
			}
		}
	}

?>