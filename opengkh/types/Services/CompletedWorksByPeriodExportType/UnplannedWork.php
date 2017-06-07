<?php

namespace gisgkh\types\Services\CompletedWorksByPeriodExportType;

/**
 * Выполненная внеплановая работа/услуга
 */
class UnplannedWork extends \gisgkh\types\Services\CompletedWorkType
{
    /**
     * Аварийные работы (tns:UnplannedWork/workType/Code=3)
     * @var \gisgkh\types\Services\CompletedWorksByPeriodExportType\UnplannedWork\Accident $Accident
     */
    public $Accident;

    /**
     * По ограничениям поставки (tns:UnplannedWork/workType/Code=5)
     * @var \gisgkh\types\Services\CompletedWorksByPeriodExportType\UnplannedWork\DeliveryRestriction $DeliveryRestriction
     */
    public $DeliveryRestriction;

    /**
     * Комментарий
     * @var string $Comment
     */
    public $Comment;

    /**
     * Ссылка на работу (услугу) в справочнике видов работ и услуг для организации (НСИ 59)
     * @var \gisgkh\types\NsiBase\nsiRef $Work
     */
    public $Work;

    /**
     * Ссылка на вид работы (услуги) в справочнике видов работ и услуг (НСИ 56)
     * @var \gisgkh\types\NsiBase\nsiRef $workType
     */
    public $workType;
}
