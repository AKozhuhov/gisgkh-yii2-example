<?php

namespace gisgkh\types\NsiBase;

/**
 * Перечень справочников с датой последнего изменения каждого из них.
 */
class NsiListType
{
    /**
     * Дата и время формирования перечня справочников.
     * @var \DateTime $Created
     */
    public $Created;

    /**
     * Наименование, дата и время последнего изменения справочника.
     * @var \gisgkh\types\NsiBase\NsiItemInfoType[] $NsiItemInfo
     */
    public $NsiItemInfo;

    /**
     * Группа справочника: NSI - (по умолчанию) общесистемный  NSIRAO - ОЖФ
     * @var string $ListGroup
     */
    public $ListGroup;
}
