<?php
require_once __DIR__.'/includes/config.php';


$erroresFormulario = array();

$app = Aplicacion::getSingleton();
$bd = $app->conexionBD();

$query = sprintf("SELECT id FROM plato");
$resultado = $bd->query($query)
    or die ($bd->error . " en la linea " . (__LINE__-1));

$cantidadPlatos = array();
$todoAcero = true;

while ($plato = $resultado->fetch_object()){
    $cantidad = $_POST[$plato->id];
    if ($cantidad > 0){
        $cantidadPlatos[$plato->id] = $cantidad;
        if ($cantidadPlatos[$plato->id] != 0){
            $todoAcero = false;
        }
    }

}

if ($todoAcero) {
    $erroresFormulario[] = "Debe seleccionar al menos un plato";
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


    if ( ! isset($_SESSION['nombre'])) {//Si se recarga la página no debe hacerse todo otra vez
?>
        <!-- ****** Reservation Area Start ****** -->
        <section class="caviar-reservation-area d-md-flex align-items-center" id="reservation">
            <div class="reservation-form-area d-flex justify-content-end">
                <div class="reservation-form">
                    <h3> Pedido realizado correctamente </h3>
                    <p> Esperamos que le guste. </p>
                </div>
            </div>
            <div class="reservation-side-thumb wow fadeInRightBig" data-wow-delay="0.5s">
                <img src="img/bg-img/hero-3.jpg" alt="">
            </div>
        </section>
<?php
    } else {
        if (count($erroresFormulario) > 0) {
    ?>
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
                                if (count($erroresFormulario) > 0) {
                                    echo '<ul class="errores">';
                                }
                                foreach($erroresFormulario as $error) {
                                    echo "<li>$error</li>";
                                }
                                if (count($erroresFormulario) > 0) {
                                    echo '</ul>';
                                }
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
    <?php
        } else {
    ?>

            <!-- ****** Reservation Area Start ****** -->
            <section class="caviar-reservation-area d-md-flex align-items-center" id="reservation">
                <div class="reservation-form-area d-flex justify-content-end">
                    <div class="reservation-form">

    <?php
                    /* 
                    mail($email, "Reserva en Rhaelgal","Usted ha realizado una reserva para el dia " . $dia .
                    " a las " . $hora . " en el local situado en " . $local . " a nombre de " 
                    . $nombre . ". Les esperamos con mucho gusto."); 
                    */
                    $nombre = $_SESSION['nombre'];
                    $email = $_SESSION['email'];
                    $calle = $_SESSION['calle'];
                    $numero = $_SESSION['numero'];
                    $ciudad = $_SESSION['ciudad'];
                    $cp = $_SESSION['cp'];
                    $hora = $_SESSION['hora'];


                    $app = Aplicacion::getSingleton();
                    $bd = $app->conexionBD();
                    $precioFinal = 0;

                    $query = sprintf("INSERT INTO pedido (cliente, email, calle, numero, ciudad, codigo_postal, hora)
                        VALUES ('$nombre', '$email', '$calle', '$numero', '$ciudad', '$cp', '$hora')");
                    $resultado = $bd->query($query);
                    $idPedido = $bd->insert_id;
                    
                    foreach($cantidadPlatos as $plato_id=>$cantidad) {
                        $query = sprintf("SELECT precio FROM plato WHERE id = '$plato_id'");
                        $resultado = $bd->query($query);
                        $resultado = $resultado->fetch_object()
                            or die ($bd->error . " en la linea " . (__LINE__-1));
                        $precioFinal = ($precioFinal + ($resultado->precio * $cantidad));

                        $query = sprintf("INSERT INTO platosPedido(id_pedido, id_plato, cantidad)
                            VALUES ('$idPedido', '$plato_id', '$cantidad')");
                        $resultado = $bd->query($query);
                        /*if (! $resultado){
                            echo "<p>Plato " . $plato . $bd->errno . $bd->error . "<p>";
                        }*/
                        $idPlatosPedido = $bd->insert_id;
                    }
                    //number_format ( float $number [, int $decimals = 0 ] ) : string

                    $precioFinal = str_replace(',', '.', $precioFinal);
                    $query = sprintf("UPDATE pedido SET precio = '$precioFinal' WHERE id = '$idPedido'");
                    $resultado = $bd->query($query);
    ?>
                    <h3> Pedido realizado correctamente </h3>
                    <h5> Precio total: <?= $precioFinal ?> </h5>
                    <p> Esperamos que le guste. </p>
    <?php
                    unset($_SESSION['nombre']);
                    unset($_SESSION['email']);
                    unset($_SESSION['calle']);
                    unset($_SESSION['numero']);
                    unset($_SESSION['ciudad']);
                    unset($_SESSION['cp']);
                    unset($_SESSION['hora']);
    ?>
                    </div>
                </div>
                <div class="reservation-side-thumb wow fadeInRightBig" data-wow-delay="0.5s">
                    <img src="img/bg-img/hero-3.jpg" alt="">
                </div>
            </section>
            <!-- ****** Reservation Area End ****** -->
    <?php
        }
    }
?>

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