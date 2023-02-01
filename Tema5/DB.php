<?php

require_once ('./Producto.php');
require_once ('./familia.php');
require_once ('./CestaCompra.php');

class DB {

    public static function obtieneFamilias() {

        $array_familia = [];
        try {
            $consulta_familias = self::ejecuta_consulta('SELECT * FROM familia');

            foreach ($consulta_familias as $familia) {
                $array_familia[] = new Familia($familia);
            }

            return $array_familia;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public static function obtieneProductos($cod_familia) {

        $sql = 'SELECT * FROM producto WHERE familia=:familia';

        $parametros = [":familia" => $cod_familia];

        $resultado = self::ejecutaConsultas($sql, $parametros);

        foreach ($resultado as $respuesta) {
            $producto[] = new Producto($respuesta);
        }
        return $producto;
    }

    public static function obtieneProducto($codigo) {

        $sql = 'SELECT cod,nombre_corto, descripcion, PVP, familia FROM producto WHERE cod=:codigo';

        $parametros = [":codigo" => $codigo];

        $resultado = self::ejecutaConsultas($sql, $parametros);

        if (isset($resultado)) {

            $producto = new Producto($resultado);
        }

        return $producto;
    }

    public static function verificaCliente($nombre, $contrasena) {
        $cadena_conexion = 'mysql:dbname=dwes2;host=127.0.0.1';
        $usuario = 'david';
        $clave = 'usuario';

        $bd = new PDO($cadena_conexion, $usuario, $clave);

        $sql = 'SELECT usuario, password FROM usuarios WHERE usuario=:nombre and password=:contra';

        $parametros4 = [":nombre" => $nombre, ":contra" => $contrasena];

        $preparar_login = $bd->prepare($sql);

        $preparar_login->execute($parametros4);

        $row = $preparar_login->fetch(PDO::FETCH_ASSOC);

        if ($row != 0) {
            session_start();
            $_SESSION['usuario'] = $nombre;
            header('Location: listado_familias.php');
        } else {
            print_r("Usuario o contraseña incorrectos");
        }
    }

    private static function ejecuta_consulta() {
        $cadena_conexion = 'mysql:dbname=dwes2;host=127.0.0.1';
        $usuario = 'david';
        $clave = 'usuario';

        $array_fun = func_get_args();
       
        if (func_num_args() == 1) {
            try {

                $bd = new PDO($cadena_conexion, $usuario, $clave);
                $query = $array_fun[0];
                $resultado_familia = $bd->query($query);

                return $resultado_familia;
            } catch (Exception $ex) {
                throw $ex;
            }
        } elseif (func_num_args() == 2) {
            try {

                $bd = new PDO($cadena_conexion, $usuario, $clave);
                
                $query = $array_fun[0];
                $preparar = $bd->prepare($query);
                
                $parametros = $array_fun[1];
                $preparar->execute($parametros);

                return $preparar;
            } catch (Exception $ex) {
                throw $ex;
            }
        } else {
            return null;
        }
    }

}

?>