<?php

namespace gisgkh\types\NsiCommon;

/**
 * Запрос на получение данных общесистмного справочника.
 */
class exportNsiItemRequest extends \gisgkh\types\Base\BaseType
{
    /**
     * Реестровый номер справочника.
     * @var null $RegistryNumber
     */
    public $RegistryNumber;

    /**
     * Группа справочника: NSI - (по умолчанию) общесистемный  NSIRAO - ОЖФ
     * @var string $ListGroup
     */
    public $ListGroup;

    /**
     * Дата и время, измененные после которой элементы справочника должны быть возвращены в ответе. Если не указана, возвращаются все элементы справочника.
     * @var \DateTime $ModifiedAfter
     */
    public $ModifiedAfter;

    /**
     * [READ ONLY] Версия элемента, начиная с которой поддерживается совместимость
     * @var string $version
     */
    public $version = "10.0.1.2";
}
