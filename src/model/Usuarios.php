<?php 
			
	/**
	 * Generated by Getz Framework
	 * 
	 * @author Mário Sakamoto <mskamot@gmail.com>
	 * @see http://mariosakamoto.com/getz
	 */
	 
	namespace src\model; 

	class Usuarios {
			
		private $id;
		private $usuario;
		private $email;
		private $senha;
		private $foto;
		private $cadastrado;
		private $modificado;
		private $status;
		private $perfil;
		private $tema;
			
		public function __construct() { }
			
		public function setId($id) {
			$this->id = $id;
		}
		
		public function getId() {
			return $this->id;
		}
					
		public function setUsuario($usuario) {
			$this->usuario = $usuario;
		}
		
		public function getUsuario() {
			return $this->usuario;
		}
					
		public function setEmail($email) {
			$this->email = $email;
		}
		
		public function getEmail() {
			return $this->email;
		}
					
		public function setSenha($senha) {
			$this->senha = $senha;
		}
		
		public function getSenha() {
			return $this->senha;
		}
					
		public function setFoto($foto) {
			$this->foto = $foto;
		}
		
		public function getFoto() {
			return $this->foto;
		}
					
		public function setCadastrado($cadastrado) {
			$this->cadastrado = $cadastrado;
		}
		
		public function getCadastrado() {
			return $this->cadastrado;
		}
					
		public function setModificado($modificado) {
			$this->modificado = $modificado;
		}
		
		public function getModificado() {
			return $this->modificado;
		}
					
		public function setStatus($status) {
			$this->status = $status;
		}
		
		public function getStatus() {
			return $this->status;
		}
					
		public function setPerfil($perfil) {
			$this->perfil = $perfil;
		}
		
		public function getPerfil() {
			return $this->perfil;
		}
					
		public function setTema($tema) {
			$this->tema = $tema;
		}
		
		public function getTema() {
			return $this->tema;
		}
					
	}
	
?>