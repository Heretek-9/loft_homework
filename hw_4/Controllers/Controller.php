<?php

namespace CarApp\Controllers;

class Controller
{
    public function calcTariff($tariffName, $distance, $timeInMinutes, $driverAge, $additionalServices = array())
    {
        $tariffDir = BASE_DIR.DS.'Tariffs'.DS;
        $tariffName = ucfirst(strtolower($tariffName));
        if (is_file($tariffDir.$tariffName.'.php')) {
            require_once $tariffDir.$tariffName.'.php';
        } else {
            echo $tariffDir.$tariffName;
            echo $tariffName.' - некорректный тариф';
            return false;
        }

        if (!isset($distance) || !isset($timeInMinutes) || !isset($driverAge)) {
            echo 'Заданы не все параметры';
            return false;
        }
        if ($driverAge < 18 || $driverAge > 65) {
            echo 'Возраст водителя должен быть от 18 до 65 лет';
            return false;
        }

        $tariffName = 'CarApp\Tariffs\\'.$tariffName;

        $tariff = new $tariffName($distance, $timeInMinutes, $driverAge, $additionalServices);
        $tariff->calcPrice();
        return $tariff->constructMessage();
    }
}
