<?php

    require_once "conexion.php";
    require_once "producto.php";

    class ProductoEnTienda{

        private $id_producto_en_tienda;
        private $cant_tienda;
        private $nombre_repartidor;
        private $fecha_recibido;
        private $pro_id;
        private $tie_id;

        const TABLA = "producto_en_tienda";

        
    public function getIdProductoTienda(){
    
        return $this -> $id_producto_en_tienda;
    }

    public function setPro_Id($id_producto_en_tienda){
    
     $this-> id_producto_en_tienda = $id_producto_en_tienda;
    }

    public function getcantTienda(){
        return $this -> $cant_tienda;
    }

    public function setcantTienda($cant_tienda){
        $this -> cant_tienda = $cant_tienda;
    }

    public function getNombreRepartidor(){
        return $this -> $nombre_repartidor;
    }

    public function setNombreRepartidor($nombre_repartidor){
        $this -> nombre_repartidor = $nombre_repartidor;
    }

    public function getFechaRecibido(){
        return $this -> $fecha_recibido;
    }

    public function setFechaRecibido($fecha_recibido){
        $this -> fecha_recibido = $fecha_recibido;
    }

    public function __construct($cant_tienda, $nombre_repartidor, $fecha_recibido, $pro_id, $tie_id, $id_producto_en_tienda = null){
        $this -> id_producto_en_tienda = $id_producto_en_tienda;
        $this -> cant_tienda = $cant_tienda;
        $this -> nombre_repartidor = $nombre_repartidor;
        $this -> fecha_recibido = $fecha_recibido;
        $this -> pro_id = $pro_id;
        $this -> tie_id = $tie_id;
    }

    public function guardar(){
        $conexion = new Conexion();
        {
            $consulta = $conexion->prepare("INSERT INTO " . self::TABLA ."(pro_tienda_cant, pro_id, tie_id, nombre_repartidor, fecha_recibido) VALUES(:cantidadProductoTienda, :idProducto, :idTienda, :nombreRepartidor, :fechaRecibido)");
            $consulta->bindParam(":cantidadProductoTienda", $this-> cant_tienda);
            $consulta->bindParam(":idProducto", $this-> pro_id);
            $consulta->bindParam(":idTienda", $this-> tie_id);
            $consulta->bindParam(":nombreRepartidor", $this-> nombre_repartidor);
            $consulta->bindParam(":fechaRecibido", $this-> fecha_recibido);
            $consulta->execute();
            $this->id = $conexion->lastInsertId();
        }
        
        $conexion = null;
    }
    
    public static function mostrar() {
        $conexion = new Conexion();
        $consulta = $conexion->prepare('SELECT pro_tienda_id, pro_tienda_cant, pro_id, tie_id,nombre_repartidor,fecha_recibido FROM ' . self::TABLA . ' ORDER BY pro_tienda_id');
        $consulta->execute();
        $registros = $consulta->fetchAll();
        return $registros;
    }

    
    public static function obtenerDatosParaGrafica()
    {
    $conexion = new Conexion();
    $consulta = $conexion->obtenerDatos(" SELECT t.pro_tienda_id, t.pro_tienda_cant, p.pro_nombre
    FROM " . self::TABLA . " t INNER JOIN producto p ON t.pro_id = p.pro_id
    ORDER BY t.pro_tienda_id");
    return $consulta;
    }

    
    public function modificar() {
        $conexion = new Conexion();
        
        if ($this->id_producto_en_tienda) {
            $consulta = $conexion->prepare("UPDATE " . self::TABLA . " SET pro_tienda_cant = :cantidadProductoTienda, pro_id = :idProducto, tie_id = :idTienda, nombre_repartidor = :nombreRepartidor, fecha_recibido = :fechaRecibido WHERE pro_tienda_id = :idProductoTienda");
            $consulta->bindParam(":cantidadProductoTienda", $this->cant_tienda);
            $consulta->bindParam(":idProducto", $this->pro_id);
            $consulta->bindParam(":idTienda", $this->tie_id);
            $consulta->bindParam(":nombreRepartidor", $this->nombre_repartidor);
            $consulta->bindParam(":fechaRecibido", $this->fecha_recibido);
            $consulta->bindParam(":idProductoTienda", $this->id_producto_en_tienda);
            $consulta->execute();
        } else {
            $consulta = $conexion->prepare("INSERT INTO " . self::TABLA . "(pro_tienda_cant, pro_id, tie_id, nombre_repartidor, fecha_recibido) VALUES(:cantidadProductoTienda, :idProducto, :idTienda, :nombreRepartidor, :fechaRecibido)");
            $consulta->bindParam(":cantidadProductoTienda", $this->cant_tienda);
            $consulta->bindParam(":idProducto", $this->pro_id);
            $consulta->bindParam(":idTienda", $this->tie_id);
            $consulta->bindParam(":nombreRepartidor", $this->nombre_repartidor);
            $consulta->bindParam(":fechaRecibido", $this->fecha_recibido);
            $consulta->execute();        }
        
        $conexion = null;
    }
    
    
    








    }







?>