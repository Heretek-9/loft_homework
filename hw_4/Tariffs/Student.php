<?php
namespace CarApp\Tariffs;

final class Student extends AbstractTariff
{
    private $pricePerKilometer = 4;
    private $pricePerMinute = 1;

    public function calcPrice()
    {
        if ($this->driverAge > 25) {
            echo 'На тарифе студенческий возраст водителя не может быть более 25 лет';
            return false;
        }

        $this->$finalPrice = ($this->pricePerKilometer * $this->distance + $this->pricePerMinute * $this->timeInMinutes) * $this->driverAgeMultiplier + $this->additionalServicesCost;

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
