<?php

namespace Exercice\ContactManagement\Block\Adminhtml\Customer\Contact;

use Magento\Backend\Block\Widget\Grid\Container;

class Index extends Container
{
    protected function _construct()
    {
        $this->_controller = 'adminhtml_customer_contact_index';
        $this->_blockGroup = 'Exercice_ContactManagement';
        $this->_headerText = __('Customer Contacts');
        parent::_construct();
        $this->removeButton('add');
    }
}
