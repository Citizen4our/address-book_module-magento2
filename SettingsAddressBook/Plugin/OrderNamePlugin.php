<?php

namespace Customer\SettingsAddressBook\Plugin;

use Customer\AddressBook\Model\AddressBook;
use Customer\SettingsAddressBook\Helper\DataSettings;

class OrderNamePlugin
{
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


    public function beforeGetFullName(AddressBook $addressBook)
    {
        $typeOrder = $this->dataSettings->getGeneralConfig('orderName');

        if ($typeOrder) {
            return $typeOrder;
        }

        return AddressBook::FIRST_NAME_LAST_NAME;
    }
}
