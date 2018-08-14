<?php

namespace Toreti\Tempo;

class Feriado
{
    /**
     * @var Data
     */
    private $data;

    /**
     * @var string;
     */
    private $nome;

    /**
     * @param string $data
     * @param string $nome
     */
    public function __construct($data, $nome)
    {
        $this->data = $data;
        $this->nome = $nome;
    }

    /**
     * @return Data
     */
    public function data()
    {
        return $this->data;
    }

    /**
     * @return string
     */
    public function nome()
    {
        return $this->nome;
    }
}
