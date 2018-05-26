<?php
// document
// https://developer.yahoo.co.jp/webapi/jlp/furigana/v1/furigana.html

// set
require_once('../config/config.php');

// url
$url = "http://jlp.yahooapis.jp/FuriganaService/V1/furigana";

$data = array(
    'appid' => _API_ID_YAHOO,
    'sentence' => $_POST['user_name']
);

// curl
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
$xml = curl_exec($ch);
$xmlData = simplexml_load_string($xml);
curl_close($ch);

// parse
$kanaData = '';
foreach ($xmlData->Result->WordList as $WordList) {
    foreach ($WordList->Word as $Word) {
        if (isset($Word->Furigana)) {
            $kanaData .= (string)$Word->Furigana;
        } else {
            $kanaData .= (string)$Word->Surface;
        }
    }
}

// return
$data = array();
if (strcmp($kanaData, "") !== 0) {
    $data['status'] = 'OK';
    $data['user_name'] = $_POST['user_name'];
    $data['user_name_kana'] = mb_convert_kana($kanaData, "C", "UTF-8");
} else {
    $data['status'] = 'NG';
}
echo json_encode($data);
