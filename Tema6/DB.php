<?php

require_once './Familia.php';
require_once './Producto.php';

class DB {

    private static function ejecuta_consulta() {
        $cadena_conexion = 'mysql:dbname=dwes2;host=127.0.0.1';
        $usuario_conexion = 'david';
        $clave_conexion = 'usuario';

//Array con argumentos que vengan
        $array_argumentos = func_get_args();

//Si tiene solo 1 parametro
        if (func_num_args() == 1) {
            try {

                $bd = new PDO($cadena_conexion, $usuario_conexion, $clave_conexion);

                $query = $array_argumentos[0];
                $resultado_familia = $bd->query($query);

                return $resultado_familia;
            } catch (PDOException $ex) {
                throw $ex;
            }
            //Si tiene 2 parametros
        } elseif (func_num_args() == 2) {
            try {

                $bd = new PDO($cadena_conexion, $usuario_conexion, $clave_conexion);

                $query = $array_argumentos[0];
                $preparar = $bd->prepare($query);

                $parametros = $array_argumentos[1];
                $preparar->execute($parametros);

                return $preparar;
            } catch (PDOException $ex) {
                throw $ex;
            }
        } else {
            //Si tiene 0 o más de 2
            return null;
        }
    }

    public static function obtieneFamilias() {


        $array_familia = [];
        try {
            $consulta_familia = self::ejecuta_consulta('SELECT * FROM familia');

            foreach ($consulta_familia as $familia) {
                $array_familia [] = new Familia($familia);
            }

            return $array_familia;
        } catch (PDOException $ex) {
            throw $ex;
        }
    }

    public static function obtieneProductos($cod_familia) {
        $array_productos = [];
        $array = [':familia' => $cod_familia];
        try {
            $consulta_productos = self::ejecuta_consulta('SELECT * FROM producto WHERE familia=:familia', $array);

            foreach ($consulta_productos as $producto) {
                $array_productos[] = new Producto($producto);
            }
            return $array_productos;
        } catch (PDOException $ex) {
            throw $ex;
        }
    }

    public static function obtieneProducto($cod_prod) {
        $array = [':cod' => $cod_prod];
        try {
            $consulta_producto = self::ejecuta_consulta('SELECT * FROM producto WHERE cod=:cod', $array);

            if ($consulta_producto->rowCount() == 1) {
                $producto = new Producto($consulta_producto->fetch());
            }
            return $producto;
        } catch (PDOException $ex) {
            throw $ex;
        }
    }

    public static function verificaCliente($nombre, $contra) {
        $array = [':nombre' => $nombre];
        try {
            $consulta = self::ejecuta_consulta('SELECT * FROM usuarios WHERE usuario=:nombre', $array);
            $row = $consulta->fetch(PDO::FETCH_ASSOC);

            if (is_array($row)) {
                return true;
            }else{
                return false;
            }
        } catch (PDOException $ex) {
            throw $ex;
        }
    }

}
