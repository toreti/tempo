<?php

namespace Toreti\Tempo;

use Exception;

class Feriados
{
    /**
     * @var array
     */
    private $feriadosNacionais;

    /**
     * @var array
     */
    private $feriadosMoveis;

    /**
     * @var array
     */
    private $feriadosMunicipais;

    private function __construct()
    {
        $this->feriadosNacionais();
        $this->feriadosMunicipais = [];
    }

    /**
     * @return Feriados
     */
    public static function instancia()
    {
        static $instance = null;
        if (null === $instance) {
            $instance = new static();
        }
        return $instance;
    }

    /**
     * @param string $data
     * @param string $nome
     * @return $this
     */
    public function adicionarFeriadoMunicipal($data, $nome)
    {
        $this->feriadosMunicipais[$data] = $nome;
        return $this;
    }

    /**
     * @param Data $data
     * @return bool
     * @throws Exception
     */
    public function possuiFeriadoNaData(Data $data)
    {
        $dataDateTime = $data->dateTime();
        $feriados = $this->feriados($dataDateTime->format('Y'));
        $diaEMes = $dataDateTime->format('d/m');
        return array_key_exists($diaEMes, $feriados);
    }

    /**
     * @param $anoComQuatroDigitos
     * @return array
     * @throws Exception
     */
    private function feriados($anoComQuatroDigitos)
    {
        $this->feriadosMoveis($anoComQuatroDigitos);
        return array_merge($this->feriadosNacionais, $this->feriadosMoveis, $this->feriadosMunicipais);
    }

    /**
     * @param int $anoComQuatroDigitos
     * @return Data
     * @throws Exception
     */
    public function pascoa($anoComQuatroDigitos)
    {
        $dataValida = checkdate(1, 1, $anoComQuatroDigitos);
        if (!$dataValida) {
            throw new Exception('O ano informado é inválido.');
        }
        return Data::criar(date(Data::DATA_FORMATO_BR, easter_date($anoComQuatroDigitos)));
    }

    private function feriadosNacionais()
    {
        $this->feriadosNacionais = [
            '01/01' => 'Confraternização Universal',
            '21/04' => 'Tiradentes',
            '01/05' => 'Dia do Trabalhador',
            '07/09' => 'Dia da Pátria',
            '12/10' => 'Nossa Senhora Aparecida',
            '02/11' => 'Finados',
            '15/11' => 'Proclamação da República',
            '25/12' => 'Natal',
        ];
    }

    /**
     * @param int $anoComQuatroDigitos
     * @throws Exception
     */
    private function feriadosMoveis($anoComQuatroDigitos)
    {
        $pascoa = $this->pascoa($anoComQuatroDigitos);
        $sextaFeiraSanta = $pascoa->subtrairDias(2);
        $corpusChristi = $pascoa->somarDias(60);
        $this->feriadosMoveis = [
            $sextaFeiraSanta->formato('d/m') => 'Sexta Feira Santa',
            $pascoa->formato('d/m') => 'Páscoa',
            $corpusChristi->formato('d/m') => 'Corpus Christi',
        ];
    }
}
