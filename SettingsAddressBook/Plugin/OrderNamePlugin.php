<?php

namespace Customer\SettingsAddressBook\Plugin;

use Customer\AddressBook\Model\AddressBook;
use Customer\SettingsAddressBook\Helper\OrderTypeFromNameSettings;
use Customer\SettingsAddressBook\Model\Config\Constants\AddressBookConstantsOrder;

class OrderNamePlugin
{

    /**
     * @var OrderTypeFromNameSettings
     */
    private $dataSettings;

    /**
     * OrderNamePlugin constructor.
     * @param OrderTypeFromNameSettings $dataSettings
     */
    public function __construct(
        OrderTypeFromNameSettings $dataSettings
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
            case AddressBookConstantsOrder::FIRST_NAME_LAST_NAME:
                $fullName = "{$addressBook->getFirstName()}  {$addressBook->getLastName()}";
                break;
            case AddressBookConstantsOrder::LAST_NAME_FIRST_NAME:
                $fullName = "{$addressBook->getLastName()}  {$addressBook->getFirstName()}";
                break;
        }
        return $fullName;
    }
}
