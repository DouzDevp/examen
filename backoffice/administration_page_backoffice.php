<?php
include_once("../library/connection_database.php");
include_once("../library/function.php");
$page_name = "administration_page_backoffice";
include_once("header_backoffice.php");
include_once("../upload_image.php");

$page = select_page();
// var_dump($page);
// $page = afficher_page($id_presentation);
// var_dump($page);
// supprimer une carte
if(isset($_POST['submit_card'])){
    delete_card($_POST['submit_card']);
}


if (isset($_POST['submit_page'])){
    maj_text_page($_POST['id_presentation'], $_POST['content_presentation']); 
};


// si pas vide, on appelle la fonction pour recuperer
if (isset($_POST['id_presentation'])){
    // contenu page 
  $recover = recover_image_presentation($_POST['id_presentation']);  
    //le texte
  $text = recover_text_presentation($_POST['id_presentation']);
};

?>

<!-- formulaire pour l'ensemble du contenu : spécifique pour le chargement d'un contenu diversifié-->
<form action="administration_page_backoffice.php" id="formId" method="post" enctype="multipart/form-data">


    <!-- le selecteur de page -->
    <div class="form-group d-flex justify-content-center my-4">

        <select id="inputPage" name="id_presentation" onChange="submit()" class="form-control col-md-3 col-5" required>
            <option value="" >Selection de la page</option>
            <?php foreach ($page as $row) { ?>
                <option <?php if(isset($_POST['id_presentation']) && $_POST['id_presentation'] == $row->id_presentation){ echo ' selected';}else{ echo '';}?> value="<?php echo $row->id_presentation; ?>"><?php  echo $row->title_presentation; ?></option>
            <?php }; ?>
        </select>

    </div>

    <div class="row d-flex justify-content-xl-between">

        <div class="col-md-6 col-12">

            <!-- ckeditor -->
            <div id="editor123">
                <textarea cols=134 rows=7 id='editor' name='content_presentation'><?php echo @$text->content_presentation; ?></textarea> 
            </div>
            
        </div>

        <!-- bloc des photos -->
        <div class="col-md-6 col-12 my-4">
            <div>
                <h6 class="d-flex justify-content-center">Choix des photos (4 max. et 300x300px)</h6>
            </div>

            <div class="row d-flex justify-content-center">

                <?php if(isset($recover)){
                    if(count($recover) < 4){ ?>
                        <div class="row d-flex justify-content-center col-xl-6 m-2">
                
                            <input class="col-xl-12 col-8 my-1" type="file" name="photo[]"><br>
                            <textarea class="col-xl-11 col-8 my-1" name="desc[]" id="" cols="26" rows="2" maxlength="40"></textarea><br>

                        </div>
                    <?php }
                } ?>

                <div class="col-xl-12 m-1 row d-flex justify-content-around">
                    <?php  ?>
                    <?php if(isset($recover)){
                        foreach($recover as $row){ ?>

                            <div class="card col-xl-5 col-md-7 col-10 mt-1" style="width: 18rem;">
                              
                            <!-- protege si pas d'image -->
                            <?php if(isset($row->name_image)){?>
                            <!-- recup image attenante -->
                                <img src="../uploads/<?php if(isset($row->name_image)){echo $row->name_image;};?>" class="card-img-top m-1" alt="image">
                                <div class="card-body">
                                    <!-- recup desc attenante -->
                                    <input class="col-xl-12 col-12 my-1 p-1" type="text" name="desc[]" value="<?php if(isset($row->desc_image)){echo $row->desc_image;};?>"><br>
                                    <div class="d-flex justify-content-center">                                    
                                        <button type="submit" value="<?php if(isset($row->id_image)){echo $row->id_image;}; ?>" name="submit_card" class="btn btn-outline-danger" onclick="return window.confirm('Êtes vous sûr de vouloir supprimer ce contenu ?')">Supprimer</button>
                                    </div>
                                </div>
                            <?php };?>        

                                <!-- input hidden : envoyer l'id de l'img pour pourvoir ensuite l'administrer-->
                                <input type="hidden" name="id_image" value="<?php if(isset($row->id_image)){echo $row->id_image;};?>">
                            </div>
                        <?php }
                    } ?>

                    
                </div>

            </div>
        </div>

    </div>


    <!-- submit de la page -->
    <div class="d-flex justify-content-center m-3">
        <!-- recup article si il y en a un -->
        <!-- <input type="hidden" name="id_presentation" value=""> -->
        <input class="btn btn-outline-success col-xl-2 col-md-3 col-5 p-1" name="submit_page" type="submit" value="Enregistrer">
    </div>

<!-- fin du formulaire -->
</form>
    

<?php
include_once("footer_backoffice.php");
?>

<!-- script ckeditor -->
<script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });
</script>