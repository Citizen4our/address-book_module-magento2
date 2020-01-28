<?php

namespace Customer\SettingsAddressBook\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

abstract class DataSettings extends AbstractHelper
{
    protected $pathXML = '';
    /**
     * @param $field
     * @param null $storeId
     * @return string
     */
    public function getConfigValue($field, $storeId = null)
    {
        return $this->scopeConfig->getValue(
            $field, ScopeInterface::SCOPE_STORE, $storeId
        );


    }

    /**
     * @param $code
     * @param null $storeId
     * @return string
     */
    public function getGeneralConfig($code, $storeId = null)
    {
        return $this->getConfigValue($this->pathXML . $code, $storeId);
    }
}
