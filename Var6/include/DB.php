<?php
require_once('Producto.php');
require_once('Familia.php');
require_once('Pedido.php');
require_once('PedidoProducto.php');


class DB {  
    protected static function ejecutaConsulta($sql) {
        $opc = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
        $dsn = "mysql:host=127.0.0.1;dbname=dwes2";
        $usuario = 'david';
        $contrasena = 'usuario';
        $dwes = new PDO($dsn, $usuario, $contrasena, $opc);
        $resultado = null;
        if (isset($dwes)) $resultado = $dwes->query($sql);
        return $resultado;
    }

    public static function obtieneFamilias() {
        $sql = "SELECT cod, nombre FROM familia;";
        $resultado = self::ejecutaConsulta ($sql);
        $productos = array();

	if($resultado) {
            // Añadimos un elemento por cada producto obtenido
            $row = $resultado->fetch();
            while ($row != null) {
                $familias[] = new Familia($row);
                $row = $resultado->fetch();
            }
	}
        return $familias;
    }
    
    public static function obtieneProductos($familia) {
        $sql = "SELECT cod, nombre_corto, nombre, PVP, familia FROM producto";
        $sql .= " WHERE familia='". $familia. "'";
        $resultado = self::ejecutaConsulta ($sql);
        $productos = array();

	if($resultado) {
            // Añadimos un elemento por cada producto obtenido
            $row = $resultado->fetch();
            while ($row != null) {
                $productos[] = new Producto($row);
                $row = $resultado->fetch();
            }
	}
        
        return $productos;
    }

    
    public static function obtieneProducto($codigo) {
        $sql = "SELECT cod, nombre_corto, nombre, PVP, familia FROM producto";
        $sql .= " WHERE cod='" . $codigo . "'";
        $resultado = self::ejecutaConsulta ($sql);
        $producto = null;

	if(isset($resultado)) {
            $row = $resultado->fetch();
            $producto = new Producto($row);
	}
        return $producto;    
    }
    
    public static function obtieneTV($codigo) {
        $sql = "SELECT t.*, p.nombre, p.nombre_corto, p.PVP, p.familia ";
	$sql .= "FROM televisor t, producto p ";
        $sql .= "WHERE t.cod='".$codigo."' and p.cod='".$codigo."'";
        $resultado = self::ejecutaConsulta ($sql);
        $televisor = null;
        if(isset($resultado)){
                $row = $resultado->fetch();
                $televisor = new TV($row); 
        }
        return $televisor;
}
    
    public static function verificaCliente($nombre, $contrasena) {
        $sql = "SELECT usuario FROM usuarios ";
        $sql .= "WHERE usuario='$nombre' ";
        $sql .= "AND password='" . md5($contrasena) . "';";
        $resultado = self::ejecutaConsulta ($sql);
        $verificado = false;

        if(isset($resultado)) {
            $fila = $resultado->fetch();
            if($fila !== false) $verificado=true;
        }
        return $verificado;
    }
    
    public static function obtienePedidos($usuario){
        $sql = "SELECT codped, fecha, usuario, coste FROM pedidos";
        $sql .= " WHERE usuario='". $usuario. "'";
        $resultado = self::ejecutaConsulta ($sql);
        $pedidos = array();

	if($resultado) {
            // Añadimos un elemento por cada pedido obtenido
            $row = $resultado->fetch();
            while ($row != null) {
                $pedidos[] = new Pedido($row);
                $row = $resultado->fetch();
            }
	}
        return $pedidos;
    }
    
    public static function obtienePedidosProductos($codped){
        $sql = "SELECT * FROM pedidosproductos";
        $sql .= " WHERE codped='" . $codped . "'";
        $resultado = self::ejecutaConsulta ($sql);
        $pedidosproductos = array();

	if($resultado) {
            // Añadimos un elemento por cada producto del pedido
            $row = $resultado->fetch();
            while ($row != null) {
                $pedidosproductos[] = new PedidoProducto($row);
                $row = $resultado->fetch();
            }
	}
        return $pedidosproductos;
    }
        
    
    public static function insertaPedido($cesta, $usuario){
       
        $opc = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
        $dsn = "mysql:host=127.0.0.1;dbname=dwes2";
        $usuarioBD = 'david';
        $password = 'usuario';
        $dwes = new PDO($dsn, $usuarioBD, $password, $opc);
        
        $datetime = date("Y-m-d H:i:s", time());
        $coste=$cesta->get_coste();
        $error = false;

        try{
            $dwes->beginTransaction();
            $sql="insert into pedidos (fecha, usuario, coste) values ('$datetime', '$usuario', '$coste')";
            $resultado = $dwes->query($sql);

      
            if($resultado){
                $codped=$dwes->lastInsertId();
                $sql="insert into pedidosproductos (codped, codprod, unidades) values (:codped, :codprod, :unidades)";
                $stmt = $dwes->prepare($sql);

                foreach($cesta->get_productos() as $ArrayProductoUnidades){
                    $codprod=$ArrayProductoUnidades['producto']->get_codigo();
                    $unidades=$ArrayProductoUnidades['unidades'];

                    if (!$stmt->execute([':codped' => $codped, ':codprod' => "$codprod", ':unidades' => $unidades])){
                        $error = true;
                    }
                }

                if(!$error){
                    $dwes->commit();
                    return $codped;
                }else{
                    $dwes->rollback();
                    return false;
                }
            }
        } catch (Exception $e){
            echo $e->getMessage();
            $dwes->rollback();
            return false;
        }
    }
}
