<?php

namespace Customer\AddressBook\Model;

use Customer\AddressBook\Api\AddressBookRepositoryInterface;
use Customer\AddressBook\Api\Data\AddressBookInterface;
use Customer\AddressBook\Api\Data\AddressBookInterfaceFactory;
use Customer\AddressBook\Api\Data\AddressBookSearchResultsInterfaceFactory;
use Customer\AddressBook\Model\ResourceModel\AddressBook\CollectionFactory;
use Customer\AddressBook\Model\ResourceModel\AddressBook;
use Customer\AddressBook\Model\ResourceModel\ResourceAddressBookFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotSaveException;

class AddressBookRepository implements AddressBookRepositoryInterface
{
    /**
     * @var AddressBook
     */
    private $resource;

    /**
     * @var AddressBookInterfaceFactory
     */
    private $addressBookFactory;

    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * @var AddressBookSearchResultsInterfaceFactory
     */
    private $searchResultsFactory;

    /**
     * AddressBookRepository constructor.
     * @param ResourceAddressBookFactory $resourceAddressBookFactory
     * @param AddressBookInterfaceFactory $addressBookFactory
     * @param CollectionFactory $collectionFactory
     * @param CollectionProcessorInterface $collectionProcessor
     * @param AddressBookSearchResultsInterfaceFactory $searchResultsFactory
     */
    public function __construct(
        ResourceAddressBookFactory $resourceAddressBookFactory,
        AddressBookInterfaceFactory $addressBookFactory,
        CollectionFactory $collectionFactory,
        CollectionProcessorInterface $collectionProcessor,
        AddressBookSearchResultsInterfaceFactory $searchResultsFactory
    )
    {
        $this->resource = $resourceAddressBookFactory->create();
        $this->addressBookFactory = $addressBookFactory;
        $this->collectionFactory = $collectionFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->searchResultsFactory = $searchResultsFactory;
    }

    /**
     * @param AddressBookInterface $addressBook
     * @return AddressBookInterface
     * @throws \Magento\Framework\Exception\AlreadyExistsException
     */
    public function save(AddressBookInterface $addressBook)
    {
        $this->resource->save($addressBook);
        return $addressBook;
    }


    /**
     * @param $addressBookId
     * @return AddressBookInterface
     */
    public function getAddressBook($addressBookId)
    {
        $addressBook = $this->addressBookFactory->create();
        $this->resource->load($addressBook, $addressBookId, AddressBookInterface::ADDRESS_BOOK_ID);
        return $addressBook;
    }

    /**
     * @param string $addressBookId
     * @return bool
     * @throws CouldNotSaveException
     */
    public function deleteByABId($addressBookId)
    {
        return $this->delete($this->getAddressBook($addressBookId));
    }

    /**
     * @param AddressBookInterface $addressBook
     * @return bool
     * @throws CouldNotSaveException
     */
    public function delete(AddressBookInterface $addressBook)
    {
        try {
            $this->resource->delete($addressBook);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__('Error delete address book'),
                $e);
        }
        return true;
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return AddressBookInterface[]
     */
    public function getListByCustomerId(SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->collectionFactory->create();

        $this->collectionProcessor->process($searchCriteria, $collection);
        $collection->load();

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        $adressBookList = $searchResults->getItems();
        return $adressBookList;
    }
}
