<?php
namespace Exercice\ContactManagement\Block;

class RaisonList extends \Magento\Framework\View\Element\Template
{
    protected $_raisonCollectionFactory;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Exercice\ContactManagement\Model\ResourceModel\Reason\CollectionFactory $raisonCollectionFactory,
        array $data = []
    ) {
        $this->_raisonCollectionFactory = $raisonCollectionFactory;
        parent::__construct($context, $data);
    }

    public function getRaisons()
    {
        $collection = $this->_raisonCollectionFactory->create();
        return $collection->load();
    }
}
