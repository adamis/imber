<?php
	include_once '../dao/Usuarios.php';
	include_once '../adapter/StatusCRUD.php';
	include_once '../adapter/PerfisCRUD.php';
	include_once '../adapter/TemasCRUD.php';
	
	class UsuariosCRUD {
	
		private $connection;
		
		public function __construct($connection) {
			$this->connection = $connection;
		}

		public function create($usuarios) {
			return $this->connection->execute('INSERT INTO usuarios (usuario,email,senha,foto,cadastrado,modificado,perfil,status,tema) values ('.
								$usuarios->getUsuario(),
								$usuarios->getEmail(),
								$usuarios->getSenha(),
								$usuarios->getFoto(),
								$usuarios->getCadastrado(),
								$usuarios->getModificado(),
					 		   $usuarios->getPerfil()->getId(),
					 		   $usuarios->getStatus()->getId(),
					 		   $usuarios->getTema()->getId().')'
					);
		}

		public function read($where) { 			
			if($where != ''){
				$where = ' where '.$where;
			}
			$i = 0;
			$listUsuarios;
			
			$usuarios = new Usuarios();
			$result = $this->connection->execute('select id,usuario,email,senha,foto,cadastrado,modificado,perfil,status,tema from usuarios'.$where);
 
			while ($row = $result->fetch_assoc()) {

				$usuarios->setId($row['id']);
				$usuarios->setUsuario($row['usuario']);
				$usuarios->setEmail($row['email']);
				$usuarios->setSenha($row['senha']);
				$usuarios->setFoto($row['foto']);
				$usuarios->setCadastrado($row['cadastrado']);
				$usuarios->setModificado($row['modificado']);
					
				$perfisCRUD = new PerfisCRUD($this->connection);
				$usuarios->setPerfil($perfisCRUD->read('id='.$row['perfil']));
						
					
				$statusCRUD = new StatusCRUD($this->connection);
				$usuarios->setStatus($statusCRUD->read('id='.$row['status']));
						
					
				$temasCRUD = new TemasCRUD($this->connection);
				$usuarios->setTema($temasCRUD->read('id='.$row['tema']));
						 
    			$listUsuarios[$i] = $usuarios;
				$i++;
			}
    		return $listUsuarios;
    	}

		public function update($usuarios) {
			return $this->connection->execute('
    		UPDATE usuarios 
    		SET usuario= '.$usuarios->getUsuario().'
	    	,email= '.$usuarios->getEmail().'
	    	,senha= '.$usuarios->getSenha().'
	    	,foto= '.$usuarios->getFoto().'
	    	,cadastrado= '.$usuarios->getCadastrado().'
	    	,modificado= '.$usuarios->getModificado().'
	    	,perfil= '.$usuarios->getPerfil().'
	    	,status= '.$usuarios->getStatus().'
	    	,tema= '.$usuarios->getTema().' 
    		WHERE id= '.$usuarios->getId().'');
		}

		public function delete($usuarios) {
			return $this->connection->execute('DELETE FROM usuarios WHERE id= '.$usuarios->getId().'');
		}

	}

?>