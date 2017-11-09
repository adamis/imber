<?php
	class Connection {
	
		private $sqli;

		public function __construct() {
			//$this->sqli = new mysqli('mysql.hostinger.com.br', 'u110440434_imber', 'q1w2e3r4', 'u110440434_imber');
			$this->sqli = new mysqli('localhost', 'root', 'vertrigo', 'u110440434_imber');
			
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

?>