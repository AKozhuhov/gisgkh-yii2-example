<?php

namespace gisgkh\types\Services;

/**
 * Экспорт тарифов ЖКУ
 */
class exportHMServicesTarifsRequest extends \gisgkh\types\Base\BaseType
{
    /**
     * Вид жилищно-коммунальной услуги (M)unicipal - Коммунальные услуги (O)verhaul - Капитальный ремонт (S)ocial hiring - Социальный наем (R)epair and maintenance - Содержание и ремонт жилого помещения (C)ommunal resourses - коммунальные ресурсы 
     * @var null $ServiceType
     */
    public $ServiceType;

    /**
     * Муниципальные образования
     * @var \gisgkh\types\Base\OKTMORefType[] $Municipalities
     */
    public $Municipalities;

    /**
     * Субъект РФ
     * @var \gisgkh\types\Base\RegionType $Region
     */
    public $Region;

    /**
     * Дата окончания действия тарифа
     * @var \DateTime $EffectivePeriodTo
     */
    public $EffectivePeriodTo;

    /**
     * Дата начала действия тарифа
     * @var \DateTime $EffectivePeriodFrom
     */
    public $EffectivePeriodFrom;

    /**
     * [READ ONLY] Экспортируются только опубликованные документы.
     * @var boolean $IsPublished
     */
    public $IsPublished = true;

    /**
     * [READ ONLY] Версия элемента, начиная с которой поддерживается совместимость
     * @var string $version
     */
    public $version = "10.0.1.1";
}
