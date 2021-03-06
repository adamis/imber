<?php
date_default_timezone_set('America/Sao_Paulo');
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
		
		
		$daoFactory->beginTransaction();
		$response[0]["titles"] = $daoFactory->getTelasDao()->read("telas.identificador = '" . $screen . "'", "", true);
		
		$first[11] = date("Y-m-01");
		$first[10] = date("Y-m-01", strtotime("-1 months", strtotime(date("Y-m-d"))));
		$first[9] = date("Y-m-01", strtotime("-2 months", strtotime(date("Y-m-d"))));
		$first[8] = date("Y-m-01", strtotime("-3 months", strtotime(date("Y-m-d"))));
		$first[7] = date("Y-m-01", strtotime("-4 months", strtotime(date("Y-m-d"))));
		$first[6] = date("Y-m-01", strtotime("-5 months", strtotime(date("Y-m-d"))));
		$first[5] = date("Y-m-01", strtotime("-6 months", strtotime(date("Y-m-d"))));
		$first[4] = date("Y-m-01", strtotime("-7 months", strtotime(date("Y-m-d"))));
		$first[3] = date("Y-m-01", strtotime("-8 months", strtotime(date("Y-m-d"))));
		$first[2] = date("Y-m-01", strtotime("-9 months", strtotime(date("Y-m-d"))));
		$first[1] = date("Y-m-01", strtotime("-10 months", strtotime(date("Y-m-d"))));
		$first[0] = date("Y-m-01", strtotime("-11 months", strtotime(date("Y-m-d"))));
		
		$last[11] = date("Y-m-t", strtotime($first[11]));
		$last[10] = date("Y-m-t", strtotime($first[10]));
		$last[9] = date("Y-m-t", strtotime($first[9]));
		$last[8] = date("Y-m-t", strtotime($first[8]));
		$last[7] = date("Y-m-t", strtotime($first[7]));
		$last[6] = date("Y-m-t", strtotime($first[6]));
		$last[5] = date("Y-m-t", strtotime($first[5]));
		$last[4] = date("Y-m-t", strtotime($first[4]));
		$last[3] = date("Y-m-t", strtotime($first[3]));
		$last[2] = date("Y-m-t", strtotime($first[2]));
		$last[1] = date("Y-m-t", strtotime($first[1]));
		$last[0] = date("Y-m-t", strtotime($first[0]));
		
		/*
		 * Mensais
		 */
		for ($i = 0; $i < sizeof($first); $i++) {
			/*
			 * Medicoes
			 */
			$where = "medicoes.data_hora >= '" . $first[$i] . 
					"' AND medicoes.data_hora <= '" . $last[$i] . "'";	
					
			$medicoesDao = $daoFactory->getMedicoesDao()->read($where, "", true);
			
			$medicoes = 1;
			$temperaturas = 0;
			$pressoes = 0;
			$humidades = 0;
			$solos = 0;
			$alturas = 0;
			
			for ($x = 0; $x < sizeof($medicoesDao); $x++) {
				$medicoes++;
				
				$temperaturas += controllerDouble($medicoesDao[$x]["medicoes.temperatura_ar"]);
				$pressoes += controllerDouble($medicoesDao[$x]["medicoes.pressao_ar"]);
				$humidades += controllerDouble($medicoesDao[$x]["medicoes.humidade_ar"]);
				$solos += controllerDouble($medicoesDao[$x]["medicoes.humidade_solo"]);
				$alturas += controllerDouble($medicoesDao[$x]["medicoes.altura_mar"]);
			}
			
			if ($medicoes > 1)
				$medicoes--;
			
			$temperaturasMedia = modelDouble($temperaturas / $medicoes);
			$pressoesMedia = modelDouble($pressoes / $medicoes);
			$humidadesMedia = modelDouble($humidades / $medicoes);
			$solosMedia = modelDouble($solos / $medicoes);
			$alturasMedia = modelDouble($alturas / $medicoes);
			
			/*
			 * Temperaturas
			 */
			$response[0]["temperaturas"][$i]["temperaturas.subtotal"] = 
					(($i > 0 ? ",'" : "'") . ($temperaturas == 0 ? 0 . "'" : controllerDouble($temperaturasMedia) . "'"));
					
			$response[0]["temperaturas"][$i]["temperaturas.month"] = ($i > 0 ? ",'" : "'") . getMounth($first[$i]) . "'";
			
			/*
			 * Pressoes
			 */
			$response[0]["pressoes"][$i]["pressoes.subtotal"] = 
					(($i > 0 ? ",'" : "'") . ($pressoes == 0 ? 0 . "'" : controllerDouble($pressoesMedia) . "'"));
					
			$response[0]["pressoes"][$i]["pressoes.month"] = ($i > 0 ? ",'" : "'") . getMounth($first[$i]) . "'";
			
			/*
			 * Humidades
			 */
			$response[0]["humidades"][$i]["humidades.subtotal"] = 
					(($i > 0 ? ",'" : "'") . ($humidades == 0 ? 0 . "'" : controllerDouble($humidadesMedia) . "'"));
					
			$response[0]["humidades"][$i]["humidades.month"] = ($i > 0 ? ",'" : "'") . getMounth($first[$i]) . "'";	
			
			/*
			 * Solos
			 */
			$response[0]["solos"][$i]["solos.subtotal"] = 
					(($i > 0 ? ",'" : "'") . ($solos == 0 ? 0 . "'" : controllerDouble($solosMedia) . "'"));
					
			$response[0]["solos"][$i]["solos.month"] = ($i > 0 ? ",'" : "'") . getMounth($first[$i]) . "'";	
			
			/*
			 * Alturas
			 */
			$response[0]["alturas"][$i]["alturas.subtotal"] = 
					(($i > 0 ? ",'" : "'") . ($alturas == 0 ? 0 . "'" : controllerDouble($alturasMedia) . "'"));
					
			$response[0]["alturas"][$i]["alturas.month"] = ($i > 0 ? ",'" : "'") . getMounth($first[$i]) . "'";	
		}
		
		$hora = date('H');
		
		$mes = date("m");
		$ano = date("Y");
		$dia = date("d");
		
		$where = " HOUR(medicoes.data_hora) =".$hora." AND data_hora BETWEEN '".$ano."/".$mes."/".$dia." 00:00:00' and '".$ano."/".$mes."/".$dia." 23:59:59'";			
		//echo $where;
		$medicoesDao = $daoFactory->getMedicoesDao()->read($where, "medicoes.id DESC ", false);
		if(sizeof($medicoesDao) > 0){
			$hora++;
		}
		
		//TODO
		
		//echo "Hora: ".$hora;
		/*
		 * Altura_mar
		 */				
		$arr = getList($daoFactory,$hora,"altura_mar");
		//print_r($arr);
		$horaAtual = $hora;
		$horaMinima = $horaAtual - 12;
		
		
		for ($x = 0; $x < sizeof($arr); $x++) {				
			//echo "X: ".$x;
			$temperaturas = $arr[$x];
			
			$response[0]["altura_mar"][$x]["altura_mar.subtotal"] = 
				(($x > 0 ? ",'" : "'") . ($temperaturas == 0 ? 0 . "'" : controllerDouble(modelDouble($temperaturas)) . "'"));
		
			$response[0]["altura_mar"][$x]["altura_mar.month"] = ($x > 0 ? ",'" : "'") . 
					(($horaMinima+$x)<0?($horaMinima+$x)+24:($horaMinima+$x)).":00". "'";	
		}
		
		/*
		 * humidade_ar
		 */				
		$arr = getList($daoFactory,$hora,"humidade_ar");
		//print_r($arr);
		$horaAtual = $hora;
		$horaMinima = $horaAtual - 12;
		
		
		for ($x = 0; $x < sizeof($arr); $x++) {				
			//echo "X: ".$x;
			$temperaturas = $arr[$x];
						
			$response[0]["humidade_ar"][$x]["humidade_ar.subtotal"] = 
				(($x > 0 ? ",'" : "'") . ($temperaturas == 0 ? 0 . "'" : controllerDouble(modelDouble($temperaturas)) . "'"));
		
			$response[0]["humidade_ar"][$x]["humidade_ar.month"] = ($x > 0 ? ",'" : "'") . 
					(($horaMinima+$x)<0?($horaMinima+$x)+24:($horaMinima+$x)).":00". "'";	
		}
		
		/*
		 * humidade_solo
		 */	
		$arr = getList($daoFactory,$hora,"humidade_solo");
		//print_r($arr);
		$horaAtual = $hora;
		$horaMinima = $horaAtual - 12;
		
		
		for ($x = 0; $x < sizeof($arr); $x++) {				
			//echo "X: ".$x;
			$temperaturas = $arr[$x];
			//echo $temperaturas."<br>";
			
			$response[0]["humidade_solo"][$x]["humidade_solo.subtotal"] = 
				(($x > 0 ? ",'" : "'") . ($temperaturas == 0 ? 0 . "'" : controllerDouble(modelDouble($temperaturas)) . "'"));
		
			$response[0]["humidade_solo"][$x]["humidade_solo.month"] = ($x > 0 ? ",'" : "'") . 
					(($horaMinima+$x)<0?($horaMinima+$x)+24:($horaMinima+$x)).":00" . "'";	
		}
		

		/*
		 * pressao_ar
		 */	
		$arr = getList($daoFactory,$hora,"pressao_ar");
		//print_r($arr);
		$horaAtual = $hora;
		$horaMinima = $horaAtual - 12;
		
		
		for ($x = 0; $x < sizeof($arr); $x++) {				
			//echo "X: ".$x;
			$temperaturas = $arr[$x];
			
			$response[0]["pressao_ar"][$x]["pressao_ar.subtotal"] = 
				(($x > 0 ? ",'" : "'") . ($temperaturas == 0 ? 0 . "'" : controllerDouble(modelDouble($temperaturas)) . "'"));
		
			$response[0]["pressao_ar"][$x]["pressao_ar.month"] = ($x > 0 ? ",'" : "'") . 
					(($horaMinima+$x)<0?($horaMinima+$x)+24:($horaMinima+$x)).":00" . "'";	
		}
		
		/*
		 * temperatura_ar
		 */				
		$arr = getList($daoFactory,$hora,"temperatura_ar");
		//print_r($arr);
		$horaAtual = $hora;
		$horaMinima = $horaAtual - 12;
		
		
		for ($x = 0; $x < sizeof($arr); $x++) {				
			//echo "X: ".$x;
			$temperaturas = $arr[$x];
			
			$response[0]["temperatura_ar"][$x]["temperatura_ar.subtotal"] = 
				(($x > 0 ? ",'" : "'") . ($temperaturas == 0 ? 0 . "'" : controllerDouble(modelDouble($temperaturas)) . "'"));
		
			$response[0]["temperatura_ar"][$x]["temperatura_ar.month"] = ($x > 0 ? ",'" : "'") . 
					(($horaMinima+$x)<0?($horaMinima+$x)+24:($horaMinima+$x)).":00". "'";	
		}
		
		
			
		$daoFactory->close();

		
		echo $darth->view("", $_DOCUMENT_ROOT . $_PACKAGE . "/html/header.htm");
		echo $darth->view($response, $_DOCUMENT_ROOT . $_PACKAGE . "/html/tempo_hoje.htm");
		echo $darth->view("", $_DOCUMENT_ROOT . $_PACKAGE . "/html/footer.htm");
	}
	
	function getList($daoFactory,$horaAtual,$column){
	
		$horaMinima = $horaAtual - 12;
		//echo "ATUAL> ".$horaAtual." MIN> ".$horaMinima."<br>";
		$addCount = 0;
				
		$mes = date("m");
		$ano = date("Y");
				
		for($h = $horaMinima; $h < $horaAtual; $h++){			
			$dia = date("d");
			
			if($h<0){
				$b = 24+$h;
				if($dia <= 1 ){					
					$dia = getLastDay(($mes-1),$ano);
				}else{
					$dia = $dia-1;
				}				
			}else{
				$b = $h;
			}
			
			//echo "DIA> ".$b;
			
			$where = " HOUR(medicoes.data_hora) =".$b." AND data_hora BETWEEN '".$ano."/".$mes."/".$dia." 00:00:00' and '".$ano."/".$mes."/".$dia." 23:59:59'";			
			$medicoesDao = $daoFactory->getMedicoesDao()->read($where, "medicoes.id DESC ", false);
			$calc = 0;
			for ($x = 0; $x < sizeof($medicoesDao); $x++) {				
				$calc += controllerDouble($medicoesDao[$x]["medicoes.".$column]);				
			}
			//debug_to_console("CALC: ".$calc);
			
			if(sizeof($medicoesDao) > 0){
				$arr[$addCount] = $calc / sizeof($medicoesDao);
			}else{
				$arr[$addCount] = 0;
			}
			$addCount++;
		}		
		//echo "<br>------------------ RETORNO ------------------<br>";
		return $arr;
	}

?>