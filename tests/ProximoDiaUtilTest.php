<?php

namespace Tests;

use Toreti\Tempo\Data;

class ProximoDiaUtilTest extends \PHPUnit_Framework_TestCase
{
    public function testProximoDiaUtil()
    {
        $data = Data::criar('10/08/2018')->proximoDiaUtil();
        $this->assertEquals('13/08/2018', $data->formatoBR());
    }

    public function testProximoDiaUtilApos2Dias()
    {
        $data = Data::criar('10/08/2018')->proximoDiaUtil(2);
        $this->assertEquals('14/08/2018', $data->formatoBR());
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage A quantidade de dias deve ser um número inteiro maior que zero.
     */
    public function testQuantidadeZerada()
    {
        $data = Data::criar('10/08/2018');
        $data->proximoDiaUtil(0);
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage A quantidade de dias deve ser um número inteiro maior que zero.
     */
    public function testQuantidadeNegativa()
    {
        $data = Data::criar('10/08/2018');
        $data->proximoDiaUtil(-1);
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage A quantidade de dias deve ser um número inteiro maior que zero.
     */
    public function testQuantidadeBool()
    {
        $data = Data::criar('10/08/2018');
        $data->proximoDiaUtil(false);
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage A quantidade de dias deve ser um número inteiro maior que zero.
     */
    public function testQuantidadeString()
    {
        $data = Data::criar('10/08/2018');
        $data->proximoDiaUtil('');
    }
}
