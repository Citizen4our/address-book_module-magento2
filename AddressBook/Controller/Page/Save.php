<?php

//new line?
namespace Customer\AddressBook\Controller\Page;

use Customer\AddressBook\Model\AddressBook;
use Customer\AddressBook\Model\AddressBookFactory;
use Customer\AddressBook\Model\ResourceModel\ResourceAddressBook;
use Customer\AddressBook\Model\ResourceModel\ResourceAddressBookFactory;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\Action;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\UrlInterface;

class Save extends Action
{
    const VIEW_ADDRESS_BOOK_LINK = 'book/page/view';

    /**
     * @var AddressBookFactory
     */
    private $addressBookFactory;
    /**
     * @var ResourceAddressBookFactory
     */
    private $resourceAddressBookFactory;

    /**
     * Save constructor.
     * @param Context $context
     * @param AddressBookFactory $addressBook
     * @param UrlInterface $urlBuilder
     * @param ResourceAddressBookFactory $resourceAddressBookFactory
     */
    public function __construct(
        Context $context,
        AddressBookFactory $addressBook,
        ResourceAddressBookFactory $resourceAddressBookFactory


    )
    {
        $this->addressBookFactory = $addressBook;
        $this->resourceAddressBookFactory = $resourceAddressBookFactory;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     * @throws \Exception
     */
    public function execute()
    {
        $post = (array)$this->getRequest()->getParams();
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        if (!empty($post)) {
            $addressBook = $this->addressBookFactory->create();
            /** @var AddressBook $addressBook */
            $addressBook->setData($post);
            /** @var ResourceAddressBook $resourceAddressBook */
            $resourceAddressBook = $this->resourceAddressBookFactory->create();
            $resourceAddressBook->save($addressBook);
            $url = $this->_url->getUrl(self::VIEW_ADDRESS_BOOK_LINK);
            $resultRedirect->setUrl($url);
            return $resultRedirect;
        }
        $this->messageManager->addErrorMessage(__('Send empty form!'));
        $resultRedirect->setUrl($this->_redirect->getRefererUrl());
        return $resultRedirect;
    }
}
