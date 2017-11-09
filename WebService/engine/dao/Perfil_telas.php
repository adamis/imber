<?php
	class Perfil_telas{
			
		private $id;
		private $cadastrado;
		private $modificado;
		private $perfil;
		private $tela;
		private $permissao;
			
		//ID
		function getId() {
			return $this->id;
		}
		function setId($id) {	
			return $this->id = $id;
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
		
		//PERFIL
		function getPerfil() {
			return $this->perfil;
		}
		function setPerfil($perfil) {	
			return $this->perfil = $perfil;
		}
		
		//TELA
		function getTela() {
			return $this->tela;
		}
		function setTela($tela) {	
			return $this->tela = $tela;
		}
		
		//PERMISSAO
		function getPermissao() {
			return $this->permissao;
		}
		function setPermissao($permissao) {	
			return $this->permissao = $permissao;
		}
		
	}
?>