<?php

	/**
	 * Log
	 * 
	 * @author Mário Sakamoto <mskamot@gmail.com>
	 * @see http://mariosakamoto.com/getz
	 */
	 
	namespace lib\getz;

	class Log {
	
		public function __construct() { }
		
		public function write($name, $log) { 
			$fo = fopen("../../_log/log.txt", "a");
			
			$fw = fwrite($fo, "Date: " . date("Y-m-d H:i:s") . "
LOG [" . $name . "]: " . $log . "

");

			fclose($fo);
		}
		
	}

?>