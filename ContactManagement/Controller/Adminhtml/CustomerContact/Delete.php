<?php
namespace Exercice\ContactManagement\Controller\Adminhtml\CustomerContact;

use Magento\Backend\App\Action;

class Delete extends Action
{
    protected $_model;

    /**
     * @param Action\Context $context
     * @param \Exercice\ContactManagement\Model\CustomerContact $model
     */
    public function __construct(
        Action\Context $context,
        \Exercice\ContactManagement\Model\CustomerContact $model
    ) {
        parent::__construct($context);
        $this->_model = $model;
    }

    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Exercice_ContactManagement::customercontact_delete');
    }

    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            try {
                $model = $this->_model;
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccess(__('Customer Contact deleted'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
                return $resultRedirect->setPath('*/*/delete', ['customer_id' => $id]);
            }
        }
        $this->messageManager->addError(__('Customer Contact does not exist'));
        return $resultRedirect->setPath('*/*/');
    }
}
