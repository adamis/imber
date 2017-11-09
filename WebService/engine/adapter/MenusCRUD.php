<?php
	include_once '../dao/Menus.php';
	
	class MenusCRUD {
	
		private $connection;
		
		public function __construct($connection) {
			$this->connection = $connection;
		}

		public function create($menus) {
			return $this->connection->execute('INSERT INTO menus (menu,cadastrado,modificado) values ('.
								$menus->getMenu(),
								$menus->getCadastrado(),
								$menus->getModificado().')'
					);
		}

		public function read($where) { 			
			if($where != ''){
				$where = ' where '.$where;
			}
			$i = 0;
			$listMenus;
			
			$menus = new Menus();
			$result = $this->connection->execute('select id,menu,cadastrado,modificado from menus'.$where);
 
			while ($row = $result->fetch_assoc()) {

				$menus->setId($row['id']);
				$menus->setMenu($row['menu']);
				$menus->setCadastrado($row['cadastrado']);
				$menus->setModificado($row['modificado']); 
    			$listMenus[$i] = $menus;
				$i++;
			}
    		return $listMenus;
    	}

		public function update($menus) {
			return $this->connection->execute('
    		UPDATE menus 
    		SET menu= '.$menus->getMenu().'
	    	,cadastrado= '.$menus->getCadastrado().'
	    	,modificado= '.$menus->getModificado().' 
    		WHERE id= '.$menus->getId().'');
		}

		public function delete($menus) {
			return $this->connection->execute('DELETE FROM menus WHERE id= '.$menus->getId().'');
		}

	}

?>