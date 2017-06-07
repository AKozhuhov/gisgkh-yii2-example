<?php

namespace gisgkh\types\Xmldsig;

class SignatureType
{
    /**
     * 
     * @var \gisgkh\types\Xmldsig\SignedInfoType $SignedInfo
     */
    public $SignedInfo;

    /**
     * 
     * @var \gisgkh\types\Xmldsig\SignatureValueType $SignatureValue
     */
    public $SignatureValue;

    /**
     * 
     * @var \gisgkh\types\Xmldsig\KeyInfoType $KeyInfo
     */
    public $KeyInfo;

    /**
     * 
     * @var \gisgkh\types\Xmldsig\ObjectType[] $Object
     */
    public $Object;

    /**
     * 
     * @var null $Id
     */
    public $Id;
}
