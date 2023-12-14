<?php
require_once "conexion.php";
class Cliente{

private $cli_id;
private $cli_documento;
const TABLA = "cliente";

public function setCliId($cli_id){
    $this->cli_id = $cli_id;
}

public function getCliId(){
    return $this->cli_id;
}

public function setCliDocumento($cli_documento){
    $this->cli_documento = $cli_documento;
}

public function getCliDocumento(){
    return $this->cli_documento;
}


public function __construct($cli_documento, $cli_id = null){
    $this->cli_id = $cli_id;
    $this->cli_documento = $cli_documento;
}


public function guardar(){
    $conexion = new Conexion();
    {
        $consulta = $conexion->prepare("INSERT INTO " . self::TABLA ."(cli_documento) VALUES(:cliDocumento)");
        $consulta->bindParam(":cliDocumento", $this->cli_documento);
        $consulta->execute();
        $this->id = $conexion->lastInsertId();
    }
    
    $conexion = null;
}

public static function mostrar() {
    $conexion = new Conexion();
    $consulta = $conexion->prepare('SELECT cli_id, cli_documento FROM ' . self::TABLA . ' ORDER BY cli_id');
    $consulta->execute();
    $registros = $consulta->fetchAll();
    return $registros;
}


public function modificar() {
    $conexion = new Conexion();
    
    if ($this->cli_id) {
        $consulta = $conexion->prepare("UPDATE " . self::TABLA . " SET cli_documento = :cliDocumento WHERE cli_id = :cliId");     
        $consulta->bindParam(":cliDocumento", $this->cli_documento);
        $consulta->bindParam(":cliId", $this->cli_id);
        $consulta->execute();
    } else {
        $consulta = $conexion->prepare("INSERT INTO " . self::TABLA ."(cli_documento) VALUES(:cliDocumento)");
        $consulta->bindParam(":cliDocumento", $this->cli_documento);
        $consulta->execute();
        $this->id = $conexion->lastInsertId();    
    }
    
    $conexion = null;
}

    




}
?>