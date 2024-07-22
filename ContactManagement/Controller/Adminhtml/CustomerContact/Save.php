<?php
namespace Exercice\ContactManagement\Controller\Adminhtml\CustomerContact;

use Magento\Backend\App\Action;

class Save extends Action
{
    protected $_model;
    protected $_transportBuilder;
    protected $_scopeConfig;
    protected $_storeManager;

    public function __construct(
        Action\Context $context,
        \Exercice\ContactManagement\Model\CustomerContact $model,
        \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        parent::__construct($context);
        $this->_model = $model;
        $this->_transportBuilder = $transportBuilder;
        $this->_scopeConfig = $scopeConfig;
        $this->_storeManager = $storeManager;
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Exercice_ContactManagement::customercontact_save');
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            $id = $this->getRequest()->getParam('id');
            $model = $this->_model->load($id);

            if ($id && !$model->getId()) {
                $this->messageManager->addError(__('This customer contact no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }

            $model->setData($data);

            try {
                $model->save();
                if ($model->getData('customer_mail') && $model->getData('contact_response')) {
                    $this->sendResponseEmail($model);
                }
                $this->messageManager->addSuccess(__('Customer Contact saved and email sent.'));
                $this->_getSession()->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['id' => $model->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
                $this->_getSession()->setFormData($data);
                return $resultRedirect->setPath('*/*/edit', ['id' => $model->getId()]);
            }
        }
        return $resultRedirect->setPath('*/*/');
    }

    protected function sendResponseEmail($contact)
    {
        $customerEmail = $contact->getData('customer_mail');
        $templateVars = [
            'customer_name' => $contact->getData('customer_name'),
            'contact_creation_at' => $contact->getData('contact_creation_at'),
            'contact_response' => $contact->getData('contact_response')
        ];

        $senderName = $this->_scopeConfig->getValue('trans_email/ident_support/name', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        $senderEmail = $this->_scopeConfig->getValue('trans_email/ident_support/email', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);

        $transport = $this->_transportBuilder
            ->setTemplateIdentifier('Réponse Contact Client')
            ->setTemplateOptions([
                'area' => \Magento\Framework\App\Area::AREA_FRONTEND,
                'store' => $this->_storeManager->getStore()->getId()
            ])
            ->setTemplateVars($templateVars)
            ->setFrom(['name' => $senderName, 'email' => $senderEmail])
            ->addTo($customerEmail)
            ->getTransport();

        $transport->sendMessage();
    }
}
