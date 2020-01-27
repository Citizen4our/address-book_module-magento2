<?php

namespace Customer\AddressBook\Model;

use Customer\AddressBook\Api\Data\AddressBookInterface;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

class AddressBook extends AbstractModel implements IdentityInterface, AddressBookInterface
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

    /**
     * @return array
     */
    public function getDefaultValues()
    {
        return [];
    }

    /**
     * @return int
     */
    public function getAddressBookId()
    {
        return (int)$this->getDataByKey(self::ADDRESS_BOOK_ID);
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return (string)$this->getDataByKey(self::FIRST_NAME);
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return (string)$this->getDataByKey(self::LAST_NAME);
    }

    /**
     * @return string
     */
    public function getPhoneNumber()
    {
        return (string)$this->getDataByKey(self::PHONE_NUMBER);
    }

    /**
     * @return int
     */
    public function getCustomerId()
    {
        return (int)$this->getDataByKey(self::CUSTOMER_ID);
    }

    /**
     * @param int $order
     * @return string
     */
    public function getFullName(int $order = AddressBook::LAST_NAME_FIRST_NAME)
    {
        $fullName = '';
        switch ($order){
            case self::FIRST_NAME_LAST_NAME:
                $fullName = "{$this->getFirstName()}  {$this->getLastName()}";
                break;
            case self::LAST_NAME_FIRST_NAME:
                $fullName = "{$this->getLastName()}  {$this->getFirstName()}";
                break;

        }
        return $fullName;
    }
}
