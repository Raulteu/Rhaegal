<?php
require_once __DIR__.'/includes/config.php';


$erroresFormulario = array();

$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
$email = isset($_POST['email']) ? $_POST['email'] : null;
$dia = isset($_POST['dia']) ? $_POST['dia'] : null;
$local = isset($_POST['local']) ? $_POST['local'] : null;

if ( empty($nombre) || empty($email) || empty($dia) || empty($local) ) {
	$erroresFormulario[] = "Debe rellenar todos los campos";
}

$fecha_actual = date('Y-m-d');
if($dia < $fecha_actual){
    $erroresFormulario[] = "El día seleccionado no es válido";

}

if (count($erroresFormulario) === 0) {
    //Comprobar dia, comprobar hora, comprobar reservas disponibles

    $_SESSION['nombre'] = $nombre;
    $_SESSION['email'] = $email;
    $_SESSION['dia'] = $dia;
    $_SESSION['local'] = $local;
    
    $hora_actual = new DateTime("now", new DateTimeZone('Europe/Madrid'));
    $hora_actual = $hora_actual->format('G:i');

    $app = Aplicacion::getSingleton();
    $bd = $app->conexionBD();
    $query = sprintf("SELECT * FROM local WHERE calle = '$local'");
    $resultado = $bd->query($query)
        or die ($bd->error . " en la linea " . (__LINE__-1));

    $local_bd = $resultado->fetch_object();
    $id_local = $local_bd->id;
    $_SESSION['id_local'] = $id_local;
    $reservasMaximas = $local_bd->reservas_maximas;
        
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
                if (count($erroresFormulario) === 0) {
                       /* 
                       mail($email, "Reserva en Rhaelgal","Usted ha realizado una reserva para el dia " . $dia .
                        " a las " . $hora . " en el local situado en " . $local . " a nombre de " 
                        . $nombre . ". Les esperamos con mucho gusto."); 
                        */
                    $app = Aplicacion::getSingleton();
                    $bd = $app->conexionBD();
                    $horas = array("12:00", "13:00", "14:00", "15:00", "16:00", "20:00", "21:00", "22:00", "23:00");
                    
                    echo "<h4> Seleccione una hora </h4>";
?>
                    <form action='finalizarReserva.php' method='POST'>
<?php
                    echo "<table class='tabla_horario'>";
                        foreach ($horas as $key => $hora) {
                            if (($dia > $fecha_actual) || ( $dia <= $fecha_actual && $hora > $hora_actual)){
                                $query = sprintf("SELECT * FROM horario WHERE id_local = '$id_local' and dia = '$dia' and hora = '$hora'");
                                $resultado = $bd->query($query);
                                $reservas = $resultado->fetch_object();
                                if ($resultado->num_rows === 0){
                                    $numReservas = 0;
                                } else {
                                    $numReservas = $reservas->num_reservas;
                                }
                                if (($reservasMaximas - $numReservas) > 0){
                                    echo "<tr>";
                                        echo "<td class='celda_horario'>";
                                            echo "<input type='radio' name='hora' value='$hora'>";
                                        echo "</td>";
                                        echo "<td>";
                                            echo "<div class='dish-value'>";
                                                echo $hora;
                                            echo "</div>";
                                        echo " </td>";
                                        echo "<td>";
                                            echo " <div class='dish-description'>";
                                                echo "Reservas disponibles: " . ($reservasMaximas - $numReservas);
                                            echo "</div>";
                                        echo "</td>";
                                    echo "</tr>";
                                } else {
                                    echo "$hora: Aforo completo";
                                }
                            }
                        }
                    echo "</table>";
?>
                        <div class="col-12 col-lg-6">
                        <button type="submit" class="btn caviar-btn"><span></span> Finalizar reserva</button>
                        </div>
                    </form>  
<?php                  
                } else {
?>
                <div class="section-heading">
                    <h2>Reserva</h2>
                </div>
<?php
                    if (count($erroresFormulario) > 0) {
                        echo '<ul class="errores">';
                    }
                    foreach($erroresFormulario as $error) {
                        echo "<li>$error</li>";
                    }
                    if (count($erroresFormulario) > 0) {
                        echo '</ul>';
                    }?>
                    
                    <form action="procesarReserva.php#reservation" method="POST">
                        <div class="row">
                            <div class="col-12">
                                <input type="text" name="nombre" class="form-control" placeholder="Nombre">
                            </div>
                            <div class="col-12">
                                <input type="email" name="email" class="form-control" placeholder="Email">
                            </div>
                            <div class="col-12">
                                <input type="date" name="dia" class="form-control" placeholder="Día">
                            </div>
                            <div class="col-12">
<?php
                                $app = Aplicacion::getSingleton();
                                $bd = $app->conexionBD();
                                $query = sprintf("SELECT * FROM local");
                                $resultado = $bd->query($query)
                                    or die ($bd->error . " en la linea " . (__LINE__-1));
                                echo "<select name='local'>";
                                while ($local = $resultado->fetch_object()){
                                    echo "<option value='" . $local->calle . "'/>" . 
                                    $local->ciudad . ", " . $local->calle . ", " . $local->numero . ".<br>";
                                    echo "</option>";
                                    echo "<br>";
                                }
                                echo "</select>";
?>
                            </div>
                            <div class="col-12 col-lg-6">
                                <button type="submit" class="btn caviar-btn"><span></span> Seleccionar Hora</button>
                            </div>
                        </div>
                    </form>
<?php
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