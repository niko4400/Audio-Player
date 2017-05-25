<?php
/**
 * Created by PhpStorm.
 * User: Adam
 * Date: 2017-03-29
 * Time: 11:57
 */

include_once 'model/Playlist.php';
include_once 'model/Track.php';
include_once 'model/Music.php';


$idPlaylist="";
/*if(isset($_GET['id'])&& isset($_GET['id_utwor'])) {
    $idPlaylist = $_GET['id'];
    $idMusic =  $_GET['id_utwor'];

    Track::addTrack($dbConnection,$idPlaylist,$idMusic);
    header('location:index.html?p=dodajutwor&id='.$idPlaylist);
    exit();
}*/

if(isset($_GET['id'])) {
    $idPlaylist = $_GET['id'];
    $playlist = Playlist::getPlaylist($dbConnection, $_GET['id']);
    $result = $playlist->fetch_array(MYSQLI_ASSOC);


    $music = Music::getAvaiableMusic($dbConnection,$idPlaylist);
//echo $music->num_rows;
  /*  if($music->num_rows == 0)
    	$music=Music::getMusic($dbConnection);
    $i=1;*/


    echo '

<div class="container panel panel-default" style="margin-top: 5%">
    <div class="panel-body">
                <legend>Dodaj utwór -> Wybierz playliste -> Dodaj do <b> ' . $result['name'] . '</b> </legend>
                     <table id="table" class="table table-striped table-hover" style="margin-top: 5%">
                        <thead>
                        <tr>                     
                            <th>#</th>
                            <th>dodaj</th>
                            <th>utwór</th>
                            <th>wykonawca</th>                          
                        </tr>
                        </thead>
                        <tbody>
                        ';
                        while($musicRes = $music->fetch_array(MYSQLI_ASSOC)) {
                            echo '
                            <tr>
                            <td>'.$i.'</td>
                            <td>';
                              /*  $url='?p=dodajutwor&id='.$result['id'].'&id_utwor='.$muzyka_res['id'];
                                 echo'
                                  <a href="'.$url.'" class="btn btn-success ">+</a>';*/
                                echo'
                                   <button id="'.$musicRes['id'].'" class="btn btn-success"
                                        onclick=ajax_add('.$musicRes['id'].','.$idPlaylist.') 
                                    style="border-radius: 13px">+</button>';// bez entera bo echo interpretuje biale znaki
                            echo '
                            </td>
                            <td>'.$musicRes['name'].'</td>
                            <td>'.$musicRes['author'].'</td>
                        </tr >
                        ';
                            $i++;
                        }
                        echo'
                        </tbody>
                     </table>
                     <a href="?p=homepage" 
                        class="btn btn-default btn-lg btn-block center-block"
                        style="border-radius: 13px">Dodaj i wróć do strony głównej</a>
    </div>
</div>';
}else {
	$playlists = Playlist::getPlaylists($dbConnection);
    $i =1;
    echo ' 
    <div class="container panel panel-default" style="margin-top: 5%">
        <div class="panel-body">
            <form class="form-horizontal">
                <fieldset>
                    <legend>Dodaj utwór -> Wybierz playliste </legend>
                         <table class="table table-striped table-hover" style="margin-top: 5%">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>nazwa</th>
                                <th>opcja</th>
                            </tr>
                            </thead>
                            <tbody>
                            ';
                             while($result = $playlists->fetch_array(MYSQLI_ASSOC)) {
                               echo'
                                    <tr>
                                        <td>'.$i.'</td>
                                        <td>'.$result['name'].'</td>
                                        <td><a style="border-radius: 13px"
                                            href="?p=dodajutwor&id='.$result['id'].'#sticker" 
                                            class="btn btn-info"
                                            style="border-radius: 13px">
                                            wybierz</a>
                                            
                                            </td>
                                     </tr>';
                                 $i++;
                             }
                             echo '
                            </tbody>
                        </table>                       
                </fieldset>
            </form>
        </div>
    </div>
    ';
}
?>
<div class="clear-both"></div>