<?php
	include_once '../dao/Status.php';
	
	class StatusCRUD {
	
		private $connection;
		
		public function __construct($connection) {
			$this->connection = $connection;
		}

		public function create($status) {
			return $this->connection->execute('INSERT INTO status (status,cadastrado,modificado) values ('.
								$status->getStatus(),
								$status->getCadastrado(),
								$status->getModificado().')'
					);
		}

		public function read($where) { 			
			if($where != ''){
				$where = ' where '.$where;
			}
			$i = 0;
			$listStatus;
			
			$status = new Status();
			$result = $this->connection->execute('select id,status,cadastrado,modificado from status'.$where);
 
			while ($row = $result->fetch_assoc()) {

				$status->setId($row['id']);
				$status->setStatus($row['status']);
				$status->setCadastrado($row['cadastrado']);
				$status->setModificado($row['modificado']); 
    			$listStatus[$i] = $status;
				$i++;
			}
    		return $listStatus;
    	}

		public function update($status) {
			return $this->connection->execute('
    		UPDATE status 
    		SET status= '.$status->getStatus().'
	    	,cadastrado= '.$status->getCadastrado().'
	    	,modificado= '.$status->getModificado().' 
    		WHERE id= '.$status->getId().'');
		}

		public function delete($status) {
			return $this->connection->execute('DELETE FROM status WHERE id= '.$status->getId().'');
		}

	}

?>