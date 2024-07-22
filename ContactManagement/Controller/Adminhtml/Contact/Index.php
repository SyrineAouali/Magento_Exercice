<?php
namespace Exercice\ContactManagement\Controller\Adminhtml\Contact;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Backend\App\Action;

class Index extends Action
{
    const ADMIN_RESOURCE = 'Exercice_ContactManagement::contact_management';

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Index action
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Exercice_ContactManagement::contact_management');
        $resultPage->addBreadcrumb(__('Contact Management'), __('Contact Management'));
        $resultPage->addBreadcrumb(__('Manage Contacts'), __('Manage Contacts'));
        $resultPage->getConfig()->getTitle()->prepend(__('Contacts'));

        return $resultPage;
    }
}
