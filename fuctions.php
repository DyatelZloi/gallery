<?php
    //TODO подумай над именами переменных!
    //Пробегаем по бд и показываем картинки
    function show_images($images){
        foreach ($images as &$value) {
            $show_image = $value['name'];
            echo (
                "
                    <div class='omg'>
                        <img src='img/mini/$show_image' />
                        <!--тут передаём как параметр-->
                        <a class='text' href='image.php?image=$show_image'> Просмотреть изображение</a>
                    </div>
                "



            );
        }
    }

    //TODO подумай о загрузке файлов с одинаковыми именами
    //Загрузка изображений
    function upload_file($file)
    {
        if ($file['name'] == '')
        {
            echo 'Файл не выбран!';
            return;
        }
        if(copy($file['tmp_name'], 'img/original/'.$file['name'])){
            copy($file['tmp_name'], 'img/mini/'.$file['name']);//TODO вынеси тогда в создание мини картинки
            create_thumb('img/mini/'.$file['name']);
            $file = $_FILES['file'];
            $server = 'localhost';
            $username = 'root';
            $password = '';
            $db_name = 'gallery';
            $file_name = $file['name'];
            $sql = "INSERT INTO `images`(`name`, `name_mini`, `views`) VALUES ('".$file_name."','".$file_name."',0)";

            $mysqli = mysqli_connect($server, $username, $password, $db_name);
            $results = mysqli_query($mysqli, $sql);

            //Проверь
            mysqli_close($mysqli);

            echo 'Файл успешно загружен';
        } else echo 'Ошибка загрузки файла';
    }

    //делаем маленькую копию
    function create_thumb($src)
    {
        $source=$src; //наш исходник

        $dest = $src;

        $height=200; //параметр высоты превью
        $width=200; //параметр ширины превью
        $rgb=0xffffff; //цвет заливки несоответствия
        $size = getimagesize($source);//узнаем размеры картинки (дает нам масив size)
        $format = strtolower(substr($size['mime'], strpos($size['mime'], '/')+1)); //определяем тип файла
        $icfunc = "imagecreatefrom" . $format;   //определение функции соответственно типу файла
        if (!function_exists($icfunc)) return false;  //если нет такой функции прекращаем работу скрипта
        $x_ratio = $width / $size[0]; //пропорция ширины будущего превью
        $y_ratio = $height / $size[1]; //пропорция высоты будущего превью
        $ratio       = min($x_ratio, $y_ratio);
        $use_x_ratio = ($x_ratio == $ratio); //соотношения ширины к высоте
        $new_width   = $use_x_ratio  ? $width  : floor($size[0] * $ratio); //ширина превью
        $new_height  = !$use_x_ratio ? $height : floor($size[1] * $ratio); //высота превью
        $new_left    = $use_x_ratio  ? 0 : floor(($width - $new_width) / 2); //расхождение с заданными параметрами по ширине
        $new_top     = !$use_x_ratio ? 0 : floor(($height - $new_height) / 2); //расхождение с заданными параметрами по высоте
        $img = imagecreatetruecolor($width,$height); //создаем вспомогательное изображение пропорциональное превью
        imagefill($img, 0, 0, $rgb); //заливаем его…
        $photo = $icfunc($source); //достаем наш исходник
        imagecopyresampled($img, $photo, $new_left, $new_top, 0, 0, $new_width, $new_height, $size[0], $size[1]); //копируем на него нашу превью с учетом расхождений
        imagejpeg($img, $dest); //выводим результат (превью картинки)
        // Очищаем память после выполнения скрипта
        imagedestroy($img);
        imagedestroy($photo);
    }
?>