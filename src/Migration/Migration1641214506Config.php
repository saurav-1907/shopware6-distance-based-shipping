<?php declare(strict_types=1);

namespace Magmodules\DistanceBasedShippingCost\Migration;

use Doctrine\DBAL\Connection;
use Shopware\Core\Framework\Migration\MigrationStep;

class Migration1641214506Config extends MigrationStep
{
    public function getCreationTimestamp(): int
    {
        return 1641214506;
    }

    /**
     * @throws \Doctrine\DBAL\Exception
     */
    public function update(Connection $connection): void
    {
        $sql = <<<SQL
            CREATE TABLE IF NOT EXISTS `mm_distance_based_shipping_cost` (
                `id` BINARY(16) NOT NULL,
                `enabled` TINYINT NULL DEFAULT '0',
                `google_maps_api_key` VARCHAR(255) COLLATE utf8mb4_unicode_ci,
                `store_address` VARCHAR(255) COLLATE utf8mb4_unicode_ci,
                `metric` TINYINT NULL DEFAULT '0',

                `shipping_method_id` BINARY(16) NULL,
                `round_distance` TINYINT NULL DEFAULT '0',
                `round_total_price` VARCHAR(2) NULL DEFAULT '0' COLLATE utf8mb4_unicode_ci,
                `shipping_price_enable_free_shipping` TINYINT NULL DEFAULT '0',
                `shipping_price_min_order_amount` DECIMAL(20,2) NULL DEFAULT NULL,
                `shipping_price_enable_min_max` TINYINT NULL DEFAULT '0',
                `shipping_price_minimum` DECIMAL(20,2) NULL DEFAULT NULL,
                `shipping_price_maximum` DECIMAL(20,2) NULL DEFAULT NULL,

                `order_amount_enable_min` TINYINT NULL DEFAULT '0',
                `order_amount_min` DECIMAL(20,2) NULL DEFAULT NULL,
                `order_amount_below_min_action` TINYINT NULL DEFAULT '0',
                `order_amount_below_min_message` LONGTEXT NULL,

                `distance_enable_max` TINYINT NULL DEFAULT '0',
                `distance_max` DECIMAL(13,2) NULL DEFAULT NULL,
                `distance_above_max_action` TINYINT NULL DEFAULT '0',
                `distance_above_max_message` LONGTEXT NULL,

                `created_at` DATETIME NOT NULL,
                `updated_at` DATETIME NULL DEFAULT NULL,
                PRIMARY KEY (`id`),
                CONSTRAINT `fk.mm_distance_based_shipping.shipping_method_id` FOREIGN KEY (`shipping_method_id`)
                    REFERENCES `shipping_method` (`id`) ON UPDATE CASCADE ON DELETE RESTRICT
            )
            ENGINE = InnoDB
            DEFAULT CHARSET = utf8mb4
            COLLATE = utf8mb4_unicode_ci
SQL;
        $connection->executeStatement($sql);
    }

    public function updateDestructive(Connection $connection): void
    {
        // implement update destructive
    }
}
