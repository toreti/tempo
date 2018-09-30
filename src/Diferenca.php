<?php

namespace Toreti\Tempo;

use DateInterval;

class Diferenca
{
    /**
     * @var DateInterval
     */
    private $dateInterval;

    /**
     * @param DateInterval $dateInterval
     */
    public function __construct(DateInterval $dateInterval)
    {
        $this->dateInterval = $dateInterval;
    }

    /**
     * @return int
     */
    public function emDias()
    {
        return $this->dateInterval->days;
    }

    /**
     * @return int
     */
    public function diasPassados()
    {
        return $this->dateInterval->invert ? $this->emDias() : -$this->emDias();
    }

    /**
     * @return int
     */
    public function diasRestantes()
    {
        return -$this->diasPassados();
    }
}
