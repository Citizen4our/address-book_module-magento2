<?php

namespace Customer\AddressBook\Api;

use Customer\AddressBook\Api\Data\AddressBookInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\DataObject;

interface AddressBookRepositoryInterface
{
    /**
     * @param AddressBookInterface $addressBook
     * @return AddressBookInterface
     */
    public function save(AddressBookInterface $addressBook);

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return AddressBookInterface[]
     */
    public function getListByCustomerId(SearchCriteriaInterface $searchCriteria);

    /**
     * @param $addressBookId
     * @return AddressBookInterface
     */
    public function getAddressBook($addressBookId);

    /**
     * Delete AddressBook by ID
     * @param string $addressBookId
     * @return bool true on success
     */
    public function deleteByABId($addressBookId);

    /**
     * Delete AddressBook
     * @param AddressBookInterface $addressBook
     * @return bool true on success
     */
    public function delete(AddressBookInterface $addressBook);
}
