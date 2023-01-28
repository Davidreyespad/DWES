<?php

class familia {

    protected $cod;
    protected $nombre;

    function __construct($fila_array) {
        $this->cod = $fila_array['cod'];
        $this->nombre = $fila_array['nombre'];
    }

    function get_cod() {
        return $this->cod;
    }

    function get_nombre() {
        return $this->nombre;
    }

}

?>