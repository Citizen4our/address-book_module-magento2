<?php

namespace Customer\SettingsAddressBook\Observer;

use Customer\AddressBook\Api\AddressBookRepositoryInterface;
use Customer\AddressBook\Api\AddressBookRepositoryInterfaceFactory;
use Customer\AddressBook\Model\AddressBook;
use Customer\SettingsAddressBook\Helper\AliasNameDataSettings;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class AliasNameObserver implements ObserverInterface
{
    /**
     * @var AliasNameDataSettings
     */
    private $aliasNameDataSettings;

    /**
     * @var AddressBookRepositoryInterfaceFactory
     */
    private $addressBookRepositoryFactory;

    /**
     * AliasNameObserver constructor.
     * @param AliasNameDataSettings $aliasNameDataSettings
     * @param AddressBookRepositoryInterfaceFactory $addressBookRepositoryFactory
     */
    public function __construct(
        AliasNameDataSettings $aliasNameDataSettings,
        AddressBookRepositoryInterfaceFactory $addressBookRepositoryFactory
    )
    {
        $this->aliasNameDataSettings = $aliasNameDataSettings;
        $this->addressBookRepositoryFactory = $addressBookRepositoryFactory;
    }

    /**
     * @param Observer $observer
     * @return AliasNameObserver
     */
    public function execute(Observer $observer)
    {
        /** @var AddressBook $addressBook */
        $addressBook = $observer->getData()['data_object'];
        $idAddressBook = $addressBook->getAddressBookId();
        if ($idAddressBook) {
            /** @var AddressBookRepositoryInterface $bookRepository */
            $bookRepository = $this->addressBookRepositoryFactory->create();

            /** @var AddressBook $tempAddressBook */
            $tempAddressBook = $bookRepository->getAddressBook($idAddressBook);

            if (empty($tempAddressBook->getAlias() or is_null($tempAddressBook->getAlias()))) {
                $addressBook->setData('pogonjalo', $this->createAliasByAddressBook());
            }

            return $this;
        }
        $addressBook->setData('pogonjalo', $this->createAliasByAddressBook());
        return $this;
    }

    /**
     * @return string
     */
    private function createAliasByAddressBook()
    {
        $arrayNouns = explode(',', $this->aliasNameDataSettings->getGeneralConfig('nouns'));
        $arrayAdjectives = explode(',', $this->aliasNameDataSettings->getGeneralConfig('adjectives'));

        return $arrayAdjectives[array_rand($arrayAdjectives)] . ' ' . $arrayNouns[array_rand($arrayNouns)];
    }
}
