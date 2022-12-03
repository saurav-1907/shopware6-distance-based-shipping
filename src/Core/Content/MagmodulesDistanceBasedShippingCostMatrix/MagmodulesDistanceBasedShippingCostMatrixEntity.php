<?php declare(strict_types=1);

namespace Magmodules\DistanceBasedShippingCost\Core\Content\MagmodulesDistanceBasedShippingCostMatrix;

use Shopware\Core\Framework\DataAbstractionLayer\Entity;
use Shopware\Core\Framework\DataAbstractionLayer\EntityIdTrait;

class MagmodulesDistanceBasedShippingCostMatrixEntity extends Entity
{
    use EntityIdTrait;

    public const TYPE_FIXED = 1;
    public const TYPE_PER_METRIC = 2;

    /**
     * @var int
     */
    protected int $from;
    /**
     * @var int
     */
    protected int $to;
    /**
     * @var float
     */
    protected float $price;
    /**
     * @var int
     */
    protected int $type;

    /**
     * @return int
     */
    public function getFrom(): int
    {
        return $this->from;
    }

    /**
     * @param int $from
     */
    public function setFrom(int $from): void
    {
        $this->from = $from;
    }

    /**
     * @return int
     */
    public function getTo(): int
    {
        return $this->to;
    }

    /**
     * @param int $to
     */
    public function setTo(int $to): void
    {
        $this->to = $to;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    /**
     * @return int
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * @param int $type
     */
    public function setType(int $type): void
    {
        $this->type = $type;
    }
}
