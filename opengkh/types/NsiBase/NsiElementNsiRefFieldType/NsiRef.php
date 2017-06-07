<?php

namespace gisgkh\types\NsiBase\NsiElementNsiRefFieldType;

/**
 * Ссылка на элемент внутреннего справочника.
 */
class NsiRef
{
    /**
     * Реестровый номер справочника.
     * @var null $NsiItemRegistryNumber
     */
    public $NsiItemRegistryNumber;

    /**
     * Ссылка на элемент справочника.
     * @var \gisgkh\types\NsiBase\nsiRef $Ref
     */
    public $Ref;
}
