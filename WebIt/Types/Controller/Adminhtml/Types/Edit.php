<?php
declare(strict_types=1);

namespace WebIt\Types\Controller\Adminhtml\Types;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Registry;
use WebIt\Types\Model\ResourceModel\Types\CollectionFactory;
use Magento\Framework\View\Result\Page;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;

/**
 * Class Edit
 */
class Edit extends Action
{
    /**
     * const string
     */
    const ADMIN_RESOURCE = 'WebIt_Types::save';

    /**
     * @var Registry|null
     */
    protected $_coreRegistry = null;

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var CollectionFactory
     */
    protected $typesCollFactory;

    /**
     * @param CollectionFactory $collectionFactory
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param Registry $registry
     */
    public function __construct(
        CollectionFactory $collectionFactory,
        Context $context,
        PageFactory $resultPageFactory,
        Registry $registry
    ) {
        $this->typesCollFactory = $collectionFactory;
        $this->resultPageFactory = $resultPageFactory;
        $this->_coreRegistry = $registry;
        parent::__construct($context);
    }

    /**
     * @return Page
     */
    protected function _initAction(): Page
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('WebIt_Types::index');

        return $resultPage;
    }

    /**
     * @return ResponseInterface|Redirect|ResultInterface|Page
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $collection = $this->typesCollFactory->create();

        if ($id) {
            $item = $collection->getItemById($id);
            if (!$item) {
                $this->messageManager->addErrorMessage(__('This item no longer exists.'));
                $resultRedirect = $this->resultRedirectFactory->create();

                return $resultRedirect->setPath('*/index/index');
            }
        } else {
            $item = $collection->getNewEmptyItem();
        }

        $data = $this->_session->getFormData(true);
        $this->_session->setTypesId($item->getId());
        if (!empty($data)) {
            $item->setData($data);
        }

        $this->_coreRegistry->register('webit_types', $item);

        $resultPage = $this->_initAction();
        $resultPage->addBreadcrumb(
            $id ? __('Edit Types') : __('New Types'),
            $id ? __('Edit Types') : __('New Types')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Types'));
        $resultPage->getConfig()->getTitle()
                   ->prepend($item->getId() ? $item->getName() : __('New Type'));

        return $resultPage;
    }
}
