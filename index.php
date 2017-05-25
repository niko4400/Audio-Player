<?php
    include_once  'session_start.php';
    include_once 'database/DatabaseConnect.php';
    include_once 'model/User.php';
    $auth = session_check();
    $dbConnection = new DatabaseConnect();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <title>Audio-Player</title>
    <meta charset="utf-8"/>
    <meta name="description" content="Strona audio">
    <meta name="keywords" content="HTML,audio">
    <meta name="author" content="JNiko">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">




    <!-- Stylesheets-->
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
    <link rel="stylesheet" type="text/css" href="public/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="public/css/style.css"/>

   <!-- scripts-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="public/js/script.js"></script>
<script src="public/js/jquery.sticky.js"></script>
<script>
    $(document).ready(function(){
        $("#sticker").sticky({topSpacing:0});
    });
</script>

</head>
<body>
<div class="container">
    <div class="jumbotron" style="margin-top:1%">
        <h1>Chcesz więcej?</h1>
        <p>Chcesz więcej informacji?</p>
        <p><a class="btn btn-primary btn-lg">Więcej</a></p>
    </div>

<nav id="sticker"  class="navbar navbar-default ">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="?p=homepage#sticker">
                Home
            </a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <?php
                    if($auth==true) {
                        echo '
                <li class="dropdown">
                    <a href="#" 
                        class="dropdown-toggle" 
                        data-toggle="dropdown" 
                        role="button" 
                        aria-expanded="false">Muzyka
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="?p=dodajplaylista#sticker">Nowa Playlista</a></li>
                        <li><a href="?p=dodajutwor#sticker">Dodaj utwory</a></li>
                        <li class="divider"></li>
                        <li><a href="?p=edytujplaylista#sticker">Edytuj kategorie</a></li>
                        <li class="divider"></li>
                        <li><a href="?p=usunkategoria#sticker">Usuń kategorie</a></li>
                        <li><a href="?p=usunutwor#sticker">Usuń utwory</a></li>';
                        if($_SESSION['admin']==1)
                            echo ' <li><a href="?p=dodajmuzyke#sticker">Aktualizuj muzyke</a></li>';
                        echo'
                    </ul>
                </li> ';}
                echo '
                <li><a href="?p=kontakt#sticker">Kontakt</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
            ';
                if($auth==true) {
                    echo'
                <li><a href="?p=profil#sticker">'.$_SESSION['login'].'</a></li>
                
                <li><a href="?p=wyloguj">Wyloguj</a></li>';
                }else
                    echo '
                 <li><a href="?p=logowanie">Zaloguj</a></li>
                 <li><a href="?p=rejestracja">Rejestruj</a></li>';
                ?>
            </ul>
        </div>
    </div>
</nav>

<?php
switch($_GET['p']){
    case 'rejestracja':
        include('auth/rejestracja.php');
        break;
    case 'logowanie':
        include('auth/logowanie.php');
        break;
    case 'wyloguj':
        include('auth/wyloguj.php');
        break;
    case 'dodajplaylista':
        include('views/dodaj_playlista.php');
        break;
    case 'edytujplaylista':
        include('views/edytuj_playlista.php');
        break;
    case 'dodajmuzyke';
        include('views/dodaj_muzyke.php');
        break;
    case 'dodajutwor':
        include('views/dodaj_utwor.php');
        break;
    case 'usunkategoria':
        include('views/usun_kategoria.php');
        break;
    case 'usunutwor':
        include('views/usun_utwor.php');
        break;
    case 'profil':
        include('views/profil.php');
        break;
    case 'kontakt':
        include('views/kontakt.php');
        break;
    case 'homepage':
        include('views/home_page.php');
        break;

    default:
        include ('views/home_page.php');
}



?>

<div class="panel-footer text-center" style="min-height: 10vh">
    Wszelkie prawa zastrzeżone <br>
       &copy Adam Goraj <br>
	STRONA TESTOWA

</div>
</div> <!-- container-->

</body>
</html>