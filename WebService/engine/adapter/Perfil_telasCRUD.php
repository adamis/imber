<?php
	include_once '../dao/Perfil_telas.php';
	include_once '../adapter/PerfisCRUD.php';
	include_once '../adapter/PermissoesCRUD.php';
	include_once '../adapter/TelasCRUD.php';
	
	class Perfil_telasCRUD {
	
		private $connection;
		
		public function __construct($connection) {
			$this->connection = $connection;
		}

		public function create($perfil_telas) {
			return $this->connection->execute('INSERT INTO perfil_telas (cadastrado,modificado,perfil,tela,permissao) values ('.
								$perfil_telas->getCadastrado(),
								$perfil_telas->getModificado(),
					 		   $perfil_telas->getPerfil()->getId(),
					 		   $perfil_telas->getTela()->getId(),
					 		   $perfil_telas->getPermissao()->getId().')'
					);
		}

		public function read($where) { 			
			if($where != ''){
				$where = ' where '.$where;
			}
			$i = 0;
			$listPerfil_telas;
			
			$perfil_telas = new Perfil_telas();
			$result = $this->connection->execute('select id,cadastrado,modificado,perfil,tela,permissao from perfil_telas'.$where);
 
			while ($row = $result->fetch_assoc()) {

				$perfil_telas->setId($row['id']);
				$perfil_telas->setCadastrado($row['cadastrado']);
				$perfil_telas->setModificado($row['modificado']);
					
				$perfisCRUD = new PerfisCRUD($this->connection);
				$perfil_telas->setPerfil($perfisCRUD->read('id='.$row['perfil']));
						
					
				$telasCRUD = new TelasCRUD($this->connection);
				$perfil_telas->setTela($telasCRUD->read('id='.$row['tela']));
						
					
				$permissoesCRUD = new PermissoesCRUD($this->connection);
				$perfil_telas->setPermissao($permissoesCRUD->read('id='.$row['permissao']));
						 
    			$listPerfil_telas[$i] = $perfil_telas;
				$i++;
			}
    		return $listPerfil_telas;
    	}

		public function update($perfil_telas) {
			return $this->connection->execute('
    		UPDATE perfil_telas 
    		SET cadastrado= '.$perfil_telas->getCadastrado().'
	    	,modificado= '.$perfil_telas->getModificado().'
	    	,perfil= '.$perfil_telas->getPerfil().'
	    	,tela= '.$perfil_telas->getTela().'
	    	,permissao= '.$perfil_telas->getPermissao().' 
    		WHERE id= '.$perfil_telas->getId().'');
		}

		public function delete($perfil_telas) {
			return $this->connection->execute('DELETE FROM perfil_telas WHERE id= '.$perfil_telas->getId().'');
		}

	}

?>