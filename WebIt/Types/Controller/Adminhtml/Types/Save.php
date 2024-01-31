<?php
declare(strict_types=1);

namespace WebIt\Types\Controller\Adminhtml\Types;

use Magento\Backend\App\Action;
use WebIt\Types\Model\ResourceModel\Types\CollectionFactory;
use WebIt\Types\Model\ResourceModel\Types as TypesResource;
use Exception;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;

/**
 * Class Save
 */
class Save extends Action
{
    /**
     * const string
     */
    const ADMIN_RESOURCE = 'WebIt_Types::save';

    /**
     * @var CollectionFactory
     */
    protected $typesCollFactory;

    /**
     * @var TypesResource
     */
    protected $typesResource;

    /**
     * @param TypesResource $typesResource
     * @param CollectionFactory $typesCollFactory
     * @param Action\Context $context
     */
    public function __construct(
        TypesResource $typesResource,
        CollectionFactory $typesCollFactory,
        Action\Context $context
    ) {
        $this->typesResource = $typesResource;
        $this->typesCollFactory = $typesCollFactory;
        parent::__construct($context);
    }

    /**
     * @return ResponseInterface|Redirect|ResultInterface
     */
    public function execute()
    {
        $post = $this->getRequest()->getParams();
        $resultRedirect = $this->resultRedirectFactory->create();
        $id = $this->getRequest()->getParam('id');
        $collection = $this->typesCollFactory->create();

        if (!$item = $collection->getItemById($id)) {
            $item = $collection->getNewEmptyItem();
        }

        try {
            $item->setName($post['name']);
            $this->typesResource->save($item);
            $this->messageManager->addSuccessMessage(__('Saved successfully.'));
        } catch (Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        }

        return $resultRedirect->setPath('*/index/index');
    }
}
