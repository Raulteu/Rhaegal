<section class="caviar-dish-menu clearfix" id="menu">
        <div class="container">
            <div class="row">
                <div class="col-12 menu-heading">
                    <div class="section-heading text-center">
                        <h2>Novedades</h2>
                    </div>
                </div>
            </div>
            <div class="row">
<?php
            $app = Aplicacion::getSingleton();
            $bd = $app->conexionBD();
            $query = sprintf("SELECT * FROM plato P where P.tipo = 'Principal' ORDER BY id desc Limit 3");
                    $resultado = $bd->query($query)
                        or die ($bd->error . " en la linea " . (__LINE__-1));

                while ($plato = $resultado->fetch_object()){
                    echo "<div class='col-12 col-sm-6 col-md-4'>";
                        echo "<div class='caviar-single-dish wow fadeInUp' data-wow-delay='0.5s'>";
                            echo "<img src='" . $plato->foto . "' alt=''>";
                            echo "<div class='dish-info'>";
                                echo "<h6 class='dish-name'>" . $plato->nombre . "</h6>";
                                echo "<p class='dish-price'>" . $plato->precio . "</p>";
                            echo "</div>";
                        echo "</div>";
                    echo "</div>";
                }
?>
            </div>
        </div>
    </section>