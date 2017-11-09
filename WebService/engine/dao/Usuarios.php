<?php
	class Usuarios{
			
		private $id;
		private $usuario;
		private $email;
		private $senha;
		private $foto;
		private $cadastrado;
		private $modificado;
		private $perfil;
		private $status;
		private $tema;
			
		//ID
		function getId() {
			return $this->id;
		}
		function setId($id) {	
			return $this->id = $id;
		}
		
		//USUARIO
		function getUsuario() {
			return $this->usuario;
		}
		function setUsuario($usuario) {	
			return $this->usuario = $usuario;
		}
		
		//EMAIL
		function getEmail() {
			return $this->email;
		}
		function setEmail($email) {	
			return $this->email = $email;
		}
		
		//SENHA
		function getSenha() {
			return $this->senha;
		}
		function setSenha($senha) {	
			return $this->senha = $senha;
		}
		
		//FOTO
		function getFoto() {
			return $this->foto;
		}
		function setFoto($foto) {	
			return $this->foto = $foto;
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
		
		//STATUS
		function getStatus() {
			return $this->status;
		}
		function setStatus($status) {	
			return $this->status = $status;
		}
		
		//TEMA
		function getTema() {
			return $this->tema;
		}
		function setTema($tema) {	
			return $this->tema = $tema;
		}
		
	}
?>