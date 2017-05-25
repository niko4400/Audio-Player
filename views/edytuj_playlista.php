<?php

include_once 'model/Playlist.php';

if($_POST) {
    if($_FILES['plik']['error']!=4)
        Playlist::setPlaylistImage($dbConnection,$_GET['id']);

    Playlist::setPlaylistName($dbConnection,$_GET['id'],$_POST['name']);


}
if(isset($_GET['id'])) {
    $playlist = Playlist::getPlaylist($dbConnection, $_GET['id']);
    $result = $playlist->fetch_array(MYSQLI_ASSOC);


    echo '

<div class="container panel panel-default" style="margin-top: 5%">
    <div class="panel-body">
        <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <fieldset>
                <legend>Edytuj playliste -> Wybierz playliste -> Edycja : '.$result['name'].' </legend>
                    <div class="img-thumbnail">';

   					 echo '<img 
						class="img-thumbnail" 
						id="photo" 
						src="data:image/jpeg;base64,'.base64_encode($result['image']).'"
                        style="max-height: 250px"
						/>';
    echo '
                    </div>
                    <br>

                    <label class="control-label" for="focusedInput"><h4>Nazwa</h4></label>
                    <input class="form-control"
                        type="text"
                        id="focusedInput" 
                        name="name" 
                        style="width: 30%"
                        value="'.$result['name'].'" 
                        required
                     >


                    <label class="control-label" for="plik">Dodaj zdjęcie</label>
                    <input id="plik" name="plik" type="file" class="file" style="color: #d7d5dd">
                    <button 
                        type="submit" 
                        class="btn btn-default btn-lg btn-block center-block"
                        style="margin-top: 2%">Zatwierdź zmiany
                    </button>
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
                    <legend>Edytuj playliste -> Wybierz playliste </legend>
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
                                        <td><a href="?p=edytujplaylista&id='.$result['id'].'#sticker" 
                                               class="btn btn-info">
                                            edytuj</a>
                                            
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
