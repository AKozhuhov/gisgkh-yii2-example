<?php

namespace gisgkh\types\Services\CompletedWorksByPeriodType;

/**
 * Выполненная плановая работа/услуга
 */
class PlannedWork extends \gisgkh\types\Services\CompletedWorkType
{
    /**
     * Идентификатор работы/услуги перечня 
     * @var string $WorkPlanItemGUID
     */
    public $WorkPlanItemGUID;

    /**
     * Количество работ по плану
     * @var null $plannedCount
     */
    public $plannedCount;
}
