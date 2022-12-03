<?php declare(strict_types=1);

namespace Magmodules\DistanceBasedShippingCost\Core\Content\MagmodulesDistanceBasedShippingCost;

use Shopware\Core\Framework\DataAbstractionLayer\EntityCollection;

/**
 * @method void               add(MagmodulesDistanceBasedShippingCostEntity $entity)
 * @method void               set(string $key, MagmodulesDistanceBasedShippingCostEntity $entity)
 * @method MagmodulesDistanceBasedShippingCostEntity[]    getIterator()
 * @method MagmodulesDistanceBasedShippingCostEntity[]    getElements()
 * @method MagmodulesDistanceBasedShippingCostEntity|null get(string $key)
 * @method MagmodulesDistanceBasedShippingCostEntity|null first()
 * @method MagmodulesDistanceBasedShippingCostEntity|null last()
 */
class MagmodulesDistanceBasedShippingCostEntityCollection extends EntityCollection
{
    protected function getExpectedClass(): string
    {
        return MagmodulesDistanceBasedShippingCostEntity::class;
    }

    public function getShippingMethodIds(): array
    {
        return $this->fmap(function (MagmodulesDistanceBasedShippingCostEntity $entry) {
            return $entry->getShippingMethodId();
        });
    }
}
