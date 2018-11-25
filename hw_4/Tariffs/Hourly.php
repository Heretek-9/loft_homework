<?php
namespace CarApp\Tariffs;

final class Hourly extends AbstractTariff
{
    private $pricePerKilometer = 0;
    private $pricePerHour = 200;

    public function calcPrice()
    {
        $timeInHours = ceil($this->timeInMinutes/60);
        $this->timeNotInMinutes = $timeInHours.' час';
        $this->$finalPrice = ($this->pricePerKilometer*$this->distance + $this->pricePerHour*$timeInHours) * $this->driverAgeMultiplier + $this->additionalServicesCost;

        $this->formula = '('.$this->pricePerKilometer.' * '.$this->distance.' + '.$this->pricePerHour.' * '.$timeInHours.')';
        if ($this->driverAgeMultiplier != 1) {
            $this->formula .= ' * '.$this->driverAgeMultiplier;
        }
        if ($this->additionalServicesCost > 0) {
            $this->formula .= ' + '.$this->additionalServicesCost;
        }
        $this->formula .= ' = '.$this->$finalPrice.' руб';
    }
}
