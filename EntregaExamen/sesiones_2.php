<?php
require_once './funciones.php';
comprobarSesion();


if ($_SESSION['palabra1'] == "") {
    header("Location: sesiones_1.php?vacio=true");
} elseif ($_SESSION['palabra1'] == " " || !ctype_alnum($_SESSION['palabra1'])) {
    header("Location: sesiones_1.php?raros=true");
} else {
    header("Location: sesiones_1.php?valida=true");

}
?>
