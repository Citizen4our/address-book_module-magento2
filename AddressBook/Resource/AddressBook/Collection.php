<?php

// new line?
namespace Customer\AddressBook\Resource\AddressBook;

// new line?
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    // comment?
    protected function _construct() {
        $this->_init(
            'Customer\AddressBook\Model\AddressBook',
            'Customer\AddressBook\Resource\AddressBook'
        );
    }
}
//new line
