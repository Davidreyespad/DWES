<?php

class Familia {
    
    private $cod;
    private $nombre;
    
    function __construct($fila) {
        $this->cod = $fila['cod'];
        $this->nombre = $fila['nombre'];
    }
    
    function get_cod(){
        return $this->cod;
    }
    
    function get_nombre(){
        return $this->nombre;
    }
    
}

