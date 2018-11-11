<?php
require('src/functions.php');

$stringArr = array(
    'Первая строка',
    'Вторая строка',
    'Третья строка',
    'Четвертая строка'
);
task1($stringArr);

echo '<br><hr><br>';

task2('+', 3, 7, 10, 5);

echo '<br><hr><br>';

task2('-', 3, 7, 10, 5);

echo '<br><hr><br>';

task2('*', 3, 7, 10, 5);

echo '<br><hr><br>';

task2('/', 3, 7, 10, 5);

echo '<br><hr><br>';

task3(10, 7);
