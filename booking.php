<?php
require_once 'partials/config.php';
require_once 'partials/db.php';
require_once 'partials/func.php';
?>

    <?php require_once 'partials/header.php' ?>

  <!-- Navbar start -->
  <nav class="navbar fixed-top navbar-expand-md  navbar-dark bg-primary lead mb-5">
  <img src="img/logo.png" width="30" height="30" class="d-inline-block align-middle" alt="logo">
  <a class="navbar-brand text-light nav-title" href="index.html">SantiEmpleo</a>

    <!-- Responsive button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
      aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="index.html">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="nosotros.html">Nosotros</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="servicios.html">Servicios</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="workers.html">Empleos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contact.php">Contacto </a>
        </li>
      </ul>
    </div>
  </nav>
  <!-- Navbar end -->

<header class="my-3 mt-5 text-center">
    <div class="container">
        <div class="jumbotron jumbotron-fluid bg-transparent text-dark">
            <div class="container">
                <h1 class="display-5">Solicita Información</h1>
                <p class="lead">Programa una llamada o visita para información en detalle.  Espera una llamada o correo electrónico de confirmación.</p>
            </div>
        </div>
    </div>
</header>

<main class="mb-5">
    <div class="container">

        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="mb-3 text-right">
                    <?php
                        if(isset($_SESSION['user_data'])) {
                            echo "<a href='viewAll.php' class='btn btn-success'>Ver todo</a> ";
                            echo "<a href='profile.php' class='btn btn-primary'>Perfil</a> ";
                            echo "<a href='logout.php' class='btn btn-danger'>Salir</a>";
                        } else {
                            echo "<a href='login.php' class='btn btn-success'>Entrar</a>";
                        }
                    ?>

                </div>
            </div>
        </div>
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="cart-title text-center">Solicita Información</h5>
                            <hr>
                            <label for="">Horario disponible</label>
                            <p>
                                <?php
                                    $times = getTimes();
                                    foreach($times as $t){
                                        if($t['start_time'] == ''){
                                            echo "<strong style='width:100px; display:inline-block; text-align:right'>{$t['day']}:</strong> Not available";
                                        } else {
                                            echo "<strong style='width:100px; display:inline-block; text-align:right'>{$t['day']}:</strong> {$t['start_time']} to {$t['end_time']}<br>";
                                        }
                                    }
                                ?>
                            </p>
                        </div>
                        <div class="card-body">
                            <div class="text-success">
                                <?php
                                if(isset($_SESSION['msg'])){
                                    echo $_SESSION['msg'];
                                    unset($_SESSION['msg']);
                                }
                                ?>
                            </div>
                            <div class="text-danger">
                                <?php
                                if(isset($_SESSION['msgErr'])){
                                    echo $_SESSION['msgErr'];
                                    unset($_SESSION['msgErr']);
                                }
                                ?>
                            </div>
                            <form action="partials/process.php" method="post">
                                <div class="form-group row">
                                    <label for="" class="col-sm-2 col-form-label">Nombre Completo</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="name" class="form-control" id="" placeholder="Nombre completo" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="" class="col-sm-2 col-form-label">Correo Electrónico</label>
                                    <div class="col-sm-10">
                                        <input type="email" name="email" class="form-control" id="" placeholder="Correo Electrónico" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="" class="col-sm-2 col-form-label">Fecha (Presione para seleccionar)</label>
                                    <div class="col-sm-10">
                                        <input type="date" name="date" id="date" onchange="loadTimes()" class="form-control" required placeholder="Elija una fecha">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="" class="col-sm-2 col-form-label">Hora</label>
                                    <div class="col-sm-10">
                                        <select name="time" id="time" class="form-control" required>
                                            <option selected>Elige una fecha primero</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="" class="col-sm-2 col-form-label">Propósito</label>
                                    <div class="col-sm-10 mt-2">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" name="purpose[]" type="checkbox" id="inlineCheckbox1" value="Llamada">
                                            <label class="form-check-label" for="inlineCheckbox1">Llamada</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" name="purpose[]" type="checkbox" id="inlineCheckbox2" value="Cita">
                                            <label class="form-check-label" for="inlineCheckbox2">Cita</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" name="purpose[]" type="checkbox" id="inlineCheckbox3" value="Otro">
                                            <label class="form-check-label" for="inlineCheckbox3">Otro</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="" class="col-sm-2 col-form-label">Danos más detalles (Opcional)</label>
                                    <div class="col-sm-10">
                                        <textarea name="description" class="form-control" placeholder="Escribe aquí..."></textarea>
                                    </div>
                                </div>

                                <button type="submit" name="add_appointment" class="btn btn-secondary offset-sm-2">Enviar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php require_once 'partials/footer.php' ?>
