<?php declare(strict_types=1);

namespace Magmodules\DistanceBasedShippingCost\Migration;

use Doctrine\DBAL\Connection;
use Shopware\Core\Framework\Migration\MigrationStep;

class Migration1641214507Matrix extends MigrationStep
{
    public function getCreationTimestamp(): int
    {
        return 1641214507;
    }

    /**
     * @throws \Doctrine\DBAL\Exception
     */
    public function update(Connection $connection): void
    {
        $sql = <<<SQL
            CREATE TABLE IF NOT EXISTS `mm_distance_based_shipping_price_matrix` (
                `id` BINARY(16) NOT NULL,

                `from` INT NOT NULL,
                `to` INT NOT NULL,
                `price` DECIMAL(20,2) NULL DEFAULT NULL,
                `type` TINYINT(1) NULL DEFAULT '0',

                `created_at` DATETIME(3) NOT NULL,
                `updated_at` DATETIME(3) NULL DEFAULT NULL,
                PRIMARY KEY (`id`)
            )
            ENGINE = InnoDB
            DEFAULT CHARSET = utf8mb4
            COLLATE = utf8mb4_unicode_ci;
SQL;
        $connection->executeStatement($sql);
    }

    public function updateDestructive(Connection $connection): void
    {
        // implement update destructive
    }
}
