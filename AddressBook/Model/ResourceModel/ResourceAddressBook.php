<?php

namespace Customer\AddressBook\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class ResourceAddressBook extends AbstractDb
{
    const ID_FIELD_TITLE = 'address_book_id';

    /**
     * Resource initialization
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('address_book', self::ID_FIELD_TITLE);
    }
}
