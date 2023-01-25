<?php

require_once ('./Producto.php');
require_once ('./familia.php');
require_once ('./CestaCompra.php');

class DB {

    public static function obtieneFamilias() {

        $sql = 'SELECT * FROM familia';

        $filas = self::ejecutaConsultas($sql, $parametros);
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

    private static function ejecutaConsultas($sql, $parametros) {

        $cadena_conexion = 'mysql:dbname=dwes2;host=127.0.0.1';
        $usuario = 'david';
        $clave = 'usuario';

        $resultado = null;

        try {

            $bd = new PDO($cadena_conexion, $usuario, $clave);

            $preparar_consulta = $bd->prepare($sql);

            $preparar_consulta->execute($parametros);

            return $preparar_consulta;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

}

?>