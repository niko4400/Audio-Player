<?php


class Track {
	
	private $id;
	private $idPlaylist;
	private $idMusic;
	private $reg;
	
	
	public function __construct() {
		
	}
	
//SET

	public function setId($id) {
		$this->id=$id;
	}
	
	public function setIdPlaylist($idPlaylist) {
		$this->idPlaylist=$idPlaylist;
	}
	
	public function setIdMusic($idMusic) {
		$this->idMusic=$idMusic;
	}
	
//GET

	public function getId() {
		return $this->id;
	}
	
	public function getIdPlaylist() {
		return $this->idPlaylist;
	}
	
	public function getIdMusic() {
		return $this->idMusic;
	}

	
//STATIC

	public static function  getTrack($dbConnect,$id) {
		$db = $dbConnect;
		$db->connect();
		$sql = "SELECT * FROM track WHERE id=".$id.";";
		$result = $db->doQuery($sql);
		$db->disconnect();
		
		return $result;
	}
	
	public static function  getTracksPlaylistPlayer($dbConnect,$idUser,$idPlaylist) {
		$db = $dbConnect;
		$db->connect();
		$sql = "SELECT music.name AS mname,music.author AS mauthor,music.url AS murl
			FROM user
			RIGHT OUTER JOIN playlist ON user.id = playlist.id_user
			RIGHT OUTER JOIN track ON playlist.id = track.id_playlist
			RIGHT OUTER JOIN music ON track.id_music = music.id
			WHERE user.id=$idUser
			AND playlist.id=$idPlaylist;";
		$result = $db->doQuery($sql);
		$db->disconnect();
		
		return $result;
	}
	
	public static function getTracksPlaylist($dbConnect,$idPlaylist) {
		$db = $dbConnect;
		$db->connect();
		$sql = "SELECT track.id AS uid, id_playlist,id_music,name,author
			FROM track
			RIGHT OUTER JOIN music ON track.id_music=music.id
			WHERE id_playlist =$idPlaylist;";
		$result = $db->doQuery($sql);
		$db->disconnect();
		
		return $result;
	}
	
	
	public static function addTrack($dbConnect,$idPlaylist,$idMusic) {
		$db = $dbConnect;
		$db->connect();
		$sql = "INSERT INTO track (id_playlist,id_music)
				VALUE ($idPlaylist,$idMusic);";
		$result = $db->doQuery($sql);
		$db->disconnect();

		
		return $result;
	}
	
	public static function deleteTrack($dbConnect,$idTrack) {
		$db = $dbConnect;
		$db->connect();
		$sql = "DELETE 
				FROM track 
				WHERE id=$idTrack;";
		$result = $db->doQuery($sql);
		$db->disconnect();
		
		return $result;
	}
	
	public static function deleteAjaxTrack($dbConnect,$idPlaylist,$idMusic) {
		$db = $dbConnect;
		$db->connect();
		$sql = "DELETE 
				FROM track 
				WHERE id_playlist=$idPlaylist 
				AND id_music=$idMusic;";
		$result = $db->doQuery($sql);
		$db->disconnect();
		
		return $result;
	}
	
//Others

	
	
}