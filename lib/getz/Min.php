<?php

	/**
	 * Min
	 * 
	 * @author Mário Sakamoto <mskamot@gmail.com>
	 * @see http://mariosakamoto.com/getz
	 */

	namespace lib\getz;
	
	class Min {
	
		/**
		 * @param {String} open
		 * @param {String} write
		 */
		public function __construct($open, $write) { 
			$lines = file ($open);
			$min = "";
			
			foreach ($lines as $line_num => $line) {
				$min .= str_replace(" ", "", trim(preg_replace("@[\n\r]@s","", $line)));
			}

			$fo = fopen($write, "w");
			$fw = fwrite($fo, $min);	
			fclose($fo);
		}
		
	}
	
?>