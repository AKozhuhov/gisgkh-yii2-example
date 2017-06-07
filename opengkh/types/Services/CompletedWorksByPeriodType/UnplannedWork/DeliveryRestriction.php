<?php

namespace gisgkh\types\Services\CompletedWorksByPeriodType\UnplannedWork;

/**
 * По ограничениям поставки (tns:UnplannedWork/workType/Code=5)
 */
class DeliveryRestriction
{
    /**
     * Вид КУ (НСИ 3)
     * @var \gisgkh\types\NsiBase\nsiRef $MSType
     */
    public $MSType;

    /**
     * Поставщик коммунального ресурса
     * @var \gisgkh\types\OrganizationsRegistryBase\RegOrgType $OrganizationGUID
     */
    public $OrganizationGUID;

    /**
     * 
     * @var string $workType
     */
    public $workType;
}
