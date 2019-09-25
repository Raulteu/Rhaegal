<form action="menuParaPedido.php" method="POST">
    <div class="row">
        <div class="col-12">
            <input type="text" name='nombre' class="form-control" placeholder="Nombre">
        </div>
        <div class="col-12">
            <input type="email" name='email' class="form-control" placeholder="Email">
        </div>
        <div class="col-12 col-lg-6">
                <input type="text" name='calle' class="form-control" placeholder="Calle">
        </div>
        <div class="col-12 col-lg-6">
                <input type="text" name='numero' class="form-control" placeholder="Número">
        </div>
        <div class="col-12 col-lg-6">
                <input type="text" name='ciudad' class="form-control" placeholder="Ciudad">
        </div>
        <div class="col-12 col-lg-6">
                <input type="text" name='cp' class="form-control" placeholder="Código postal">
        </div>
        <div class="col-12 col-lg-6">
            <input type="time" name='hora' class="form-control">
        </div>
        <div class="col-12 col-lg-6">
            <button type="submit" class="btn caviar-btn"><span></span> Seleccionar platos</button>
        </div>
    </div>
</form>