<?php

namespace gisgkh\types\NsiCommon;

/**
 * Перечень общесистмных справочников с датой последнего изменения каждого из них.
 */
class exportNsiListResult extends \gisgkh\types\Base\BaseType
{
    /**
     * Перечень справочников с указанием даты последнего изменения каждого из них.
     * @var \gisgkh\types\NsiBase\NsiListType $NsiList
     */
    public $NsiList;

    /**
     * Описание ошибок контролей или бизнес-процесса
     * @var \gisgkh\types\Base\ErrorMessageType $ErrorMessage
     */
    public $ErrorMessage;

    /**
     * [READ ONLY] Версия элемента, начиная с которой поддерживается совместимость
     * @var string $version
     */
    public $version = "10.0.1.2";
}
