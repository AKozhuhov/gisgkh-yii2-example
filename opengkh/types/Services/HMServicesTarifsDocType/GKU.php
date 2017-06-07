<?php

namespace gisgkh\types\Services\HMServicesTarifsDocType;

/**
 * Вид ЖКУ = "Коммунальные услуги"
 * Доступно организациям с полномочием:
 * - Орган государственной власти субъекта РФ в сфере ЖКХ
 * - Орган местного самоуправления в сфере ЖКХ 
 * - Управляющая организация
 * 
 */
class GKU
{
    /**
     * Вид коммунальной услуги (НСИ №3)
     * @var \gisgkh\types\NsiBase\nsiRef[] $MServiceType
     */
    public $MServiceType;

    /**
     * Муниципальное образование
     * @var \gisgkh\types\Base\OKTMORefType $Municipalities
     */
    public $Municipalities;

    /**
     * Идентификатор РСО
     * @var \gisgkh\types\OrganizationsRegistryBase\RegOrgVersionType[] $RSOOrganizationGUID
     */
    public $RSOOrganizationGUID;

    /**
     * Система коммунальной инфраструктуры (СКИ)
     * @var \gisgkh\types\Services\HMServicesTarifsDocType\GKU\SKI[] $SKI
     */
    public $SKI;
}
