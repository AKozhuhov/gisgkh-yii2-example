<?php

namespace gisgkh\types\Xmldsig;

class KeyInfoType
{
    /**
     * 
     * @var string $KeyName
     */
    public $KeyName;

    /**
     * 
     * @var \gisgkh\types\Xmldsig\KeyValueType $KeyValue
     */
    public $KeyValue;

    /**
     * 
     * @var \gisgkh\types\Xmldsig\RetrievalMethodType $RetrievalMethod
     */
    public $RetrievalMethod;

    /**
     * 
     * @var \gisgkh\types\Xmldsig\X509DataType $X509Data
     */
    public $X509Data;

    /**
     * 
     * @var \gisgkh\types\Xmldsig\PGPDataType $PGPData
     */
    public $PGPData;

    /**
     * 
     * @var \gisgkh\types\Xmldsig\SPKIDataType $SPKIData
     */
    public $SPKIData;

    /**
     * 
     * @var string $MgmtData
     */
    public $MgmtData;

    /**
     * 
     * @var null $Id
     */
    public $Id;
}
