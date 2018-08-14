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

    /**
     * @var Feriado
     */
    private $pascoa;

    private function __construct()
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
        $this->feriadosMoveis = [];
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
        $this->pascoa = $this->pascoa($anoComQuatroDigitos);
        $this->feriadosMoveis = [
            $this->pascoa->data()->dateTime()->format('d/m') => $this->pascoa->nome(),
        ];
        return array_merge($this->feriadosNacionais, $this->feriadosMoveis, $this->feriadosMunicipais);
    }

    /**
     * @param int $anoComQuatroDigitos
     * @return Feriado
     * @throws Exception
     */
    public function pascoa($anoComQuatroDigitos)
    {
        $dataValida = checkdate(1, 1, $anoComQuatroDigitos);
        if (!$dataValida) {
            throw new Exception('O ano informado é inválido.');
        }
        $data = Data::criar(date(Data::DATA_FORMATO_BR, easter_date($anoComQuatroDigitos)));
        return new Feriado($data, 'Páscoa');
    }
}
