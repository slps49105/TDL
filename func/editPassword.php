<?php
include("../connect.php");
session_start();
header('Content-Type: application/json; charset=UTF-8');
$password = $_SESSION['password'];
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    @$newPassword = $_POST["newPassword"];

    if ($newPassword != null) {
        mysqli_query($db_link, "UPDATE members SET `password` = '$newPassword' WHERE `password` = '$password'");
        $_SESSION['password'] = $newPassword;
    }
}
