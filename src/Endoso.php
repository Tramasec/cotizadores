<?php


namespace Cotizador;


use Carbon\Carbon;
use phpDocumentor\Reflection\Types\Float_;

class Endoso
{
    /**
     * @var \Carbon\Carbon
     */
    protected $fecha_inicio;

    /**
     * @var \Carbon\Carbon
     */
    protected $fecha_fin;

    /**
     * @var int
     */
    protected $numero_endoso;

    /**
     * @var float
     */
    protected $valor_asegurado;

    /**
     * @var float
     */
    protected $tasa;

    /**
     * @var float
     */
    protected $prima_neta;

    /**
     * @var float
     */
    protected $prima_total;

    /**
     * @var string
     */
    protected $estado_emision;

    /**
     * @var int
     */
    protected $numero_poliza;

    /**
     * @var string
     */
    protected $numero_factura;

    /**
     * @var string
     */
    protected $canal_id;

    /**
     * @var string
     */
    protected $producto_id;

    /**
     * @var string
     */
    protected $contrato_id;

    /**
     * @var int
     */
    protected $periodo_id;

    /**
     * Endoso constructor.
     * @param Carbon $fecha_inicio
     * @param Carbon $fecha_fin
     * @param int $numero_endoso
     * @param float $valor_asegurado
     * @param float $tasa
     * @param float $prima_neta
     * @param float $prima_total
     * @param string $estado_emision
     * @param int $numero_poliza
     * @param string $numero_factura
     */
    public function __construct(Carbon $fecha_inicio, Carbon $fecha_fin, $numero_endoso, $valor_asegurado, $tasa, $prima_neta, $prima_total, $estado_emision, $numero_poliza, $numero_factura)
    {
        $this->fecha_inicio = $fecha_inicio;
        $this->fecha_fin = $fecha_fin;
        $this->numero_endoso = $numero_endoso;
        $this->valor_asegurado = $valor_asegurado;
        $this->tasa = $tasa;
        $this->prima_neta = $prima_neta;
        $this->prima_total = $prima_total;
        $this->estado_emision = $estado_emision;
        $this->numero_poliza = $numero_poliza;
        $this->numero_factura = $numero_factura;
    }


    /**
     * @return \Carbon\Carbon
     */
    public function getFechaInicio()
    {
        return $this->fecha_inicio;
    }

    /**
     * @param \Carbon\Carbon $fecha_inicio
     */
    public function setFechaInicio(Carbon $fecha_inicio)
    {
        $this->fecha_inicio = $fecha_inicio;
    }

    /**
     * @return \Carbon\Carbon
     */
    public function getFechaFin()
    {
        return $this->fecha_fin;
    }

    /**
     * @param \Carbon\Carbon $fecha_fin
     */
    public function setFechaFin(Carbon $fecha_fin)
    {
        $this->fecha_fin = $fecha_fin;
    }

    /**
     * @return float
     */
    public function getValorAsegurado()
    {
        return $this->valor_asegurado;
    }

    /**
     * @param float $valor_asegurado
     */
    public function setValorAsegurado(float $valor_asegurado)
    {
        $this->valor_asegurado = $valor_asegurado;
    }

    /**
     * @return float
     */
    public function getTasa()
    {
        return $this->tasa;
    }

    /**
     * @param float $tasa
     */
    public function setTasa(float $tasa)
    {
        $this->tasa = $tasa;
    }

    /**
     * @return float
     */
    public function getPrimaNeta()
    {
        return $this->prima_neta;
    }

    /**
     * @param float $prima_neta
     */
    public function setPrimaNeta(float $prima_neta)
    {
        $this->prima_neta = $prima_neta;
    }

    /**
     * @return float
     */
    public function getPrimaTotal()
    {
        return $this->prima_total;
    }

    /**
     * @param float $prima_total
     */
    public function setPrimaTotal(float $prima_total)
    {
        $this->prima_total = $prima_total;
    }

    /**
     * @return int
     */
    public function getNumeroEndoso()
    {
        return $this->numero_endoso;
    }

    /**
     * @param int $numero_endoso
     */
    public function setNumeroEndoso(int $numero_endoso)
    {
        $this->numero_endoso = $numero_endoso;
    }

    /**
     * @return string
     */
    public function getEstadoEmision()
    {
        return $this->estado_emision;
    }

    /**
     * @param string $estado_emision
     */
    public function setEstadoEmision(string $estado_emision)
    {
        $this->estado_emision = $estado_emision;
    }

    /**
     * @return int
     */
    public function getNumeroPoliza()
    {
        return $this->numero_poliza;
    }

    /**
     * @param int $numero_poliza
     */
    public function setNumeroPoliza(int $numero_poliza)
    {
        $this->numero_poliza = $numero_poliza;
    }

    /**
     * @return string
     */
    public function getNumeroFactura()
    {
        return $this->numero_factura;
    }

    /**
     * @param string $numero_factura
     */
    public function setNumeroFactura(string $numero_factura)
    {
        $this->numero_factura = $numero_factura;
    }

    /**
     * @return string
     */
    public function getCanalId()
    {
        return $this->canal_id;
    }

    /**
     * @param string $canal_id
     */
    public function setCanalId(string $canal_id)
    {
        $this->canal_id = $canal_id;
    }

    /**
     * @return string
     */
    public function getProductoId()
    {
        return $this->producto_id;
    }

    /**
     * @param string $producto_id
     */
    public function setProductoId(string $producto_id)
    {
        $this->producto_id = $producto_id;
    }

    /**
     * @return string
     */
    public function getContratoId()
    {
        return $this->contrato_id;
    }

    /**
     * @param string $contrato_id
     */
    public function setContratoId(string $contrato_id)
    {
        $this->contrato_id = $contrato_id;
    }

    /**
     * @return string
     */
    public function getPeriodoId()
    {
        return $this->periodo_id;
    }

    /**
     * @param int $periodo_id
     */
    public function setPeriodoId(int $periodo_id)
    {
        $this->periodo_id = $periodo_id;
    }

}