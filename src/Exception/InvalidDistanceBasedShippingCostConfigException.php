<?php

namespace Magmodules\DistanceBasedShippingCost\Exception;

use Exception;

class InvalidDistanceBasedShippingCostConfigException extends Exception
{
    /** @var string */
    protected $message = 'Distance Based Shipping Cost not correctly configured';
}
