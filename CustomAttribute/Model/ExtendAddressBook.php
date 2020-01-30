<?php

namespace Customer\CustomAttribute\Model;

use Customer\AddressBook\Model\AddressBook;
use Customer\CustomAttribute\Api\Data\ExtendedAddressBookInterface;

class ExtendAddressBook extends AddressBook implements ExtendedAddressBookInterface
{
    const IS_RACIST = 'is_racist';

    /**
     * @return int
     */
    public function getRacism()
    {
        return (int)$this->getDataByKey(self::IS_RACIST);
    }
}
