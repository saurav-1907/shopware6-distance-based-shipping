<?php

namespace Magmodules\DistanceBasedShippingCost\Test\Service;

use Doctrine\DBAL\Connection;
use Magmodules\DistanceBasedShippingCost\Core\Content\MagmodulesDistanceBasedShippingCost\MagmodulesDistanceBasedShippingCostConstants;
use Magmodules\DistanceBasedShippingCost\Core\Content\MagmodulesDistanceBasedShippingCost\MagmodulesDistanceBasedShippingCostEntity as MagmodulesDistanceBasedShippingCostEntityAlias;
use Magmodules\DistanceBasedShippingCost\Exception\InvalidDistanceBasedShippingCostConfigException;
use Magmodules\DistanceBasedShippingCost\Service\ConfigService;
use PHPUnit\Framework\TestCase;
use Shopware\Core\Framework\Context;
use Shopware\Core\Framework\DataAbstractionLayer\EntityRepositoryInterface;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\Framework\Test\TestCaseBase\IntegrationTestBehaviour;
use Shopware\Core\Framework\Uuid\Uuid;

class ConfigServiceTest extends TestCase
{
    use IntegrationTestBehaviour;
    private Connection $connection;
    private Context $context;
    private ?MagmodulesDistanceBasedShippingCostEntityAlias $config;
    private ConfigService $configService;

    /**
     * @throws \Doctrine\DBAL\Driver\Exception
     * @throws \Doctrine\DBAL\Exception
     */
    protected function setUp(): void
    {
        $connection = $this->getContainer()->get(Connection::class);

        $context = Context::createDefaultContext();

        /** @var EntityRepositoryInterface $repo * */
        $repo = $this->getContainer()->get('mm_distance_based_shipping_cost.repository');

        $connection->update('mm_distance_based_shipping_cost', [
            'google_maps_api_key' => null,
            'shipping_method_id' => null,
            'store_address' => null,
            'round_total_price' => '2',
            'metric' => MagmodulesDistanceBasedShippingCostConstants::METRIC_KM
        ], ['id' => ($repo->search(new Criteria(), $context))->first()->getId()]);

        $this->connection = $connection;
        $this->context = $context;
        $this->config = (new ConfigService($repo))->getUnvalidatedConfig($context);
        $this->configService = new ConfigService($repo);
    }

    public function testExceptionOnGetValidConfig(): void
    {
        $this->expectException(InvalidDistanceBasedShippingCostConfigException::class);

        $this->configService->getValidConfig($this->context);
    }

    public function testExceptionOnGetValidConfigEmptyApiKey(): void
    {
        $this->expectException(InvalidDistanceBasedShippingCostConfigException::class);

        $this->configService->getValidConfig($this->context);
    }

    public function testExceptionOnGetValidConfigEmptyShippingMethod(): void
    {
        $this->expectException(InvalidDistanceBasedShippingCostConfigException::class);

        $this->connection->update('mm_distance_based_shipping_cost', [
            'google_maps_api_key' => 'abcdefg',
        ], ['id' => Uuid::fromHexToBytes($this->config->getId())]);

        $this->configService->getValidConfig($this->context);
    }

    public function testExceptionOnGetValidConfigEmptyStoreAddress(): void
    {
        $this->expectException(InvalidDistanceBasedShippingCostConfigException::class);

        $this->connection->update('mm_distance_based_shipping_cost', [
            'google_maps_api_key' => 'abcdefg',
            'shipping_method_id' => Uuid::fromHexToBytes($this->getValidShippingMethodId()),
        ], ['id' => Uuid::fromHexToBytes($this->config->getId())]);

        $this->configService->getValidConfig($this->context);
    }

    public function testSuccessGetValidConfig(): void
    {
        $this->connection->update('mm_distance_based_shipping_cost', [
            'google_maps_api_key' => getenv('TEST_GOOGLE_MAPS_API_KEY'),
            'shipping_method_id' => Uuid::fromHexToBytes($this->getValidShippingMethodId()),
            'store_address' => 'Amsterdam, Netherlands',
        ], ['id' => Uuid::fromHexToBytes($this->config->getId())]);

        $this->configService->getValidConfig($this->context);
    }
}
