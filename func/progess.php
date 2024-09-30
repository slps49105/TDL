<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <?php
    include "connect.php";
    $res = "SELECT * FROM `daily`";
    $res2 = "SELECT * FROM `daily` WHERE checking = 'checked'";
    $result = mysqli_query($db_link, $res);
    $result2 = mysqli_query($db_link, $res2);
    $num = mysqli_num_rows($result);
    $num2 = mysqli_num_rows($result2);
    $num4 = 1 / $num * 100;
    echo "
    <style>
        .container {
            width: 500px;
            height: 400px;
            overflow: hidden;
            position: relative;
            margin: 50px auto;
        }

        .barcontainer {
            background-color: #181818;
            position: relative;
            transform: translateY(-50%);
            top: 50%;
            width: 20px;
            height: 320px;
            float: left;
        }
        .add {
            background-color: #9BC9C7;
            position: relative;
            bottom: 0;
            width: 100%;
            height: $num4%;
            box-sizing: border-box;
            animation: grow 0.1s ease-out forwards;
            transform-origin: top;
        }
            
        @keyframes grow {
            from {
                transform: scaleY(0);
            }
        }

    </style> 
    "
    ?>
    <script>
        $(document).ready(function() {
            $(".checked").change(function() {
                if (this.checked) {
                    $(".barcontainer").append("<div class = \"add\"></div>")
                } else {
                    $(".add").last().slideUp(100, function() {
                        $(this).remove();
                    });
                }
            })
        })
    </script>
</head>

<body>
    <div class="container">
        <div class="barcontainer">
            <?php
            for ($i = 0; $i <= $num2 - 1; $i++) {
                echo "
                <div class=\"add\"></div>
                ";
            }
            ?>
        </div>
    </div>
    <input type="checkbox" class="checked">
    <input type="checkbox" class="checked">
    <input type="checkbox" class="checked">
    <input type="checkbox" class="checked">
    <input type="checkbox" class="checked">
    <input type="checkbox" class="checked">
    <input type="checkbox" class="checked">
    <input type="checkbox" class="checked">
    <input type="checkbox" class="checked">
    <input type="checkbox" class="checked">
    <input type="checkbox" class="checked">
</body>

</html>