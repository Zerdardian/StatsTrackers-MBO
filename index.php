<?php
    include_once './vendor/autoload.php';
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    include_once './include/functions.php';
    include_once './include/basis.php';
    include_once './include/meta.php';
    include_once './include/core.php';
?>