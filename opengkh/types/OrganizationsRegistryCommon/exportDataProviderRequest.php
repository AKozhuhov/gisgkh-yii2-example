<?php

namespace gisgkh\types\OrganizationsRegistryCommon;

/**
 * В качестве поискового параметра используется Идентификатор ИС из RequestHeader
 */
class exportDataProviderRequest extends \gisgkh\types\Base\BaseType
{
    /**
     * [READ ONLY] Выгрузить только активных поставщиков данных
     * @var boolean $IsActual
     */
    public $IsActual = true;

    /**
     * [READ ONLY] Версия элемента, начиная с которой поддерживается совместимость
     * @var string $version
     */
    public $version = "10.0.2.1";
}
