<!-- charge new article in infinite scroll -->

<?php 
//connect to database
include_once("../library/connection_database.php");

if(isset($_GET['last_date_in_article']) && !empty($_GET['last_date_in_article'])){
    $sql = 'SELECT *, article.id_article AS article_id FROM article 
    -- jointure des 2 tables : left fonctionne meme si pas de correspondance entre les deux tables
    LEFT JOIN image_article ON article.id_article = image_article.id_article
    WHERE date_in_article < :last_date_in_article AND id_category = :id_category ORDER BY date_in_article DESC LIMIT 3;';
    $q = $pdo->prepare($sql);
    $q->execute(['last_date_in_article' => $_GET['last_date_in_article'], 'id_category' => $_GET['id_category']]);?>
    
    <div class="d-flex justify-content-center row">

    <?php
    while($data = $q->fetch(PDO::FETCH_OBJ)){?>
    <?php //var_dump($data) ;?>
        <div class="card-deck d-flex justify-content-around col-lg-4 col-sm-5 col-12 mb-2">
            <div class="card post center" date="<?php echo $data->date_in_article;?>" category="<?php echo $data->id_category;?>">
                
            <div class="card-body d-flex justify-content-around mb-0 row">
                             <div class="">
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
    }?>

    </div>
