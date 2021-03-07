
<?php 
include_once("../library/connection_database.php");
include_once("../library/function.php");
$page_name = "all_articles";
include_once("header_frontoffice.php");
include_once("../upload_image.php");

// recover 
if(isset($_GET['id'])){
    $id_article = $_GET['id'];
    // var_dump($id_article);

    $article = recover_single_article($id_article);
    // var_dump($article);

    //recover image article
    $image_article = recover_image_article($id_article);
    //  var_dump($image_article);

    //enregistrer nouveau commentaire
    if(isset($_POST['insert']) && empty($_POST['honeyPot'])){
        $id_article = $_POST['id_article'];
        $firstname = htmlspecialchars($_POST['firstname_comment']);
        $email = filter_var($_POST['email_comment'], FILTER_SANITIZE_EMAIL);
        var_dump($email);
        $content = htmlspecialchars($_POST['content_comment']);

    insert_commentary($id_article, $firstname, $email, $content);

   } 

   //recover 2 last commment
    $comments = recover_comment($_GET['id'], 0);

    if(isset($_POST['btn_more'])){
        $btn_more = $_POST['btn_more'];
        $comments = recover_comment($_GET['id'], 1);
        // var_dump($first_comments);
    }
}
?>



<div>
    <h3 class="d-flex justify-content-center"><?php echo $article[0]->title_article;?></h3>
    <h6 class="d-flex justify-content-center"> 
        <?php $date_ve = $article[0]->date_in_article;
        echo $date = date_vf($date_ve);
        ?>
    </h6>
    <?php if($image_article){ ?>
        <div class="center">
            <img src="../uploads/<?php if(isset($image_article)){echo $image_article[0]->name_image;}?>" width="35%" height="auto" class="thumbnail_article" alt="image de l'article">
        </div>
    <?php } ?>

    <p class="d-flex justify-content-center text-justify col-10 m-1">
        <?php echo $article[0]->content_article;?>
    </p>

</div>



<!-- Share -->
<div class="post-share d-flex align-items-baseline ">
        <p>Partager l'article :</p>

        <!-- script to share on fb -->
        <div id="fb-root" class="m-1"></div>
            <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
            fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>

        <!-- to share on fb -->
        <div class="JSrslink" data-href="https://www.facebook.com/sharer/sharer.php?u=<?php echo "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];?>" data-layout="button">
            <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];?>&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore" data-share="true"><img alt="facebook" src="../img/logo_facebook.png" height="24" width="24"></a>
        </div>
        <!-- &amp;src=sdkpreparse -->
        <!-- btn ne fonctionne pas, certainement un probleme de lien transmis
            une fois herbergé, faire des test avec : https://developers.facebook.com/tools/debug/ -->


        <!-- to share on twitter -->
        <div class="m-1">
            <a target="_blank" class="JSrslink" href="https://www.twitter.com/share?url=<?php echo "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];?>" title="Partager l'article sur Twitter"><img alt="Twitter" src="../img/logo_twitter.png" height="24" width="24" data-size="large" data-via="twitter_username" data-count="none" data-dnt="true"></a>
        </div>

        <!-- to copy url -->
        <div class="">
            <img src="../img/link.png" alt="Link" class="clipboard" title="Copier le l'url de la page" height="24" width="24">
        </div>
        
</div>

<!-- Bloc comment -->
<form class="mb-0 text-justify"  action="" method="post" class="form-example">
    <div class="d-flex justify-content-center"> 
        <fieldset id="comment">
            
            <legend id="legend" class="container d-flex justify-content-center col-5 m-2">Commentaire</legend>
                <div class="d-flex row">
                    <span class="col-lg-6 col-12">Ajouter un commentaire:</span><br>
                    <span class="col-lg-6 col-12">* : champs obligatoires</span><br>
                </div>    

                <br>
                <label class="mb-1" for="firstname_comment">Prénom*:</label><br>
                <input class="col-lg-6 mb-1" type="text" name="firstname_comment" required><br>

                <label class="mb-1" for="email">Email*:</label><br>
                <input class="col-lg-8 mb-1" type="email" name="email_comment" required><br>

                <label class="mb-1" for="content_comment">Commentaire*:</label><br>
                <input class="col-12 mb-1" type="text" name="content_comment" required><br>

                <div class="d-flex justify-md-content-between justify-content-center align-items-center row m-3">
                    <span class=""><input class="" type="checkbox" name="accept_cgu_content" aria-label="Checkbox for comment" required>&nbsp;En cochant cette case, j'accepte les&nbsp;<a href="">CGU.</a></span>
                    <input class="submit-comment m-3" name="insert" type="submit" value="Publier le commentaire">
                    <input type="hidden" name="id_article" value="<?php echo $id_article; ?>">
                </div>

                <!-- Security -->
                <input type="hidden" name="honeyPot" value="">
            
        </fieldset>
    </div>
    
    <!-- display comments -->
    <div class="m-3">
        <?php if($comments){ 
            ?>
            <span class="m-1">Dernier(s) commentaire(s):</span>
            
            <div class="mx-1">
                <?php if(isset($comments)){
                    foreach ($comments as $row) { ?>

                    <div class="comment_added d-flex bd-highlight my-2 mb-1 row">
                        <span class="mr-auto p-2 bd-highlight mx-2">Prénom: <?php echo $row->firstname_comment; ?></span>
                        <span class="p-2 bd-highlight mx-2"><?php echo $date = date_vf($row->date_in_comment); ?></span>
                        <span class='p-2 pt-0 col-12 mx-2'>Commentaire: <?php echo $row->content_comment; ?></span>
                    </div>

                <?php 
                    }
                }
                ?>
            </div>
        <?php } ?>
    </div>

</form>

<form action="" method="post" class=" d-flex justify-content-center mb-3">
    <?php if($comments){ ?>
        <button type="submit" value="1" name="btn_more" class="btn more_comment">
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-down-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
            <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v5.793l2.146-2.147a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 1 1 .708-.708L7.5 10.293V4.5A.5.5 0 0 1 8 4z"/>
            </svg>
            Voir tous les commentaires
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-down-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
            <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v5.793l2.146-2.147a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 1 1 .708-.708L7.5 10.293V4.5A.5.5 0 0 1 8 4z"/>
            </svg>
        </button>
    <?php } ?>
</form>

<?php
include_once("footer_frontoffice.php");
?>

<!-- modal - comment send -->
<div class="modal fade" id="modal_comment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Merci !</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Votre commentaire est en cours de validation par le modérateur !
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>

  <!-- quand le post du nouveau commentaire est bien parti : lancer la modal -->
  <script>

        <?php if(isset($_POST['insert'])){?>
            $('#modal_comment').modal('show')
        <?php } ?>

  </script>

  