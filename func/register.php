<?php
include("../connect.php");
$username = $_POST["username"];
$password = $_POST["password"];
if (preg_match('/(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])[a-zA-Z0-9]{8}/', $password)) 
{
    $sql_query2 = "INSERT INTO members (username,password) VALUES ('$username','$password')";
    mysqli_query($db_link, $sql_query2);
    header("Location:../login.php");
} 
else 
{
    echo '密碼格式錯誤';
}
