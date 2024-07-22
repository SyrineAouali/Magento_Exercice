<?php

namespace Exercice\ContactManagement\Model;

use Magento\Framework\Data\OptionSourceInterface;

class ReasonOptionsProvider implements OptionSourceInterface
{
    protected $reasonCollectionFactory;

    public function __construct(
        \Exercice\ContactManagement\Model\ResourceModel\Reason\CollectionFactory $reasonCollectionFactory
    ) {
        $this->reasonCollectionFactory = $reasonCollectionFactory;
    }

    public function toOptionArray()
    {
        $collection = $this->reasonCollectionFactory->create();
        $options = [];

        foreach ($collection as $reason) {
            $options[] = [
                'value' => $reason->getId(),
                'label' => $reason->getReason()
            ];
        }

        return $options;
    }
}
