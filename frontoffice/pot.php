
<?php 
include_once("../library/connection_database.php");
include_once("../library/function.php");
$page_name = "pot";
include_once("header_frontoffice.php");
include_once("../upload_image.php");

$recover = recover_link();
// var_dump($recover);

?>

<div class="d-flex justify-content-center col-xl-12 my-4">
    <h3 class="center">
        Financement participatif
    </h3>
</div>

<div class="text-justify">

    <p>Si vous avez apprécié votre visite sur ce site, et que vous avez envie d'en voir de nouvelles, je propose à ceux qui le souhaite de me soutenir financièrement dans mes aventures. En effet, je mets en place régulièrement des cagnottes en ligne sur PayPal pour financer les projets !</p>

    <!-- Share -->
    <div class="post-share my-2">
            <p>Partager la page:</p>

            <a class="JSrslink" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];?>" title="Partager l'article sur Facebook" data-share="true"><img alt="facebook" src="../img/logo_facebook.png" height="24" width="24">
            </a>

            <a class="JSrslink" href="https://www.twitter.com/share?url=<?php echo $url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];?>" title="Partager l'article sur Twitter"><img alt="Twitter" src="../img/logo_twitter.png" height="24" width="24" class="twitter-share-button" data-size="large" data-via="twitter_username" data-count="none" data-dnt="true">
            </a>

            <img src="../img/link.png" alt="Link" class="clipboard" title="Copier le l'url de la page" height="28" width="28">
            
    </div>

    <div class="row">
        <div class="start col-md-6 col-12">
            <ul><h6>Pourquoi Paypal ?</h6></ul>
                <li>Les transferts en euros dans l'Union-Européenne sont gratuits.</li>
                <li>Les transferts sont sécurisés.</li>
                <li>Vous pouvez retrouvez toutes les informations concernant ce système <a href="https://www.paypal.com/fr/webapps/mpp/money-pools">ici</a> (oui, c'est un lien : il faut donc cliquer dessus si ça t'intérèsse).</li>
        </div>

        <div class="center col-md-6 col-12">
        <img src="../img/illustration.jpg" alt="Illustration PayPal" class="m-2" width="40%">
        </div>  
    </div>

    <div class="row mt-2">
        <div class="start col-md-6 col-12">
            <ul><h6>Besoin de plus d'informations ?</h6></ul>
                <li>Les transferts sont sécurisés.</li>
                <li>Vous pouvez retrouvez toutes les informations concernant ce système <a href="https://www.paypal.com/fr/webapps/mpp/money-pools">ici</a> (oui, c'est un lien : il faut donc cliquer dessus si ça t'intérèsse).</li>
        </div>

        <div class="center col-md-6 col-12">
        <img src="../img/illustration.jpg" alt="Illustration PayPal" class="m-2" width="40%">
        </div>  
    </div>

</div>



<!-- Button_pot -->

<?php if($recover){ ;?>

    <div class="d-flex justify-content-center align-items-center m-2">
        <a href="<?php echo $recover->url_link ;?>"target="_blank">
            <button type="button" href=""  class="btn btn-outline-success">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-link" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path d="M6.354 5.5H4a3 3 0 0 0 0 6h3a3 3 0 0 0 2.83-4H9c-.086 0-.17.01-.25.031A2 2 0 0 1 7 10.5H4a2 2 0 1 1 0-4h1.535c.218-.376.495-.714.82-1z"/>
                <path d="M9 5.5a3 3 0 0 0-2.83 4h1.098A2 2 0 0 1 9 6.5h3a2 2 0 1 1 0 4h-1.535a4.02 4.02 0 0 1-.82 1H12a3 3 0 1 0 0-6H9z"/>
                </svg>
                Pour accéder à la cagnotte : cliquez ici pour être redirigé vers la page PayPal 
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-link" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path d="M6.354 5.5H4a3 3 0 0 0 0 6h3a3 3 0 0 0 2.83-4H9c-.086 0-.17.01-.25.031A2 2 0 0 1 7 10.5H4a2 2 0 1 1 0-4h1.535c.218-.376.495-.714.82-1z"/>
                <path d="M9 5.5a3 3 0 0 0-2.83 4h1.098A2 2 0 0 1 9 6.5h3a2 2 0 1 1 0 4h-1.535a4.02 4.02 0 0 1-.82 1H12a3 3 0 1 0 0-6H9z"/>
                </svg>
            </button>
        </a>
    </div>

<?php }else{ ?>

    <div class="d-flex justify-content-center align-items-center m-2">
        <button type="button" class="btn btn-outline-warning">
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-link" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path d="M6.354 5.5H4a3 3 0 0 0 0 6h3a3 3 0 0 0 2.83-4H9c-.086 0-.17.01-.25.031A2 2 0 0 1 7 10.5H4a2 2 0 1 1 0-4h1.535c.218-.376.495-.714.82-1z"/>
            <path d="M9 5.5a3 3 0 0 0-2.83 4h1.098A2 2 0 0 1 9 6.5h3a2 2 0 1 1 0 4h-1.535a4.02 4.02 0 0 1-.82 1H12a3 3 0 1 0 0-6H9z"/>
            </svg>
            Il n'y a pas de cagnotte en ce moment !
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-link" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path d="M6.354 5.5H4a3 3 0 0 0 0 6h3a3 3 0 0 0 2.83-4H9c-.086 0-.17.01-.25.031A2 2 0 0 1 7 10.5H4a2 2 0 1 1 0-4h1.535c.218-.376.495-.714.82-1z"/>
            <path d="M9 5.5a3 3 0 0 0-2.83 4h1.098A2 2 0 0 1 9 6.5h3a2 2 0 1 1 0 4h-1.535a4.02 4.02 0 0 1-.82 1H12a3 3 0 1 0 0-6H9z"/>
            </svg>
        </button>
    </div>

<?php } ?>






<?php
include_once("footer_frontoffice.php");
?>

