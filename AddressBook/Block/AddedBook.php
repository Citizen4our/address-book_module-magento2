<?php

namespace Customer\AddressBook\Block;

use Customer\AddressBook\Model\AddressBook;
use Customer\AddressBook\Model\AddressBookFactory;
use Customer\AddressBook\Model\ResourceModel\ResourceAddressBook;
use Customer\AddressBook\Model\ResourceModel\ResourceAddressBookFactory;
use Magento\Customer\Model\Session;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class AddedBook extends Template
{
    const FORM_ACTION = '/book/page/save';

    /**
     * @var Session
     */
    private $session;
// Please decide to use or not to use gaps between сlass properties
    /**
     * @var AddressBookFactory
     */
    private $addressBookFactory;
    /**
     * @var ResourceAddressBookFactory
     */
    private $resourceAddressBookFactory;

    /**
     * AddedBook constructor.
     * @param Context $context
     * @param Session $session
     * @param AddressBookFactory $addressBookFactory
     * @param ResourceAddressBookFactory $resourceAddressBookFactory
     */
    public function __construct(
        Context $context,
        Session $session,
        AddressBookFactory $addressBookFactory,
        ResourceAddressBookFactory $resourceAddressBookFactory
    )
    {
        $this->session = $session;
        $this->addressBookFactory = $addressBookFactory;
        $this->resourceAddressBookFactory = $resourceAddressBookFactory;
        parent::__construct($context);
    }

    /**
     * Get form action URL for POST booking request
     *
     * @return string
     */
    public function getFormAction()
    {
        return self::FORM_ACTION;
    }

    /**
     * @return int|null
     */
    public function getIdCustomer()
    {
        return $this->session->getId();
    }

    /**
     * @return array|AddressBook
     */
    public function getDataAddressBookFromCustomer()
    {
        $id = $this->_request->getParam('id');
        /** @var AddressBook $addressBook */
        $addressBook = $this->addressBookFactory->create();
        if (isset($id)) {
            $this->resourceAddressBookFactory->create()->load($addressBook, $id, ResourceAddressBook::ID_FIELD_TITLE);
        }
        return $addressBook;
    }
}
