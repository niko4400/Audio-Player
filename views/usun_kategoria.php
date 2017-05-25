<?php
/**
 * Created by PhpStorm.
 * User: Adam
 * Date: 2017-03-29
 * Time: 14:33
 */

include_once 'model/Playlist.php';


if($_GET['id']) {
    $id = $_GET['id'];
    Playlist::deletePlaylist($dbConnection,$id);

    $_GET['id']='';

}

    $playlists = Playlist::getPlaylists($dbConnection);
    $i =1;
    echo ' 
    <div class="container panel panel-default" style="margin-top: 5%">
        <div class="panel-body">
            <form class="form-horizontal">
                <fieldset>
                    <legend>Usun playliste </legend>
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
                            while($result =$playlists->fetch_array(MYSQLI_ASSOC)) {
                                echo'
                                    <tr>
                                        <td>'.$i.'</td>
                                        <td>'.$result['name'].'</td>';

                                        echo'
                                        <td><a style="border-radius: 13px"
                                            href="?p=usunkategoria&id='.$result['id'].'" class="btn btn-danger">
                                            usun</a>
                                            
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
?>
<div class="clear-both"></div>
