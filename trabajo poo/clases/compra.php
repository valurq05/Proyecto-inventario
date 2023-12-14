<?php
require_once "conexion.php";

class Compra{

        private $com_id;
        private $com_cantidad;
        private $com_precioProveedor;
        private $pro_id;
        private $prov_id;
        const TABLA = "compra";

        public function setcomId($com_id){
            $this->com_id = $com_id;
        }

        public function getcomId(){
            return $this->com_id;
        }

        public function setcomCantidad($com_cantidad){
            $this->com_cantidad = $com_cantidad;
        }

        public function getcomCantidad(){
            return $this->com_cantidad;
        }

        public function setPrecioProveedor($com_precioProveedor){
            $this->com_precioProveedor = $com_precioProveedor;
        }

        public function getPrecioProveedor(){
            return $this->com_precioProveedor;
        }

        public function getId(){

            return $this-> pro_id;
        }
        
        public function setPro_Id($pro_id){
        
         $this-> pro_id = $pro_id;
        }

        public function getProvId(){
            return $this->prov_id;
        }

        public function setProvId($prov_id){
            $this->prov_id = $prov_id;
        }

        public function getTieId(){
            return $this->tie_id;
        }

        public function setTieId($tie_id){
            $this->tie_id = $tie_id;
        }

        public function __construct($com_id, $com_cantidad, $com_precioProveedor, $pro_id, $prov_id, $tie_id){
            $this->com_id = $com_id;
            $this->com_cantidad = $com_cantidad;
            $this->com_precioProveedor = $com_precioProveedor;
            $this->pro_id = $pro_id;
            $this->prov_id = $prov_id;
            $this->tie_id = $tie_id;

        }

        public function guardar(){
            $conexion = new Conexion();
            {
                $consulta = $conexion->prepare("INSERT INTO " . self::TABLA ."(com_id, com_cantidad, com_pre_provee, pro_id, prov_id, tie_id) VALUES(:codCompra, :cantCompra, :compraPrecioProv, :CodigoProducto, :CodigoProveedor, :tiendaId)");
                $consulta->bindParam(":codCompra", $this->com_id);
                $consulta->bindParam(":cantCompra", $this->com_cantidad);
                $consulta->bindParam(":compraPrecioProv", $this->com_precioProveedor);
                $consulta->bindParam(":CodigoProducto", $this->pro_id);
                $consulta->bindParam(":CodigoProveedor", $this->prov_id);
                $consulta->bindParam(":tiendaId", $this->tie_id);
                $consulta->execute();
                $this->id = $conexion->lastInsertId();
                $this->agregarStock($this->pro_id, $this->com_cantidad);
            }
            
            $conexion = null;
        }

        public function agregarStock($pro_id, $com_cantidad){

            $conexion = new Conexion();
        
            $consulta = $conexion->prepare("SELECT pro_tienda_cant FROM producto_en_tienda WHERE pro_id = :pro_id");
            $consulta->bindValue(':pro_id', $pro_id, PDO::PARAM_INT);
            $consulta->execute();
        
            $result = $consulta->fetch(PDO::FETCH_ASSOC);
            $cantUno = $result['pro_tienda_cant'];
        
            $cantActual = abs($cantUno + $com_cantidad);
        
            $consulta = $conexion->prepare("UPDATE producto_en_tienda SET pro_tienda_cant = :cantActual WHERE pro_id = :pro_id");
            $consulta->bindValue(':cantActual', $cantActual, PDO::PARAM_INT);
            $consulta->bindValue(':pro_id', $pro_id, PDO::PARAM_INT);
            $consulta->execute();
        
            $conexion = null;

        }

        public static function mostrar() {
            $conexion = new Conexion();
            $consulta = $conexion->prepare('SELECT com_id, com_cantidad, com_pre_provee, pro_id, prov_id FROM ' . self::TABLA . ' ORDER BY com_id');
            $consulta->execute();
            $registros = $consulta->fetchAll();
            return $registros;
        }

        public static function obtenerDatosParaGrafica()
        {
             $conexion = new Conexion();
             $consulta = $conexion->obtenerDatos("SELECT p.pro_nombre, SUM(t.com_cantidad) as total_cantidad
             FROM " . self::TABLA . " t
             INNER JOIN producto p ON t.pro_id = p.pro_id
             GROUP BY p.pro_nombre
             ORDER BY total_cantidad DESC
             ");
             return $consulta;
        }
        
        
        public function modificar() {
            $conexion = new Conexion();
        
            if ($this->com_id) {
                $consulta = $conexion->prepare("UPDATE " . self::TABLA . " SET com_cantidad = :cantCompra, com_pre_provee = :compraPrecioProv, pro_id = :CodigoProducto, prov_id = :CodigoProveedor, tie_id = :tiendaId WHERE com_id = :codCompra");
                $consulta->bindParam(":cantCompra", $this->com_cantidad);
                $consulta->bindParam(":compraPrecioProv", $this->com_precioProveedor);
                $consulta->bindParam(":CodigoProducto", $this->pro_id);
                $consulta->bindParam(":CodigoProveedor", $this->prov_id);
                $consulta->bindParam(":tiendaId", $this->tie_id);
                $consulta->bindParam(":codCompra", $this->com_id);
                $consulta->execute();
            } else {
                $consulta = $conexion->prepare("INSERT INTO " . self::TABLA ."(com_cantidad, com_pre_provee, pro_id, prov_id, tie_id) VALUES(:cantCompra, :compraPrecioProv, :CodigoProducto, :CodigoProveedor, :tiendaId)");
                $consulta->bindParam(":cantCompra", $this->com_cantidad);
                $consulta->bindParam(":compraPrecioProv", $this->com_precioProveedor);
                $consulta->bindParam(":CodigoProducto", $this->pro_id);
                $consulta->bindParam(":CodigoProveedor", $this->prov_id);
                $consulta->bindParam(":tiendaId", $this->tie_id);
                $consulta->execute();
                $this->id = $conexion->lastInsertId();
            }
        
            $conexion = null;
        }
        

}
?>