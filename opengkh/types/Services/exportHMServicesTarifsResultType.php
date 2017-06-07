<?php

namespace gisgkh\types\Services;

class exportHMServicesTarifsResultType extends \gisgkh\types\Services\HMServicesTarifsDocType
{
    /**
     * Идентификатор документа тарифа в ГИС ЖКХ 
     * @var string $ServicesTarifDocGUID
     */
    public $ServicesTarifDocGUID;

    /**
     * Дата создания документа в ГИС ЖКХ
     * @var \DateTime $CreationDate
     */
    public $CreationDate;
}
