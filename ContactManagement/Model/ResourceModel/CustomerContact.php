<?php
namespace Exercice\ContactManagement\Model\ResourceModel;

use \Magento\Framework\Model\ResourceModel\Db\AbstractDb;


class CustomerContact extends AbstractDb
{

    protected function _construct()
    {
        $this->_init('customer_contact', 'customer_id');
    }

}
