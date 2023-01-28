<?php
require_once './CestaCompra.php';
require_once './DB.php';
require_once './familia.php';

class Producto {

    protected $codigo;
    protected $nombre;
    protected $nombre_corto;
    protected $PVP;

    public function getcodigo() {
        return $this->codigo;
    }

    public function getnombre() {
        return $this->nombre;
    }

    public function getnombrecorto() {
        return $this->nombre_corto;
    }

    public function getPVP() {
        return $this->PVP;
    }

    public function muestra() {
        print "<p>" . $this->codigo . "</p>";
    }

    public function __construct($row) {

        $this->codigo = $row['cod'];
        $this->nombre = $row['nombre'];
        $this->nombre_corto = $row['nombre_corto'];
        $this->PVP = $row['PVP'];
    }

}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
    </body>
</html>
