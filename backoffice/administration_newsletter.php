<?php 
include_once("../library/connection_database.php");
include_once("../library/function.php");
$page_name = "administration_newsletter";
include_once("header_backoffice.php");

if(isset($_POST['delete_contact'])){
    delete_contact($_POST['delete_contact']);
}

$contacts = recover_newsletter();
// var_dump($contacts);

?>

<!-- copy
<div class="d-flex justify-content-center align-items-center" >

    <input type="hidden" id="copy" cols="75" rows="2"><?php foreach($contacts as $row){if(isset($row->email_newsletter)){echo $row->email_newsletter. ', '; }; } ?></textarea>
    
    <img src="../img/copy.png" alt="Link" id="copy_contacts" class="m-1" title="Copier la liste des contacts" height="40" width="40">

</div> -->


<!-- tableau -->
<div class="d-flex justify-content-center">
    <table>
        <tr>
            <td>Liste des contactes :</td>
            <td class="d-flex justify-content-center">
                <input type="hidden" id="copy" cols="75" rows="2" value="<?php foreach($contacts as $row){if(isset($row->email_newsletter)){echo $row->email_newsletter. ', '; }; } ?>"></input>
    
                <img src="../img/copy.png" alt="Link" id="copy_contacts" class="center m-1" title="Copier la liste des contacts" height="40" width="40">
            </td>
        </tr>

        <?php foreach($contacts as $row){?>
            <tr >
                <td class="contact"><?php if(isset($row->email_newsletter)){echo $row->email_newsletter; }; ?></td>
                <td>
                    <form action="" method="post">
                        <button type="submit" class="btn btn-outline-danger " value="<?php if(isset($row->id_newsletter)){echo $row->id_newsletter; };?>" name="delete_contact" onclick="return window.confirm('Êtes vous sûr de vouloir supprimer ce contact ?')">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-left-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"/>
                            </svg> Supprimer
                        </button>
                    </form>
                </td>
            </tr>
        <?php } ?>

    </table>
</div>


<?php 
include_once("footer_backoffice.php");
?>