<?php
include_once 'FppClient.php';

use Fpp\FppClient;

$host = 'https://api-cn.faceplusplus.com';
$apiKey = '5eMFOQ6yFxElb6S2PcbDWIPdnv8ACzx-';
$apiSecret = 'OKWmuaj-Oqvlk3WNZjsqbpT9k_qqEMo-';

$client = new FppClient($apiKey, $apiSecret, $host);

$data = array(
    'image_url' => imagecreatefromjpeg('https://thispersondoesnotexist.com/image'),
    'return_landmark' => '2',
    'return_attributes' => 'age,headpose'
);

$resp = $client->detectFace($data);
var_dump($resp);
?>