<?php

namespace gisgkh\types\Xmldsig;

class X509DataType
{
    /**
     * 
     * @var \gisgkh\types\Xmldsig\X509IssuerSerialType $X509IssuerSerial
     */
    public $X509IssuerSerial;

    /**
     * 
     * @var null $X509SKI
     */
    public $X509SKI;

    /**
     * 
     * @var string $X509SubjectName
     */
    public $X509SubjectName;

    /**
     * 
     * @var null $X509Certificate
     */
    public $X509Certificate;

    /**
     * 
     * @var null $X509CRL
     */
    public $X509CRL;
}
