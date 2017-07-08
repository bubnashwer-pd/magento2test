<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Sunsand\Affiliate\Controller\Adminhtml\Affiliate;
use Magento\Framework\Controller\ResultFactory;
class Index extends \Sunsand\Affiliate\Controller\Adminhtml\Affiliate
{
    public function executeInternal()
    {
       $resultPage = $this->_initAction();
        $resultPage->getConfig()->getTitle()->prepend(__('Affiliate Memebers'));
        return $resultPage;
    }
    
    /**
     * Index action
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Sunsand_Affiliate::affiliate');
        $resultPage->addBreadcrumb(__('Affiliate'), __('Affiliate'));
        $resultPage->addBreadcrumb(__('Affiliate'), __('Affiliate'));
        $resultPage->getConfig()->getTitle()->prepend(__('Affiliate Members'));
 
        return $resultPage;
    }
}