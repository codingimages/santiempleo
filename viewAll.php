<?php
require_once 'partials/config.php';
require_once 'partials/db.php';
require_once 'partials/func.php';

if(!isset($_SESSION['user_data'])){
    return header('Location:login.php');
}
?>
    <?php require_once 'partials/header.php' ?>

    <header class="my-3 text-center">
        <div class="container">
            <div class="jumbotron jumbotron-fluid bg-transparent">
                <div class="container">
                    <h1 class="display-5">Solicitud de contacto</h1>
                </div>
                    <p class="lead">Programa una cita o una llamada. <span class="text-danger">Espera nuestra confirmación.</span></p>
            </div>
        </div>
    </header>

    <main class="mb-5">
        <div class="container">
            <div>
                <?php
                    if(isset($_SESSION['msg'])){
                        echo $_SESSION['msg'];
                        unset($_SESSION['msg']);
                    }
                ?>
            </div>
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="mb-3 text-right">
                        <a href="booking.php" class="btn btn-success">Inicio</a>
                        <a href="profile.php" class="btn btn-primary">Perfil</a>
                        <a href="logout.php" class="btn btn-danger">Salir</a>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h5 class="cart-title">Detalles</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-hove table-bordered text-center table-responsive-md">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Correo Electrónico</th>
                                        <th scope="col">Fecha</th>
                                        <th scope="col">Descripción</th>
                                        <th scope="col">Propósito</th>
                                    </tr>
                                        <th scope="col">Acción</th>
                                </thead>
                                <tbody>
                                    <?php
                                        $appointments = getAppointments();
                                        $i = 1;
                                        foreach($appointments as $a) {
                                            echo "<tr>
                                                    <th scope='row'>{$i}</th>
                                                    <td>{$a['name']}</td>
                                                    <td>{$a['email']}</td>
                                                    <td>" . date('M d, Y', $a['date']) . " at {$a['time']}</td>
                                                    <td>";

                                                foreach($a['purpose'] as $p) {
                                                    echo "$p, ";
                                                }

                                              echo "</td>
                                                    <td>{$a['description']}</td>
                                                    <td>
                                                        <a href='#' class='btn btn-sm btn-danger' title='delete-appointment' data-toggle='modal' data-target='#exampleModal{$a['id']}'><i class='fas fa-trash-alt'></i></a>
                                                    </td>
                                                </tr>";
                                            $i++;
                                            
                                            ?>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal<?php echo $a['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Eliminar</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                          <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Seguro que quieres eliminar la cita, esto no se puede recuperar.
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                                                        <a href="partials/process.php?d=<?php echo $a['id'] ?>" class="btn btn-success">Si</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php require_once 'partials/footer.php' ?>
