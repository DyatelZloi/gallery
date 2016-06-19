<?php
    $image = $_GET['image']; // Считываем передаваемый параметр
    $views = $_GET['views'];
    $id = $_GET['id'];
    $views = $views + 1;
    $server = 'localhost';
    $username = 'root';
    $password = '';
    $db_name = 'gallery';

    $mysqli = mysqli_connect($server, $username, $password, $db_name);
    if ($mysqli->connect_errno) {
        printf("Не удалось подключиться: %s\n", $mysqli->connect_error);
        exit();
    }
    $sql = "UPDATE images SET views ='".$views."' WHERE id = '".$id."'";
    $results = mysqli_query($mysqli, $sql);
    mysqli_close($mysqli);
?>
<html>
    <head>
        <meta charset="UTF-8"/>
        <title>
            Посмотреть картинку
        </title>
        <link rel="stylesheet" type="text/css" href="/css/style.css">
    </head>
    <body>
        <div id = "head">
            <a href="index.php">На главную</a>
        </div>
        <div id = "body">
            <img src="img/original/<?php echo $image;?>"/>
        </div>
    </body>
</html>
