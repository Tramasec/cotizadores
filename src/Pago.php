<?php


namespace Cotizador;


class Pago
{
    public $fechaCorte;
    public $valorAcordado;
    public $valorCalculado;
    public $estado;
    public $periodo;

    public function __construct($fechaCorte, $valorAcordado)
    {
        $this->fechaCorte = $fechaCorte;
        $this->valorAcordado = $valorAcordado;
        $this->valorCalculado = $valorAcordado;
        $this->estado = 'por cobrar';
        $this->periodo = '';
    }

}