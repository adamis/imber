<?php
	include_once '../dao/Perfis.php';
	
	class PerfisCRUD {
	
		private $connection;
		
		public function __construct($connection) {
			$this->connection = $connection;
		}

		public function create($perfis) {
			return $this->connection->execute('INSERT INTO perfis (perfil,cadastrado,modificado) values ('.
								$perfis->getPerfil(),
								$perfis->getCadastrado(),
								$perfis->getModificado().')'
					);
		}

		public function read($where) { 			
			if($where != ''){
				$where = ' where '.$where;
			}
			$i = 0;
			$listPerfis;
			
			$perfis = new Perfis();
			$result = $this->connection->execute('select id,perfil,cadastrado,modificado from perfis'.$where);
 
			while ($row = $result->fetch_assoc()) {

				$perfis->setId($row['id']);
				$perfis->setPerfil($row['perfil']);
				$perfis->setCadastrado($row['cadastrado']);
				$perfis->setModificado($row['modificado']); 
    			$listPerfis[$i] = $perfis;
				$i++;
			}
    		return $listPerfis;
    	}

		public function update($perfis) {
			return $this->connection->execute('
    		UPDATE perfis 
    		SET perfil= '.$perfis->getPerfil().'
	    	,cadastrado= '.$perfis->getCadastrado().'
	    	,modificado= '.$perfis->getModificado().' 
    		WHERE id= '.$perfis->getId().'');
		}

		public function delete($perfis) {
			return $this->connection->execute('DELETE FROM perfis WHERE id= '.$perfis->getId().'');
		}

	}

?>