<?php

namespace Tests;

use Toreti\Tempo\Data;

class DiferencaTest extends \PHPUnit_Framework_TestCase
{
    public function testDiferencaEmDias()
    {
        $data1 = Data::criar('01/01/2018');
        $data2 = Data::criar('30/09/2018');
        $diferencaEmDias = $data1->diferencaEmDias($data2);
        $this->assertEquals(272, $diferencaEmDias);
    }

    public function testDiferencaEmDiasZero()
    {
        $data1 = Data::criar('01/01/2018');
        $data2 = Data::criar('01/01/2018');
        $diferencaEmDias = $data1->diferencaEmDias($data2);
        $this->assertEquals(0, $diferencaEmDias);
    }

    public function testDiasPassados()
    {
        $data1 = Data::criar('30/09/2018');
        $data2 = Data::criar('01/01/2018');
        $diasPassados = $data1->diasPassados($data2);
        $this->assertEquals(272, $diasPassados);
    }

    public function testDiasPassadosZero()
    {
        $data1 = Data::criar('01/01/2018');
        $data2 = Data::criar('01/01/2018');
        $diasPassados = $data1->diasPassados($data2);
        $this->assertEquals(0, $diasPassados);
    }

    public function testDiasPassadosInvertido()
    {
        $data1 = Data::criar('01/01/2018');
        $data2 = Data::criar('30/09/2018');
        $diasPassados = $data1->diasPassados($data2);
        $this->assertEquals(-272, $diasPassados);
    }

    public function testDiasRestantes()
    {
        $data1 = Data::criar('30/09/2018');
        $data2 = Data::criar('01/01/2018');
        $diasRestantes = $data1->diasRestantes($data2);
        $this->assertEquals(-272, $diasRestantes);
    }

    public function testDiasRestantesZero()
    {
        $data1 = Data::criar('01/01/2018');
        $data2 = Data::criar('01/01/2018');
        $diasRestantes = $data1->diasRestantes($data2);
        $this->assertEquals(0, $diasRestantes);
    }

    public function testDiasRestantesInvertido()
    {
        $data1 = Data::criar('01/01/2018');
        $data2 = Data::criar('30/09/2018');
        $diferencaEmDias = $data1->diasRestantes($data2);
        $this->assertEquals(272, $diferencaEmDias);
    }
}
