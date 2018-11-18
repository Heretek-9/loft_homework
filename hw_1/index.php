<?php
$name = 'Никита';
$age = 27;
echo 'Меня зовут: '.$name;
echo '<br>';

echo 'Мне '.$age.' лет';
echo '<br>';

echo '" ! | \\ / \' " \\';
echo '<br>';

echo '<br><hr><br>';

define('TOTAL_DRAWINGS', 80);
define('FELT_TIP_PEN', 23);
define('PENCIL', 40);

echo 'Задача: На школьной выставке '.TOTAL_DRAWINGS.' рисунков. '.FELT_TIP_PEN.' из них выполнены фломастерами, '
    .PENCIL.' карандашами, а остальные — красками. Сколько рисунков, выполненные красками, на школьной выставке?';
echo '<br>';
$paint = TOTAL_DRAWINGS - FELT_TIP_PEN - PENCIL;
echo 'Ответ: рисунков выполнено красками: '.$paint.'.';

echo '<br><hr><br>';

$age = mt_rand(0, 100);

if ($age >= 18 && $age <= 65) {
    echo 'Вам еще работать и работать';
} elseif ($age > 65) {
    echo 'Вам пора на пенсию';
} elseif ($age <= 1 && $age >= 17) {
    echo 'Вам ещё рано работать';
} else {
    echo 'Неизвестный возраст';
}

echo '<br><hr><br>';

$day = mt_rand(0, 10);

switch ($day) {
    case 1:
    case 2:
    case 3:
    case 4:
    case 5:
        echo 'Это рабочий день';
        break;
    case 6:
    case 7:
        echo 'Это выходной день';
        break;
    
    default:
        echo 'Неизвестный день';
        break;
}

echo '<br><hr><br>';

$bmw = array(
    'model' => 'X5',
    'speed' => '120',
    'doors' => '5',
    'year' => '2015'
);

$toyota = array(
    'model' => 'Camry',
    'speed' => '110',
    'doors' => '5',
    'year' => '2014'
);

$opel = array(
    'model' => 'Astra',
    'speed' => '115',
    'doors' => '5',
    'year' => '2016'
);

$cars = array('bmw' => $bmw, 'toyota' => $toyota, 'opel' => $opel);

foreach ($cars as $name => $car) {
    echo 'CAR '.$name.'<br>';
    echo $car['model'].' '.$car['speed'].' '.$car['doors'].' '.$car['year'];
    echo '<br><br>';
}

echo '<br><hr><br>';

$length = 10;
$style = '
<style>
    tr td:first-child, thead {
        font-weight: bold;
    }
</style>
';
$html = '';
$th = '<table style="text-align: center;border: 1px solid black;"><tbody><thead><tr><th>-</th>';
for ($i = 1; $i <= $length; $i++) {
    $th .= '<th>'.$i.'</th>';
    $html .= '<tr><td>'.$i.'</td>';
    for ($j = 1; $j <= $length; $j++) {
        if ($i % 2 == 0 && $j % 2 == 0) {
            $html .= '<td>('.($i*$j).')</td>';
        } elseif ($i % 2 == 1 && $j % 2 == 1) {
            $html .= '<td>['.($i*$j).']</td>';
        } else {
            $html .= '<td>' . ($i * $j) . '</td>';
        }
    }
    $html .= '</tr>';
}
$th .= '</tr></thead>';
$html .= '</tbody></table>';
echo $style.$th.$html;
