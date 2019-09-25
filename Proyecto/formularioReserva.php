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