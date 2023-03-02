<?php
class Producto implements JsonSerializable{
    protected $codigo;
    protected $nombre;
    protected $nombre_corto;
    protected $PVP;
    protected $familia;
    
    public function get_codigo() {return $this->codigo; }
    public function get_nombre() {return $this->nombre; }
    public function get_nombre_corto() {return $this->nombre_corto; }
    public function get_PVP() {return $this->PVP; }
    public function get_familia() {return $this->familia; }
    
        
    public function muestra() { print "$this->nombre_corto"; }
    
    public function __construct($row) {
        $this->codigo = $row['cod'];
        $this->nombre = $row['nombre'];
        $this->nombre_corto = $row['nombre_corto'];
        $this->PVP = $row['PVP'];
        $this->familia=$row['familia'];
    }
    

    public function jsonSerialize(){
        return $this->row;
    }

}
