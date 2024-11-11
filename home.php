<?php
include("connect.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/css.css">
    <link rel="stylesheet" type="text/css" href="css/checkbox.css">
    <link rel="stylesheet" type="text/css" href="css/dycalendar.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="js/javascript.js"></script>
    <title>TDL</title>
</head>

<body>
    <header class="header vh3">
        <div class="header-logo">TDL</div>
        <div class="header-list">
            <ul class="header-list-ul">
                <li>
                    <a href=""><img src="img/person-fill-gear.svg">Profile</a>
                </li>
                <li class="logout">
                    <a href="logout.php"><img src="img/box-arrow-right.svg">Logout</a>
                </li>
                <li class="login">
                    <a href="login.php"><img src="img/box-arrow-right.svg">Login</a>
                </li>
            </ul>
        </div>
        <script>
            $(document).ready(function() {
                $(".header-profile").click(function() {
                    $(".header-menu").fadeToggle(500);
                });
            });
        </script>
    </header>
    <form class="content" method="post">
        <img src="img/螢幕擷取畫面 2024-09-23 145547.png" class="content-img">
        <div id="dycalendar"></div>
        <script src="js/dycalendar.js"></script>
        <script>
            dycalendar.draw({
                target: '#dycalendar',
            });
        </script>
        <div id="clock"></div>
        <div class="content-main">
            <div class="content-title">To Do List</div>
            <div class="content-main-line">
                <div class="content-main-line-bar">
                    <?php
                    if (isset($_SESSION['username'])) {
                        $username = $_SESSION['username'];
                        echo "
                            <style>
                            .login {
                                display: none;
                            }
                            </style>
                        ";
                    } else {
                        echo "
                            <div class=\"nlogin\">未登入</div>
                            <style>

                            .logout {
                                display: none;
                            }

                            .add {
                                display: none;
                            }

                            .nlogin {
                                top: 20vh;
                                position: relative;
                            }

                            </style>
                        ";
                    }
                    ?>
                </div>
            </div>
            <div class="content-main-list">
                <ul class="content-main-ul">
                    <li class="daily dy">Daily</li>
                    <li class="weekly wy">Weekly</li>
                    <li class="monthly my">Monthly</li>
                    <li class="irregularly iy">Irregularly</li>
                </ul>
            </div>
            <div id="mycalendar"></div>
            <script>
                dycalendar.draw({
                    target: '#mycalendar',
                    type: 'month',
                    highlighttargetdate: true,
                    prevnextbutton: 'show'
                });
            </script>
            <div class="hidden day W M I content-main-checkboxs checkbox-wrapper-11">
                <?php
                if (isset($_SESSION['username'])) {
                    $username = $_SESSION['username'];
                    $result = $db_link->query($sql_query = "SELECT * FROM daily WHERE username = '$username' ORDER BY id ASC");
                    if (isset($result)) {
                        while ($row = $result->fetch_assoc()) {
                            $Did = $row["id"];
                            $listname = $row["listname"];
                            $checking = $row["checking"];
                            echo "
                                <input type=\"checkbox\" id=\"D$Did\" class=\"checked checkedD$Did\" $checking>
                                <label for=\"D$Did\" class=\"labels labelD$Did\">$listname
                                    <a class=\"ilnk-dark update hideD$Did updateD$Did\" value=\"更新\"><img class=\"pencil-square\" src=\"img/pencil-square.svg\"></a>
                                    <a class=\"delete hideD$Did deleteD$Did\" value=\"刪除\"><img class=\"trath\" src=\"img/trash.svg\"></a>
                                </label>
                            ";
                            echo " 
                                <script type=\"text/javascript\">
                                    $(document).ready(function() {
                                        $(\".updateD$Did\").click(function () {
                                            $(\".labelD$Did\").append(
                                                `
                                                <input type=\"text\" id=\"dateup\" name=\"date\" value=\"$listname\">
                                                <input type=\"submit\" class=\"tem update dateupD$Did\" value=\"更新\">
                                                <input type=\"button\" class=\"tem cancel\" value=\"取消\">
                                                `
                                            );
                                            $(\".hideD$Did\").hide();
                                        });

                                        $(\".labelD$Did\").on('click',\".dateupD$Did\", function () {
                                            const Dudata = $(\"#dateup\").val();
                                            phpSel(\"func/update.php\",\"Did\",\"$Did\", \"dataup\", Dudata);
                                        });

                                        $(\".deleteD$Did\").click(function(){
                                            phpSel(\"func/delete.php\",\"Did\",\"$Did\");
                                            $(\".checkedD$Did, .labelD$Did\").remove();
                                        });

                                        $(\".checkedD$Did\").change(function() {
                                            if (this.checked) {
                                                phpSel(\"func/checkedT.php\",\"Did\",\"$Did\");
                                            } else {
                                                phpSel(\"func/checkedF.php\",\"Did\",\"$Did\");
                                            }
                                        });
                                    });
                                </script>
                            ";
                        }
                    }
                }
                ?>
            </div>
            <div class="hidden week D M I content-main-checkboxs checkbox-wrapper-11">
                <?php
                if (isset($_SESSION['username'])) {
                    $username = $_SESSION['username'];
                    $result = $db_link->query($sql_query = "SELECT * FROM weekly WHERE username = '$username' ORDER BY id ASC");
                    while ($row = $result->fetch_assoc()) {
                        $Wid = $row["id"];
                        $listname = $row["listname"];
                        $checking = $row["checking"];
                        echo "
                            <input type=\"checkbox\" id=\"W$Wid\" class=\"checked checkedW$Wid\" $checking>
                            <label for=\"W$Wid\" class=\"labels labelW$Wid\">$listname
                                <a class=\"ilnk-dark update hideW$Wid updateW$Wid\" value=\"更新\"><img class=\"pencil-square\" src=\"img/pencil-square.svg\"></a>
                                <a class=\"delete hideW$Wid deleteW$Wid\" value=\"刪除\"><img class=\"trath\" src=\"img/trash.svg\"></a>
                            </label>
                        ";
                        echo " 
                            <script type=\"text/javascript\">
                                $(document).ready(function() {
                                    $(\".updateW$Wid\").click(function () {
                                        $(\".labelW$Wid\").append(
                                            `
                                            <input type=\"text\" id=\"dateup\" name=\"date\" value=\"$listname\">
                                            <input type=\"submit\" class=\"tem update dateupW$Wid\" value=\"更新\">
                                            <input type=\"button\" class=\"tem cancel\" value=\"取消\">
                                            `
                                        );
                                        $(\".hideW$Wid\").hide();
                                    });

                                    $(\".labelW$Wid\").on('click',\".dateupW$Wid\", function () {
                                        const Dudata = $(\"#dateup\").val();
                                        phpSel(\"func/update.php\",\"Wid\",\"$Wid\", \"dataup\", Dudata);
                                    });

                                    $(\".deleteW$Wid\").click(function(){
                                        phpSel(\"func/delete.php\",\"Wid\",\"$Wid\");
                                        $(\".checkedW$Wid, .labelW$Wid\").remove();
                                    });

                                    $(\".checkedW$Wid\").change(function() {
                                        if (this.checked) {
                                            phpSel(\"func/checkedT.php\",\"Wid\",\"$Wid\");
                                        } else {
                                            phpSel(\"func/checkedF.php\",\"Wid\",\"$Wid\");
                                        }
                                    });
                                });
                            </script>
                        ";
                    }
                }
                ?>
            </div>
            <div class="hidden month D W I content-main-checkboxs checkbox-wrapper-11">
                <?php
                if (isset($_SESSION['username'])) {
                    $username = $_SESSION['username'];
                    $result = $db_link->query($sql_query = "SELECT * FROM monthly WHERE username = '$username' ORDER BY id ASC");
                    while ($row = $result->fetch_assoc()) {
                        $Mid = $row["id"];
                        $listname = $row["listname"];
                        $checking = $row["checking"];
                        echo "
                            <input type=\"checkbox\" id=\"M$Mid\" class=\"checked checkedM$Mid\" $checking>
                            <label for=\"M$Mid\" class=\"labels labelM$Mid\">$listname
                                <a class=\"ilnk-dark update hideM$Mid updateM$Mid\" value=\"更新\"><img class=\"pencil-square\" src=\"img/pencil-square.svg\"></a>
                                <a class=\"delete hideM$Mid deleteM$Mid\" value=\"刪除\"><img class=\"trath\" src=\"img/trash.svg\"></a>
                            </label>
                        ";
                        echo " 
                            <script type=\"text/javascript\">
                                $(document).ready(function() {
                                    $(\".updateM$Mid\").click(function () {
                                        $(\".labelM$Mid\").append(
                                            `
                                            <input type=\"text\" id=\"dateup\" name=\"date\" value=\"$listname\">
                                            <input type=\"submit\" class=\"tem update dateupM$Mid\" value=\"更新\">
                                            <input type=\"button\" class=\"tem cancel\" value=\"取消\">
                                            `
                                        );
                                        $(\".hideM$Mid\").hide();
                                    });

                                    $(\".labelM$Mid\").on('click',\".dateupM$Mid\", function () {
                                        const Dudata = $(\"#dateup\").val();
                                        phpSel(\"func/update.php\",\"Mid\",\"$Mid\", \"dataup\", Dudata);
                                    });

                                    $(\".deleteM$Mid\").click(function(){
                                        phpSel(\"func/delete.php\",\"Mid\",\"$Mid\");
                                        $(\".checkedM$Mid, .labelM$Mid\").remove();
                                    });

                                    $(\".checkedM$Mid\").change(function() {
                                        if (this.checked) {
                                            phpSel(\"func/checkedT.php\",\"Mid\",\"$Mid\");
                                        } else {
                                            phpSel(\"func/checkedF.php\",\"Mid\",\"$Mid\");
                                        }
                                    });
                                });
                            </script>
                        ";
                    }
                }
                ?>
            </div>
            <div class="hidden irregular D W M content-main-checkboxs checkbox-wrapper-11">
                <?php
                if (isset($_SESSION['username'])) {
                    $username = $_SESSION['username'];
                    $result = $db_link->query($sql_query = "SELECT * FROM irregularly WHERE username = '$username' ORDER BY id ASC");
                    while ($row = $result->fetch_assoc()) {
                        $Iid = $row["id"];
                        $listname = $row["listname"];
                        $deadline = $row["deadline"];
                        $checking = $row["checking"];
                        echo "
                            <input type=\"checkbox\" id=\"I$Iid\" class=\"checked checkedI$Iid\" $checking>
                            <label for=\"I$Iid\" class=\"labels labelI$Iid\">$listname
                                <div>$deadline</div>
                                <a class=\"ilnk-dark update hideI$Iid updateI$Iid\" value=\"更新\"><img class=\"pencil-square\" src=\"img/pencil-square.svg\"></a>
                                <a class=\"delete hideI$Iid deleteI$Iid\" value=\"刪除\"><img class=\"trath\" src=\"img/trash.svg\"></a>
                            </label>
                            ";
                        echo " 
                            <script type=\"text/javascript\">
                                $(document).ready(function() {
                                    $(\".updateI$Iid\").click(function () {
                                        $(\".labelI$Iid\").append(
                                            `
                                            <input type=\"text\" id=\"dateup\" name=\"date\" value=\"$listname\">
                                            <input type=\"submit\" class=\"tem update dateupI$Iid\" value=\"更新\">
                                            <input type=\"button\" class=\"tem cancel\" value=\"取消\">
                                            `
                                        );
                                        $(\".hideI$Iid\").hide();
                                    });

                                    $(\".labelI$Iid\").on('click',\".dateupI$Iid\", function () {
                                        $.ajax({
                                            type: \"POST\", //傳送方式
                                            url: \"func/update.php\", //傳送目的地
                                            dataType: \"json\", //資料格式
                                            data: {
                                                Iid: $Iid,
                                                dataup: $(\"#dateup\").val(),
                                                dataup2: $(\"\").val()
                                            }
                                        });
                                    });

                                    $(\".deleteI$Iid\").click(function(){
                                        phpSel(\"func/delete.php\",\"Iid\",\"$Iid\");
                                        $(\".checkedI$Iid, .labelI$Iid\").remove();
                                    })

                                    $(\".checkedI$Iid\").change(function() {
                                        if (this.checked) {
                                            phpSel(\"func/checkedT.php\",\"Iid\",\"$Iid\");
                                        } else {
                                            phpSel(\"func/checkedF.php\",\"Iid\",\"$Iid\");
                                        }
                                    });
                                });
                            </script>
                        ";
                    }
                }
                ?>
            </div>
            <div class="add"><img src="img/plus-square.svg"></div>
        </div>
    </form>
</body>

</html>