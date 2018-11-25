<?php
namespace CarApp\Tariffs;

final class Basic extends AbstractTariff
{
    private $pricePerKilometer = 10;
    private $pricePerMinute = 3;

    public function calcPrice()
    {
        $this->$finalPrice = ($this->pricePerKilometer*$this->distance + $this->pricePerMinute*$this->timeInMinutes) * $this->driverAgeMultiplier + $this->additionalServicesCost;
        
        $this->formula = '('.$this->pricePerKilometer.' * '.$this->distance.' + '.$this->pricePerMinute.' * '.$this->timeInMinutes.')';
        if ($this->driverAgeMultiplier != 1) {
            $this->formula .= ' * '.$this->driverAgeMultiplier;
        }
        if ($this->additionalServicesCost > 0) {
            $this->formula .= ' + '.$this->additionalServicesCost;
        }
        $this->formula .= ' = '.$this->$finalPrice.' руб';
    }
}
