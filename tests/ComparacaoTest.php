<?php

namespace Tests;

use Toreti\Tempo\Data;

class ComparacaoTest extends \PHPUnit_Framework_TestCase
{
    public function testDatasDiferentes()
    {
        $data1 = Data::criar('10/08/2018');
        $data2 = Data::criar('11/08/2018');
        $this->assertFalse($data1->igual($data2));
        $this->assertTrue($data1->diferente($data2));
    }

    public function testDatasIguais()
    {
        $data1 = Data::criar('11/08/2018');
        $data2 = Data::criar('11/08/2018');
        $this->assertTrue($data1->igual($data2));
        $this->assertFalse($data1->diferente($data2));
    }

    public function testMaiorQue()
    {
        $data1 = Data::criar('10/08/2018');
        $data2 = Data::criar('11/08/2018');
        $this->assertFalse($data1->maiorQue($data1));
        $this->assertFalse($data1->maiorQue($data2));
        $this->assertTrue($data2->maiorQue($data1));
    }

    public function testMenorQue()
    {
        $data1 = Data::criar('10/08/2018');
        $data2 = Data::criar('11/08/2018');
        $this->assertFalse($data1->menorQue($data1));
        $this->assertTrue($data1->menorQue($data2));
        $this->assertFalse($data2->menorQue($data1));
    }
}
