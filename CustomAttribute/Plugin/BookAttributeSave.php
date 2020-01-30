<?php

namespace Customer\CustomAttribute\Plugin;

use Customer\AddressBook\Api\AddressBookRepositoryInterface;
use Customer\CustomAttribute\Api\Data\ExtendedAddressBookInterface;

class BookAttributeSave
{
    const NAME_ATTRIBUTE = 'is_racist';

    /**
     * @param AddressBookRepositoryInterface $addressBookRepository
     * @param ExtendedAddressBookInterface $addressBook
     */
    public function beforeSave(
        AddressBookRepositoryInterface $addressBookRepository,
        ExtendedAddressBookInterface $addressBook
    )
    {
        $this->generateIsRacist($addressBook);
    }

    /**
     * @param ExtendedAddressBookInterface $addressBook
     * @return ExtendedAddressBookInterface
     */
    private function generateIsRacist(ExtendedAddressBookInterface $addressBook)
    {

        $addressBookId = $addressBook->getAddressBookId();
        if (!$addressBookId) {
            $isRacist = rand(0, 1);
            $addressBook->setData(self::NAME_ATTRIBUTE, $isRacist);
        }
        return $addressBook;
    }
}
