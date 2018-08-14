<?php

namespace Tests;

use Toreti\Tempo\Data;

class DiaUtilEFimDeSemanaTest extends \PHPUnit_Framework_TestCase
{
    public function testDiaUtilVerdadeiro()
    {
        $data = '10/08/2018';
        $diaUtil = Data::criar($data)->diaUtil();
        $this->assertTrue($diaUtil);
    }

    public function testDiaUtilFalso()
    {
        $data = '11/08/2018';
        $diaUtil = Data::criar($data)->diaUtil();
        $this->assertFalse($diaUtil);
    }

    public function testFimDeSemanaVerdadeiro()
    {
        $data = '11/08/2018';
        $fimDeSemana = Data::criar($data)->fimDeSemana();
        $this->assertTrue($fimDeSemana);
    }

    public function testFimDeSemanaFalso()
    {
        $data = '10/08/2018';
        $fimDeSemana = Data::criar($data)->fimDeSemana();
        $this->assertFalse($fimDeSemana);
    }

    public function testDiaUtilNatal()
    {
        $natal = Data::criar('25/12/2018');
        $this->assertFalse($natal->diaUtil());
    }

    public function testDiaUtilPascoa()
    {
        $pascoa = Data::criar('01/04/2018');
        $this->assertFalse($pascoa->diaUtil());
    }
}
