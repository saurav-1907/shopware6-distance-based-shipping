<?php

namespace Magmodules\DistanceBasedShippingCost\Helper;

class UnitRoundingHelper
{
    public static function getRoundedUnit($subject, string $unit): float
    {
        switch ($unit) {
            case '2':
                $subject = round($subject, 2);
                break;
            case '1':
                $subject = round($subject, 1);
                break;
            case '0':
                $subject = round($subject, 0);
                break;
            case 'C':
                $subject = ceil($subject);
                break;
            case 'F':
                $subject = floor($subject);
                break;
        }

        return $subject;
    }
}
