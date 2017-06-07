<?php

namespace gisgkh\types\NsiBase;

/**
 * Данные справочника.
 */
class NsiItemType
{
    /**
     * Реестровый номер справочника.
     * @var null $NsiItemRegistryNumber
     */
    public $NsiItemRegistryNumber;

    /**
     * Дата и время формирования данных справочника.
     * @var \DateTime $Created
     */
    public $Created;

    /**
     * Элемент справочника верхнего уровня.
     * @var \gisgkh\types\NsiBase\NsiElementType[] $NsiElement
     */
    public $NsiElement;
}
