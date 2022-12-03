<?php

namespace Magmodules\DistanceBasedShippingCost\Test\Migration;

use Doctrine\DBAL\Connection;
use Magmodules\DistanceBasedShippingCost\Migration\Migration1641214506Config;
use PHPUnit\Framework\TestCase;
use Shopware\Core\Framework\Test\TestCaseBase\KernelTestBehaviour;

class Migration1641214506ConfigTest extends TestCase
{
    use KernelTestBehaviour;

    /**
     * @throws \Doctrine\DBAL\Exception
     */
    public function testCreatedTable(): void
    {
        /** @var \Doctrine\DBAL\Connection $testConn */
        $testConn = $this->getContainer()->get(Connection::class);
        $testConn->executeStatement("DROP TABLE IF EXISTS mm_distance_based_shipping_cost");

        $migration = new Migration1641214506Config();
        $migration->update($testConn);

        $tableExists = $testConn->getSchemaManager()->tablesExist('mm_distance_based_shipping_cost');

        self::assertTrue($tableExists);
    }
}
