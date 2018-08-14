<?php

namespace Tests;

use Exception;
use Toreti\Tempo\Data;

class CriacaoTest extends \PHPUnit_Framework_TestCase
{
    public function testCriarComDataValida()
    {
        $data = '11/08/2018';
        $this->assertEquals($data, Data::criar($data)->formatoBR());
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Data inválida.
     */
    public function testCriarComDataInvalida()
    {
        $data = false;
        Data::criar($data);
    }
}
