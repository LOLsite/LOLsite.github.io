
<?php

require 'vendor/autoload.php';

// Если вы хотите удалить старые сообщения, измените значение на true. Мы так сделали для очистки демо-примера.
$deleteOldComments = false;

// Настройка хранилища данных

$dir = __DIR__.'/data';

$config = new \JamesMoss\Flywheel\Config($dir, array(
 'formatter' => new \JamesMoss\Flywheel\Formatter\JSON,
));

$repo = new \JamesMoss\Flywheel\Repository('shouts', $config);

// Удаляем комментарии, опубликованные больше 1 часа назад, если в переменной содержится true.

if($deleteOldComments) {

 $oldShouts = $repo->query()
 ->where('createdAt', '<', strtotime('-1 hour'))
 ->execute();

 foreach($oldShouts as $old) {
 $repo->delete($old->id);
 }

}

// Отправляем последние 20 сообщений в формате json

$shouts = $repo->query()
 ->orderBy('createdAt ASC')
 ->limit(20,0)
 ->execute();

$results = array();

$config = array(
 'language' => '\RelativeTime\Languages\English',
 'separator' => ', ',
 'suffix' => true,
 'truncate' => 1,
);

$relativeTime = new \RelativeTime\RelativeTime($config);

foreach($shouts as $shout) {
 $shout->timeAgo = $relativeTime->timeAgo($shout->createdAt);
 $results[] = $shout;
}

header('Content-type: application/json');
echo json_encode($results);

<?php

require 'vendor/autoload.php';

// Если вы хотите удалить старые сообщения, измените значение на true. Мы так сделали для очистки демо-примера.
$deleteOldComments = false;

// Настройка хранилища данных

$dir = __DIR__.'/data';

$config = new \JamesMoss\Flywheel\Config($dir, array(
    'formatter' => new \JamesMoss\Flywheel\Formatter\JSON,
));

$repo = new \JamesMoss\Flywheel\Repository('shouts', $config);

// Удаляем комментарии, опубликованные больше 1 часа назад, если в переменной содержится true.

if($deleteOldComments) {

    $oldShouts = $repo->query()
                ->where('createdAt', '<', strtotime('-1 hour'))
                ->execute();

    foreach($oldShouts as $old) {
        $repo->delete($old->id);
    }

}

// Отправляем последние 20 сообщений в формате json

$shouts = $repo->query()
        ->orderBy('createdAt ASC')
        ->limit(20,0)
        ->execute();

$results = array();

$config = array(
    'language' => '\RelativeTime\Languages\English',
    'separator' => ', ',
    'suffix' => true,
    'truncate' => 1,
);

$relativeTime = new \RelativeTime\RelativeTime($config);

foreach($shouts as $shout) {
    $shout->timeAgo = $relativeTime->timeAgo($shout->createdAt);
    $results[] = $shout;
}

header('Content-type: application/json');
echo json_encode($results);
