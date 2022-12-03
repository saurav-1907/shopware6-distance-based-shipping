<?php declare(strict_types=1);

namespace Magmodules\DistanceBasedShippingCost\Core\Content\MagmodulesDistanceBasedShippingCost;

use Shopware\Core\Framework\DataAbstractionLayer\Entity;
use Shopware\Core\Framework\DataAbstractionLayer\EntityIdTrait;

class MagmodulesDistanceBasedShippingCostEntity extends Entity
{
    use EntityIdTrait;

    /**
     * @var bool
     */
    protected bool $enabled;
    /**
     * @var string|null
     */
    protected ?string $googleMapsApiKey;
    /**
     * @var string|null
     */
    protected ?string $storeAddress;
    /**
     * @var int|null
     */
    protected ?int $metric;
    /**
     * @var string|null
     */
    protected ?string $shippingMethodId;
    /**
     * @var int|null
     */
    protected ?int $roundDistance;
    /**
     * @var string|null
     */
    protected ?string $roundTotalPrice;
    /**
     * @var bool|null
     */
    protected ?bool $shippingPriceEnableFreeShipping;
    /**
     * @var float|null
     */
    protected ?float $shippingPriceMinOrderAmount;
    /**
     * @var bool|null
     */
    protected ?bool $shippingPriceEnableMinMax;
    /**
     * @var float|null
     */
    protected ?float $shippingPriceMinimum;
    /**
     * @var float|null
     */
    protected ?float $shippingPriceMaximum;
    /**
     * @var bool|null
     */
    protected ?bool $orderAmountEnableMin;
    /**
     * @var float|null
     */
    protected ?float $orderAmountMin;
    /**
     * @var bool|null
     */
    protected ?bool $orderAmountBelowMinAction;
    /**
     * @var string|null
     */
    protected ?string $orderAmountBelowMinMessage;
    /**
     * @var bool|null
     */
    protected ?bool $distanceEnableMax;
    /**
     * @var float|null
     */
    protected ?float $distanceMax;
    /**
     * @var int|null
     */
    protected ?int $distanceAboveMaxAction;
    /**
     * @var string|null
     */
    protected ?string $distanceAboveMaxMessage;

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * @param bool $enabled
     */
    public function setEnabled(bool $enabled): void
    {
        $this->enabled = $enabled;
    }

    /**
     * @return string|null
     */
    public function getGoogleMapsApiKey(): ?string
    {
        return $this->googleMapsApiKey;
    }

    /**
     * @param string|null $googleMapsApiKey
     */
    public function setGoogleMapsApiKey(?string $googleMapsApiKey): void
    {
        $this->googleMapsApiKey = $googleMapsApiKey;
    }

    /**
     * @return string|null
     */
    public function getStoreAddress(): ?string
    {
        return $this->storeAddress;
    }

    /**
     * @param string|null $storeAddress
     */
    public function setStoreAddress(?string $storeAddress): void
    {
        $this->storeAddress = $storeAddress;
    }

    /**
     * @return int|null
     */
    public function getMetric(): ?int
    {
        return $this->metric;
    }

    /**
     * @param int|null $metric
     */
    public function setMetric(?int $metric): void
    {
        $this->metric = $metric;
    }

    /**
     * @return int|null
     */
    public function getRoundDistance(): ?int
    {
        return $this->roundDistance;
    }

    /**
     * @param int|null $roundDistance
     */
    public function setRoundDistance(?int $roundDistance): void
    {
        $this->roundDistance = $roundDistance;
    }

    /**
     * @return string|null
     */
    public function getRoundTotalPrice(): ?string
    {
        return $this->roundTotalPrice;
    }

    /**
     * @param string|null $roundTotalPrice
     */
    public function setRoundTotalPrice(?string $roundTotalPrice): void
    {
        $this->roundTotalPrice = $roundTotalPrice;
    }

    /**
     * @return bool|null
     */
    public function getShippingPriceEnableFreeShipping(): ?bool
    {
        return $this->shippingPriceEnableFreeShipping;
    }

    /**
     * @param bool|null $shippingPriceEnableFreeShipping
     */
    public function setShippingPriceEnableFreeShipping(?bool $shippingPriceEnableFreeShipping): void
    {
        $this->shippingPriceEnableFreeShipping = $shippingPriceEnableFreeShipping;
    }

    /**
     * @return float|null
     */
    public function getShippingPriceMinOrderAmount(): ?float
    {
        return $this->shippingPriceMinOrderAmount;
    }

    /**
     * @param float|null $shippingPriceMinOrderAmount
     */
    public function setShippingPriceMinOrderAmount(?float $shippingPriceMinOrderAmount): void
    {
        $this->shippingPriceMinOrderAmount = $shippingPriceMinOrderAmount;
    }

    /**
     * @return bool|null
     */
    public function getShippingPriceEnableMinMax(): ?bool
    {
        return $this->shippingPriceEnableMinMax;
    }

    /**
     * @param bool|null $shippingPriceEnableMinMax
     */
    public function setShippingPriceEnableMinMax(?bool $shippingPriceEnableMinMax): void
    {
        $this->shippingPriceEnableMinMax = $shippingPriceEnableMinMax;
    }

    /**
     * @return float|null
     */
    public function getShippingPriceMinimum(): ?float
    {
        return $this->shippingPriceMinimum;
    }

    /**
     * @param float|null $shippingPriceMinimum
     */
    public function setShippingPriceMinimum(?float $shippingPriceMinimum): void
    {
        $this->shippingPriceMinimum = $shippingPriceMinimum;
    }

    /**
     * @return float|null
     */
    public function getShippingPriceMaximum(): ?float
    {
        return $this->shippingPriceMaximum;
    }

    /**
     * @param float|null $shippingPriceMaximum
     */
    public function setShippingPriceMaximum(?float $shippingPriceMaximum): void
    {
        $this->shippingPriceMaximum = $shippingPriceMaximum;
    }

    /**
     * @return bool|null
     */
    public function getOrderAmountEnableMin(): ?bool
    {
        return $this->orderAmountEnableMin;
    }

    /**
     * @param bool|null $orderAmountEnableMin
     */
    public function setOrderAmountEnableMin(?bool $orderAmountEnableMin): void
    {
        $this->orderAmountEnableMin = $orderAmountEnableMin;
    }

    /**
     * @return float|null
     */
    public function getOrderAmountMin(): ?float
    {
        return $this->orderAmountMin;
    }

    /**
     * @param float|null $orderAmountMin
     */
    public function setOrderAmountMin(?float $orderAmountMin): void
    {
        $this->orderAmountMin = $orderAmountMin;
    }

    /**
     * @return bool|null
     */
    public function getOrderAmountBelowMinAction(): ?bool
    {
        return $this->orderAmountBelowMinAction;
    }

    /**
     * @param bool|null $orderAmountBelowMinAction
     */
    public function setOrderAmountBelowMinAction(?bool $orderAmountBelowMinAction): void
    {
        $this->orderAmountBelowMinAction = $orderAmountBelowMinAction;
    }

    /**
     * @return string|null
     */
    public function getOrderAmountBelowMinMessage(): ?string
    {
        return $this->orderAmountBelowMinMessage;
    }

    /**
     * @param string|null $orderAmountBelowMinMessage
     */
    public function setOrderAmountBelowMinMessage(?string $orderAmountBelowMinMessage): void
    {
        $this->orderAmountBelowMinMessage = $orderAmountBelowMinMessage;
    }

    /**
     * @return bool|null
     */
    public function getDistanceEnableMax(): ?bool
    {
        return $this->distanceEnableMax;
    }

    /**
     * @param bool|null $distanceEnableMax
     */
    public function setDistanceEnableMax(?bool $distanceEnableMax): void
    {
        $this->distanceEnableMax = $distanceEnableMax;
    }

    /**
     * @return float|null
     */
    public function getDistanceMax(): ?float
    {
        return $this->distanceMax;
    }

    /**
     * @param float|null $distanceMax
     */
    public function setDistanceMax(?float $distanceMax): void
    {
        $this->distanceMax = $distanceMax;
    }

    /**
     * @return int|null
     */
    public function getDistanceAboveMaxAction(): ?int
    {
        return $this->distanceAboveMaxAction;
    }

    /**
     * @param int|null $distanceAboveMaxAction
     */
    public function setDistanceAboveMaxAction(?int $distanceAboveMaxAction): void
    {
        $this->distanceAboveMaxAction = $distanceAboveMaxAction;
    }

    /**
     * @return string|null
     */
    public function getDistanceAboveMaxMessage(): ?string
    {
        return $this->distanceAboveMaxMessage;
    }

    /**
     * @param string|null $distanceAboveMaxMessage
     */
    public function setDistanceAboveMaxMessage(?string $distanceAboveMaxMessage): void
    {
        $this->distanceAboveMaxMessage = $distanceAboveMaxMessage;
    }

    /**
     * @return string|null
     */
    public function getShippingMethodId(): ?string
    {
        return $this->shippingMethodId;
    }

    /**
     * @param string|null $shippingMethodId
     */
    public function setShippingMethodId(?string $shippingMethodId): void
    {
        $this->shippingMethodId = $shippingMethodId;
    }

}
