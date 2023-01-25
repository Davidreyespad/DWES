<?php

function recoge($var)
{
    $tmp = (isset($_REQUEST[$var])) ? trim(strip_tags($_REQUEST[$var])) : '';
    if (get_magic_quotes_gpc()) {
        $tmp = stripslashes($tmp);
    }
    $tmp = str_replace('&', '&amp;',  $tmp);
    $tmp = str_replace('"', '&quot;', $tmp);
    return $tmp;
}

$color  = recoge('color');
// Si se envía un color se crea la cookie
if (($color=='rojo') || ($color=='azul') || ($color=='verde')) {
    setcookie('cookieColor', $color);
// Si se envía el color ninguno se destruye la cookie
} elseif ($color=='ninguno') {
    setcookie ("cookieColor", "", time() - 3600);
// Si no se envía ningún color se mira si hay cookie con un color
} elseif (isset($_COOKIE['cookieColor'])) {
    $color = $_COOKIE['cookieColor'];
}

print "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?".">
<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\"
       \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\">
<head>
  <meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\" />
  <title>Selección de colores (selección). Cookies.
  Ejercicios. PHP. Bartolomé Sintes Marco</title>
  <link href=\"mclibre_php_soluciones.css\" rel=\"stylesheet\" type=\"text/css\"
    title=\"Color\" />
</head>

<body>
<h1>Selección de colores (selección)</h1>\n";
if ($color=='') {
    print "<p>No se ha elegido ningún color.</p>\n";
} else {
    print "<p>Se ha elegido el color $color.</p>\n";
}

print "<p>Cambio de color: <a href=\"$_SERVER[PHP_SELF]?color=rojo\">Rojo</a> -
  <a href=\"$_SERVER[PHP_SELF]?color=azul\">Azul</a> -
  <a href=\"$_SERVER[PHP_SELF]?color=verde\">Verde</a> -
  <a href=\"$_SERVER[PHP_SELF]?color=ninguno\">Ninguno</a>.</p>
<p><a href=\"cookies_1b.php\">Ir a otra página para comprobar la cookie</a></p>";

print '
</body>
</html>';

?>