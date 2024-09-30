<?php
include("../connect.php");
session_start();
$username = $_SESSION['username'];
header('Content-Type: application/json; charset=UTF-8'); //設定資料類型為 json，編碼 utf-8
if ($_SERVER['REQUEST_METHOD'] == "POST") { //如果是 POST 請求
    @$id = $_POST["id"]; //取得 id POST 值
    @$data = $_POST["dataup"];
    $update = "UPDATE daily SET listname = '$data' WHERE id = '$id' and username = '$username'";
    if ($id != null && $data != null) { //如果 id 不為 null
        mysqli_query($db_link, $update);
        //回傳 id 資料da
        echo json_encode(array(
            'id' => $id,
            'dataup' => $data
        ));
    }
}
