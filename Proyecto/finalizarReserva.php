<?php
require_once __DIR__.'/includes/config.php';


$erroresFormulario = array();

$hora = isset($_POST['hora']) ? $_POST['hora'] : null;


if (empty($hora)) {
	$erroresFormulario[] = "Debe rellenar todos los campos";
}
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

    <!-- ***** Header Area Start ***** -->
    <header class="header_area" id="header">
    <div class="container h-100">
        <div class="row h-100">
            <div class="col-12 h-100">
                <nav class="h-100 navbar navbar-expand-lg align-items-center">
                    <a class="navbar-brand" href="index.php">Rhaegal</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#caviarNav" aria-controls="caviarNav" aria-expanded="false" aria-label="Toggle navigation"><span class="fa fa-bars"></span></button>
                    <div class="collapse navbar-collapse" id="caviarNav">
                        <ul class="navbar-nav ml-auto" id="caviarMenu">
                            <li class="nav-item active">
                                <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                    <a class="nav-link" href="menu.php">Menú</a>
                                </li>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php#about">Conócenos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php#awards">Premios</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php#reservation">Reserva</a>
                            </li>
                            <li class="nav-item">
                                    <a class="nav-link" href="index.php#order">Para llevar</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    </header>    
    <!-- ***** Header Area End ***** -->

<?php
    //<!-- ****** Welcome Area Start ****** -->
    require("includes/comun/welcomeArea.html");
    //<!-- ****** Welcome Area End ****** -->

?>

    <!-- ****** Reservation Area Start ****** -->
    <section class="caviar-reservation-area d-md-flex align-items-center" id="reservation">
        <div class="reservation-form-area d-flex justify-content-end">
            <div class="reservation-form">

<?php
                if ( ! isset($_SESSION['id_local'])) {//Si se recarga la página no debe hacerse todo otra vez
?>
                    <h3> Reserva realizada correctamente </h3>
                    <p> Le estaremos esperando encantados. Disfrute de su visita. </p>
<?php
                } else {
                    if (count($erroresFormulario) === 0) {
                        /* 
                        mail($email, "Reserva en Rhaelgal","Usted ha realizado una reserva para el dia " . $dia .
                        " a las " . $hora . " en el local situado en " . $local . " a nombre de " 
                        . $nombre . ". Les esperamos con mucho gusto."); 
                        */
                        $id_local = $_SESSION['id_local'];
                        $nombre = $_SESSION['nombre'];
                        $email = $_SESSION['email'];
                        $dia = $_SESSION['dia'];
                        $local = $_SESSION['local'];
                        $hora = $_POST['hora'];
                    
                        $app = Aplicacion::getSingleton();
                        $bd = $app->conexionBD();
                        $query = sprintf("INSERT INTO reservas(cliente, email, id_local, dia, hora)
                            VALUES('$nombre', '$email', '$id_local', '$dia', '$hora')");
                        $resultado = mysqli_query($bd, $query);

                        $query = sprintf("SELECT * FROM reservas WHERE id_local = '$id_local' and dia = '$dia' 
                            and hora = '$hora'");
                        $resultado = $bd->query($query);

                        $numReservas = $resultado->num_rows;
                        if ($numReservas == 1){
                            $query = sprintf("INSERT INTO horario(id_local, dia, hora, num_reservas)
                                VALUES('$id_local', '$dia', '$hora', '$numReservas')");
                        } else {
                            $query = sprintf("UPDATE horario SET num_reservas = '$numReservas' 
                                WHERE id_local = '$id_local' and dia = '$dia' and hora = '$hora'");
                        }
                        $resultado = mysqli_query($bd, $query);

    ?>
                        <h3> Reserva realizada correctamente </h3>
                        <p> Le estaremos esperando encantados. Disfrute de su visita. </p>
    <?php
                        echo "<p>" . $dia . " a las " . $hora . " horas en " . $_SESSION['local'] . ".<p>"; 
                        unset($_SESSION['nombre']);
                        unset($_SESSION['email']);
                        unset($_SESSION['dia']);
                        unset($_SESSION['local']);
                        unset($_SESSION['id_local']);
                    }
                }   
?>
            </div>
        </div>
        <div class="reservation-side-thumb wow fadeInRightBig" data-wow-delay="0.5s">
            <img src="img/bg-img/hero-3.jpg" alt="">
        </div>
    </section>
    <!-- ****** Reservation Area End ****** -->


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
</html>