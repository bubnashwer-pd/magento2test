<?php

namespace Sunsand\Affiliate\Controller\Adminhtml\Affiliate;

class Edit extends \Sunsand\Affiliate\Controller\Adminhtml\Affiliate
{
    /**
     * Edit Affiliate
     *
     * @return void
     */
    public function execute()
    {
        $model = $this->_objectManager->create('Sunsand\Affiliate\Model\Affiliate');
        $id = $this->getRequest()->getParam('id');
        if ($id) {
            $model->load($id);
        }

        $this->_coreRegistry->register('_affiliate_affiliate', $model);

        $this->_view->loadLayout();
        $this->_setActiveMenu('Sunsand_Affiliate::affiliate');

        if ($model->getId()) {
            $breadcrumbTitle = __('Edit Affiliate');
            $breadcrumbLabel = $breadcrumbTitle;
        } else {
            $breadcrumbTitle = __('New Affiliate');
            $breadcrumbLabel = __('Create  Affiliate');
        }
        $this->_view->getPage()->getConfig()->getTitle()->prepend(__(' Affiliates'));
        $this->_view->getPage()->getConfig()->getTitle()->prepend(
            $model->getId() ? $model->getTemplateId() : __('New Affiliate')
        );

        $this->_addBreadcrumb($breadcrumbLabel, $breadcrumbTitle);

        // restore data
        $values = $this->_getSession()->getData('affiliate_affiliate_form_data', true);
        if ($values) {
            $model->addData($values);
        }

        $this->_view->renderLayout();
    }
}