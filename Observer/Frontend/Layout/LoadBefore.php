<?php

declare(strict_types=1);

namespace LeSite\CustomBar\Observer\Frontend\Layout;

use LeSite\CustomBar\Model\Config;
use LeSite\CustomBar\Model\CustomerBar;
use Magento\Framework\Event\Observer;
use Magento\Framework\Exception\LocalizedException;

/**
 * Set custom bar to top page
 */
class LoadBefore implements \Magento\Framework\Event\ObserverInterface
{

    /**
     * @var Config
     */
    private $config;

    /**
     * @var CustomerBar
     */
    private $customerBar;

    /**
     * @param Config $config
     */
    public function __construct(
        Config                              $config,
        \LeSite\CustomBar\Model\CustomerBar $customerBar
    )
    {
        $this->config = $config;
        $this->customerBar = $customerBar;
    }

    /**
     * @param Observer $observer
     * @return $this
     * @throws LocalizedException
     */
    public function execute(
        Observer $observer
    )
    {
        if ($this->config->isEnabled() && false !== $this->customerBar->getCustomerGroupName()) {
            $layout = $observer->getLayout();
            $layout->getUpdate()->addHandle('default_custombar_section');
        }
        return $this;
    }
}

