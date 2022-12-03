<?php

declare(strict_types=1);

namespace Magmodules\DistanceBasedShippingCost;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;
use Shopware\Core\Framework\Plugin;
use Shopware\Core\Framework\Plugin\Context\ActivateContext;
use Shopware\Core\Framework\Plugin\Context\DeactivateContext;
use Shopware\Core\Framework\Plugin\Context\InstallContext;
use Shopware\Core\Framework\Plugin\Context\UninstallContext;
use Shopware\Core\Framework\Uuid\Uuid;

class MagmodulesDistanceBasedShippingCost extends Plugin
{
    public function install(InstallContext $installContext): void
    {
        $installContext->setAutoMigrate(false);
        $migrations = $installContext->getMigrationCollection();
        $migrations->migrateInPlace();

        $connection = $this->container->get(Connection::class);
        if ($connection) {
            try {
                $result = $connection->executeQuery('SELECT * FROM `mm_distance_based_shipping_cost`');
                if ($result && $result->rowCount() === 0) {
                    $this->insertDefaults($connection);
                }
            } catch (Exception $e) {
                $this->insertDefaults($connection);
            }
        }
    }

    public function activate(ActivateContext $activateContext): void
    {
        parent::activate($activateContext);

        $connection = $this->container->get(Connection::class);
        if ($connection) {
            $connection->executeStatement('UPDATE `mm_distance_based_shipping_cost` SET `enabled`=1');
        }
    }

    public function uninstall(UninstallContext $uninstallContext): void
    {
        parent::uninstall($uninstallContext);

        if ($uninstallContext->keepUserData()) {
            return;
        }

        $connection = $this->container->get(Connection::class);
        if ($connection) {
            $connection->executeStatement('DROP TABLE IF EXISTS `mm_distance_based_shipping_cost`');
            $connection->executeStatement('DROP TABLE IF EXISTS `mm_distance_based_shipping_price_matrix`');
        }
    }

    public function deactivate(DeactivateContext $deactivateContext): void
    {
        parent::deactivate($deactivateContext);

        $connection = $this->container->get(Connection::class);
        if ($connection) {
            $connection->executeStatement('UPDATE `mm_distance_based_shipping_cost` SET `enabled`=0');
        }
    }

    /**
     * @throws \Doctrine\DBAL\Exception
     */
    private function insertDefaults(Connection $connection): void
    {
        $connection->executeStatement('INSERT INTO `mm_distance_based_shipping_cost`
                        (`id`, `enabled`, `created_at`)
                        VALUES
                        (?, false, NOW())', [Uuid::randomBytes()]);
    }
}
