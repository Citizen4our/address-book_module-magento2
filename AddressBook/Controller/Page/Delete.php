<?php

//redudant new line
namespace Customer\AddressBook\Controller\Page;

//redudant new line
use Customer\AddressBook\Model\AddressBookFactory;
use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;

class Delete extends Action
{
    /**
     * @var Session
     */
    private $session;

    /**
     * @var AddressBookFactory
     */
    private $addressBookFactory;
    // add coment. Please use new line for each argument.
    public function __construct(Context $context, AddressBookFactory $addressBookFactory, Session $session)
    {
        $this->addressBookFactory = $addressBookFactory;
        $this->session = $session;
        parent::__construct($context);
    }

    /**
     * @return ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
     * @throws \Exception
     */
    public function execute()
    {
        $abbBook = $this->addressBookFactory->create();
        $customerId = $this->session->getId();
        $abbBook->load($customerId, 'customer_id')->delete();
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setUrl('/customer/account');
        return $resultRedirect;
    }
}
//add new line
