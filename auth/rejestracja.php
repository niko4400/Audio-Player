<?php
$success=false;
    if($_POST){
    	$success =  User::addUser($dbConnection,$_POST['login'],$_POST['password']);
    };
    ?>
        <div id="logowanie" class="container panel panel-default">
            <div class="panel-body">
                <form class="form-horizontal" action="" method="post">
                    <fieldset>
                        <legend>Rejestracja
                            <?php
                                if($_POST)
                                    if($success==true)
                                        echo '<p class="text-success">Rejestracja przebiegła pomyślnie</p>';
                                    else
                                        echo '<p class="text-danger">Rejestracja nie powiodła się
                                                login jest już zajęty lub mała ilość znaków</p>';
                            ?>
                        </legend>
                        <div class="form-group col-lg-12">
                            <label class="control-label" for="focusedInput"><h4>Login</h4></label>
                            <input class="form-control" name="login" id="focusedInput" placeholder="Login" type="text" required>
                            <label class="control-label" for="inputDefault"><h4>Hasło</h4></label>
                            <input class="form-control" name="password" id="inputDefault" placeholder="Hasło" type="password" required>
                            <button type="submit" class="btn btn-primary">Enter</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>