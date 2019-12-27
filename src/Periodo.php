<?php


namespace Cotizador;


use Carbon\Carbon;

class Periodo
{
    protected $pagos = [];
    protected $endosos = [];
    protected $cotizadores = [];

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
    protected $year;

    /**
     * @var string
     */
    protected $estado;

    /**
     * @var float
     */
    protected $valor_asegurado;

    /**
     * @var float
     */
    protected $prima_neta;

    /**
     * @var float
     */
    protected $prima_total;

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
     * @return int
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param int $year
     */
    public function setYear(int $year)
    {
        $this->year = $year;
    }

    /**
     * @return string
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * @param string $estado
     */
    public function setEstado(string $estado)
    {
        $this->estado = $estado;
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
     * @return array
     */
    public function getEndosos()
    {
        return $this->endosos;
    }

    /**
     * @param array $endosos
     */
    public function setEndosos($endosos)
    {
        $this->endosos = $endosos;
    }

    /**
     * @return array
     */
    public function getPagos()
    {
        return $this->pagos;
    }

    /**
     * @param array $pagos
     */
    public function setPagos($pagos)
    {
        $this->pagos = $pagos;
    }

    /**
     * @return array
     */
    public function getCotizadores()
    {
        return $this->cotizadores;
    }

    /**
     * @param array $cotizadores
     */
    public function setCotizadores($cotizadores)
    {
        $this->cotizadores = $cotizadores;
    }

}