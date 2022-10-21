<?php
    // Main page, everything will be loaded before hand.
    // All comments located in the post/ajax pages of this project.
    // Pages are the public pages of this website.

    include_once './vendor/autoload.php';
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    include_once './include/functions.php';
    include_once './include/basis.php';
    include_once './include/meta.php';
    include_once './include/core.php';
?>