<?php

namespace Tests;

use Toreti\Tempo\Data;
use Toreti\Tempo\Feriados;

class FeriadoMunicipalTest extends \PHPUnit_Framework_TestCase
{
    public function testFeriadosMunicipais()
    {
        $feriados = Feriados::instancia()
            ->adicionarFeriadoMunicipal('01/06', 'Santos Reis e fundação da cidade de Criciúma')
            ->adicionarFeriadoMunicipal('31/05', 'Corpus Christi')
            ->adicionarFeriadoMunicipal('04/12', 'Santa Bárbara, Padroeira dos Mineiros');

        $this->assertTrue($feriados->possuiFeriadoNaData(Data::criar('01/06/2018')));
        $this->assertTrue($feriados->possuiFeriadoNaData(Data::criar('31/05/2018')));
        $this->assertTrue($feriados->possuiFeriadoNaData(Data::criar('04/12/2018')));

    }

    public function testFeriadosMunicipaisUtilizandoSingleton()
    {
        Feriados::instancia()
            ->adicionarFeriadoMunicipal('01/06', 'Santos Reis e fundação da cidade de Criciúma')
            ->adicionarFeriadoMunicipal('31/05', 'Corpus Christi')
            ->adicionarFeriadoMunicipal('04/12', 'Santa Bárbara, Padroeira dos Mineiros');

        $this->assertFalse(Data::criar('01/06/2018')->diaUtil());
        $this->assertTrue(Data::criar('01/06/2018')->feriado());
    }
}
