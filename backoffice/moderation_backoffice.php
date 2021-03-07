<?php 
include_once("../library/connection_database.php");
include_once("../library/function.php");
$page_name = "moderation_backoffice";
include_once("header_backoffice.php");

//Pour viser le commentaire sur lequel on veut faire une action 
if(isset($_POST)){

    // Si on a cliqué sur supprimer :
    if(isset($_POST['supprimer'])){
        delete_comment($_POST['id_comment']);
    }
    
    // Si on a cliqué sur valider :
    if(isset($_POST['valider'])){
        update_comment($_POST['id_comment']);
    }
};

$comments = read_all_comments();

?>

<div class="container col-xl-8 col-12">

    <?php foreach($comments as $row){?>

        <form class="d-flex justify-content-center m-3" action="" method="post" class="form">
        
                <fieldset class="col-12">

                    <div class="d-flex justify-content-between">
                        <div class="form">
                            <label><U>Prénom</U> : <?php echo $row->firstname_comment;?></label>
                        </div>
                        <div>
                            <label><?php echo $row->date_in_comment;?></label>
                        </div>
                    </div>

                    <div class="form">
                        <label><U>Commentaire</U> : <?php echo $row->content_comment;?></label><br>
                    </div>
                    <div class="form">
                        <label><?php  echo ($row->visible == 1 ) ? 'Ce commentaire a été publié.' : '';?></label>
                    </div>

                    <input type="hidden" name="id_comment" value="<?php echo $row->id_comment;?>">

                    <div class="d-flex justify-content-center">
                        <button type="submit" name="valider" value="valider" class="btn btn-secondary col-xl-2 col-md-4 col-6 m-1" onclick="return window.confirm('Êtes vous sûr de vouloir valider ce commentaire ?')">Valider</button>
                        <button type="submit" name="supprimer" value="supprimer" class="btn btn-danger col-xl-2 col-md-4 col-6 m-1" onclick="return window.confirm('Êtes vous sûr de vouloir supprimer ce commentaire ?')">Supprimer</button>
                    </div>

                </fieldset>

        </form>
    <?php }; ?>
</div>

<?php 
include_once("footer_backoffice.php");
?>