<?php
namespace Exercice\ContactManagement\Model\ResourceModel;

class Reason extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('exercice_contactmanagement_customer_reason', 'entity_id');
    }
}
