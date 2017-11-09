<?php
		class Medicoes  implements JsonSerializable{
			
		private $id;
		private $data_hora;
		private $altura_mar;
		private $humidade_ar;
		private $humidade_solo;
		private $pressao_ar;
		private $temperatura_ar;
		private $cadastrado;
		private $modificado;
			
		public function jsonSerialize() {
			return [
					'id' =>$this->getId(),
					'data_hora' =>$this->getData_hora(),
					'altura_mar' =>$this->getAltura_mar(),
					'humidade_ar' =>$this->getHumidade_ar(),
					'humidade_solo' =>$this->getHumidade_solo(),
					'pressao_ar' =>$this->getPressao_ar(),
					'temperatura_ar' =>$this->getTemperatura_ar()					
			];
		}
		
		
		//ID
		function getId() {
			return $this->id;
		}
		function setId($id) {	
			return $this->id = $id;
		}
		
		//DATA_HORA
		function getData_hora() {
			return $this->data_hora;
		}
		function setData_hora($data_hora) {	
			return $this->data_hora = $data_hora;
		}
		
		//ALTURA_MAR
		function getAltura_mar() {
			return $this->altura_mar;
		}
		function setAltura_mar($altura_mar) {	
			return $this->altura_mar = $altura_mar;
		}
		
		//HUMIDADE_AR
		function getHumidade_ar() {
			return $this->humidade_ar;
		}
		function setHumidade_ar($humidade_ar) {	
			return $this->humidade_ar = $humidade_ar;
		}
		
		//HUMIDADE_SOLO
		function getHumidade_solo() {
			return $this->humidade_solo;
		}
		function setHumidade_solo($humidade_solo) {	
			return $this->humidade_solo = $humidade_solo;
		}
		
		//PRESSAO_AR
		function getPressao_ar() {
			return $this->pressao_ar;
		}
		function setPressao_ar($pressao_ar) {	
			return $this->pressao_ar = $pressao_ar;
		}
		
		//TEMPERATURA_AR
		function getTemperatura_ar() {
			return $this->temperatura_ar;
		}
		function setTemperatura_ar($temperatura_ar) {	
			return $this->temperatura_ar = $temperatura_ar;
		}
		
		//CADASTRADO
		function getCadastrado() {
			return $this->cadastrado;
		}
		function setCadastrado($cadastrado) {	
			return $this->cadastrado = $cadastrado;
		}
		
		//MODIFICADO
		function getModificado() {
			return $this->modificado;
		}
		function setModificado($modificado) {	
			return $this->modificado = $modificado;
		}
		
	}
?>