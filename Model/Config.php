<?php

declare(strict_types=1);

namespace LeSite\CustomBar\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

/**
 * Config Model
 */
class Config extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Extension enabled config path
     */
    const XML_PATH_EXTENSION_ENABLED = 'custombar/options/enable';

    /**
     * @var ScopeConfigInterface
     */
    private ScopeConfigInterface $scopeConfig;

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry      $registry,
        ScopeConfigInterface             $scopeConfig
    )
    {
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context, $registry);
    }

    /**
     * @return bool
     */
    public function isEnabled()
    {
        return (bool)$this->scopeConfig->getValue(
            self::XML_PATH_EXTENSION_ENABLED,
            ScopeInterface::SCOPE_STORE);
    }
}
