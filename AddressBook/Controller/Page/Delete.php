<?php

namespace Customer\AddressBook\Controller\Page;

use Customer\AddressBook\Api\AddressBookRepositoryInterface;
use Customer\AddressBook\Api\AddressBookRepositoryInterfaceFactory;
use Customer\AddressBook\Model\AddressBookFactory;
use Customer\AddressBook\Model\ResourceModel\AddressBookFactory as ResourceAddressBookFactory;
use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\UrlInterface;

class Delete extends Action
{
    /**
     * @var Session
     */
    private $session;

    /**
     * @var UrlInterface
     */
    private $urlBuilder;

    /**
     * @var ResourceAddressBookFactory
     */
    private $resourceAddressBookFactory;

    /**
     * @var AddressBookFactory
     */
    private $addressBookFactory;

    /**
     * @var AddressBookRepositoryInterfaceFactory
     */
    private $addressBookRepositoryFactory;

    /**
     * Delete constructor.
     * @param Context $context
     * @param Session $session
     * @param UrlInterface $urlBuilder
     * @param ResourceAddressBookFactory $resourceAddressBookFactory
     * @param AddressBookFactory $addressBookFactory
     * @param AddressBookRepositoryInterfaceFactory $addressBookRepositoryFactory
     */
    public function __construct(
        Context $context,
        Session $session,
        UrlInterface $urlBuilder,
        ResourceAddressBookFactory $resourceAddressBookFactory,
        AddressBookFactory $addressBookFactory,
        AddressBookRepositoryInterfaceFactory $addressBookRepositoryFactory
    )
    {
        $this->session = $session;
        $this->urlBuilder = $urlBuilder;
        $this->addressBookFactory = $addressBookFactory;
        $this->resourceAddressBookFactory = $resourceAddressBookFactory;
        parent::__construct($context);
        $this->addressBookRepositoryFactory = $addressBookRepositoryFactory;
    }

    /**
     * @return ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
     * @throws \Exception
     */
    public function execute()
    {
        $id = $this->_request->getParam('id');

        try {
            /** @var AddressBookRepositoryInterface $repository */
            $repository = $this->addressBookRepositoryFactory->create();
            $repository->deleteByABId($id);
        } catch (\Exception $exception) {
            $this->messageManager->addErrorMessage($exception->getMessage());
        }
        /** @var Json $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        $resultRedirect->setData([
            'success' => true
        ]);
        return $resultRedirect;
    }
}
