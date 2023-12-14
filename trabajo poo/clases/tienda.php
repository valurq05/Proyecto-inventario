<?php
require_once "conexion.php";

class Tienda{
        private $tie_id;
        private $tie_nombre;
        private $tie_direccion;
        const TABLA = "tienda";

        public function getTieId(){
            return $this->tie_id;
        }

        public function setTieId($tie_id){
            $this->tie_id = $tie_id;
        }

        public function getTieNombre(){
            return $this->tie_nombre;
        }

        public function setTieNombre($tie_nombre){
            $this->tie_nombre = $tie_nombre;
        }

        public function getTieDireccion(){
            return $this->tie_direccion;
        }

        public function setTieDireccion($tie_direccion){
            $this->tie_direccion = $tie_direccion;
        }

        public function __construct($tie_nombre,$tie_direccion,$tie_id=null){
            $this-> tie_id = $tie_id;
            $this->tie_nombre = $tie_nombre;
            $this->tie_direccion = $tie_direccion;
        }

        public function guardar(){
            $conexion = new Conexion();
            {
                $consulta = $conexion->prepare("INSERT INTO " . self::TABLA ."(tie_nombre, tie_direccion) VALUES(:tiendaNombre,:tiendaDireccion )");
                $consulta->bindParam(":tiendaNombre", $this->tie_nombre);
                $consulta->bindParam(":tiendaDireccion", $this->tie_direccion);
                $consulta->execute();
                $this->id = $conexion->lastInsertId();
            }
            
            $conexion = null;
        }
        
        public static function mostrar() {
            $conexion = new Conexion();
            $consulta = $conexion->prepare('SELECT tie_id, tie_nombre FROM ' . self::TABLA . ' ORDER BY tie_id');
            $consulta->execute();
            $registros = $consulta->fetchAll();
            return $registros;
        }
        
        
        public function modificar() {
            $conexion = new Conexion();
            
            if ($this->tie_id) {
                $consulta = $conexion->prepare("UPDATE " . self::TABLA . " SET tie_nombre = :tiendaNombre, tie_direccion = :tiendaDireccion WHERE tie_id = :tiendaId");
                $consulta->bindParam(":tiendaNombre", $this->tie_nombre);
                $consulta->bindParam(":tiendaDireccion", $this->tie_direccion);
                $consulta->bindParam(":tiendaId", $this->tie_id);
                $consulta->execute();
            } else {
                $consulta = $conexion->prepare("INSERT INTO " . self::TABLA ."(tie_nombre, tie_direccion) VALUES(:tiendaNombre,:tiendaDireccion )");
                $consulta->bindParam(":tiendaNombre", $this->tie_nombre);
                $consulta->bindParam(":tiendaDireccion", $this->tie_direccion);
                $consulta->execute();
                $this->id = $conexion->lastInsertId();
            }
            
            $conexion = null;
        }

    }
    ?>