<?php
namespace Exercice\ContactManagement\Model;

use \Magento\Framework\Model\AbstractModel;

class CustomerContact extends AbstractModel implements \Exercice\ContactManagement\Api\Data\CustomerContactInterface
{
    const CUSTOMER_ID = 'customer_id';
    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'contact_management';

    /**
     * Name of the event object
     *
     * @var string
     */
    protected $_eventObject = 'customer_contact';

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_idFieldName = self::CUSTOMER_ID;

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Exercice\ContactManagement\Model\ResourceModel\CustomerContact');
    }

    public function getEntityId()
    {
        return $this->getData('entity_id');
    }

    public function setEntityId($entityId)
    {
        return $this->setData('entity_id', $entityId);
    }

    public function getCustomerId()
    {
        return $this->getData('customer_id');
    }

    public function setCustomerId($customerId)
    {
        return $this->setData('customer_id', $customerId);
    }

    public function getCustomerName()
    {
        return $this->getData('customer_name');
    }

    public function setCustomerName($customerName)
    {
        return $this->setData('customer_name', $customerName);
    }

    public function getCustomerMail()
    {
        return $this->getData('customer_mail');
    }

    public function setCustomerMail($customerMail)
    {
        return $this->setData('customer_mail', $customerMail);
    }

    public function getCustomerPhoneNumber()
    {
        return $this->getData('customer_phone_number');
    }

    public function setCustomerPhoneNumber($customerPhoneNumber)
    {
        return $this->setData('customer_phone_number', $customerPhoneNumber);
    }

    public function getContactReason()
    {
        return $this->getData('contact_reason');
    }

    public function setContactReason($contactReason)
    {
        return $this->setData('contact_reason', $contactReason);
    }

    public function getContactRequest()
    {
        return $this->getData('contact_request');
    }

    public function setContactRequest($contactRequest)
    {
        return $this->setData('contact_request', $contactRequest);
    }

    public function getContactResponse()
    {
        return $this->getData('contact_response');
    }

    public function setContactResponse($contactResponse)
    {
        return $this->setData('contact_response', $contactResponse);
    }

    public function getContactCreationAt()
    {
        return $this->getData('contact_creation_at');
    }

    public function setContactCreationAt($contactCreationAt)
    {
        return $this->setData('contact_creation_at', $contactCreationAt);
    }

    public function getContactUpdatedAt()
    {
        return $this->getData('contact_updated_at');
    }

    public function setContactUpdatedAt($contactUpdatedAt)
    {
        return $this->setData('contact_updated_at', $contactUpdatedAt);
    }

}
