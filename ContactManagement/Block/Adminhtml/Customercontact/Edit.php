<?php
namespace Exercice\ContactManagement\Block\Adminhtml\Customercontact;

use Magento\Backend\Block\Widget\Form\Container;

class Edit extends Container
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;

    /**
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry,
        array $data = []
    ) {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }

    /**
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_objectId = 'customer_id';
        $this->_blockGroup = 'Exercice_ContactManagement';
        $this->_controller = 'adminhtml_customercontact';

        parent::_construct();

        if ($this->_isAllowedAction('Exercice_ContactManagement::customercontact_save')) {
            $this->buttonList->update('save', 'label', __('Save Contact Response'));

        } else {
            $this->buttonList->remove('save');
        }

    }

    /**

     *
     *
     *
     * @return \Magento\Framework\Phrase
     */
    public function getHeaderText()
    {
        if ($this->_coreRegistry->registry('customer_contact_customercontact')->getCustomerId()) {
            return __("Edit Customer Contact '%1'", $this->escapeHtml($this->_coreRegistry->registry('customer_contact_customercontact')->getName()));
        } else {
            return __('New Customer Contact');
        }
    }

    /**
     * Check permission for passed action
     *
     * @param string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }

    /**
     * Getter of url for "Save and Continue" button
     * tab_id will be replaced by desired by JS later
     *
     * @return string
     */
    protected function _getSaveAndContinueUrl()
    {
        return $this->getUrl('customer_contact/*/save', ['_current' => true, 'back' => 'edit', 'active_tab' => '']);
    }
}
