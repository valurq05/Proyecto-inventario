<?php

session_start();
include("conexion2.php");

if (isset($_SESSION["adm_id"])) {
	header("Location: ../interfaz/inicio.php");
  } 

if (isset($_POST["adm_usuario"]) && isset($_POST["adm_contraseña"])) {

    function validar($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $usuario = validar($_POST["adm_usuario"]);
    $contrasena = validar($_POST["adm_contraseña"]);

    if (empty($usuario)) {
        header("Location:../interfaz/interfazlogin.php?error=El usuario es requerido");

        exit();
    } elseif (empty($contrasena)) {
        header("Location:../interfaz/interfazlogin.php?error=La clave es requerida");
        exit();
    } else {

        // $contrasena = md5($contrasena);

        $consulta = "SELECT * FROM administrador WHERE adm_usuario = '$usuario' AND adm_contraseña = '$contrasena'";
        $resultado = mysqli_query($conexion, $consulta);

        if (mysqli_num_rows($resultado) === 1) {
            $row = mysqli_fetch_assoc($resultado);

            if ($row["adm_usuario"] === $usuario && $row["adm_contraseña"] === $contrasena) {
                $_SESSION["adm_usuario"] = $row["adm_usuario"];
                $_SESSION["adm_nombre"] = $row["adm_nombre"];
                $_SESSION["adm_tienda"] = $row["tie_id"];
                $_SESSION["adm_id"] = $row["adm_id"];

                header("Location:../interfaz/inicio.php");
           
            } else {
                header("Location:../interfaz/interfazlogin.php?error=El usuario o clave son incorrectos");
              
            }
        } else {
            header("Location:../interfaz/interfazlogin.php?error=El usuario o clave son incorrectos");
        }
    }
} else {
    header("Location:../interfaz/interfazlogin.php?error=El usuario o clave son incorrectos");
  
}

?>
