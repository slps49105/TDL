<?php
include("../connect.php");

$username = $_POST['username'];
$password = $_POST['password'];

if ($username == null || $password == null) {
    echo "未輸入帳號或密碼";
}

if ($username && $password) {
    $sql = "SELECT * from `members` where username = '$username' and password = '$password'"; //檢測資料庫是否有對應的username和password的sql
    $result = mysqli_query($db_link, $sql);
    $row = mysqli_num_rows($result);

    if ($row) {
        session_start();
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        header("Location:../home.php");
        exit;
    } else {
        echo "帳號或密碼錯誤";
    }
}
