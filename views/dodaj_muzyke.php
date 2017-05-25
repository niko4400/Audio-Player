<?php
/**
 * Created by PhpStorm.
 * User: Adam
 * Date: 2017-03-29
 * Time: 09:36
 */

include_once 'model/Music.php';

if($_POST) {
    for ($i = 0; $i < count($_FILES['plik']['size']); $i++) {
        if ($_FILES['plik']['type'][$i] == 'audio/mpeg' ||
             $_FILES['plik']['type'][$i] =='audio/mp3') {
            $url='music/'.$_FILES['plik']['name'][$i];
            $url = str_replace(" ","_",$url);
            if (move_uploaded_file($_FILES['plik']['tmp_name'][$i], $url)) {
                $expl =explode('.',$_FILES['plik']['name'][$i]);
                $name = $expl[0];
                $author = $expl[1];
                Music::addMusic($dbConnection,$name,$author,$url);
            } else {
                echo'File was not moved successfully';
            }
        } else {
            echo' File is not of the audio/mpeg type';

        }
    }
}

?>


<div class="container panel panel-default" style="margin-top: 5%">
    <div class="panel-body">
        <?php
            if($_POST) {
                echo '
                    <div class="alert alert-dismissible alert-success">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Stworzono</strong> pomyślnie <a href="#" class="alert-link">nową kategorie</a>.
                     </div>
                ';
            }
        ?>

<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
    <fieldset>
        <legend>Nowa muzyka</legend>
        <div class="form-group col-lg-12">
            <input type ="hidden" name ="stop" value="1">

            <label class="control-label" for="plik">Dodaj muzyke</label>
            <input id="plik" type="file" class="file"  multiple="multiple" name="plik[]" required style="color: #d7d5dd">
            <button type="submit" class="btn btn-primary">Enter</button>
        </div>
    </fieldset>
</form>
</div>
</div>


</div>