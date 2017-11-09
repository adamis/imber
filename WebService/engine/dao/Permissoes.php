<?php
	class Permissoes{
			
		private $id;
		private $permissao;
		private $cadastrado;
		private $modificado;
			
		//ID
		function getId() {
			return $this->id;
		}
		function setId($id) {	
			return $this->id = $id;
		}
		
		//PERMISSAO
		function getPermissao() {
			return $this->permissao;
		}
		function setPermissao($permissao) {	
			return $this->permissao = $permissao;
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