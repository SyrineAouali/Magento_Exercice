<?php
namespace Exercice\ContactManagement\Model;

use Exercice\ContactManagement\Api\ContactManagementInterface;
use Exercice\ContactManagement\Api\Data\CustomerContactInterface;
use Exercice\ContactManagement\Model\ResourceModel\CustomerContact as ResourceContact;
use Exercice\ContactManagement\Model\CustomerContactFactory;

class ContactManagement implements ContactManagementInterface
{
     protected $customercontactFactory;
     protected $resource;

public function __construct(
    CustomerContactFactory $customercontactFactory,
    ResourceContact $resource
) {
  $this->customercontactFactory = $customercontactFactory;
  $this->resource = $resource;
}

public function saveContact(CustomerContactInterface $customercontactData)
{
   if ($this->contactExists($customercontactData->getCustomerId())) {
    return [
    'success' => false,
    'message' => 'A contact with the same customer ID already exists.'
    ];
    }

    $contact = $this->customercontactFactory->create();
    $contact->setData([
    'customer_id' => $customercontactData->getCustomerId(),
    'customer_name' => $customercontactData->getCustomerName(),
    'customer_mail' => $customercontactData->getCustomerMail(),
    'customer_phone_number' => $customercontactData->getCustomerPhoneNumber(),
    'contact_request' => $customercontactData->getContactRequest(),
    ]);

    try {
    $this->resource->save($contact);
    return [
    'success' => true,
    'message' => 'Contact saved successfully',
    'contact_id' => $contact->getId()
    ];
    } catch (\Exception $exception) {
    return [
    'success' => false,
    'message' => __('Could not save the contact: %1', $exception->getMessage())
    ];
    }
    }

    /**

    * @param int $customerId Customer ID to check.
    * @return bool True if exists, false otherwise.
    */
    private function contactExists($customerId)
    {
    $contact = $this->customercontactFactory->create();
    $this->resource->load($contact, $customerId, 'customer_id');
    return (bool)$contact->getId();
    }
}
