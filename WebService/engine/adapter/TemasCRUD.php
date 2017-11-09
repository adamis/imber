<?php
	include_once '../dao/Temas.php';
	
	class TemasCRUD {
	
		private $connection;
		
		public function __construct($connection) {
			$this->connection = $connection;
		}

		public function create($temas) {
			return $this->connection->execute('INSERT INTO temas (tema,identificador,cor_primaria,cor_secundaria,cor_texto,foto,cadastrado,modificado) values ('.
								$temas->getTema(),
								$temas->getIdentificador(),
								$temas->getCor_primaria(),
								$temas->getCor_secundaria(),
								$temas->getCor_texto(),
								$temas->getFoto(),
								$temas->getCadastrado(),
								$temas->getModificado().')'
					);
		}

		public function read($where) { 			
			if($where != ''){
				$where = ' where '.$where;
			}
			$i = 0;
			$listTemas;
			
			$temas = new Temas();
			$result = $this->connection->execute('select id,tema,identificador,cor_primaria,cor_secundaria,cor_texto,foto,cadastrado,modificado from temas'.$where);
 
			while ($row = $result->fetch_assoc()) {

				$temas->setId($row['id']);
				$temas->setTema($row['tema']);
				$temas->setIdentificador($row['identificador']);
				$temas->setCor_primaria($row['cor_primaria']);
				$temas->setCor_secundaria($row['cor_secundaria']);
				$temas->setCor_texto($row['cor_texto']);
				$temas->setFoto($row['foto']);
				$temas->setCadastrado($row['cadastrado']);
				$temas->setModificado($row['modificado']); 
    			$listTemas[$i] = $temas;
				$i++;
			}
    		return $listTemas;
    	}

		public function update($temas) {
			return $this->connection->execute('
    		UPDATE temas 
    		SET tema= '.$temas->getTema().'
	    	,identificador= '.$temas->getIdentificador().'
	    	,cor_primaria= '.$temas->getCor_primaria().'
	    	,cor_secundaria= '.$temas->getCor_secundaria().'
	    	,cor_texto= '.$temas->getCor_texto().'
	    	,foto= '.$temas->getFoto().'
	    	,cadastrado= '.$temas->getCadastrado().'
	    	,modificado= '.$temas->getModificado().' 
    		WHERE id= '.$temas->getId().'');
		}

		public function delete($temas) {
			return $this->connection->execute('DELETE FROM temas WHERE id= '.$temas->getId().'');
		}

	}

?>