<?php


include_once  'session_start.php';

class User {
	
	private $id;
	private $login;
	private $password;
	private $name;
	private $admin;

	
	public function __construct() {
		
	}
	
	
//SET	
	
	public function setId($id) {
		$this->id = $id;
	}
		
	public function setLogin($login) {
		$this->login = $login;
	}
	
	public function setName($name) {
		$this->name = $name;
	}
	
	public function setAdmin($admin) {
		$this->admin = $admin;
	}
	

//GET	
	
	public function getId() {
		return $this->id;
	}
	
	public function getLogin() {
		return $this->login;
	}
	
	public function getName() {
		return $this->name;
	}
	
	public function getAdmin() {
		return $this->admin;
	}
	
	
//STATIC

	public static function getUsers($dbConnect) {
		$db = $dbConnect;
		$db->connect();
		$sql = "SELECT * FROM user;";
		$result = $db->doQuery($sql);
		$db->disconnect();
	}
	
	public static function addUser($dbConnect,$login,$password) {
		$db = $dbConnect;
		$db->connect();
		//validate login and password
		$loginTmp = strtolower($login);
		$loginTmp = htmlspecialchars($loginTmp);
		$loginTmp = $db->getConnection()->real_escape_string($loginTmp);
		
		$passwordTmp = htmlspecialchars($password);
		$passwordTmp = $db->getConnection()->real_escape_string($passwordTmp);
		
		
		$sql = "insert into user (login,password)
		VALUES ('$loginTmp','$passwordTmp');";
		$result = $db->doQuery($sql);
		$db->disconnect();
		if($result == FALSE)
			return false;
			
			return TRUE;
	}
	
	

	public static function login($dbConnect,$login,$password) {
		$db = $dbConnect;
		$db->connect();
		
		//validate login and password
		
		$loginTmp = strtolower($login);
		$loginTmp = htmlspecialchars($loginTmp);
		$loginTmp = $db->getConnection()->real_escape_string($loginTmp);
		
		$passwordTmp = htmlspecialchars($password);
		$passwordTmp = $db->getConnection()->real_escape_string($passwordTmp);
		
		$sql = "SELECT *
		FROM user
		WHERE login='$loginTmp' and password='$passwordTmp';";
		$result = $db->doQuery($sql);
		$row = $result->fetch_array(MYSQLI_ASSOC);
		if($row != NULL) {
			session_set($row['id'], $row['login'], $row['name'], $row['admin']);
			$db->disconnect();
			return true;
		}
		$db->disconnect();
		return false;
		
		
	}
	

	
	public static function logout() {
		//TODO w pliku  auth-wyloguj
	}
	

	
}