<?php
namespace Sunsand\Affiliate\Model\ResourceModel;

class Affiliate extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('affiliate', 'affiliate_id');
    }
}