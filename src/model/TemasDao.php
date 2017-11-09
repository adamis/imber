<?php
			
	/**
	 * Generated by Getz Framework
	 * 
	 * @author Mário Sakamoto <mskamot@gmail.com>
	 * @see http://mariosakamoto.com/getz 
	 */
	 
	namespace src\model; 
	
	class TemasDao {
	
		private $connection;
		
		/*
		 * Constant variables
		 */
		private $create = "INSERT INTO temas (
				tema
				, identificador
				, cor_primaria
				, cor_secundaria
				, cor_texto
				, foto
				, cadastrado
				, modificado
				) VALUES";
				
		public $read = 
				"temas.id AS 'temas.id'
				, temas.tema AS 'temas.tema'
				, temas.identificador AS 'temas.identificador'
				, temas.cor_primaria AS 'temas.cor_primaria'
				, temas.cor_secundaria AS 'temas.cor_secundaria'
				, temas.cor_texto AS 'temas.cor_texto'
				, temas.foto AS 'temas.foto'
				, temas.cadastrado AS 'temas.cadastrado'
				, temas.modificado AS 'temas.modificado'
				";
				
		private $update = "UPDATE temas SET";
		private $delete = "DELETE FROM temas";
		
		public $from = "temas temas";
		
		/*
		 * Parameters
		 */
		private $where;
		private $order;
		
		// Dynamic query
		private $sql;
		
		// Controller response
		private $response;	
		
		/**
		 * @param {Object} connection
		 */
		public function __construct($connection) {
			$this->connection = $connection;
		}

		/**
		 * @param {Temas}temas
		 */
		public function setCreate($temas) {		
			$this->sql = $this->create . " (\"" . 
					$temas->getTema() .
					"\", \"" . $temas->getIdentificador() .
					"\", \"" . $temas->getCor_primaria() .
					"\", \"" . $temas->getCor_secundaria() .
					"\", \"" . $temas->getCor_texto() .
					"\", \"" . $temas->getFoto() .
					"\", \"" . $temas->getCadastrado() .
					"\", \"" . $temas->getModificado() .
					"\")";
		}
		
		/**
		 * @return {String}
		 */
		public function getCreate() {
			return $this->sql;
		}	
		
		/**
		 * @param {String} where
		 * @param {String} order
		 */
		public function setRead($where, $order) {
			
			$this->setWhere($where);
			$this->setOrder($order);
			
			$this->sql = "SELECT " . $this->read . " FROM " . $this->getFrom() . 
					$this->getWhere() . "
				" . $this->getOrder();
		}
		
		/**
		 * @return {String}
		 */
		public function getRead() {
			return $this->sql;
		}
		
		/**
		 * @param {Temas}temas  
		 * @param {String} where
		 */
		public function setUpdate($temas, $where) {
			$this->setWhere($where);
			
			$this->sql = $this->update . 
					" id = \"" . $temas->getId() . 
					"\", tema = \"" . $temas->getTema() . 
					"\", identificador = \"" . $temas->getIdentificador() . 
					"\", cor_primaria = \"" . $temas->getCor_primaria() . 
					"\", cor_secundaria = \"" . $temas->getCor_secundaria() . 
					"\", cor_texto = \"" . $temas->getCor_texto() . 
					"\", foto = \"" . $temas->getFoto() . 
					"\", modificado = \"" . $temas->getModificado() . 
					"\"" . $this->getWhere();
		}
		
		/**
		 * @return {String}
		 */
		public function getUpdate() {
			return $this->sql;
		}
		
		/**
		 * @param {String} where
		 */
		public function setDelete($where) {	
			$this->setWhere($where);
			
			$this->sql = $this->delete . $this->getWhere();
		}
		
		/**
		 * @return {String}
		 */
		public function getDelete() {
			return $this->sql;
		}
		
		/**
		 * @return {String}
		 */
		public function getFrom() {
			return $this->from;
		}
		
		/**
		 * @param {String} where
		 */
		public function setWhere($where) {
			if ($where != "")
				$this->where = " WHERE " . $where;
			else
				$this->where = "";
		}
		
		/**
		 * @return {String}
		 */
		public function getWhere() {
			return $this->where;
		}
		
		/**
		 * @param {String} order
		 */
		public function setOrder($order) {
			if ($order != "")
				$this->order = " ORDER BY " . $order;
			else
				$this->order = "";
		}
		
		/**
		 * @return {String}
		 */
		public function getOrder() {
			return $this->order;
		}
		
		/**
		 * @param {Integer} line
		 * @param column String
		 * @param value String
		 */
		private function setResponse($line, $column, $value) {
			$this->response[$line][$column] = $value;
		}

		/**
		 * @return {Array}
		 */
		private function getResponse() {
			return $this->response;
		}

		/**
		 * @param {String} where
		 */
		private function setSize($where) {
			$this->setWhere($where);
			
			$result = $this->connection->execute(
					"SELECT count(1) AS 'temas.size' from temas" . $this->getWhere());

			while ($row = $result->fetch_assoc()) {		
				$this->setResponse(0, "temas.size", $row["temas.size"]);
				
				$pages = ceil($row["temas.size"] / $this->connection->getItensPerPage());
				
				$this->setResponse(0, "temas.pages", $pages);
				
				$pagination = "<select id=\"gz-select-pagination\" onchange=\"goPage();\">";
				
				for ($i = 1; $i <= $pages; $i++) {
					if ($i == $this->connection->getPosition())
						$pagination .= "<option value=\"" . $i . "\" selected>" . $i . "</option>";
					else
						$pagination .= "<option value=\"" . $i . "\">" . $i . "</option>";
				}	

				$pagination .= "</select>";
						
				$this->setResponse(0, "temas.pagination", $pagination);
			}

			$this->connection->free($result);
		}
		
		/**
		 * @param {Integer} line
		 */
		public function setDivLine($line) {
			$this->setResponse($line - 1, "@_START_LINE_TWO", modelStartLine($line, 2));
			$this->setResponse($line - 1, "@_END_LINE_TWO", modelEndLine($line, 2));

			$this->setResponse($line - 1, "@_START_LINE_THREE", modelStartLine($line, 3));
			$this->setResponse($line - 1, "@_END_LINE_THREE", modelEndLine($line, 3));
			
			$this->setResponse($line - 1, "@_START_LINE_FOUR", modelStartLine($line, 4));
			$this->setResponse($line - 1, "@_END_LINE_FOUR", modelEndLine($line, 4));
		}
		
		/**
		 * @param {Integer} line
		 */
		public function checkDivLine($line) {
			if (modelCheckEndLine($line, 2) != "")
				$this->setResponse($line - 1, "@_END_LINE_TWO", modelCheckEndLine($line, 2));
			
			if (modelCheckEndLine($line, 3) != "")
				$this->setResponse($line - 1, "@_END_LINE_THREE", modelCheckEndLine($line, 3));		

			if (modelCheckEndLine($line, 4) != "")
				$this->setResponse($line - 1, "@_END_LINE_FOUR", modelCheckEndLine($line, 4));			
		}	

		/**
		 * @param {String} log
		 */
		private function setLog($log) {
			$this->setResponse(0, "log", $log);
		}
		
		/**
		 * @param {Temas} temas 
		 * @return {Boolean}
		 */
		public function create($temas) {
			$result = "";

			$this->setCreate($temas);
			$result = $this->connection->execute($this->getCreate());
			
			return $result;
		}

		/**
		 * @param {String} where
		 * @param {String} order
		 * @param {Boolean} wp
		 * @param {Array}
		 */
		public function read($where, $order, $wp) {
			$line = 0;

			$this->setRead($where, $order);
			$result = $this->connection->execute($this->getRead());

			while ($row = $result->fetch_assoc()) {
				$this->setResponse($line, "temas.id", $row["temas.id"]);
				$this->setResponse($line, "temas.tema", $row["temas.tema"]);
				$this->setResponse($line, "temas.identificador", $row["temas.identificador"]);
				$this->setResponse($line, "temas.cor_primaria", $row["temas.cor_primaria"]);
				$this->setResponse($line, "temas.cor_secundaria", $row["temas.cor_secundaria"]);
				$this->setResponse($line, "temas.cor_texto", $row["temas.cor_texto"]);
				$this->setResponse($line, "temas.foto", $row["temas.foto"]);
				$this->setResponse($line, "temas.cadastrado", modelDateTime($row["temas.cadastrado"]));
				$this->setResponse($line, "temas.modificado", modelDateTime($row["temas.modificado"]));
			
				$this->setResponse($line, "temas.line", $line);
			
				$line++;
				
				if ($wp)
					$this->setDivLine($line);
			}

			$this->connection->free($result);
			
			if ($wp && $line > 0) {
				$this->checkDivLine($line);
				
				$this->setSize($where);
			}

			return $this->getResponse();
		}

		/**
		 * @param {Temas} temas 
		 * @return {Boolean}
		 */
		public function update($temas) {
			$result = "";
			
			$this->setUpdate($temas, "temas.id = " . $temas->getId());
			$result = $this->connection->execute($this->getUpdate());

			return $result;
		}

		/**
		 * @param {String} where
		 * @return {Boolean}
		 */
		public function delete($where) {
			$result = "";
			
			$this->setDelete($where);
			$result = $this->connection->execute($this->getDelete());

			return $result;
		}
		
		/**
		 * @param {Integer} selected
		 * @param {String} order
		 * @return {Array}
		 */
		public function combo($selected, $order) {
			$size = 0;

			$this->setRead("", $order);
			$result = $this->connection->execute($this->getRead());

			while ($row = $result->fetch_assoc()) {
				$this->setResponse($size, "temas.id", $row["temas.id"]);
				$this->setResponse($size, "temas.tema", $row["temas.tema"]);
			
				if ($row["temas.id"] == $selected)
					$this->setResponse($size, "temas.selected", "selected");
				else
					$this->setResponse($size, "temas.selected", "");
					
				$size++;
			}
			
			$this->connection->free($result);
			
			$this->setResponse(0, "size", $size);

			return $this->getResponse();
		}
		
		/**
		 * @param {String} where
		 * @return {Array}
		 */
		public function comboScr($where) {
			$size = 0;

			$this->setRead($where, "");
			$result = $this->connection->execute($this->getRead());

			while ($row = $result->fetch_assoc()) {
				$this->setResponse($size, "temas.id", $row["temas.id"]);
				$this->setResponse($size, "temas.tema", $row["temas.tema"]);
				$this->setResponse($size, "temas.selected", "selected");
					
				$size++;
			}
			
			$this->connection->free($result);
			
			$this->setResponse(0, "size", $size);

			return $this->getResponse();
		}

	}

?>