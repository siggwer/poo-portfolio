<?php

use Framework\Application;

require __DIR__.'/../vendor/autoload.php';

session_start();

$sessionId = session_id();
$cookieId = $_COOKIE['PHPSESSID'] ?? 0;

if ($sessionId === $cookieId) {
    session_regenerate_id(true);
    $sessionId = session_id();
}

if (empty($_SESSION['counter'])) {
    $_SESSION['counter'] = 0;
}
$_SESSION['counter'] += 1;

try {
    $app = new Application();
    $app->init();
    $app->run();

} catch (Exception $exception) {
    var_dump($exception->getMessage());
}