<?php
 
require_once "../clases/producto_en_tienda.php";

$pro_id = $_POST["cod_producto"];
$cant_tienda = $_POST["cant_producto"];
$tie_id = $_POST["cod_tienda"];
$nombre_repartidor = $_POST["nombre_repartidot"];
$fecha_recibido = $_POST["fecha_recibido"];

$productoTienda = new ProductoEnTienda($cant_tienda, $nombre_repartidor, $fecha_recibido, $pro_id, $tie_id);

$productoTienda->guardar();
header('Location: Location: http://localhost/ProyectoPoo2/ProyectoPoo/trabajo%20poo/interfaz/inicio.php#tienda');


?>