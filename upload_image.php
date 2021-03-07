<!-- Upload multiple images -->

<?php 
if(isset($_FILES['photo'])){ 
    // Include the database configuration file 
    include_once '../library/connection_database.php'; 
     
    // File upload configuration 
    $targetDir = "../uploads/"; 
    $allowTypes = array('jpg','png','jpeg','gif'); 
     
    $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = ''; 
    $fileNames = array_filter($_FILES['photo']['name']); 
    if(!empty($fileNames)){ 
        foreach($_FILES['photo']['name'] as $key=>$val){ 
            // File upload path 
            $fileName = basename($_FILES['photo']['name'][$key]); 
            $desc = @$_POST["desc"][$key];

           //variable qui recup id_presentation
           $id_presentation = @$_POST["id_presentation"];

           //variable qui recup id_article
           $id_article = @$_POST["id_article"];

            $targetFilePath = $targetDir . $fileName; 
             
            // Check whether file type is valid 
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
            if(in_array($fileType, $allowTypes)){ 
                // Upload file to server 
                if(move_uploaded_file($_FILES["photo"]["tmp_name"][$key], $targetFilePath)){ 
                   // si on est dans admin_article:
                    if(isset($_POST['image_article'])){
                        $insertValuesSQL .= "('".$fileName."', '$id_article'),";

                    }else{
                        //on est dans admin_page
                    // Image db insert sql 
                    $insertValuesSQL .= "('".$fileName."', '".$desc."', '$id_presentation'),";
                    } 
                }else{ 
                    $errorUpload .= $_FILES['photo']['name'][$key].' | '; 
                } 
            }else{ 
                $errorUploadType .= $_FILES['photo']['name'][$key].' | '; 
            } 

        } 


        if(!empty($insertValuesSQL)){ 
            $insertValuesSQL = trim($insertValuesSQL, ','); 
            // Insert image file name into database 
            //si on est dans admin_article
            if(isset($_POST['image_article'])){
                $insert = $pdo->query("INSERT INTO image_article( name_image, id_article ) VALUES $insertValuesSQL"); 


            }else{
            //on est dans admin_page
            $insert = $pdo->query("INSERT INTO image_presentation ( name_image, desc_image, id_presentation ) VALUES $insertValuesSQL"); 
            }

            if($insert){ 
                $errorUpload = !empty($errorUpload)?'Upload Error: '.trim($errorUpload, ' | '):''; 
                $errorUploadType = !empty($errorUploadType)?'File Type Error: '.trim($errorUploadType, ' | '):''; 
                $errorMsg = !empty($errorUpload)?'<br/>'.$errorUpload.'<br/>'.$errorUploadType:'<br/>'.$errorUploadType; 
                $statusMsg = "Chargement réussi.".$errorMsg; 
            }else{ 
                $statusMsg = "Erreur dans le chargement de l'image."; 
            } 
        } 
         
    }else{ 
        $statusMsg = 'Please select a file to upload.'; 
    } 
     
    //Display status message 
    //echo $statusMsg; 
} 
?>