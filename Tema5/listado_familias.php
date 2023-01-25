<?php
//Comprobar si tengo sesion
require_once './funciones.php';
require_once './CestaCompra.php';
comprobar_sesion();

//Compruebo si viene redirigido de listado_productos
if (isset($_REQUEST['redirigido_sin_familia'])) {
    $mensaje_redirigido_sin_familia = 'Debe usted seleccionar previamente alguna familia para acceder al listado de productos.';
}
//Compruebo si vengo redireccionado de cesta
if (isset($_REQUEST['redireccionado_cesta'])) {
    $mensaje_cesta_vacia = 'No puede acceder a la cesta sin productos introducidos';
}

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

//Variables para la conexión a la bd
$cadena_conexion = 'mysql:dbname=dwes2;host=127.0.0.1';
$usuario = 'david';
$clave = 'usuario';

try {
    //Hago la conexión a la bd
    $bd = new PDO($cadena_conexion, $usuario, $clave);
    //Para mostrar el listado de familias
    $query = "SELECT * FROM familia";
    $consulta_familias = $bd->query($query);
    $resultado_familias = $consulta_familias->fetchAll(PDO::FETCH_OBJ);

    //Comprobamos si hay cesta creada, sino la creamos
    $cesta_compra = CestaCompra::carga_cesta();
    //Comprobamos si se ha pulsado el botón vaciar 
    if (isset($_REQUEST['vaciar'])) {
        $cesta_compra = [];
        $_SESSION['cesta'] = [];
    }
    //Creamos variable cargar cesta
    if (count($cesta_compra) == 0) {
        $cesta_vacia = true;
    } else {
        $cesta_vacia = false;
    }
} catch (PDOException $ex) {
    $mensaje_catch = "Ha ocurrido un error: " . $ex->getMessage();
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<!-- Tienda Web: listado_familias.php -->
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <title>Listado de familias</title>
        <link href="tienda.css" rel="stylesheet" type="text/css">
    </head>

    <body class="pagproductos">

        <div id="contenedor">
            <div id="encabezado">
                <h1>Listado de familias</h1>
            </div>
            <div>
                <?php if (isset($mensaje_redirigido_sin_familia)): ?>
                    <p class="error"><?= $mensaje_redirigido_sin_familia ?></p>
                <?php endif ?>
                <?php if (isset($mensaje_cesta_vacia)): ?>
                    <p class="error"><?= $mensaje_cesta_vacia ?><p>
                    <?php endif ?>
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
                        <?php foreach ($cesta_compra as $prod): ?>
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
                </form>
                <form id='comprar' action='cesta.php' method='post'>
                    <input type='submit' name='comprar' value='Comprar'
                           <?php if ($cesta_vacia) print "disabled='true'"; ?>/>

                </form>

            </div>

            <!--Lista de vínculos con la forma listado_productos.php?categoria=-->
            <div id="productos">
                <h3>Seleccione una familia:</h3>
                <ul >
                    <?php foreach ($resultado_familias as $valor): ?>
                        <li> <a href="listado_productos.php?familia=<?= $valor->cod ?>"><?= $valor->nombre ?></a></li>
                    <?php endforeach ?>
                </ul>
            </div>

            <br class="divisor" />
            <div id="pie">
                <a href="listado_productos.php">Ir a Listado Productos</a>
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