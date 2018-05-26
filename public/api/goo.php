<?php
// document
// https://labs.goo.ne.jp/api/jp/hiragana-translation/

// set
require_once('../config/config.php');

// url
$url = "https://labs.goo.ne.jp/api/hiragana";

$data = array(
    'app_id' => _API_ID_GOO,
    'sentence' => $_POST['user_name'],
    'output_type' => 'katakana'
);

// curl
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
$json = curl_exec($ch);
$jsonData = json_decode($json, true);
curl_close($ch);

// return
$data = array();
if (strcmp($jsonData['converted'], "") !== 0) {
    $data['status'] = 'OK';
    $data['user_name'] = $_POST['user_name'];
    $data['user_name_kana'] = $jsonData['converted'];
} else {
    $data['status'] = 'NG';
}
echo json_encode($data);
