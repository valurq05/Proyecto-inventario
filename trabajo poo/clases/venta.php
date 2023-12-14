<?php
require_once "conexion.php";

class Venta{
        private $ven_id;
        private $ven_cant;
        private $ven_fecha;
        private $pro_id;
        private $cli_id;
        private $tie_id;
        const TABLA = "venta";

        public function getId(){

            return $this-> pro_id;
        }
        
        public function setPro_Id($pro_id){
        
         $this-> pro_id = $pro_id;
        }

        public function getVenId(){

            return $this->ven_id;
        }

        public function setVenId($ven_id){
            $this->ven_id = $ven_id;
        }

        public function getVenCant(){
            return $this->ven_cant;
        }

        public function setVenCant($ven_cant){
           $this->ven_cant = $ven_cant;
        }

        public function getVenFecha(){
            return $this->ven_fecha;
        }
        public function setVenFecha($ven_fecha){
            $this->ven_fecha = $ven_fecha;
        }

        public function setCliId($cli_id){
            $this->cli_id = $cli_id;
        }
        
        public function getCliId(){
            return $this->cli_id;
        }

        public function getTieId(){
            return $this->tie_id;
        }

        public function setTieId($tie_id){
            $this->tie_id = $tie_id;
        }

        public function __construct($cli_id,$pro_id, $ven_cant, $ven_fecha,$tie_id,$ven_id = null){
            $this-> tie_id = $tie_id;
            $this->cli_id = $cli_id;
            $this->ven_id = $ven_id;
            $this->ven_fecha = $ven_fecha;
            $this->ven_cant = $ven_cant;
            $this->pro_id = $pro_id;

        }

        public function guardar(){
            $conexion = new Conexion();
            {
                $consulta = $conexion->prepare("INSERT INTO " . self::TABLA ."(ven_cant, ven_fecha, cli_id, pro_id, tie_id) VALUES(:cantVenta, :fechaVenta, :clienteId, :CodigoProducto, :tiendaID)");
                $consulta->bindParam(":cantVenta", $this->ven_cant);
                $consulta->bindParam(":fechaVenta", $this->ven_fecha);
                $consulta->bindParam(":clienteId", $this->cli_id);
                $consulta->bindParam(":CodigoProducto", $this->pro_id);
                $consulta->bindParam(":tiendaID", $this->tie_id);
                $consulta->execute();
                $this->id = $conexion->lastInsertId();
                $this->actualizarStock($this->pro_id, $this->ven_cant);
                
            }
            
            $conexion = null;
        }

        public function actualizarStock($pro_id, $ven_cant) {
            $conexion = new Conexion();
        
            $consulta = $conexion->prepare("SELECT pro_tienda_cant FROM producto_en_tienda WHERE pro_id = :pro_id");
            $consulta->bindValue(':pro_id', $pro_id, PDO::PARAM_INT);
            $consulta->execute();
        
            $result = $consulta->fetch(PDO::FETCH_ASSOC);
            $cantUno = $result['pro_tienda_cant'];
        
            $cantActual = abs($cantUno - $ven_cant);
        
            $consulta = $conexion->prepare("UPDATE producto_en_tienda SET pro_tienda_cant = :cantActual WHERE pro_id = :pro_id");
            $consulta->bindValue(':cantActual', $cantActual, PDO::PARAM_INT);
            $consulta->bindValue(':pro_id', $pro_id, PDO::PARAM_INT);
            $consulta->execute();
        
            $conexion = null;
        }
        
        public static function obtenerDatosParaGrafica()
        {
            $conexion = new Conexion();
            $consulta = $conexion->obtenerDatos("
            SELECT p.pro_nombre, v.ven_fecha, SUM(p.pro_precioVenta) AS totalDiario
            FROM " . self::TABLA . " v
            INNER JOIN producto p ON v.pro_id = p.pro_id
            WHERE v.ven_fecha >= CURDATE() - INTERVAL 5 DAY
            GROUP BY DATE(v.ven_fecha)
            ORDER BY v.ven_fecha DESC
            ");
            return $consulta;
        }


        public static function mostrar() {
            $conexion = new Conexion();
            $consulta = $conexion->prepare('SELECT ven_id, ven_cant	, ven_fecha, cli_id	, pro_id, tie_id FROM ' . self::TABLA . ' ORDER BY ven_id');
            $consulta->execute();
            $registros = $consulta->fetchAll();
            return $registros;
        }
        
        public function modificar() {
            $conexion = new Conexion();
            
            if ($this->ven_id) {
                $consulta = $conexion->prepare("UPDATE " . self::TABLA . " SET ven_cant = :cantVenta, ven_fecha = :fechaVenta, cli_id = :clienteId, pro_id = :CodigoProducto, tie_id = :tiendaID WHERE ven_id = :ven_id");
                $consulta->bindParam(":cantVenta", $this->ven_cant);
                $consulta->bindParam(":fechaVenta", $this->ven_fecha);
                $consulta->bindParam(":clienteId", $this->cli_id);
                $consulta->bindParam(":CodigoProducto", $this->pro_id);
                $consulta->bindParam(":tiendaID", $this->tie_id);
                $consulta->bindParam(":ven_id", $this->ven_id);
                $consulta->execute();
            } else {
                $consulta = $conexion->prepare("INSERT INTO " . self::TABLA ."(ven_cant, ven_fecha, cli_id, pro_id, tie_id, ven_valor_total) VALUES(:cantVenta, :fechaVenta, :clienteId, :CodigoProducto, :tiendaID)");
                $consulta->bindParam(":cantVenta", $this->ven_cant);
                $consulta->bindParam(":fechaVenta", $this->ven_fecha);
                $consulta->bindParam(":clienteId", $this->cli_id);
                $consulta->bindParam(":CodigoProducto", $this->pro_id);
                $consulta->bindParam(":tiendaID", $this->tie_id);
                $consulta->execute();
                $this->id = $conexion->lastInsertId();
            }
            
            $conexion = null;
        }

    }
    ?>