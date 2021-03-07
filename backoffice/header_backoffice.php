<?php 
session_start();
$unique = uniqid();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/style_backoffice.css?<?php echo $unique; ?>">
 
    <title>Willy Brewing</title>

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@500&family=Montserrat&display=swap" rel="stylesheet">

    <!-- script CDN pour ckeditor -->
    <script src="https://cdn.ckeditor.com/ckeditor5/22.0.0/classic/ckeditor.js"></script>
   
</head>

<body>

    <div class="admin d-flex bd-highlight align-items-center">

        <div class="p-2 bd-highlight d-flex justify-content-center col-2">
            <img src="../img/logo-admin1.png" class="logo-admin" width="150" height="auto" alt="logo Willy Brewery">
        </div>

        <div class="flex-grow-1 bd-highlight align-self-center d-flex justify-content-center col-8">
            <h1 style="text-align:center" >
                Administration du site
            </h1>
        </div>

    </div>

    <!-- Navbar -->

        <nav class="navbar navbar-back navbar-expand-md navbar-light bg-light d-flex justify-content-md-center justify-content-around">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- disconnect -->
            <div>
                <form method="post" action="../library/logout.php" id="form_session_destroy">
                    <input type="hidden" id="logout_hidden" name="logout_hidden"/>
                </form>
                <button type="button" id="destroy_session" class="btn btn-light ml-5" >Se déconnecter <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-power" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.578 4.437a5 5 0 1 0 4.922.044l.5-.866a6 6 0 1 1-5.908-.053l.486.875z"/><path fill-rule="evenodd" d="M7.5 8V1h1v7h-1z"/></svg></button>
            </div>

            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="navbar-nav col-lg-11 col-md-12">

                <ul class="navbar-nav mx-auto">
                    <?php if($_SESSION['level_admin']>=4){?>                    
                        <li class="nav-item <?php echo ($page_name == 'moderation_backoffice') ? 'active' : '';?>">
                            <a class="m-1 nav-link" href="moderation_backoffice.php">Modération des commentaires <span class="sr-only">(current)</span></a>
                        </li>
                    <?php } ?>

                    <?php if($_SESSION['level_admin']==5){?>                    
                        <li class="nav-item <?php echo ($page_name == 'administration_page_backoffice') ? 'active' : '';?>">
                            <a class="m-1 nav-link" href="administration_page_backoffice.php">Administration des pages-présentation</a>
                        </li>
                    <?php } ?>

                    <?php if($_SESSION['level_admin']==5){?>                    
                        <li class="nav-item <?php echo ($page_name == 'administration_article_backoffice') ? 'active' : '';?>">
                            <a class="m-1 nav-link" href="administration_article_backoffice.php">Administration des articles</a>
                        </li>
                    <?php } ?>

                    <?php if($_SESSION['level_admin']==5){?>                    
                        <li class="nav-item <?php echo ($page_name == 'administration_pot_link') ? 'active' : '';?>">
                            <a class="m-1 nav-link" href="administration_pot_link.php">Lien pour la cagnotte</a>
                        </li>
                    <?php } ?>


                    <?php if($_SESSION['level_admin']==5){?>                    
                        <li class="nav-item <?php echo ($page_name == 'administration_newsletter') ? 'active' : '';?>">
                           <a class="m-1 nav-link" href="administration_newsletter.php">Newsletter</a>
                        </li>
                    <?php } ?>
                </ul>

                </div>
            </div>
        </nav>

    <div class="container">