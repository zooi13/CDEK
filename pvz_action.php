<?php
//Проверка выбраны ли ПВЗ
if(empty($_POST['pvz'])){
    header('Location: index.php');
}
require_once "autorisation.php";

//Данные о товаре
$prods = array(
    array(
        'name'   => 'Название товара',
        'comment' => 'Коментарий к товару',
        'sku'    => '1234',// Артикул
        'price'  => '379', // Стоимость
        'count'  => '1',   // Кол-во
        'weight' => '227', // Вес, гр
        'length' => '10',  // Длина, см
        'width'  => '10',  // Ширина, см
        'height' => '10',  // Высота, см
    ),
);

// Регистрация заявки
$array = array();
$array['type'] = 2;	// Договор "доставка" (для любого договора)
$array['tariff_code'] = '136';
$array['number'] = rand(100, 999); //Номер заказа на сайте
$array['shipment_point'] = 'MSK1949'; //Код ПВЗ отгрузки
$array['delivery_point'] = $_POST['pvz'];

$array['sender'] = array(
    'company' => 'Название компании',
    'name' => 'ФИО контактного лица',
    'phones' => array(
        'number' => '+79999999999', //Номер компании
    ),
    'email'   => 'Электронный адрес компании,',
);

$array['recipient'] = array(
    'name' => $_POST['name'],
    'phones' => array(
        'number' => $_POST['phone'],
    ),
    'email'   => $_POST['email'],
);

foreach($prods as $i => $row) {
    $array['packages'][] = array(
        'number' => ++$i,
        'weight' => $row['weight'] * $row['count'],
        'length' => $row['length'],
        'width'  => $row['width'],
        'height' => $row['height'],
        'comment' => $row['comment'],
        'items'  => array(
            array(
                'name'     => $row['name'],
                'ware_key' => $row['sku'],
                'payment'  => array(
                    'value' => $row['price'],
                ),
                'cost'     => $row['price'] * $row['count'],
                'weight'   => $row['weight'],
                'amount'   => $row['count'],
            )
        )
    );
}

$array = json_encode($array, JSON_UNESCAPED_UNICODE);
$ch = curl_init('https://api.cdek.ru/v2/orders');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $array);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Authorization: Bearer ' . $access_token
));
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
$html = curl_exec($ch);
curl_close($ch);

$res = json_decode($html, true);
echo "<pre>";
var_dump($res);