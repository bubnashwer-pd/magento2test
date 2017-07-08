<?php

namespace Sunsand\Affiliate\Model\ResourceModel\Affiliate\Grid;

class Statuslist implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * Return statuses option array
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            1 => __('Enabled'),
            0 => __('Disabled')
        ];
    }
}
