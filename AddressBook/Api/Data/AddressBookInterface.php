<?php

namespace Customer\AddressBook\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

interface AddressBookInterface extends ExtensibleDataInterface
{
    const TABLE_NAME = 'address_book';

    const ADDRESS_BOOK_ID = 'address_book_id';

    const FIRST_NAME = 'first_name';

    const LAST_NAME = 'last_name';

    const PHONE_NUMBER = 'phone_number';

    const CUSTOMER_ID = 'customer_id';

    /**
     * Get ID AddressBook
     * @return int
     */
    public function getAddressBookId();

    /**
     * @return string
     */
    public function getFirstName();

    /**
     * @return string
     */
    public function getLastName();

    /**
     * @return string
     */
    public function getPhoneNumber();

    /**
     * @return int
     */
    public function getCustomerId();

    /**
     * @return string
     */
    public function getFullName();
}
