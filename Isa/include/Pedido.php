<?php
class Pedido{
    protected $codped;
    protected $fecha;
    protected $usuario;
    protected $coste;
    
    public function __construct($parametros){
        $this->codped=$parametros['codped'];
        $this->fecha=$parametros['fecha'];
        $this->usuario = $parametros['usuario'];
        $this->coste=$parametros['coste'];
    }
    
    public function get_codped() {
        return $this->codped;
    }

    public function get_fecha() {
        return $this->fecha;
    }

    public function get_usuario() {
        return $this->usuario;
    }
    
    public function get_coste() {
        return $this->coste;
    }
   
    public function set_codped($codped): void {
        $this->codped = $codped;
    }

    public function set_fecha($datetime): void {
        $this->fecha = $datetime;
    }

    public function set_usuario($usuario): void {
        $this->usuario = $usuario;
    }
    
     public function set_coste($coste): void {
        $this->coste = $coste;
    }
}

