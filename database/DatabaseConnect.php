<?php



class DatabaseConnect {
	
	private $user='u960822207_niko';
	private $password='elo123';
	private $host='mysql.hostinger.pl';
	private $base='u960822207_audio';
	
	
	private $connection;
	
	public function __construct(){
		
	}
	
	public function  __wakeup() {
		
	}
		
	public function getConnection() {
		return $this->connection;
	}
	
	public function doQuery($sql) {
		return $this->connection->query($sql);
	}
	
	public function connect() {
		try {
			$this->connection= new mysqli($this->host,$this->user,$this->password,$this->base);
			if($this->connection->connect_error)
				die('Connect Error (' . $this->connection->connect_errno . ') '
						. $this->connection->connect_error);
		} catch (Exception $e) {
		}
	}
	
	public function disconnect() {
		try {
			$this->getConnection()->close();
		} catch (Exception $e) {
		}
	}
	
		
}