<?php
// document
// https://developer.yahoo.co.jp/yconnect/v2/authorization_code/authorization.html

// set
require_once('config/config.php');
$strState = uniqid();

// url
$strUrl = 'https://auth.login.yahoo.co.jp/yconnect/v2/authorization?';
$strUrl .= 'response_type=code' . '&';
$strUrl .= 'client_id=' . _API_ID_YAHOO . '&';
$strUrl .= 'redirect_uri=http://sample.sample/regist.php' . '&';
$strUrl .= 'bail=1' . '&';
$strUrl .= 'scope=' . urlencode('openid profile email address') . '&';
$strUrl .= 'state=' . $strState . '&';
$strUrl .= 'nonce=' . uniqid() . '&';
$strUrl .= 'display=auto' . '&';
$strUrl .= 'prompt=consent' . '&';
$strUrl .= 'max_age=3600';

// cookie
setcookie("yahoo_state", $strState);

header("Location: {$strUrl}");
exit;
