<?php


class Music {
	
	private $id;
	private $name;
	private $author;
	private $url;
	
	public function __construct(){
		
	}
	
//SET

	public function setId($id) {
		$this->id=$id;
	}
	
	public function setName($name) {
		$this->name=$name;
	}
	
	public function setAuthor($author) {
		$this->author=$author;
	}
	
	public  function setUrl($url) {
		$this->url=$url;
	}
	
//GET

	public function getId() {
		return $this->id;
	}
	
	public function getName() {
		return $this->name;
	}
	
	public function  getAuthor() {
		return $this->author;
	}
	
	public function getUrl() {
		return $this->url;
	}
	
//STATIC

	public static function addMusic($dbConnect,$name,$author,$url) {
		$db = $dbConnect;
		$db->connect();
		$sql="INSERT INTO music (name,author,url)
			VALUES('$name','$author','$url');";
		$result = $db->doQuery($sql);
		$db->disconnect();
		
		return $result;
	}
	
	public static function getMusic($dbConnect) {
		$db = $dbConnect;
		$db->connect();
		$sql="SELECT * 
			FROM music;";
		
		$result = $db->doQuery($sql);
		$db->disconnect();
		
		return $result;
	}
	
	public static function getAvaiableMusic($dbConnect,$idPlaylist) {
		$db = $dbConnect;
		$db->connect();
		$sql="SELECT *
			FROM music
			WHERE music.id NOT IN (
			SELECT track.id_music
			FROM track
			WHERE track.id_playlist=$idPlaylist
			);";
		$result = $db->doQuery($sql);
		$db->disconnect();
	
		return $result;
	}
	
	
//OTHERS	
	
	
}