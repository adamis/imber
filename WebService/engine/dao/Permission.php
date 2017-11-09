<?php
	class Permission{
			
		private $id;
		private $user;
		private $token;
		private $dataIni;
			
		//ID
		function getId() {
			return $this->id;
		}
		function setId($id) {	
			return $this->id = $id;
		}
		
		//USER
		function getUser() {
			return $this->user;
		}
		function setUser($user) {	
			return $this->user = $user;
		}
		
		//TOKEN
		function getToken() {
			return $this->token;
		}
		function setToken($token) {	
			return $this->token = $token;
		}
		
		//DATAINI
		function getDataIni() {
			return $this->dataIni;
		}
		function setDataIni($dataIni) {	
			return $this->dataIni = $dataIni;
		}
		
	}
?>