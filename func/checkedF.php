<?php
include("../connect.php");
session_start();
header('Content-Type: application/json; charset=UTF-8'); //設定資料類型為 json，編碼 utf-8
$username = $_SESSION['username'];
if ($_SERVER['REQUEST_METHOD'] == "POST") { //如果是 POST 請求
    @$Did = $_POST["Did"]; //取得 id POST 值
    @$Wid = $_POST["Wid"];
    @$Mid = $_POST["Mid"];
    @$Iid = $_POST["Iid"];
    $Dsave = "UPDATE daily SET checking = '' WHERE id = '$Did' and username = '$username'";
    $Wsave = "UPDATE weekly SET checking = '' WHERE id = '$Wid' and username = '$username'";
    $Msave = "UPDATE monthly SET checking = '' WHERE id = '$Mid' and username = '$username'";
    $Isave = "UPDATE irregularly SET checking = '' WHERE id = '$Iid' and username = '$username'";
    if ($Did != null) { //如果 id 不為 null 回傳 Did 資料
        mysqli_query($db_link, $Dsave);
    } 
    elseif ($Wid != null){
        mysqli_query($db_link, $Wsave);
    } 
    elseif ($Mid != null){
        mysqli_query($db_link, $Msave);
    }
    elseif ($Iid != null){
        mysqli_query($db_link, $Isave);
    }
}
