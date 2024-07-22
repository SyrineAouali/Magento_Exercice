<?php
namespace Exercice\ContactManagement\Api\Data;

interface CustomerContactInterface
{
    /**
     * Get customer ID
     *
     * @return int|null
     */
    public function getCustomerId();

    /**
     * Set customer ID
     *
     * @param int $customerId
     * @return void
     */
    public function setCustomerId($customerId);

    /**
     * Get customer name
     *
     * @return string
     */
    public function getCustomerName();

    /**
     * Set customer name
     *
     * @param string $customerName
     * @return void
     */
    public function setCustomerName($customerName);

    /**
     * Get customer email
     *
     * @return string
     */
    public function getCustomerMail();

    /**
     * Set customer email
     *
     * @param string $customerMail
     * @return void
     */
    public function setCustomerMail($customerMail);

    /**
     * Get customer phone number
     *
     * @return string
     */
    public function getCustomerPhoneNumber();

    /**
     * Set customer phone number
     *
     * @param string $customerPhoneNumber
     * @return void
     */
    public function setCustomerPhoneNumber($customerPhoneNumber);

    /**
     * Get contact reason
     *
     * @return string
     */
    public function getContactReason();

    /**
     * Set contact reason
     *
     * @param string $contactReason
     * @return void
     */
    public function setContactReason($contactReason);

    /**
     * Get contact request
     *
     * @return string
     */
    public function getContactRequest();

    /**
     * Set contact request
     *
     * @param string $contactRequest
     * @return void
     */
    public function setContactRequest($contactRequest);

    /**
     * Get contact response
     *
     * @return string
     */
    public function getContactResponse();

    /**
     * Set contact response
     *
     * @param string $contactResponse
     * @return void
     */
    public function setContactResponse($contactResponse);

    /**
     * Get contact creation date
     *
     * @return string
     */
    public function getContactCreationAt();

    /**
     * Set contact creation date
     *
     * @param string $contactCreationAt
     * @return void
     */
    public function setContactCreationAt($contactCreationAt);

    /**
     * Get contact update date
     *
     * @return string
     */
    public function getContactUpdatedAt();

    /**
     * Set contact update date
     *
     * @param string $contactUpdatedAt
     * @return void
     */
    public function setContactUpdatedAt($contactUpdatedAt);
}
