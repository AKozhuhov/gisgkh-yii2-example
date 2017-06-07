<?php

namespace gisgkh\types\NsiBase;

/**
 * Составной тип. Наименование и значение поля "Вложение"
 */
class NsiElementAttachmentFieldType extends \gisgkh\types\NsiBase\NsiElementFieldType
{
    /**
     * Документ
     * @var \gisgkh\types\Base\AttachmentType $Document
     */
    public $Document;
}
