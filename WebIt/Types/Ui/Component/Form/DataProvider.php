<?php
declare(strict_types=1);

namespace WebIt\Types\Ui\Component\Form;

use Magento\Ui\DataProvider\AbstractDataProvider;
use WebIt\Types\Model\ResourceModel\Types\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Backend\Model\Session;

/**
 * Class DataProvider
 */
class DataProvider extends AbstractDataProvider
{
    /**
     * @var Session
     */
    protected $session;

    /**
     * @var array
     */
    protected $loadedData;

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param Session $session
     * @param CollectionFactory $collectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        Session $session,
        CollectionFactory $collectionFactory,
        DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = []
    ) {
        $this->session = $session;
        $this->collection = $collectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * @return array
     */
    public function getData(): array
    {
       $id = $this->session->getTypesId();
       $this->loadedData = [];

       if ($id) {
           $item = $this->collection->getItemById($id);
           if ($item) {
               $this->loadedData[$item->getId()] = $item->getData();
           }
       }

        return $this->loadedData;
    }
}
