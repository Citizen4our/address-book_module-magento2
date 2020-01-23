<?php

//new line?
namespace Customer\AddressBook\Controller\Page;

use Magento\Framework\App\Action\Action;
use Magento\Framework\Controller\ResultFactory;

class Save extends Action
{
    const VIEW_ADDRESS_BOOK_LINK = '/book/page/view';

    //comment
    private $addressBook;

    //comment
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Customer\AddressBook\Model\AddressBookFactory $addressBook
    ) //new line?
    {
        $this->addressBook = $addressBook;
        parent::__construct($context);
    }

    //Comment?
    public function execute()
    {
        //please check what data type return getParams()
        $post = (array)$this->getRequest()->getParams();
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        if (!empty($post)) {
            $abbBook = $this->addressBook->create();
            //Saving of the entity with a model is depricated. Use Resource Model instead.
            $abbBook->setData($post)->save();
            // Please use UrlBuilder
            $resultRedirect->setUrl(self::VIEW_ADDRESS_BOOK_LINK);
            return $resultRedirect;
        }
        //add error message
        $resultRedirect->setUrl($this->_redirect->getRefererUrl());
        return $resultRedirect;
    }
}
//add new line
