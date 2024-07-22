<?php
namespace Exercice\ContactManagement\Model\Reason;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Exercice\ContactManagement\Model\ResourceModel\Reason\CollectionFactory;

class DataProvider extends AbstractDataProvider
{
    /**
     * Constructeur de la classe DataProvider.
     *
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * Préparation des données pour le formulaire.
     *
     * @return array
     */
    public function getData()
    {
        $items = $this->collection->getItems();
        $result = [];

        foreach ($items as $item) {
            // Dans ce contexte, $item->getData() renvoie les données de l'entité qui doivent être affichées dans le formulaire.
            $result[$item->getId()] = $item->getData();
        }

        return $result;
    }
}
