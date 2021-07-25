<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
    <a class="navbar-brand me-5" href="#">MVC</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link" href="/loginangel/index.php">Inicio</a>
        <a class="nav-link" href="/loginangel/vista/register.php">Registrarse</a>
        <a class="nav-link" href="/loginangel/vista/login.php">Iniciar Sesion</a>
      </div>
    </div>
    </div>
</nav>

<div class="container">
    <div class="row">
        <div class="col">

        <form  method="post" action="/loginangel/controlador/controlador.php" name="signin-form">
            <div class="mb-3 mt-5">
                <label class="form-label">Username</label>
                <input type="text" class="form-control" name="username" pattern="[a-zA-Z0-9]+" required />
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input class="form-control" type="password" name="password" required />
            </div>
            <div class="mb-3 mt-3">
                <div class="g-recaptcha" data-sitekey="6LcOxgMbAAAAAIvaJXoMg3oRKFbF-BpsLNMcHQIA"></div>
             </div>
             <button type="submit" class="btn btn-primary" name="login" value="login">Iniciar Sesion</button>
        </form>
        </div>
        <div class="col">
        
        </div>
    </div>
</div>