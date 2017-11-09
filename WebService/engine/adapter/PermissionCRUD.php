<?php
	include_once '../dao/Permission.php';
	
	class PermissionCRUD {
	
		private $connection;
		
		public function __construct($connection) {
			$this->connection = $connection;
		}

		public function create($permission) {
			$id = rand(1000 , 999999999999999 );	
			return $this->connection->execute('INSERT INTO permission (user,token,dataIni) values ('.
								$permission->getUser(),
								md5($id),
								$permission->getDataIni().')'
					);
		}

		public function read($where) { 			
			if($where != ''){
				$where = ' where '.$where;
			}
			$i = 0;
			$listPermission;
			
			$permission = new Permission();
			$result = $this->connection->execute('select id,user,token,dataIni from permission'.$where);
 
			while ($row = $result->fetch_assoc()) {

				$permission->setId($row['id']);
				$permission->setUser($row['user']);
				$permission->setToken($row['token']);
				$permission->setDataIni($row['dataIni']); 
    			$listPermission[$i] = $permission;
				$i++;
			}
    		return $listPermission;
    	}

		public function update($permission) {
			return $this->connection->execute('
    		UPDATE permission 
    		SET user= '.$permission->getUser().'
	    	,token= '.$permission->getToken().'
	    	,dataIni= '.$permission->getDataIni().' 
    		WHERE id= '.$permission->getId().'');
		}

		public function delete($permission) {
			return $this->connection->execute('DELETE FROM permission WHERE id= '.$permission->getId().'');
		}

				public function checkToken($token){			
			$valid = false;
			
				if($token == ''){					
					$valid = false;					
				}else{					
					$sql = 'select id,user,token from permission where token="'.$token.'"';					
					  					
					$result = $this->connection->execute($sql);
					
					$cont = 0;							 
					while ($row = $result->fetch_assoc()) {							
							$cont++;
					}
					
					if($cont > 0){
						$valid = true;
					}else{
						$valid = false;
					}
				}							
			return $valid;
		}
	
	}

?>