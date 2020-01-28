<?php

namespace Customer\AddressBook\Controller\Page;

use Customer\AddressBook\Api\AddressBookRepositoryInterface;
use Customer\AddressBook\Api\AddressBookRepositoryInterfaceFactory;
use Customer\AddressBook\Model\AddressBookFactory;
use Customer\AddressBook\Model\ResourceModel\AddressBook;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\Action;
use Magento\Framework\Controller\ResultFactory;

class Save extends Action
{
    const VIEW_ADDRESS_BOOK_LINK = 'book/page/view';

    /**
     * @var AddressBookFactory
     */
    private $addressBookFactory;

    /**
     * @var AddressBookRepositoryInterfaceFactory
     */
    private $addressBookRepository;

    /**
     * Save constructor.
     * @param Context $context
     * @param AddressBookFactory $addressBook
     * @param AddressBookRepositoryInterfaceFactory $addressBookRepository
     */
    public function __construct(
        Context $context,
        AddressBookFactory $addressBook,
        AddressBookRepositoryInterfaceFactory $addressBookRepository
    )
    {
        $this->addressBookFactory = $addressBook;

        $this->addressBookRepository = $addressBookRepository;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $post = (array)$this->getRequest()->getParams();
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        if (!empty($post)) {
            $addressBook = $this->addressBookFactory->create();
            /** @var AddressBook $addressBook */
            $addressBook->setData($post);
            /** @var AddressBookRepositoryInterface $repository */
            $repository = $this->addressBookRepository->create();
            $repository->save($addressBook);
            $url = $this->_url->getUrl(self::VIEW_ADDRESS_BOOK_LINK);
            $resultRedirect->setUrl($url);
            return $resultRedirect;
        }
        $this->messageManager->addErrorMessage(__('Send empty form!'));
        $resultRedirect->setUrl($this->_redirect->getRefererUrl());
        return $resultRedirect;
    }
}
