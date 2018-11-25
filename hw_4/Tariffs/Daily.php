<?php
namespace CarApp\Tariffs;

final class Daily extends AbstractTariff
{
    private $pricePerKilometer = 1;
    private $pricePerDay = 1000;

    public function calcPrice()
    {
        $timeInDays = ceil($this->timeInMinutes/(60*24));
        if ($this->timeInMinutes%(60*24) < 30) {
            $timeInDays--;
        }
        $this->timeNotInMinutes = $timeInDays.' дн';
        $this->$finalPrice = ($this->pricePerKilometer * $this->distance + $this->pricePerDay * $timeInDays) * $this->driverAgeMultiplier + $this->additionalServicesCost;

        $this->formula = '('.$this->pricePerKilometer.' * '.$this->distance.' + '.$this->pricePerDay.' * '.$timeInDays.')';
        if ($this->driverAgeMultiplier != 1) {
            $this->formula .= ' * '.$this->driverAgeMultiplier;
        }
        if ($this->additionalServicesCost > 0) {
            $this->formula .= ' + '.$this->additionalServicesCost;
        }
        $this->formula .= ' = '.$this->$finalPrice.' руб';
    }
}
