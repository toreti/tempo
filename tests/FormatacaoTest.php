<?php

namespace Tests;

use Toreti\Tempo\Data;

class FormatacaoTest extends \PHPUnit_Framework_TestCase
{
    public function testFormatoBR()
    {
        $dataExperada = date('d/m/Y');
        $hoje = Data::hoje()->formatoBR();
        $this->assertEquals($dataExperada, $hoje);
    }
}
