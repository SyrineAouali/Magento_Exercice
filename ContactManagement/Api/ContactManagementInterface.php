<?php
namespace Exercice\ContactManagement\Api;

use Exercice\ContactManagement\Api\Data\CustomerContactInterface;

interface ContactManagementInterface
{
    /**
     * Save contact
     *
     * @param \Exercice\ContactManagement\Api\Data\CustomerContactInterface $contact
     * @return \Exercice\ContactManagement\Api\Data\CustomerContactInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function saveContact(CustomerContactInterface $contact);
}
