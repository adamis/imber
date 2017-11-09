<?php

	/**
	 * Permission
	 * 
	 * @author Mário Sakamoto <mskamot@gmail.com>
	 * @see http://mariosakamoto.com/getz
	 * @since 2014-07-26
	 */

	/**
	 * @param {String} module
	 * @param {Object} daoFactory
	 * @param {String} screen
	 * @param {String} method
	 * @return {Boolean}
	 */
	function getPermission($module, $daoFactory, $screen, $method) {
		$permission = false;
		$permissionCondition = "";
		$users = getUserSession($module);

		if ($method == "stateCreate" || $method == "create") {
			$permissionCondition = 
					"(permissions.id = 2 OR permissions.id = 3 OR permissions.id = 4) AND " .
					"users.id = " . $users[0]["users.id"] . " AND " .
					"screens.identifier = '" . $screen . "'";
		} else if ($method == "stateRead" || $method == "stateCalled") {
			$permissionCondition =
					"users.id = " . $users[0]["users.id"] . " AND " .
					"screens.identifier = '" . $screen . "'";
		} else if ($method == "stateUpdate" || $method == "update") {
			$permissionCondition = 
					"(permissions.id = 3 OR permissions.id = 4) AND " .
					"users.id = " . $users[0]["users.id"] . " AND " .
					"screens.identifier = '" . $screen . "'";
		} else if ($method == "delete") {
			$permissionCondition = 
					"(permissions.id = 4) AND " .
					"users.id = " . $users[0]["users.id"] . " AND " .
					"screens.identifier = '" . $screen . "'";
		}

		$sql = "SELECT " . 
					"permissions.id AS 'permissions.id' " . 
				"FROM " .
					"users users, " .
					"profiles profiles, " .
					"screens screens, " .
					"profile_screens profile_screens, " .
					"permissions permissions, " .
					"status status " .
				"WHERE " .
					"users.profile = profiles.id AND " .
					"profiles.id = profile_screens.profile AND " .
					"profile_screens.screen = screens.id AND " .
					"profile_screens.permission = permissions.id AND " .
					"users.status = status.id AND " .
					"status.id = 1 AND " .
					$permissionCondition;

		$daoFactory->beginTransaction();						
		$result = $daoFactory->getConnection()->execute($sql);

		while ($row = $result->fetch_assoc()) {
			$permission = true;
		}
		
		$daoFactory->getConnection()->free($result);
		$daoFactory->close();
		
		return $permission;
	}
	
	/**
	 * @param {Object} daoFactory
	 * @param {Object} user
	 * @param {String} screen	
	 * @return {Array}
	 */
	function getMenu($daoFactory, $user, $screen) {
		$response[0]["users"][0]["users.photo"] = $user[0]["users"][0]["users.photo"];
		$response[0]["registrations"] = getMenuItem($daoFactory, $user, $screen, 2);
		$response[0]["configurations"] = getMenuItem($daoFactory, $user, $screen, 3);
		
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
					"screens.screen AS 'screens.screen', " . 
					"screens.identifier AS 'screens.identifier' " . 
				"FROM " .
					"users users, " .
					"profiles profiles, " .
					"screens screens, " .
					"profile_screens profile_screens, " .
					"status status, " .
					"menus menus " .
				"WHERE " .
					"users.profile = profiles.id AND " .
					"profiles.id = profile_screens.profile AND " .
					"profile_screens.screen = screens.id AND " .
					"users.status = status.id AND " .
					"status.id = 1 AND " .
					"users.id = " . $user[0]["users"][0]["users.id"] . " AND " .
					"screens.menu = menus.id AND " .
					"screens.menu = " . $menu . " " .
				"ORDER BY " .
					"screens.screen ASC";

		$daoFactory->beginTransaction();						
		$result = $daoFactory->getConnection()->execute($sql);

		while ($row = $result->fetch_assoc()) {
			$response[$line]["screens.screen"] = $row["screens.screen"];
			$response[$line]["screens.identifier"] = $row["screens.identifier"];
			
			if ($screen == $row["screens.identifier"]) 
				$response[$line]["screens.selected"] = $user[0]["users"][0]["themes.identifier"];
			
			$line++;
		}

		$daoFactory->getConnection()->free($result);
		$daoFactory->close();

		return $response;
	}

?>