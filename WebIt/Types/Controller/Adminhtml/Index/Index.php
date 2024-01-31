<?php
declare(strict_types=1);

namespace WebIt\Types\Controller\Adminhtml\Index;

use Magento\Backend\App\Action\Context;
use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\Page;

/**
 * Class Index
 */
class Index extends Action
{
    /**
     * const string
     */
    const ADMIN_RESOURCE = 'WebIt_Types::index';

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * @return ResponseInterface|ResultInterface|Page
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('WebIt_Types::index');
        $resultPage->addBreadcrumb(__('WebIt'), __('Types'));
        $resultPage->getConfig()->getTitle()->prepend(__('Types'));

        return $resultPage;
    }
}

