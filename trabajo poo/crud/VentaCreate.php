<?php

require_once "../clases/venta.php";

$ven_cant = $_POST["cant_producto"];
$ven_fecha = $_POST["fecha_venta"];
$pro_id = $_POST["codProducto"];
$tie_id = $_POST["cod_tienda"];
$cli_id = $_POST["cli_documento"];

$venta = new Venta($cli_id, $pro_id, $ven_cant, $ven_fecha, $tie_id);

$venta->guardar();
header('Location: http://localhost/trabajo%20poo/interfaz/inicio.php#ventas');

?>