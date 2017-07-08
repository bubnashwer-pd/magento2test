<?php

namespace Sunsand\Affiliate\Controller\Adminhtml\Affiliate;

class NewAction extends \Sunsand\Affiliate\Controller\Adminhtml\Affiliate
{
    /**
     * Create new Newsletter Template
     *
     * @return void
     */
    public function execute()
    {
        $this->_forward('edit');
    }
}