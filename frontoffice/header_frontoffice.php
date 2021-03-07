<?php
$unique = uniqid();
include_once("../library/connection_database.php");
include_once("../library/function.php");

// Inscription in newsletter
if(isset($_POST['checkbox_cgu']) && filter_var($_POST['input_email'], FILTER_SANITIZE_EMAIL) && $_POST['button_email'] && empty($_POST['honeyPot'])){
inscript_newsletter($_POST['input_email']);
};

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css?<?php echo $unique; ?>">
    

    <title>Willy Brewing</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@500&family=Montserrat&display=swap" rel="stylesheet">

    <script src="../tarteaucitron/tarteaucitron.js"></script>
    <script>
        tarteaucitron.init({
            "privacyUrl": "", /* URL de la page de la politique de vie privée */

            "hashtag": "#tarteaucitron", /* Ouvrir le panneau contenant ce hashtag */
            "cookieName": "tarteaucitron", /* Nom du Cookie */

            "orientation": "middle", /* Position de la bannière (top - bottom) */
            "showAlertSmall": true, /* Voir la bannière réduite en bas à droite */
            "cookieslist": true, /* Voir la liste des cookies */

            "adblocker": false, /* Voir une alerte si un bloqueur de publicités est détecté */
            "AcceptAllCta": true, /* Voir le bouton accepter tous les cookies (quand highPrivacy est à true) */
            "highPrivacy": true, /* Désactiver le consentement automatique (car interdit dans l'UE) */
            "handleBrowserDNTRequest": false, /* Si la protection du suivi du navigateur est activée, tout interdire */

            "removeCredit": false, /* Retirer le lien vers tarteaucitron.js */
            "moreInfoLink": true, /* Afficher le lien "voir plus d'infos" */
            "useExternalCss": false, /* Si false, tarteaucitron.css sera chargé */

            //"cookieDomain": ".my-multisite-domaine.fr", /* Cookie multisite */

            "readmoreLink": "/cookiespolicy" /* Lien vers la page "Lire plus" */
        });

        // facebook
        (tarteaucitron.job = tarteaucitron.job || []).push('facebook');

        //twitter
        (tarteaucitron.job = tarteaucitron.job || []).push('twitter');

    </script>

<!-- Matomo -->
<script type="text/javascript">
    var _paq = window._paq = window._paq || [];
    /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
    _paq.push(['trackPageView']);
    _paq.push(['enableLinkTracking']);
    (function() {
        var u="//matomo.arjuna85.com/";
        _paq.push(['setTrackerUrl', u+'matomo.php']);
        _paq.push(['setSiteId', '1']);
        var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
        g.type='text/javascript'; g.async=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
    })();
    </script>
    <!-- End Matomo Code -->
</head>

<body>

    <!-- navbar -->
    
    <nav class="navbar navbar-front navbar-expand-md navbar-light bg-light">
       
        <a class="col-2" href="home_frontoffice.php">
            <img src="../img/logo2.png" width="365px" height="auto" class="logo" alt="logo Willy Brewery">
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
   
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="navbar-nav col-10">
                <ul class="navbar-nav mx-auto">
                    <li class="m-1 nav-item <?php echo ($page_name == 'home') ? 'active' : '';?>">
                        <a class="nav-link" href="home_frontoffice.php">Accueil</a>
                    </li>
                    <li class="m-1 nav-item <?php echo ($page_name == 'presentation') ? 'active' : '';?> dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Présentation</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="presentation.php?id=1">Le brasseur</a>
                            <a class="dropdown-item" href="presentation.php?id=2">Le matériel</a>
                            <a class="dropdown-item" href="presentation.php?id=3">Les produits</a>
                        </div>
                    </li>  
                    <li class="m-1 nav-item <?php echo ($page_name == 'all_articles_1') ? 'active' : '';?>">
                        <a class="nav-link" href="all_articles.php?id=1">Actualités</a>
                    </li>
                    <li class="m-1 nav-item <?php echo ($page_name == 'all_articles_2') ? 'active' : '';?>">
                        <a class="nav-link" href="all_articles.php?id=2">Recettes</a>
                    </li>
                    <li class="m-1 nav-item <?php echo ($page_name == 'pot') ? 'active' : '';?>">
                        <a class="nav-link" href="pot.php">Cagnotte</a>
                    </li>
                    <li class="m-1 nav-item <?php echo ($page_name == 'contact') ? 'active' : '';?>">
                        <a class="nav-link" href="contact.php">Contact</a>
                    </li>
                </ul>
            </div>

        </div>
    </nav>

    <div class="wrapper">
    <div class="container">