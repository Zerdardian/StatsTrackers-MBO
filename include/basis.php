<?php
session_start();
$error['bool'] = false;
$error['type'] = null;
$error['message'] = null;

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

// Page info
$fulllink = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

if($pdoconn == true) {
    if(!empty($_GET['one']) && $_GET['one'] != '.php') {
        $page = str_replace('.php', '', $_GET['one']);
    } else {
        $page = 'index';
    }
    
    if(!empty($_GET['two'])) {
        $item = str_replace('.php', '', $_GET['two']);
    } else {
        $item = null;
    }

    if(!empty($_GET['three'])) {
        $pageitem = str_replace('.php', '', $_GET['three']);
    } else {
        $pageitem = null;
    }
    
    if(!empty($_SESSION['curpage'])) {
        if($page != 'login' || $page != 'register') {
            $_SESSION['prevpage'] = $_SESSION['curpage'];
            $_SESSION['fullprevpage'] = $_SESSION['fullpage'];
        } 
        $_SESSION['curpage'] = $page;
        $_SESSION['fullpage'] = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    } else {
        $_SESSION['prevpage'] = $_SESSION['fullprevpage'] = null;
        $_SESSION['curpage'] = $page;
        $_SESSION['fullpage'] = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    }
    
    if(!empty($_SESSION['user'])) {
        $email = $_SESSION['user']['email'];
        $userid = $_SESSION['user']['userid'];
    }    
} else {
    $page = $item = $email = $userid = null;
    $_SESSION['prevpage'] = $_SESSION['fullprevpage'] = $_SESSION['curpage'] = $_SESSION['fullpage'] = null;
}