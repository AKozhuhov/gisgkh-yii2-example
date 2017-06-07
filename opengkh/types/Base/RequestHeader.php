<?php

namespace gisgkh\types\Base;

/**
 * Заголовок запроса
 */
class RequestHeader extends \gisgkh\types\Base\HeaderType
{
    /**
     * Идентификатор поставщика данных
     * @var string $SenderID
     */
    public $SenderID;

    /**
     * Идентификатор зарегистрированной организации
     * @var string $orgPPAGUID
     */
    public $orgPPAGUID;

    /**
     * [READ ONLY] Используется подпись Оператора ИС
     * @var boolean $IsOperatorSignature
     */
    public $IsOperatorSignature = true;
}
