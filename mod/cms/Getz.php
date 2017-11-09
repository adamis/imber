<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//PT" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" oncontextmenu="return false" onselectstart="return false">
	<head>
		<?php 
			require_once("../../Autoload.php"); 
			require_once("../../lib/getz/Parameters.php");
		?>
		
		<title>CMS - <?php echo ucfirst($_GET["screen"]); ?></title>

		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<meta http-equiv="content-language" content="en">
		
		<meta name="title" content="">
		<meta name="description" content="">
	  	<meta name="keywords" content="">
		<meta name="author" content="Getz Framework">
		<meta name="generator" content="Getz Framework">	
		<meta name="robots" content="noindex, nofollow">
		
		<link rel="icon" type="image/png" href="<?php echo $_ROOT; ?>/res/img/ldpi/icon-getz.png" sizes="16x16">
		
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,700">
		<link rel="stylesheet" href="<?php echo $_ROOT; ?>/res/css/divmon-1.0.0.css">	
		<link rel="stylesheet" href="<?php echo $_ROOT; ?>/res/css/gzstan-1.0.0.css">
		<link rel="stylesheet" href="<?php echo $_ROOT . $_PACKAGE; ?>/css/style.css">
		
		<script charset="UTF-8" src="<?php echo $_ROOT ?>/res/js/jsmin-1.0.0.js"></script>
		<script charset="UTF-8" src="<?php echo $_ROOT ?>/res/js/gzcon2-1.0.0.js"></script>
		<script charset="UTF-8" src="<?php echo $_ROOT . $_PACKAGE; ?>/js/handler.js"></script>
		<script charset="UTF-8" src="<?php echo $_ROOT . $_PACKAGE; ?>/js/ext.js"></script>
	</head>

	<body>
		<?php require_once("../../src/controller/" . ucfirst($_GET["screen"]) . ".php"); ?>
		
		<div id="gz-block"></div>
		<div id="gz-screen"></div>
		<div id="gz-message"></div>
		<div id="gz-loading"></div>
	</body>
</html>