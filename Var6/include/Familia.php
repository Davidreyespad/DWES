<?php
class Familia {
    protected $codigo;
    protected $nombre;
    
    public function getcodigo() {return $this->codigo; }
    public function getnombre() {return $this->nombre; }
            
    public function __construct($row) {
        $this->codigo = $row['cod'];
        $this->nombre = $row['nombre'];
    }
}
