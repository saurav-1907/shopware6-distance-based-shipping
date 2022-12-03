<?php declare(strict_types=1);

namespace Magmodules\DistanceBasedShippingCost\Service;

use Magmodules\DistanceBasedShippingCost\Core\Content\MagmodulesDistanceBasedShippingCost\MagmodulesDistanceBasedShippingCostConstants;
use Magmodules\DistanceBasedShippingCost\Core\Content\MagmodulesDistanceBasedShippingCost\MagmodulesDistanceBasedShippingCostEntity;
use Magmodules\DistanceBasedShippingCost\Core\Content\MagmodulesDistanceBasedShippingCostMatrix\MagmodulesDistanceBasedShippingCostMatrixEntity;
use Magmodules\DistanceBasedShippingCost\Exception\GoogleMapsApiResponseException;
use Magmodules\DistanceBasedShippingCost\Exception\InvalidDistanceBasedShippingCostConfigException;
use Magmodules\DistanceBasedShippingCost\Helper\AddressHelper;
use Magmodules\DistanceBasedShippingCost\Helper\UnitConverter;
use Magmodules\DistanceBasedShippingCost\Helper\UnitRoundingHelper;
use Shopware\Core\Checkout\Customer\Aggregate\CustomerAddress\CustomerAddressEntity;
use Shopware\Core\Framework\Context;
use Shopware\Core\Framework\DataAbstractionLayer\EntityRepositoryInterface;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;

class ShippingPriceCalculator
{
    private EntityRepositoryInterface $priceMatrixRepo;

    private GoogleMapsApiService $mapsApiService;

    private ConfigService $configService;

    public function __construct(
        ConfigService             $configService,
        EntityRepositoryInterface $priceMatrixRepo,
        GoogleMapsApiService      $mapsApiService
    )
    {
        $this->configService = $configService;
        $this->priceMatrixRepo = $priceMatrixRepo;
        $this->mapsApiService = $mapsApiService;
    }

    public function calculateForAddress(CustomerAddressEntity $customerAddress, Context $context): float
    {
        try {
            $config = $this->configService->getValidConfig($context);
            $distanceInMeters = $this->getDistanceInMeters($config, $customerAddress, $context);
            $distanceInChosenMetric = $this->convertFromMeter($config->getMetric(), $distanceInMeters);

            $price = $this->determinePriceViaMatrix($distanceInChosenMetric, $context);

            return UnitRoundingHelper::getRoundedUnit($price, (string)$config->getRoundTotalPrice());
        } catch (InvalidDistanceBasedShippingCostConfigException|GoogleMapsApiResponseException $e) {
            // let event subscriber handle showing the error indicator
            return 0; // TODO: should we default to 0 if error occurred?
        }
    }

    /**
     * @throws \Magmodules\DistanceBasedShippingCost\Exception\GoogleMapsApiResponseException
     */
    private function getDistanceInMeters(MagmodulesDistanceBasedShippingCostEntity $config, CustomerAddressEntity $customerAddress, Context $context): ?float
    {
        $shippingAddressStr = AddressHelper::getShippingAddressAsStr($customerAddress);
        $storeAddressStr = $config->getStoreAddress();

        return $this->mapsApiService->getDistanceInMeters(
            $config->getGoogleMapsApiKey(),
            $storeAddressStr,
            $shippingAddressStr
        );
    }

    private function convertFromMeter(int $metric, float $distanceInMeters): float
    {
        $convertedDistance = 0;
        switch ($metric) {
            case MagmodulesDistanceBasedShippingCostConstants::METRIC_KM:
                $convertedDistance = $distanceInMeters * MagmodulesDistanceBasedShippingCostConstants::METRIC_KM_MULTIPLIER;
                break;
            case MagmodulesDistanceBasedShippingCostConstants::METRIC_MI:
                $convertedDistance = $distanceInMeters * MagmodulesDistanceBasedShippingCostConstants::METRIC_MI_MULTIPLIER;
                break;
        }

        return $convertedDistance;
    }

    private function determinePriceViaMatrix(float $distanceInMetric, Context $context): float
    {
        $price = 0.00;
        $zones = $this->priceMatrixRepo->search(new Criteria(), $context);

        foreach ($zones as $zone) {
//            dd($zone);
            /** @var MagmodulesDistanceBasedShippingCostMatrixEntity $zone * */
            if ($zone->getType() === MagmodulesDistanceBasedShippingCostMatrixEntity::TYPE_FIXED
                && ($zone->getFrom() <= $distanceInMetric && $zone->getTo() >= $distanceInMetric)
            ) {
                $price += $zone->getPrice();
            } elseif ($zone->getType() === MagmodulesDistanceBasedShippingCostMatrixEntity::TYPE_PER_METRIC
                && ($zone->getFrom() <= $distanceInMetric && $zone->getTo() >= $distanceInMetric)
            ) {
                $price += $zone->getPrice() * $distanceInMetric;
            }
        }

        return $price;
    }


}
