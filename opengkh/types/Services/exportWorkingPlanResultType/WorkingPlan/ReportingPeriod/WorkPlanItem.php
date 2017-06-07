<?php

namespace gisgkh\types\Services\exportWorkingPlanResultType\WorkingPlan\ReportingPeriod;

/**
 * План по работе/услуге
 */
class WorkPlanItem
{
    /**
     * Идентификатор работы/услуги перечня 
     * @var string $WorkPlanItemGUID
     */
    public $WorkPlanItemGUID;

    /**
     * Дата модификации объекта
     * @var \DateTime $ModificationDate
     */
    public $ModificationDate;

    /**
     * Ссылка на работу (услугу) в справочнике видов работ и услуг для организации (НСИ 59)
     * @var \gisgkh\types\NsiBase\nsiRef $WorkGUID
     */
    public $WorkGUID;

    /**
     * Ссылка на вид работы (услуги) в справочнике видов работ и услуг (НСИ 56)
     * @var \gisgkh\types\NsiBase\nsiRef $workTypeGUID
     */
    public $workTypeGUID;

    /**
     * Порядковый номер строки в перечне
     * @var null $sortIndex
     */
    public $sortIndex;

    /**
     * Код ОКЕИ
     * @var string $OKEI
     */
    public $OKEI;

    /**
     * Даты начала работ по плану
     * @var \DateTime[] $WorkDate
     */
    public $WorkDate;

    /**
     * Количество работ
     * @var null $WorkCount
     */
    public $WorkCount;
}
