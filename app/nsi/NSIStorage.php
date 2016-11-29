<?php

namespace app\nsi;

use yii\base\Component;

use opengkh\gis\interfaces\nsi\DynamicReference\IDynamicReferenceManager;

/**
 * Класс для управления хранилищем справочников ИС
 * Реализует интерфейс OpenGKH IDynamicReferenceManager
 */
class NSIStorage extends Component implements IDynamicReferenceManager
{
    /**
     * @var NSIReference[] $references
     */
    public $references = [];

    /**
     * @param int $registryNumber
     * @return NSIReference
     */
    public function getReferenceByRegistryNumber($registryNumber)
    {
        return @$this->references[$registryNumber];
    }

    /**
     * @param int $registryNumber
     * @param string $name
     * @return NSIReference
     */
    public function createReference($registryNumber, $name)
    {
        $reference = new NSIReference();
        $reference->registryNumber = $registryNumber;
        $reference->title = $name;
        $this->references[$registryNumber] = $reference;
        return $reference;
    }

}