<?php

namespace gisgkh\types\NsiCommon;

/**
 * Возврат данных  общесистмного справочника.
 */
class exportNsiPagingItemResult extends \gisgkh\types\Base\BaseType
{
    /**
     * Данные справочника.
     * @var \gisgkh\types\NsiCommon\exportNsiPagingItemResult\NsiItem $NsiItem
     */
    public $NsiItem;

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
