<?php
namespace Sunsand\Affiliate\Api;
 
interface AffiliateSearchResultInterface
{
    /**
     * @return \Sunsand\Affiliate\Api\Data\HamburgerInterface[]
     */
    public function getItems();
 
    /**
     * @param \Sunsand\Affiliate\Api\Data\HamburgerInterface[] $items
     * @return void
     */
    public function setItems(array $items);
}