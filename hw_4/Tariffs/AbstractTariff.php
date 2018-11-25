<?php
namespace CarApp\Tariffs;

abstract class AbstractTariff implements TariffsInterface
{
    protected $distance;
    protected $timeInMinutes;
    protected $timeNotInMinutes = false;
    protected $driverAge;
    protected $driverAgeMultiplier;
    protected $additionalServicesCost;
    protected $formula;
    protected $currentClassName;
    protected $finalPrice;

    use \CarApp\Traits\AddAdditionalServices;

    public function __construct($distance, $timeInMinutes, $driverAge, $additionalServices = array())
    {
        if ($driverAge < 21) {
            $this->driverAgeMultiplier = 1.1;
        } else {
            $this->driverAgeMultiplier = 1;
        }

        $this->distance = $distance;
        $this->timeInMinutes = $timeInMinutes;
        $this->driverAge = $driverAge;
        $this->additionalServicesCost = 0;

        $currentClassName = get_class($this);
        $currentClassName = explode('\\', $currentClassName);
        $this->currentClassName = end($currentClassName);

        if (!empty($additionalServices)) {
            $this->calcAdditionalServicesCost($additionalServices);
        }
    }

    public function constructMessage()
    {
        $msg = 'Тариф ';

        switch ($this->currentClassName) {
            case 'Basic':
                $msg .= 'базовый';
                break;
            case 'Hourly':
                $msg .= 'почасовой';
                break;
            case 'Daily':
                $msg .= 'суточный';
                break;
            case 'Student':
                $msg .= 'студенческий';
                break;
        }
        $msg .= '<br>';
        $msg .= 'Расстояние: '.$this->distance.' км<br>';

        if ($this->timeNotInMinutes) {
            $msg .= 'Время поездки: '.$this->timeNotInMinutes.'<br>';
        } else {
            $msg .= 'Время поездки: '.$this->timeInMinutes.' мин<br>';
        }

        $msg .= 'Возраст водителя: '.$this->driverAge.'<br>';

        if ($this->driverAgeMultiplier != 1) {
            $msg .= 'Коэффициент молодежный: '.$this->driverAgeMultiplier.'<br>';
        }

        if (empty($this->additionalServices)) {
            $msg .= 'Дополнительные услуги отсутствуют<br>';
        } else {
            $msg .= 'Дополнительные услуги: '.implode(', ', $this->additionalServices).'<br>';
        }

        $msg .= $this->formula;
        $msg .= '<br>';
        return $msg;
    }
}
