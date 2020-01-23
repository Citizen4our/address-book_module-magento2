<?php

// new line?
namespace Customer\AddressBook\Resource;

// new line?
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class AddressBook extends AbstractDb
{
    //Why we a re using constructor here?
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context
        // new line?
    )
    {
        parent::__construct($context);
    }
    /**
     * Resource initialization
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('address_book', 'address_book_id');
    }
}
