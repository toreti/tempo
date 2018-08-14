# Tempo

Extensão da classe DateTime para facilitar operações com data.

Exemplo de uso:

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