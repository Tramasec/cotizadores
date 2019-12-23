<?php


require_once ('./vendor/autoload.php');


$a = new \Cotizador\Cotizador();
$date = \Carbon\Carbon::now();
$date2 = \Carbon\Carbon::now()->addMonth();

$a->setInicioVigencia($date);
$a->setFinVigencia($date2);

//Valores asegurados y tasas
$a->setValorAsegurado(16000);
$a->setPrimaTotal(9.98);

$a->setDerechosEmision(0.5);

//Impuestos a base imponible
$a->agregarImpuesto(12, 12.0);


//Impuestos a prima neta
$a->agregarImpuestoPrimaNeta(35, 3.5);
$a->agregarImpuestoPrimaNeta(5, 0.5);

$a->cotizadorInverso();
$a->cotizar();


dump($a);
