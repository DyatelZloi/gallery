<html>
    <head>
        <meta charset="UTF-8"/>
        <title>Загрузка файла на сервер</title>
    </head>
    <body>
        <a href="index.php">На главную</a>
        <?php
            include 'fuctions.php';
            if (isset($_FILES['file']))
            {
                upload_file($_FILES['file']);
            }
        ?>
        <form method="post" enctype="multipart/form-data">
            <input type="file" name="file" />
            <input type="submit" value="Загрузить файл!" />
        </form>
    </body>
</html>
