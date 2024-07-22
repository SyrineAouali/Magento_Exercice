<?php
namespace Exercice\ContactManagement\Controller\Adminhtml\CustomerContact;

use Magento\Backend\App\Action;

class Edit extends Action
{   protected $_transportBuilder;
    protected $_scopeConfig;
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_resultPageFactory;

    /**
     * @var \Exerice\ContactManagement\Model\CustomerContact
     */
    protected $_model;
    protected $_storeManager;
    /**
     * @param Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Magento\Framework\Registry $registry
     * @param Exercice\ContactManagement\Model\CustomerContact $model
     */
    public function __construct(
        \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Registry $registry,
        \Exercice\ContactManagement\Model\CustomerContact $model,

    ) {
        $this->_resultPageFactory = $resultPageFactory;
        $this->_coreRegistry = $registry;
        $this->_model = $model;
        $this->_transportBuilder = $transportBuilder;
        $this->_scopeConfig = $scopeConfig;
        $this->_storeManager = $storeManager;
        parent::__construct($context);
    }

    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Exercice_ContactManagement::customercontact_save');
    }

    /**
     * Init actions
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    protected function _initAction()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->_resultPageFactory->create();
        $resultPage->setActiveMenu('Exercice_ContactManagement::customercontact')
            ->addBreadcrumb(__('Contact Management'), __('Contact Management'))
            ->addBreadcrumb(__('Manage Customer Contacts'), __('Manage Customer Contacts'));
        return $resultPage;
    }


    /**

     *
     * @return \Magento\Backend\Model\View\Result\Page|\Magento\Backend\Model\View\Result\Redirect
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    protected function sendResponseEmail($contact)
    {

        $customerName = $contact->getCustomerName();
        $customerEmail = $contact->getCustomerMail();
        $contactCreationTime = $contact->getContactCreationAt();
        $contactResponse = $contact->getContactResponse();

        $templateVars = [
            'customer_name' => $customerName,
            'contact_creation_at' => $contactCreationTime,
            'contact_response' => $contactResponse,
        ];

        $sender = [
            'name' => $this->_scopeConfig->getValue('trans_email/ident_support/name', \Magento\Store\Model\ScopeInterface::SCOPE_STORE),
            'email' => $this->_scopeConfig->getValue('trans_email/ident_support/email', \Magento\Store\Model\ScopeInterface::SCOPE_STORE),
        ];

        $transport = $this->_transportBuilder
            ->setTemplateIdentifier('Réponse Contact Client')
            ->setTemplateOptions([
                'area' => \Magento\Framework\App\Area::AREA_FRONTEND,
                'store' => $this->_storeManager->getStore()->getId()
            ])
            ->setTemplateVars($templateVars)
            ->setFrom($sender)
            ->addTo($customerEmail, $customerName)
            ->getTransport();

        $transport->sendMessage();
    }
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $model = $this->_model;


        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This customer contact no longer exists.'));
                return $this->resultRedirectFactory->create()->setPath('*/*/');
            }
        }


        $data = $this->getRequest()->getPostValue();
        if ($data) {
            try {
                $model->setData('contact_response', $data['contact_response']);
                $model->save();

                if ($model->getCustomerMail()) {
                    $this->sendResponseEmail($model);
                }


                $this->messageManager->addSuccess(__('The contact response has been saved and an email has been sent.'));
                return $this->resultRedirectFactory->create()->setPath('*/*/index');
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
                return $this->resultRedirectFactory->create()->setPath('*/*/edit', ['id' => $model->getId()]);
            }

        }
        $this->_coreRegistry->register('customer_contact_customercontact', $model);
        $resultPage = $this->_initAction();
        $resultPage->getConfig()->getTitle()->prepend(__('Customer Contact'));
        $resultPage->getConfig()->getTitle()->prepend($model->getId() ? $model->getName() : __('New Customer Contact'));

        return $resultPage;
    }

}
