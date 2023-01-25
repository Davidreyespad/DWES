<?php
//Comprobar si tengo sesion
require_once 'funciones.php';
comprobarSesion();

//Cerrar Sesión
if (isset($_POST["desconectar"])) {

    // Destruir todas las variables de sesión.
    $_SESSION = array();

    // Si se desea destruir la sesión completamente, borre también la cookie de sesión.
    // Nota: ¡Esto destruirá la sesión, y no la información de la sesión!
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
        );
    }

    // Finalmente, destruir la sesión.
    session_destroy();

    //Lo redirecciono a la página de Login para que inicie sesión
    header('Location: login.php?logout=true');
}

//Capturo el contenido del link que viene de familias_productos
if (isset($_REQUEST["familia"])) {
    $familia = $_REQUEST["familia"];
} else {
    //En caso de que hayamos llegado a la página sin seleccionar familia, redireccionamos a listado_familia
    header('Location: listado_familias.php?redirigido_sin_familia=true');
}

//Comprobamos si hay cesta creada, sino la creamos
$cesta = cargarCesta();

//Si se ha pulsado añadir
if (isset($_POST['anadir'])) {
    //Recogemos los datos hidden del formulario
    $cod = $_POST['cod'];
    $nombre_corto = $_POST['nombre_corto'];
    $PVP = $_POST['PVP'];
    $familia = $_POST['familia'];
    //Modificar
    $unidades = 1;
    //Reuno los datos en un array
    $producto = ['cod' => $cod,
        'nombre_corto' => $nombre_corto,
        'PVP' => $PVP,
        'familia' => $familia,
        'unidades' => $unidades];

    //Ahora utilizo la función pasándole como parámetros la cesta y el producto
    anadir_producto($cesta, $producto);
    //IMPORTANTE GUARDAR LA CESTA EN LA SESIÓN
    $_SESSION['cesta'] = $cesta;
}

//Comprobamos si se ha pulsado el botón vaciar 
if (isset($_POST['vaciar'])) {
    $cesta = [];
    $_SESSION['cesta'] = [];
}
//Comprobamos si la cesta está vacía
if (count($cesta) == 0) {
    $cesta_vacia = true;
} else {
    $cesta_vacia = false;
}


//Variables para la conexión a la bd
$cadena_conexion = 'mysql:dbname=dwes2;host=127.0.0.1';
$usuario = 'david';
$clave = 'usuario';

try {
    //Hago la conexión a la bd
    $bd = new PDO($cadena_conexion, $usuario, $clave);
    //Para mostrar el listado de familias
    $query = "SELECT * FROM producto WHERE familia= :familia";
    $preparar_productos = $bd->prepare($query);
    $parametros = [":familia" => $familia];
    $preparar_productos->execute($parametros);
    $productos = $preparar_productos->fetchAll(PDO::FETCH_OBJ);
    
} catch (Exception $ex) {
    $mensaje_catch = "Ha ocurrido un error: " . $ex->getMessage();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <title>Listado de productos</title>
        <link href="tienda.css" rel="stylesheet" type="text/css">
    </head>

    <body class="pagproductos">

        <div id="contenedor">
            <div id="encabezado">
                <h1>Listado de productos</h1>
            </div>

            <!-- Dividir en varios templates -->
            <div id="cesta">      
                <h3><img src='cesta.png' alt='Cesta' width='24' height='21'> Cesta</h3>
                <hr/>
                <?php if ($cesta_vacia): ?>
                    <h3>Cesta vacía</h3>
                <?php else: ?>
                    <table>
                        <tr>
                            <th>Nombre</th>
                            <th></th>
                            <th>Unidades</th>
                        </tr>

                        <?php foreach ($cesta as $prod): ?>
                            <tr>
                                <td><?= $prod['nombre_corto'] ?></td>
                                <td>x</td>
                                <td><?= $prod['unidades'] ?></td>
                            </tr>
                        <?php endforeach; ?>

                    </table>
                <?php endif ?>
                <form id='vaciar' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>' method='post'>

                    <input type='submit' name='vaciar' value='Vaciar Cesta'
                           <?php if ($cesta_vacia) print "disabled='true'"; ?>/>
                    <input type='hidden' name='familia' value='<?= $familia ?>'/>

                </form>
                <form id='comprar' action='cesta.php' method='post'>
                    <input type='submit' name='comprar' value='Comprar'
                           <?php if ($cesta_vacia) print "disabled='true'"; ?>/>
                </form>
            </div>

            <div id="productos">
                <table>
                    <tr>
                        <th>Añadir</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>PVP</th>
                    </tr>  
                    <?php foreach ($productos as $value): ?>
                        <tr>
                            <td>
                                <form id='anadir' action='listado_productos.php?familia=<?= $familia ?>' method='post'>
                                    <input type='submit' name='anadir' value='Añadir'/>
                                    <input type='hidden' name='cod' value='<?= $value->cod ?>'/>
                                    <input type='hidden' name='nombre_corto' value='<?= $value->nombre_corto ?>'/>
                                    <input type='hidden' name='PVP' value='<?= $value->PVP ?>'/>
                                    <input type='hidden' name='familia' value='<?= $value->familia ?>'/>
                                </form>
                            </td>
                            <td><?= $value->nombre_corto ?></td>
                            <td><?= $value->descripcion ?></td>
                            <td><?= $value->PVP ?>€</td>
                        </tr>
                    <?php endforeach; ?>

                </table>

            </div>

            <br class="divisor" />
            <div id="pie">
                <a href="listado_familias.php">Ir a Listado Familias</a>
                <br>
                <a href="cesta.php">Ir a Cesta</a>
                <form action='cesta.php' method='post'>
                    <input type='submit' name='desconectar' value='Desconectar usuario'/>
                </form>  
            </div>
        </div>

        <?php if (isset($mensaje_catch)): ?>
            <div id="mensaje_error">
                <p class="error"><?= $mensaje_catch ?></p>
            </div>
        <?php endif ?>
    </body>
</html>
