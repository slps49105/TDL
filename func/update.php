<?php
include("../connect.php");
session_start();
header('Content-Type: application/json; charset=UTF-8'); //設定資料類型為 json，編碼 utf-8
$username = $_SESSION['username'];
if ($_SERVER['REQUEST_METHOD'] == "POST") { //如果是 POST 請求
    @$data = $_POST["dataup"];
    $ids = [
        'Did' => $_POST["Did"],
        'Wid' => $_POST["Wid"],
        'Mid' => $_POST["Mid"],
        'Iid' => $_POST["Iid"]
    ];

    $tables = [
        'Did' => 'daily',
        'Wid' => 'weekly',
        'Mid' => 'monthly',
        'Iid' => 'irregularly'
    ];

    foreach ($ids as $key => $id) {
        if ($id != null) { // 如果 id 不為 null
            $table = $tables[$key];
            $update = "UPDATE $table SET listname = '$data' WHERE id = '$id' and username = '$username'";
            mysqli_query($db_link, $update);
            break; // 找到第一個不為 null 的 id 後停止
        }
    }
}
