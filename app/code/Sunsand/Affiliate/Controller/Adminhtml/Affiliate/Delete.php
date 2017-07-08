<?php

namespace Sunsand\Affiliate\Controller\Adminhtml\Affiliate;

class Delete extends \Sunsand\Affiliate\Controller\Adminhtml\Affiliate
{
    /**
     * Delete affiliate member
     *
     * @return void
     */
    public function execute()
    {
        $template = $this->_objectManager->create(
            'Sunsand\Affiliate\Model\Affiliate'
        )->load(
            $this->getRequest()->getParam('id')
        );
        if ($template->getId()) {
            try {
                $template->delete();
                $this->messageManager->addSuccess(__('The affiliate member has been deleted.'));
                $this->_getSession()->setFormData(false);
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('We can\'t delete this template right now.'));
            }
        }
        $this->_redirect('*/affiliate');
    }
}
