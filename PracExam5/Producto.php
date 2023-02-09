<?php

class Producto{
    
    private $cod;
    private $nombre;
    private $nombre_corto;
    private $pvp;
    private $familia;
    private $descripcion;
    
    function __construct($fila) {
        $this->cod = $fila['cod'];
        $this->nombre = $fila['nombre'];
        $this->nombre_corto = $fila['nombre_corto'];
        $this->pvp = $fila['PVP'];
        $this->familia = $fila['familia'];
        $this->descripcion = $fila['descripcion'];        
    }
    
    public function getCod(){
        return $this->cod;
    }
    
    public function getNombre(){
        return $this->nombre;
    }
    
    public function getNombre_corto(){
        return $this->nombre_corto;
    }
    
    public function getPvp(){
        return $this->pvp;
    }
    
    public function getFamilia(){
        return $this->familia;
    }
    
    public function getDescripcion(){
        return $this->descripcion;
    }
    
}

