<?php

$db_host = 'localhost';
$db_userName = 'root';
$db_password = '';
$db_name = 'memo';

$db_link = @mysqli_connect($db_host, $db_userName, $db_password, $db_name);
if (!$db_link) {
    die('資料庫連結失敗!');
}

mysqli_query($db_link, "SET NAMES 'utf8'");