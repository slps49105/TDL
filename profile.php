<?php
include("connect.php");
session_start();
$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>檔案</title>
</head>

<body>
    <form action="" method="POST">
        <img src="img/螢幕擷取畫面 2024-09-23 145547.png" class="content-img">
        <div class="profile-container">
            <script>
                $(document).ready(function() {
                    $(".editUsername").click(function() {
                        $(".username").append(
                            `
                            <input type="text" class="newUsername" value="<?PHP echo "$username" ?>">
                            <input type="submit" class="update" value="變更">
                            <input type="submit" class="cancel" value="取消">
                            `
                        );
                        $(".div0, .editUsername-container").hide();
                    });
                    $(".username").on('click', ".update", function() {
                        $.ajax({
                            type: "POST",
                            url: "func/editUsername.php",
                            dataType: "json",
                            data: {
                                newUsername: $(".newUsername").val(),
                            },
                            success: function(response) {
                                setTimeout(function() {
                                    location.reload(); // 延遲重新整理頁面
                                }, 500); // 延遲時間 500ms
                            }
                        });
                    });
                    $(".editPassword-container").on('click', ".editPassword", function() {
                        $.ajax({
                            type: "POST",
                            url: "func/editPassword.php",
                            dataType: "json",
                            data: {
                                newPassword: $(".password").val(),
                            },
                            success: function(response) {
                                setTimeout(function() {
                                    location.reload(); // 延遲重新整理頁面
                                }, 500); // 延遲時間 500ms
                            }
                        });
                    })
                });
            </script>
            <h2>檔案</h2>
            <div class="inputBox">
                <div class="username">
                    <div class="div0"><?PHP echo "$username" ?></div>
                </div>
            </div>
            <div class="inputBox editUsername-container">
                <input type="button" class="editUsername" value="變更帳號">
            </div>
            <div class="inputBox">
                <input type="password" class="password" name="password" placeholder="密碼">
            </div>
            <div class="inputBox editPassword-container">
                <input type="button" class="editPassword" value="變更密碼">
            </div>
            <div class="inputBox goback">
                <a href="home.php"><input type="button" class="back" value="返回"></a>
            </div>
        </div>
    </form>
</body>

</html>