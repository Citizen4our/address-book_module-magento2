<?php

namespace Customer\AddressBook\Block;

use Customer\AddressBook\Model\AddressBook;
use Customer\AddressBook\Model\ResourceModel\AddressBook\Collection;
use Customer\AddressBook\Model\ResourceModel\AddressBook\CollectionFactory;
use Magento\Customer\Model\Session;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class ViewListBook extends Template
{
    const LINK_DELETE = 'book/page/delete';

    const LINK_EDIT = 'book/page/addbook';

    /**
     * @var Session
     */
    private $session;

    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * ViewBook constructor.
     * @param Context $context
     * @param Session $session
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        Context $context,
        Session $session,
        CollectionFactory $collectionFactory
    )
    {
        $this->session = $session;
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\DataObject[]
     */
    public function getAddressBookListByCustomerId()
    {
        $customerId = $this->session->getId();
        /** @var Collection $collection */
        $collection = $this->collectionFactory->create();
        $addressBook = $collection->addFieldToFilter('customer_id', $customerId)->getItems();

        return $addressBook;
    }

    /**
     * @param int $idAddressBook
     * @return string
     */
    public function getDeleteUrl(int $idAddressBook)
    {
        return $this->_urlBuilder->getUrl(self::LINK_DELETE, ['id' => $idAddressBook]);
    }

    /**
     * @param int $idAddressBook
     * @return string
     */
    public function getEditUrl(int $idAddressBook)
    {
        return $this->_urlBuilder->getUrl(self::LINK_EDIT, ['id' => $idAddressBook]);
    }
}
