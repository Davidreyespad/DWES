<?php
class PedidoProducto{
    protected $codpedprod;
    protected $codped;
    protected $codprod;
    protected $unidades;
    
    public function __construct($parametros){
        $this->codpedprod=$parametros['codpedprod'];
        $this->codped=$parametros['codped'];
        $this->codprod=$parametros['codprod'];
        $this->unidades = $parametros['unidades'];
    }
    
    public function get_codpedprod() {
        return $this->codpedprod;
    }

    public function get_codped() {
        return $this->codped;
    }

    public function get_producto() {
        return $this->codprod;
    }

    public function get_unidades() {
        return $this->unidades;
    }
}