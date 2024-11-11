<?php
include("../connect.php");
session_start();
header('Content-Type: application/json; charset=UTF-8');
$username = $_SESSION['username'];
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $datas = [
        'Ddata' => $_POST["Dinsert"],
        'Wdata' => $_POST["Winsert"],
        'Mdata' => $_POST["Minsert"],
        'Idata' => $_POST["Iinsert"]
    ];

    $tables = [
        'Ddata' => 'daily',
        'Wdata' => 'weekly',
        'Mdata' => 'monthly',
        'Idata' => 'irregularly'
    ];

    foreach ($datas as $key => $data) {
        if ($data != null) { // 如果 data 不為 null
            $table = $tables[$key];
            $insert = "INSERT INTO $table (listname, username) VALUES ('$data', '$username')";
            mysqli_query($db_link, $insert);
            break; // 找到第一個不為 null 的 id 後停止
        }
    }
}