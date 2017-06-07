<?php

namespace gisgkh\types\Base;

/**
 * Базовый тип бизнес-сообщения с подписью
 */
class BaseType
{
    /**
     * 
     * @var \gisgkh\types\Xmldsig\SignatureType $Signature
     */
    public $Signature;

    /**
     * 
     * @var null $Id
     */
    public $Id;
}
