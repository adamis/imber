<?php
			
	/**
	 * Generated by Getz Framework
	 * 
	 * @author Mário Sakamoto <mskamot@gmail.com>
	 * @see http://mariosakamoto.com/getz 
	 */
	 
	namespace src\model; 
	
	use src\model;
	
	class MedicoesDao {
	
		private $connection;
		
		/*
		 * Constant variables
		 */
		private $create = "INSERT INTO medicoes (
				data_hora
				, altura_mar
				, humidade_ar
				, humidade_solo
				, pressao_ar
				, temperatura_ar
				, cadastrado
				, modificado
				) VALUES";
				
		public $read = 
				"medicoes.id AS 'medicoes.id'
				, medicoes.data_hora AS 'medicoes.data_hora'
				, medicoes.altura_mar AS 'medicoes.altura_mar'
				, medicoes.humidade_ar AS 'medicoes.humidade_ar'
				, medicoes.humidade_solo AS 'medicoes.humidade_solo'
				, medicoes.pressao_ar AS 'medicoes.pressao_ar'
				, medicoes.temperatura_ar AS 'medicoes.temperatura_ar'
				, medicoes.cadastrado AS 'medicoes.cadastrado'
				, medicoes.modificado AS 'medicoes.modificado'
				";
				
		private $update = "UPDATE medicoes SET";
		private $delete = "DELETE FROM medicoes";
		
		public $from = "medicoes medicoes";
		
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
		 * @param {Medicoes}medicoes
		 */
		public function setCreate($medicoes) {		
			$this->sql = $this->create . " (\"" . 
					$medicoes->getData_hora() .
					"\", \"" . $medicoes->getAltura_mar() .
					"\", \"" . $medicoes->getHumidade_ar() .
					"\", \"" . $medicoes->getHumidade_solo() .
					"\", \"" . $medicoes->getPressao_ar() .
					"\", \"" . $medicoes->getTemperatura_ar() .
					"\", \"" . $medicoes->getCadastrado() .
					"\", \"" . $medicoes->getModificado() .
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
		 * @param {Medicoes}medicoes  
		 * @param {String} where
		 */
		public function setUpdate($medicoes, $where) {
			$this->setWhere($where);
			
			$this->sql = $this->update . 
					" id = \"" . $medicoes->getId() . 
					"\", data_hora = \"" . $medicoes->getData_hora() . 
					"\", altura_mar = \"" . $medicoes->getAltura_mar() . 
					"\", humidade_ar = \"" . $medicoes->getHumidade_ar() . 
					"\", humidade_solo = \"" . $medicoes->getHumidade_solo() . 
					"\", pressao_ar = \"" . $medicoes->getPressao_ar() . 
					"\", temperatura_ar = \"" . $medicoes->getTemperatura_ar() . 
					"\", modificado = \"" . $medicoes->getModificado() . 
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
					"SELECT count(1) AS 'medicoes.size' from medicoes" . $this->getWhere());

			while ($row = $result->fetch_assoc()) {		
				$this->setResponse(0, "medicoes.size", $row["medicoes.size"]);
				
				$pages = ceil($row["medicoes.size"] / $this->connection->getItensPerPage());
				
				$this->setResponse(0, "medicoes.pages", $pages);
				
				$pagination = "<select id=\"gz-select-pagination\" onchange=\"goPage();\">";
				
				for ($i = 1; $i <= $pages; $i++) {
					if ($i == $this->connection->getPosition())
						$pagination .= "<option value=\"" . $i . "\" selected>" . $i . "</option>";
					else
						$pagination .= "<option value=\"" . $i . "\">" . $i . "</option>";
				}	

				$pagination .= "</select>";
						
				$this->setResponse(0, "medicoes.pagination", $pagination);
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
		 * @param {Medicoes} medicoes 
		 * @return {Boolean}
		 */
		public function create($medicoes) {
			$result = "";

			$this->setCreate($medicoes);
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
				$this->setResponse($line, "medicoes.id", $row["medicoes.id"]);
				$this->setResponse($line, "medicoes.data_hora", modelDateTime($row["medicoes.data_hora"]));
				$this->setResponse($line, "medicoes.altura_mar", modelDouble($row["medicoes.altura_mar"]));
				$this->setResponse($line, "medicoes.humidade_ar", modelDouble($row["medicoes.humidade_ar"]));
				$this->setResponse($line, "medicoes.humidade_solo", modelDouble($row["medicoes.humidade_solo"]));
				$this->setResponse($line, "medicoes.pressao_ar", modelDouble($row["medicoes.pressao_ar"]));
				$this->setResponse($line, "medicoes.temperatura_ar", modelDouble($row["medicoes.temperatura_ar"]));
				$this->setResponse($line, "medicoes.cadastrado", modelDateTime($row["medicoes.cadastrado"]));
				$this->setResponse($line, "medicoes.modificado", modelDateTime($row["medicoes.modificado"]));
			
				$this->setResponse($line, "medicoes.line", $line);
			
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
		 * @param {Medicoes} medicoes 
		 * @return {Boolean}
		 */
		public function update($medicoes) {
			$result = "";
			
			$this->setUpdate($medicoes, "medicoes.id = " . $medicoes->getId());
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
				$this->setResponse($size, "medicoes.id", $row["medicoes.id"]);
				$this->setResponse($size, "medicoes.data_hora", $row["medicoes.data_hora"]);
			
				if ($row["medicoes.id"] == $selected)
					$this->setResponse($size, "medicoes.selected", "selected");
				else
					$this->setResponse($size, "medicoes.selected", "");
					
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
				$this->setResponse($size, "medicoes.id", $row["medicoes.id"]);
				$this->setResponse($size, "medicoes.data_hora", $row["medicoes.data_hora"]);
				$this->setResponse($size, "medicoes.selected", "selected");
					
				$size++;
			}
			
			$this->connection->free($result);
			
			$this->setResponse(0, "size", $size);

			return $this->getResponse();
		}

	}

?>