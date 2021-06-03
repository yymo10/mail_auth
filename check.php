<?php
       session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>確認コードチェックサンプル</title>
</head>
<body>
    <?php
        require_once('./lib/mail_auth.php');
        $val = $_POST['keys'];
        $token = $_POST['token'];
        $check = new Check($val,$token);
        if($check->result()===true){
            print("成功");
        }else{
            print("失敗");
        }
    ?>
</body>
</html>
