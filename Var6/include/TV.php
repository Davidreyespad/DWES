<?php
require_once('Producto.php');

class TV extends Producto{
    protected $pulgadas;
    protected $resolucion;
    protected $panel;
    
    public function get_pulgadas() {return $this->pulgadas; }
    public function get_resolucion() {return $this->resolucion; }
    public function get_panel() {return $this->panel; }
            
    public function __construct($row) {
        parent::__construct($row);
        $this->pulgadas = $row['pulgadas'];
        $this->resolucion = $row['resolucion'];
        $this->panel = $row['panel'];
    }
}

