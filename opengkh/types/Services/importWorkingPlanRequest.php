<?php

namespace gisgkh\types\Services;

/**
 * Импорт актуальных планов по перечню работ/услуг
 */
class importWorkingPlanRequest extends \gisgkh\types\Base\BaseType
{
    /**
     * Актуальный план по перечню работ/услуг
     * @var \gisgkh\types\Services\WorkingPlanType[] $WorkingPlan
     */
    public $WorkingPlan;

    /**
     * [READ ONLY] Версия элемента, начиная с которой поддерживается совместимость
     * @var string $version
     */
    public $version = "10.0.1.1";
}
