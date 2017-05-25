
<?php
include_once 'model/Playlist.php';

if(isset($_POST['name'])) {
	$name = $_POST['name'];
	$playlist = new Playlist();
	$playlist->addPlaylist($dbConnection, $name);
	}

?>


<div class="container panel panel-default" style="margin-top: 5%">
    <div class="panel-body">
        <?php
            if($_POST) {
                echo '
                    <div class="alert alert-dismissible alert-success">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Stworzono</strong> 
                            pomyślnie nową playliste.
                            <a href="?p=dodajutwor" class="alert-link">
                            Możesz teraz dodać do niej wybrane utwory</a>.
                     </div>
                ';
            }
        ?>

        <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <fieldset>
                <legend>Nowa Playlista</legend>
                <div class="form-group col-lg-12">
                    <img    id="photo"
                            class="img-thumbnail"
                            src="public/img/noimage.jpg"
                            style="max-height: 250px"/>
                    <br>

                    <label class="control-label" for="name"><h4>Nazwa</h4></label>
                    <input class="form-control"
                           style="width: 30%"
                           id="name"
                           name="name"
                           placeholder="Moja playlista"
                           type="text" required>


                    <label class="control-label" for="file">Dodaj zdjęcie</label>
                    <input id="file"
                           type="file"
                           class="file"
                           name="plik"
                           style="color: #d7d5dd"
                           accept="image/*"
                           onchange="loadFile(event)" required>
                    <button
                            type="submit"
                            class="btn btn-default btn-lg btn-block center-block"
                            style="border-radius: 13px;margin-top: 2%">Enter
                    </button>
                </div>
            </fieldset>
        </form>
    </div>
</div>


</div>