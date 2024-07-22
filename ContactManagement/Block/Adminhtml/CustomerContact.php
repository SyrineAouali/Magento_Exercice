<?php
// app/code/Exe/ContactManagement/Block/Adminhtml/CustomerContact.php

namespace Exe\ContactManagement\Block\Adminhtml;

use Magento\Backend\Block\Widget\Grid\Container;

class CustomerContact extends Container
{
    protected function _construct()
    {
        $this->_controller = 'adminhtml_customerContact';
        $this->_blockGroup = 'Exe_ContactManagement';
        $this->_headerText = __('Customer Contacts');
        $this->_addButtonLabel = __('Add New Contact');
        parent::_construct();
    }
}
