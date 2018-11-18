<?php
function task1($lines, $return = false)
{
    $result = '';
    foreach ($lines as $line) {
        $result .= '<p>'.$line.'</p>';
    }
    if ($return) {
        return $result;
    }
    echo $result;
}

function task2($action)
{
    $args = func_get_args();
    unset($args[0]);

    if (!isset($args[1])) {
        echo 'Не переданы числа';
        return false;
    }

    $text = 'Результат: '.floatval($args[1]);

    if (!isset($args[2])) {
        echo $text;
        return false;
    }

    $result = floatval($args[1]);
    unset($args[1]);
    switch ($action) {
        case '+':
            foreach ($args as $arg) {
                $text .= ' + '.floatval($arg);
                $result += floatval($arg);
            }
            $text .= ' = '.$result;
            break;
        case '-':
            foreach ($args as $arg) {
                $text .= ' - '.floatval($arg);
                $result -= floatval($arg);
            }
            $text .= ' = '.$result;
            break;
        case '*':
            foreach ($args as $arg) {
                $text .= ' * '.floatval($arg);
                $result *= floatval($arg);
            }
            $text .= ' = '.$result;
            break;
        case '/':
            foreach ($args as $arg) {
                $text .= ' / '.floatval($arg);
                $result /= floatval($arg);
            }
            $text .= ' = '.$result;
            break;
        
        default:
            $text = 'Неизвестное действие';
            break;
    }
    echo $text;
}

function task3($x, $y)
{
    if ($x < 1 || intval($x) != $x) {
        echo $x.' - некорректное число';
        return false;
    }
    if ($y < 1 || intval($y) != $y) {
        echo $y.' - некорректное число';
        return false;
    }
    $style = '
    <style>
        tr td:first-child, thead {
            font-weight: 900;
        }
    </style>
    ';

    $html = '';
    $thFinished = false;
    $th = '<table style="text-align: center;border: 1px solid black;"><tbody><thead><tr><th>-</th>';
    for ($i = 1; $i <= $y; $i++) {
        if ($x < $y && $i <= $x) {
            $th .= '<th>'.$i.'</th>';
        }

        if ($i <= $y) {
            $html .= '<tr><td>'.$i.'</td>';
        } else {
            $html .= '<tr><td> </td>';
        }
        
        for ($j = 1; $j <= $x; $j++) {
            if ($x > $y && $j <= $x && !$thFinished) {
                $th .= '<th>'.$j.'</th>';
                if ($j >= $x) {
                    $thFinished = true;
                }
            }
            $html .= '<td>' . ($i * $j) . '</td>';
        }
        $html .= '</tr>';
    }
    $th .= '</tr></thead>';
    $html .= '</tbody></table>';
    echo $style.$th.$html;
}

function task4()
{
    echo 'Текущая дата - '.date('d.m.Y H:i');
    echo '<br>';
    echo 'unixtime для 24.02.2016 00:00:00 - '.mktime(0, 0, 0, 24, 2, 2016);
}

function task5()
{
    $string = 'Карл у Клары украл Кораллы';
    echo str_replace('К', '', $string);
    echo '<br>';
    $string = 'Две бутылки лимонада';
    echo str_replace('Две', 'Три', $string);
}

function task6()
{
    file_put_contents('test.txt', 'Hello again!');
}

function printFileContent($filename)
{
    if (is_file($filename) ) {
        echo file_get_contents($filename);
    } else {
        echo 'Файл '.$filename.' не найден';
    }
}
