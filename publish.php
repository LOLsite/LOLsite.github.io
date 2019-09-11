
<?php

// Подключение наших библиотек
require 'vendor/autoload.php';

// Настраиваем хранилище данных

$dir = __DIR__.'/data';

$config = new \JamesMoss\Flywheel\Config($dir, array(
 'formatter' => new \JamesMoss\Flywheel\Formatter\JSON,
));

$repo = new \JamesMoss\Flywheel\Repository('shouts', $config);

// Сохраняем поступившие данные (сообщения) в хранилище данных

if(isset($_POST["name"]) && isset($_POST["comment"])) {

 $name = htmlspecialchars($_POST["name"]);
 $name = str_replace(array("\n", "\r"), '', $name);

 $comment = htmlspecialchars($_POST["comment"]);
 $comment = str_replace(array("\n", "\r"), '', $comment);

 // Сохранение нового сообщения

 $shout = new \JamesMoss\Flywheel\Document(array(
 'text' => $comment,
 'name' => $name,
 'createdAt' => time()
 ));

 $repo->store($shout);

}

<?php

// Подключение наших библиотек
require 'vendor/autoload.php';

// Настраиваем хранилище данных

$dir = __DIR__.'/data';

$config = new \JamesMoss\Flywheel\Config($dir, array(
    'formatter' => new \JamesMoss\Flywheel\Formatter\JSON,
));

$repo = new \JamesMoss\Flywheel\Repository('shouts', $config);

// Сохраняем поступившие данные (сообщения) в хранилище данных

if(isset($_POST["name"]) && isset($_POST["comment"])) {

    $name = htmlspecialchars($_POST["name"]);
    $name = str_replace(array("\n", "\r"), '', $name);

    $comment = htmlspecialchars($_POST["comment"]);
    $comment = str_replace(array("\n", "\r"), '', $comment);

    // Сохранение нового сообщения

    $shout = new \JamesMoss\Flywheel\Document(array(
        'text' => $comment,
        'name' => $name,
        'createdAt' => time()
    ));

    $repo->store($shout);

}
