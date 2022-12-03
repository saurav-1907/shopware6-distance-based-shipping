<?php declare(strict_types=1);

namespace Magmodules\DistanceBasedShippingCost\Subscriber;

use Magmodules\DistanceBasedShippingCost\Core\Content\MagmodulesDistanceBasedShippingCost\MagmodulesDistanceBasedShippingCostConstants;
use Magmodules\DistanceBasedShippingCost\Core\Content\MagmodulesDistanceBasedShippingCost\MagmodulesDistanceBasedShippingCostEntity;
use Magmodules\DistanceBasedShippingCost\Helper\AddressHelper;
use Magmodules\DistanceBasedShippingCost\Helper\UnitRoundingHelper;
use Magmodules\DistanceBasedShippingCost\Service\ConfigService;
use Magmodules\DistanceBasedShippingCost\Service\GoogleMapsApiService;
use Shopware\Storefront\Page\Checkout\Confirm\CheckoutConfirmPageLoadedEvent;
use Shopware\Storefront\Page\PageLoadedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class CheckoutConfirmPageLoadedEventSubscriber implements EventSubscriberInterface
{
    private ConfigService $configService;

    private GoogleMapsApiService $gmapsApiService;

    public function __construct(
        ConfigService        $configService,
        GoogleMapsApiService $gmapsApiService
    ) {
        $this->configService = $configService;
        $this->gmapsApiService = $gmapsApiService;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            CheckoutConfirmPageLoadedEvent::class => ['addDistanceToPage', 500]
        ];
    }

    /**
     * @param PageLoadedEvent|CheckoutConfirmPageLoadedEvent $event
     * @return void
     */
    public function addDistanceToPage($event): void
    {
        try {
            $config = $this->configService->getValidConfig($event->getContext());
            if ($config->getShippingMethodId() === $event->getSalesChannelContext()->getShippingMethod()->getId()) {
                $distanceInMeters = $this->gmapsApiService->getDistanceInMeters(
                    $config->getGoogleMapsApiKey(),
                    $config->getStoreAddress(),
                    AddressHelper::getShippingAddressAsStr($event->getSalesChannelContext()->getShippingLocation()->getAddress())
                );

                $distanceLabel = sprintf("%s %s", $this->getDistanceLabel($config, $distanceInMeters),
                    $this->getMetricLabel($config)
                );

                $data['distanceBasedShippingCostData'] = [
                    'shippingMethodId' => $config->getShippingMethodId(),
                    'distanceLabel' => "($distanceLabel)",
                ];

                $event->getPage()->assign($data);
            }
        } catch (\Exception $e) {
            $config = $this->configService->getUnvalidatedConfig($event->getContext());

            if ($config && $config->getShippingMethodId() === $event->getSalesChannelContext()->getShippingMethod()->getId()) {
                $data['distanceBasedShippingCostData'] = [
                    'shippingMethodId' => $config->getShippingMethodId(),
                    'distanceLabel' => "(error)",
                ];

                $event->getPage()->assign($data);
            }
        }
    }

    private function getDistanceLabel(MagmodulesDistanceBasedShippingCostEntity $config, float $distanceInMeters): float
    {
        $distance = $config->getMetric() === MagmodulesDistanceBasedShippingCostConstants::METRIC_KM
            ? $distanceInMeters * MagmodulesDistanceBasedShippingCostConstants::METRIC_KM_MULTIPLIER
            : $distanceInMeters * MagmodulesDistanceBasedShippingCostConstants::METRIC_MI_MULTIPLIER;

        return UnitRoundingHelper::getRoundedUnit($distance, (string)$config->getRoundDistance());
    }

    private function getMetricLabel(MagmodulesDistanceBasedShippingCostEntity $config): string
    {
        return $config->getMetric() === MagmodulesDistanceBasedShippingCostConstants::METRIC_KM
            ? MagmodulesDistanceBasedShippingCostConstants::METRIC_KM_STR
            : MagmodulesDistanceBasedShippingCostConstants::METRIC_MI_STR;
    }
}
