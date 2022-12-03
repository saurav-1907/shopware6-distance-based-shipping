<?php

namespace Magmodules\DistanceBasedShippingCost\Test\Service;

use Doctrine\DBAL\Connection;
use Magmodules\DistanceBasedShippingCost\Core\Content\MagmodulesDistanceBasedShippingCost\MagmodulesDistanceBasedShippingCostConstants;
use Magmodules\DistanceBasedShippingCost\Service\ShippingPriceCalculator;
use Magmodules\DistanceBasedShippingCost\Test\CustomerTestBehaviour;
use PHPUnit\Framework\TestCase;
use Shopware\Core\Checkout\Customer\Aggregate\CustomerAddress\CustomerAddressEntity;
use Shopware\Core\Framework\Context;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\Framework\Uuid\Uuid;

class ShippingPriceCalculatorTest extends TestCase
{
    use CustomerTestBehaviour;

    private CustomerAddressEntity $customerShippingAddress;
    private ShippingPriceCalculator $shippingCalculator;
    private string $shippingMethodId;
    private Connection $connection;
    private string $configId;
    private Context $context;

    protected function setUp(): void
    {
        $email = Uuid::randomHex() . '@example.com';
        $context = Context::createDefaultContext();
        $repo = $this->getContainer()->get('mm_distance_based_shipping_cost.repository');
        $customer = $this->createTestCustomer('shopware', $email, $context);

        $this->customerShippingAddress = $customer->getDefaultShippingAddress();
        $this->shippingCalculator = $this->getContainer()->get(ShippingPriceCalculator::class);
        $this->shippingMethodId = Uuid::fromHexToBytes($this->getValidShippingMethodId());
        $this->connection = $this->getContainer()->get(Connection::class);
        $this->configId = Uuid::fromHexToBytes($repo->search(new Criteria(), $context)->first()->getId());
        $this->context = $context;
    }

    /**
     * @throws \Doctrine\DBAL\Exception
     */
    public function testCalculateForAddressIsZeroWhenConfigIsInvalid(): void
    {
        $this->connection->update('mm_distance_based_shipping_cost', [
            'google_maps_api_key' => null,
            'shipping_method_id' => $this->shippingMethodId,
            'store_address' => null,
            'round_total_price' => '0',
            'metric' => MagmodulesDistanceBasedShippingCostConstants::METRIC_KM
        ], ['id' => $this->configId]);

        $cost = $this->shippingCalculator->calculateForAddress($this->customerShippingAddress, $this->context);

        static::assertEquals(0, $cost);
    }

    /**
     * @throws \Doctrine\DBAL\Exception
     */
    public function testCalculateForAddressSucceedsAndIsGreaterThenZero(): void
    {
        $this->connection->update('mm_distance_based_shipping_cost', [
            'google_maps_api_key' => getenv('TEST_GOOGLE_MAPS_API_KEY'),
            'shipping_method_id' => $this->shippingMethodId,
            'store_address' => 'Metelen, 48629, Germany',
            'round_total_price' => '0',
            'metric' => MagmodulesDistanceBasedShippingCostConstants::METRIC_KM
        ], ['id' => $this->configId]);

        $cost = $this->shippingCalculator->calculateForAddress($this->customerShippingAddress, $this->context);

        static::assertGreaterThan(0, $cost);
    }
}
