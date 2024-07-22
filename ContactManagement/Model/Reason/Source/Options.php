<?php
namespace Exercice\ContactManagement\Model\Reason\Source;

use Magento\Framework\Data\OptionSourceInterface;
use Exercice\ContactManagement\Model\ResourceModel\Reason\CollectionFactory;

class Options implements OptionSourceInterface
{
    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * Constructor
     *
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(CollectionFactory $collectionFactory)
    {
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        $collection = $this->collectionFactory->create();
        $options = [];

        foreach ($collection as $reason) {
            $options[] = [
                'label' => $reason->getId(),
                'value' => $reason->getReason()
            ];
        }

        return $options;
    }
}
