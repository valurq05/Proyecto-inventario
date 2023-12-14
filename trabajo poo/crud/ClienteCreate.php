<?php
 
require_once "../clases/cliente.php";

$cli_documento = $_POST["cli_documento"];

$cliente = new Cliente($cli_documento);

$cliente->guardar();
header('Location: http://localhost/ProyectoPoo2/ProyectoPoo/trabajo%20poo/interfaz/inicio.php#ventas');

?>