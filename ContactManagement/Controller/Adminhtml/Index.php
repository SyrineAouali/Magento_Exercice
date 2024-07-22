<?php
// app/code/Exe/ContactManagement/Controller/Adminhtml/Index.php

namespace Exe\ContactManagement\Controller\Adminhtml;

use Magento\Backend\App\Action;

class Index extends Action
{
protected $_publicActions = ['index'];

protected function _isAllowed()
{
return $this->_authorization->isAllowed('Exe_ContactManagement::manage');
}

public function execute()
{
$this->_view->loadLayout();
$this->_setActiveMenu('Exe_ContactManagement::manage');
$this->_view->getPage()->getConfig()->getTitle()->prepend(__('Customer Contacts'));
$this->_view->renderLayout();
}
}
