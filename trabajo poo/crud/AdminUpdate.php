<?php
 require_once "../clases/administrador.php";

 $id_admin = $_POST["num_documento"];
 $nombre_admin = $_POST["adm_nombre"];
 $cargo = $_POST["adm_cargo"];
 $usuario = $_POST["adm_usuario"];
 $contrasena = $_POST["adm_contrasena"];
 $tie_id = $_POST["tienda_codigo"];

 $administrador = new Administrador($id_admin, $nombre_admin, $cargo, $usuario, $contrasena, $tie_id);

 $administrador->modificar();
 header('Location: http://localhost/ProyectoPoo2/ProyectoPoo/trabajo%20poo/interfaz/inicio.php#admin');


?>