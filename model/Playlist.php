<?php


class Playlist {
	
	private $id;
	private $name;
	private $image;
	private $idUser;
	
	
	public function __construct() {
		
	}
	
//SET

	public function setId($id) {
		$this->id=$id;
	}
	
	public function setName($name) {
		$this->name=$name;
	}
	
	public function setImage($image) {
		$this->image=$image;
	}
	
	public function setIdUser($idUser) {
		$this->idUser=$idUser;
	}
	
//GET

	public function getId() {
		return $this->id;
	}
	
	public function  getName() {
		return $this->name;
	}
	
	public function getImage() {
		return $this->image;
	}
	
	public function getIdUser() {
		return $this->idUser;
	}

//STATIC

	public static function setPlaylistImage($dbConnect,$id) {
		$db = $dbConnect;
		$db->connect();
		$image = addslashes(file_get_contents($_FILES['plik']['tmp_name']));
		
		$sql="UPDATE playlist SET image='$image' WHERE id='$id';";
		
		$db->doQuery($sql);
		$db->disconnect();
		
	}
	
	public static function setPlaylistName($dbConnect,$id,$name) {
		$db = $dbConnect;
		$db->connect();
		$name = htmlspecialchars($name);
		$name = $db->getConnection()->real_escape_string($name);
		$sql="UPDATE playlist SET name='$name' WHERE id=$id;";
		$db->doQuery($sql);
		$db->disconnect();
	}

	public static function getPlaylists($dbConnect) {
		$db = $dbConnect;
		$db->connect();
		// Jeżeli w zapytaniu złączymy tabele LEFT JOIN można uzyskać wiersze
		// w których count =0
		$sql = "SELECT playlist.id,playlist.name,playlist.image,playlist.id_user,count(track.id) as count
            FROM playlist
            LEFT JOIN track on playlist.id=track.id_playlist
            WHERE id_user =".$_SESSION['id']."
            GROUP by playlist.id;";
		$result = $db->doQuery($sql);
		if($result->num_rows == 0) {
			$sql="SELECT *
              FROM playlist
              WHERE playlist.id_user=".$_SESSION['id'].";";
			
			$result = $db->doQuery($sql);					
		}	
		$db->disconnect();
		
		return $result ;
	}
	
	public static function getPlaylist($dbConnect,$id) {
		$db = $dbConnect;
		$db->connect();
		$sql = "SELECT *
            FROM playlist
            WHERE id=".$id."
            AND id_user =".$_SESSION['id'].";";
		$result = $db->doQuery($sql);
		
		return $result;
		
	}
	
	public static function deletePlaylist($dbConnect,$id) {
		$db = $dbConnect;
		$db->connect();
		$sql= "DELETE FROM track WHERE id_kategoria=$id;";
		$db->doQuery($sql);
		
		$sql = "DELETE FROM playlist WHERE id ='$id';";
		$db->doQuery($sql);
		
		$db->disconnect();
		
			
	}
	
	public function addPlaylist($dbConnect,$name) {
		$db = $dbConnect;
		$db->connect();
		
		$playlist = new Playlist();
		$playlist->setName($name);
		$playlist->validateName($db->getConnection());
		$playlist->setImage(addslashes(file_get_contents($_FILES['plik']['tmp_name'])));
		
		
		$sql="Insert into playlist (name,image,id_user)
		VALUES ('".$playlist->getName()."','".$playlist->getImage()."',".$_SESSION['id'].");";
		
		
		$result = $db->doQuery($sql);
		
		$db->disconnect();
		
		return $result;
	}
	
	
//OTHERS

	public function validateName($db) {
		$this->name=htmlspecialchars($this->name);
		$this->name= $db->real_escape_string($this->name);
	}

	
}