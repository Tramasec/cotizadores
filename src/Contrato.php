<?php
namespace Cotizador;

class Contrato
{
    protected $cotizadores = [];
    protected $pagos = [];

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
        $pago = new Pago('', $this->periodos[0]->primaTotal);

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

        $periodo->primaTotal = $primaTotal;
        $periodo->primaNeta = $primaNeta;
        $periodo->valorAsegurado = $valorAsegurado;

        $this->periodos = [$periodo];

    }

    private function generarPeriodo() {
        $periodo = new Periodo();

        $this->periodos = [$periodo];
    }

    private function generarCotizaciones() {
        $this->cargarConfiguraciones();

        $cotizadores = [];

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
        }


        $this->cotizadores = $cotizadores;
    }
}