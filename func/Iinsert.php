<?php
include("../connect.php");
session_start();
header('Content-Type: application/json; charset=UTF-8');
$username = $_SESSION['username'];
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    @$Iinsert = $_POST["Iinsert"];
    @$deadline = $_POST["deadline"];

    if ($Iinsert != null && $deadline != null) {
        $insert = "INSERT INTO irregularly (listname, deadline, username) VALUES ('$Iinsert', '$deadline', '$username')";
        mysqli_query($db_link, $insert);
    }
}
