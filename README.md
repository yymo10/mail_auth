# 簡易確認コード送信ライブラリ
## License
### Apache License
[https://github.com/yymo10/mail_auth/blob/5763f0dcde4b54f946773b719c9ea8cf006d5293/LICENSE](https://github.com/yymo10/mail_auth/blob/5763f0dcde4b54f946773b719c9ea8cf006d5293/LICENSE)
## 概要
### メールアドレスの所有者の確認
- メールアドレスの登録時など、登録者がメールアドレスの所有者であることを確認する為に登録するメール宛に確認コードを送信し、確認コードを入力する事で、所有者である事を認証する。
## 前提条件
- ウェブサーバ上にSMTPサーバが構築されていること
- PHP 4.0.6, PHP 5, PHP 7, PHP 8
- mb_send_mailモジュールが使用できること
## 導入
1. ダウンロード
    - Git
        ```bash
        git clone https://github.com/yymo10/mail_auth.git
        ```
    - Zipファイルのダウンロード
    
        [Zipファイルダウンロード](https://github.com/y-ymo10/mail_auth/archive/refs/heads/master.zip)
    
        ```
        unzip master.zip
        ```
2. session_start()とmail_auth.phpの読み込み設定
    - session_start()をphpプログラムの中で最上位で設定
    - mail_auth.phpをrequire_once()で読み込み
    ```php
    <?php 
    session_start();
    require_once('./lib/mail_auth.php');
    ?>
    ```
4. 
### lib/mail_auth.php
- ```mail_auth.php```を``` require_once() ```で読み込むことで使用可能になる。
### 確認コード送信と入力フォームのサンプルコード
``` ./index.php ```
```php
<?php
session_start();　// セッションを使用するので、session_start（）を必ず設定
require_once('./lib/mail_auth.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    // Authオブジェクトインスタンス
    // 第一引数で桁数を指定
    $pn = new Auth(6);
    
    // 確認コードのメール送信
    $pn->send();
    ?>
    <form action="./check.php" method="post">
    <input type="text" name="keys" id="" >
    <?php $pn->Create_CSRF(); //CSRFトークンをinputに組み込んでを生成 ?> 
    <input type="submit" value="認証">
    </form>
</body>
</html>
```

### 確認コードのチェックサンプル
``` ./check.php ```
```php
<?php
       session_start();// セッションを使用するので、session_start（）を必ず設定
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        require_once('./lib/mail_auth.php');
        //確認コードの取得
        $val = $_POST['keys'];
        //CSRF対策トークンの取得
        $token = $_POST['token'];
        //Checkオブジェクトインスタンス
        $check = new Check($val,$token);
        //resultメンバ関数で認証結果を取得。成功すればtrue、失敗でfalse
        if($check->result()===true){
            print("成功");
        }else{
            print("失敗");
        }
        
    ?>
</body>
</html>
```
