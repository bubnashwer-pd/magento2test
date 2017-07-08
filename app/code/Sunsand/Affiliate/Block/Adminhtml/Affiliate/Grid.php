<?php

namespace Sunsand\Affiliate\Block\Adminhtml\Affiliate;

class Grid extends \Magento\Backend\Block\Widget\Grid\Container
{
    protected function _construct()
    {
        $this->_blockGroup = 'Sunsand_Affiliate';
        $this->_controller = 'adminhtml_affiliate';
        $this->_headerText = __('Affiliate');
        $this->_addButtonLabel = __('Add New Affiliate');
        parent::_construct();
        $this->buttonList->add(
            'affiliate_apply',
            [
                'label' => __('Affiliate'),
                'onclick' => "location.href='" . $this->getUrl('affiliate/*/applyAffiliate') . "'",
                'class' => 'apply'
            ]
        );
    }
}