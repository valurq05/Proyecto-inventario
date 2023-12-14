<?php

require_once "../clases/compra.php";

$com_id = $_POST["codCompra"];
$com_cantidad = $_POST["cant_producto"];
$com_precioProveedor = $_POST["precioProveedor"];
$pro_id = $_POST["productoSelect"];
$prov_id = $_POST["proveedorSelect"];
$tie_id = $_POST["cod_tienda"];

$compra = new Compra($com_id, $com_cantidad, $com_precioProveedor, $pro_id, $prov_id, $tie_id);

$compra->guardar();
header('Location: http://localhost/ProyectoPoo2/ProyectoPoo/trabajo%20poo/interfaz/inicio.php#compras');


?>