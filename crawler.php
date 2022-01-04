<?php

if (php_sapi_name() !== 'cli') {
    echo "[*] Execute only in CLI Mode";
    exit;
}

use GuzzleHttp\Exception\GuzzleException;
use Src\App;

require_once __DIR__ . '/vendor/autoload.php';

$app = new App('https://alura.com.br');

try {

    $courses = $app->getCourses('/cursos-online-programacao/php');
    foreach ($courses as $course) {
        $app->printer()->display($course);
    }

} catch (GuzzleException $e) {
    echo "Message: {$e->getMessage()}";
}
