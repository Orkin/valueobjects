<?php

declare(strict_types=1);

namespace ValueObjects\Money;

use Money\Money as BaseMoney;
use Money\Currency as BaseCurrency;
use ValueObjects\Number\Integer;
use ValueObjects\Number\Real;
use ValueObjects\Number\RoundingMode;
use ValueObjects\Util\Util;
use ValueObjects\ValueObjectInterface;
use function intval;
use function sprintf;

class Money implements ValueObjectInterface
{
    /** @var BaseMoney */
    protected BaseMoney $money;

    /** @var Currency */
    protected Currency $currency;

    /**
     * Returns a Money object from native int amount and string currency code
     *
     * @param  int    $amount   Amount expressed in the smallest units of $currency (e.g. cents)
     * @param  string $currency Currency code of the money object
     * @return static
     */
    public static function fromNative(): self
    {
        $args = func_get_args();

        $amount   = new Integer($args[0]);
        $currency = Currency::fromNative($args[1]);

        return new static($amount, $currency);
    }

    /**
     * Returns a Money object
     *
     * @param Integer  $amount   Amount expressed in the smallest units of $currency (e.g. cents)
     * @param Currency $currency Currency of the money object
     */
    public function __construct(Integer $amount, Currency $currency)
    {
        $baseCurrency   = new BaseCurrency($currency->getCode()->toNative());
        $this->money    = new BaseMoney($amount->toNative(), $baseCurrency);
        $this->currency = $currency;
    }

    /**
     *  Tells whether two Currency are equal by comparing their amount and currency
     *
     * @param  ValueObjectInterface $money
     * @return bool
     */
    public function sameValueAs(ValueObjectInterface $money): bool
    {
        if (false === Util::classEquals($this, $money)) {
            return false;
        }

        return $this->getAmount()->sameValueAs($money->getAmount()) && $this->getCurrency()->sameValueAs($money->getCurrency());
    }

    /**
     * Returns money amount
     *
     * @return Integer
     */
    public function getAmount()
    {
        return new Integer(intval($this->money->getAmount()));
    }

    /**
     * Returns money currency
     *
     * @return Currency
     */
    public function getCurrency(): Currency
    {
        return clone $this->currency;
    }

    /**
     * Add an integer quantity to the amount and returns a new Money object.
     * Use a negative quantity for subtraction.
     *
     * @param Integer $quantity Quantity to add
     *
     * @return Money
     */
    public function add(Integer $quantity)
    {
        $amount = new Integer($this->getAmount()->toNative() + $quantity->toNative());
        return new static($amount, $this->getCurrency());
    }

    /**
     * Multiply the Money amount for a given number and returns a new Money object.
     * Use 0 < Real $multipler < 1 for division.
     *
     * @param  Real  $multiplier
     * @param  mixed $roundingMode Rounding mode of the operation. Defaults to RoundingMode::HALF_UP.
     * @return Money
     */
    public function multiply(Real $multiplier, RoundingMode $roundingMode = null)
    {
        if (null === $roundingMode) {
            $roundingMode = RoundingMode::HALF_UP();
        }

        $amount        = $this->getAmount()->toNative() * $multiplier->toNative();
        $roundedAmount = new Integer(intval(round($amount, 0, $roundingMode->toNative())));
        return new static($roundedAmount, $this->getCurrency());
    }

    /**
     * Returns a string representation of the Money value in format "CUR AMOUNT" (e.g.: EUR 1000)
     *
     * @return string
     */
    public function __toString(): string
    {
        return sprintf('%s %d', $this->getCurrency()->getCode(), $this->getAmount()->toNative());
    }
}
