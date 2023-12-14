<?php
require_once 'conexion.php';

class Administrador{
        private $id_admin;
        private $nombre_admin;
        private $cargo;
        private $usuario;
        private $contrasena;
        private $tie_id;

        const TABLA = "administrador";

        public function getIdAdmin(){
            return $this->id_admin;
        }

        public function setIdAdmin($id_admin){
            $this->id_admin = $id_admin;
        }

        public function getNombreAdmin(){
            return $this->nombre_admin;
        }
        public function setNombreAdmin($nombre_admin){
            $this->nombre_admin = $nombre_admin;
        }

        public function getCargo(){
            return $this->cargo;
        }

        public function setCargo($cargo){
            $this->cargo = $cargo;
        }

        public function getUsuario(){
            return $this->usuario;
        }

        public function setUsuario($usuario){
            $this->usuario = $usuario;
        }

        public function getContrasena(){
            return $this->contrasena;
        }

        public function setContrasena($contrasena){
            $this->contrasena = $contrasena;
        }

        public function __construct($id_admin, $nombre_admin, $cargo, $usuario, $contrasena, $tie_id){
            $this->id_admin = $id_admin;
            $this->nombre_admin = $nombre_admin;
            $this->cargo = $cargo;  
            $this->usuario = $usuario;  
            $this->contrasena = $contrasena;
            $this->tie_id = $tie_id;
        }

        public static function usuarioExistente($usuario)
        {
            $conexion = new Conexion();
            $consulta = $conexion->prepare("SELECT COUNT(*) FROM " . self::TABLA . " WHERE adm_usuario = :usuario");
            $consulta->bindParam(":usuario", $usuario);
            $consulta->execute();
        
            $cantidad = $consulta->fetchColumn();
        
            $conexion = null;
        
            return $cantidad > 0;
        }
            
public function guardar(){
    $conexion = new Conexion();
    {
        $consulta = $conexion->prepare("INSERT INTO " . self::TABLA ."(adm_id, adm_nombre, adm_cargo, adm_usuario, adm_contraseña, tie_id) VALUES(:admId, :admNombre, :admCargo, :admUsuario, :admContrasena, :TiendaId)");
        $consulta->bindParam(":admId", $this->id_admin);
        $consulta->bindParam(":admNombre", $this->nombre_admin);
        $consulta->bindParam(":admCargo", $this->cargo);
        $consulta->bindParam(":admUsuario", $this->usuario);
        $consulta->bindParam(":admContrasena", $this->contrasena);
        $consulta->bindParam(":TiendaId", $this->tie_id);
        $consulta->execute();
        $this->id = $conexion->lastInsertId();
    }
    
    $conexion = null;
}

public static function mostrar() {
    $conexion = new Conexion();
    $consulta = $conexion->prepare('SELECT adm_id, adm_nombre, adm_cargo, adm_usuario, tie_id  FROM ' . self::TABLA . ' ORDER BY adm_nombre');
    $consulta->execute();
    $registros = $consulta->fetchAll();
    return $registros;
}


public function modificar() {
    $conexion = new Conexion();
    
    if ($this->id_admin) {
        $consulta = $conexion->prepare("UPDATE " . self::TABLA . " SET adm_nombre = :admNombre, adm_cargo = :admCargo, adm_usuario = :admUsuario, adm_contraseña = :admContrasena, tie_id = :TiendaId WHERE adm_id = :admId");
        $consulta->bindParam(":admNombre", $this->nombre_admin);
        $consulta->bindParam(":admCargo", $this->cargo);
        $consulta->bindParam(":admUsuario", $this->usuario);
        $consulta->bindParam(":admContrasena", $this->contrasena);
        $consulta->bindParam(":TiendaId", $this->tie_id);
        $consulta->bindParam(":admId", $this->id_admin);
        $consulta->execute();
    } else {
        $consulta = $conexion->prepare("INSERT INTO " . self::TABLA ."(adm_id, adm_nombre, adm_cargo, adm_usuario, adm_contraseña, tie_id) VALUES(:admId, :admNombre, :admCargo, :admUsuario, :admContrasena, :TiendaId)");
        $consulta->bindParam(":admId", $this->id_admin);
        $consulta->bindParam(":admNombre", $this->nombre_admin);
        $consulta->bindParam(":admCargo", $this->cargo);
        $consulta->bindParam(":admUsuario", $this->usuario);
        $consulta->bindParam(":admContrasena", $this->contrasena);
        $consulta->bindParam(":TiendaId", $this->tie_id);
        $consulta->execute();
        $this->id = $conexion->lastInsertId();
    }
    
    $conexion = null;
} 

        

    

    }



    ?>