<?php
include_once("../library/function.php");
if (isset($_GET['id'])) {
    $id = $_GET['id'];
$page_name = "all_articles_$id";
include_once("header_frontoffice.php");
include_once("../upload_image.php");

// recover 

    // var_dump($id);

    // recover all 
    // $recover = recover_all_articles($id);
    // var_dump($recover);
}
?>

<div>
    
        <?php if ($_GET['id']==1){?>
            <h3 class="m-3">Actualités 
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-newspaper" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M0 2.5A1.5 1.5 0 0 1 1.5 1h11A1.5 1.5 0 0 1 14 2.5v10.528c0 .3-.05.654-.238.972h.738a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 1 1 0v9a1.5 1.5 0 0 1-1.5 1.5H1.497A1.497 1.497 0 0 1 0 13.5v-11zM12 14c.37 0 .654-.211.853-.441.092-.106.147-.279.147-.531V2.5a.5.5 0 0 0-.5-.5h-11a.5.5 0 0 0-.5.5v11c0 .278.223.5.497.5H12z"/>
                <path d="M2 3h10v2H2V3zm0 3h4v3H2V6zm0 4h4v1H2v-1zm0 2h4v1H2v-1zm5-6h2v1H7V6zm3 0h2v1h-2V6zM7 8h2v1H7V8zm3 0h2v1h-2V8zm-3 2h2v1H7v-1zm3 0h2v1h-2v-1zm-3 2h2v1H7v-1zm3 0h2v1h-2v-1z"/>
            </svg>
            </h3>
            <p>Voici quelques articles sur mes dernières découvertes :</p>
        <?php } else if($_GET['id'] == 2){?>
            <h3 class="m-3">Recettes
            <img src="../img/beer.png" class="icon_beer" alt="icon beer">
            </h3>
            <p>Voici mes dernières recettes, testées et approuvées !</p>
        <?php };?>
    </h3>
</div>

<div class="d-flex-justify-content content m-2">
    <div class="d-flex justify-content-center row">
        <?php 
            $sql = 'SELECT *, article.id_article AS article_id FROM article 
            -- jointure des 2 tables : left fonctionne meme si pas de correspondance entre les deux tables
            LEFT JOIN image_article ON article.id_article = image_article.id_article
            WHERE article.id_category = :id_category ORDER BY date_in_article DESC LIMIT 6';
            $q = $pdo->prepare($sql);
            $q->execute(['id_category' => $id]);

            while($data = $q->fetch(PDO::FETCH_OBJ)){?>
            
                <div class="card-deck d-flex justify-content-center col-lg-4 col-sm-5 col-12 mb-2">
                    <!-- on recupe date_in_article pour savoir quels articles importer dans le infinite scroll §+ quel id_category-->
                    <div class="card post center" date="<?php echo $data->date_in_article;?>" category="<?php echo $data->id_category;?>">
                        
                        <div class="card-body d-flex justify-content-around mb-0 row">
                             <div class="center">
                                <h3 class="card-title"><?php echo $data->title_article; ?></h3>
                            </div>

                            <div class="">
                               <?php if (isset($data->name_image)) {?>
                                    <img src="../uploads/<?php echo $data->name_image; ?>" width="40%" height="auto" class="thumbnail_article" alt="<?php echo $data->name_image; ?>">
                                <?php }else{?>
                                    <img src="../img/no-image-avalaible.jpg" width="50%" height="auto" class="thumbnail_article" alt="no-image-avalaible">
                                <?php } ?>  
                            </div>
                             <!--  -->
                                                        
                        </div>
                        
                        <div class="p-2">
                            <p class="card-text m-2"><?php if (isset($data->content_article)) {
                                // afficher la description -> retirer les balises puis couper le texte
                                $description = $data->content_article;
                                filter_var ( $description, FILTER_SANITIZE_STRING);?>
                                <?php echo substr($description, 0, 50);
                                } ?> 
                            [...]</p>
                            <a href="single_article.php?id=<?php echo $data->article_id; ?>" class="btn submit-comment m-2 center">Lire la suite</a>
                        </div>  

                    </div>
                </div>   

            <?php }
            $q->closeCursor();
        ?>


    </div>
</div>

    <div class="d-flex justify-content-center more m-3" >
        <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-arrow-down-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
        <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v5.793l2.146-2.147a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 1 1 .708-.708L7.5 10.293V4.5A.5.5 0 0 1 8 4z"/>
        </svg>
    </div>

    <div id="loader">
        <img src="../img/ajax-loader.gif" alt="loader">
    </div> 

<?php
include_once("footer_frontoffice.php");
?>