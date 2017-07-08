<?php
namespace Sunsand\Affiliate\Model\ResourceModel\Affiliate;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Sunsand\Affiliate\Model\Affiliate', 'Sunsand\Affiliate\Model\ResourceModel\Affiliate');
    }
}