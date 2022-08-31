<?php

function sortDeliveryMethods($arr) {
    $result = array();

    foreach($arr as $a) {
        foreach($a['customer_costs'] as $key => $value) {
            $result[$key][$a['code']] = $value;
        }
    }
    
    foreach($result as $key => $value) {
        // Сортировка по названию службы доставки
        ksort($result[$key]);
        // // Сортировка по цене
        // asort($result[$key]);
    }

    return $result;
}

$deliveryMethodsArray = [
    [
        'code' => 'dhl',
        'customer_costs' => [
            22 => '1.000', 
            11 => '3.000',
        ]
    ],
    [
        'code' => 'fedex',
        'customer_costs' => [
            22 => '4.000',
            11 => '6.000',
        ]
    ]
];


$result = sortDeliveryMethods($deliveryMethodsArray);

var_dump($result);