<?php

namespace Customer\AddressBook\Block;

use Magento\Customer\Model\Session;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\Data\Form\FormKey;
use Magento\Framework\View\Element\Template;

class AddedBook extends Template
{
    const FORM_ACTION = '/book/page/save';

    /**
     * @var FormKey
     */
    private $formKey;

    /**
     * @var Session
     */
    private $session;

    /**
     * AddedBook constructor.
     * @param Template\Context $context
     * @param FormKey $formKey
     * @param Session $session
     */
    public function __construct(Template\Context $context, FormKey $formKey, Session $session)
    {
        //Using of the ObjectManger is a bad practice. Why we are using it here?
        $this->formKey = $formKey ?: ObjectManager::getInstance()->get(
            FormKey::class
        );
        $this->session = $session;
        parent::__construct($context);
    }

    /**
     * Get form action URL for POST booking request
     *
     * @return string
     */
    public function getFormAction()
    {
        return self::FORM_ACTION;
    }

        //Comments
    public function getFormKey()
    {
        return $this->formKey->getFormKey();
    }

    //Comments
    public function getIdCustomer()
    {
        return $this->session->getId();
    }
}
