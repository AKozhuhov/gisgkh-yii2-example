<?php

namespace gisgkh\types\Base;

/**
 * Вложение
 */
class AttachmentType
{
    /**
     * Наименование вложения
     * @var string $Name
     */
    public $Name;

    /**
     * Описание вложения
     * @var string $Description
     */
    public $Description;

    /**
     * Вложение
     * @var \gisgkh\types\Base\AttachmentType\Attachment $Attachment
     */
    public $Attachment;

    /**
     * Хэш-тег вложения по алгоритму ГОСТ в binhex
     * @var string $AttachmentHASH
     */
    public $AttachmentHASH;
}
