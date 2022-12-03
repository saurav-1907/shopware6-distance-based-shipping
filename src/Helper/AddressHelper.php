<?php declare(strict_types=1);

namespace Magmodules\DistanceBasedShippingCost\Helper;

use Shopware\Core\Checkout\Customer\Aggregate\CustomerAddress\CustomerAddressEntity;

class AddressHelper
{
    public static function getShippingAddressAsStr(CustomerAddressEntity $customerAddress): string
    {
        return sprintf('%s, %s, %s',$customerAddress->getStreet(), $customerAddress->getCity(),
            $customerAddress->getZipcode() . ($customerAddress->getCountry() ? ", " . $customerAddress->getCountry()->getName() : ""),
        );
    }
}
