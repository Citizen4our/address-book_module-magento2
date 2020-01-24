<?php

namespace Customer\AddressBook\Api\Data;

use \Magento\Framework\Api\SearchResultsInterface;

interface AddressBookSearchResultsInterface extends SearchResultsInterface
{
    /**
     * @return AddressBookInterface[]
     */
    public function getItems();

    /**
     * @param AddressBookInterface[]|null $items
     * @return SearchResultsInterface
     */
    public function setItems(array $items = null);
}
