<?php

namespace Magmodules\DistanceBasedShippingCost\Test\Service;

use Magmodules\DistanceBasedShippingCost\Exception\GoogleMapsApiResponseException;
use Magmodules\DistanceBasedShippingCost\Service\GoogleMapsApiService;
use PHPUnit\Framework\TestCase;
use Shopware\Core\Framework\Test\TestCaseBase\KernelTestBehaviour;

class GoogleMapsApiServiceTest extends TestCase
{
    use KernelTestBehaviour;

    public function testGetDistanceInMetersThrowsErrorOnInvalidOrigin(): void
    {
        $this->expectException(GoogleMapsApiResponseException::class);

        $service = $this->getContainer()->get(GoogleMapsApiService::class);

        $service->getDistanceInMeters(
            getenv('TEST_GOOGLE_MAPS_API_KEY'),
            '',
            'Amtsstraße 21, 48624, Schöppingen, Germany'
        );
    }

    public function testGetDistanceInMetersThrowsErrorOnInvalidDestination(): void
    {
        $this->expectException(GoogleMapsApiResponseException::class);

        $service = $this->getContainer()->get(GoogleMapsApiService::class);

        $service->getDistanceInMeters(
            getenv('TEST_GOOGLE_MAPS_API_KEY'),
            'Amtsstraße 21, 48624, Schöppingen, Germany',
            '',
        );
    }

    public function testGetDistanceInMetersIsGreaterThenZeroIfSuccessful(): void
    {
        $service = $this->getContainer()->get(GoogleMapsApiService::class);

        $distanceInMeters = $service->getDistanceInMeters(
            getenv('TEST_GOOGLE_MAPS_API_KEY'),
            'Metelen, 48629, Germany',
            'Amtsstraße 21, 48624, Schöppingen, Germany'
        );

        self::assertGreaterThan(0, $distanceInMeters);
    }
}
