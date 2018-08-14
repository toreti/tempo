<?php

namespace Tests;

use Toreti\Tempo\Data;

class CalculoTest extends \PHPUnit_Framework_TestCase
{
    public function testSomar1Dia()
    {
        $data = Data::criar('11/08/2018');
        $novaData = $data->somarDias();
        $this->assertEquals('12/08/2018', $novaData->formatoBR());
    }

    public function testSomar7Dias()
    {
        $data = Data::criar('11/08/2018');
        $novaData = $data->somarDias(7);
        $this->assertEquals('18/08/2018', $novaData->formatoBR());
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage A quantidade de dias deve ser um número inteiro maior que zero.
     */
    public function testSomar0Dias()
    {
        $data = Data::criar('11/08/2018');
        $data->somarDias(0);
    }

    public function testSubtrair1Dia()
    {
        $data = Data::criar('11/08/2018');
        $novaData = $data->subtrairDias();
        $this->assertEquals('10/08/2018', $novaData->formatoBR());
    }

    public function testSubtrair7Dias()
    {
        $data = Data::criar('11/08/2018');
        $proximoDia = $data->subtrairDias(7);
        $this->assertEquals('04/08/2018', $proximoDia->formatoBR());
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage A quantidade de dias deve ser um número inteiro maior que zero.
     */
    public function testSubtrair0Dias()
    {
        $data = Data::criar('11/08/2018');
        $data->subtrairDias(0);
    }
}
