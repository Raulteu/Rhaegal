<?php
require_once __DIR__.'/includes/config.php';

$erroresFormulario = array();

$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
$email = isset($_POST['email']) ? $_POST['email'] : null;
$calle = isset($_POST['calle']) ? $_POST['calle'] : null;
$numero = isset($_POST['numero']) ? $_POST['numero'] : null;
$ciudad = isset($_POST['ciudad']) ? $_POST['ciudad'] : null;
$cp = isset($_POST['cp']) ? $_POST['cp'] : null;
$hora = isset($_POST['hora']) ? $_POST['hora'] : null;


if ( empty($nombre) || empty($email) || empty($calle) || empty($numero) || empty($ciudad) || empty($cp) || empty($hora)) {
    $erroresFormulario[] = "Debe rellenar todos los campos";
}

$hora_actual = new DateTime("now", new DateTimeZone('Europe/Madrid'));
$hora_actual = $hora_actual->format('G:i');
$hora_actual = date('H:i', strtotime ( '+30 minutes' , strtotime ( $hora_actual )));
$hora_actual = strtotime($hora_actual);
$hora = strtotime($hora);

if ($hora_actual > $hora){
    $erroresFormulario[] = "<p>La hora seleccionada no es válida.</p>
                            <p>(El tiempo mínimo para la entrega es de media hora.)</p>";
}

if (count($erroresFormulario) === 0) {
    //Comprobar dia, comprobar hora, comprobar reservas disponibles

    $_SESSION['nombre'] = $nombre;
    $_SESSION['email'] = $email;
    $_SESSION['calle'] = $calle;
    $_SESSION['numero'] = $numero;
    $_SESSION['ciudad'] = $ciudad;
    $_SESSION['cp'] = $cp;
    $_SESSION['hora'] = $hora;
        
}
?>
<!DOCTYPE html>
<html lang="en">

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
    if (count($erroresFormulario) === 0){
?>
    <!-- ***** Breadcumb Area Start ***** -->
    <div class="breadcumb-area bg-img bg-overlay" style="background-image: url(img/bg-img/hero-2.jpg)">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcumb-content">
                        <h2>Menu</h2>
                        <a href="#menu" id="menubtn" class="btn caviar-btn"><span></span> Novedades</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Breadcumb Area End ***** -->

    <!-- ***** Menu Area Start ***** -->
    <div class="caviar-food-menu section-padding-150 clearfix">
        <div class="container">
            <div class="row">
                <div class="col-2">
                    <div class="food-menu-title">
                        <h2>Menu</h2>
                    </div>
                </div>

                <div class="col-10">
                    <div class="caviar-projects-menu">
                        <div class="text-center portfolio-menu">
                            <a class='filtro_menu' href="#entrantes">Todos</a>
                            <a class='filtro_menu' href="#entrantes">Entrantes</a>
                            <a class='filtro_menu' href="#principales">Platos Principales</a>
                            <a class='filtro_menu' href="#postres">Postres</a>
                            <a class='filtro_menu' href="#bebidas">Bebidas</a>
                        </div>
                    </div>

                    <form action="procesarPedido.php" method="POST">
<?php
                        $app = Aplicacion::getSingleton();
                        $bd = $app->conexionBD();

                        //ENTRANTES
                        $query = sprintf("SELECT * FROM plato P where P.tipo = 'Entrante'");
                        $resultado = $bd->query($query)
                            or die ($bd->error . " en la linea " . (__LINE__-1));

                        //<!-- Single Gallery Item -->
                        echo "<div id='entrantes'>";
                        echo "<h1> Entrantes </h1>";
                        echo "<table>";
                            while ($plato = $resultado->fetch_object()){
                                echo "<tr>";
                                    echo "<td class='input_pedir_menu'>";
                                        echo "<select name='$plato->id'>";
                                            echo "<option selected value='0'>0</option>";
                                            echo "<option value='1'>1</option>";
                                            echo "<option value='2'>2</option>";
                                            echo "<option value='3'>3</option>";
                                            echo "<option value='4'>4</option>";
                                            echo "<option value='5'>5</option>";
                                        echo "</select>";
                                        //echo "<input name='platos[]' type='checkbox' value='$plato->id'/>";
                                    echo "</td>";
                                    echo "<div class='single_menu_item" . $plato->tipo . " wow fadeInUp'>";
                                        echo "<div class='d-sm-flex align-items-center'>";
                                            echo "<td>";
                                                echo "<div class='dish-thumb'>";
                                                    echo "<img src='" . $plato->foto . "' width='300px' alt=''>"; //Cargar imagen
                                                echo "</div>";
                                            echo "</td>";
                                            echo "<td>";
                                                echo " <div class='dish-description'>";
                                                    echo "<h4>" . $plato->nombre . "</h4>";
                                                    echo "<p>" . $plato->descripcion . "</p>";
                                                echo "</div>";
                                            echo "</td>";
                                            echo "<td>";
                                                echo "<div class='dish-value'>";
                                                    echo "<h4>" . $plato->precio . "</h4>";
                                                echo "</div>";
                                            echo "</td>";
                                        echo "</div>";
                                    echo "</div>";
                                echo "</tr>";
                            }
                        echo "</table>";
                        echo "</div>";
                        echo "<hr size='15px'>";

                        //PLATOS PRINCIPALES
                        $query = sprintf("SELECT * FROM plato P where P.tipo = 'Principal'");
                        $resultado = $bd->query($query)
                            or die ($bd->error . " en la linea " . (__LINE__-1));

                        //<!-- Single Gallery Item -->
                        echo "<div id='principales'>";
                        echo "<h1> Platos Principales </h1>";
                        echo "<table>";
                            while ($plato = $resultado->fetch_object()){
                                echo "<tr>";
                                    echo "<td class='input_pedir_menu'>";
                                        echo "<select name='$plato->id'>";
                                            echo "<option selected value='0'>0</option>";
                                            echo "<option value='1'>1</option>";
                                            echo "<option value='2'>2</option>";
                                            echo "<option value='3'>3</option>";
                                            echo "<option value='4'>4</option>";
                                            echo "<option value='5'>5</option>";
                                        echo "</select>";
                                        //echo "<input name='platos[]' type='checkbox' value='$plato->id'/>";
                                    echo "</td>";
                                    echo "<div class='single_menu_item" . $plato->tipo . " wow fadeInUp'>";
                                        echo "<div class='d-sm-flex align-items-center'>";
                                            echo "<td>";
                                                echo "<div class='dish-thumb'>";
                                                    echo "<img src='" . $plato->foto . "' width='500px' alt=''>"; //Cargar imagen
                                                echo "</div>";
                                            echo "</td>";
                                            echo "<td>";
                                                echo " <div class='dish-description'>";
                                                    echo "<h4>" . $plato->nombre . "</h4>";
                                                    echo "<p>" . $plato->descripcion . "</p>";
                                                echo "</div>";
                                            echo "</td>";
                                            echo "<td>";
                                                echo "<div class='dish-value'>";
                                                    echo "<h4>" . $plato->precio . "</h4>";
                                                echo "</div>";
                                            echo "</td>";
                                        echo "</div>";
                                    echo "</div>";
                                echo "</tr>";
                            }
                        echo "</table>";
                        echo "</div>";
                        echo "<hr size='15px'>";

                        //POSTRES
                        $query = sprintf("SELECT * FROM plato P where P.tipo = 'Postre'");
                        $resultado = $bd->query($query)
                            or die ($bd->error . " en la linea " . (__LINE__-1));

                        //<!-- Single Gallery Item -->
                        echo "<div id='postres'>";
                        echo "<h1> Postres </h1>";
                        echo "<table>";
                            while ($plato = $resultado->fetch_object()){
                                echo "<tr>";
                                    echo "<td class='input_pedir_menu'>";
                                        echo "<select name='$plato->id'>";
                                            echo "<option selected value='0'>0</option>";
                                            echo "<option value='1'>1</option>";
                                            echo "<option value='2'>2</option>";
                                            echo "<option value='3'>3</option>";
                                            echo "<option value='4'>4</option>";
                                            echo "<option value='5'>5</option>";
                                        echo "</select>";
                                        //echo "<input name='platos[]' type='checkbox' value='$plato->id'/>";
                                    echo "</td>";
                                    echo "<div class='single_menu_item" . $plato->tipo . " wow fadeInUp'>";
                                        echo "<div class='d-sm-flex align-items-center'>";
                                            echo "<td>";
                                                echo "<div class='dish-thumb'>";
                                                    echo "<img src='" . $plato->foto . "' width='250px' alt=''>"; //Cargar imagen
                                                echo "</div>";
                                            echo "</td>";
                                            echo "<td>";
                                                echo " <div class='dish-description'>";
                                                    echo "<h4>" . $plato->nombre . "</h4>";
                                                    echo "<p>" . $plato->descripcion . "</p>";
                                                echo "</div>";
                                            echo "</td>";
                                            echo "<td>";
                                                echo "<div class='dish-value'>";
                                                    echo "<h4>" . $plato->precio . "</h4>";
                                                echo "</div>";
                                            echo "</td>";
                                        echo "</div>";
                                    echo "</div>";
                                echo "</tr>";
                            }
                        echo "</table>";
                        echo "</div>";
                        echo "<hr size='15px'>";

                        //BEBIDAS
                        $query = sprintf("SELECT * FROM plato P where P.tipo = 'Bebida'");
                        $resultado = $bd->query($query)
                            or die ($bd->error . " en la linea " . (__LINE__-1));

                        //<!-- Single Gallery Item -->
                        echo "<div id='bebidas'>";
                        echo "<h1> Bebidas </h1>";
                        echo "<table>";
                            while ($plato = $resultado->fetch_object()){
                                echo "<tr>";
                                    echo "<td class='input_pedir_menu'>";
                                        echo "<select name='$plato->id'>";
                                            echo "<option selected value='0'>0</option>";
                                            echo "<option value='1'>1</option>";
                                            echo "<option value='2'>2</option>";
                                            echo "<option value='3'>3</option>";
                                            echo "<option value='4'>4</option>";
                                            echo "<option value='5'>5</option>";
                                        echo "</select>";
                                        //echo "<input name='platos[]' type='checkbox' value='$plato->id'/>";
                                    echo "</td>";
                                    echo "<div class='single_menu_item" . $plato->tipo . " wow fadeInUp'>";
                                        echo "<div class='d-sm-flex align-items-center'>";
                                            echo "<td>";
                                                echo " <div class='dish-description'>";
                                                    echo "<h4>" . $plato->nombre . "</h4>";
                                                    echo "<p>" . $plato->descripcion . "</p>";
                                                echo "</div>";
                                            echo "</td>";
                                            echo "<td>";
                                                echo "<div class='dish-value'>";
                                                    echo "<h4>" . $plato->precio . "</h4>";
                                                echo "</div>";
                                            echo "</td>";
                                        echo "</div>";
                                    echo "</div>";
                                echo "</tr>";
                            }
                        echo "</table>";
                        echo "</div>";
?>
                    <div>
                        <button type="submit" class="btn caviar-btn"><span></span> Finalizar pedido</button>
                    </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- ***** Menu Area End ***** -->
<?php
    } else {
?>
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
                    if (count($erroresFormulario) > 0) {
                        echo '<ul class="errores">';
                    }
                    foreach($erroresFormulario as $error) {
                        echo "<li>$error</li>";
                    }
                    if (count($erroresFormulario) > 0) {
                        echo '</ul>';
                    }
                    require "formularioPedido.php";
?>
                </div>
            </div>
        </section>
        <!-- ****** Order Area End ****** -->
<?php
    }

    //<!-- ***** Footer Area Start ***** -->
    require("includes/comun/footer.html");
    //<!-- ***** Footer Area Start ***** -->
?>
    <!-- jQuery-2.2.4 js -->
    <script src="js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="js/bootstrap/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <!-- All Plugins js -->
    <script src="js/others/plugins.js"></script>
    <!-- Active js -->
    <script src="js/active.js"></script>
</body>