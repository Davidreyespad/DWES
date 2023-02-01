<?php


class Familia {
    //Atributos de la Clase
    private $cod;
    private $nombre;
    
    //Constructor (Le paso una fila y accedo a sus valores por la clave)
    function __construct($fila) {
        $this->cod = $fila['cod'];
        $this->nombre= $fila['nombre'];
    }
    //Get
    function get_cod() {
        return $this->cod;
    }
    function get_nombre() {
        return $this->nombre;
    }
   
}
