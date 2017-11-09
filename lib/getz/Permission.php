<?php

	/**
	 * Permission
	 * 
	 * @author Mário Sakamoto <mskamot@gmail.com>
	 * @see http://mariosakamoto.com/getz
	 */

	/**
	 * @param {String} module
	 * @param {Object} daoFactory
	 * @param {String} tela
	 * @param {String} method
	 * @return {Boolean}
	 */
	function getPermission($module, $daoFactory, $tela, $method) {
		$permissao = false;
		$permissaoCondition = "";
		$usuarios = getUserSession($module);

		if ($method == "stateCreate" || $method == "create") {
			$permissaoCondition = 
					"(permissoes.id = 2 OR permissoes.id = 3 OR permissoes.id = 4) AND " .
					"usuarios.id = " . $usuarios[0]["usuarios.id"] . " AND " .
					"telas.identificador = '" . $tela . "'";
		} else if ($method == "stateRead" || $method == "stateCalled") {
			$permissaoCondition =
					"usuarios.id = " . $usuarios[0]["usuarios.id"] . " AND " .
					"telas.identificador = '" . $tela . "'";
		} else if ($method == "stateUpdate" || $method == "update") {
			$permissaoCondition = 
					"(permissoes.id = 3 OR permissoes.id = 4) AND " .
					"usuarios.id = " . $usuarios[0]["usuarios.id"] . " AND " .
					"telas.identificador = '" . $tela . "'";
		} else if ($method == "delete") {
			$permissaoCondition = 
					"(permissoes.id = 4) AND " .
					"usuarios.id = " . $usuarios[0]["usuarios.id"] . " AND " .
					"telas.identificador = '" . $tela . "'";
		}

		$sql = "SELECT " . 
					"permissoes.id AS 'permissoes.id' " . 
				"FROM " .
					"usuarios usuarios, " .
					"perfis perfis, " .
					"telas telas, " .
					"perfil_telas perfil_telas, " .
					"permissoes permissoes, " .
					"status status " .
				"WHERE " .
					"usuarios.perfil = perfis.id AND " .
					"perfis.id = perfil_telas.perfil AND " .
					"perfil_telas.tela = telas.id AND " .
					"perfil_telas.permissao = permissoes.id AND " .
					"usuarios.status = status.id AND " .
					"status.id = 1 AND " .
					$permissaoCondition;

		$daoFactory->beginTransaction();						
		$result = $daoFactory->getConnection()->execute($sql);

		while ($row = $result->fetch_assoc()) {
			$permissao = true;
		}
		
		$daoFactory->getConnection()->free($result);
		$daoFactory->close();
		
		return $permissao;
	}
	
	/**
	 * @param {Object} daoFactory
	 * @param {Object} user
	 * @param {String} screen 
	 * @return {Array}
	 */
	function getMenu($daoFactory, $user, $screen) {
		$response[0]["usuarios"][0]["usuarios.foto"] = $user[0]["usuarios"][0]["usuarios.foto"];
		$response[0]["cadastros"] = getMenuItem($daoFactory, $user, $screen, 2);
		$response[0]["configuracoes"] = getMenuItem($daoFactory, $user, $screen, 3);
		
		/* Insert your code here */

		return $response;
	}

	/**
	 * @param {Object} daoFactory
	 * @param {Object} user
	 * @param {String} screen
	 * @param {Integer} menu
	 * @return {Array}
	 */
	function getMenuItem($daoFactory, $user, $screen, $menu) {
		$response = null;
		$line = 0;

		$sql = "SELECT " . 
					"telas.tela AS 'telas.tela', " . 
					"telas.identificador AS 'telas.identificador' " . 
				"FROM " .
					"usuarios usuarios, " .
					"perfis perfis, " .
					"telas telas, " .
					"perfil_telas perfil_telas, " .
					"status status, " .
					"menus menus " .
				"WHERE " .
					"usuarios.perfil = perfis.id AND " .
					"perfis.id = perfil_telas.perfil AND " .
					"perfil_telas.tela = telas.id AND " .
					"usuarios.status = status.id AND " .
					"status.id = 1 AND " .
					"usuarios.id = " . $user[0]["usuarios"][0]["usuarios.id"] . " AND " .
					"telas.menu = menus.id AND " .
					"telas.menu = " . $menu . " " .
				"ORDER BY " .
					"telas.tela ASC";

		$daoFactory->beginTransaction();						
		$result = $daoFactory->getConnection()->execute($sql);

		while ($row = $result->fetch_assoc()) {
			$response[$line]["telas.tela"] = $row["telas.tela"];
			$response[$line]["telas.identificador"] = $row["telas.identificador"];
			
			if ($screen == $row["telas.identificador"]) 
				$response[$line]["telas.selected"] = $user[0]["usuarios"][0]["temas.identificador"];
			
			$line++;
		}

		$daoFactory->getConnection()->free($result);
		$daoFactory->close();

		return $response;
	}

?>