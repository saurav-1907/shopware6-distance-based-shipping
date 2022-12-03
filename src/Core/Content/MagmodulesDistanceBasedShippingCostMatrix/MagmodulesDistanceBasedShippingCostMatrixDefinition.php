<?php declare(strict_types=1);

namespace Magmodules\DistanceBasedShippingCost\Core\Content\MagmodulesDistanceBasedShippingCostMatrix;

use Shopware\Core\Framework\DataAbstractionLayer\EntityDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\BoolField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopware\Core\Framework\DataAbstractionLayer\Field\FloatField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\IdField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\IntField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;

class MagmodulesDistanceBasedShippingCostMatrixDefinition extends EntityDefinition
{
    public const ENTITY_NAME = 'mm_distance_based_shipping_price_matrix';

    public function getEntityName(): string
    {
        return self::ENTITY_NAME;
    }

    protected function defineFields(): FieldCollection
    {
        return new FieldCollection([
            (new IdField('id', 'id'))->addFlags(new Required(), new PrimaryKey()),
            (new IntField('from', 'from'))->addFlags(new Required()),
            (new IntField('to', 'to'))->addFlags(new Required()),
            (new FloatField('price', 'price'))->addFlags(new Required()),
            (new IntField('type', 'type'))->addFlags(new Required())
        ]);
    }

    public function getEntityClass(): string
    {
        return MagmodulesDistanceBasedShippingCostMatrixEntity::class;
    }

    public function getCollectionClass(): string
    {
        return MagmodulesDistanceBasedShippingCostMatrixEntityCollection::class;
    }
}
