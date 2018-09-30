[![Build Status](https://travis-ci.org/toreti/tempo.svg?branch=master)](https://travis-ci.org/toreti/tempo)
[![codecov](https://codecov.io/gh/toreti/tempo/branch/master/graph/badge.svg)](https://codecov.io/gh/toreti/tempo)

# Tempo

Extensão da classe DateTime para facilitar operações com data.

Exemplo de uso para verificar se a data é dia útil, feriado ou fim de semana:

```php
use Toreti\Tempo\Data;

$hoje = Data::hoje();

if ($hoje->diaUtil()) {
    die('Dia de trabalho duro');
}

if ($hoje->feriado() || $hoje->fimDeSemana()) {
    $proximoDiaUtil = $hoje->proximoDiaUtil();
    die('Dia de descanso, trabalho só no dia '.$proximoDiaUtil->formatoBR());
}
```