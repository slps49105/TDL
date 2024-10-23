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
                <li class=""><a href="" class="text-decoration-none">D</a></li>
                <li class=""><a href="" class="text-decoration-none">W</a></li>
                <li class=""><a href="" class="text-decoration-none">M</a></li>
                <li class=""><a href="" class="text-decoration-none">I</a></li>
            </ul>
        </div>
        <div class="header-profile"><img src="img/gear.svg"></div>
        <div class="header-menu">
            <ul>
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
            <div class="content-title">Daily To Do List</div>
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
                        if (isset($_POST['sure'])) {
                            $todoss = $_POST["todoss"];
                            $sql_query2 = "INSERT INTO daily (listname, username) VALUES ('$todoss', '$username')";
                            mysqli_query($db_link, $sql_query2);
                            header("Location:home.php");
                        }
                        // $res1 = "SELECT * FROM `daily` WHERE username = '$username'";
                        // $res2 = "SELECT * FROM `daily` WHERE checking = 'checked'";
                        // $result1 = mysqli_query($db_link, $res1);
                        // $result2 = mysqli_query($db_link, $res2);
                        // if ($result1->num_rows > 0) {
                        //     $num1 = mysqli_num_rows($result1);
                        //     $num2 = mysqli_num_rows($result2);
                        //     $num4 = 1 / $num1 * 100;
                        //     echo "
                        //         <style>
                        //         .content-main-line-bar {
                        //             position: relative;
                        //         }

                        //         .bar {
                        //             background-color: #445FAA;
                        //             position: relative;
                        //             bottom: 0;
                        //             width: 8px;
                        //             height: " . $num4 . "px;
                        //             box-sizing: border-box;
                        //             animation: grow 0.1s ease-out forwards;
                        //             transform-origin: top;
                        //         }

                        //         @keyframes grow {
                        //             from {
                        //                 transform: scaleY(0);
                        //             }
                        //         }
                        //         </style> 
                        //     ";

                        //     for ($i = 0; $i <= $num2 - 1; $i++) {
                        //         echo "
                        //         <div class=\"bar\"></div>
                        //         ";
                        //     }
                        // } else {
                        //     echo "沒有資料";
                        // }
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
                    <!-- <script>
                        $(document).ready(function() {
                            $(".checked").change(function() {
                                if (this.checked) {
                                    $(".content-main-line-bar").append("<div class = \"bar\"></div>")
                                } else {
                                    $(".bar").last().slideUp(100, function() {
                                        $(this).remove();
                                    });
                                }
                            })
                        })
                    </script> -->
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

                                        $(\".deleteD$Did\").click(function(){
                                            $.ajax({
                                                type: \"POST\",
                                                url: \"func/delete.php\",
                                                dataType: \"json\",
                                                data: {
                                                    Did: $Did,
                                                }
                                            });
                                        })

                                        $(\".labelD$Did\").on('click',\".dateupD$Did\", function () {
                                            $.ajax({
                                                type: \"POST\", //傳送方式
                                                url: \"func/update.php\", //傳送目的地
                                                dataType: \"json\", //資料格式
                                                data: {
                                                    Did: $Did,
                                                    dataup: $(\"#dateup\").val()
                                                }
                                            });
                                        });

                                        $(\".checkedD$Did\").change(function() {
                                            if (this.checked) {
                                                $.ajax({
                                                    type: \"POST\", //傳送方式
                                                    url: \"func/checkedT.php\", //傳送目的地
                                                    dataType: \"json\", //資料格式
                                                    data: {
                                                        Did: $Did
                                                    }
                                                })
                                            } else {
                                                $.ajax({
                                                    type: \"POST\", //傳送方式
                                                    url: \"func/checkedF.php\", //傳送目的地
                                                    dataType: \"json\", //資料格式
                                                    data: {
                                                        Did: $Did
                                                    }
                                                })
                                            }
                                        })
                                    });
                                </script>
                            ";
                        }
                    } else {
                    }
                } else {
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

                                    $(\".deleteW$Wid\").click(function(){
                                        $.ajax({
                                            type: \"POST\",
                                            url: \"func/delete.php\",
                                            dataType: \"json\",
                                            data: {
                                                Wid: $Wid,
                                            }
                                        });
                                    })

                                    $(\".labelW$Wid\").on('click',\".dateupW$Wid\", function () {
                                        $.ajax({
                                            type: \"POST\", //傳送方式
                                            url: \"func/update.php\", //傳送目的地
                                            dataType: \"json\", //資料格式
                                            data: {
                                                Wid: $Wid,
                                                dataup: $(\"#dateup\").val()
                                            }
                                        });
                                    });

                                    $(\".checkedW$Wid\").change(function() {
                                        if (this.checked) {
                                            $.ajax({
                                                type: \"POST\", //傳送方式
                                                url: \"func/checkedT.php\", //傳送目的地
                                                dataType: \"json\", //資料格式
                                                data: {
                                                    Wid: $Wid
                                                }
                                            })
                                        } else {
                                            $.ajax({
                                                type: \"POST\", //傳送方式
                                                url: \"func/checkedF.php\", //傳送目的地
                                                dataType: \"json\", //資料格式
                                                data: {
                                                    Wid: $Wid
                                                }
                                            })
                                        }
                                    })
                                });
                            </script>
                        ";
                    }
                } else {
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

                                    $(\".deleteM$Mid\").click(function(){
                                        $.ajax({
                                            type: \"POST\",
                                            url: \"func/delete.php\",
                                            dataType: \"json\",
                                            data: {
                                                Mid: $Mid,
                                            }
                                        });
                                    })

                                    $(\".labelM$Mid\").on('click',\".dateupM$Mid\", function () {
                                        $.ajax({
                                            type: \"POST\", //傳送方式
                                            url: \"func/update.php\", //傳送目的地
                                            dataType: \"json\", //資料格式
                                            data: {
                                                Mid: $Mid,
                                                dataup: $(\"#dateup\").val()
                                            }
                                        });
                                    });

                                    $(\".checkedM$Mid\").change(function() {
                                        if (this.checked) {
                                            $.ajax({
                                                type: \"POST\", //傳送方式
                                                url: \"func/checkedT.php\", //傳送目的地
                                                dataType: \"json\", //資料格式
                                                data: {
                                                    Mid: $Mid
                                                }
                                            })
                                        } else {
                                            $.ajax({
                                                type: \"POST\", //傳送方式
                                                url: \"func/checkedF.php\", //傳送目的地
                                                dataType: \"json\", //資料格式
                                                data: {
                                                    Mid: $Mid
                                                }
                                            })
                                        }
                                    })
                                });
                            </script>
                        ";
                    }
                } else {
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
                        $checking = $row["checking"];
                        echo "
                                <input type=\"checkbox\" id=\"I$Iid\" class=\"checked checkedI$Iid\" $checking>
                                <label for=\"I$Iid\" class=\"labels labelI$Iid\">$listname
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

                                        $(\".deleteI$Iid\").click(function(){
                                            $.ajax({
                                                type: \"POST\",
                                                url: \"func/delete.php\",
                                                dataType: \"json\",
                                                data: {
                                                    Iid: $Iid,
                                                }
                                            });
                                        })

                                        $(\".labelI$Iid\").on('click',\".dateupI$Iid\", function () {
                                            $.ajax({
                                                type: \"POST\", //傳送方式
                                                url: \"func/update.php\", //傳送目的地
                                                dataType: \"json\", //資料格式
                                                data: {
                                                    Iid: $Iid,
                                                    dataup: $(\"#dateup\").val()
                                                }
                                            });
                                        });

                                        $(\".checkedI$Iid\").change(function() {
                                            if (this.checked) {
                                                $.ajax({
                                                    type: \"POST\", //傳送方式
                                                    url: \"func/checkedT.php\", //傳送目的地
                                                    dataType: \"json\", //資料格式
                                                    data: {
                                                        Iid: $Iid
                                                    }
                                                })
                                            } else {
                                                $.ajax({
                                                    type: \"POST\", //傳送方式
                                                    url: \"func/checkedF.php\", //傳送目的地
                                                    dataType: \"json\", //資料格式
                                                    data: {
                                                        Iid: $Iid
                                                    }
                                                })
                                            }
                                        })
                                    });
                                </script>
                            ";
                    }
                } else {
                }
                ?>
            </div>
            <div class="add"><img src="img/plus-square.svg"></div>
        </div>
    </form>
</body>

</html>