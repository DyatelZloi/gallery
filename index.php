<?php
    include 'fuctions.php';
    $server = 'localhost';
    $username = 'root';
    $password = '';
    $db_name = 'gallery';

    $mysqli = mysqli_connect($server, $username, $password, $db_name);
    if ($mysqli->connect_errno) {
        printf("Не удалось подключиться: %s\n", $mysqli->connect_error);
        exit();
    }
    $results = mysqli_query($mysqli, 'SELECT * FROM images');
    $images = array();

    while($row = mysqli_fetch_assoc($results)){
        $images[] = $row;
    }
    //Обязательно отчищать
    mysqli_free_result($results);
    //Проверь
    mysqli_close($mysqli);
?>
<html>
    <head>
        <meta charset="UTF-8"/>
        <title>
            Галерея изображений
        </title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <div id = "head">
            <a href = "loadimage.php"> Загрузить картинку</a>
        </div>
        <div id = "body">
            <?php
                show_images($images);
            ?>
        </div>
    </body>
</html>
