<?php
    $image = $_GET['image']; // Считываем передаваемый параметр
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

        </div>
        <div id = "body">
            <img src="img/original/<?php echo $image;?>"/>
        </div>
        <div id = "подвал">

        </div>
    </body>
</html>
