<?php

define('DS', DIRECTORY_SEPARATOR);
define('BASE_DIR', __DIR__);

require BASE_DIR.DS.'Controllers'.DS.'Controller.php';
require BASE_DIR.DS.'Traits'.DS.'AddAdditionalServices.php';
require BASE_DIR.DS.'Tariffs'.DS.'TariffsInterface.php';
require BASE_DIR.DS.'Tariffs'.DS.'AbstractTariff.php';

$controller = new CarApp\Controllers\Controller();

echo $controller->calcTariff('basic', 2, 10, 23);

echo '<br><hr><br>';

echo $controller->calcTariff('hourly', 20, 150, 27, array('gps'));

echo '<br><hr><br>';

echo $controller->calcTariff('daily', 200, 1500, 30, array('gps', 'extraDriver'));

echo '<br><hr><br>';

echo $controller->calcTariff('student', 15, 15, 20, array('gps'));
