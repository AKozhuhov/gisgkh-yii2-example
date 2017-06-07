<?php

namespace gisgkh\types\Base;

/**
 * Базовый тип документа ОЧ
 */
class DocumentPortalType
{
    /**
     * Наименование документа
     * @var string $Name
     */
    public $Name;

    /**
     * Номер документа
     * @var string $DocNumber
     */
    public $DocNumber;

    /**
     * Дата принятия документа органом власти
     * @var \DateTime $ApproveDate
     */
    public $ApproveDate;

    /**
     * Вложение
     * @var \gisgkh\types\Base\AttachmentType $Attachment
     */
    public $Attachment;
}
