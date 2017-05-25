<?php
/**
 * Created by PhpStorm.
 * User: Adam
 * Date: 2017-03-29
 * Time: 14:33
 */

include_once 'model/Track.php';
include_once 'model/Playlist.php';

if(isset($_POST['check_list'])) {
    $checklist=$_POST['check_list'];

    foreach($checklist as $selected) {
        $idTrack  = $selected;
        Track::deleteTrack($dbConnection,$idTrack);
    }

}
if(isset($_GET['id'])) {
    $playlist = Playlist::getPlaylist($dbConnection, $_GET['id']);
    $result = $playlist->fetch_array(MYSQLI_ASSOC);

    $tracks = Track::getTracksPlaylist($dbConnection,$result['id']);


    echo '

<div class="container panel panel-default" style="margin-top: 5%">
    <div class="panel-body">
        <form class="form-horizontal" action="" method="post">
            <fieldset>
                <legend>Usuń : ' . $result['name'] . ' </legend>
                    <table class="table table-striped table-hover" style="margin-top: 5%">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>nazwa</th>
                                <th>wykonawca</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody> ';
                            $i=1;
                            while($trackRes = $tracks->fetch_array(MYSQLI_ASSOC)) {
                                echo'
                                    <tr>
                                        <td>'.$i.'</td>
                                        <td>'.$trackRes['name'].'</td>
                                        <td>'.$trackRes['author'].'</td>
                                        <td>
                                            <label 
                                                id="'.$trackRes['uid'].'label"                                       
                                                for="'.$trackRes['uid'].'" 
                                                class="btn btn-danger"
                                                style="border-radius: 13px">usuń
                                                    <input type="checkbox" 
                                                        name="check_list[]"
                                                        id="'.$trackRes['uid'].'" 
                                                        class="badgebox"
                                                        value="'.$trackRes['uid'].'">
                                                    <span class="badge">&check;</span>
                                            </label>
                                        </td>
                                     </tr>';
                                $i++;
                                }
                 echo '
                            </tbody>
                        </table>
                            <button type="submit" 
                                class="btn btn-default btn-lg btn-block center-block"
                                style="border-radius: 13px">Usuń zaznaczone</button>
            </fieldset>
        </form>
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
                    <legend>Usuń utwór -> Wybierz playliste </legend>
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
                                            href="?p=usunutwor&id='.$result['id'].'#sticker" class="btn btn-info">
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
