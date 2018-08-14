<?php

namespace Tests;

use Toreti\Tempo\Data;
use Toreti\Tempo\Feriados;

class FeriadoTest extends \PHPUnit_Framework_TestCase
{
    public function testFeriado()
    {
        $data = '25/12/2018';
        $feriado = Data::criar($data)->feriado();
        $this->assertTrue($feriado);
    }

    public function testNaoEFeriado()
    {
        $data = '24/12/2018';
        $feriado = Data::criar($data)->feriado();
        $this->assertFalse($feriado);
    }

    public function testPascoa()
    {
        $ano = 2018;
        $pascoa = Feriados::instancia()->pascoa($ano);
        $this->assertEquals('01/04/2018', $pascoa->data()->formatoBR());
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage O ano informado é inválido.
     */
    public function testPascoaComAnoInvalido()
    {
        Feriados::instancia()->pascoa(false);
    }
}
