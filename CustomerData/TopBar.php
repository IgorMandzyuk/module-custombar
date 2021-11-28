<?php

declare(strict_types=1);

namespace LeSite\CustomBar\CustomerData;

use LeSite\CustomBar\Model\CustomerBar;
use Magento\Customer\CustomerData\SectionSourceInterface;
use Magento\Framework\Exception\LocalizedException;

class TopBar implements SectionSourceInterface
{

    /**
     * @var CustomerBar
     */
    private $customerBar;

    /**
     * @param CustomerBar $customerBar
     */
    public function __construct(
        CustomerBar $customerBar
    )
    {
        $this->customerBar = $customerBar;
    }

    /**
     * @return array
     * @throws LocalizedException
     */
    public function getSectionData()
    {
        $customerGroupTitle = $this->customerBar->getCustomerGroupName();
        return ['customerData' => $customerGroupTitle];
    }
}

