<?php
namespace Exercice\ContactManagement\Model\ResourceModel\Reason;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'entity_id';
    protected $_eventPrefix = 'exercice_contactmanagement_reason_collection';
    protected $_eventObject = 'reason_collection';

    protected function _construct()
    {
        $this->_init(
            \Exercice\ContactManagement\Model\Reason::class,
            \Exercice\ContactManagement\Model\ResourceModel\Reason::class
        );
    }
}
