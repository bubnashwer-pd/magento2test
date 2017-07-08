<?php
namespace Sunsand\Affiliate\Model;
use Magento\Framework\Exception\LocalizedException as CoreException;
class Affiliate extends \Magento\Framework\Model\AbstractModel
{
	
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Sunsand\Affiliate\Model\ResourceModel\Affiliate');
    }
}