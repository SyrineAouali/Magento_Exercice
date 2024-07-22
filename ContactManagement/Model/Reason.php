<?php
namespace Exercice\ContactManagement\Model;

class Reason extends \Magento\Framework\Model\AbstractModel
{
    protected function _construct()
    {
        $this->_init('Exercice\ContactManagement\Model\ResourceModel\Reason');
    }
    public function getId()
    {
        return $this->getData('entity_id');
    }
    public function getReason()
    {
        return $this->getData('reason');
    }
}
