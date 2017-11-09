<?php
	class Temas{
			
		private $id;
		private $tema;
		private $identificador;
		private $cor_primaria;
		private $cor_secundaria;
		private $cor_texto;
		private $foto;
		private $cadastrado;
		private $modificado;
			
		//ID
		function getId() {
			return $this->id;
		}
		function setId($id) {	
			return $this->id = $id;
		}
		
		//TEMA
		function getTema() {
			return $this->tema;
		}
		function setTema($tema) {	
			return $this->tema = $tema;
		}
		
		//IDENTIFICADOR
		function getIdentificador() {
			return $this->identificador;
		}
		function setIdentificador($identificador) {	
			return $this->identificador = $identificador;
		}
		
		//COR_PRIMARIA
		function getCor_primaria() {
			return $this->cor_primaria;
		}
		function setCor_primaria($cor_primaria) {	
			return $this->cor_primaria = $cor_primaria;
		}
		
		//COR_SECUNDARIA
		function getCor_secundaria() {
			return $this->cor_secundaria;
		}
		function setCor_secundaria($cor_secundaria) {	
			return $this->cor_secundaria = $cor_secundaria;
		}
		
		//COR_TEXTO
		function getCor_texto() {
			return $this->cor_texto;
		}
		function setCor_texto($cor_texto) {	
			return $this->cor_texto = $cor_texto;
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
		
	}
?>