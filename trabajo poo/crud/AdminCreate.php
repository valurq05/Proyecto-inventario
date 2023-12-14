<?php

require_once "../clases/administrador.php";

    $id_admin = $_POST["num_documento"];
    $nombre_admin = $_POST["adm_nombre"];
    $cargo = $_POST["adm_cargo"];
    $usuario = $_POST["adm_usuario"];
    $contrasena = $_POST["adm_contrasena"];
    $tie_id = $_POST["tienda_codigo"];

   
    if (Administrador::usuarioExistente($usuario)) {
        header("Location: ../interfaz/crearCuenta.php?error=El usuario ya existe");
        exit();
    }

    $administrador = new Administrador($id_admin, $nombre_admin, $cargo, $usuario, $contrasena, $tie_id);

     $administrador->guardar();

     
    header('Location:../interfaz/interfazlogin.php?success=Registro de cuenta exitoso.');
    

?>