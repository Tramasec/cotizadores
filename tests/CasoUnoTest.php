<?php
use PHPUnit\Framework\TestCase;

class CasoUnoTest extends TestCase
{
    public function test1()
    {

        $a = new \Cotizador\Cotizador();
        $date = \Carbon\Carbon::now();

        $a->setInicioVigencia($date);
        $a->setFinVigencia($date->clone()->addMonth());

        //Valores asegurados y tasas
        $a->setValorAsegurado(244);
        $a->setTasa(3);

        //Impuestos a base imponible
        $a->agregarImpuesto(12, 12.0);


        //Impuestos a prima neta
        $a->agregarImpuestoPrimaNeta(35, 3.5);
        $a->agregarImpuestoPrimaNeta(5, 0.5);

        //Valores extras en prima neta
        $a->agregarValoresExtrasPrima('lucro cesante', 12);

        $a->cotizar();

        $this->assertEquals(19.32, $a->getPrimaNeta());
        $this->assertEquals(22.50, $a->getPrimaTotal());
        $this->assertEquals(20.0928, $a->getBaseImponible());
        $this->assertEquals(7.32, $a->getPrimaNetaSinValoresExtra());
    }


    public function testToJVehiculo()
    {

        $a = new \Cotizador\Cotizador();
        $date = \Carbon\Carbon::now();
        $date2 = \Carbon\Carbon::now()->addYear();

        $a->setInicioVigencia($date);
        $a->setFinVigencia($date2);

        //Valores asegurados y tasas
        $a->setValorAsegurado(27000);
        $a->setTasa(3.4);

        $a->agregarValoresExtrasValorAsegurado('plataforma', 1500);
        $a->setDerechosEmision(3);

        //Impuestos a base imponible
        $a->agregarImpuesto(12, 12.0);


        //Impuestos a prima neta
        $a->agregarImpuestoPrimaNeta(35, 3.5);
        $a->agregarImpuestoPrimaNeta(5, 0.5);

        $a->cotizar();

        $this->assertEquals(969, $a->getPrimaNeta());
        $this->assertEquals(1132.05, $a->getPrimaTotal());
        $this->assertEquals(1010.76, $a->getBaseImponible());
        $this->assertEquals(969, $a->getPrimaNetaSinValoresExtra());
    }


    public function testNVCVehiculo()
    {

        $a = new \Cotizador\Cotizador();
        $date = \Carbon\Carbon::now();
        $date2 = \Carbon\Carbon::now()->addYear();

        $a->setInicioVigencia($date);
        $a->setFinVigencia($date2);

        //Valores asegurados y tasas
        $a->setValorAsegurado(19990);
        $a->setTasa(3.5);

        //$a->agregarValoresExtrasValorAsegurado('plataforma', 1500);
        $a->setDerechosEmision(0.42);

        //Impuestos a base imponible
        $a->agregarImpuesto(12, 12.0);


        //Impuestos a prima neta
        $a->agregarImpuestoPrimaNeta(35, 3.5);
        $a->agregarImpuestoPrimaNeta(5, 0.5);

        $a->cotizar();

        $this->assertEquals(699.65, $a->getPrimaNeta());
        $this->assertEquals(815.42, $a->getPrimaTotal());
        $this->assertEquals(728.056, $a->getBaseImponible());
    }

    public function testCDSVehiculo()
    {

        $a = new \Cotizador\Cotizador();
        $date = \Carbon\Carbon::now();
        $date2 = \Carbon\Carbon::now()->addYear();

        $a->setInicioVigencia($date);
        $a->setFinVigencia($date2);

        //Valores asegurados y tasas
        $a->setValorAsegurado(23500);
        $a->setTasa(3);

        $a->setDerechosEmision(0.45);

        //Impuestos a base imponible
        $a->agregarImpuesto(12, 12.0);


        //Impuestos a prima neta
        $a->agregarImpuestoPrimaNeta(35, 3.5);
        $a->agregarImpuestoPrimaNeta(5, 0.5);

        $a->cotizarPrimaDiaria(365);

        $this->assertEquals(706.931506849315, $a->getPrimaNeta());
        $this->assertEquals(823.94, $a->getPrimaTotal());
        $this->assertEquals(735.6587671232877, $a->getBaseImponible());
    }

    public function testPTP()
    {

        $a = new \Cotizador\Cotizador();
        $date = \Carbon\Carbon::now();
        $date2 = \Carbon\Carbon::now()->addMonth();

        $a->setInicioVigencia($date);
        $a->setFinVigencia($date2);

        //Valores asegurados y tasas
        $a->setValorAsegurado(500);
        $a->setPrimaTotal(2.99);

        $a->setDerechosEmision(0);

        //Impuestos a base imponible
        //$a->agregarImpuesto(12, 12.0);


        //Impuestos a prima neta
        $a->agregarImpuestoPrimaNeta(35, 3.5);
        $a->agregarImpuestoPrimaNeta(5, 0.5);

        $a->cotizadorInverso();

        $this->assertEquals(2.875, $a->getPrimaNeta());
        $this->assertEquals(2.99, $a->getPrimaTotal());
        //$this->assertEquals(, $a->getBaseImponible());
    }

    public function testPD763()
    {

        $a = new \Cotizador\Cotizador();
        $date = \Carbon\Carbon::now();
        $date2 = \Carbon\Carbon::now()->addMonth();

        $a->setInicioVigencia($date);
        $a->setFinVigencia($date2);

        //Valores asegurados y tasas
        $a->setValorAsegurado(1550);
        $a->setPrimaTotal(7.63);

        $a->setDerechosEmision(0.5);

        //Impuestos a base imponible
        //$a->agregarImpuesto(12, 12.0);


        //Impuestos a prima neta
        $a->agregarImpuestoPrimaNeta(35, 3.5);
        $a->agregarImpuestoPrimaNeta(5, 0.5);

        $a->cotizadorInverso();

        $this->assertEquals(6.855769230769231, $a->getPrimaNeta());
        $this->assertEquals(7.63, $a->getPrimaTotal());

    }

    public function testPD7999()
    {

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

        $this->assertEquals(8.0872252747253, $a->getPrimaNeta());
        $this->assertEquals(9.98, $a->getPrimaTotal());

    }

    public function testCoberturas()
    {

        $a = new \Cotizador\Cotizador();
        $date = \Carbon\Carbon::now();
        $a->setInicioVigencia($date);
        $a->setFinVigencia($date->clone()->addMonth());
        $cobertura1 = new stdClass();
        $cobertura1->nombre = 'incendio';
        $cobertura1->maximo_asegurado = 20000;
        $cobertura1->porcentaje = 0.015;
        $a->agregarCoberturas(1, $cobertura1);
        $cobertura2 = new stdClass();
        $cobertura2->nombre = 'robo';
        $cobertura2->maximo_asegurado = 6000;
        $cobertura2->porcentaje = 0.075;
        $a->agregarCoberturas(2, $cobertura2);
        $cobertura3 = new stdClass();
        $cobertura3->nombre = 'robo equipo electronico';
        $cobertura3->maximo_asegurado = 2000;
        $cobertura3->porcentaje = 0.0;
        $a->agregarCoberturas(3, $cobertura3);
        $cobertura4 = new stdClass();
        $cobertura4->nombre = 'responsabilidad civil';
        $cobertura4->maximo_asegurado = 2000;
        $cobertura4->porcentaje = 0.0666666666666667;

        $a->agregarCoberturas(4, $cobertura4);
        $a->agregarImpuesto(12, 12.0);
        $a->agregarImpuestoPrimaNeta(35, 3.5);
        $a->agregarImpuestoPrimaNeta(5, 0.5);
        $a->setPrimaTotal(19.983);
        $a->setValorAsegurado(15000);
        $a->setDerechosEmision(1.05);


        $a->setFormulas([
            'prima_neta = 16.1461195054945'
        ]);

        $a->ejecutarFormulas();


        $a->cotizadorInverso();
        $a->cotizar();

        $this->assertEquals(16.1461195054945, $a->getPrimaNeta());
        $this->assertEquals(19.98, $a->getPrimaTotal());
        $this->assertEquals(17.84196428571428, $a->getBaseImponible());
        $this->assertEquals(8.833333333333334, $a->getPrimaRiesgo());
    }
}