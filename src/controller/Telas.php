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
		$where = "telas.tela LIKE \"%" . $search . "%\"";	
		
	if ($code != "")
		$where = "telas.id = " . $code;
		
	if ($order != "") {
		$o = explode("<gz>", $order);

		$limit = $o[0] . " " . $o[1] . " LIMIT " . 
				(($position * $itensPerPage) - $itensPerPage) . ", " . $itensPerPage;
				
	} else
		$limit = "telas.id DESC LIMIT " . 
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
		$response[0]["telas"] = $daoFactory->getTelasDao()->read($where, $limit, true);
		$daoFactory->close();

		echo $darth->view("", $_DOCUMENT_ROOT . $_PACKAGE . "/html/header.htm");
		echo $darth->view($response, $_DOCUMENT_ROOT . $_PACKAGE . "/html/telas.htm");
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
		$telas = new model\Telas();
		$telas->setTela(logicNull($form[0]));
		$telas->setIdentificador(logicNull($form[1]));
		$telas->setCadastrado(date("Y-m-d H:i:s", (time() - 3600 * 3)));
		$telas->setModificado(date("Y-m-d H:i:s", (time() - 3600 * 3)));
		$telas->setMenu($form[2]);
		
		$daoFactory->beginTransaction();
		$resultDao = $daoFactory->getTelasDao()->create($telas);

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
		$response[0]["telas"] = $daoFactory->getTelasDao()->read($where, $limit, false);
		$daoFactory->close();

		echo $darth->json($response[0]["telas"]);
	}
	*/
	
	/*
	 * Update
	 *
	else if ($method == "ws-update") {	
		$telas = new model\Telas();
		$telas->setId($code);
		$telas->setTela(logicNull($form[0]));
		$telas->setIdentificador(logicNull($form[1]));
		$telas->setCadastrado(date("Y-m-d H:i:s", (time() - 3600 * 3)));
		$telas->setModificado(date("Y-m-d H:i:s", (time() - 3600 * 3)));
		$telas->setMenu($form[2]);
		
		$daoFactory->beginTransaction();
		$resultDao = $daoFactory->getTelasDao()->update($telas);

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
			$where = "telas.id = " . $lines[$i];
			
			$resultDao = $daoFactory->getTelasDao()->delete($where);
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
					echo $darth->view($response, $_DOCUMENT_ROOT . $_PACKAGE . "/html/telas/telasCRT.htm");
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
					$response[0]["telas"] = $daoFactory->getTelasDao()->read($where, $limit, true);
					$daoFactory->close();

					echo $darth->view(getMenu($daoFactory, $_USER, $screen), $_DOCUMENT_ROOT . $_PACKAGE . "/html/menus/menusCST.htm");
					echo $darth->view($response, $_DOCUMENT_ROOT . $_PACKAGE . "/html/telas/telasRD.htm");
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
					$response[0]["telas"] = $daoFactory->getTelasDao()->read($where, "", true);
					$daoFactory->close();

					echo $darth->view(getMenu($daoFactory, $_USER, $screen), $_DOCUMENT_ROOT . $_PACKAGE . "/html/menus/menusCST.htm");
					echo $darth->view($response, $_DOCUMENT_ROOT . $_PACKAGE . "/html/telas/telasUPD.htm");
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
						$where .= " AND telas.@_FOREIGN_KEY = " . $base;
					else 
						$where = "telas.@_FOREIGN_KEY = " . $base;
						
					$daoFactory->beginTransaction();
					$response[0]["titles"] = $daoFactory->getTelasDao()->read("telas.identificador = '" . $screen . "'", "", true);
					$response[0]["telas"] = $daoFactory->getTelasDao()->read($where, $limit, true);
					$daoFactory->close();

					echo $darth->view(getMenu($daoFactory, $_USER, $screen), $_DOCUMENT_ROOT . $_PACKAGE . "/html/menus/menusCST.htm");
					echo $darth->view($response, $_DOCUMENT_ROOT . $_PACKAGE . "/html/telas/telasCLL.htm");
				}
			}

			/*
			 * Screen
			 */
			else if ($method == "screen") {
				$where = "telas.id NOT IN(" . 
						"SELECT " . 
							"perfil_telas.tela AS 'perfil_telas.tela' " . 
						"FROM " . 
							"perfil_telas perfil_telas " .
						"WHERE " .
							"perfil_telas.perfil = " . $base . 
						")";				
				
				if ($base != "") {
					$arrBase = explode("<gz>", $base);
					
					if (sizeof($arrBase) > 1)
						$where = "telas.@_FOREIGN_KEY = " . $arrBase[1];
				}
				
				if ($search != "")
					if ($where != "")
						$where .= " AND telas.tela LIKE \"%" . $search . "%\"";	
					else
						$where = "telas.tela LIKE \"%" . $search . "%\"";	
				
				
				$limit = "telas.id DESC LIMIT " . (($position * 5) - 5) . ", 5";

				$daoFactory->beginTransaction();
				$response[0]["titles"] = $daoFactory->getTelasDao()->read("telas.identificador = '" . $screen . "'", "", true);
				$response[0]["telas"] = $daoFactory->getTelasDao()->read($where, $limit, true);
				$daoFactory->close();

				echo $darth->view($response, $_DOCUMENT_ROOT . $_PACKAGE . "/html/telas/telasSCR.htm") . 
						"<size>" . $response[0]["telas"][0]["telas.size"] . "<theme>" . 
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
					$where = "telas.id = " . $cmb[1];

				$daoFactory->beginTransaction();
				$response[0]["telas"] = $daoFactory->getTelasDao()->comboScr($where);
				$daoFactory->close();

				echo $darth->view($response, $_DOCUMENT_ROOT . $_PACKAGE . "/html/telas/telasCMB.htm");
			}

			/*
			 * Create
			 */
			else if ($method == "create") {
				if (!getPermission($_ROOT . $_MODULE, $daoFactory, $screen, $method)) {
					$response[0]["message"] = "permission";
					
					echo $darth->json($response);
				} else {
					$telas = new model\Telas();
					$telas->setTela(logicNull($form[0]));
					$telas->setIdentificador(logicNull($form[1]));
					$telas->setCadastrado(date("Y-m-d H:i:s", (time() - 3600 * 3)));
					$telas->setModificado(date("Y-m-d H:i:s", (time() - 3600 * 3)));
					$telas->setMenu($form[2]);
					
					$daoFactory->beginTransaction();
					$resultDao = $daoFactory->getTelasDao()->create($telas);

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
			 * Action update
			 */
			else if ($method == "update") {	
				if (!getPermission($_ROOT . $_MODULE, $daoFactory, $screen, $method)) {
					$response[0]["message"] = "permission";
					
					echo $darth->json($response);
				} else {
					$telas = new model\Telas();
					$telas->setId($code);
					$telas->setTela(logicNull($form[0]));
					$telas->setIdentificador(logicNull($form[1]));
					$telas->setCadastrado(date("Y-m-d H:i:s", (time() - 3600 * 3)));
					$telas->setModificado(date("Y-m-d H:i:s", (time() - 3600 * 3)));
					$telas->setMenu($form[2]);
					
					$daoFactory->beginTransaction();
					$resultDao = $daoFactory->getTelasDao()->update($telas);

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
						$where = "telas.id = " . $lines[$i];
						
						$resultDao = $daoFactory->getTelasDao()->delete($where);
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