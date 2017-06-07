<?php

namespace gisgkh\types\NsiCommon;

/**
 * Запрос получения перечня  общесистмного справочников.
 */
class exportNsiListRequest extends \gisgkh\types\Base\BaseType
{
    /**
     * Группа справочника: NSI - (по умолчанию) общесистемный  NSIRAO - ОЖФ
     * @var string $ListGroup
     */
    public $ListGroup;

    /**
     * [READ ONLY] Версия элемента, начиная с которой поддерживается совместимость
     * @var string $version
     */
    public $version = "10.0.1.2";
}
