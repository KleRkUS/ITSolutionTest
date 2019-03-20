<?php
	class Database 
	{
		private $hostname = 'localhost';
		private $db_username = 'mysql';
		private $db_password = 'mysql';
		private $db_name = 'links';
		private $db;
		private $connection;

  		public function connect()
  		{
  			$this->db = mysqli_connect($this->hostname, $this->db_username, $this->db_password, $this->db_name);
  			$this->connection = true;
  			return true;
  		}	

  		public function disconnect()
  		{
  			if ($this->connection && $close = mysqli_close($this->db)) {
                $this->connection = false;
            	return true;
        	}
  		}

		public function select($table, $rows = '*', $where = null, $order = null)
		{
			$arr = [];
			$q = 'SELECT '.$rows.' FROM '.$table;
        	if($where != null) {
            	$q .= ' WHERE '.$where;
        	}
        	if($order != null) {
            	$q .= ' ORDER BY '.$order;
        	}
        	$query = mysqli_query($this->db, $q);
        	$res = mysqli_fetch_array($query);
        	return $res;
        	//There is only one copy of full/short link in db available
        	//So we only need one result
		}
		
		public function insert($table, $rows, $values)
		{
			$q = "INSERT INTO ".$table." (".$rows.") VALUES (".$values.")";
			$query = mysqli_query($this->db, $q);
		}

		//I decided to explode one table in two parts with idea of 
		//trying to minimize memory when application select smth
		//It isn't nesessary here but I believe it's a good habit
	}
