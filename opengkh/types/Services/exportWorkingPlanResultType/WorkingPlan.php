<?php

namespace gisgkh\types\Services\exportWorkingPlanResultType;

/**
 * План работ/услуг
 */
class WorkingPlan
{
    /**
     * Идентификатор перечня работ/услуг
     * @var string $WorkListGUID
     */
    public $WorkListGUID;

    /**
     * Год в рамках периода перечня
     * @var null $Year
     */
    public $Year;

    /**
     * Глобальный уникальный идентификатор дома по ФИАС
     * @var string $FIASHouseGuid
     */
    public $FIASHouseGuid;

    /**
     * 
     * @var \gisgkh\types\Services\exportWorkingPlanResultType\WorkingPlan\ReportingPeriod[] $ReportingPeriod
     */
    public $ReportingPeriod;
}
