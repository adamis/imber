<?php
	include_once '../dao/Telas.php';
	include_once '../adapter/MenusCRUD.php';
	
	class TelasCRUD {
	
		private $connection;
		
		public function __construct($connection) {
			$this->connection = $connection;
		}

		public function create($telas) {
			return $this->connection->execute('INSERT INTO telas (tela,identificador,cadastrado,modificado,menu) values ('.
								$telas->getTela(),
								$telas->getIdentificador(),
								$telas->getCadastrado(),
								$telas->getModificado(),
					 		   $telas->getMenu()->getId().')'
					);
		}

		public function read($where) { 			
			if($where != ''){
				$where = ' where '.$where;
			}
			$i = 0;
			$listTelas;
			
			$telas = new Telas();
			$result = $this->connection->execute('select id,tela,identificador,cadastrado,modificado,menu from telas'.$where);
 
			while ($row = $result->fetch_assoc()) {

				$telas->setId($row['id']);
				$telas->setTela($row['tela']);
				$telas->setIdentificador($row['identificador']);
				$telas->setCadastrado($row['cadastrado']);
				$telas->setModificado($row['modificado']);
					
				$menusCRUD = new MenusCRUD($this->connection);
				$telas->setMenu($menusCRUD->read('id='.$row['menu']));
						 
    			$listTelas[$i] = $telas;
				$i++;
			}
    		return $listTelas;
    	}

		public function update($telas) {
			return $this->connection->execute('
    		UPDATE telas 
    		SET tela= '.$telas->getTela().'
	    	,identificador= '.$telas->getIdentificador().'
	    	,cadastrado= '.$telas->getCadastrado().'
	    	,modificado= '.$telas->getModificado().'
	    	,menu= '.$telas->getMenu().' 
    		WHERE id= '.$telas->getId().'');
		}

		public function delete($telas) {
			return $this->connection->execute('DELETE FROM telas WHERE id= '.$telas->getId().'');
		}

	}

?>