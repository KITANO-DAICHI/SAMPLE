<?php
// check
if ((strcmp($_GET["state"], $_COOKIE["yahoo_state"]) !== 0) || (strcmp($_GET["code"], "") === 0)) {
    header("Location: /");
    exit;
}

// document
// https://developer.yahoo.co.jp/yconnect/v2/authorization_code/token.html

// set
require_once('config/config.php');

// url
$url = "https://auth.login.yahoo.co.jp/yconnect/v2/token";

$headers = array(
    "Authorization: Basic " . base64_encode(_API_ID_YAHOO . ':' . _SECRET_ID_YAHOO)
);
$data = array(
    'grant_type' => 'authorization_code',
    'client_id' => _API_ID_YAHOO,
    'client_secret' => _SECRET_ID_YAHOO,
    'redirect_uri' => 'http://sample.sample/regist.php',
    'code' => $_GET["code"]
);
// curl
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
$json = curl_exec($ch);
$jsonData = json_decode($json, true);
curl_close($ch);

// document
// https://userinfo.yahooapis.jp/yconnect/v2/attribute

// url
$url = "https://userinfo.yahooapis.jp/yconnect/v2/attribute";

$headers = array(
    "Authorization: Bearer " . $jsonData["access_token"]
);
// curl
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$json = curl_exec($ch);
$jsonData = json_decode($json, true);
curl_close($ch);

php ?>

<!doctype html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title></title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="copyright" content="">
    <meta name="robots" content="index"/>
    <link rel="shortcut icon" href="">
    <link rel="apple-touch-icon" href="">
    <meta property="og:title" content="">
    <meta property="og:type" content="website">
    <meta property="og:url" content="/">
    <meta property="og:description" content="">
    <meta property="og:site_name" content="">
    <meta property="og:image" content="">
    <meta property="og:locale" content="ja_JP">
    <link rel="stylesheet" href="/assets/base.css?1.0.0">
    <script src="/assets/jquery.min.js?1.0.0"></script>
</head>
<body>

<!-- ------------------------------ -->
<div class="page-home-sentence">
    <h2 class="border-bottom-color-site">会員登録画面</h2>
    <div class="page-home-sentence-text">
        <!-- ------------------------------ -->
        <div>
            <input type="text" name="text_1" value="<?php echo $jsonData['family_name'];
            php ?>">
            <input type="text" name="text_1" value="<?php echo $jsonData['given_name'];
            php ?>">
            <input type="text" name="text_1" value="<?php echo $jsonData['family_name#ja-Kana-JP'];
            php ?>">
            <input type="text" name="text_1" value="<?php echo $jsonData['given_name#ja-Kana-JP'];
            php ?>">
            <input type="text" name="text_1" value="<?php echo $jsonData['gender'];
            php ?>">
            <input type="text" name="text_1" value="<?php echo $jsonData['birthdate'];
            php ?>">
            <input type="text" name="text_1" value="<?php echo $jsonData['email'];
            php ?>">
            <input type="text" name="text_1" value="<?php echo $jsonData['address']['postal_code'];
            php ?>">
            <input type="text" name="text_1" value="<?php echo $jsonData['address']['region'];
            php ?>">
            <input type="text" name="text_1" value="<?php echo $jsonData['address']['locality'];
            php ?>">
        </div>
        <!-- ------------------------------ -->
    </div>
</div>
</body>
</html>
