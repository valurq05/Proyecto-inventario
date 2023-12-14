<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://use.fontawesome.com/releases/v5.7.2/css/all.css' rel='stylesheet'>
    <title>Inicio de Sesión</title>
   
</head>
<body>

     <!-- Formulario inicio sesion -->

        <div class="container">
    <div class="row">
        <div class="offset-md-2 col-lg-5 col-md-7 offset-lg-4 offset-md-3">
            <div class="panel border bg-white">
                <div class="panel-heading">
                    <h3 class="pt-3 font-weight-bold">Inicio de Sesión</h3>
                </div>
                <div class="panel-body p-3">
                    <form action="../clases/login.php" method="POST">
                    <div>
                    <?php
                     if (isset($_GET["error"])) {
                        ?>
                    <p class = "error"> 
                        <?php
                        echo $_GET["error"];
                        ?>
                    </p>
                    </div>
                    <div>
                    <?php
                     }
                      if(isset($_GET["success"])){
                        ?>
                        <p class = "success">
                        <?php
                        echo  $_GET["success"];
                        ?>
                        </p>
                        <?php    
                         }
                        ?>
                    </div>
                        <div class="form-group py-2">
                            <div class="input-field"> <span class="far fa-user p-2"></span> <input type="text" name="adm_usuario" placeholder="Usuario" required> </div>
                        </div>
                        <div class="form-group py-1 pb-2">
                            <div class="input-field"> <span class="fas fa-lock px-2"></span> <input type="password" name="adm_contraseña" placeholder="Ingrese su contraseña" required> <button class="btn bg-white text-muted"> <span class="far fa-eye-slash"></span> </button> </div>
                        </div>
                        <div> <button type="submit" class="btn btn-primary btn-block mt-3">Iniciar Sesión</button></div>
                        <div class="text-center pt-4 text-muted">No tiene una cuenta? <a href="./crearCuenta.php">Registrarse</a> </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    
</body>
</html>