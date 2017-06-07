<?php

namespace gisgkh\types\NsiCommon\getStateResult;

class NsiPagingItem extends \gisgkh\types\NsiBase\NsiItemType
{
    /**
     * Количество записей в справочнике
     * @var null $TotalItemsCount
     */
    public $TotalItemsCount;

    /**
     * Количество страниц
     * @var null $TotalPages
     */
    public $TotalPages;

    /**
     * Номер текущей страницы
     * @var  $CurrentPage
     */
    public $CurrentPage;
}
