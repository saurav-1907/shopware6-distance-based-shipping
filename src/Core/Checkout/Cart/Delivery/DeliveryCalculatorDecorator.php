<?php declare(strict_types=1);

namespace Magmodules\DistanceBasedShippingCost\Core\Checkout\Cart\Delivery;

use Magmodules\DistanceBasedShippingCost\Core\Content\MagmodulesDistanceBasedShippingCost\MagmodulesDistanceBasedShippingCostEntity;
use Magmodules\DistanceBasedShippingCost\Service\ShippingPriceCalculator;
use Shopware\Core\Checkout\Cart\Cart;
use Shopware\Core\Checkout\Cart\Delivery\DeliveryCalculator;
use Shopware\Core\Checkout\Cart\Delivery\Struct\DeliveryCollection;
use Shopware\Core\Checkout\Cart\LineItem\CartDataCollection;
use Shopware\Core\Checkout\Cart\Price\QuantityPriceCalculator;
use Shopware\Core\Checkout\Cart\Price\Struct\QuantityPriceDefinition;
use Shopware\Core\Checkout\Cart\Tax\Struct\TaxRuleCollection;
use Shopware\Core\Framework\Context;
use Shopware\Core\Framework\DataAbstractionLayer\EntityRepositoryInterface;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\System\SalesChannel\SalesChannelContext;

class DeliveryCalculatorDecorator extends DeliveryCalculator
{
    private DeliveryCalculator $origCalculator;

    private QuantityPriceCalculator $priceCalculator;

    private EntityRepositoryInterface $distanceBasedRepo;

    private ShippingPriceCalculator $distanceBasedShippingPriceCalculator;

    /** @noinspection MagicMethodsValidityInspection
     * @noinspection PhpMissingParentConstructorInspection
     */
    public function __construct(
        DeliveryCalculator        $origCalculator,
        ShippingPriceCalculator   $distanceBasedShippingPriceCalculator,
        EntityRepositoryInterface $entityRepository,
        QuantityPriceCalculator   $priceCalculator
    )
    {
        $this->origCalculator = $origCalculator;
        $this->distanceBasedShippingPriceCalculator = $distanceBasedShippingPriceCalculator;
        $this->distanceBasedRepo = $entityRepository;
        $this->priceCalculator = $priceCalculator;
    }

    public function calculate(CartDataCollection $data, Cart $cart, DeliveryCollection $deliveries, SalesChannelContext $context): void
    {

        $this->origCalculator->calculate($data, $cart, $deliveries, $context);

        $config = $this->getConfig($context->getContext());
        foreach ($deliveries as $delivery) {
            if ($delivery->getShippingMethod()->getId() === $config->getShippingMethodId()) {
                if ($address = $delivery->getLocation()->getAddress()) {
                    $price = $this->distanceBasedShippingPriceCalculator->calculateForAddress($address, $context->getContext());
                    $definition = new QuantityPriceDefinition($price, new TaxRuleCollection(), 1);
                    $costs = $this->priceCalculator->calculate($definition, $context);

                    $delivery->setShippingCosts($costs);
//                    dd($price,$delivery);
                }
            }
        }
    }

    private function getConfig(Context $context): MagmodulesDistanceBasedShippingCostEntity
    {
        return $this->distanceBasedRepo->search(new Criteria(), $context)->first();
    }
}
