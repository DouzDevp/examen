<?php
//pour en local
define("PDO_HOST", "localhost");
define("PDO_DBBASE", "brasserie");
define("PDO_USER", "root");
define("PDO_PW", "");

//  pour en prod - en distant
// define("PDO_HOST", "arjunacortedou.mysql.db");
// define("PDO_DBBASE", "arjunacortedou");
// define("PDO_USER", "arjunacortedou");
// define("PDO_PW", "EdouardArinfo44");

try {
    $pdo = new PDO(
        "mysql:host=" . PDO_HOST . ";" .
            "dbname=" . PDO_DBBASE,
        PDO_USER,
        PDO_PW,
        // pour des retours de la base en objet
        array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}
?>
