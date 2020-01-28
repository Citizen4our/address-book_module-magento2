<?php

namespace Customer\SettingsAddressBook\Plugin;

use Customer\AddressBook\Model\AddressBook;
use Customer\SettingsAddressBook\Helper\DataSettings;

class OrderNamePlugin
{
    const FIRST_NAME_LAST_NAME = 1;

    const LAST_NAME_FIRST_NAME = 2;

    /**
     * @var DataSettings
     */
    private $dataSettings;

    /**
     * OrderNamePlugin constructor.
     * @param DataSettings $dataSettings
     */
    public function __construct(
        DataSettings $dataSettings
    )
    {
        $this->dataSettings = $dataSettings;
    }

    /**
     * the substitution of the result of the method depending on the settings
     * @param AddressBook $addressBook
     *
     * @param $result
     * @return string
     */
    public function afterGetFullName(AddressBook $addressBook, $result)
    {
        $typeOrder = (int)$this->dataSettings->getGeneralConfig('orderName');

        $fullName = '';

        switch ($typeOrder) {
            case self::FIRST_NAME_LAST_NAME:
                $fullName = "{$addressBook->getFirstName()}  {$addressBook->getLastName()}";
                break;
            case self::LAST_NAME_FIRST_NAME:
                $fullName = "{$addressBook->getLastName()}  {$addressBook->getFirstName()}";
                break;
        }
        return $fullName;
    }
}
