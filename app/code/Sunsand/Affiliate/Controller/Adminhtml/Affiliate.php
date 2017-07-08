<?php
namespace Sunsand\Affiliate\Controller\Adminhtml;
abstract class Affiliate extends \Magento\Backend\App\AbstractAction
{
    protected $_coreRegistry;
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {parent::__construct($context);
        $this->_coreRegistry = $coreRegistry;
        $this->resultPageFactory = $resultPageFactory;
    }
   /**
     * @return $this
     */
       protected function _initAction()
    {
        $resultPage = $this->resultPageFactory->create();

        return $resultPage;
    }

    /**
     * Retrieve well-formed admin user data from the form input
     *
     * @param array $data
     * @return array
     */
  
    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Sunsand_Affiliate::affiliate');
    }
     
}