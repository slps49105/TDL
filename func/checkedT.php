<?php
include("../connect.php");
session_start();
header('Content-Type: application/json; charset=UTF-8'); //設定資料類型為 json，編碼 utf-8
$username = $_SESSION['username'];
if ($_SERVER['REQUEST_METHOD'] == "POST") { //如果是 POST 請求
    @$id = $_POST["id"]; //取得 id POST 值
    $save = "UPDATE daily SET checking = 'checked' WHERE id = '$id' and username = '$username'";
    if ($id != null) { //如果 id 不為 null
        //回傳 id 資料
        mysqli_query($db_link, $save);
    }
}