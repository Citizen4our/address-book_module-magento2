<?php

namespace Customer\SettingsAddressBook\Model\Config\Source;

use Customer\AddressBook\Model\AddressBook;
use \Magento\Framework\Data\OptionSourceInterface;

class OrderTypeName implements OptionSourceInterface
{

    /**
     * Return array of options as value-label pairs
     *
     * @return array Format: array(array('value' => '<value>', 'label' => '<label>'), ...)
     */
    public function toOptionArray()
    {
        return [
            ['value' => AddressBook::FIRST_NAME_LAST_NAME, 'label' => __('First name - last name')],
            ['value' => AddressBook::LAST_NAME_FIRST_NAME, 'label' => __('Last name - first name')],
        ];
    }
}
