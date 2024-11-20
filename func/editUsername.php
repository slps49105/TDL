<?php
include("../connect.php");
session_start();
header('Content-Type: application/json; charset=UTF-8');
$username = $_SESSION['username'];
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    @$newUsername = $_POST["newUsername"];

    if ($newUsername != null) {
        mysqli_query($db_link, "START TRANSACTION");

        mysqli_query($db_link, "UPDATE members SET username = '$newUsername' WHERE username = '$username'");
        mysqli_query($db_link, "UPDATE daily SET username = '$newUsername' WHERE username = '$username'");
        mysqli_query($db_link, "UPDATE weekly SET username = '$newUsername' WHERE username = '$username'");
        mysqli_query($db_link, "UPDATE monthly SET username = '$newUsername' WHERE username = '$username'");
        mysqli_query($db_link, "UPDATE irregularly SET username = '$newUsername' WHERE username = '$username'");

        mysqli_query($db_link, "COMMIT;");
        $_SESSION['username'] = $newUsername;
    }
}
