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
	 * Logout
	 */
	if ($method == "logout") {
		closeSession($_ROOT . $_MODULE);
		
		$response[0]["message"] = "success";

		echo $darth->json($response);
	}

?>