<?php declare(strict_types=1);

namespace Magmodules\DistanceBasedShippingCost\Core\Content\MagmodulesDistanceBasedShippingCostMatrix;

use Shopware\Core\Framework\DataAbstractionLayer\EntityCollection;

/**
 * @method void               add(MagmodulesDistanceBasedShippingCostMatrixEntity $entity)
 * @method void               set(string $key, MagmodulesDistanceBasedShippingCostMatrixEntity $entity)
 * @method MagmodulesDistanceBasedShippingCostMatrixEntity[]    getIterator()
 * @method MagmodulesDistanceBasedShippingCostMatrixEntity[]    getElements()
 * @method MagmodulesDistanceBasedShippingCostMatrixEntity|null get(string $key)
 * @method MagmodulesDistanceBasedShippingCostMatrixEntity|null first()
 * @method MagmodulesDistanceBasedShippingCostMatrixEntity|null last()
 */
class MagmodulesDistanceBasedShippingCostMatrixEntityCollection extends EntityCollection
{
    protected function getExpectedClass(): string
    {
        return MagmodulesDistanceBasedShippingCostMatrixEntity::class;
    }
}
