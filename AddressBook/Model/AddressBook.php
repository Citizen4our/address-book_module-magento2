<?php

namespace Customer\AddressBook\Model;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

class AddressBook extends AbstractModel implements IdentityInterface
{
    const  CACHE_TAG = 'add_book';

    /**
     * initialization Model
     */
    protected function _construct()
    {
        $this->_init(\Customer\AddressBook\Model\ResourceModel\ResourceAddressBook::class);
    }

    /**
     * @return array|string[]
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getDefaultValues()
    {
        return [];
    }

    public function getAddressBookId()
    {
        return $this->getDataByKey('address_book_id');
    }

    public function getFirstName()
    {
        return $this->getDataByKey('first_name');
    }

    public function getLastName()
    {
        return $this->getDataByKey('last_name');
    }

    public function getPhoneNumber()
    {
        return $this->getDataByKey('phone_number');
    }

    public function getCustomerId()
    {
        return $this->getDataByKey('customer_id');
    }
}
