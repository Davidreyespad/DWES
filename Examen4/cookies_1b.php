<?php
$color = isset($_COOKIE['cookieColor'])?$_COOKIE['cookieColor']:'';

print "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?".">
<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\"
       \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\">
<head>
  <meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\" />
  <title>Selección de colores (comprobación). Cookies.
  Ejercicios. PHP. Bartolomé Sintes Marco</title>
  <link href=\"mclibre_php_soluciones.css\" rel=\"stylesheet\" type=\"text/css\"
    title=\"Color\" />\n";
if ($color=='rojo') {
  print "  <style type=\"text/css\">body, a { color: red; }</style>\n";
} elseif ($color=='azul') {
  print "  <style type=\"text/css\">body, a { color: blue; }</style>\n";
} elseif ($color=='verde') {
  print "  <style type=\"text/css\">body, a { color: green; }</style>\n";
}

print "</head>

<body>
<h1>Selección de colores (comprobación)</h1>\n";
if ($color=='') {
    print "<p>No se ha elegido ningún color.</p>\n";
} else {
    print "<p>Se ha elegido el color $color.</p>\n";
}

print "<p><a href=\"cookies_1a.php\">Volver a la selección de color</a></p>";
?>