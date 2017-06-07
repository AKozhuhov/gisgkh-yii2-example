<?php

namespace gisgkh\types\Base;

/**
 * Элемент Fault (для параметра Fault в операции)
 */
class Fault
{
    /**
     * 
     * @var string $ErrorCode
     */
    public $ErrorCode;

    /**
     * 
     * @var string $ErrorMessage
     */
    public $ErrorMessage;

    /**
     * 
     * @var string $StackTrace
     */
    public $StackTrace;
}
