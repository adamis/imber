<?php
	include_once '../dao/Medicoes.php';
	
	class MedicoesCRUD {
	
		private $connection;
		
		public function __construct($connection) {
			$this->connection = $connection;
		}

		public function create($medicoes) {			
			return $this->connection->execute("INSERT INTO medicoes (data_hora,altura_mar,humidade_ar,humidade_solo,pressao_ar,temperatura_ar,cadastrado,modificado) values ('".
								$medicoes->getData_hora()."',".
								$medicoes->getAltura_mar().",".
								$medicoes->getHumidade_ar().",".
								$medicoes->getHumidade_solo().",".
								$medicoes->getPressao_ar().",".
								$medicoes->getTemperatura_ar().",'".
								$medicoes->getCadastrado()."','".
								$medicoes->getModificado()."')"								
					);
		}

		public function read($where) { 			
			if($where != ''){
				$where = ' where '.$where;
			}
			$i = 0;
			$listMedicoes;
			
			
			$result = $this->connection->execute('select id,data_hora,altura_mar,humidade_ar,humidade_solo,pressao_ar,temperatura_ar,cadastrado,modificado from medicoes'.$where);
 
			while ($row = $result->fetch_assoc()) {
				$medicoes = new Medicoes();
				$medicoes->setId($row['id']);
				$medicoes->setData_hora($row['data_hora']);
				$medicoes->setAltura_mar($row['altura_mar']);
				$medicoes->setHumidade_ar($row['humidade_ar']);
				$medicoes->setHumidade_solo($row['humidade_solo']);
				$medicoes->setPressao_ar($row['pressao_ar']);
				$medicoes->setTemperatura_ar($row['temperatura_ar']);
				$medicoes->setCadastrado($row['cadastrado']);
				$medicoes->setModificado($row['modificado']); 
    			$listMedicoes[$i] = $medicoes;
				$i++;
			}
    		return $listMedicoes;
    	}

		public function update($medicoes) {
			return $this->connection->execute('
    		UPDATE medicoes 
    		SET data_hora= '.$medicoes->getData_hora().'
	    	,altura_mar= '.$medicoes->getAltura_mar().'
	    	,humidade_ar= '.$medicoes->getHumidade_ar().'
	    	,humidade_solo= '.$medicoes->getHumidade_solo().'
	    	,pressao_ar= '.$medicoes->getPressao_ar().'
	    	,temperatura_ar= '.$medicoes->getTemperatura_ar().'
	    	,cadastrado= '.$medicoes->getCadastrado().'
	    	,modificado= '.$medicoes->getModificado().' 
    		WHERE id= '.$medicoes->getId().'');
		}

		public function delete($medicoes) {
			return $this->connection->execute('DELETE FROM medicoes WHERE id= '.$medicoes->getId().'');
		}

	}

?>