<?php
require_once "conexion.php";

class Proveedor{
        private $prov_id;
        private $prov_nombre;
        private $prov_telefono;
        private $prov_correo;
        const TABLA = "proveedor";

        public function getProvId(){
            return $this->prov_id;
        }

        public function setProvId($prov_id){
            $this->prov_id = $prov_id;
        }

        public function getProvNombre(){
            return $this->prov_nombre;
        }

        public function setProNombre($prov_nombre){
            $this->prov_nombre = $prov_nombre;
        }

        public function getProvTelefono(){
            return $this->prov_telefono;
        }

        public function setProvTelefono($prov_telefono){
            $this->prov_telefono = $prov_telefono;
        }

        public function getProvCorreo(){
            return $this->prov_correo;
        }

        public function setProvCorreo($prov_correo){
            $this->prov_correo = $prov_correo;
        }

        public function __construct($prov_nombre,$prov_telefono,$prov_correo,$prov_id = null){
            $this->prov_id = $prov_id;
            $this->prov_nombre = $prov_nombre;
            $this->prov_telefono = $prov_telefono;
            $this->prov_correo = $prov_correo;
        }

        public function guardar(){
            $conexion = new Conexion();
            {
                $consulta = $conexion->prepare("INSERT INTO " . self::TABLA ."(prov_nombre, prov_telefono, prov_correo	) VALUES(:provNombre, :provTelefono, :provCorreo)");
                $consulta->bindParam(":provNombre", $this->prov_nombre);
                $consulta->bindParam(":provTelefono", $this->prov_telefono);
                $consulta->bindParam(":provCorreo", $this->prov_correo);
                $consulta->execute();
                $this->id = $conexion->lastInsertId();
            }
            
            $conexion = null;
        }
        
        public static function mostrar() {
            $conexion = new Conexion();
            $consulta = $conexion->prepare('SELECT prov_id, prov_nombre, prov_telefono, prov_correo FROM ' . self::TABLA . ' ORDER BY prov_id');
            $consulta->execute();
            $registros = $consulta->fetchAll();
            return $registros;
        }
        
        
        public function modificar() {
            $conexion = new Conexion();
            
            if ($this->prov_id) {
                $consulta = $conexion->prepare("UPDATE " . self::TABLA . " SET prov_nombre = :provNombre, prov_telefono = :provTelefono, prov_correo = :provCorreo WHERE prov_id = :prov_id");
                $consulta->bindParam(":provNombre", $this->prov_nombre);
                $consulta->bindParam(":provTelefono", $this->prov_telefono);
                $consulta->bindParam(":provCorreo", $this->prov_correo);
                $consulta->bindParam(":prov_id", $this->prov_id);
                $consulta->execute();
            } else {
                $consulta = $conexion->prepare("INSERT INTO " . self::TABLA ."(prov_nombre, prov_telefono, prov_correo	) VALUES(:provNombre, :provTelefono, :provCorreo)");
                $consulta->bindParam(":provNombre", $this->prov_nombre);
                $consulta->bindParam(":provTelefono", $this->prov_telefono);
                $consulta->bindParam(":provCorreo", $this->prov_correo);
                $consulta->execute();
                $this->id = $conexion->lastInsertId();
            }
            
            $conexion = null;
        }
    }
    ?>