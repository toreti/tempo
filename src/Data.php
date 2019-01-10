<?php

namespace Toreti\Tempo;

use DateInterval;
use DateTime;
use Exception;

class Data
{
    const DATA_FORMATO_BR = 'd/m/Y';

    /**
     * @var DateTime
     */
    private $dateTime;

    /**
     * @param DateTime $dateTime
     */
    public function __construct(DateTime $dateTime)
    {
        $this->dateTime = $dateTime;
    }

    /**
     * @return Data
     */
    public static function hoje()
    {
        return new self(new DateTime());
    }

    /**
     * @param string $data
     * @param string $formato
     * @return Data
     * @throws \Exception
     */
    public static function criar($data, $formato = self::DATA_FORMATO_BR)
    {
        $dateTime = DateTime::createFromFormat($formato, $data);
        if (!$dateTime) {
            throw new Exception('Data inválida.');
        }
        $dateTime->setTime(0, 0, 0);
        return new self($dateTime);
    }

    /**
     * return bool
     */
    public function fimDeSemana()
    {
        return !$this->diaUtil();
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function diaUtil()
    {
        if ($this->feriado()) {
            return false;
        }
        return (int)$this->dateTime->format('N') < 6;
    }

    /**
     * @param Data $data
     * @return Diferenca
     */
    public function diferenca(Data $data)
    {
        return new Diferenca($this->dateTime()->diff($data->dateTime()));
    }

    /**
     * @param Data $data
     * @return int
     */
    public function diferencaEmDias(Data $data)
    {
        return $this->diferenca($data)->emDias();
    }

    /**
     * @param Data $desdeAData
     * @return int
     */
    public function diasPassados(Data $desdeAData)
    {
        return $this->diferenca($desdeAData)->diasPassados();
    }

    /**
     * @param Data $ateAData
     * @return int
     */
    public function diasRestantes(Data $ateAData)
    {
        return $this->diferenca($ateAData)->diasRestantes();
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function feriado()
    {
        return Feriados::instancia()->possuiFeriadoNaData($this);
    }

    /**
     * @param int $aposDiasUteis
     * @return Data
     * @throws Exception
     */
    public function proximoDiaUtil($aposDiasUteis = 1)
    {
        $this->validarQuantidadeDeDias($aposDiasUteis);
        $data = clone $this;
        $diasUteisPassados = 0;
        while ($diasUteisPassados < $aposDiasUteis) {
            $data = $data->somarDias();
            if ($data->diaUtil()) {
                $diasUteisPassados++;
            }
        }
        return $data;
    }

    /**
     * @param int $dias
     * @throws Exception
     */
    private function validarQuantidadeDeDias($dias)
    {
        if (!is_int($dias) || $dias < 1) {
            throw new Exception('A quantidade de dias deve ser um número inteiro maior que zero.');
        }
    }

    /**
     * @param int $quantidadeDeDias
     * @return Data
     * @throws Exception
     */
    public function somarDias($quantidadeDeDias = 1)
    {
        $this->validarQuantidadeDeDias($quantidadeDeDias);
        $dateTime = clone $this->dateTime;
        $dateTime = $dateTime->add(new DateInterval("P{$quantidadeDeDias}D"));
        return new self($dateTime);
    }

    /**
     * @param Data $data
     * @return bool
     */
    public function diferente(Data $data)
    {
        return !$this->igual($data);
    }

    /**
     * @param Data $data
     * @return bool
     */
    public function igual(Data $data)
    {
        return $this->formatoBR() === $data->formatoBR();
    }

    /**
     * @return string
     */
    public function formatoBR()
    {
        return $this->formato(self::DATA_FORMATO_BR);
    }

    /**
     * @param string $formato
     * @return string
     */
    public function formato($formato = self::DATA_FORMATO_BR)
    {
        return $this->dateTime->format($formato);
    }

    /**
     * @param Data $data
     * @return bool
     */
    public function maiorQue(Data $data)
    {
        return $this->dateTime > $data->dateTime();
    }

    /**
     * @return DateTime
     */
    public function dateTime()
    {
        return $this->dateTime;
    }

    /**
     * @param Data $data
     * @return bool
     */
    public function menorQue(Data $data)
    {
        return $this->dateTime < $data->dateTime();
    }

    /**
     * @param int $quantidadeDeDias
     * @return Data
     * @throws Exception
     */
    public function subtrairDias($quantidadeDeDias = 1)
    {
        $this->validarQuantidadeDeDias($quantidadeDeDias);
        $dateTime = clone $this->dateTime;
        $dateTime = $dateTime->sub(new DateInterval("P{$quantidadeDeDias}D"));
        return new self($dateTime);
    }
}
