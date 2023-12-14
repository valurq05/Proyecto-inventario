<?php
 
require_once "../clases/producto.php";

$pro_id = $_POST["codProducto"];
$pro_nombre = $_POST["nombre_producto"];
$pro_venta = $_POST["valor_venta"];
$prov_id = $_POST["prov_id"];

$producto = new Producto($pro_id, $pro_nombre, $pro_venta, $prov_id);

$producto->guardar();
header('Location: http://localhost/trabajo%20poo/interfaz/inicio.php#productos');


?>