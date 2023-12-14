<?php
 require_once "../clases/proveedor.php";

 $prov_id = $_POST["prov_id"];
 $prov_nombre = $_POST["prov_nombre"];
 $prov_telefono = $_POST["prov_telefono"];
 $prov_correo = $_POST["prov_correo"];
 
 $proveedor = new Proveedor($prov_nombre, $prov_telefono, $prov_correo);
 $proveedor -> setProvId($prov_id);

 $proveedor->modificar();
 header('Location: http://localhost/ProyectoPoo2/ProyectoPoo/trabajo%20poo/interfaz/inicio.php#proveedor');













?>