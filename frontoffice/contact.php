<?php 
include_once("../library/connection_database.php");
include_once("../library/function.php");
$page_name = "contact";
include_once("header_frontoffice.php");
include_once("../upload_image.php");

?>

<!-- <div class="d-flex justify-content-center col-xl-12 my-4">
    <h3 class="center">
        Contact
    </h3>
</div> -->
<div class="m-2">
    <p>Une question, besoin d'en renseignement, n'hésitez pas à m'envoyer un message !</p>
</div>

<!-- form-contact -->
<form class="m-2 text-justify " action="" method="post" class="form-example">
    <div class="d-flex justify-content-center"> 
        <fieldset id="contact" class="col-md-8 col-12">
            
            <legend class="container d-flex justify-content-center col-4 m-2">Fomulaire</legend>
                <span class="d-flex justify-content-end col-12">* : champs obligatoires</span><br>

                <label class="mb-1" for="lastname_mail">Nom*:</label><br>
                <input class="col-lg-6 mb-1" type="text" name="lastname_mail" required><br>

                <label class="mb-1" for="firstname_mail">Prénom*:</label><br>
                <input class="col-lg-6 mb-1" type="text" name="firstname_mail" required><br>

                <label class="mb-1" for="email">Email*:</label><br>
                <input class="col-lg-6 mb-1" type="email" name="email" required><br>

                <label class="mb-1" for="content_mail">Message* (max : 1000 car.):</label><br>
                <textarea class="col-12 mb-1" name="content_mail" id="" cols="30" rows="5" size="1000" required></textarea>

                <div class="d-flex justify-content-around align-items-center row m-1">
                    <span class="m-1"><input type="checkbox" name="accept_cgu_content" aria-label="Checkbox for comment" required>&nbsp;En cochant cette case, j'accepte les&nbsp;<a href="">CGU.</a></span>
                    <input class="mt-1" name="send" type="submit" value="Envoyer le message">
                </div>

                <!-- security -->
                <input type="hidden" name="honeyPotcontact" value="">

                <?php
                if (isset($_POST['send']) && empty($_POST['honeyPotcontact'])) {
                    $entete  = 'MIME-Version: 1.0' . "\r\n";
                    $entete .= 'Content-type: text/html; charset=utf-8' . "\r\n";
                    $entete .= 'From: ' . $_POST['email'] . "\r\n";

                    $message = '<h1>Message envoyé depuis la page Contact du site</h1>
                    <p><b>Nom : </b>' . htmlspecialchars($_POST['lastname_mail']) . '<br>
                    <p><b>Prénom : </b>' . htmlspecialchars($_POST['firstname_mail']) . '<br>
                    <b>Email : </b>' . htmlspecialchars($_POST['email']) . '<br>
                    <b>Message : </b>' . htmlspecialchars($_POST['content_mail']) . '</p>';

                    $retour = mail('eduardo.me@aol.fr', 'Mail envoyé depuis la page Contact du site', $message, $entete);
 
                }?>

        </fieldset>
    </div>

</form>

<?php
include_once("footer_frontoffice.php");
?>


<!-- modal - comment send -->
<div class="modal fade" id="modal_message" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Merci !</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Votre message a bien été envoyé !
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>

<!-- Confirm message sent -->
<script>

  <?php if($retour) {?>
  // Wait full document ready to show
    $( document ).ready(function(){
    $('#modal_message').modal('show')
    });
  <?php }else{
    echo '<p class="d-flex justify-content-center"><b>Erreur.</p>';
  } ?>

</script>
