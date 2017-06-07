<?php

namespace gisgkh\types\Xmldsig;

class SignedInfoType
{
    /**
     * 
     * @var \gisgkh\types\Xmldsig\CanonicalizationMethodType $CanonicalizationMethod
     */
    public $CanonicalizationMethod;

    /**
     * 
     * @var \gisgkh\types\Xmldsig\SignatureMethodType $SignatureMethod
     */
    public $SignatureMethod;

    /**
     * 
     * @var \gisgkh\types\Xmldsig\ReferenceType[] $Reference
     */
    public $Reference;

    /**
     * 
     * @var null $Id
     */
    public $Id;
}
