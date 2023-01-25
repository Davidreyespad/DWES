<?php
//Comprobar si tengo sesion
require_once 'funciones.php';
comprobarSesion();

//Recuperamos la cesta
$cesta = cargarCesta();
//Nombre de Usuario
$usuario = $_SESSION['usuario'];

//Si la cesta está vacía, redireccionamos a listado familias
if (count($cesta) == 0) {
    header('Location: listado_familias.php?redireccionado_cesta=true');
}

//Si pulsamos modificar unidades
if (isset($_POST['modificar_unidades'])){
    //Recogemos el codigo del producto que queremos modificar
    $cod_modif= $_POST['cod_modif'];
    
    //Recogemos las unidades del producto que queremos modificar
    $unidades_modif = $_POST['unidades_modif'];
    
    //Modificamos la cesta
    $cesta[$cod_modif]['unidades']=$unidades_modif;
    $_SESSION['cesta']=$cesta;
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

//Calcular el precio total
$precioFinal = 0;

foreach ($cesta as $producto) {
    $precioFinal += $producto['PVP'] * $producto['unidades'];
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<!-- Tienda Web: cesta.php -->
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <title>Cesta de la Compra</title>
        <link href="tienda.css" rel="stylesheet" type="text/css">
    </head>

    <body class="pagcesta">

        <div id="contenedor">
            <div id="encabezado">
                <h1>Cesta de la compra</h1>
            </div>
            <div id="productos">
                <table border="1">
                    <tr>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Unidades</th>
                        <th>Importe</th>
                    </tr>
                   
                        <?php foreach ($cesta as $producto): ?>
                        <tr>
                            <td><?= $producto['nombre_corto'] ?></td>
                            <td><?= $producto['PVP'] ?></td>
                            <td>
                                <form id='modificar' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>' method='post'>
                                    <input type="number" name='unidades_modif' value="<?= $producto['unidades']?>"></input>
                                    <input type='submit' name='modificar_unidades' value='Modificar'/>
                                    <input type='hidden' name='cod_modif' value='<?= $producto['cod']?>'/>
                                </form>
                            </td>
                            <td><?=$producto['PVP']*$producto['unidades']?></td>
                            </tr>
                        <?php endforeach; ?>

                </table>
                <hr/>
                <p><span class='pagar'>Precio total: <?= $precioFinal ?> €</span></p>
                <form action='pagar.php' method='post'>
                    <p><span class='pagar'>
                            <input type='submit' name='pagar' value='Pagar'/>
                        </span></p>
                </form>
            </div>
            <br class="divisor" />
            <div id="pie">
                <form action='cesta.php' method='post'>
                    <input type='submit' name='desconectar' value='Desconectar usuario'/>
                </form>        
            </div>
             <div id="pie">
                <a href="listado_familias.php">Ir a Listado Familias</a>
                <br>
                <a href="listado_productos.php">Ir a Listado Productos</a>
            </div>
        </div>
    </body>
</html>

