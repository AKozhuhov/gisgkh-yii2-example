<?php

namespace gisgkh\types\Services;

/**
 * Документ. Тарифы ЖКУ
 */
class HMServicesTarifsDocType extends \gisgkh\types\Base\DocumentPortalType
{
    /**
     * Дата начала действия тарифа
     * @var \DateTime $EffectivePeriodFrom
     */
    public $EffectivePeriodFrom;

    /**
     * Дата окончания действия тарифа
     * @var \DateTime $EffectivePeriodTo
     */
    public $EffectivePeriodTo;

    /**
     * Отмяеняет прежний документ (ссылка на документ)
     * @var string $CancelServicesTarifDocGUID
     */
    public $CancelServicesTarifDocGUID;

    /**
     * [READ ONLY] Документ всегда приходит в статусе "Опубликован" и публикуется на Портале. Экспортируются только опубликованные документы.
     * @var boolean $IsPublished
     */
    public $IsPublished = true;

    /**
     * Субъект РФ
     * @var \gisgkh\types\Base\RegionType $Region
     */
    public $Region;

    /**
     * Вид ЖКУ = "Коммунальные услуги" Доступно организациям с полномочием: - Орган государственной власти субъекта РФ в сфере ЖКХ - Орган местного самоуправления в сфере ЖКХ  - Управляющая организация 
     * @var \gisgkh\types\Services\HMServicesTarifsDocType\GKU $GKU
     */
    public $GKU;

    /**
     *  Вид ЖКУ = "Коммунальные ресурсы" Доступно организациям с полномочием: - Орган исполнительной власти субъекта РФ в области регулирования тарифов - Федеральная антимонопольная служба (Федеральная служба по тарифам) - Ресурсоснабжающая организация 
     * @var \gisgkh\types\Services\HMServicesTarifsDocType\KU $KU
     */
    public $KU;

    /**
     *  Вид ЖКУ = "Капитальный ремонт" Доступно организациям с полномочиями: - Орган государственной власти субъекта РФ в сфере ЖКХ
     * @var boolean $IsOverhaul
     */
    public $IsOverhaul;

    /**
     * Муниципальные образования
     * @var \gisgkh\types\Base\OKTMORefType[] $OKTMOs
     */
    public $OKTMOs;

    /**
     * Вид жилищно-коммунальной услуги (S)ocial hiring - Социальный наем (R)epair and maintenance - Содержание и ремонт жилого помещения 
     * @var null $ServiceType
     */
    public $ServiceType;
}
