<?php declare(strict_types=1);

namespace Magmodules\DistanceBasedShippingCost\Core\Content\MagmodulesDistanceBasedShippingCost;

use Shopware\Core\Checkout\Shipping\ShippingMethodDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\BoolField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\FkField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\ApiAware;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopware\Core\Framework\DataAbstractionLayer\Field\FloatField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\IdField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\IntField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\LongTextField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\StringField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;

class MagmodulesDistanceBasedShippingCostDefinition extends EntityDefinition
{
    public const ENTITY_NAME = 'mm_distance_based_shipping_cost';

    public function getEntityName(): string
    {
        return self::ENTITY_NAME;
    }

    protected function defineFields(): FieldCollection
    {
        return new FieldCollection([
            (new IdField('id', 'id'))->addFlags(new Required(), new PrimaryKey()),
            (new BoolField('enabled', 'enabled')),
            (new StringField('google_maps_api_key', 'googleMapsApiKey')),
            (new StringField('store_address', 'storeAddress')),
            (new IntField('metric', 'metric')),

            (new FkField('shipping_method_id', 'shippingMethodId', ShippingMethodDefinition::class))->addFlags(new ApiAware()),
            (new IntField('round_distance', 'roundDistance')),
            (new StringField('round_total_price', 'roundTotalPrice')),
            (new BoolField('shipping_price_enable_free_shipping', 'shippingPriceEnableFreeShipping')),
            (new FloatField('shipping_price_min_order_amount', 'shippingPriceMinOrderAmount')),
            (new BoolField('shipping_price_enable_min_max', 'shippingPriceEnableMinMax')),
            (new FloatField('shipping_price_minimum', 'shippingPriceMinimum')),
            (new FloatField('shipping_price_maximum', 'shippingPriceMaximum')),

            (new BoolField('order_amount_enable_min', 'orderAmountEnableMin')),
            (new FloatField('order_amount_min', 'orderAmountMin')),
            (new BoolField('order_amount_below_min_action', 'orderAmountBelowMinAction')),
            (new LongTextField('order_amount_below_min_message', 'orderAmountBelowMinMessage')),

            (new BoolField('distance_enable_max', 'distanceEnableMax')),
            (new FloatField('distance_max', 'distanceMax')),
            (new IntField('distance_above_max_action', 'distanceAboveMaxAction')),
            (new LongTextField('distance_above_max_message', 'distanceAboveMaxMessage')),

        ]);
    }

    public function getEntityClass(): string
    {
        return MagmodulesDistanceBasedShippingCostEntity::class;
    }

    public function getCollectionClass(): string
    {
        return MagmodulesDistanceBasedShippingCostEntityCollection::class;
    }
}
