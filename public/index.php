<?php
require_once('config/config.php');
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
    <h2 class="border-bottom-color-site">ユーザ情報取得(PHP)</h2>
    <div class="page-home-sentence-text">
        <!-- ------------------------------ -->
        <form method="POST" action="authentication.php" id="form">
            <button class="btn-s">
                会員登録
            </button>
        </form>
        <!-- ------------------------------ -->
    </div>
</div>

<!-- ------------------------------ -->
<div class="page-home-sentence">
    <h2 class="border-bottom-color-site">ユーザ情報取得(JS)</h2>
    <div class="page-home-sentence-text">
        <!-- ------------------------------ -->
        <span class="yconnectLogin"></span>
        <input type="text" id="name">
        <input type="text" id="email">
        <input type="text" id="address">
        <!-- ------------------------------ -->
    </div>
</div>

<script type="text/javascript">
    // document
    // https://developer.yahoo.co.jp/yconnect/v2/javascript_sdk/
    window.yconnectInit = function () {
        YAHOO.JP.yconnect.Authorization.init({
            button: {    // ボタンに関しては下記URLを参考に設定してください
                // https://developer.yahoo.co.jp/yconnect/loginbuttons.html
                format: "image",
                type: "a",
                textType: "b",
                width: 280,
                height: 38,
                className: "yconnectLogin"
            },
            authorization: {
                clientId: '<?php echo _API_ID_YAHOO; php ?>',    // 登録したClient IDを入力してください
                redirectUri: "http://sample.sample/regist.html", // 本スクリプトを埋め込むページのURLを入力してください
                scope: "openid email profile address",
                windowWidth: "500",
                windowHeight: "400"
            },
            autofill: {
                // 属性パラメーター: "属性情報を挿入したいフォーム要素のID名"
                name: "name",
                email: "email",
                address: "address"
            },
            onSuccess: function (res) {
                // 正常時のコールバック関数
                // res変数に各属性情報が格納されます
            },
            onError: function (res) {
                // エラー発生時のコールバック関数
            },
            onCancel: function (res) {
                // 同意キャンセルされた時のコールバック関数
            }
        });
    };
    (function () {
        var fs = document.getElementsByTagName("script")[0], s = document.createElement("script");
        s.setAttribute("src", "https://s.yimg.jp/images/login/yconnect/auth/2.0.1/auth-min.js");
        fs.parentNode.insertBefore(s, fs);
    })();
</script>

<!-- ------------------------------ -->
<div class="page-home-sentence">
    <h2 class="border-bottom-color-site">入力補完(Yahoo)</h2>
    <div class="page-home-sentence-text">
        <!-- ------------------------------ -->
        <input type="text" id="user_name_yahoo">
        <input type="text" id="user_name_kana_yahoo">
        <!-- ------------------------------ -->
    </div>
</div>

<script>
    <!--
    jQuery.noConflict();
    (function ($) {
        $(function () {
            $('#user_name_yahoo').bind('change', function () {
                $.ajax({
                    url: '/api/yahoo.php',
                    type: 'POST',
                    data: {
                        'user_name': this.value
                    },
                    dataType: 'json',
                    timeout: 10000
                }).done(function (data, textStatus, jqXHR) {
                    if (data.status == 'OK') {
                        $('#user_name_kana_yahoo').val(data.user_name_kana);
                    }
                }).fail(function (data, textStatus, errorThrown) {
                    //
                }).always(function (data, textStatus, returnedObject) {
                    //
                });
            });
        });
    })(jQuery);
    //-->
</script>

<!-- ------------------------------ -->
<div class="page-home-sentence">
    <h2 class="border-bottom-color-site">入力補完(Goo)</h2>
    <div class="page-home-sentence-text">
        <!-- ------------------------------ -->
        <input type="text" id="user_name_goo">
        <input type="text" id="user_name_kana_goo">
        <!-- ------------------------------ -->
    </div>
</div>

<script>
    <!--
    jQuery.noConflict();
    (function ($) {
        $(function () {
            $('#user_name_goo').bind('change', function () {
                $.ajax({
                    url: '/api/goo.php',
                    type: 'POST',
                    data: {
                        'user_name': this.value
                    },
                    dataType: 'json',
                    timeout: 10000
                }).done(function (data, textStatus, jqXHR) {
                    if (data.status == 'OK') {
                        $('#user_name_kana_goo').val(data.user_name_kana);
                    }
                }).fail(function (data, textStatus, errorThrown) {
                    //
                }).always(function (data, textStatus, returnedObject) {
                    //
                });
            });
        });
    })(jQuery);
    //-->
</script>

</body>
</html>
