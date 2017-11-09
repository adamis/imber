<?php

define("BANCO", "u110440434_imber");
define("IP", "localhost");
define("USUARIO", "root");
define("SENHA", "vertrigo");
define("FOLDER","WebService");


$caminho = '';
$pdo_ = null;

// Criando Folders
if(!file_exists('engine')){
	mkdir ( 'engine' , 0777);
	mkdir ( 'engine/adapter', 0777 );
	mkdir ( 'engine/connection', 0777 );
	mkdir ( 'engine/controller', 0777 );
	mkdir ( 'engine/dao', 0777 );
	mkdir ( 'engine/utils', 0777 );
}

createTablePermission();

// Buscando todas as Tabelas
$sth = getAllTables();

//CONSTRUINDO OS DAOS ------------------------------------------//----------------------------------------------------
$caminho = 'engine/dao/';
$builder = '';

while ( $dados = $sth->fetch () ) {
	
	// Definindo o nome do arquivo a ser criado.
	$filename = $caminho . ucfirst($dados [0]) . '.php';
	
	if (! file_exists ( $filename )) {
		$builder .= 
'<?php
	class ' . ucfirst($dados [0]) . '{
			';
		
		$builder .= getColum($dados[0]);
		$builder .= setColum($dados[0]);
		$builder .= '
	}
?>';	
		
	}
	
	//Escrevendo o texto na página
	writeCodeInFile($filename,$builder);	
	
	$builder ='';
}

$filename = $caminho . 'Response.php';

$builder .=
'<?php
	class Response{
			';

$builder .='
		private $result;
		private $data;
		';

$builder .='
		function getResult() {
			return $this->result;
		}
		function setResult($result) {
			return $this->result = $result;
		}
';

$builder .='
		function getData() {
			return $this->data;
		}
		function setData($data) {	
			return $this->data = $data;
		}
';

$builder .='
	}';


$builder .='
?>';

writeCodeInFile($filename,$builder);


//CONSTRUINDO CONEXAO ----------------------------------------//---------------------------------------------------
$builder ='';
$caminho = 'engine/connection/';

$builder .= '<?php';

$builder .= '
	class Connection {
	
		private $sqli;

		public function __construct() {
			$this->sqli = new mysqli(\''.IP.'\', \''.USUARIO.'\', \''.SENHA.'\', \''.BANCO.'\');
			
			if ($this->sqli->connect_errno > 0)
				die("Unable to connect to database.");

			$this->sqli->set_charset("utf8");
		}
		
		public function beginTransaction() {
			$this->sqli->autocommit(FALSE);
		}

		public function execute($query) {
			return $this->sqli->query($query);
		}

		public function commit() {
			$this->sqli->commit();
		}

		public function rollBack() {
			$this->sqli->rollback();
		}

		public function close() {
			$this->sqli->close();
		}

		public function free($result) {
			$result->free();
		}

	}

';

$builder .= '?>';

//Escrevendo connection.php
writeCodeInFile($caminho.'/connection.php',$builder);	

$builder = '';



//CONSTRUINDO ADAPTERS (CRUD) ---------------------------------------//---------------------------------------------------
$sth = getAllTables();

$caminho = 'engine/adapter';

while ( $dados = $sth->fetch () ) {		
	
	$builder .='<?php';
			
	$builder .='
	include_once \'../dao/'.ucfirst($dados[0]).'.php\';
	';		
	$getsFk = getFk($dados[0]);
	while ( $colunsFkGet = $getsFk->fetch() ) {
		
		$builder .='include_once \'../adapter/'.ucfirst($colunsFkGet[2]).'CRUD.php\';
	';
	}	 
	
	
	$builder .='
	class '.ucfirst($dados[0]).'CRUD {
	
		private $connection;
		
		public function __construct($connection) {
			$this->connection = $connection;
		}
';
	$colunas = "";
	$colunasRead = "";
	$tip = "";
	$cont = 0;
	$sths = showColum($dados[0]);
	
	
	
	while ( $coluns = $sths->fetch() ) {//TODAS COLUNAS DA TABELA			
		
		if($cont != 0){			
			if($cont > 1){				
				$colunas .= ',';
				$colunasRead .= ',';
				$tip .= ',';	
			}
			
			$colunas .= $coluns[0];	
			$colunasRead .= $coluns[0];
			
			$controlFK  = 0;
			
			$sthFk = getFk($dados[0]);			
			while ( $fk = $sthFk->fetch () ) {		
				
				if($coluns[0] == $fk[1]){
					$controlFK = 1;
				}
			}
			
			
			if($controlFK == 0){
			
				if($dados[0] == 'permission' && $coluns[0] == 'token'){					
					$tip .= '
								md5($id)';
								
				}else{
					if(gettype($coluns[1]) == 'string' || gettype($coluns[1]) == 'string32'){
						$tip .= '
								$'.$dados[0].'->'.'get'.ucfirst($coluns[0]).'()';
					}else {
						$tip .= '
								$'.$dados[0].'->'.'get'.ucfirst($coluns[0]).'()';
					}
					
				}
			}else{
				$tip .= '
					 		   $'.$dados[0].'->'.'get'.ucfirst($coluns[0]).'()'.'->getId()';
			}
			
		}else{
			$colunasRead .= $coluns[0].',';
		}	
		
		$cont++;
	}	
	
	if($dados[0] == 'permission'){
		//INSERT
		$sql = '\'INSERT INTO '.$dados[0].' ('.$colunas.') values (\'.'.$tip.'.\')\'';
		$builder .='
		public function create($'.$dados[0].') {
			$id = rand(1000 , 999999999999999 );	
			return $this->connection->execute('.$sql.'
					);
		}
';
	}else{
		//INSERT
		$sql = '\'INSERT INTO '.$dados[0].' ('.$colunas.') values (\'.'.$tip.'.\')\'';
		$builder .='
		public function create($'.$dados[0].') {
			return $this->connection->execute('.$sql.'
					);
		}
';		
	}
	
	
	//READ
	$sql = "select ".$colunasRead." from ".$dados[0];
	$builder .='
		public function read($where) { 			
			if($where != \'\'){
				$where = \' where \'.$where;
			}
			$i = 0;
			$list'.ucfirst($dados[0]).';
			
			$'.$dados[0].' = new '.ucfirst($dados[0]).'();
			$result = $this->connection->execute(\''.$sql.'\'.$where);
';

	$builder .=' 
			while ($row = $result->fetch_assoc()) {
';
	
	$sths = showColum($dados[0]);
	
	while ( $coluns = $sths->fetch() ) {
		
		$controlFK = true;
		$fkName = "";
		
		$sthsFK = getFk($dados[0]); 
		while ( $foren = $sthsFK->fetch() ) {				
			if($coluns[0] == $foren[1]){
				$controlFK = false;
				$fkName = $foren[1];
				$fkTable = $foren[2];
			}
		}
		
		if($controlFK){ //true -> coluna / false -> FK
		$builder .='
				$'.$dados[0].'->set'.ucfirst($coluns[0]).'($row[\''.$coluns[0].'\']);';
		}else{
			
			$builder .= '
					
				$'.$fkTable.'CRUD = new '.ucfirst($fkTable).'CRUD($this->connection);';
			
			$builder .= '
				$'.$dados[0]. '->set'.ucfirst($fkName).'($'.$fkTable.'CRUD->read(\'id=\'.$row[\''.$coluns[0].'\']));
						';
						
		}
	}
	
    $builder .=' 
    			$list'.ucfirst($dados[0]).'[$i] = $'.$dados[0].';
				$i++;
			}
    		return $list'.ucfirst($dados[0]).';
    	}
';
	
    

	//UPDATE
    $update = "";
    $where  = "";
    $cont = 0;    
    $sths = showColum($dados[0]);    
    while ( $coluns = $sths->fetch() ) {
    	
    	if($cont > 0){
	    	if($cont > 1){
	    		$update .= "
	    	,";   		    		
	    	}
	    	$update .= $coluns[0] .'= \'.$'.$dados[0].'->get'.ucfirst($coluns[0]).'().\'';
    	}
    	
    	if($cont == 0){
    		$where = $coluns[0] .'= \'.$'.$dados[0].'->get'.ucfirst($coluns[0]).'().\'';
    	}
    	
    	$cont++;
    }
    
    $sql = "
    		UPDATE ".$dados[0].' 
    		SET '.$update.' 
    		WHERE '.$where;    
    
	$builder .='
		public function update($'.$dados[0].') {
			return $this->connection->execute(\''.$sql.'\');
		}
';
	
	
	
	//DELETE
	$sql = "DELETE FROM ".$dados[0]." WHERE ";
	$builder .='
		public function delete($'.$dados[0].') {
			return $this->connection->execute(\''.$sql.$where.'\');
		}
';

	if($dados[0] == 'permission'){
	//PERMISSION TOKEN
	$builder .='
				public function checkToken($token){			
			$valid = false;
			
				if($token == \'\'){					
					$valid = false;					
				}else{					
					$sql = \'select id,user,token from permission where token="\'.$token.\'"\';					
					  					
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
	';
	
	}
	
$builder .='
	}
';

$builder .='
?>';

writeCodeInFile($caminho.'/'.ucfirst($dados[0]).'CRUD.php',$builder);	
	$builder ="";	
}

//CONSTRUINDO CONTROLLER ----------------------------------///-------------------------------------------


$sth = getAllTables();

$caminho = 'engine/controller';
$builder ="";

while ( $dados = $sth->fetch () ) {
	if($dados[0] != 'permission'){
		$builder .="<?php";
		
		$builder .= '
	include_once \'../connection/connection.php\';
	include_once \'../connection/PermissionCRUD.php\';
	include_once \'../adapter/'.ucfirst($dados[0]).'CRUD.php\';
				';
		
		$builder .='
	if (isset ( $_POST[\'token\'] )) {
		$token = $_POST[\'token\'];
	}
		';
		
		$builder .='';
		
		$builder .='
?>';
		writeCodeInFile($caminho.'/'.$dados[0].'.php',$builder);
		$builder ='';
	}
}


//FUNÇÕES ----------------------------------//-----------------------------------------------------------

function createTablePermission(){
	$pdo_ = getConection();
	$query = 'CREATE TABLE IF NOT EXISTS permission (
			  id int(11) NOT NULL AUTO_INCREMENT,
			  user varchar(255) DEFAULT NULL,
			  token varchar(255) DEFAULT NULL,
			  dataIni datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
			  PRIMARY KEY (id)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8'
	;
	
	try{		
		$pdo_->exec($query);
	} catch(PDOException $e) {
		echo $e->getMessage();//Remove or change message in production code
	}
	return $pdo_;
}


function writeCodeInFile($file,$text){
	//Escrevendo
	if (!file_exists($file)) {
		$fo = fopen($file, "w");
		$fw = fwrite($fo, $text);
		fclose($fo);
	}
}

function getConection(){

	// Conexao
	$pdo_ = new PDO( 'mysql:dbname=' . BANCO . ';host=' . IP, USUARIO, SENHA );
	$pdo_->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	return $pdo_;
}

function getFk($table){	
	$pdo_ = getConection();
	$query = 'select
				table_name as \'tabela\',
    			column_name as \'coluna\',
				referenced_table_name as \'tabela_referencia\' ,
    			referenced_column_name as \'coluna_referencia\'    
			  from
    			information_schema.key_column_usage
			  where	TABLE_NAME = \''.$table.'\'
			  AND 	referenced_table_name is not null';
    			
	//echo $query.'<br>';	
	$sth = $pdo_->prepare ( $query );
	$sth->execute ();
	return $sth;
}


function getAllTables(){
	$pdo_ = getConection();
	$query = ' SHOW TABLES ';
	$sth = $pdo_->prepare ( $query );
	$sth->execute ();
	return $sth;
}

function showColum($table){
	$pdo_ = getConection();
	$query = 'SHOW COLUMNS FROM ' . $table;
	$sth = $pdo_->prepare($query);
	$sth->execute ();
	return $sth;
}

function getColum($table) {	
	$pdo_ = getConection();
	$query = 'SHOW COLUMNS FROM ' . $table;
	$sth = $pdo_->prepare($query);
	$sth->execute ();
	
	$arrayColl = '';
	$StringGetSet = '';
	while ( $row = $sth->fetch () ) {		
			$arrayColl .= '
		private $' . $row['Field'] .';';						
	}
	
	return $arrayColl;
}


function setColum($table){
	$pdo_ = getConection();
	$query = 'SHOW COLUMNS FROM ' . $table;
	$sth = $pdo_->prepare($query);
	$sth->execute ();
	
	$StringGetSet = '
			';
	
	while ( $row = $sth->fetch () ) {
				
		$StringGetSet .='
		//'.strtoupper($row['Field']);
		
		$StringGetSet .= '
		function get'.ucfirst($row['Field']).'() {
			'.'return $this->'.$row['Field'] .';
		}';
		$StringGetSet .= '
		function set'.ucfirst($row['Field']).'($'.$row['Field'].') {	
			'.'return $this->'.$row['Field'].' = $'.$row['Field'].';
		}';
		
		$StringGetSet .= '
		';
	}
	
	return $StringGetSet;
}

function getTypes($type){
	
	if(strpos(strtoupper($type),'INT') !== false){
		return 'integer';
	}else if(strpos(strtoupper($type),'DOUBLE') !== false){
		return 'double';
	}else if(strpos(strtoupper($type),'DATETIME') !== false){		
		return 'datetime';
	}else if(strpos(strtoupper($type),'DATE') !== false){
		return 'date';
	}else if( strpos(strtoupper($type),'VARCHAR') !== false) {	
			return 'string';		
	}else if( strpos(strtoupper($type),'TEXT') !== false) {
		return 'string64';
	}

	return '?';

}


//$now = new DateTime();
//echo 'OK<br>'.$now->format('Y-m-d H:i:s'); 

$pdo_ = null;


?>