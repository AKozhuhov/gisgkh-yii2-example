<?php

namespace gisgkh\types\Services;

/**
 * Импорт сведений о выполненных работах и услугах
 */
class importCompletedWorksRequest extends \gisgkh\types\Base\BaseType
{
    /**
     * Перечень выполненных работ за отчетный период
     * @var \gisgkh\types\Services\CompletedWorksByPeriodType $CompletedWorksByPeriod
     */
    public $CompletedWorksByPeriod;

    /**
     * [READ ONLY] Версия элемента, начиная с которой поддерживается совместимость
     * @var string $version
     */
    public $version = "10.0.1.1";
}
