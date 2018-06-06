<?php
require_once 'partials/config.php';
require_once 'partials/db.php';
require_once 'partials/func.php';
?>

    <?php require_once 'partials/header.php' ?>

    <main class="my-5">
        <div class="container">
            <div class="row">
                <div class="col-md-5 mx-auto">
                    <div class="card my-5">
                        <div class="card-header">
                            <h5 class="cart-title">Login</h5>
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
                            <form action="partials/processLogin.php" method="post">
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <input type="email" name="email" class="form-control" id="" placeholder="Enter your email" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <input type="password" name="password" class="form-control" id="" placeholder="Enter your password" required>
                                    </div>
                                </div>

                                <button type="submit" name="login" class="btn btn-secondary">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php require_once 'partials/footer.php' ?>
