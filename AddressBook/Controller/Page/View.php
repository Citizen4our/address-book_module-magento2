<?php

namespace Customer\AddressBook\Controller\Page;

use Magento\Framework\App\Action\Action;
use \Magento\Framework\App\Action\Context;
// what is the difference Magento... between \Magento\..
use Magento\Framework\Controller\ResultFactory;
use \Magento\Framework\View\Result\PageFactory;
use \Magento\Customer\Model\Session;

class View extends Action
{
    /**
     * @var PageFactory
     */
    private $resultPageFactory;
    /**
     * @var Session
     */
    private $session;

    /**
     * View constructor.
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param Session $session
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        Session $session
    )
    {
        $this->resultPageFactory = $resultPageFactory;
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
            $url = $this->_url->getUrl('customer/account/login');
            $resultRedirect->setUrl($url);
            return $resultRedirect;
        }
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(__('Customer: Address book '));
        $this->_view->loadLayout();
        $this->_view->renderLayout();
        return $resultPage;
    }
}
