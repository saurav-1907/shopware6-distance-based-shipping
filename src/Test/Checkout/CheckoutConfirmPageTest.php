<?php

namespace Magmodules\DistanceBasedShippingCost\Test\Checkout;

use Doctrine\DBAL\Connection;
use Magmodules\DistanceBasedShippingCost\Core\Content\MagmodulesDistanceBasedShippingCost\MagmodulesDistanceBasedShippingCostConstants;
use Magmodules\DistanceBasedShippingCost\Service\ConfigService;
use Magmodules\DistanceBasedShippingCost\Test\CustomerTestBehaviour;
use PHPUnit\Framework\TestCase;
use Shopware\Core\Framework\Context;
use Shopware\Core\Framework\Uuid\Uuid;
use Shopware\Storefront\Page\Checkout\Confirm\CheckoutConfirmPage;
use Shopware\Storefront\Page\Checkout\Confirm\CheckoutConfirmPageLoader;
use Shopware\Storefront\Test\Page\StorefrontPageTestBehaviour;
use Symfony\Component\HttpFoundation\Request;

class CheckoutConfirmPageTest extends TestCase
{
    use CustomerTestBehaviour;
    use StorefrontPageTestBehaviour;

    protected function setUp(): void
    {
        $config = $this->getContainer()->get(ConfigService::class)->getUnvalidatedConfig(Context::createDefaultContext());
        $this->configId = Uuid::fromHexToBytes($config->getId());
    }

    private function getPage(): CheckoutConfirmPage
    {
        $context = Context::createDefaultContext();
        $salesChContext = $this->createSalesChannelContextWithLoggedInCustomer($context);

        $orderId = $this->placeRandomOrder($salesChContext);
        $request = new Request([], [], ['orderId' => $orderId]);

        return $this->getPageLoader()->load($request, $salesChContext);
    }

    /**
     * @throws \Doctrine\DBAL\Exception
     */
    public function testPageHasDistanceInKm(): void
    {
        $this->getContainer()->get(Connection::class)->update('mm_distance_based_shipping_cost', [
            'google_maps_api_key' => getenv('TEST_GOOGLE_MAPS_API_KEY'),
            'shipping_method_id' => Uuid::fromHexToBytes($this->getValidShippingMethodId()),
            'store_address' => 'Metelen, 48629, Germany',
            'round_total_price' => '2',
            'metric' => MagmodulesDistanceBasedShippingCostConstants::METRIC_KM
        ], ['id' => $this->configId]);


        $page = $this->getPage();

        static::assertArrayHasKey('distanceBasedShippingCostData', $page->getVars());
        static::assertStringContainsString('km', $page->getVars()['distanceBasedShippingCostData']['distanceLabel']);
    }

    /**
     * @throws \Doctrine\DBAL\Exception
     */
    public function testPageHasDistanceInMi(): void
    {
        $this->getContainer()->get(Connection::class)->update('mm_distance_based_shipping_cost', [
            'google_maps_api_key' => getenv('TEST_GOOGLE_MAPS_API_KEY'),
            'shipping_method_id' => Uuid::fromHexToBytes($this->getValidShippingMethodId()),
            'store_address' => 'Metelen, 48629, Germany',
            'round_total_price' => '2',
            'metric' => MagmodulesDistanceBasedShippingCostConstants::METRIC_MI
        ], ['id' => $this->configId]);

        $page = $this->getPage();

        static::assertArrayHasKey('distanceBasedShippingCostData', $page->getVars());
        static::assertStringContainsString('mi', $page->getVars()['distanceBasedShippingCostData']['distanceLabel']);
    }

    /**
     * @throws \Doctrine\DBAL\Exception
     */
    public function testPageHasErrorWhenNoStoreAddressSet(): void
    {
        $this->getContainer()->get(Connection::class)->update('mm_distance_based_shipping_cost', [
            'google_maps_api_key' => getenv('TEST_GOOGLE_MAPS_API_KEY'),
            'shipping_method_id' => Uuid::fromHexToBytes($this->getValidShippingMethodId()),
            'store_address' => '',
            'round_total_price' => '2',
            'metric' => MagmodulesDistanceBasedShippingCostConstants::METRIC_MI
        ], ['id' => $this->configId]);

        $page = $this->getPage();

        static::assertArrayHasKey('distanceBasedShippingCostData', $page->getVars());
        static::assertStringContainsString('error', $page->getVars()['distanceBasedShippingCostData']['distanceLabel']);
    }

    public function testPageHasErrorWhenNoApiSet(): void
    {
        $this->getContainer()->get(Connection::class)->update('mm_distance_based_shipping_cost', [
            'google_maps_api_key' => '',
            'shipping_method_id' => Uuid::fromHexToBytes($this->getValidShippingMethodId()),
            'store_address' => '',
            'round_total_price' => '2',
            'metric' => MagmodulesDistanceBasedShippingCostConstants::METRIC_MI
        ], ['id' => $this->configId]);

        $page = $this->getPage();

        static::assertArrayHasKey('distanceBasedShippingCostData', $page->getVars());
        static::assertStringContainsString('error', $page->getVars()['distanceBasedShippingCostData']['distanceLabel']);
    }

    public function testPageHasNoAdditionalDataInDistanceWhenNoShippingMethodSet(): void
    {
        $this->getContainer()->get(Connection::class)->update('mm_distance_based_shipping_cost', [
            'google_maps_api_key' => getenv('TEST_GOOGLE_MAPS_API_KEY'),
            'shipping_method_id' => null,
            'store_address' => '',
            'round_total_price' => '2',
            'metric' => MagmodulesDistanceBasedShippingCostConstants::METRIC_MI
        ], ['id' => $this->configId]);

        $page = $this->getPage();

        static::assertArrayNotHasKey('distanceBasedShippingCostData', $page->getVars());
    }

    protected function getPageLoader()
    {
        return $this->getContainer()->get(CheckoutConfirmPageLoader::class);

    }


}
