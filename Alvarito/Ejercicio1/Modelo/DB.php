<?php

include_once '../Modelo/constantes.php';
include_once '../Modelo/Familia.php';
include_once '../Modelo/Producto.php';
include_once '../../Hash/crear_contra_hash.php';

class DB {

    private static function ejecuta_consulta() {
        //Hacemos un array con los argumentos que trae la funcion

        $array_argumentos = func_get_args();
        //Esta función, con un parametro, ejecuta la consulta normal
        if (func_num_args() == 1) {
            try {

                $bd = new PDO(CADENA_CONEXION, USUARIO, CONTRA);
                //El parametro que le pasamos es la consulta
                $query = $array_argumentos[0];
                $resultado_familia = $bd->query($query);

                return $resultado_familia;
            } catch (Exception $ex) {
                throw $ex;
            }
            //Esta función, con dos parametros, ejecuta la consulta parametrizada
        } elseif (func_num_args() == 2) {
            try {

                $bd = new PDO(CADENA_CONEXION, USUARIO, CONTRA);
                //El primer parametro que le pasamos es la consulta
                $query = $array_argumentos[0];
                $preparar = $bd->prepare($query);
                //El segundo parametro que le pasamos es un array para la consulta preparada
                $parametros = $array_argumentos[1];
                $preparar->execute($parametros);

                return $preparar;
            } catch (Exception $ex) {
                throw $ex;
            }
        } else {
            //En caso de que tenga 0 o más de 2 parámetros:
            return null;
        }
    }

    //Aquí hacemos el método de obtieneFamilias->Para llamarlo: DB::obtieneFamilias()
    public static function obtieneFamilias() {
        //Tenemos que crear un array de familias
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

    //Aquí hacemos el metodo de obtieneProductos pasandole el código
    public static function obtieneProductos($cod_familia) {
        $array_productos = [];
        $array = [':familia' => $cod_familia];
        try {
            $consulta_productos = self::ejecuta_consulta('SELECT * FROM producto WHERE familia= :familia', $array);

            foreach ($consulta_productos as $producto) {
                $array_productos[] = new Producto($producto);
            }
            return $array_productos;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    //Aquí hacemos el método de obtieneProducto(codigo del producto)
    public static function obtieneProducto($cod_prod) {
        //Esta es la array que le introduzco a ejecuta_consulta
        $array = [':cod' => $cod_prod];
        try {
            $consulta_producto = self::ejecuta_consulta('SELECT * FROM producto WHERE cod =:cod', $array);
            if ($consulta_producto->rowCount() == 1) {
                $producto = new Producto($consulta_producto->fetch());
            }
            return $producto;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    //Función verifica cliente
    public static function verificaCliente($nombre, $contra) {
        $array = [':nombre' => $nombre];
        
        try {
            $consulta = self::ejecuta_consulta('SELECT * FROM usuarios WHERE usuario = :nombre', $array);
            $row = $consulta->fetch(PDO::FETCH_ASSOC);
            

            if (is_array($row)) {
                //Devuelve true si coincide o false sino
                return password_verify($contra, $row['password']);
            } else {
                return false;
            }
        } catch (Exception $ex) {
            throw $ex;
        }
    }

}

?>