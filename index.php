<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
    <a class="navbar-brand me-5" href="#">MVC</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link" href="/loginangel/index.php">Inicio</a>
      </div>
    </div>
    </div>
</nav>
<div class="container">
    <div class="row">
        <div class="col">
            <?php

                session_start();
                include('modelo/coneccion.php');

                if(!isset($_SESSION['user_id'])){
                header('Location: vista/login.php');
                exit;
                } else {
                echo '<h1>Bienvenido</h1>';

                }

            ?>

            <form  method="post" action="/loginangel/controlador/controlador.php">
                <button type="submit" class="btn btn-primary" name="cerrarsesion" value="cerrarsesion">Cerrar Sesion</button>
            </form>
        </div>
        <div class="col">
        
        </div>
    </div>
</div>