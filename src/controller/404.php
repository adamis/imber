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
		$darth->setTitle($screen);
		$darth->setDescription("");
		$darth->setKeywords("");
		
		echo $darth->view("", $_DOCUMENT_ROOT . "/lib/getz/404.htm");
	}

?>