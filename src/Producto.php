<?php
namespace Cotizador;

class Producto
{

    public $cotizadores = [];


    public function __construct()
    {

        $cotizadores = [];
        $cotizador = new \stdClass();
        $impuestos = [
            '0' => '0'
        ];

        $impuestosPrimaNeta = [
            '35' => 3.5,
            '5' => 0.5
        ];

        $cotizador->impuestos = $impuestos;
        $cotizador->impuestosPrimaNeta = $impuestosPrimaNeta;
        $cotizador->derechoEmision = 0.4;
        $cotizador->primaTotal = 2.00;
        $cotizador->valorAsegurado = 500;

        $cotizadores[] = $cotizador;




        $cotizador = new \stdClass();

        $impuestos = [
            '0' => '0'
        ];

        $impuestosPrimaNeta = [
            '35' => 3.5,
            '5' => 0.5
        ];

        $cotizador->impuestos = $impuestos;
        $cotizador->impuestosPrimaNeta = $impuestosPrimaNeta;
        $cotizador->derechoEmision = 0.4;
        $cotizador->primaTotal = 1;
        $cotizador->valorAsegurado = 100;

        $cotizadores[] = $cotizador;

        $cotizador = new \stdClass();

        $impuestos = [
            '12' => '12'
        ];

        $impuestosPrimaNeta = [
            '35' => 3.5,
            '5' => 0.5
        ];

        $cotizador->impuestos = $impuestos;
        $cotizador->impuestosPrimaNeta = $impuestosPrimaNeta;
        $cotizador->derechoEmision = 0.4;
        $cotizador->primaTotal = 1.99;
        $cotizador->valorAsegurado = 2000;

        $cotizadores[] = $cotizador;

        $this->cotizadores = $cotizadores;

    }
}