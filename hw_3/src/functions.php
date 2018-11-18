<?php

function task1()
{
    $xml = simplexml_load_file('data.xml') or die('Ошибка при открытии файла data.xml');
    $html = '<h2>Order Receipt</h2>';
    $html .= 'Order № '.$xml['PurchaseOrderNumber'].'<br>';
    $html .= 'Date '.$xml['OrderDate'].'<br><br>';
    
    $shippingAddress = $xml->xpath('Address[@Type="Shipping"]')[0];
    $billingAddress = $xml->xpath('Address[@Type="Billing"]')[0];

    $html .= '<h3>Shipping address</h3>';
    $html .= 'Country: '.$shippingAddress->Country.'<br>';
    $html .= 'State: '.$shippingAddress->State.'<br>';
    $html .= 'City: '.$shippingAddress->City.'<br>';
    $html .= 'Street: '.$shippingAddress->Street.'<br>';
    $html .= 'Zip: '.$shippingAddress->Zip.'<br>';
    $html .= 'Name: '.$shippingAddress->Name.'<br>';

    $html .= '<h3>Billing address</h3>';
    $html .= 'Country: '.$billingAddress->Country.'<br>';
    $html .= 'State: '.$billingAddress->State.'<br>';
    $html .= 'City: '.$billingAddress->City.'<br>';
    $html .= 'Street: '.$billingAddress->Street.'<br>';
    $html .= 'Zip: '.$billingAddress->Zip.'<br>';
    $html .= 'Name: '.$billingAddress->Name.'<br>';

    $html .= '<h3>Delivery notes</h3> '.$xml->DeliveryNotes.'<br>';

    $html .= '<h3>Order Content</h3>';

    $html .= '<table><thead><tr>';
    $html .= '<th>Product name</th>';
    $html .= '<th>Part number</th>';
    $html .= '<th>Quantity</th>';
    $html .= '<th>Price</th>';
    $html .= '<th>Comment</th>';
    $html .= '<th>Shipping date</th>';
    $html .= '</tr></thead><tbody>';

    foreach ($xml->Items->children() as $item) {
        $html .= '<tr>';
        $html .= '<td>'.$item->ProductName.'</td>';
        $html .= '<td>'.$item['PartNumber'].'</td>';
        $html .= '<td>'.$item->Quantity.'</td>';
        $html .= '<td>'.$item->USPrice.'</td>';
        $html .= '<td>'.$item->Comment.'</td>';
        $html .= '<td>'.$item->ShipDate.'</td>';
        $html .= '</tr>';
    }

    $html .= '</tbody></table>';
    echo $html;
}

function task2()
{
    $array = array(
        'bmw' => array(
            'model' => 'X5',
            'speed' => '120',
            'doors' => '5',
            'year' => '2015'
        ),
        'toyota' => array(
            'model' => 'Camry',
            'speed' => '110',
            'doors' => '5',
            'year' => '2014'
        ),
        'opel' => array(
            'model' => 'Astra',
            'speed' => '115',
            'doors' => '5',
            'year' => '2016'
        )
    );

    file_put_contents('output.json', json_encode($array));

    $originalArray = json_decode(file_get_contents('output.json'), true);
    $changedArray = arrayRandomChange($originalArray);

    file_put_contents('output2.json', json_encode($changedArray));

    $originalArray = json_decode(file_get_contents('output.json'), true);
    $changedArray = json_decode(file_get_contents('output2.json'), true);

    $differences = arrayCompare($originalArray, $changedArray);

    /*echo '<pre>';
    print_r($originalArray);
    print_r($changedArray);
    echo '</pre>';*/

    foreach ($differences as $difference) {
        echo 'Путь - '.$difference.'<br>';
    }
}

function arrayRandomChange($array)
{
    foreach ($array as $key => $value) {
        if (is_array($value)) {
            $array[$key] = arrayRandomChange($value);
        } else {
            if (rand(0, 1)) {
                $array[$key] = chr(rand(48, 126));
            }
        }
    }
    return $array;
}

function arrayCompare($array1, $array2, $keyPath = '', $diff = array())
{
    foreach ($array1 as $key => $value) {
        if (!isset($array2[$key]) || (is_array($value) && !is_array($array2[$key]))) {
            $diff[] = $keyPath.'['.$key.'], структура массивов различается';
        } elseif (is_array($value) && is_array($array2[$key])) {
            $diff += arrayCompare($value, $array2[$key], $keyPath.'['.$key.']', $diff);
        } elseif ($value !== $array2[$key]) {
            $diff[] = $keyPath.'['.$key.'], было - ('.$value.'), стало - ('.$array2[$key].')';
        }
    }
    return $diff;
}

function task3()
{
    $array = array();
    $fileName = 'task3.csv';
    $summ = 0;

    for ($i = 0; $i < 50; $i++) {
        $array[] = mt_rand(1, 100);
    }

    $file = fopen($fileName, 'w');
    fputcsv($file, $array, ';');
    fclose($file);

    $file = fopen($fileName, 'r');
    if (!$file) {
        echo 'Ошибка при открытии файла '.$fileName;
        return false;
    }

    $data = fgetcsv($file, 1000, ';');

    foreach ($data as $value) {
        if ($value % 2 === 0) {
            $summ += $value;
        }
    }

    echo 'Сумма четных чисел - '.$summ;
}

function task4()
{
    $url = 'https://en.wikipedia.org/w/api.php?action=query&titles=Main%20Page&prop=revisions&rvprop=content&format=json';

    $content = json_decode(file_get_contents($url), true);

    if (!isset($content['query']['pages']) || empty($content['query']['pages'])) {
        echo 'Ошибка при получении данных';
        return false;
    }
    foreach ($content['query']['pages'] as $value) {
        echo 'Заголовок страницы - '.$value['title'].'<br>';
        echo 'id страницы - '.$value['pageid'].'<br>';
    }
}
