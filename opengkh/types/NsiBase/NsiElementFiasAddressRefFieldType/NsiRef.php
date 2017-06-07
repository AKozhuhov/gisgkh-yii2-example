<?php

namespace gisgkh\types\NsiBase\NsiElementFiasAddressRefFieldType;

/**
 * Ссылка на элемент справочника ФИАС.
 */
class NsiRef
{
    /**
     * Идентификационный код позиции в справочнике ФИАС.
     * @var string $Guid
     */
    public $Guid;

    /**
     * Глобально-уникальный идентификатор адресного объекта в справочнике ФИАС.
     * @var string $aoGuid
     */
    public $aoGuid;
}
