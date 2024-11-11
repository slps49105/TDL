<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
</head>

<body>
    <form action="func/login.php" method="POST">
        <img src="img/螢幕擷取畫面 2024-09-23 145547.png" class="content-img">
        <div class="login">
            <h2>登入</h2>
            <div class="inputBox">
                <input type="text" name="username" placeholder="使用者名稱">
            </div>
            <div class="inputBox">
                <input type="password" name="password" placeholder="密碼">
            </div>
            <div class="inputBox">
                <input type="submit" value="登入">
            </div>
            <a href="register.php">註冊</a>
        </div>
    </form>
</body>

</html>