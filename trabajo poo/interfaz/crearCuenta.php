<?php
require_once "../clases/tienda.php";
$tienda = Tienda::mostrar();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://use.fontawesome.com/releases/v5.7.2/css/all.css' rel='stylesheet'>
    <title>Registro</title>
</head>
<body>

<!-- Formulario registro -->
<div class="container">
    <div class="row">
        <div class="offset-md-2 col-lg-5 col-md-7 offset-lg-4 offset-md-3">
            <div class="panel border bg-white">
                <div class="panel-heading">
                    <h3 class="pt-3 font-weight-bold">Registro</h3>
                </div>
                <div class="panel-body p-3">
                    <form action="../crud/AdminCreate.php" method="POST">
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
                     
                    <?php
                     }
                    ?>
                        <div class="form-group py-2">
                            <div class="input-field">
                                <span class="far fa-user p-2"></span>
                                <input type="text" name="num_documento"  id="documento" placeholder="Documento" required>
                            </div>
                        </div>

                        <div class="form-group py-2">
                            <div class="input-field">
                                <span class="far fa-user p-2"></span>
                                <input type="text" name="adm_nombre" id="nombre" placeholder="Nombre" required>

                            </div>
                        </div>

                        <div class="form-group py-2">
                         <div class="input-field">
                             <span class="far fa-user p-2"></span>
                             <select name="adm_cargo"  id="cargo" class="form-control" required>
                                 <option value="" disabled selected>Selecciona el Cargo</option>
                                 <option value="administrador">Administrador</option>
                                 <option value="supervisor">Supervisor</option>
                             </select>
                         </div>
                         </div>


                        <div class="form-group py-2">
                            <div class="input-field">
                                <span class="far fa-user p-2"></span>
                                <input type="text" name="adm_usuario" id="usuario" placeholder="Usuario" required>
                            </div>
                        </div>
                        <div class="form-group py-1 pb-2">
                            <div class="input-field">
                                <span class="fas fa-lock px-2"></span>
                                <input type="password" name="adm_contrasena"  id="contraseña" placeholder="Ingrese su contraseña" required>
                                <button type="button" class="btn bg-white text-muted">
                                    <span class="far fa-eye-slash"></span>
                                </button>
                            </div>
                        </div>
                        
                        <div class="form-group py-2">
                            <div class="input-field">
                                <span class="far fa-user p-2"></span>
                                <select name="tienda_codigo" id="tienda" class="form-control">
                                <option value="" disabled selected>Selecciona la tienda</option>
                                    <?php
                                        foreach ($tienda as $item): 
                                            echo "<option value='{$item['tie_id']}'>{$item['tie_nombre']}</option>";
                                     endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div>
                            <button type="submit" class="btn btn-primary btn-block mt-3">Registrarse</button>
                        </div>
                        <div class="text-center pt-4 text-muted">¿Ya tiene una cuenta? <a href="./interfazlogin.php">Iniciar Sesión</a></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
