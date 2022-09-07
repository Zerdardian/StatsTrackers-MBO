<?php
session_start();
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$dbname = $_ENV['DBLOGIN'];
$dbpass = $_ENV['DBPASS'];
$dbhost = $_ENV['DBHOST'];
$dbbase = $_ENV['DBBASE'];

$dsn = "mysql:host=$dbhost;dbname=$dbbase;charset=UTF8";

try {
    $pdo = new PDO($dsn, $dbname, $dbpass);

    if ($pdo) {
        $pdoconn = true;
        $pdomsg = null;
    }
} catch (PDOException $e) {
    $pdoconn = false;
    $pdomsg = $e->getMessage();
}

// User info

if(empty($_SESSION['curpage'])) {
    $_SESSION['curpage'] = $page;
}

if(!empty($_SESSION['user'])) {
    $email = $_SESSION['user']['email'];
    $userid = $_SESSION['user']['userid'];
}
