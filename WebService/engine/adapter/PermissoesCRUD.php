<?php
	include_once '../dao/Permissoes.php';
	
	class PermissoesCRUD {
	
		private $connection;
		
		public function __construct($connection) {
			$this->connection = $connection;
		}

		public function create($permissoes) {
			return $this->connection->execute('INSERT INTO permissoes (permissao,cadastrado,modificado) values ('.
								$permissoes->getPermissao(),
								$permissoes->getCadastrado(),
								$permissoes->getModificado().')'
					);
		}

		public function read($where) { 			
			if($where != ''){
				$where = ' where '.$where;
			}
			$i = 0;
			$listPermissoes;
			
			$permissoes = new Permissoes();
			$result = $this->connection->execute('select id,permissao,cadastrado,modificado from permissoes'.$where);
 
			while ($row = $result->fetch_assoc()) {

				$permissoes->setId($row['id']);
				$permissoes->setPermissao($row['permissao']);
				$permissoes->setCadastrado($row['cadastrado']);
				$permissoes->setModificado($row['modificado']); 
    			$listPermissoes[$i] = $permissoes;
				$i++;
			}
    		return $listPermissoes;
    	}

		public function update($permissoes) {
			return $this->connection->execute('
    		UPDATE permissoes 
    		SET permissao= '.$permissoes->getPermissao().'
	    	,cadastrado= '.$permissoes->getCadastrado().'
	    	,modificado= '.$permissoes->getModificado().' 
    		WHERE id= '.$permissoes->getId().'');
		}

		public function delete($permissoes) {
			return $this->connection->execute('DELETE FROM permissoes WHERE id= '.$permissoes->getId().'');
		}

	}

?>