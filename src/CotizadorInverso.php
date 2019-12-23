<?php
namespace Cotizador;

class CotizadorInverso
{
    public function cotizadorInverso()
    {
        $this->base_imponible = $this->totalImpuestos();
        $this->prima_neta = $this->totalImpuestosPrimaNeta();
        $this->tasa = ($this->prima_neta/$this->valor_asegurado)*100;
    }
    public function totalImpuestos()
    {
        $total = 0;
        foreach ($this->impuestos as $impuesto) {
            $total = $total + $impuesto;
        }
        $total = $this->prima_total / (1+($total/100));
        return $total;
    }
    public function totalImpuestosPrimaNeta()
    {
        $total = 0;
        foreach ($this->impuestosPrimaNeta as $impuesto) {
            $total = $total + $impuesto;
        }
        $total = ($this->base_imponible - $this->derechos_emision) / (1+($total/100));
        return $total;
    }
}
