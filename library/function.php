<?php 
/**---------------------------------------------------------------- CRUD global ----------------------------------------------------------------*/


/**
 * connexion login et pwd
 * retourne informations transmise sous forme d'objets
 * si ok : ouverture d'une session login et d'un session pass
 * si non ok : destroy session
 * @return sous forme d'objet
 */
function checkLogin($login, $pwd){
    session_start();
    global $pdo;

    $sql = $pdo->prepare("SELECT login_admin, password_admin, level_admin FROM admin WHERE login_admin = :login_admin AND password_admin = :password_admin AND level_admin = 5 OR level_admin = 4");
    $sql->bindParam(':login_admin', $login);
    $sql->bindParam(':password_admin', $pwd);
    $sql->execute();

    $ok = $sql->fetch();

    if($ok){
        $_SESSION["login_admin"] = $ok->login_admin;
        $_SESSION["password_admin"] = $ok->password_admin;
        $_SESSION["level_admin"] = $ok->level_admin;

        header ('Location: moderation_backoffice.php');

    }else{
        session_destroy();
    }

    return $ok;
}

 //change date format
function date_vf($date){
    $format_fr = date("d-m-Y", strtotime($date));
    echo substr($format_fr, 0, 10);
}




/**---------------------------------------------------------------- CRUD Commentaire - Backoffice ----------------------------------------------------------------*/

/**
 * Lire tous les commentaires (pour la backoffice)
 * @return sous forme d'objet
 */
function read_all_comments()
    {
        global $pdo;

        $query = $pdo->prepare("SELECT * FROM comment_article ORDER BY date_in_comment DESC");
        $query->execute();
        $comments = $query->fetchAll();

        return $comments;
    }


 /**
 * Suppression du commentaire par son id
 * @return void
 */
function delete_comment($id)
{
    global $pdo;
    $query = $pdo->prepare("DELETE FROM comment_article WHERE id_comment = :id_comment");
    $query->execute(['id_comment' => $id]);
}


/**
 * Rendre affichable les commentaires valider
 * @return void
 */
function update_comment($id){
    global $pdo;

    $maj = $pdo->prepare("UPDATE comment_article SET visible=:visible WHERE id_comment=$id");

    $maj->bindParam(':visible', $visible);
    $visible = 1;

    $maj->execute();
}


/**---------------------------------------------------------------- CRUD page-présebtation - Backoffice ----------------------------------------------------------------*/

/**
 * Selectionne une page à administrer
 * @return sous forme d'objet
 */
function select_page()
    {
        global $pdo;

        $query = $pdo->prepare("SELECT * FROM presentation");
        $query->execute();
        $id = $query->fetchAll();

        return $id;
    }


/**
 * Récupération les textes
 * @return sous forme d'objet
 */

function recover_text_presentation($id_presentation){
    global $pdo;

    $query = $pdo->prepare("SELECT content_presentation, id_presentation FROM presentation WHERE id_presentation = :id_presentation");
    $query->execute(['id_presentation' => $id_presentation]);

    $text = $query->fetch();

    return $text;

}

/**
 * Enregistrer le text_page
 * @return void
 */

function maj_text_page($id_presentation, $content_presentation){
    global $pdo;

    $maj = $pdo->prepare("UPDATE presentation SET content_presentation=:content_presentation WHERE id_presentation = $id_presentation");

    $maj->bindParam(':content_presentation', $content_presentation);
    
    $maj->execute();
}


/**
 * Recupère les images de la page
 * @return sous forme de tableau
 */

 function recover_image_presentation($id_presentation){
    global $pdo;

    $sql= "SELECT * FROM presentation 
    -- jointure des 2 tables
    INNER JOIN image_presentation ON presentation.id_presentation = image_presentation.id_presentation
    WHERE image_presentation.id_presentation = $id_presentation";
    
    $query = $pdo->prepare($sql);

    $query->execute();

    $page = $query->fetchAll();

    return $page;
 }


 /**
 * Supprimer card image et desc (et fichier image)
 * @return void
 */

function delete_card($id_image){
    global $pdo;

    $select = $pdo->prepare("SELECT name_image, id_image FROM image_presentation WHERE id_image = $id_image");
    $select->execute();
    $name_delete = $select->fetch();

    // Suppri dans la base de donnée
    $del = $pdo->prepare("DELETE FROM image_presentation WHERE id_image = $id_image");
    $del->execute();


    // pour detruire l'image elle meme dans le dossier upload
    unlink('../uploads/'.$name_delete->name_image);

}

/**---------------------------------------------------------------- CRUD article - Backoffice ----------------------------------------------------------------*/

/**
 * Selectionne un article à administrer
 * @return sous forme d'objet
 */
function select_article($id_category)
    {
        global $pdo;

        $query = $pdo->prepare("SELECT * FROM article WHERE id_category = $id_category");
        $query->execute();
        $id = $query->fetchAll();

        return $id;
    }


/**
 * Recupère  l'image de l'article
 * @return sous forme de tableau
 */

 function recover_image_article($id_article){
    global $pdo;

    $sql= "SELECT * FROM article 
    -- jointure des 2 tables
    INNER JOIN image_article ON article.id_article = image_article.id_article
    WHERE image_article.id_article = $id_article";
    
    $query = $pdo->prepare($sql);

    $query->execute();

    $article = $query->fetchAll();

    return $article;
 }


 /**
 * Récupération les textes administrables
 * @return sous forme d'objet
 */

function recover_text_article($id_article){

    global $pdo;

    $query = $pdo->prepare("SELECT content_article, title_article, id_article FROM article WHERE id_article = :id_article");
    $query->execute(['id_article' => $id_article]);

    $text = $query->fetch();

    return $text;

}


/**
 * Enregistrer les textes article
 * @return void
 */

function maj_texts_article($id_article, $title_article, $content_article){
    global $pdo;


   


    $maj = $pdo->prepare("UPDATE article SET title_article=:title_article, content_article=:content_article WHERE id_article = $id_article");

    $maj->bindParam(':title_article', $title_article);
    $maj->bindParam(':content_article', $content_article);

    $maj->execute();
}


 /**
 * Supprimer card image (et fichier image)
 * @return void
 */

function delete_image($id_image){
    global $pdo;

    $select = $pdo->prepare("SELECT name_image, id_image FROM image_article WHERE id_image = $id_image");
    $select->execute();
    $name_delete = $select->fetch();

    // Suppri dans la base de donnée
    $del = $pdo->prepare("DELETE FROM image_article WHERE id_image = $id_image");
    $del->execute();


    // pour detruire l'image elle meme dans le dossier upload
    unlink('../uploads/'.$name_delete->name_image);

}

/**
 * ajoute un nouvel article : nouveau titre intro et contenu (sécurisé)
 */
function insert_article($id_category, $title_article, $content_article){
    
    global $pdo;

    $nouvel_article = $pdo->prepare("INSERT INTO article (id_category, title_article, content_article) VALUES (:id_category, :title_article, :content_article)");
        
        $nouvel_article->bindParam(':id_category', $id_category);
        $nouvel_article->bindParam(':title_article', $title_article);
        $nouvel_article->bindParam(':content_article', $content_article);

    $nouvel_article->execute();

}

/**
 * suppression de l'article par son id 
 */
function delete_article($id_article){
    global $pdo;
    // supp article lui meme
    $delete = $pdo->prepare("DELETE FROM article WHERE id_article = $id_article");    
    $delete->execute();

    // on recupere le ,nom de son imafge pour pouvoir la supprimer
    $delete_img = $pdo->prepare("SELECT * FROM image_article WHERE id_article = $id_article");    
    $delete_img->execute();
    $delete_img->fetch();

    // on supprime la ligne dont on a plus besoin
    $delete = $pdo->prepare("DELETE FROM image_article WHERE id_article = $id_article");    
    $delete->execute();

    // pour detruire l'image elle meme dans le dossier upload (repertoire) (proteger si on a pas d'image)
    @unlink('../uploads/'.@$delete_img->name_image);

    header ('Location: administration_article_backoffice.php');


}


/**---------------------------------------------------------------- CRUD pot link - Backoffice ----------------------------------------------------------------*/


/**
 * ajoute un lien 
 */
function insert_link($url_link){

    global $pdo;

    $nouveau_lien=$pdo->prepare("INSERT INTO link_pot (url_link) VALUES (:url_link)");
   
    $nouveau_lien->bindParam(':url_link', $url_link);
  
    $nouveau_lien->execute();

    header ('Location: administration_pot_link.php');
}


 /**
 * Récupération du lien pour l'afficher
 * @return sous forme d'objet
 */

function recover_link(){
    global $pdo;

    $query = $pdo->prepare("SELECT * FROM link_pot");
    
    $query->execute();
    $link = $query->fetch();

    return $link;
}

 /**
 * Suppression du lien (et tout le reste par sécurité)
 * @return void
 */
function delete_link()
{
    global $pdo;

    $query = $pdo->prepare("DELETE FROM link_pot");
    
    $query->execute();

    header ('Location: administration_pot_link.php');
}


/**---------------------------------------------------------------- CRUD newsletter - Backoffice ----------------------------------------------------------------*/

 /**
 * Récupération du lien pour l'afficher
 * @return sous forme d'objet
 */

function recover_newsletter(){
    global $pdo;

    $query = $pdo->prepare("SELECT * FROM inscription_newsletter");
    
    $query->execute();
    $contact = $query->fetchAll();

    return $contact;
}

/**
 * Suppression du contact par son id
 * @return void
 */
function delete_contact($id)
{
    global $pdo;
    $query = $pdo->prepare("DELETE FROM inscription_newsletter WHERE id_newsletter = :id_newsletter");
    $query->execute(['id_newsletter' => $id]);
}


function export_newsletter(){
    
};



/**---------------------------------------------------------------- CRUD Footer - Frontoffice ----------------------------------------------------------------*/

/**
 * ajoute un nouvel article : nouveau titre intro et contenu (sécurisé)
 */
function inscript_newsletter($email_newsletter){
    
    global $pdo;

    $inscr = $pdo->prepare("INSERT INTO inscription_newsletter (email_newsletter) VALUES (:email_newsletter)");
        
    $inscr->bindParam(':email_newsletter', $email_newsletter);

    $inscr->execute();

}

/**---------------------------------------------------------------- CRUD présentation - Frontoffice ----------------------------------------------------------------*/

 /**
 * Récupération le texte de la page de présentation
 * @return sous forme d'objet
 */

function recover_presentation($id_presentation){

    global $pdo;

    $query = $pdo->prepare("SELECT * FROM presentation WHERE id_presentation = :id_presentation");
    $query->execute(['id_presentation' => $id_presentation]);

    $text = $query->fetch();

    return $text;

}

/**---------------------------------------------------------------- CRUD single_artcle.php - Frontoffice ----------------------------------------------------------------*/

 /**
 * Récupération le texte & image de l'article
 * @return sous forme d'objet
 */

function recover_single_article($id_article){

    global $pdo;

    $sql = 'SELECT * FROM article 
            -- jointure des 2 tables : left fonctionne meme si pas de correspondance entre les deux tables
            LEFT JOIN image_article ON article.id_article = image_article.id_article
            WHERE article.id_article = :id_article';

            $query = $pdo->prepare($sql);
            $query->execute(['id_article' => $id_article]);
            $text = $query->fetchAll(PDO::FETCH_OBJ);
            return $text;
    
}


 /**
 * ajoute un nouveau commentaire 
 */
function insert_commentary($id_article, $firstname_comment, $email_comment, $content_comment){
    
    global $pdo;
    $accept_cgu_comment=1;
    $visible=0;

    $comment = $pdo->prepare("INSERT INTO comment_article (id_article, firstname_comment, email_comment, content_comment, accept_cgu_comment, visible) VALUES (:id_article, :firstname_comment, :email_comment, :content_comment, :accept_cgu_comment, :visible)");
        
        $comment->bindParam(':id_article', $id_article);
        $comment->bindParam(':firstname_comment', $firstname_comment);
        $comment->bindParam(':email_comment', $email_comment);
        $comment->bindParam(':content_comment', $content_comment);
        $comment->bindParam(':accept_cgu_comment', $accept_cgu_comment);
        $comment->bindParam(':visible', $visible);

    $comment->execute();

}

/**
 * Récupération les commentaires
 * @return sous forme d'objet
 */

function recover_comment($id_article, $btn_more=0){   

    global $pdo;

    if($btn_more == 0){
        $query = $pdo->prepare("SELECT * FROM comment_article WHERE id_article = :id_article AND visible=1 ORDER BY date_in_comment DESC LIMIT 2");

    }else{
        $query = $pdo->prepare("SELECT * FROM comment_article WHERE id_article = :id_article AND visible=1 ORDER BY date_in_comment DESC");
    }

    $query->execute(['id_article' => $id_article]);

    $text = $query->fetchAll();

    return $text;

}

/**---------------------------------------------------------------- CRUD pot.php - Frontoffice ----------------------------------------------------------------*/



