<?php

namespace gisgkh\types\Services\CompletedWorksByPeriodType;

/**
 * Ссылка на ранее загруженный акт
 */
class ExistedAct
{
    /**
     * Идентификатор акта
     * @var string $ActGUID
     */
    public $ActGUID;

    /**
     * Транспортный идентификатор
     * @var string $TransportGUID
     */
    public $TransportGUID;
}
