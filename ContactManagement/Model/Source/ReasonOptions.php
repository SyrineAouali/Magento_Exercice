<?php
namespace Exercice\ContactManagement\Model\Source;

use Magento\Framework\Option\ArrayInterface;
use Exercice\ContactManagement\Model\ReasonFactory;

class ReasonOptions implements ArrayInterface
{
    protected $reasonFactory;

    public function __construct(
        ReasonFactory $reasonFactory
    ) {
        $this->reasonFactory = $reasonFactory;
    }

    public function toOptionArray()
    {
        $options = [];
        $reasons = $this->reasonFactory->create()->getCollection();
        foreach ($reasons as $reason) {
            $options[] = [
                'value' => $reason->getId(),
                'label' => $reason->getReasonLabel() // Assurez-vous d'avoir une méthode pour obtenir le libellé de la raison
            ];
        }
        return $options;
    }
}
