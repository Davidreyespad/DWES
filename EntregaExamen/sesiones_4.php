<?php

require_once './funciones.php';
comprobarSesion();


if ($_SESSION['palabra2'] == "") {
    header("Location: sesiones_3.php?vacio2=true");
} elseif ($_SESSION['palabra2'] == " " || !ctype_alnum($_SESSION['palabra2'])) {
    header("Location: sesiones_3.php?raros2=true");
} elseif (($_SESSION['palabra2']) !== $_SESSION['palabra1']) {
    header("Location: sesiones_1.php?desiguales=true");
}elseif (($_SESSION['palabra2']) == $_SESSION['palabra1']) {
    header("Location: sesiones_3.php?iguales=true");
}
?>
