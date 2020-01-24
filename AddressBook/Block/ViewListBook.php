<?php

namespace Customer\AddressBook\Block;

use Customer\AddressBook\Api\AddressBookRepositoryInterfaceFactory;
use Customer\AddressBook\Api\Data\AddressBookInterface;
use Magento\Customer\Model\Session;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchCriteriaInterface;
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
     * @var AddressBookRepositoryInterfaceFactory
     */
    private $addressBookRepositoryFactory;
    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * ViewBook constructor.
     * @param Context $context
     * @param Session $session
     * @param AddressBookRepositoryInterfaceFactory $addressBookRepositoryFactory
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     */
    public function __construct(
        Context $context,
        Session $session,
        AddressBookRepositoryInterfaceFactory $addressBookRepositoryFactory,
        SearchCriteriaBuilder $searchCriteriaBuilder
    )
    {
        $this->session = $session;
        $this->addressBookRepositoryFactory = $addressBookRepositoryFactory;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        parent::__construct($context);
    }

    /**
     * @return AddressBookInterface[]
     */
    public function getAddressBookListByCustomerId()
    {
        $customerId = $this->session->getId();
        $repository = $this->addressBookRepositoryFactory->create();
        /** @var SearchCriteriaInterface $searchCriteria */
        $searchCriteria = $this->searchCriteriaBuilder->addFilter(AddressBookInterface::CUSTOMER_ID, $customerId)->create();
        return $repository->getListByCustomerId($searchCriteria);
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
