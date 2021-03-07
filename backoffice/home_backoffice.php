<?php 
include_once("../library/connection_database.php");
include_once("../library/function.php");


if(isset( $_POST['login_admin'])){
    $login = $_POST['login_admin'];
    $pwd = $_POST['password_admin'];
    $ok = checkLogin($login, $pwd);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <title>Brasserie - Backoffice</title>
</head> 

<body>

    <div class="container">

        <div class="d-flex bd-highlight align-items-center">

            <div class="p-2 bd-highlight d-flex justify-content-center col-2 m-2">
                <img src="../img/logo-admin1.png" width="120" height="120" alt="logo Willy Brewery">
            </div>

            <div class="align-self-center d-flex justify-content-center col-8">
                <h3 class="">
                    Administration du site
                </h3>
            </div>

        </div>


        <form class="d-flex justify-content-center col-8 offset-2" action="" method="post" class="form-example">

            <div class="container">
                <fieldset>
                    <legend class="d-flex justify-content-center col-10 col-xl-4 m-2">Se connecter</legend>
                    <div class="form-example">
                        <label for="name">Identifiant:</label><br>
                        <input class="d-flex justify-content-center col-xl-8 col-11" type="email" name="login_admin" id="name" required>
                    </div>
                    <div class="form-example">
                        <label for="email">Mot de passe:</label><br>
                        <input class="d-flex justify-content-start col-xl-8 col-11" type="password" name="password_admin" id="email" required>
                    </div>
                    <div class="form-example d-flex justify-content-end">
                        <input class="button-connexion" type="submit" value="Valider">
                    </div>
                </fieldset>
            </div>

        </form>

    </div>
    
    <?php include_once('footer_backoffice.php'); ?>
    
</body>