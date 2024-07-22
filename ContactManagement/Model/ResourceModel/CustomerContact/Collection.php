<?php
namespace Exercice\ContactManagement\Model\ResourceModel\CustomerContact;

use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    protected $_idFieldName = \Exercice\ContactManagement\Model\CustomerContact::CUSTOMER_ID;

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Exercice\ContactManagement\Model\CustomerContact', 'Exercice\ContactManagement\Model\ResourceModel\CustomerContact');
    }

}
