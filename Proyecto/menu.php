<?php
require_once __DIR__.'/includes/config.php';
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
    <title>Caviar - Premium Restaurant Template | Menu</title>

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
                            <a class="filtro_menu" href=#entrantes>Todos</button>
                            <a class='filtro_menu' href="#entrantes">Entrantes</button>
                            <a class='filtro_menu' href="#principales">Platos Principales</button>
                            <a class='filtro_menu' href="#postres">Postres</button>
                            <a class='filtro_menu' href="#bebidas">Bebidas</button>
                        </div>
                    </div>
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
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Menu Area End ***** -->

<?php
    //<!-- ***** Special Menu Area Start ***** -->
    require("includes/comun/specialMenu.php");
    //<!-- ***** Special Menu Area End ***** -->

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