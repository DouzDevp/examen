<?php 
include_once("../library/connection_database.php");
include_once("../library/function.php");
$page_name = "administration_pot_link";
include_once("header_backoffice.php");

// Ajouter un lien
if(isset($_POST['submit_add'])){
    insert_link($_POST['url_pot']);
};

// Supprimer le lien
if(isset($_POST['submit_delete'])){
    delete_link();  
}; 

// Afficher le lien  
$link= recover_link();
// var_dump($link);
?>

<!-- gestion du lien -->
<form action="" method="post"> 

    <!-- si on a deja un lien, on désactive -->
    <?php if(!$link){?>

        <input type="url" name="url_pot" id="" placeholder="Lien pour une nouvelle cagnotte">

        <input class="btn btn-outline-primary col-xl-2 col-md-3 col-7 m-1" name="submit_add" type="submit" value="Ajouter le lien">

    <?php };?>

    <br>
            
    <?php if($link){?>

        <span> Lien actuel : 
            <?php echo $link->url_link;?>
        </span>

        <input class="btn btn-outline-danger col-xl-2 col-md-3 col-7 m-1" name="submit_delete" type="submit" value="Supprimer le lien" onclick="return window.confirm('Êtes vous sûr de vouloir supprimer ce commentaire ?')">

    <?php }; ?>


</form>

<?php 
include_once("footer_backoffice.php");
?>