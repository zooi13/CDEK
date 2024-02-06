<?php

// Авторизация
$array = array();
$array['grant_type']    = 'client_credentials';
$array['client_id']     = 'EMscd6r9JnFiQ3bLoyjJY6eM78JrJceI';
$array['client_secret'] = 'PjLZkKBHEiLK3YsjtNrt3TGNG0ahs3kG';

$ch = curl_init('https://api.edu.cdek.ru/v2/oauth/token?parameters');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($array, '', '&'));
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
$html = curl_exec($ch);
curl_close($ch);
$res = json_decode($html, true);

$access_token = $res['access_token'];