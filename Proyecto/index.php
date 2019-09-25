<?php
require_once __DIR__.'/includes/config.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>Restaurante Rhaegal</title>

    <!-- Favicon -->
    <link rel="icon" href="img/core-img/favicon.ico">

    <!-- Core Stylesheet -->
    <link href="style.css" rel="stylesheet">

    <!-- Responsive CSS -->
    <link href="css/responsive/responsive.css" rel="stylesheet">

</head>

<body>
    <!-- Preloader -->
    <div id="preloader">
        <div class="caviar-load"></div>
        <div class="preload-icons">
            <img class="preload-1" src="img/core-img/preload-1.png" alt="">
            <img class="preload-2" src="img/core-img/preload-2.png" alt="">
            <img class="preload-3" src="img/core-img/preload-3.png" alt="">
        </div>
    </div>

<?php
    //<!-- ***** Header Area Start ***** -->
    require("includes/comun/header.html");
    //<!-- ***** Header Area End ***** -->

    //<!-- ****** Welcome Area Start ****** -->
    require("includes/comun/welcomeArea.html");
    //<!-- ****** Welcome Area End ****** -->

    //<!-- ****** About Us Area Start ****** -->
    require("includes/comun/aboutUs.html");
    //<!-- ****** About Us Area End ****** -->

    //<!-- ***** Special Menu Area Start ***** -->
    require("includes/comun/specialMenu.php");
    //<!-- ***** Special Menu Area End ***** -->

    //<!-- ****** Awards Area Start ****** -->
    require("includes/comun/awards.html");
    //<!-- ****** Awards Area End ****** -->
?>

    <!-- ****** Reservation Area Start ****** -->
    <section class="caviar-reservation-area d-md-flex align-items-center" id="reservation">
        <div class="reservation-form-area d-flex justify-content-end">
            <div class="reservation-form">
                <div class="section-heading">
                    <h2>Reserva</h2>
                </div>
<?php
                require "formularioReserva.php";
?>
            </div>
        </div>
        <div class="reservation-side-thumb wow fadeInRightBig" data-wow-delay="0.5s">
            <img src="img/bg-img/hero-3.jpg" alt="">
        </div>
    </section>
    <!-- ****** Reservation Area End ****** -->

    <!-- ****** Order Area Start ****** -->
    <section class="caviar-reservation-area d-md-flex align-items-center" id="order">
        <div class="reservation-side-thumb wow fadeInLeftBig" data-wow-delay="0.5s">
                    <img src="img/bg-img/order.jpg" alt="">
        </div>   
        <div class="reservation-form-area d-flex justify-content-end">
                <div class="reservation-form">
                    <div class="section-heading">
                        <p></p>
                        <h2>Pedido</h2>
                    </div>
<?php
                    require "formularioPedido.php";
?>
                </div>
            </div>
        </section>
        <!-- ****** Order Area End ****** -->

    <!-- ****** Footer Area Start ****** -->
<?php require("includes/comun/footer.html"); ?>
    <!-- ****** Footer Area End ****** -->

    <!-- Jquery-2.2.4 js -->
    <script src="js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="js/bootstrap/popper.min.js"></script>
    <!-- Bootstrap-4 js -->
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <!-- All Plugins js -->
    <script src="js/others/plugins.js"></script>
    <!-- Active JS -->
    <script src="js/active.js"></script>
</body>