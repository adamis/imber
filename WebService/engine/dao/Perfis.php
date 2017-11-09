<?php
	class Perfis{
			
		private $id;
		private $perfil;
		private $cadastrado;
		private $modificado;
			
		//ID
		function getId() {
			return $this->id;
		}
		function setId($id) {	
			return $this->id = $id;
		}
		
		//PERFIL
		function getPerfil() {
			return $this->perfil;
		}
		function setPerfil($perfil) {	
			return $this->perfil = $perfil;
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