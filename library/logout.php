<!-- Session destroy-->

<?php
session_start();
if(isset($_POST['logout_hidden']) AND $_POST['logout_hidden'] == 1){
    if(session_destroy()){
        header ('Location: ../backoffice/home_backoffice.php');
    }
}    
?>
