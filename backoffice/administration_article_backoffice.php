<?php 
include_once("../library/connection_database.php");
include_once("../library/function.php");
$page_name = "administration_article_backoffice";
include_once("header_backoffice.php");
include_once("../upload_image.php");

// Ajouter une carte
if(isset($_POST['submit_add'])){
    insert_article($_POST['id_category'], $_POST['title_article'], $_POST['content_article'] );
};

// supprimer article
if(isset($_POST['submit_delete'])){
    delete_article($_POST['id_article']);
};

// supprimer une carte
if(isset($_POST['submit_image'])){
    delete_image($_POST['submit_image']);
};

// mise à jour des textes de l'article
if (isset($_POST['submit_upload'])){
    maj_texts_article($_POST['id_article'], $_POST['title_article'], $_POST['content_article']); 
};

//selectionner un article
if (isset($_POST['id_category'])){
    $article = select_article($_POST['id_category']);
};

// si pas vide, on appelle la fonction pour recuperer
if (isset($_POST['id_article'])){
    // contenu image 
    $recover =  recover_image_article($_POST['id_article']);
    // var_dump($recover);

    //les textes
    $text = recover_text_article($_POST['id_article']);
    // var_dump($text);

};

?>


<!-- formulaire pour l'ensemble du contenu : spécifique pour le chargement d'un contenu diversifié-->
<form action="" method="post" enctype="multipart/form-data">


    <!-- le selecteur de la catégorie -->
    <div class="form-group d-flex justify-content-center my-4">

        <select id="inputCategory" onchange="submit()" name="id_category" class="form-control col-md-3 col-5" required>
            <option >Selection de la catégorie</option>
                <option value="1" <?php if(isset($_POST['id_category']) && $_POST['id_category']==1){echo ' selected';} ?>>Actualités</option>
                <option value="2" <?php if(isset($_POST['id_category']) && $_POST['id_category']==2){echo ' selected';} ?>>Recettes</option>
        </select>
    </div>


    <!-- le selecteur de l'article -->
    <div class="form-group d-flex justify-content-center my-4">

        <select id="inputArticle" name="id_article" onchange="submit()" class="form-control col-md-3 col-5">
            <option value="0" >Selection de l'article</option>
            <?php foreach ($article as $row) { ?>
                <option <?php if(isset($_POST['id_article']) && $_POST['id_article'] == $row->id_article){ echo ' selected';}else{ echo '';}?> value="<?php echo $row->id_article; ?>"><?php  echo $row->title_article; ?></option>
            <?php }; ?>
        </select>

    </div>


    <div class="row d-flex justify-content-xl-between">

        <div class="col-md-6 col-12">

            <div>
                <input class="col-12 my-4" type="text" name="title_article" id="" value="<?php if(isset($text->title_article)){ echo $text->title_article;}; ?>" placeholder="Titre de l'article">
            </div>

            <!-- ckeditor -->
            <div id="editor_article">
                <textarea cols=134 rows=7 id="editor" name="content_article"><?php if(isset($text->content_article)){ echo $text->content_article;}; ?></textarea> 
            </div>

        </div>


        <!-- bloc de la photo -->
        <!-- ne s'affiche pas si l'article n'a pas deja ete créé -->
        <?php if(isset($_POST['id_article']) && $_POST['id_article']!=0){?>

            <div class="col-md-6 col-12 my-4">
                <div>
                    <h6 class="d-flex justify-content-center">Choix de la photo mise en avant :</h6>
                </div>

                <div class="row d-flex justify-content-center">

                    <div class="row d-flex justify-content-center col-xl-6 m-2">
                        <?php if(isset($recover)){
                        if(count($recover) < 1){ ?>
                            <input class="col-xl-12 col-8 my-1" type="file" name="photo[]"><br>
                            <!-- permet dans upload_image php , de voir dans quelle page se trouve la requete    -->
                            <input type="hidden" name="image_article" value="1">
                        <?php }
                    } ?>
                    </div>

                    <div class="col-xl-12 m-1 row d-flex justify-content-around">
                        <?php if(isset($recover)){
                            foreach($recover as $row){ ?>

                                <div class="card col-xl-5 col-md-7 col-10 mt-1" style="width: 18rem;">
                                
                                <!-- protege si pas d'image -->
                                <?php if(isset($row->name_image)){?>
                                <!-- recup image attenante -->
                                    <img src="../uploads/<?php if(isset($row->name_image)){echo $row->name_image;};?>" class="card-img-top m-1" alt="image">
                                    <div class="card-body">
                                        
                                        <div class="d-flex justify-content-center">                                    
                                            <button type="submit_image" value="<?php if(isset($row->id_image)){echo $row->id_image;}; ?>" name="submit_image" class="btn btn-outline-danger" onclick="return window.confirm('Êtes vous sûr de vouloir supprimer cette immage ?')">Supprimer</button>
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
            
        <?php } ?>



    </div>

    <!-- submit de la page - s'adapte en fonction de si id_article est renseigné -->
    <div class="row d-flex justify-content-xl-between justify-content-center m-2">
        <?php if(isset($_POST['id_article'])==0){?>
            <input class="btn btn-outline-primary col-xl-2 col-md-3 col-7 m-1" name="submit_add" type="submit" value="Ajouter article">
        <?php }else{ 
            if(($_POST['id_article']==0)){?>
            <input class="btn btn-outline-primary col-xl-2 col-md-3 col-7 m-1" name="submit_add" type="submit" value="Ajouter article">
        <?php }else{ ?>
            <input class="btn btn-outline-success col-xl-2 col-md-3 col-7 m-1" name="submit_upload" type="submit" value="Enregistrer">
            <input class="btn btn-outline-danger col-xl-2 col-md-3 col-7 m-1 p-1" name="submit_delete" type="submit" value="Supprimer l'article" onclick="return window.confirm('Êtes vous sûr de vouloir supprimer cet article ?')">
        <?php }}; ?>
    </div>

    <!-- fin du formulaire -->
</form>

<?php
include_once("footer_backoffice.php");
?>

<script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });
</script>