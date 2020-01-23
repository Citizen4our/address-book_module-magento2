<?php

namespace Customer\AddressBook\Model;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

class AddressBook extends AbstractModel implements IdentityInterface
{
    const  CACHE_TAG = 'add_book';

    //Comment?
    protected function _construct() {
        $this->_init('Customer\AddressBook\Resource\AddressBook');
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
        //Redudant string return [];
        $values = [];

        return $values;
    }
}
//there must be an empty string.
