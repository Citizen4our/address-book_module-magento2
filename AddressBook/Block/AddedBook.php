<?php

namespace Customer\AddressBook\Block;

use Customer\AddressBook\Api\AddressBookRepositoryInterfaceFactory;
use Customer\AddressBook\Api\Data\AddressBookInterface;
use Customer\AddressBook\Api\Data\AddressBookInterfaceFactory;
use Magento\Customer\Model\Session;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class AddedBook extends Template
{
    const FORM_ACTION = 'book/page/save';

    /**
     * @var Session
     */
    private $session;

    /**
     * @var AddressBookInterfaceFactory
     */
    private $addressBookFactory;

    /**
     * @var AddressBookRepositoryInterfaceFactory
     */
    private $repositoryFactory;

    /**
     * AddedBook constructor.
     * @param Context $context
     * @param Session $session
     * @param AddressBookInterfaceFactory $addressBookFactory
     * @param AddressBookRepositoryInterfaceFactory $addressBookRepositoryFactory
     */
    public function __construct(
        Context $context,
        Session $session,
        AddressBookInterfaceFactory $addressBookFactory,
        AddressBookRepositoryInterfaceFactory $addressBookRepositoryFactory
    )
    {
        $this->session = $session;
        $this->addressBookFactory = $addressBookFactory;
        $this->repositoryFactory = $addressBookRepositoryFactory;
        parent::__construct($context);
    }

    /**
     * Get form action URL for POST request
     *
     * @return string
     */
    public function getFormAction()
    {
        return $this->getUrl(self::FORM_ACTION, ['_secure' => true]);
    }

    /**
     * @return int|null
     */
    public function getIdCustomer()
    {
        return $this->session->getId();
    }

    /**
     * @return AddressBookInterface
     */
    public function getDataAddressBookFromCustomer()
    {
        $id = $this->_request->getParam('id');
        if (isset($id)) {
            return $this->repositoryFactory->create()->getAddressBook($id);
        }

        /** @var AddressBookInterface $addressBook */
        $addressBook = $this->addressBookFactory->create();
        return $addressBook;
    }
}
