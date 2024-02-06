<?php
if(empty($_POST['token'])){
    header('Location: index.php');
}
require_once "autorisation.php";

$uuid = $_POST['token'];

$ch = curl_init('https://api.cdek.ru/v2/orders/' . $uuid);
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
    
echo 'Информация по заказу: ' . $res['entity']['uuid'] . "<br><br>";
echo 'Статус заказа: ' . $res['entity']['statuses']['1']['name'] . "<br><br>";
echo 'Название компании отправителя: ' . $res['entity']['sender']['company'] . "<br>";
echo 'ФИО отправителя: ' . $res['entity']['sender']['name'] . "<br>";
echo 'Электронный адрес компании: ' . $res['entity']['sender']['email'] . "<br>";
echo 'Номер компании: ' . $res['entity']['sender']['phones']['0']['number'] . "<br><br>";

echo 'ФИО получателя: ' . $res['entity']['recipient']['name'] . "<br>";
echo 'Электронный адрес получателя: ' . $res['entity']['recipient']['email'] . "<br>";
echo 'Номер получателя: ' . $res['entity']['recipient']['phones']['0']['number'] . "<br><br>";


