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
        $this->assertEquals('21/04/2019', Feriados::instancia()->pascoa(2019)->formatoBR());
        $this->assertEquals('12/04/2020', Feriados::instancia()->pascoa(2020)->formatoBR());
        $this->assertEquals('04/04/2021', Feriados::instancia()->pascoa(2021)->formatoBR());
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage O ano informado é inválido.
     */
    public function testPascoaComAnoInvalido()
    {
        Feriados::instancia()->pascoa(false);
    }

    public function testSextaSanta()
    {
        $this->assertTrue(Data::criar('19/04/2019')->feriado());
        $this->assertTrue(Data::criar('10/04/2020')->feriado());
        $this->assertTrue(Data::criar('02/04/2021')->feriado());
    }

    public function testCorpus()
    {
        $this->assertTrue(Data::criar('20/06/2019')->feriado());
        $this->assertTrue(Data::criar('11/06/2020')->feriado());
        $this->assertTrue(Data::criar('03/06/2021')->feriado());
    }
}
