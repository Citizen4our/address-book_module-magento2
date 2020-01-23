<?php

namespace Customer\AddressBook\Controller\Page;

//new line?
use Customer\AddressBook\Model\AddressBookFactory;
//redudant \ before Class name
use \Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use \Magento\Framework\View\Result\PageFactory;
use \Magento\Customer\Model\Session;

class View extends \Magento\Framework\App\Action\Action
{
    /**
     * @var PageFactory
     */
    private $resultPageFactory;
    
    /**
     * @var AddressBookFactory
     */
    private $addressBookFactory;

    /**
     * @var Session
     */
    private $session;

    /**
     * View constructor.
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param AddressBookFactory $addressBookFactory
     * @param Session $session
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        AddressBookFactory $addressBookFactory,
        Session $session
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->addressBookFactory = $addressBookFactory;
        $this->session = $session;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        if (!$this->session->isLoggedIn()) {
            $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
            //Please use UrlBuilder
            $resultRedirect->setUrl('/customer/account/login');
            return $resultRedirect;
        }
        $abbBook = $this->addressBookFactory->create();
        $customerId = $this->session->getId();
        //Load is a heavy operation. Please use a collection.
        $data = $abbBook->load($customerId, 'customer_id')->getData();
        
        if(empty($data)){
            $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
            //Please use UrlBuilder
            $resultRedirect->setUrl('/book/page/addbook');
            return $resultRedirect;
        }
        
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(__('Customer: Address book '));
        $this->_view->loadLayout();
        $this->_view->renderLayout();
        return $resultPage;
    }
}
