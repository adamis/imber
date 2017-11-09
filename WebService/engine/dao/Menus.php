<?php
	class Menus{
			
		private $id;
		private $menu;
		private $cadastrado;
		private $modificado;
			
		//ID
		function getId() {
			return $this->id;
		}
		function setId($id) {	
			return $this->id = $id;
		}
		
		//MENU
		function getMenu() {
			return $this->menu;
		}
		function setMenu($menu) {	
			return $this->menu = $menu;
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