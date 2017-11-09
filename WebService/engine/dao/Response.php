<?php
	class Response{
			
		private $result;
		private $data;
		
		function getResult() {
			return $this->result;
		}
		function setResult($result) {
			return $this->result = $result;
		}

		function getData() {
			return $this->data;
		}
		function setData($data) {	
			return $this->data = $data;
		}

	}
?>