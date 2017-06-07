<?php

namespace gisgkh\types\NsiBase\NsiElementNsiFieldType;

/**
 * Ссылка на справочник.
 */
class NsiRef
{
    /**
     * Реестровый номер справочника.
     * @var null $NsiItemRegistryNumber
     */
    public $NsiItemRegistryNumber;

    /**
     * Группа справочника: NSI - (по умолчанию) общесистемный  NSIRAO - ОЖФ
     * @var string $ListGroup
     */
    public $ListGroup;
}
