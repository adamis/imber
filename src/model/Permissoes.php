<?php 
			
	/**
	 * Generated by Getz Framework
	 * 
	 * @author Mário Sakamoto <mskamot@gmail.com>
	 * @see http://mariosakamoto.com/getz
	 */
	 
	namespace src\model; 

	class Permissoes {
			
		private $id;
		private $permissao;
		private $cadastrado;
		private $modificado;
			
		public function __construct() { }
			
		public function setId($id) {
			$this->id = $id;
		}
		
		public function getId() {
			return $this->id;
		}
					
		public function setPermissao($permissao) {
			$this->permissao = $permissao;
		}
		
		public function getPermissao() {
			return $this->permissao;
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
					
	}
	
?>