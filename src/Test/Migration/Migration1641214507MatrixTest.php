<?php

namespace Magmodules\DistanceBasedShippingCost\Test\Migration;

use Doctrine\DBAL\Connection;
use Magmodules\DistanceBasedShippingCost\Migration\Migration1641214507Matrix;
use PHPUnit\Framework\TestCase;
use Shopware\Core\Framework\Test\TestCaseBase\KernelTestBehaviour;

class Migration1641214507MatrixTest extends TestCase
{
    use KernelTestBehaviour;

    /**
     * @throws \Doctrine\DBAL\Exception
     */
    public function testCreatedTable(): void
    {
        /** @var \Doctrine\DBAL\Connection $testConn */
        $testConn = $this->getContainer()->get(Connection::class);
        $testConn->executeStatement("DROP TABLE IF EXISTS mm_distance_based_shipping_price_matrix");

        $migration = new Migration1641214507Matrix();
        $migration->update($testConn);
        $tableExists = $testConn->getSchemaManager()->tablesExist('mm_distance_based_shipping_price_matrix');

        self::assertTrue($tableExists);
    }
}
