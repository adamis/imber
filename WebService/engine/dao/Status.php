<?php
	class Status{
			
		private $id;
		private $status;
		private $cadastrado;
		private $modificado;
			
		//ID
		function getId() {
			return $this->id;
		}
		function setId($id) {	
			return $this->id = $id;
		}
		
		//STATUS
		function getStatus() {
			return $this->status;
		}
		function setStatus($status) {	
			return $this->status = $status;
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