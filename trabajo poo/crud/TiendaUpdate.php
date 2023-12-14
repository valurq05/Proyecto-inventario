<?php
 require_once "../clases/tienda.php";

 $tie_id = $_POST["tie_id"];
 $tie_nombre = $_POST["tie_nombre"];
 $tie_direccion = $_POST["tie_direccion"];

 $tienda = new Tienda($tie_nombre, $tie_direccion);
 $tienda -> setTieId($tie_id);

 $tienda->modificar();
 header('Location: http://localhost/trabajo%20poo/interfaz/inicio.php#tienda');











?>