<?php
require_once "conexion.php";

class Producto{

private $pro_id;
private $pro_nombre;
private $pro_venta;
private
const TABLA = "producto";

public function getId(){

    return $this-> pro_id;
}


public function setPro_Id($pro_id){

 $this-> pro_id = $pro_id;
}

public function getPro_nombre(){

    return $this-> pro_nombre;
}


public function setPro_nombre($pro_nombre){

 $this-> pro_nombre = $pro_nombre;
}

public function getPro_venta(){
   return $this-> pro_venta; 
}

public function setPro_venta($pro_venta){
    $this->pro_venta = $pro_venta;
}

public function getProvId(){
    return $this->prov_id;
}

public function setProvId($prov_id){
    $this->prov_id = $prov_id;
}

public function __construct($pro_id, $pro_nombre,$pro_venta, $prov_id) {
    $this->pro_id = $pro_id;
    $this->pro_nombre = $pro_nombre;
    $this->pro_venta = $pro_venta;
    $this->prov_id = $prov_id;
}

public function guardar(){
    $conexion = new Conexion();
    {
        $consulta = $conexion->prepare("INSERT INTO " . self::TABLA ."(pro_id, pro_nombre, pro_precioVenta, prov_id) VALUES(:idProducto,:nombreProducto, :precioVenta, :idProveedor)");
        $consulta->bindParam(":idProducto", $this->pro_id);
        $consulta->bindParam(":nombreProducto", $this->pro_nombre);
        $consulta->bindParam(":precioVenta", $this->pro_venta);
        $consulta->bindParam(":idProveedor", $this->prov_id);
        $consulta->execute();
        $this->id = $conexion->lastInsertId();
    }
    
    $conexion = null;
}

public static function mostrar() {
    $conexion = new Conexion();
    $consulta = $conexion->prepare('SELECT pro_id, pro_nombre, pro_precioVenta, prov_id FROM ' . self::TABLA . ' ORDER BY pro_nombre');
    $consulta->execute();
    $registros = $consulta->fetchAll();
    return $registros;
}

public function eliminarProducto(){
    $conexion = new Conexion();
    $consulta = $conexion->prepare('DELETE FROM '. self::TABLA .' WHERE pro_id = :pro_id');
    $consulta->bindParam(":pro_id", $this->pro_id);
    $consulta->execute();
}

public function modificar() {
    $conexion = new Conexion();
    if ($this->pro_id) {
        $consulta = $conexion->prepare("UPDATE " . self::TABLA . " SET pro_nombre = :nombreProducto, pro_precioVenta = :precioVenta, prov_id = :idProveedor WHERE pro_id = :pro_id");
        $consulta->bindParam(":nombreProducto", $this->pro_nombre);
        $consulta->bindParam(":precioVenta", $this->pro_venta);
        $consulta->bindParam(":idProveedor", $this->prov_id);
        $consulta->bindParam(":pro_id", $this->pro_id);
        $consulta->execute();
    } else {
        $consulta = $conexion->prepare("INSERT INTO " . self::TABLA . " (pro_nombre, pro_precioVenta, prov_id) VALUES (:nombreProducto, :precioVenta, :idProveedor)");
        $consulta->bindParam(":nombreProducto", $this->pro_nombre);
        $consulta->bindParam(":precioVenta", $this->pro_venta); 
        $consulta->bindParam(":idProveedor", $this->prov_id);
        $consulta->execute();
        $this->id = $conexion->lastInsertId();
    }
    
    $conexion = null;
}


    
}
    

?>