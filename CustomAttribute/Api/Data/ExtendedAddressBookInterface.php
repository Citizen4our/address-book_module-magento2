<?php

namespace Customer\CustomAttribute\Api\Data;

use Customer\AddressBook\Api\Data\AddressBookInterface;

interface ExtendedAddressBookInterface extends AddressBookInterface
{
    /**
     * @return int
     */
    public function getRacism();
}
