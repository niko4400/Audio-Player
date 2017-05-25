<?php
/**
 * Created by PhpStorm.
 * User: Adam
 * Date: 2017-04-06
 * Time: 20:16
 */

include_once 'DatabaseConnect.php';
include_once '../model/Track.php';

$dbConnection = new DatabaseConnect();


if(isset($_POST['action']) && !empty($_POST['action'])) {
    $action = $_POST['action'];
    $idPlaylist = $_POST['id_kategoria'];
    $idTrack = $_POST['id_utwor'];
    switch($action) {
    	case '+' : Track::addTrack($dbConnection,$idPlaylist,$idTrack);break;
    	case '-' : Track::deleteAjaxTrack($dbConnection,$idPlaylist,$idTrack);break;
        // ...etc...
    }
    $dbConnection->disconnect();
}