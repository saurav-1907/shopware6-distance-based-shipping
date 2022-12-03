<?php declare(strict_types=1);

namespace Magmodules\DistanceBasedShippingCost\Service;

use Magmodules\DistanceBasedShippingCost\Core\Content\MagmodulesDistanceBasedShippingCost\MagmodulesDistanceBasedShippingCostEntity;
use Magmodules\DistanceBasedShippingCost\Exception\InvalidDistanceBasedShippingCostConfigException;
use Shopware\Core\Framework\Context;
use Shopware\Core\Framework\DataAbstractionLayer\EntityRepositoryInterface;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;

class ConfigService
{
    private EntityRepositoryInterface $configRepo;

    public function __construct(
        EntityRepositoryInterface $configRepo
    ) {
        $this->configRepo = $configRepo;
    }

    public function getUnvalidatedConfig(Context $context): ?MagmodulesDistanceBasedShippingCostEntity
    {
        return $this->getConfig($context);
    }

    /**
     * @throws \Magmodules\DistanceBasedShippingCost\Exception\InvalidDistanceBasedShippingCostConfigException
     */
    public function getValidConfig(Context $context): MagmodulesDistanceBasedShippingCostEntity
    {
        $config = $this->getConfig($context);

        $this->validate($config);

        return $config;
    }

    private function getConfig(Context $context): ?MagmodulesDistanceBasedShippingCostEntity
    {
        return $this->configRepo->search(new Criteria(), $context)->first();
    }

    /**
     * @throws \Magmodules\DistanceBasedShippingCost\Exception\InvalidDistanceBasedShippingCostConfigException
     */
    private function validate(?MagmodulesDistanceBasedShippingCostEntity $config): void
    {
        if (!$config instanceof MagmodulesDistanceBasedShippingCostEntity) {
            throw new InvalidDistanceBasedShippingCostConfigException();
        }

        if (empty($config->getGoogleMapsApiKey())) {
            throw new InvalidDistanceBasedShippingCostConfigException("Google Maps API key is not set");
        }

        if (empty($config->getShippingMethodId())) {
            throw new InvalidDistanceBasedShippingCostConfigException("Shipping Method is not set");
        }

        if (empty($config->getStoreAddress())) {
            throw new InvalidDistanceBasedShippingCostConfigException("Store Address is not set");
        }
    }
}
