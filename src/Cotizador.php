<?php
namespace Cotizador;

use Carbon\Carbon;
use Tramasec\Util\EvalMath\EvalMath;

class Cotizador extends CotizadorInverso
{
    /**
     * @var \DateTime
     */
    protected $inicio_vigencia;

    /**
     * @var array
     */
    protected $formulas = [];

    /**
     * @var \DateTime
     */
    protected $fin_vigencia;

    /**
     * @var float
     */
    protected $valor_asegurado;

    /**
     * @var float
     */
    protected $valor_asegurado_sin_valores_extra;

    /**
     * @var float
     */
    protected $tasa;

    /**
     * @var float
     */
    protected $prima_neta_sin_valores_extra;

    /**
     * @var float
     */
    protected $prima_neta;

    /**
     * @var float
     */
    protected $prima_total = 0;

    /**
     * @var float
     */
    protected $prima_riesgo = 0;

    /**
     * @var float
     */
    protected $base_imponible;

    /**
     * @var int
     */
    protected $dias_vigencia;

    /**
     * @var float
     */
    protected $derechos_emision = 0;

    /**
     * @var array
     * Impuestos en porcentaje para calcular prima total a partir de la base imponible ej [12,12] iva 12
     */
    protected $impuestos = [];

    /**
     * @var array
     * Impuestos calculados a partir de la base imponible ej [12,2.411136] iva de la base imponible de 2.411136
     */
    protected $impuestosCalculados = [];

    /**
     * @var array
     * Impuestos en porcentaje para calcular la base imponible ej [5,0.5] ssc 0.5
     */
    protected $impuestosPrimaNeta = [];

    /**
     * @var array
     * Impuestos calculados a partir de la prima_neta ej [5,0.0966] ssc de la prima neta de 0.0966
     */
    protected $impuestosCalculadosPrimaNeta = [];

    /**
     * @var array
     * Valores de extras para agregar a la prima neta ej ['lucro cesante', 12.0]
     */
    protected $valoresExtrasPrima = [];

    /**
     * @var array
     * Valores de extras para agregar al valor asegurado ej ['plataforma', 1500]
     */
    protected $valoresExtrasValorAsegurado = [];

    /**
     * @var array
     * Valores de coberturas del cotizador ej [1, 'incendio' => [1000, 2]]
     */
    protected $coberturas = [];

    /**
     * @return array
     */
    public function getFormulas()
    {
        return $this->formulas;
    }

    /**
     * @param array $formulas
     */
    public function setFormulas($formulas)
    {
        $this->formulas = $formulas;
    }

    /**
     * @return \DateTime
     */
    public function getInicioVigencia()
    {
        return $this->inicio_vigencia;
    }

    /**
     * @param \DateTime $inicio_vigencia
     */
    public function setInicioVigencia(Carbon $inicio_vigencia)
    {
        $this->inicio_vigencia = $inicio_vigencia;
    }

    /**
     * @return \DateTime
     */
    public function getFinVigencia()
    {
        return $this->fin_vigencia;
    }

    /**
     * @param \DateTime $fin_vigencia
     */
    public function setFinVigencia(Carbon $fin_vigencia)
    {
        $this->fin_vigencia = $fin_vigencia;

        $inicio_vigencia = Carbon::parse($this->inicio_vigencia);
        $fin_vigencia = Carbon::parse($this->fin_vigencia);

        $this->dias_vigencia = $fin_vigencia->diffInDays($inicio_vigencia);
    }

    /**
     * @return float
     */
    public function getPrimaNeta()
    {
        return $this->prima_neta;
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
     * @return float
     */
    public function getBaseImponible()
    {
        return $this->base_imponible;
    }

    /**
     * @return int
     */
    public function getDiasVigencia()
    {
        return $this->dias_vigencia;
    }

    /**
     * @param float $valor_asegurado
     */
    public function setValorAsegurado(float $valor_asegurado)
    {
        $this->valor_asegurado = $valor_asegurado;
    }

    /**
     * @param float
     */
    public function setTasa(float $tasa)
    {
        $this->tasa = $tasa;
    }

    /**
     * @return float
     */
    public function getPrimaNetaSinValoresExtra()
    {
        return $this->prima_neta_sin_valores_extra;
    }

    /**
     * @return float
     */
    public function getPrimaRiesgo()
    {
        return $this->prima_riesgo;
    }

    /**
     * @return float
     */
    public function getDerechosEmision()
    {
        return $this->derechos_emision;
    }

    /**
     * @param float $derechos_emision
     */
    public function setDerechosEmision($derechos_emision)
    {
        $this->derechos_emision = $derechos_emision;
    }

    public function agregarCoberturas(int $id, object $valor) {
        $coberturas = $this->coberturas;
        $coberturas[$id] = $valor;

        $this->coberturas = $coberturas;
    }

    public function calcularCoberturas() {

        foreach ($this->coberturas as $key => $value){
            $value->prima_calculada  = $value->maximo_asegurado * ($value->porcentaje/100);
        }

        $this->calcularCoberturasPrimaNeta();
    }

    public function calcularCoberturasPrimaNeta() {

        $total = 0;
        foreach ($this->coberturas as $key => $value){
            $total = $total + $value->prima_calculada;
        }

        $this->prima_riesgo = $total;
    }

    public function agregarValoresExtrasValorAsegurado(string $detalle, float $valor) {
        $valoresExtrasValorAsegurado = $this->valoresExtrasValorAsegurado;
        $valoresExtrasValorAsegurado[$detalle] = $valor;

        $this->valoresExtrasValorAsegurado = $valoresExtrasValorAsegurado;
    }

    public function calcularValorAseguradoValoresExtras() {

        $this->valor_asegurado_sin_valores_extra = $this->valor_asegurado;
        $total = 0;
        foreach ($this->valoresExtrasValorAsegurado as $key => $value){
            $total = $total + $value;
        }

        $this->valor_asegurado = $this->valor_asegurado + $total;
    }

    public function calcularPrimaNeta() {

        $this->prima_neta = $this->valor_asegurado * ($this->tasa /100);
        $this->prima_neta_sin_valores_extra = $this->prima_neta;

    }

    public function agregarValoresExtrasPrima(string $detalle, float $valor) {
        $valoresExtrasPrima = $this->valoresExtrasPrima;
        $valoresExtrasPrima[$detalle] = $valor;

        $this->valoresExtrasPrima = $valoresExtrasPrima;
    }

    public function calcularPrimaNetaValoresExtras() {

        $total = 0;
        foreach ($this->valoresExtrasPrima as $key => $value){
            $total = $total + $value;
        }

        $this->prima_neta = $this->prima_neta + $total;
    }

    public function agregarImpuestoPrimaNeta(int $id, float $porcentaje) {
        $impuestosPrimaNeta = $this->impuestosPrimaNeta;
        $impuestosPrimaNeta[$id] = $porcentaje;

        $this->impuestosPrimaNeta = $impuestosPrimaNeta;
    }

    public function calcularImpuestosPrimaNeta() {

        $impuestosCalculados = [];

        foreach ($this->impuestosPrimaNeta as $key => $impuesto) {
            $impuestosCalculados[$key] = $this->prima_neta * ($impuesto/100);
        }

        $this->impuestosCalculadosPrimaNeta = $impuestosCalculados;
    }

    public function calcularBaseImponible() {

        $total = 0;
        foreach ($this->impuestosCalculadosPrimaNeta as $key => $value) {
            $total = $total + $value;
        }

        $this->base_imponible = $this->prima_neta + $total + $this->derechos_emision;
    }

    public function agregarImpuesto(int $id, float $porcentaje) {
        $impuestos = $this->impuestos;
        $impuestos[$id] = $porcentaje;

        $this->impuestos = $impuestos;
    }

    public function calcularImpuestos() {

        $impuestosCalculados = [];

        foreach ($this->impuestos as $key => $impuesto) {
            $impuestosCalculados[$key] = $this->base_imponible * ($impuesto/100);
        }

        $this->impuestosCalculados = $impuestosCalculados;
    }

    public function calcularPrimaTotal() {

        $total = 0;
        foreach ($this->impuestosCalculados as $key => $value) {
            $total = $total + $value;
        }

        $this->prima_total = round($this->base_imponible + $total, 2);
    }

    public function calcularPrimaNetaDiaria(int $dias){
        $prima_diaria = $this->prima_neta / $dias;

        $this->prima_neta = $prima_diaria * $this->dias_vigencia;
    }

    public function ejecutarFormulas(){

        $formulas = new EvalMath();

        $append = [
            "prima_riesgo = 0+".$this->prima_riesgo
        ];
        //$this->formulas = array_merge($append,$formulas);

        $form = array_merge($append, $this->getFormulas());

        foreach ( $form as $formula){

            $formulas->evaluate($formula);
        }

        $this->formulas_calculadas = $formulas->vars();

        foreach ($this->formulas_calculadas as $key => $value){

            if($key == 'prima_neta') {
                $this->$key = $value;
                $this->prima_neta_sin_valores_extra = $value;
            }
        }
    }

    /**
     * Realiza todos los cálculos pera generar el cotizador con prima diaria
     */
    public function cotizarPrimaDiaria(int $dias) {
        $this->calcularValorAseguradoValoresExtras();
        $this->calcularPrimaNeta();
        $this->calcularPrimaNetaDiaria($dias);
        $this->calcularPrimaNetaValoresExtras();
        $this->ejecutarFormulas();

        $this->calcularImpuestosPrimaNeta();
        $this->calcularBaseImponible();
        $this->calcularImpuestos();
        $this->calcularPrimaTotal();
    }

    /**
     * Realiza todos los cálculos pera generar el cotizador
     */
    public function cotizar() {
        $this->calcularCoberturas();
        $this->calcularValorAseguradoValoresExtras();
        $this->calcularPrimaNeta();
        $this->ejecutarFormulas();
        $this->calcularPrimaNetaValoresExtras();

        $this->calcularImpuestosPrimaNeta();
        $this->calcularBaseImponible();
        $this->calcularImpuestos();
        $this->calcularPrimaTotal();
    }

}
