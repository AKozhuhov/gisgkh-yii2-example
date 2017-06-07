<?php

namespace gisgkh\types\Services;

/**
 * Экспорт плана работ/услуг
 */
class exportWorkingPlanRequest extends \gisgkh\types\Base\BaseType
{
    /**
     * 
     * @var \gisgkh\types\Services\exportWorkingPlanRequest\work[] $work
     */
    public $work;

    /**
     * [READ ONLY] Версия элемента, начиная с которой поддерживается совместимость
     * @var string $version
     */
    public $version = "10.0.1.1";
}
