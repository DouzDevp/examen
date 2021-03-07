
<?php 
include_once("../library/connection_database.php");
include_once("../library/function.php");
$page_name = "presentation";
include_once("header_frontoffice.php");
include_once("../upload_image.php");

// recover 
if(isset($_GET['id'])){
    $id = $_GET['id'];
    // var_dump($id);

    // recover text
    $recover1 = recover_presentation($id);  
    // var_dump($recover1);

    // recover image
    $recover2 = recover_image_presentation($id);
    // var_dump($recover2);

}

?>

<div class="container row">

<div class="col-lg-7 col-12 m-2">

    <!-- title -->
    <h1><?php echo $recover1->title_presentation ;?></h1>

    <!-- text -->
    <div class="text-justify">
        <?php echo $recover1->content_presentation ;?>
    </div>

</div>


<div class="col-lg-4 col-12 mx-xl-4 my-xl-5 my-lg-5 m-md-3">

    <!-- images & description -->
    <?php if(isset($recover2)){ ?>
        <div class="d-flex justify-content-center mb-3">
            <div id="carouselExampleIndicators" class="carousel slide carousel-dimension" data-ride="carousel">
                <ol class="carousel-indicators">
                    <?php foreach($recover2 as $row1){; ?>
                        <?php //var_dump($row); ?>
                        <li data-target="#carouselExampleCaptions" data-slide-to="<?php if(isset($row1->id_image)){echo $row1->id_image; } ?>" class="active"></li>
                    <?php }; ?>
                </ol>

                <div class="carousel-inner">
                <?php $i=1;
                foreach($recover2 as $row2){ 
                    $active_slide=$i?>
                    <!-- For active -->
                    <?php if($active_slide==1){;
                        $active='active'; 
                    }else{
                        $active='';
                    } ?>
                    <div class="carousel-item <?php echo $active; ?>">
                        <img src="../uploads/<?php if(isset($row2->name_image)){echo $row2->name_image;};?>" class="d-block w-100 carousel-dimension" alt="<?php if(isset($row2->name_image)){echo $row2->name_image;};?>">
                        <div class="carousel-caption d-none d-md-block">
                            <p><?php if(isset($row2->desc_image)){echo $row2->desc_image;} ?></p>
                        </div>
                    </div>
                <?php $i++; }; ?>
                </div>
                
                <?php if(isset($row2->name_image)){?>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                <?php }; ?>
            </div>

        </div>
    <?php }; ?>

</div>

</div>

<?php
include_once("footer_frontoffice.php");
?>