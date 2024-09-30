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
                <li>
                    <a href=""><img src="img/box-arrow-right.svg">Logout</a>
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
        <div class="content-title">Daily To Do List</div>
        <div class="content-main">
            <div class="content-main-line">
                <div class="content-main-line-bar">
                    <?php
                    if (isset($_SESSION['username'])) {
                        $username = $_SESSION['username'];
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
                        echo "未登入";
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

            <div class="content-main-checkboxs checkbox-wrapper-11">
                <?php
                $result = $db_link->query($sql_query = "SELECT * FROM daily ORDER BY id ASC");
                while ($row = $result->fetch_assoc()) {
                    $id = $row["id"];
                    $listname = $row["listname"];
                    $checking = $row["checking"];
                    echo "
                    <input type=\"checkbox\" id=\"$id\" class=\"checked checked$id\" $checking>
                    <label for=\"$id\" class=\"labels label$id\">$listname
                        <a class=\"ilnk-dark update hide$id update$id\" value=\"更新\"><img class=\"pencil-square\" src=\"img/pencil-square.svg\"></a>
                        <a class=\"delete hide$id delete$id\" value=\"刪除\"><img class=\"trath\" src=\"img/trash.svg\"></a>
                    </label>
                    ";
                    echo " 
                    <script type=\"text/javascript\">
                        $(document).ready(function() {
                            $(\".update$id\").click(function () {
                                $(\".label$id\").append(
                                    `
                                    <input type=\"text\" id=\"dateup\" name=\"date\" value=\"$listname\">
                                    <input type=\"submit\" class=\"tem update dateup$id\" value=\"更新\">
                                    <input type=\"button\" class=\"tem cancel\" value=\"取消\">
                                    `
                                );
                                $(\".hide$id\").hide();
                            });

                            $(\".delete$id\").click(function(){
                                $.ajax({
                                    type: \"POST\",
                                    url: \"func/delete.php\",
                                    dataType: \"json\",
                                    data: {
                                        id: $id,
                                    }
                                });
                            })

                            $(\".label$id\").on('click',\".dateup$id\", function () {
                                $.ajax({
                                    type: \"POST\", //傳送方式
                                    url: \"func/update.php\", //傳送目的地
                                    dataType: \"json\", //資料格式
                                    data: {
                                        id: $id,
                                        dataup: $(\"#dateup\").val()
                                    }
                                });
                            });

                            $(\".checked$id\").change(function() {
                                if (this.checked) {
                                    $.ajax({
                                        type: \"POST\", //傳送方式
                                        url: \"func/checkedT.php\", //傳送目的地
                                        dataType: \"json\", //資料格式
                                        data: {
                                            id: $id
                                        }
                                    })
                                } else {
                                    $.ajax({
                                        type: \"POST\", //傳送方式
                                        url: \"func/checkedF.php\", //傳送目的地
                                        dataType: \"json\", //資料格式
                                        data: {
                                            id: $id
                                        }
                                    })
                                }
                            })
                        });
                    </script>
                    ";
                }
                ?>
            </div>
            <div class="add"><img src="img/plus-square.svg"></div>
        </div>
    </form>
</body>

</html>