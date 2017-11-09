<?php
	class Telas{
			
		private $id;
		private $tela;
		private $identificador;
		private $cadastrado;
		private $modificado;
		private $menu;
			
		//ID
		function getId() {
			return $this->id;
		}
		function setId($id) {	
			return $this->id = $id;
		}
		
		//TELA
		function getTela() {
			return $this->tela;
		}
		function setTela($tela) {	
			return $this->tela = $tela;
		}
		
		//IDENTIFICADOR
		function getIdentificador() {
			return $this->identificador;
		}
		function setIdentificador($identificador) {	
			return $this->identificador = $identificador;
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
		
		//MENU
		function getMenu() {
			return $this->menu;
		}
		function setMenu($menu) {	
			return $this->menu = $menu;
		}
		
	}
?>