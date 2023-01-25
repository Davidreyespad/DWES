<?php

class familia {
    protected $cod;
    protected $nombre;    
    
    public function __construct($fila_array) {
        $this->cod=$fila_array['codigo'];
        $this->nombre=$fila_array['nombre'];        
    }
    
    
}

?>