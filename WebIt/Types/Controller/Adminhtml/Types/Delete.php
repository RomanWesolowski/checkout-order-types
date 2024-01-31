<?php
declare(strict_types=1);

namespace WebIt\Types\Controller\Adminhtml\Types;

use Magento\Backend\App\Action;
use WebIt\Types\Model\ResourceModel\Types\CollectionFactory;
use WebIt\Types\Model\ResourceModel\Types as TypesResource;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;
use Exception;

/**
 * Class Delete
 */
class Delete extends Action
{
    /**
     * const string
     */
    const ADMIN_RESOURCE = 'WebIt_Types::delete';

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
     * @throws Exception
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id = $this->getRequest()->getParam('id')) {
            if($item = $this->typesCollFactory->create()->getItemById($id)) {
                $this->typesResource->delete($item);
                try {
                    $this->messageManager->addSuccessMessage(__('The Type has been deleted.'));
                } catch (\Exception $e) {
                    $this->messageManager->addErrorMessage($e->getMessage());
                }
                return $resultRedirect->setPath('*/index/index');
            }
        }
        $this->messageManager->addErrorMessage(__('We can\'t find a Type to delete.'));

        return $resultRedirect->setPath('*/index/index');
    }
}
