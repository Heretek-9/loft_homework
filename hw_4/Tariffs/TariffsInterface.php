<?php
namespace CarApp\Tariffs;

interface TariffsInterface
{
    public function calcPrice();
    public function constructMessage();
}
