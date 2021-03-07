<?php
// var_dump($_POST);
// var_dump($_FILES);

include_once("../library/connection_database.php");
include_once("../library/function.php");
$page_name = "home";
include_once("header_frontoffice.php");
include_once("../upload_image.php");

?>


<div class="d-flex justify-content-center col-xl-12 mt-2 mb-1">
    <h3 class="center">
        Accueil
    </h3>
</div>

<!-- début carousel -->
<div class="row d-flex justify-content-center">
    <div class="col-8">

        <div id="carouselExampleControls" class="carousel slide w-100" data-ride="carousel">
            <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="../img/radovan-46Yad80Ynp4-unsplash.jpg" class="d-block w-100 rounded" alt="Credit: @radovan_be" >
            </div>
            <div class="carousel-item">
                <img src="../img/helena-lopes-m8R7_qWdXpU-unsplash.jpg" class="d-block w-100 rounded" alt="Credit: @wildlittlethingsphoto">
            </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
            </a>
        </div>

    </div>
</div>
    


<!-- fin carousel -->

<div class="row d-flex justify-content-center">
    <div class="col-12 col-md-6">
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nesciunt ullam, in perferendis molestias ipsa consequatur id illo officiis consectetur, corrupti expedita consequuntur fugit non facilis nisi neque doloribus quibusdam aliquam.</p> <br>
        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eius expedita assumenda ab sint? Cumque tempore ducimus eligendi obcaecati sapiente. Voluptates molestiae quis quos hic esse! Blanditiis, cumque. Cumque, nihil eaque? Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores soluta nam qui, iste sequi voluptates sed voluptatibus, voluptate adipisci aspernatur vero ullam accusamus odio dolore delectus libero distinctio totam odit?</p>
    </div>

    <div class="col-12 col-md-6">
        <img id="phototropgrande" src="images/im3.jpg" alt="vélo3">
    </div>
</div>

<div class="row d-flex justify-content-center">
    <div class="col-12 col-md-6">
        <img id="phototropgrande" src="images/im3.jpg" alt="vélo3">
    </div>
    
    <div class="col-12 col-md-6">
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nesciunt ullam, in perferendis molestias ipsa consequatur id illo officiis consectetur, corrupti expedita consequuntur fugit non facilis nisi neque doloribus quibusdam aliquam.</p> <br>
        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eius expedita assumenda ab sint? Cumque tempore ducimus eligendi obcaecati sapiente. Voluptates molestiae quis quos hic esse! Blanditiis, cumque. Cumque, nihil eaque? Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores soluta nam qui, iste sequi voluptates sed voluptatibus, voluptate adipisci aspernatur vero ullam accusamus odio dolore delectus libero distinctio totam odit?</p>
    </div>

</div>



    

<?php
include_once("footer_frontoffice.php");
?>
