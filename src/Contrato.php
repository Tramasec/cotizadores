<?php
namespace Cotizador;

use Carbon\Carbon;

class Contrato
{
    protected $cotizadores = [];
    protected $pagos = [];
    protected $endosos = [];

    /**
     * @var Producto
     */
    private $producto = null;
    protected $periodos = [];

    public function cargarConfiguraciones() {

        $producto = new Producto();

        //dump($producto);
        $this->producto = $producto;



    }
    public function cotizarMasivo() {

        $this->generarPeriodo();

        $this->generarCotizaciones();

        $this->calcularPeriodo();
        $this->crearPago();


        dump($this);
    }

    private function crearPago() {
        $pago = new Pago('', $this->periodos[0]->getPrimaTotal());

        $periodo = $this->periodos[0];

        $periodo->setPagos([$pago]);
    }

    private function crearEndoso() {
        $pago = new Pago('', $this->periodos[0]->getPrimaTotal());

        $periodo = $this->periodos[0];

        $periodo->setPagos([$pago]);
    }

    private function calcularPeriodo() {

        $primaTotal = 0;
        $primaNeta = 0;
        $valorAsegurado = 0;

        foreach ($this->cotizadores as $cotizador) {
            $primaTotal = $primaTotal + $cotizador->getPrimaTotal();
            $primaNeta = $primaNeta + $cotizador->getPrimaNeta();
            $valorAsegurado = $valorAsegurado + $cotizador->getValorAsegurado();
        }

        $periodo = $this->periodos[0];

        $periodo->setPrimaTotal($primaTotal);
        $periodo->setPrimaNeta($primaNeta);
        $periodo->setValorAsegurado($valorAsegurado);

        $this->periodos = [$periodo];

    }

    private function generarPeriodo() {
        $periodo = new Periodo();

        $this->periodos = [$periodo];
    }

    private function generarCotizaciones() {
        $this->cargarConfiguraciones();

        $cotizadores = [];
        $endosos = [];

        //Iterar Cotitzadores
        foreach ($this->producto->cotizadores as $ct) {
            $cotizador = new Cotizador();

            foreach ($ct->impuestos as $key => $impuesto) {
                $cotizador->agregarImpuesto($key, $impuesto);
            }

            foreach ($ct->impuestosPrimaNeta as $key => $impuesto) {
                $cotizador->agregarImpuestoPrimaNeta($key, $impuesto);
            }

            $cotizador->setDerechosEmision($ct->derechoEmision);
            $cotizador->setValorAsegurado($ct->valorAsegurado);
            $cotizador->setPrimaTotal($ct->primaTotal);

            $cotizador->cotizadorInverso();
            $cotizador->cotizar();

            $cotizadores[] = $cotizador;

            $endoso = new Endoso(Carbon::now(), Carbon::now()->addMonth(), 0,
                $cotizador->getValorAsegurado(), $cotizador->getTasa(), $cotizador->getPrimaNeta(),
                $cotizador->getPrimaTotal(), 'pendiente', null, null);

            $endosos[] = $endoso;
        }


        $this->cotizadores = $cotizadores;
        $this->endosos = $endosos;
        $periodo = $this->periodos[0];

        $periodo->setEndosos($endosos);
        $periodo->setCotizadores($cotizadores);
    }
}