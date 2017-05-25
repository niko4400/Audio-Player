<?php
$result=false;
if($_POST){
	$result = User::login($dbConnection,$_POST['login'],$_POST['password']);
    if($result!=false) {
        header('location:?p=homepage');
        exit;
    }
};
?>


        <div id="logowanie" class="container panel panel-default">
            <div class="panel-body">
                <form class="form-horizontal" action="" method="post">
                    <fieldset>
                        <legend>Logowanie
                            <?php
                                if($_POST)
                                    if($result==false) {
                                        echo '<p class="text-danger">Logowanie nie powiodło się
                                                    login lub hasło jest nie poprawne</p>';
                                    }
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





