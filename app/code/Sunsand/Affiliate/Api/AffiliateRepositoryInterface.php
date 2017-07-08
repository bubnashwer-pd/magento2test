<?php

namespace Sunsand\Affiliate\Api;
 
use Magento\Framework\Api\SearchCriteriaInterface;
 
interface AffiliateRepositoryInterface
{ 
    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Sunsand\Affiliate\Api\Data\AffiliateSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria);
}