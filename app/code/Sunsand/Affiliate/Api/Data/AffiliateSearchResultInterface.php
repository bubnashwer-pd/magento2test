<?php
 
namespace Sunsand\Affiliate\Api\Data;
 
use Magento\Framework\Api\SearchResultsInterface;
 
interface AffiliateSearchResultInterface extends SearchResultsInterface
{
    /**
     * @return \Sunsand\Affiliate\Api\Data\AffiliateInterface[]
     */
    public function getItems();
 
    /**
     * @param \Sunsand\Affiliate\Api\Data\AffiliateInterface[] $items
     * @return void
     */
    public function setItems(array $items);
}