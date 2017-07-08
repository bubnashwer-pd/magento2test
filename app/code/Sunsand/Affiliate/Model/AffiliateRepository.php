<?php
 
namespace Sunsand\Affiliate\Model;
 
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Exception\NoSuchEntityException;
use Sunsand\Affiliate\Api\Data\AffiliateInterface;
use Sunsand\Affiliate\Api\Data\AffiliateSearchResultInterface;
use Sunsand\Affiliate\Api\Data\AffiliateSearchResultInterfaceFactory;
use Sunsand\Affiliate\Api\AffiliateRepositoryInterface;
use Sunsand\Affiliate\Model\ResourceModel\Affiliate\CollectionFactory as AffiliateCollectionFactory;
use Sunsand\Affiliate\Model\ResourceModel\Affiliate\Collection;
 
class AffiliateRepository implements AffiliateRepositoryInterface
{
    /**
     * @var Affiliate
     */
    private $affiliateFactory;
 
    /**
     * @var AffiliateCollectionFactory
     */
    private $affiliateCollectionFactory;
     
    /**
     * @var AffiliateSearchResultInterfaceFactory
     */
    private $searchResultFactory;
 
    public function __construct(
        Affiliate $affiliateFactory,
        AffiliateCollectionFactory $affiliateCollectionFactory,
        AffiliateSearchResultInterfaceFactory $affiliateSearchResultInterfaceFactory
    ) {
        $this->affiliateFactory = $affiliateFactory;
        $this->affiliateCollectionFactory = $affiliateCollectionFactory;
        $this->searchResultFactory = $affiliateSearchResultInterfaceFactory;
    }
 
    // ... getById, save and delete methods listed above ...
 
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->affiliateCollectionFactory->create();
 
        $this->addFiltersToCollection($searchCriteria, $collection);
        $this->addSortOrdersToCollection($searchCriteria, $collection);
        $this->addPagingToCollection($searchCriteria, $collection);
 
        $collection->load();
 
        return $this->buildSearchResult($searchCriteria, $collection);
    }
    
    
    private function addFiltersToCollection(SearchCriteriaInterface $searchCriteria, Collection $collection)
    {
        foreach ($searchCriteria->getFilterGroups() as $filterGroup) {
            $fields = $conditions = [];
            foreach ($filterGroup->getFilters() as $filter) {
                $fields[] = $filter->getField();
                $conditions[] = [$filter->getConditionType() => $filter->getValue()];
            }
            $collection->addFieldToFilter($fields, $conditions);
        }
    }
 
    private function addSortOrdersToCollection(SearchCriteriaInterface $searchCriteria, Collection $collection)
    {
        foreach ((array) $searchCriteria->getSortOrders() as $sortOrder) {
            $direction = $sortOrder->getDirection() == SortOrder::SORT_ASC ? 'asc' : 'desc';
            $collection->addOrder($sortOrder->getField(), $direction);
        }
    }
 
    private function addPagingToCollection(SearchCriteriaInterface $searchCriteria, Collection $collection)
    {
        $collection->setPageSize($searchCriteria->getPageSize());
        $collection->setCurPage($searchCriteria->getCurrentPage());
    }
 
    private function buildSearchResult(SearchCriteriaInterface $searchCriteria, Collection $collection)
    {
        $searchResults = $this->searchResultFactory->create();
 
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
 
        return $searchResults;
    }
}