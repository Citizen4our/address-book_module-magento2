<?php

namespace Customer\AddressBook\Model\ResourceModel\AddressBook;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * Collection initialization
     */
    protected function _construct()
    {
        $this->_init(
            \Customer\AddressBook\Model\AddressBook::class,
            \Customer\AddressBook\Model\ResourceModel\AddressBook::class
        );
    }
}
