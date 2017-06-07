<?php

namespace gisgkh\types\OrganizationsRegistryBase;

/**
 * Индивидуальный предприниматель
 */
class EntpsType
{
    /**
     * Фамилия
     * @var string $Surname
     */
    public $Surname;

    /**
     * Имя
     * @var string $FirstName
     */
    public $FirstName;

    /**
     * Отчество
     * @var string $Patronymic
     */
    public $Patronymic;

    /**
     * Пол (M- мужской, F-женский)
     * @var string $Sex
     */
    public $Sex;

    /**
     * ОГРН
     * @var string $OGRNIP
     */
    public $OGRNIP;

    /**
     * Дата государственной регистрации
     * @var \DateTime $StateRegistrationDate
     */
    public $StateRegistrationDate;

    /**
     * ИНН
     * @var string $INN
     */
    public $INN;
}
