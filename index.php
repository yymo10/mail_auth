<?php
session_start();
require_once('./lib/mail_auth.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>確認コード送信　サンプル</title>
</head>
<body>
    <?php
    $pn = new Auth(6);
    $pn->send();
    ?>
    <form action="./check.php" method="post">
    <input type="text" name="keys" id="" >
    <?php $pn->Create_CSRF(); ?>
    <input type="submit" value="認証">
    </form>
</body>
</html>
