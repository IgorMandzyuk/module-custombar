<?php

namespace LeSite\CustomBar\Model;

use Magento\Customer\Api\GroupRepositoryInterface;
use Magento\Customer\Model\Session;
use Magento\Framework\Data\Collection\AbstractDb;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Model\Context;
use Magento\Framework\Model\ResourceModel\AbstractResource;
use Magento\Framework\Registry;
use Psr\Log\LoggerInterface;

/**
 * Customer Bar Model
 */
class CustomerBar extends AbstractModel
{

    /**
     * @var Session
     */
    protected $customerSession;

    /**
     * @var GroupRepositoryInterface
     */
    private $groupRepository;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param Session $customerSession
     * @param GroupRepositoryInterface $groupRepository
     * @param LoggerInterface $logger
     * @param Context $context
     * @param Registry $registry
     * @param AbstractResource|null $resource
     * @param AbstractDb|null $resourceCollection
     * @param array $data
     */
    public function __construct(
        Session                  $customerSession,
        GroupRepositoryInterface $groupRepository,
        LoggerInterface          $logger,
        Context                  $context,
        Registry                 $registry,
        AbstractResource         $resource = null,
        AbstractDb               $resourceCollection = null,
        array                    $data = []
    )
    {
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
        $this->customerSession = $customerSession;
        $this->groupRepository = $groupRepository;
        $this->logger = $logger;
    }

    /**
     * @return int|null
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getCustomerGroupName()
    {
        $customerGroupTitle = 'NOT LOGGED IN';
        if ($this->customerSession->isLoggedIn()) {
            try {
                $groupId = $this->customerSession->getCustomer()->getGroupId();
                $group = $this->groupRepository->getById($groupId);
                $customerGroupTitle = $group->getCode();
            } catch (NoSuchEntityException $noSuchEntityException) {
                $this->logger->error($noSuchEntityException);
                $customerGroupTitle = false;
            }
        }
        return $customerGroupTitle;
    }
}
