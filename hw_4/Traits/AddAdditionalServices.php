<?php
namespace CarApp\Traits;

trait AddAdditionalServices
{   
    private $gpsCostPerHour = 15;
    private $additionalDriverCost = 100;
    private $additionalServices = array();

    public function calcAdditionalServicesCost($additionalServices)
    {
        foreach ($additionalServices as $service) {
            switch ($service) {
                case 'gps':
                    $this->additionalServicesCost += $this->gpsCostPerHour*ceil($this->timeInMinutes/60);
                    $this->additionalServices[] .= 'GPS в салон';
                    break;
                case 'extraDriver':
                    if (!in_array($this->currentClassName, array('Basic', 'Student'))) {
                        $this->additionalServicesCost += $this->additionalDriverCost;
                        $this->additionalServices[] .= 'дополнительный водитель';
                    } else {
                        echo 'Дополнительный водитель не доступен на тарифах базовый и студенческий<br>';
                    }
                    break;
            }
        }
    }
}
